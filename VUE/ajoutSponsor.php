<?php
session_start ();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');
require_once ('../MODELE/PersonneModele.class.php');
require_once ('../MODELE/EntrepriseModele.class.php');

if (isset ( $_SESSION ['idU'] ) && isset ( $_SESSION ['mdpU'] )) {
	$pageAjoutSponsor = new pageSecurisee ( "Ajouter une association..." );
}
$PersonneModele = new PersonneModele();
$personnes = $PersonneModele->getAll();
$EntrepriseModele = new EntrepriseModele();
$entreprises = $EntrepriseModele->getAll();

$pageAjoutSponsor->contenu = '<section>
	<article>
	<form class="form-inline" id="formNouveauSponsor" method="post" action="../CONTROLEUR/tt_AjoutSponsor.php" enctype="multipart/form-data">
	<div class="form-group">
	<label for="nomSponsor">Nom du sponsor</label>
	<input type="text" class="form-control" name="nomSponsor" id="nomSponsor" required />
	<input type="hidden" name="idEqu" value='. $_SESSION ['id'] .' />
	<select name="idPer" class="form-control">
	    ';
foreach($personnes as $personne){
	$pageAjoutSponsor->contenu .= '<option  value="'. $personne->IDPER .'">' . $personne->PRENOMPER .  " ". $personne->NOMPER . '</option>';
};
    $pageAjoutSponsor->contenu .='</select><select class="form-control" name="idSociety"><option></option>
	    ';
foreach($entreprises as $entreprise){
	$pageAjoutSponsor->contenu .= '<option value="'. $entreprise->IDENT .'">' . $entreprise->RAISONSOCIALEENT . '</option>';
};
    $pageAjoutSponsor->contenu .='
	</select>
	</div>
	<div class="form-group">
	<label for="montant">Montant</label>
	<input type="number" class="form-control" name="montant" id="montant" required />
	</div>
	<div class="form-group">
			<input type="submit" class="btn btn-default" name="btnValiderSponsor" id="btnValiderSponsor" value="Valider"/></div>
	</form>
</article> </section>';


$pageAjoutSponsor->afficher();
?>