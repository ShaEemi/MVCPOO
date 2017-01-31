<?php
// recuperation du parametre de l url
if (!isset($_GET['module'])) {
	$module = DEFAULT_MODULE;
} else {
	$module = $_GET['module'];
}
// appel du controller
$controller = 'app/controller/'.$module.'s.php';
if (file_exists($controller)) {
	include_once($controller);
	// instanciationn du controller
	new Controller($module);
} else {
	include_once('app/view/layout/404.php');
}
