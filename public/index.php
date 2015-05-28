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
 * Include all routes
 */
require_once ROUTES;
/**
 * Run the application
 */
$app->run();