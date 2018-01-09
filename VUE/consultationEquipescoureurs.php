<?php
session_start();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');
require_once ('../CONTROLEUR/controleur.php');

$isSession = false ;

if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$isSession = true;
	$pageConsultationEquipesCoureurs = new pageSecurisee ("Consulter les équipes et leurs coureurs...");
} else {
	$pageConsultationEquipesCoureurs = new pageBase ("Consulter les équipes et leurs coureurs...");
}
$pageConsultationEquipesCoureurs->script = 'jquery-3.0.0.min';
$pageConsultationEquipesCoureurs->script = 'ajaxRecupEquipesCoureurs'; //pour gerer par l'AJAX le clic de la case � cocher et afficher les commentaires correspondants

$listeEQU = listeEquipeAssociation(); //appel de la fonction dans le CONTROLEUR : page controleur.php

$pageConsultationEquipesCoureurs->contenu = '<section>
					<div class="col-md-6">
          <table class="table table-striped">
            <thead>	<tr><th>Nom Equipe</th><th>son slogan</th><th>son Association</th></tr></thead><tbody>';
//parcours du résultat de la requete
foreach ($listeEQU as $unEQU){
					$pageConsultationEquipesCoureurs->contenu .= '<tr><td>'.$unEQU->NOMEQU.'</td><td>'.$unEQU->SLOGANEQU.'</td><td><b>'.$unEQU->NOMASS.'</b><br/>'.$unEQU->CAUSEASS.'</td>
					<td><input type="radio" onclick="jsClickRadioButton('.$isSession.');" name="idEQU"  id="'.$unEQU->IDEQU.'"  value="'.$unEQU->IDEQU.'" /></td></tr>';
}
$listeEQU->closeCursor(); //pour liberer la memoire occupee par le resultat de la requete
$listeEQU = null; //pour une autre execution avec cette variable

$pageConsultationEquipesCoureurs->contenu .= '</tbody></table></div>';

//div qui sert a afficher les coureurs d'une equipe : rempli a partir du json retourne par la requete AJAX
$pageConsultationEquipesCoureurs->contenu .= '<div id="listeCoureurs"></div></section>';

// TRAITEMENT du RETOUR DE L'ERREUR par le controleur
if (isset($_GET['error']) && !empty($_GET['error'])) {
	$err = $_GET['error'];
	$pageConsultationEquipesCoureurs->zoneErreur = '<div id="infoERREUR" class="alert alert-success fade in"><strong>INFO : </strong><a href="#" onclick="cacher();" class="close" data-dismiss="alert">&times;</a></div>';
	$verif = preg_match("/ERREUR/",$err); //verifie s'il y a le mot erreur dans le message retourné
	if ( $verif == TRUE ){
		$class ="alert alert-danger fade in";
	}
	else {
		$class ="alert alert-success fade in";
	}
	$pageConsultationEquipesCoureurs->scriptExec = "changerCouleurZoneErreur('".$class."');";	//ajout dans le tableau scriptExec du script à executer
	$pageConsultationEquipesCoureurs->scriptExec = "montrer('".$err."');"; //ajout dans le tableau scriptExec du script à executer
}


$pageConsultationEquipesCoureurs->afficher();
?>
