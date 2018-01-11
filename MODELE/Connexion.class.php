<?php
require_once '../Class/Connexion.class.php';

class ConnexionModele {

	private $idCo = null;

	public function __construct() {
		// creation de la connexion afin d'executer les requetes
		try {
			$ConnexionCOU = new Connexion();
			$this->idCo = $ConnexionCOU->IDconnexion;
		} catch ( PDOException $e ) {
			echo "<h1>probleme access BDD</h1>";
		}
	}

	public function getnom($nom) {

		if ($this->idCo) {
			$req ="SELECT MAIL from enseignant where MAIL='". $nom ."';" ;
			$resultEQU = $this->idCo->query($req);
			return $resultEQU->fetch()->nomequ;
		}
	}
    public function getmdp($nom, $mdp) {

	    if ($this->idCo) {
	      $req ="SELECT PASSWORD from enseignant where MAIL='". $nom ."' and PASSWORD ='". $mdp ."';" ;
	      $resultEQU = $this->idCo->query($req);
	      return $resultEQU->fetch()->mdp;
	    }
	}

    public function connect($nom, $mdp){

	    if ($this->idCo) {
		    $req ="SELECT * FROM enseignant where MAiL='". $nom ."' and PASSWORD ='". $mdp ."';" ;
		    $resultEQU = $this->idCo->query($req);
			return $resultEQU->fetch();
	    }
    }
}
