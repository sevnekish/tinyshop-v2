<?
/**
 * Define constants
 */
define("VENDORDIR", "../vendor/");
define("TEMPLATEDIR", "../app/views/");

define("ROUTES", "../app/routes.php");
define("BOOTSTRAP", "../app/bootstrap.php")


require '../vendor/autoload.php';

/**
 * Include bootstrap file
 */
require_once BOOTSTRAP;

/**
 * Custom helpers
 */
$authentication = function($app, $user, $authentication_role) {
  return function() use ($app, $user, $authentication_role) {
    $user_role = $user->getRole();
    if ($authentication_role != $user_role) {
      switch($user_role){
        case 'admin': $app->redirect("/adminbar"); break;
        case 'user': $app->redirect("/account"); break;
        case 'guest': 
          $app->flash('error', 'Login required');
          $app->setCookie('urlRedirect', $app->request()->getPathInfo(), '4 minutes');
          $app->redirect("/login");
          break;
        }
    }
  };
};

$access_denied = function($app, $user, $denied_user_role) {
  return function() use ($app, $user, $denied_user_role) {
    $user_role = $user->getRole();
    if ($denied_user_role == $user_role) {
      switch($denied_user_role){
        case 'admin': $app->redirect("/adminbar"); break;
        case 'user': $app->redirect("/account"); break;
        case 'guest': 
          $app->flash('error', 'Login required');
          $app->setCookie('urlRedirect', $app->request()->getPathInfo(), '4 minutes');
          $app->redirect("/login");
          break;
        }
    }
  };
};

/**
 * Add data to view
 */
$app->hook('slim.before.dispatch', function() use ($app, $user, $cart, $image_dir) {
  $userparams = $user->getParams();
  $categories = $user->getCategories();
  $cart_count = $cart->getCount();

  $flash = $app->view()->getData('flash');
  $error = isset($flash['error']) ? $flash['error'] : '';
  $success = isset($flash['success']) ? $flash['success'] : '';

  $app->view()->setData(array(
                  'userparams' => $userparams,
                  'cart_count' => $cart_count,
                  'error'      => $error,
                  'success'    => $success,
                  'categories' => $categories
                ));
});


/**
 * Include all routes
 */
require_once ROUTES;

/**
 * Run the application
 */
$app->run();