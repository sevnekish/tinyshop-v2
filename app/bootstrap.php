<?
/**
 * bootstrap.php
 */

require '../vendor/autoload.php';

use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;

use Illuminate\Database\Capsule\Manager as Capsule;

use Symfony\Component\Yaml\Yaml;

function fromYaml($configFilePath) {
    $configArray = Yaml::parse(file_get_contents($configFilePath));
    if (!is_array($configArray)) {
        throw new Exception("File $configFilePath must be valid YAML");
    }
    return $configArray;
};

$configArray = fromYaml('../phinx.yml');


/**
 * Display errors
 */

error_reporting('E_ALL');
ini_set('display_errors', 1);

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
$capsule     = new Capsule;
$environment = $configArray['environment'];
$capsule->addConnection(array(
  'driver'    => $configArray['environments'][$environment]['adapter'],
  'host'      => $configArray['environments'][$environment]['host'],
  'database'  => $configArray['environments'][$environment]['name'],
  'username'  => $configArray['environments'][$environment]['user'],
  'password'  => $configArray['environments'][$environment]['pass'],
  'charset'   => $configArray['environments'][$environment]['charset'],
  'collation' => $configArray['environments'][$environment]['collation'],
  'prefix'    => $configArray['environments'][$environment]['prefix'],
));
$capsule->bootEloquent();
$capsule->setAsGlobal();

// $user = UsersFactory::createUser();
$user = new User;

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
