<?
$app->get("/login", function() use ($app) {
  $app->render('sessions/new.php');
});

$app->post("/login", function() use ($app, $validator) {
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

$app->get("/logout", function() use ($app) {
  if (SessionsHelper::logged_in($app)) SessionsHelper::log_out($app);
  $app->redirect('/');
});