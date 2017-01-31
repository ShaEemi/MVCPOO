<?php 
Class Controller extends AppController {
	public function index() {
		if(isset($_POST['name'])){
			$name = $_POST['name'];
			$inserted_id = $this->model->coreInsert('series', array(
				'name' => array(':name', $name, PDO::PARAM_STR)
			));
			if($inserted_id){
				header('Location: index.php?module=serie&action=index&insert=success');
			}
		}

		// si un fichier est chargé
		// if(isset($_POST['files']['name'])){
		// 	require ROOT . '/lib/Upload.class.php';
		// 	try{
		// 		$mail = new Upload();
		// 		// ../
		// 	} catch (Exception $e){
		// 		echo $e->getMessage();
		// 	}
		// }

		if(isset($_GET['delete_id'])){
			$serie_id = $_GET['delete_id'];
			$this->model->coreDelete('series', array('id' => $serie_id));
			//$this->model->coreDelete('series', array('id' => array($serie_id, '>')));
		}

		if(isset($_GET['update_id'])){
			$serie_id = $_GET['update_id'];
			// Pour afficher le nom de la série dans le formulaire
			$nom_serie = $this->model->coreRead('series', array('colonne' => 'id', 'value' => $serie_id));
			$data['serie_name'] = $nom_serie['name'];
			if(isset($_POST['new_name'])){
				$new_name = $_POST['new_name'];
				$this->model->coreUpdate(
					'series', 
					array(
						'name' => array(':new_name', $new_name, PDO::PARAM_STR)
					),
					array('id' => $serie_id)
				);
			}
			
		}

		$data['series'] = $this->model->coreList('series', array("colonne" => "name"));
		$this->load->view('series', 'index', $data);
	}
	public function oth() {
		//$data = $this->model->coreRead('projet', array("wherecolonne" => "nom", "wherevalue" => 'one tree hill'));
		$this->load->view('series', 'oth', $data);
	}
}