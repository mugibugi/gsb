<?php
include("vues/v_sommaire.php");
$idutilisateur = $_SESSION['idutilisateur'];
$mois = getMois(date("d/m/Y"));
$numAnnee =substr( $mois,0,4);
$numMois =substr( $mois,4,2);
$action = $_REQUEST['action'];
switch($action){
	case 'saisirFrais':{
		if($pdo->estPremierFraisMois($idutilisateur,$mois)){
			$pdo->creeNouvellesLignesFrais($idutilisateur,$mois);
		}
		break;
	}
	case 'validerMajFraisForfait':{
            
                $visiteurASelectionner = $_SESSION['unVisiteur'];
                $moisASelectionner = $_SESSION['unMois'];
		$lesFrais = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($visiteurASelectionner,$moisASelectionner,$lesFrais);
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
	  break;
	}
	case 'validerCreationFrais':{
		$dateFrais = $_REQUEST['dateFrais'];
		$libelle = $_REQUEST['libelle'];
		$montant = $_REQUEST['montant'];
		valideInfosFrais($dateFrais,$libelle,$montant);
		if (nbErreurs() != 0 ){
			include("vues/v_erreurs.php");
		}
		else{
			$pdo->creeNouveauFraisHorsForfait($idutilisateur,$mois,$libelle,$dateFrais,$montant);
		}
		break;
	}
	case 'supprimerFrais':{
		$idFrais = $_REQUEST['idFrais'];
	    $pdo->supprimerFraisHorsForfait($idFrais);
		break;
	}
        case 'validerFicheFrais':
            $moisASelectionner = $_SESSION['unMois'];
            $visiteurASelectionner = $_SESSION['unVisiteur'];
            $nom = $_SESSION['nom'];
            $prenom = $_SESSION['prenom'];
            
            $numAnnee = substr($moisASelectionner, 0, 4);
            $numMois = substr($moisASelectionner, 4, 2);
            
            $pdo->majEtatFicheFrais($visiteurASelectionner,$moisASelectionner,'VA');
            include 'vues/v_confirmValide.php';
            break;
}
//$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idutilisateur,$mois);
//$lesFraisForfait= $pdo->getLesFraisForfait($idutilisateur,$mois);
//include("vues/v_listeFraisForfait.php");
//include("vues/v_listeFraisHorsForfait.php");

?>