<?php
session_start();

require_once ('../Class/PageBase.class.php');

$pageConvocation = new pageBase ("Récupération des convocations");

$pageConvocation->afficher();
?>
