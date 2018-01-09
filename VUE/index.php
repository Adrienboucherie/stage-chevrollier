<?php
session_start ();

require_once ('../Class/PageBase.class.php');



	$pageIndex = new pageBase ( "Bienvenue sur THT..." );


$pageIndex->contenu = 'slt c lrb';


$pageIndex->afficher();

?>
