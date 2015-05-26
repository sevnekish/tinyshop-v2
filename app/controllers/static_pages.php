<?
$app->get("/", function() use ($app, $user) {
  $params = ['title' => 'not',
             'content' => '2'
  ];

  $app->render('static_pages/home.php');
});