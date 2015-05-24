<?
$app->get("/", function() use ($app) {

  // $items = $user->getItemsRandom(6);

  $app->render('static_pages/home.php');
});