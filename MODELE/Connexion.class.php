<?php
require_once('../Class/Connexion.class.php');
class ConnexionModele {
	
    public function donnenom() {

    $resultat = $mysqli->query ("SELECT nome from eleves where ide=1;");
	$ligne = $resultat->fetch_assoc();
	echo 'Le nom est ' . $ligne;

	}
	
    
}
?>