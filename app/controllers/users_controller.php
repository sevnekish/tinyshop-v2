<?


$app->get("/users/new",  function() use ($app, $validator) {

  $app->render('users/new.php');
});

$app->post("/users", function() use ($app, $validator) {

  $params = $app->request()->post();

var_dump($params);

  $vaildation = $validator->make($params, array_merge(
                                 User::$name_rules,
                                 User::$email_rules,
                                 User::$password_rules,
                                 User::$telephone_rules,
                                 User::$address_rules
  ));
      echo '<pre>';
  print_r($vaildation->messages()->all());
      echo '</pre>';
    exit;

  // if ()

  $user = new User($params);

    echo '<pre>';
    print_r($app->request()->post());
    echo '</pre>';

    exit;
  // try {
  //   $user->registrateNewUser($params);
  // } catch (Exception $e) {
  //   $app->flash('error', $e->getMessage());
  //   $app->redirect($urlRedirect);
  // }
  // $app->flash('success', 'The user has been added successfully');
  // $app->redirect($urlRedirect);
});