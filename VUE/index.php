<?php
session_start ();

require_once ('../Class/PageBase.class.php');
require_once ('../Class/PageSecurisee.class.php');


if (isset( $_SESSION ['idU'] ) && isset( $_SESSION ['mdpU'] )) {
	$pageIndex = new pageSecurisee ( "Bienvenue sur le mode SECU" );
} else {
	$pageIndex = new pageBase ( "Bienvenue !" );
}



$pageIndex->contenu = '
';


$pageIndex->afficher();

?>
