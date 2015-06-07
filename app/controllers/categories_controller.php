<?

// categories#new
$app->get("/adminpanel/categories/new", function() use ($app) {
  $app->render('categories/new.php');
});