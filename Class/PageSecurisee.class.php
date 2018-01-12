<?php
class PageSecurisee extends PageBase {
	public function __construct($t) {
		parent::__construct($t);
	}

	/**
	 ***************************** Gestion du menu ********************************************
	 */
	// REDEFINITON du menu par rapport à celui de page_base
	protected function affiche_menu() {

		// on rajoute dans le MENU
		// le menu Déconnexion : possiblité de se deconnecter du mode administrateur
		// 2 nouvelles pages "inscription coureurs et Association Caritative !
		$this->menu ='<div id="cssmenu">
<ul>
  <li class="active"><a href="index.php">sdsfsf</a></li>
	<li><a href="convocation.php">Convocations</a></li>
	<li><a href="emargement.php">Emargement</a></li>
  <li style="float:right"><a href="VerifSessionOK.php">Déconnexion</a></li>
  </ul>
</div>';
		echo $this->menu;
	}
}
?>
