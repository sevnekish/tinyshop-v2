<?
/**
 * Display errors
 */
error_reporting(E_ALL);
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


// Make a new connection
// use Illuminate\Database\Capsule\Manager as Capsule;
// $capsule = new Capsule;
// $capsule->addConnection(include '../config/database_config.ini');
// $capsule->bootEloquent();
// $capsule->setAsGlobal();

// $user = UsersFactory::createUser();

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
