<?
/**
 * Define constants
 */
define("VENDORDIR",   "../vendor/");
define("TEMPLATEDIR", "../app/views/");
define("ROUTES",    "../app/routes.php");
define("BOOTSTRAP", "../app/bootstrap.php");
define("HELPERS", "../app/helpers.php");
/**
 * Include bootstrap file
 */
require_once BOOTSTRAP;
/**
 * Include custom helpers
 */
require_once HELPERS;


/**
 * Add data to view
 */
// $app->hook('slim.before.dispatch', function() use ($app, $user, $cart, $image_dir) {
//   $userparams = $user->getParams();
//   $categories = $user->getCategories();
//   $cart_count = $cart->getCount();

//   $flash = $app->view()->getData('flash');
//   $error = isset($flash['error']) ? $flash['error'] : '';
//   $success = isset($flash['success']) ? $flash['success'] : '';

//   $app->view()->setData(array(
//                   'userparams' => $userparams,
//                   'cart_count' => $cart_count,
//                   'error'      => $error,
//                   'success'    => $success,
//                   'categories' => $categories
//                 ));
// });

/**
 * Include all routes
 */
require_once ROUTES;
/**
 * Run the application
 */
$app->run();