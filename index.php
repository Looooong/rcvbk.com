<?php
	define('CORE_PATH', 'core/');
	define('CONTROLLER_PATH', 'controller/');
	define('TEMPLATE_PATH', 'template/');
	define('TITLE', 'Rung Chuông Vàng');
	define('ICON_PATH', '/resource/favicon.ico');
	define('MAIN_URL', 'http://'.$_SERVER['SERVER_NAME'].'/');
	define('NOSCRIPT_URL', 'http://'.$_SERVER['SERVER_NAME'].'/noscript/');
	define('RESOURCE_URL', 'http://'.$_SERVER['SERVER_NAME'].'/resource/');
	
	require_once(CORE_PATH.'loader.php');
	session_start();
	
	$router = Router::getInstance();
?>