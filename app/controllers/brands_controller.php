<?

// brands#new
$app->get("/adminpanel/brands/new", function() use ($app) {
  $app->render('brands/new.php');
});