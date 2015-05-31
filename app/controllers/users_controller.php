<?


$app->get("/users/new",  function() use ($app, $validator) {
  $app->render('users/new.php');
});

$app->get("/users/test",  function() use ($app, $validator) {
  $messages_all = ['Password confirmation doesn\'t match',
                   'second'
  ];
  $app->flash('messages', ['danger' => $messages_all]);
  $app->redirect('/users/new');
});

$app->post("/users", function() use ($app, $validator) {

  $params = $app->request()->post();

  $vaildation = $validator->make($params, array_merge(
                                 User::$name_rules,
                                 User::$email_rules,
                                 User::$password_rules,
                                 User::$telephone_rules,
                                 User::$address_rules
  ));

  //creating array of errors
  $message_password_confirmation = array();
  if ($params['password'] != $params['password_confirmation'])
    $message_password_confirmation = ['Password confirmation doesn\'t match'];
  $messages_validation = $vaildation->messages()->all();
  $messages_all = array_merge($message_password_confirmation, $messages_validation);

  //if there is any errors
  if (!empty($messages_all)) {
    $app->flash('messages', ['danger' => $messages_all]);
    $app->flash('prev_params', $params);
    $app->redirect('/users/new');
  }

  $user = new User($params);
  $user->save();
  //there'll be sending email function
  // $user->send_activation_email();

  $app->flash('messages', ['info' => ['Please check your email to activate your account.']]);
  $app->redirect('/');
});