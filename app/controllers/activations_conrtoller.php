<?

//account_activations#edit
$app->get("/account_activations/:activation_digest/edit/:email", function($activation_digest, $email) use ($app) {

  $user = User::where('email', '=', StringHelper::base64_url_decode($email))->first();

  if ($user && !$user->activated && $user->is_authenticated('activation', $activation_digest)) {
    $user->activate();
    SessionsHelper::log_in($user);
    $app->flash('messages', ['success' => ['Account activated!']]);
    $app->redirect('/users/' . $user->id);
  } else {
    $app->flash('messages', ['danger' => ['Invalid activation link']]);
    $app->redirect('/');
  }
});