<?php

// Memulai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Error reporting
error_reporting(E_ALL);

// Application paths and database connection
define("ROOT", dirname(__DIR__) . DIRECTORY_SEPARATOR);
$requestHost = $_SERVER['HTTP_HOST'] ?? 'localhost';
if (!preg_match('/^[A-Za-z0-9.-]+(?::[0-9]{1,5})?$/D', $requestHost)) {
	$requestHost = 'localhost';
}
$scheme = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
define("URL", rtrim(
	$scheme . $requestHost
	. rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/')), '/'),
	'/'
));
define("AST", URL . "/layouts/assets");
define("DB_HOST", "localhost");
define("DB_NAME", "db_project7");
define("DB_USER", "root");
define("DB_PASS", "");

function e($value): string
{
	return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Autoload
require_once ROOT. "vendor/autoload.php";

// Whoops
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
