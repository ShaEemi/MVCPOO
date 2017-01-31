<?php
/**
* 
*/
class Controller extends AppController
{
	
	function index(){
		$data = $this->model->coreList("users", array());
		if ($data) {
			define("PAGE_TITLE", "Liste utilisateurs");
			// $this->load->view('layout', 'header.php', $data);
			// $this->load->view('posts', 'index.php', $data);
			// $this->load->view('layout', 'footer.php', $data);
			var_dump($data);
		} else{
			$this->load->view('layout', '404.php');
		}
	}
}