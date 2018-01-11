<?php
session_start();

require_once ('../Class/autoload.php');
require_once ('../CONTROLEUR/controleur.php');

$pageNomEle = new PageBase ("nom eleve");

$listeEle= nomEleves();


foreach ($listeEle as $unELE) {

		$pageNomEle->contenu .= 'Nom:'.$unELE->NOME. ' Prénom:'.$unELE->PRENOME. '<br>' ;

	}


$pageNomEle->afficher();

?>