/* JavaScript 
 * Copyright (c) 2017 F. de Robien
*/

/*
 * GESTION DU CLIC DE L'EQUIPE et AFFICHAGE DES COUREURS CORRESPONDANTS
 * ******verification si une session est active pour proposer la suppression en mode ADMINISTRATEUR
 *              dans ce cas appel de l'autre script jsSupprCoureur() ci-dessous
 */
function jsClickRadioButton(isSession){
	//alert("click sur un radiobutton");
	//alert ("la session est " + isSession);
	console.log("ready!");
	var idE = 0;
	// lorsque l'on clique sur un bouton d'option en face d'une equipe, on verifie laquelle est cochee et on recupere son id
	$("input[type='radio']:checked").each(
	          function() {
	        	  idE =($(this).attr('id'));
	        	  //alert ("id de l equipe selectionnée : "+ idE);
	         }
	    );
		//APPEL du fichier de traitement (ici : tt_ListeCoureurs.php) qui va récupérer les données et les renvoyer en JSON à cette page
		var filterDataRequest = $.ajax({
			url: '../CONTROLEUR/tt_ListeCoureurs.php',
			type: 'GET',
			data: 'idEQU='+ idE, // on envoie le numero de l equipe, on le testera avec $_GET['idEQU']
			dataType: 'json'
		});

	//une fois réceptionné les donnees en JSON
	filterDataRequest.done(function(data) {
		$('#listeCoureurs').text(""); //remise à blanc de la div
		//alert("SUCCESS : " + data);
		console.log("success");
		console.log(data);
		$('#listeCoureurs').append('<h4>Les coureurs appartenant à cette équipe sont : </h4><ul>');
		/*Pour afficher le tableau des commentaires retournés en JSON par la requête AJAX*/
		 $.each(data, function(index, value) {
			 var supCou="";
			
			 //test s'il existe une session, sinon cette option de suppression est accessible que pour l'ADMINISTRATEUR
			 if (isSession == true){ supCou = '<input type="radio" onclick="jsSupprCoureur();" name="idCOU"  id="'+index +'" />'; }
			 
		 		$('#listeCoureurs').append('<li>'+ value + '&nbsp&nbsp'+ supCou +'</li>');
		 		});	
		 $('#listeCoureurs').append('</ul>');
	});
	filterDataRequest.fail(function(jqXHR, textStatus) {
			//alert("ERROR, jqXHR : "+ jqXHR.responseText + "textStatus : "+ textStatus );
			console.log( "error" );
			if (jqXHR.status === 0){alert("Not connect.n Verify Network.");}
			else if (jqXHR.status == 404){alert("Requested page not found. [404]");}
			else if (jqXHR.status == 500){alert("Internal Server Error [500].");}
			else if (textStatus === "parsererror"){alert("Requested JSON parse failed.");}
			else if (textStatus === "timeout"){alert("Time out error.");}
			else if (textStatus === "abort"){alert("Ajax request aborted.");}
			else{alert("Uncaught Error.n" + jqXHR.responseText);}
		});
		filterDataRequest.always(function() {
			console.log( "complete" );
	});

	//APPEL du fichier de traitement (ici : tt_ListeCoureurs.php) qui va récupérer les données et les renvoyer en JSON à cette page
	var filterDataRequest2 = $.ajax({
		url: '../CONTROLEUR/tt_GetSum.php',
		type: 'GET',
		data: 'idEQU='+ idE, // on envoie le numero de l equipe, on le testera avec $_GET['idEQU']
		dataType: 'json'
	});
	//une fois réceptionné les donnees en JSON
	filterDataRequest2.done(function(data) {
		if(data == null){		
			$('#listeCoureurs').append('<h4>Le montant des sponsors est de 0 €</h4>');
		}
		else{
			
		$('#listeCoureurs').append('<h4>Le montant des sponsors est de ' + data + ' €</h4>');
		}
	});
	filterDataRequest2.fail(function(jqXHR, textStatus) {
			//alert("ERROR, jqXHR : "+ jqXHR.responseText + "textStatus : "+ textStatus );
			console.log( "error" );
			if (jqXHR.status === 0){alert("Not connect.n Verify Network.");}
			else if (jqXHR.status == 404){alert("Requested page not found. [404]");}
			else if (jqXHR.status == 500){alert("Internal Server Error [500].");}
			else if (textStatus === "parsererror"){alert("Requested JSON parse failed.");}
			else if (textStatus === "timeout"){alert("Time out error.");}
			else if (textStatus === "abort"){alert("Ajax request aborted.");}
			else{alert("Uncaught Error.n" + jqXHR.responseText);}
		});
}; /*FIN DE LA FONCTION jsClickRadioButton*/

/*
 * SUPPRESSION DU COUREUR que pour l'administrateur
 */
function jsSupprCoureur(){
	//alert("click sur un radiobutton");
	console.log("ready!");
	var idC = 0;
	// lorsque l'on clique sur un bouton d'option en face du coureur, on verifie lequel est coche et on recupere son id
	$("input[type='radio']:checked").each(
	          function() {
	        	  idC =($(this).attr('id'));
	        	  //alert ("id du coureur selectionné : "+ idC);
	         }
	    );
	
	var reponse = window.confirm("voulez-vous vraiment supprimer ce  coureur ?");
	if(reponse){
		//APPEL du fichier de traitement (ici : tt_ListeCoureurs.php) qui va récupérer les données et les renvoyer en JSON à cette page
		var filterDataRequest = $.ajax({
			url: '../CONTROLEUR/tt_SupprCoureur.php',
			type: 'GET',
			data: 'idCOU='+ idC, // on envoie le numero du coureur, on le testera avec $_GET['idCOU']
			dataType: 'json' //RETOUR DES DONNEES EN JSON
		});

	//une fois réceptionnées les données en JSON
	filterDataRequest.done(function(data) {
		 $.each(data, function(index, value) {
			 //on créé un message d'erreur pour que le traitement de l'erreur soit pris en compte
			 var error = index + value ;
			 //alert('<strong>'+error+'</strong>');
			 //on redirige vers la page en lui passant le message d'erreur en GET (traitement du message)
			 window.location.replace("../VUE/consultationEquipescoureurs.php?error="+error);
			 	 		
		 		});	
	});
	filterDataRequest.fail(function(jqXHR, textStatus) {
			//alert("ERROR, jqXHR : "+ jqXHR.responseText + "textStatus : "+ textStatus );
			console.log( "error" );
			if (jqXHR.status === 0){alert("Not connect.n Verify Network.");}
			else if (jqXHR.status == 404){alert("Requested page not found. [404]");}
			else if (jqXHR.status == 500){alert("Internal Server Error [500].");}
			else if (textStatus === "parsererror"){alert("Requested JSON parse failed.");}
			else if (textStatus === "timeout"){alert("Time out error.");}
			else if (textStatus === "abort"){alert("Ajax request aborted.");}
			else{alert("Uncaught Error.n" + jqXHR.responseText);}
		});
		filterDataRequest.always(function() {
			console.log( "complete" );
		});
	}//cas de la reponse positive à la demande de confirmation de la suppression
	
}; /*FIN DE LA FONCTION jsSupprCoureur*/

