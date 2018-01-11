<?php
require_once ('../MODELE/ElevesModele.class.php');

function nomEleves() {
	$ELEmod = new ElevesModele();
	return $ELEmod->getNom(); //requete via le modele
}








?>