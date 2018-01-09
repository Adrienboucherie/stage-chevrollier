<?php
session_start ();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');
require_once ('../CONTROLEUR/controleur.php');


if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageInscriptionCoureurs = new pageSecurisee ( "Ajouter son équipe avec ses coureurs..." );
} else {
	$pageInscriptionCoureurs = new pageBase ( "Ajouter son équipe avec ses coureurs..." );
}
$pageInscriptionCoureurs->script = 'jquery-3.0.0.min';
$pageInscriptionCoureurs->script = 'ajaxRecupEquipesCoureurs'; //pour gerer par l'AJAX le clic de la case à cocher et afficher les commentaires correspondants
		
$pageInscriptionCoureurs->contenu .= '<section>
<article>
<form class="form" id="formInscriptionCoureurs" method="GET" action="../VUE/inscriptionEquipeCoureurs.php">
<div class="form-group">
<h4>Choisir votre Equipe </h4>';
//sur le formulaire, on appelle la vue InscriptionEquipeCoureurs qui gère déjà les inscriptions des coureurs 
//mais on lui passe en GET l'équipe sélectionnée ci-dessous via les radiobuttons

$listeEqu = listeEquipeAssociation(); //appel d'une fonction du controleur

foreach ($listeEqu as $uneEqu){
		$pageInscriptionCoureurs->contenu .= '<label class="radio"><input type="radio" onclick="jsClickRadioButton();" id='.$uneEqu->IDEQU.' value='.$uneEqu->IDEQU.' name="idE" required>'.$uneEqu->NOMEQU.'</label>';
}
			
$pageInscriptionCoureurs->contenu .='	<div class="form-group">
			<input type="submit" class="btn btn-default"  name="btnAjoutCoureur" value="Ajouter un Coureur"/></div>
			</form>
		</article> </section>';
				
$listeEqu->closeCursor (); // pour libérer la mémoire occupée par le résultat de la requéte
$listeEqu = null; // pour une autre exécution avec cette variable


//div qui sert a afficher les coureurs d'une equipe : rempli a partir du json retourne par la requete AJAX
$pageInscriptionCoureurs->contenu .= '<div id="listeCoureurs"></div></section>';
				
// TRAITEMENT du RETOUR DE L'ERREUR par le controleur
if (isset($_GET['error']) && !empty($_GET['error'])) {
	$err = $_GET['error'];
	$pageInscriptionCoureurs->zoneErreur = '<div id="infoERREUR" class="alert alert-success fade in"><strong>INFO : </strong><a href="#" onclick="cacher();" class="close" data-dismiss="alert">&times;</a></div>';
	$verif = preg_match("/ERREUR/",$err); //verifie s'il y a le mot erreur dans le message retourné
	if ( $verif == TRUE ){
		$class ="alert alert-danger fade in";
	}
	else {
		$class ="alert alert-success fade in";
	}
	$pageInscriptionCoureurs->scriptExec = "changerCouleurZoneErreur('".$class."');";	//ajout dans le tableau scriptExec du script à executer	
	$pageInscriptionCoureurs->scriptExec = "montrer('".$err."');"; //ajout dans le tableau scriptExec du script à executer
}

$pageInscriptionCoureurs->afficher();
 ?>




