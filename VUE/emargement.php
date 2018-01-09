<?php
session_start();

require_once ('../Class/PageBase.class.php');

$pageEmargement = new pageBase ("Récupération des émergements");

$pageEmargement->afficher();
?>
