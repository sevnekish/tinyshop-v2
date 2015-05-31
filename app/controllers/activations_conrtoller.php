<?
//need some midleware for protectiong access
$app->get("/account_activations/:activation_digest",  function($activation_digest) use ($app) {
  
  // $app->render('users/new.php');
});