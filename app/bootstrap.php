<?
/**
 * Display errors
 */

error_reporting('E_ALL');
ini_set('display_errors', 1);

/**
 * Composer autoload
 */
require '../vendor/autoload.php';

use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;

use Illuminate\Database\Capsule\Manager as Manager;

use Symfony\Component\Yaml\Yaml;
function fromYaml($configFilePath) {
    $configArray = Yaml::parse(file_get_contents($configFilePath));
    if (!is_array($configArray)) {
        throw new Exception("File $configFilePath must be valid YAML");
    }
    return $configArray;
};

$configArray = fromYaml('../phinx.yml');




\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
                            'templates.path' => '../app/views',
                            "view"           => new \Slim\Views\Twig(),
                            'debug'          => true
));

// $app->add(new \Slim\Middleware\SessionCookie()); not work well, beacause we use $_SESSION => session_start();
// session_start();
// Try one more time
$app->add(new \Slim\Middleware\SessionCookie(array('secret' => 'aetnrjtk23A/zvcv{]daff34G')));


$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

// Make a new connection
$capsule     = new Manager;
$environment = $configArray['environment'];
$capsule->addConnection(array(
  'driver'    => $configArray['environments'][$environment]['adapter'],
  'host'      => $configArray['environments'][$environment]['host'],
  'database'  => $configArray['environments'][$environment]['name'],
  'username'  => $configArray['environments'][$environment]['user'],
  'password'  => $configArray['environments'][$environment]['pass'],
  'charset'   => $configArray['environments'][$environment]['charset'],
  'collation' => $configArray['environments'][$environment]['collation'],
  'prefix'    => $configArray['illuminate_config']['prefix'],
));
$capsule->bootEloquent();
$app->db = $capsule;
// $capsule->setAsGlobal();

// $user = UsersFactory::createUser();
$user = new User;

$cart;


// $cart = new ShoppingCart();

// $app->notFound(function () use ($app) {
//   $app->render('404.php');
// });


/**
 * Add some twig extensions
 */
$app->view->parserExtensions = [
    new \Slim\Views\TwigExtension()
];

/**
 * Add some data to view
 */
$app->hook('slim.before.dispatch', function() use ($app, $user, $cart) {
  // $userparams = $user->getParams();
  // $categories = $user->getCategories();
  // $cart_count = $cart->getCount();

  // $flash = $app->view()->getData('flash');
  // $error = isset($flash['error']) ? $flash['error'] : '';
  // $success = isset($flash['success']) ? $flash['success'] : '';

  // $app->view()->setData(array(
  //                 'userparams' => $userparams,
  //                 'cart_count' => $cart_count,
  //                 'error'      => $error,
  //                 'success'    => $success,
  //                 'categories' => $categories
  //               ));
});

