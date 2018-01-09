<?php
session_start ();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');


if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageAjoutAssociation = new pageSecurisee ( "Ajouter une association..." );
} else {
	$pageAjoutAssociation = new pageBase ( "Ajouter une association..." );
}

$pageAjoutAssociation->contenu = '<section>
		<article>
		<form class="form-inline" id="formNouvelleAssociation" method="post" action="../CONTROLEUR/tt_AjoutAssociation.php" enctype="multipart/form-data">
			<div class="form-group">
			<label for="nomASS">nom de l\'association </label>
			<input type="text" class="form-control" name="nomASS"  id="nomASS"  required />
			</div>
			<div class="form-group">
			<label for="causeASS">Cause de l\'association </label>
			<input type="text" class="form-control" name="causeASS"  id="causeASS"  required/>
			</div>
			<div class="form-group">
			<label for="logoASS">Logo de l\'association </label>
			<input type="file" name="logoASS" />
			</div>
						<div class="form-group">
			<input type="submit" class="btn btn-default" name="btnValiderASS" id="btnValiderASS" value="Valider"/></div>
			</form>
		</article> </section>';


// TRAITEMENT du RETOUR DE L'ERREUR par le controleur
if (isset($_GET['error']) && !empty($_GET['error'])) {

	$pageAjoutAssociation->contenu .= '<a href="inscriptionEquipeCoureurs.php" class="btn btn-success" role="button">retour à l\'inscription </a>';

	$err = $_GET['error'];
	$pageAjoutAssociation->zoneErreur = '<div id="infoERREUR" class="alert alert-success fade in"><strong>INFO : </strong><a href="#" onclick="cacher();" class="close" data-dismiss="alert">&times;</a></div>';
	$verif = preg_match("/ERREUR/",$err); //verifie s'il y a le mot erreur dans le message retourné
	if ( $verif == TRUE ){
		$class ="alert alert-danger fade in";
	}
	else {
		$class ="alert alert-success fade in";
	}
	$pageAjoutAssociation->scriptExec = "changerCouleurZoneErreur('".$class."');";	//ajout dans le tableau scriptExec du script à executer
	$pageAjoutAssociation->scriptExec = "montrer('".$err."');"; //ajout dans le tableau scriptExec du script à executer
}
$pageAjoutAssociation->afficher ();
?>
