<?php
require_once ('../MODELE/EquipeModele.class.php');
require_once ('../Class/PageBase.class.php');

?>
<!DOCTYPE html>
<html lang='fr'>
<head>
<script type="text/javascript" src="utile.js"></script>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
</head>

<?php
 session_start();
 $pagerecapitulatif = new PageBase ( "Ajouter son équipe avec ses coureurs..." );
$mdp= $_SESSION['motdepasse'];
$nomEQU = $_SESSION['nomEQU'];




$pagerecapitulatif ->contenu =	'<p>Le nom de votre équipe est: '.$nomEQU. ' </p>
<p>Votre mot de passe est : <b>'.$mdp.'</b></p>
		<form action="../CONTROLEUR/tt_AjoutCoureursEquipe.php?idE=' . $_GET["idE"] . '" method="POST">
		<div class="form-group">
		<input type="hidden" value="TEST" name="TEST"/>
			<input type="submit" class="btn btn-default"  name="btnValiderEQU" value="Suivant"/></div>
			</form>
		</article> ';



/*unset($_SESSION['motdepasse']);
unset($_SESSION['nomEQU']);*/
$pagerecapitulatif->afficher();
?>
</html>