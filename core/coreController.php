<?php
/**
* 
*/
class CoreController extends Core {
	protected $load;
	protected $model;
	function __construct($module) {
		// load va nous permettre de générer la vue à partir du contrôleur
		$this->load = new CoreView();
		// charge du model
		$pathModel = 'app/model/' . $module . '.php';
		if (is_file($pathModel)){
			require $pathModel;
			// load va nous permettre d'intéragir aec la bdd depuis le contrôleur
			$this->model = new Model();
		}
		if (isset($_GET['action'])) {
			$action = $_GET['action'];
			if ( method_exists($this, $action) ) {
				$this->$action();
			} else {
				$this->page404();
			}
		} else {
			$this->index();
		}

	}
}
