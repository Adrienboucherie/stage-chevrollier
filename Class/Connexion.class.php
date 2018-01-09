<?php
require_once 'MyPDO.class.php';

class Connexion {
	private $PARAM_hote = 'localhost'; // le chemin vers le serveur local (pour les tests) ou serveur de production (sur la ferme)
	private $PARAM_utilisateur = 'root'; // nom d'utilisateur pour se connecter
	private $PARAM_mot_passe = ''; // mot de passe de l'utilisateur pour se connecter
	private $PARAM_nom_bd = 'ppe3'; // nom de ma base de donnees
	
	private $IDconnexion;
	
	public function __construct() {
		try {
			
			$this->IDconnexion = new MyPDO ( 'mysql:host=' . $this->PARAM_hote . ';dbname=' . $this->PARAM_nom_bd, $this->PARAM_utilisateur, $this->PARAM_mot_passe );
			// Il faut ajouter pour gerer les accents et caracteres non utf8
			$this->IDconnexion->exec ( 'SET NAMES utf8');
			
			//echo '<script>alert ("ok connex");</script>';
		} catch ( PDOException $e ) {
			echo 'hote: ' . $this->PARAM_hote . ' ' . $_SERVER ['DOCUMENT_ROOT'] . '<br />';
			echo 'Erreur : ' . $e->getMessage () . '<br />';
			echo 'Num : ' . $e->getCode ();
			$this->IDconnexion = false;
			echo '<script>alert ("ERREUR lien BDD");</script>';
		}
	}
	public function __get($propriete) {
		switch ($propriete) {
			case 'IDconnexion' :
				{
					return $this->IDconnexion;
					break;
				}
		}
	}
}
?>
