﻿<?php
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
                
                $moisASelectionner = $_REQUEST['lstMois'];
                
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
                
                
                $visiteurASelectionner = $_REQUEST['lstVisiteurs'];
                $moisASelectionner = $_REQUEST['unMois'];
                
             
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
                break;
	}
        case 'validerFicheFrais': { 
                    $moisASelectionner = $_REQUEST['unMois'];
                    $visiteurASelectionner = $_REQUEST['idVisiteur']; 
                    $numAnnee = substr($moisASelectionner, 0, 4); 
                    $numMois = substr($moisASelectionner, 4, 2);
                    $pdo->majEtatFicheFrais($visiteurASelectionner,$moisASelectionner,'VA'); 
                    
                    include 'vues/v_confirmValide.php';
                break;
        }
        case 'modifier':{
            
                    $moisASelectionner = $_REQUEST['unMois'];
                    $visiteurASelectionner = $_REQUEST['idVisiteur'];
                    
                    //recuperation du nombre de justificatifs
                    $nbJustificatifs = $pdo->getNbJustificatifs($visiteurASelectionner,$moisASelectionner);
                    
                    //recuperation des frais forfait
                    $lesFraisForfait = $pdo->getLesFraisForfait($visiteurASelectionner,$moisASelectionner);
                    
                    include 'vues/v_modif.php';
                    break;
        }
        case 'validerModif':{
                    $moisASelectionner = $_REQUEST['unMois'];
                    $visiteurASelectionner = $_REQUEST['idVisiteur']; 
                    $lesFrais = $_REQUEST['lesFrais'];
                    
                    $lesMois=$pdo->getLesMoisEnAttente();
                    include ("vues/v_listeMois.php")
                    ;
                    $lesVisiteurs=$pdo->getLesVisiteurs($moisASelectionner);
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
                    
                    //verification de valeur valide puis ajout
                    if(lesQteFraisValides($lesFrais)){
                        $pdo->majFraisForfait($visiteurASelectionner,$moisASelectionner,$lesFrais);
                    }
        }   
                    
                    break;
}
?>