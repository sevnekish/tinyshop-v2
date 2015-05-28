<?
$app->get("/", function() use ($app) {
  // $params = [
  //            'email' => 'sevnekish@.com',
  //            'title' => 's'
  // ];
  // $validator = new Validator($app->db);

  // $validator = $validator->make($params, User::$rules);
  // echo '<pre>';
  // var_dump($validator->messages());
  // echo '</pre>';

  $app->render('static_pages/home.php');
});