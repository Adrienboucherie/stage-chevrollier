<?php
session_start();

require_once ('../Class/PageBase.class.php');

$pageEmargement = new pageBase ("Récupération des émargements");

$pageEmargement->contenu='<form action="../pdf_emargement.php">
<input class="btn btn-primary" type="submit" value="PDF_EMARGEMENT">
</form>';

$pageEmargement->afficher();
?>
