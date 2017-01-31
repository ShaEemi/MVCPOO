<?php
/**
* 
*/
class Controller extends AppController
{
	function index(){
		if(isset($_GET['send'])){
			require ROOT . '/lib/mail.class.php';
			try{
				$mail = new Mail('sharon.colin7@gmail.com', 'sharon', 'sharon.colin@eemi.com');
				// $mail->ajouter_destinataire("sharon.colin@gmail.fr");
				$mail->ajouter_destinataire("sharon.colin@eemi.com");
				$mail->ajouter_bcc("shashou_113@hotmail.com");
				// $mail->ajouter_bcc("joel.cohen@hotmail.fr");
				// $mail->ajouter_bcc("brigitte.cohen@hotmail.fr");
				//$mail->ajouter_pj("fichiers/23451691-t-vacances-vacances-le-concept-de-gens-heureux-groupe-d-amis-ou-en-couple-s-amuser-et-montrant-thum-Banque-d'images.jpg");
				//$mail->ajouter_pj("fichiers/29409707-jouer-des-enfants-heureux-dans-le-champ-vert-pendant-la-periode-estivale.jpg");
				$mail->contenu('ceci est le contenu objet','ceci est le contenu texte','<p>ceci est le contenu html</p>');
				$mail->envoyer();
			}catch(Exception $e){
				echo $e->getMessage();
			}
		}
		
		$this->load->view('mail', 'index');
	}
}