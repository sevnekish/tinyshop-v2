<?

// items#new
$app->get("/adminpanel/items/new", function() use ($app) {
  $app->render('items/new.php');
});

// items#create
$app->post("/users", function() use ($app, $validator) {

  // $params = $app->request()->post();

  // $validation = $validator->make($params, array_merge(
  //                                User::$name_rules,
  //                                User::$email_rules,
  //                                User::$password_rules,
  //                                User::$telephone_rules,
  //                                User::$address_rules
  // ));

  // //creating array of errors
  // $message_password_confirmation = array();
  // if ($params['password'] != $params['password_confirmation'])
  //   $message_password_confirmation = ['Password confirmation doesn\'t match'];
  // $messages_validation = $validation->messages()->all();
  // $messages_all = array_merge($message_password_confirmation, $messages_validation);

  // //if there is any errors
  // if (!empty($messages_all)) {
  //   $app->flash('messages', ['danger' => $messages_all]);
  //   $app->flash('prev_params', $params);
  //   $app->redirect('/users/new');
  // }

  // $user = new User($params);

  // if ($environment == 'development'){
  //   // used on local machine when you not able to send email
  //   // after sign up activation link appears in debug_info block
  //   $user->create_digest('activation');
  //   $user->create_digest('password', $params['password']);

  //   $user->save();
  //   $app->flash('debug_info', ['link' => ['Activation link' => '/account_activations/' . $user->activation_digest 
  //                                           . '/edit/' . StringHelper::base64_url_encode($user->email)]]
  //   );
  //   $app->redirect('/');

  // }

  // $user->create_digest('activation');
  // $user->create_digest('password', $params['password']);

  // $user->send_activation_email();

  // $user->save();

  // $app->flash('messages', ['info' => ['Please check your email to activate your account.']]);
  // $app->redirect('/');
});