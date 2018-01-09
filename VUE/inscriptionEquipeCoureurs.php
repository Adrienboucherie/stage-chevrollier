<?php
session_start ();

require_once ('../Class/PageBase.class.php');
require_once ('../CONTROLEUR/controleur.php');

if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageInscriptionEquipeCoureurs = new pageSecurisee ( "Ajouter son équipe avec ses coureurs..." );
} else {
	$pageInscriptionEquipeCoureurs = new pageBase ( "Ajouter son équipe avec ses coureurs..." );
}
$pageInscriptionEquipeCoureurs->script = 'utile';
/*gestion du cookie pour éviter de retaper le nom et slogan de l'équipe lors de l'ajout de l'association
 * petit algo pour vérifier s'il est créé ou NON
 * et affectation des 2 variables qui renseignent les champs TEXTE
 */
		$nomE = "";
		$sloganE = "";	
		if (isset ( $_COOKIE ['nomE'] ) && isset ( $_COOKIE ['sloganE'] )) {
			echo $_COOKIE['nomE'];
			$nomE = $_COOKIE['nomE'];
			$sloganE = $_COOKIE['sloganE'];
		}
/*fin de gestion du cookie*/

$pageInscriptionEquipeCoureurs->contenu = '<section>
		<article>
			<form  class="form" id="formInscriptionEquipe" method="POST" action="../CONTROLEUR/tt_AjoutEquipe.php">
  				<div class="form-group">
    				<label for="nomEQU">nom de l\'équipe </label>
    				<input type="text" class="form-control" name="nomEQU"  id="nomEQU" value="'.$nomE.'" placeholder ="Choisir un nom pour votre équipe" required="required"/></div>
  				<div class="form-group">
    			<label for="sloganEQU">slogan de l\'équipe</label>
    				<input type="text" class="form-control" name="sloganEQU"  id="sloganEQU" value="'.$sloganE.'" placeholder ="Choisir un slogan pour votre équipe" required="required"/>
  				</div>
				<div class="form-group">
    			<label>Quelle association soutenez-vous ?</label>
					<select name="radioASS">';

$listeAss = listeAssociationS(); //appel d'une fonction du controleur

foreach ($listeAss as $uneAss){
	// pour TESTER : echo "UNE ASSOCIATION : </br>";print_r($uneAss);
				$pageInscriptionEquipeCoureurs->contenu .= '<option id='.$uneAss->IDASS.' value='.$uneAss->IDASS.' name="radioASS" required>'.$uneAss->NOMASS.'</option>';
}
//ajout d'un bouton ajouter une association si elle n'existe pas dans la liste présente
			$pageInscriptionEquipeCoureurs->contenu .='
    					<input  type="button" class="btn btn-default" name="btnAjoutASS"  id="btnAjoutASS" value="AUTRE Association" onclick="ClickAjoutASS();"/>
    					           </div>';

$pageInscriptionEquipeCoureurs->contenu .='	<div class="form-group">
			<input type="submit" class="btn btn-default"  name="btnValiderEQU" value="Valider""/></div>
			</form>
		</article> </section>';

$listeAss->closeCursor (); // pour libérer la mémoire occupée par le résultat de la requéte
$listeAss = null; // pour une autre exécution avec cette variable


//SI LE FORMULAIRE DE L'EQUIPE A ETE VALIDE ALORS AFFICHAGE DE CE SECOND FORMULAIRE
//ici on récupère l'ID de l'équipe qui vient d'être insérée (tt_AjoutEquipe)
if (isset($_GET['idE']) && !empty($_GET['idE'])){

$pageInscriptionEquipeCoureurs->scriptExec = "bloqueInfoEquipe();"; //ajout dans le tableau scriptExec du script à executer

$pageInscriptionEquipeCoureurs->contenu .= '<section>
		<article>
			<form class="form" id="formInscriptionCoureurs" method="post" action="../CONTROLEUR/tt_AjoutCoureursEquipe.php" <form method="post" action="page.php" >
				<div class="form-group">
					<label for="idE">Numéro de votre Equipe </label>
    					<input type="text" class="form-control" name="idE"  id="idE"  value="'.$_GET['idE'].'" readonly/>
  				</div>
  				<div class="form-group">
    				<label for="nomCOU">nom du coureur </label>
    				<input type="text" class="form-control" name="nomCOU"  id="nomCOU"  required="required"/>
  				</div>
    			<div class="form-group">
    				<label for="prenomCOU">prénom du coureur </label>
    				<input type="text" class="form-control" name="prenomCOU"  id="prenomCOU" required="required" />
  				</div>
				<div class="form-group">
    				<label for="mailCOU">mail du coureur </label>
    				<input type="mail" class="form-control" name="mailCOU"  id="mailCOU" required="required" />
  				</div>
					<div class="form-group">
	    				<label for="dateNCOU">Date de naissance du coureur </label>
	    				<input type="text" class="form-control" name="dateNCOU"  id="dateNCOU" required="required" placeholder="AAAA/MM/JJ" pattern="\d{4}/\d{1,2}/\d{1,2}"/>
	  				</div>
						<div class="form-group">
		    				<label for="cerCOU">Le coureur possède un certificat? </label>
		    				Oui &nbsp;<input type="radio"  name="cerCOU"  value="1" required="required" /> &nbsp;&nbsp;&nbsp;&nbsp;
					      Non &nbsp;<input type="radio"  name="cerCOU"  value="0" required="required" />
		  				</div>
							<div class="form-group">
			    				<label for="numLIC">Numéro de licence du coureur(s\'il en possède une): </label>
			    				<input type="text" class="form-control" name="numLIC"  id="numLIC" />
			  				</div>
  				<div class="form-group">
				<input type="submit" class="btn btn-default" name="btnValiderCoureur" value="Valider"/></div>
				</form>
</article> </section>';
}



// TRAITEMENT du RETOUR DE L'ERREUR par le controleur
if (isset($_GET['error']) && !empty($_GET['error'])) {

	$err = $_GET['error'];

	$pageInscriptionEquipeCoureurs->zoneErreur = '<div id="infoERREUR" class="alert alert-success fade in"><strong>INFO : </strong><a href="#" onclick="cacher();" class="close" data-dismiss="alert">&times;</a></div>';

	$verif = preg_match("/ERREUR/",$err); //verifie s'il y a le mot erreur dans le message retourné
	if ( $verif == TRUE ){
		$class ="alert alert-danger fade in";
	}
	else {
		$class ="alert alert-success fade in";
	}
	$pageInscriptionEquipeCoureurs->scriptExec = "changerCouleurZoneErreur('".$class."');";	//ajout dans le tableau scriptExec du script à executer
	$pageInscriptionEquipeCoureurs->scriptExec = "montrer('".$err."');"; //ajout dans le tableau scriptExec du script à executer
}

$pageInscriptionEquipeCoureurs->afficher();
 ?>
