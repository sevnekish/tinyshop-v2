<?

// categories#new
$app->get("/adminpanel/categories/new", function() use ($app) {
  $app->render('categories/new.php');
});

// categories#create
$app->post("/categories", function() use ($app, $validator) {

  $params = $app->request()->post();

  $validation = $validator->make($params, array_merge(
                                                      Category::$name_rules
  ));

  //creating array of errors
  $messages_all = $validation->messages()->all();

  //if there is any errors
  if (!empty($messages_all)) {
    $app->flash('messages', ['danger' => $messages_all]);
    $app->flash('prev_params', $params);
    $app->redirect('/adminpanel/categories/new');
  }

  $category = new Category($params);
  $category->save();

  $app->flash('messages', ['success' => ['New category has been added successfully.']]);

  $app->redirect('/adminpanel/categories/new');

});