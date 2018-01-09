/*ces  scripts servent à montrer ou cacher la zone d'erreur et changer les informations en fonction des erreurs reçues*/
function cacher(){ 
	(document.getElementById("infoERREUR")).style.display = "none";
	//alert("je suis passee dans CACHER");
	}

function montrer(infoErreur){ 
	var info = (document.getElementById("infoERREUR"));
	info.style.display = "block";
	info.innerHTML += infoErreur;
	//alert("je suis passee dans MONTRER : "+infoErreur);
	} 

function changerCouleurZoneErreur(typeErreur){ 
	document.getElementById("infoERREUR").className = typeErreur;
	//alert("je suis passee dans CHANGER COULEUR ZONE ERREUR : "+typeErreur);
	}

/*lors du click sur le bouton AjoutASSOCIATION */
function ClickAjoutASS(){
	//alert("je passe dans ClickAjoutASS");
	//on met en cookie les informations saisies par l'utilisateur nom et slogan de l'équipe
	//alert("nomE :"+document.getElementById("nomEQU").value);

	creerCookie("nomE", document.getElementById("nomEQU").value, 1);
	creerCookie("sloganE", document.getElementById("sloganEQU").value, 1);
	
    document.location.href="ajoutAssociation.php";//je redirige vers la page ajoutAssociation
      }

//une fois l'équipe créée, permet au chargement du formulaire d'inscription des coureurs, de bloquer les champs de l'équipe qui vient d'être créée.
//ici le but est de rajouter des joueurs à cette équipe et non de changer les informations de l'équipe
function bloqueInfoEquipe(){ 
	document.getElementById('formInscriptionEquipe').style.display = "none";
	//alert("je suis passee dans BLOQUE INFO EQUIPE");
}

/* fonction de gestion des cookies en JAVASCRIPT*/
function creerCookie(nom, valeur, jours) {
	// Le nombre de jours est spécifié
	        if (jours) {
	var date = new Date();
	// Converti le nombre de jour en millisecondes
	date.setTime(date.getTime()+(jours*24*60*60*1000));
	var expire = "; expire="+date.toGMTString();
	}
	// Aucune valeur de jours spécifiée
	else var expire = "";
	document.cookie = nom+"="+valeur+expire+"; path=/";
	}

function tafonction(mdp){
	alert("Votre mot de passe est: "+mdp+", Notez le bien.");
}