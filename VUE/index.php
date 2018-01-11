<?php
session_start ();

require_once ('../Class/PageBase.class.php');



	$pageIndex = new PageBase ( "Bienvenue !" );


$pageIndex->contenu = '
';


$pageIndex->afficher();

?>
