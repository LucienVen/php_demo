<?php


define("FILE_PATH", __DIR__ . "/File");
define("CORE_PATH", __DIR__ . DIRECTORY_SEPARATOR . "Core");
define("BASE_PATH", __DIR__ . "/App");

// print_r(CORE_PATH . '/Loader.php');exit;


require 'vendor/autoload.php';
require CORE_PATH . "/Autoload.php";


spl_autoload_register("Autoload::load");


$test = new App\Test();
$test->run();