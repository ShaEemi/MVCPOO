<?php
/**
* 
*/
class AppController extends CoreController {
	function page404() {
		echo "DEBUG = " . DEBUG . "<br>";
		echo "RUN = " . RUN . "<br>";
		echo "GA = " . GA . "<br>";
		echo "erreur 404";
	}
}