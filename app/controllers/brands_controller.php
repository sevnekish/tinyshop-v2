<?

// brands#new
$app->get("/adminpanel/brands/new", function() use ($app) {
  $app->render('brands/new.php');
});

// brands#create
$app->post("/brands", function() use ($app, $validator) {

  $params = $app->request()->post();

  $validation = $validator->make($params, array_merge(
                                                      Brand::$name_rules
  ));

  //creating array of errors
  $messages_all = $validation->messages()->all();

  //if there is any errors
  if (!empty($messages_all)) {
    $app->flash('messages', ['danger' => $messages_all]);
    $app->flash('prev_params', $params);
    $app->redirect('/adminpanel/brands/new');
  }

  $category = new Brand($params);
  $category->save();

  $app->flash('messages', ['success' => ['New brand has been added successfully.']]);

  $app->redirect('/adminpanel/brands/new');

});