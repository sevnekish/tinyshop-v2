<?
//password_resets#new
$app->get("/password_resets/new", SessionsHelper::not_logged_in_user($app), function() use ($app) {
  $app->render('password_resets/new.php');
});

//password_resets#create
$app->post("/password_resets", SessionsHelper::not_logged_in_user($app), function() use ($app, $validator, $environment) {
  $email = $app->request()->post('email');

  $validation = $validator->make($params, array_merge(
                                 User::$email_alt_rules
  ));

  //creating array of validation errors
  $messages_all = $validation->messages()->all();

  //if there is any validation errors
  if (!empty($messages_all)) {
    $app->flash('messages', ['danger' => $messages_all]);
    $app->redirect('/login');
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
  $app->render('password_resets/edit.php', [
                                            'reset_digest' => $reset_digest,
                                            'email'        => $email
  ]);
});

//password_resets#update
$app->post("/password_resets/:reset_digest", SessionsHelper::not_logged_in_user($app), function($reset_digest) use ($app, $validator) {
  $params = $app->request()->post();

  $validation = $validator->make($params, array_merge(
                                 User::$email_alt_rules,
                                 User::$password_rules
  ));

  //creating array of validation errors
  $messages_all = $validation->messages()->all();

  //if there is any validation errors
  if (!empty($messages_all)) {
    $app->flash('messages', ['danger' => $messages_all]);
    $app->redirect('/login');
  }

  $user = User::where('email', '=', $params['email'])->first();

  if ($user && $user->password_verify($params['password'])) {
    if ($user->activated) {
      SessionsHelper::log_in($user);
      isset($params['remember_me']) ? SessionsHelper::remember($app, $user) : SessionsHelper::forget($app, $user);
      SessionsHelper::redirect_back_or($app, '/');
    } else {
      $app->flash('messages', ['warning' => ['Account not activated! Check your email for the activation link.']]);
      $app->redirect('/');
    }
  } else {
    $app->flash('messages', ['danger' => ['Invalid email/password combination']]);
    $app->redirect('/login');
  }
});