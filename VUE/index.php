<?php
session_start ();

require_once ('../Class/PageBase.class.php');



	$pageIndex = new pageBase ( "Bienvenue !" );


$pageIndex->contenu = '
';


$pageIndex->afficher();

?>
