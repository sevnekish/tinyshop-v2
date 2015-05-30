<?
/**
 * Define constants
 */
define("VENDORDIR",   "../vendor/");
define("TEMPLATEDIR", "../app/views/");
define("ROUTES",      "../app/routes.php");
define("BOOTSTRAP",   "../app/bootstrap.php");
/**
 * Include bootstrap file
 */
require_once BOOTSTRAP;
/**
 * Include all routes
 */
require_once ROUTES;
/**
 * Run the application
 */
$app->run();