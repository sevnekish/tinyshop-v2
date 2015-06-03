<?
/**
 * Display errors
 */
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;

error_reporting('E_ALL');
ini_set('display_errors', 1);
error_reporting(-1);

/**
 * Composer autoload
 */
require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


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
                            'templates.path'     => TEMPLATEDIR,
                            "view"               => new \Slim\Views\Twig(),
                            'debug'              => true,
                            'cookies.encrypt'    => true,
                            'cookies.secret_key' => 'aetnrid243A/zvcv{]daff34G'
));

$app->add(new \Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware);

// $app->add(new \Slim\Middleware\SessionCookie()); not work well, beacause we use $_SESSION => session_start();
session_cache_limiter(false);
session_start();
$app->add(new \Slim\Middleware\SessionCookie(array(
    'expires'     => '20 minutes',
    'path'        => '/',
    'domain'      => null,
    'secure'      => false,
    'httponly'    => false,
    'name'        => 'slim_session',
    'secret'      => 'aff32HJJ/[}d234d',
    'cipher'      => MCRYPT_RIJNDAEL_256,
    'cipher_mode' => MCRYPT_MODE_CBC
)));

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
// $user = new User;
$validator = new Validator($app->db);
$cart;


// $cart = new ShoppingCart();

// $app->notFound(function () use ($app) {
//   $app->render('404.php');
// });


/**
 * Add some twig extensions
 */
$app->view->parserExtensions = [
    new \Slim\Views\TwigExtension(),
    new Twig_Extension_Debug()
];

/**
 * Add some data to view
 */
$app->hook('slim.before.dispatch', function() use ($app) {
  // $userparams = $user->getParams();
  // $categories = $user->getCategories();
  // $cart_count = $cart->getCount();

  // $flash = $app->view()->getData('flash');
  // $error = isset($flash['error']) ? $flash['error'] : '';
  // $success = isset($flash['success']) ? $flash['success'] : '';
  // $flash = $app->view()->getData('flash');

  // echo '<pre>';
  // print_r($flash);
  // echo '</pre>';
  // exit;
  // $app->view()->setData(array(
  //                 'userparams' => $userparams,
  //                 'cart_count' => $cart_count,
  //                 'error'      => $error,
  //                 'success'    => $success,
  //                 'categories' => $categories
  //               ));
  $user = SessionsHelper::current_user($app);
  $app->view()->setData(array(
                              'user' => $user
  ));
});

