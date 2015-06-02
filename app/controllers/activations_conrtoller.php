<?
//need some midleware for protectiong access
$app->get("/account_activations/:activation_digest/edit/:email",  function($activation_digest, $email) use ($app) {
  echo $activation_digest;
  echo '<br>';
  echo StringHelper::base64_url_decode($email);

  exit;
  // $app->render('users/new.php');
});