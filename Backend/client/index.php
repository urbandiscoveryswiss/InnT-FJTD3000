<?php
session_start();
ob_start( );
header('Content-type: text/html; charset=utf-8');
require_once("config.php");
require_once(__DIR__ . '/vendor/autoload.php');

require_once("lib/Core/App.php");

$app = new App;





ob_end_flush( )
?>