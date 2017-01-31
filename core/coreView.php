<?php
/**
* 
*/
class CoreView extends Core {
	function view($module, $view, $data = null) {
		$pathView = 'app/view/'.$module.'/'.$view.'.php';
		if(is_file($pathView)){
			include $pathView;
		} else{
			echo 'Il faut créer le fichier: <b>' . $pathView . '</b>';
		}
	}
}