<?php
session_start();

require_once ('../Class/PageBase.class.php');

$pageConvocation = new pageBase ("Récupération des convocations");

$pageConvocation->contenu='<form action="../pdf_convocation.php">
<input class="btn btn-primary" type="submit" value="PDF_CONVOCS">
</form>';

$pageConvocation->afficher();
?>
