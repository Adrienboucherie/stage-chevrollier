<?php
require_once('../Class/Connexion.class.php');
class ElevesModele {
	private $idcELE = null;

	public function __construct() {
		
		try {
			$ConnexionELE = new Connexion();
			$this->idcELE = $ConnexionELE->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}
	public function getNom() {
		if ($this->idcELE) {
			$req ="SELECT * from eleves;" ;
			$resultELE = $this->idcELE->query($req);
			
			return $resultELE;
		}
	}
    
}
?>