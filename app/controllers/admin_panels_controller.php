<?

$app->get("/adminpanel", function() use ($app) {
  $app->render('admin_panel/index.php');
});

