<?


// users#new
$app->get("/users/new", SessionsHelper::not_logged_in_user($app), function() use ($app) {
  $app->render('users/new.php');
});

// users#index
$app->get("/adminpanel/users", function() use ($app) {
  $app->render('users/index.php');
});


// users#create
$app->post("/users", SessionsHelper::not_logged_in_user($app), function() use ($app, $validator, $environment) {

  $params = $app->request()->post();

  $validation = $validator->make($params, array_merge(
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
  $messages_validation = $validation->messages()->all();
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
    $user->create_digest('activation');
    $user->create_digest('password', $params['password']);

    $user->save();
    $app->flash('debug_info', ['link' => ['Activation link' => '/account_activations/' . $user->activation_digest 
                                            . '/edit/' . StringHelper::base64_url_encode($user->email)]]
    );
    $app->redirect('/');

  }

  $user->create_digest('activation');
  $user->create_digest('password', $params['password']);

  $user->send_activation_email();

  $user->save();

  $app->flash('messages', ['info' => ['Please check your email to activate your account.']]);
  $app->redirect('/');
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
  // $user = new User();
  // $user->name = "John";
  // $user->email = 'test@gmail.com';
  //  $tags_mail    = [':/name', ':/link'];
  // $link = 'http://tinyshopv2/account_activations/' . $user->create_activation_digest() . '/edit/' . StringHelper::base64_url_encode($user->email);
  // $replace_mail = [$user->name, $link];
  // $mail_html = str_replace($tags_mail, $replace_mail, file_get_contents('../app/views/mailer/activation_mail.php'));
  // // $userk = User::find(2);
  // $userk = User::where('email', '=', 'entony123@gmail.com')->first();
  // echo '<pre>';
  // print_r($userk->name);
  // echo '</pre>';
  // echo '<pre>';
  // echo $mail_html;
  /////////////////////////////
  // unset($_SESSION['user_id']);
  // echo $_SESSION['user_id'];
  // exit;
  //////////////////////////////
  // $user = User::find(10);
  // SessionsHelper::log_in($user);
  // // echo '<pre>';
  // // print_r($user);
  // // echo '</pre>';
  // SessionsHelper::log_out($app, $user);
  // exit;
  // $app->setCookie('test', 'worked');
  // echo '<pre>';
  // print_r($app->request()->getPathInfo());exit;
  // $user = User::where('email', '=', 'ololo')->first();
  // var_dump($user);exit;
  //////////////////////////////////////
 

  $user = User::find(12);
  var_dump(time());
  echo '<br>';
  echo date ("Y-m-d H:i:s", time());
  echo '<br>';
  echo strtotime($user->reset_sent_at);
  echo '<br>';
  echo $user->reset_sent_at;
  exit;
  if (time_difference(time(), strtotime($user->reset_sent_at)) > 2)
    echo 'more then 2';
  

  function time_difference($time1, $time2) {
    return round(($time1 - $time2)/3600, 1);
  }
});

// users#show
$app->get("/users/:id", SessionsHelper::logged_in_user($app), function($id) use ($app) {
  SessionsHelper::correct_user($app, $id);
  $app->render('users/show.php');
});

// users#edit
$app->get("/users/:id/edit", SessionsHelper::logged_in_user($app), function($id) use ($app) {
  SessionsHelper::correct_user($app, $id);
  $app->render('users/edit.php');
});

//users#update
$app->post("/users/:id", SessionsHelper::logged_in_user($app), function($id) use ($app, $validator) {

  SessionsHelper::correct_user($app, $id);

  $params = $app->request()->post();

  $validation = $validator->make($params, array_merge(
                                 User::$name_rules,
                                 User::$password_alt_rules,
                                 User::$telephone_rules,
                                 User::$address_rules
  ));

  //creating array of errors
  $message_password_confirmation = array();
  if ($params['password'] != $params['password_confirmation'])
    $message_password_confirmation = ['Password confirmation doesn\'t match'];
  $messages_validation = $validation->messages()->all();
  $messages_all = array_merge($message_password_confirmation, $messages_validation);

  $user = SessionsHelper::current_user($app);

  //if there is any errors
  if (!empty($messages_all)) {
    $app->flash('messages', ['danger' => $messages_all]);
    $app->redirect('/users/' . $user->id . '/edit');
  }

  $user->name            = $params['name'];
  $user->telephone       = $params['telephone'];
  $user->address         = $params['address'];
  if (isset($params['password']))
    $user->create_digest('password', $params['password']);

  $user->save();

  $app->flash('messages', ['success' => ['Profile updated.']]);
  $app->redirect('/users/' . $user->id);
});
