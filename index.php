<?php 
// chargement des fichiers de config
include_once('app/config/dev_test_prod.php');
include_once('app/config/db.php');
include_once('app/config/config.php');
// parametre des erreurs
if ( defined('DEBUG') && DEBUG ) {
	ini_set('display error', 1);
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
} else {
	ini_set('display error', 0);
	error_reporting(0);
}
// require des cores
require_once('core/core.php');
require_once('core/coreController.php');
require_once('core/coreModel.php');
require_once('core/coreView.php');
require_once('app/appController.php');
require_once('app/appModel.php');
// lancement de l application
include_once('app/application.php');
