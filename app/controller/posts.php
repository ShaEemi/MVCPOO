<?php
class Controller extends AppController {
	function index(){
		// appel des param
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}
		$offset = ($page - 1)*PAGINATION; // nbre de page -1 et le tout multiplié par la limite
		// appel du model
		$data = $this->model->coreList("posts", array(/*"wherecolonne" => "post_category", "wherevalue" => 2,*/ 
			"colonne" => "post_date", "descAsc" => "DESC", 
			"offset" => $offset, "limit" => PAGINATION));
		if ($data) {
			define("PAGE_TITLE", "Liste articles");
			$this->load->view('layout', 'header.php', $data);
			$this->load->view('posts', 'index.php', $data);
			$this->load->view('layout', 'footer.php', $data);
		} else{
			$this->load->view('layout', '404.php');
		}
	}
	function view() {
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$data = $this->model->coreRead("posts", array("colonne" => "post_ID", "value" => $id));
			if ($data) {
				define("PAGE_TITLE", "Detail articles");
				$this->load->view('layout', 'header.php', $data);
				$this->load->view('posts', 'view.php', $data);
				$this->load->view('layout', 'footer.php', $data);
			} else{
				$this->load->view('layout', '404.php');
			}
		} else {
			die('paramètre manquant');
		}
	}
}
