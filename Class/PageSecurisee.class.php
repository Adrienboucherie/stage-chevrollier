<?php
class pageSecurisee extends pageBase {
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
		$this->menu ='<div id="navbar" class="navbar navbar-inverse">
				<div class="navbar-header">
      				<a class="navbar-brand" href="../VUE/VerifSessionOK.php">Déconnexion</a>
    			</div>
    
          <ul class="nav navbar-nav">
            <li><a href="index.php">THT</a></li>
            <li><a href="consultationEquipescoureurs.php">Consultation des Equipes avec leurs coureurs</a></li>
		
			<li><a href="inscriptionCoureurs.php">ajouter les coureurs dans une équipe</a></li>
		    <li><a href="ajoutAssociation.php">ajouter l\'association caritative</a></li>
		    <li><a href="ajoutSponsor.php">Ajout un sponsor</a></li>
				
			</ul>
		</div>';
		echo $this->menu;
	}
}
?>