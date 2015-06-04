<?
//password_resets#new
$app->get("/password_resets/new", SessionsHelper::not_logged_in_user($app), function() use ($app) {
  $app->render('password_resets/new.php');
});

//password_resets#create
$app->post("/password_resets", SessionsHelper::not_logged_in_user($app), function() use ($app, $validator, $environment) {
  $params = $app->request()->post();

  $validation = $validator->make($params, array_merge(
                                 User::$email_alt_rules
  ));

  //creating array of validation errors
  $messages_all = $validation->messages()->all();

  //if there is any validation errors
  if (!empty($messages_all)) {
    $app->flash('messages', ['danger' => $messages_all]);
    $app->redirect('/password_resets/new');
  }

  $user = User::where('email', '=', $params['email'])->first();
  
  if (!$user) {
    $app->flash('messages', ['danger' => ['Email address not found']]);
    $app->redirect('/');
  }

  if ($user->activated) {

    if ($environment == 'development'){
      // used on local machine when you not able to send email
      // after submit password reset link appears in debug_info block
      $user->create_reset_digest();
      $user->save();

      $app->flash('debug_info', ['link' => ['Password reset link' => '/password_resets/' . $user->reset_digest 
                                              . '/edit/' . StringHelper::base64_url_encode($user->email)]]
      );
      $app->redirect('/');
    }

    $user->create_reset_digest();
    $user->save();

    $user->send_reset_email();

    $app->flash('messages', ['info' => ['Email send with password reset instructions']]);
    $app->redirect('/');

  } else {
    $app->flash('messages', ['warning' => ['Account not activated! Check your email for the activation link.']]);
    $app->redirect('/');
  }

});

//password_resets#edit
$app->get("/password_resets/:reset_digest/edit/:email", SessionsHelper::not_logged_in_user($app), function($reset_digest, $email) use ($app) {
  $user = User::where('email', '=', StringHelper::base64_url_decode($email))->first();

  if ($user && $user->is_authenticated('reset', $reset_digest)) {
    SessionsHelper::is_activated($app, $user);

    $app->render('password_resets/edit.php', [
                                              'reset_digest' => $reset_digest,
                                              'email'        => $email
    ]);
  } else {
    $app->flash('messages', ['danger' => ['Invalid password reset link']]);
    $app->redirect('/');
  }
});

//password_resets#update
$app->post("/password_resets/:reset_digest", SessionsHelper::not_logged_in_user($app), function($reset_digest) use ($app, $validator) {
  $params = $app->request()->post();
  $user = User::where('email', '=', StringHelper::base64_url_decode($params['email']))->first();

  if ($user && $user->is_authenticated('reset', $reset_digest)) {
    SessionsHelper::is_activated($app, $user);

    $validation = $validator->make($params, array_merge(
                                   User::$password_rules
    ));

    //creating array of errors
    $message_password_confirmation = array();
    if ($params['password'] != $params['password_confirmation'])
      $message_password_confirmation = ['Password confirmation doesn\'t match'];
    $messages_validation = $validation->messages()->all();
    $messages_all = array_merge($message_password_confirmation, $messages_validation);

    //if there is any validation errors
    if (!empty($messages_all)) {
      $app->flash('messages', ['danger' => $messages_all]);
      $app->redirect('/password_resets/' . $reset_digest . '/edit/' . $params['email']);
    }

    $user->password_digest = $user->create_password_digest($params['password']);
    $user->save();

    SessionsHelper::log_in($user);

    $app->flash('messages', ['success' => ['Password has been reset']]);
    $app->redirect('/users/' . $user->id);
  } else {
    $app->flash('messages', ['danger' => ['Invalid password reset link']]);
    $app->redirect('/');
  }
});