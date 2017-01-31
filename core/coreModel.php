<?php
/**
* 
*/
class CoreModel extends Core {
	protected $pdo;
	function __construct() {
        try {
            $dns = 'mysql:host=' . DB_host . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
            $options = array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
            $this->pdo = new PDO($dns, DB_USER, DB_PASSWORD, $options);
        } catch (Exception $e) {
            $this->coreDbError($e);
        }
    }
    protected function coreDbError($e) {
        if (defined('DEBUG') && DEBUG) {
            $message = SITE_NAME . "dit : Erreur mysql " . $e->getMessage();
        } else {
            $message = SITE_NAME . "dit : Désolé erreur technique du serveur " . $e->getMessage();
        }
        echo $message;
        exit;
    }
    public function coreRead($table, $options = array()) {
        try {
             // on envoie la requete
            $query = $this->pdo->prepare('SELECT * FROM ' . PREFIXE . $table .' WHERE ' . $options['colonne'] . ' = :value');
            // on initialise les parametres
            $query->bindParam(':value', $options['value'], PDO::PARAM_INT);
            // on execute la requete
            $query->execute();
            // on recupere le resultat : fetch on renvoie une ligne fetchAll on renvoie toute les lignes 
            $resultat = $query->fetch();
            // on ferme le curseur
            $query->closeCursor();
            // on retourne le resultat
            return $resultat;
        } catch (Exception $e) {
            return false;
        }
    }

    public function coreList($table, $options = array()) { 
        try {
            // on envoie la requete
            $sql = 'SELECT * FROM ' . PREFIXE . $table;
            if ((isset($options['wherecolonne'])) && (isset($options['wherevalue']))) {
                $sql .= ' WHERE ' . $options['wherecolonne'] . ' = :wherevalue';
            }
            if (isset($options['colonne'])) {
                $sql .= ' ORDER BY ' . $options['colonne'];
            }
            if (isset($options['descAsc'])) {
                $sql .= ' ' . $options['descAsc'];
            }
            if (isset($options['limit'])) {
                $sql .= ' LIMIT ';
                if (isset($options['offset'])) {
                    $sql .= ' :offset,';
                }
                $sql .= ' :limite';
            }
            $query = $this->pdo->prepare($sql);
            // on initialise les parametres
            if ((isset($options['wherecolonne'])) && (isset($options['wherevalue']))) {
                $sql .= 'WHERE' . $options['wherecolonne'] . '=:wherevalue';
                $query->bindParam(':wherevalue', $options['wherevalue'], PDO::PARAM_INT);
            }
            if (isset($options['limit'])) {
                if (isset($options['offset'])) {
                    $query->bindParam(':offset', $options['offset'], PDO::PARAM_INT);
                }
                $query->bindParam(':limite', $options['limit'], PDO::PARAM_INT);
            }
            // on execute la requete
            $query->execute();
            // on recupere tous les resultats
            $resultats = $query->fetchAll();
            // on ferme le curseur
            $query->closeCursor();
            // on retourne tous les resultats
            return $resultats;
        } catch (Exception $e) {
            die($e->getMessage());
            return false;
        }
    }

    public function coreInsert($table, $column_values){
        try {
            $query = "INSERT INTO ";
            $query .= $table . " (";
            $i = 0;
            foreach($column_values as $column => $value){
                $i++;
                $query .= $i === 1 ? $column : ', ' . $column;
            }
            $query .= ") VALUES (";

            $j = 0;
            foreach($column_values as $column => $value){
                $j++;
                if(is_array($value)){
                    $query .= $j === 1 ? $value[0] : ', ' . $value[0];
                } else {
                    $query .= $j === 1 ? $value : ', ' . $value;
                }
            }
            $query .= ")";


            $insert = $this->pdo->prepare($query);
            foreach($column_values as $namedParam => $value){
                if(is_array($value)){
                    // Si un typage est définie, on l'utilise, sinon on ne type pas
                    isset($value[2]) ? $insert->bindValue($value[0], $value[1], $value[2]) : $insert->bindValue($value[0], $value[1]);
                }
            }
            $insert->execute();
            $return = $this->pdo->lastInsertId();

            return $return;
        } catch (Exception $e) {
            die($e->getMessage());
            return false;
        }
    }

    public function coreUpdate($table, $column_values, $where_clauses){
        try{
            $query = "UPDATE ";
            $query .= $table . " SET ";

            $i=0;
            foreach($column_values as $colums => $new_value){
                $i++;
                if(is_array($new_value)){
                    $query .= $i === 1 ? $colums . ' = ' . $new_value[0] : ', ' . $colums . ' = ' . $new_value[0];
                } else {
                    $query .= $i === 1 ? $colums . ' = ' . $new_value : ', ' . $colums . ' = ' . $new_value;
                }
            }
            $query .= " WHERE TRUE ";

            foreach($where_clauses as $colums => $value){
                $query .= ' AND ' . $colums . ' = ' . $value;
            }

            $update = $this->pdo->prepare($query);
            foreach($column_values as $namedParam => $value){
                if(is_array($value)){
                    // Si un typage est définie, on l'utilise, sinon on ne type pas
                    isset($value[2]) ? $update->bindValue($value[0], $value[1], $value[2]) : $update->bindValue($value[0], $value[1]);
                }
            }
            $return = $update->execute();

            return $return;
    
        } catch(Exception $e){
            die($e->getMessage());
            return false;
        }
    }

    public function coreDelete($table, $where_clauses)
    {
        try{
            $query = "DELETE FROM " . $table;
            $query .= " WHERE TRUE ";

            foreach($where_clauses as $colums => $value){
                    $operator = is_array($value) ? $value[1] : '=';
                    $query .= ' AND ' . $colums . ' ' . $operator . ' ' . $value[0];
            }
            $delete = $this->pdo->exec($query);
            return $delete;
        } catch (Exception $e){
            die($e->getMessage());
            return false;
        }
        

        
    }
}
