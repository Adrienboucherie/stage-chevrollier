<?php
class MyPDO extends PDO {
	
	public function __construct($dsn, $user = NULL, $password = NULL) {
		parent::__construct ( $dsn, $user, $password );
		// dire comment on veut traiter les erreurs ici gestion avec les exceptions try catch
		$this->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	
	// méthode exec pour les requetes de type INSERT, UPDATE et DELETE
	public function exec($sql) {
		return (parent::exec($sql));
	}
	
	// méthode query pour les requetes de type SELECT
	public function query($sql) {
		$result = parent::query($sql);
		$result->setFetchMode(PDO::FETCH_OBJ); // resultat de la requete retournee sous la forme d'objets
		return $result;
	}
	
}
?>	
