<?
$app->get("/", function() use ($app) {

  $app->render('static_pages/home.php');
});