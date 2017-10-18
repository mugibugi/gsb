<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idutilisateur = $_SESSION['idutilisateur'];

switch($action){
	case 'selectionnerMois':{
		$lesMois=$pdo->getLesMoisEnAttente();
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
		include("vues/v_listeMois.php");
		break;
	}
        case 'selectionnerVisiteurs':{
                $_SESSION['unMois'] = $_REQUEST['lstMois'];
                $moisASelectionner = $_SESSION['unMois'];
                
                $lesMois = $pdo->getLesMoisEnAttente();
                include("vues/v_listeMois.php");
        
		$lesVisiteurs=$pdo->getLesVisiteurs($moisASelectionner);
                include("vues/v_listeVisiteurs.php");
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		
		break;
	}
	case 'voirEtatFrais':{
                
                $_SESSION['unVisiteur'] = $_REQUEST['lstVisiteurs'];
                $visiteurASelectionner = $_SESSION['unVisiteur'];
                $moisASelectionner = $_SESSION['unMois'];
                
                $_SESSION['nom'] = $_REQUEST['nom'];
                $_SESSION['prenom'] = $_REQUEST['prenom'];
                
                $nom = $_SESSION['nom'];
                $prenom = $_SESSION['prenom'];
                
                $lesMois = $pdo->getLesMoisEnAttente();
                include("vues/v_listeMois.php");
                
                $lesVisiteurs = $pdo->getLesVisiteurs($moisASelectionner);
                include("vues/v_listeVisiteurs.php");

		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($visiteurASelectionner,$moisASelectionner);
		$lesFraisForfait= $pdo->getLesFraisForfait($visiteurASelectionner,$moisASelectionner);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($visiteurASelectionner,$moisASelectionner);
		$numAnnee =substr( $moisASelectionner,0,4);
		$numMois =substr( $moisASelectionner,4,2);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_etatFrais.php");
	}
}
?>