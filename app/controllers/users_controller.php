<?


$app->get("/users/new",  function() use ($app, $validator) {
  $app->render('users/new.php');
});

$app->get("/users/test",  function() use ($app, $validator, $environment) {
  // $messages_all = ['Password confirmation doesn\'t match',
  //                  'second'
  // ];
  // $app->flash('messages', ['danger' => $messages_all]);
  // $app->redirect('/users/new');
  ///////////////////////////////
  // $user = new User();
  // $password = 'hello';
  // $hash = $user->create_password_digest($password);
  // $password = 'helloa';
  // echo $hash;
  // echo '<br>';
  // if (password_verify($password, $hash)) {
  //     echo 'true';
  // } else {
  //     echo 'false';
  // }
  //////////////////////////////
  // $base64_str = 'a2VsdmluMTIzQGdtYWlsLmNvbQ%3D%3D';
  // echo StringHelper::base64_url_decode($base64_str);
  //////////////////////////////
  exit;
});

$app->post("/users", function() use ($app, $validator, $environment) {

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

  if ($environment == 'development'){
    // used on local machine when you not able to send email
    // after sign up activation link appears in debug_info block
    $activation_digest = $user->create_activation_digest();

    $user->password_digest   = $user->create_password_digest($params['password']);
    $user->activation_digest = $activation_digest;

    $app->flash('debug_info', ['link' => ['Activation link' => '/account_activations/' . $activation_digest 
                                            . '/edit/' . StringHelper::base64_url_encode($user->email)]]
    );
  } else {
    $user->send_activation_email();
  }

  $user->save();

  $app->flash('messages', ['info' => ['Please check your email to activate your account.']]);
  $app->redirect('/');
});