<?php 
/**
* 
*/
class Model extends AppModel {
	function postList($offset, $limite) {
		//return "la liste des postes";
        try {
            // on envoie la requete
            $query = $this->pdo->prepare('SELECT * FROM ' . PREFIXE.'posts ORDER BY post_date DESC LIMIT :offset, :limite');
            // on initialise les parametres
            $query->bindParam(':offset', $offset, PDO::PARAM_INT);
            $query->bindParam(':limite', $limite, PDO::PARAM_INT);
            // on execute la requete
            $query->execute();
            // on recupere tous les resultats
            $articles = $query->fetchAll();
            // on ferme le curseur
            $query->closeCursor();
            // on retourne tous les articles sélectionnes
            return $articles;
        } catch (Exception $e) {
            return false;
        }
	}
}