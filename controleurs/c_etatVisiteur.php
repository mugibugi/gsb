<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idutilisateur = $_SESSION['idutilisateur'];
switch($action){
	case 'selectionnerVisiteurs':{
		$lesVisiteurs=$pdo->getLesVisiteurs();
                echo "Bonjour";
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		include("vues/v_listeVisiteurs.php");
		break;
	}
	case 'voirEtatFrais':{
		$leMois = $_REQUEST['lstMois']; 
		$lesMois=$pdo->getLesMoisDisponibles($idutilisateur);
		$moisASelectionner = $leMois;
		include("vues/v_listeMois.php");
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idutilisateur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($idutilisateur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idutilisateur,$leMois);
		$numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_etatFrais.php");
	}
}
?>