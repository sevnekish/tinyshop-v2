<?

$app->get("/adminpanel", function() use ($app) {
  $app->render('admin_panel/index.php');
});

$app->get("/adminpanel/users", function() use ($app) {
  $app->render('users/index.php');
});


$app->get("/adminpanel/items/new", function() use ($app) {
  $app->render('items/new.php');
});