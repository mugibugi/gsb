
<h3>Fiche de frais du mois <?php echo $nom."-".$prenom."-".$numMois."-".$numAnnee?> : 
    </h3>
    <div class="encadre">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant validé : <?php echo $montantValide?>
              
                     
    </p>
  	<table class="listeLegere">
  	   <caption>Eléments forfaitisés </caption>
        <tr>
         <?php
         foreach ( $lesFraisForfait as $unFraisForfait ) 
		 {
                        
			$libelle = $unFraisForfait['libelle'];
		?>	
			<th> <?php echo $libelle?></th>
                        
		 <?php
        }
		?>
                        <th>Action</th>
		</tr>
        <tr>
        <?php
          foreach (  $lesFraisForfait as $unFraisForfait  ) 
		  {
				$quantite = $unFraisForfait['quantite'];
		?>
                <td class="qteForfait"><input type="text" size="10" value="<?php echo $quantite?>"/></td>
		 <?php
          }
		?>
                <form action='index.php?uc=gererFrais&action=modifier' method='POST'>
                    <td><input type='submit' value='Modifier'/></td>       
                </form>
		</tr>
                
    </table>
  	<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
       </caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>                
             </tr>
        <?php      
          foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
		  {
                        $idFrais = $unFraisHorsForfait['id'];
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
		?>
             <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
             </tr>
        <?php 
          }
		?>
    </table>
    <form action='index.php?uc=gererFrais&action=validerFicheFrais' method='POST'>
        <input type='submit' value='Valider'/>
    </form>
    
    <form action='index.php?uc=gererFrais&action=supprimerFrais' method='POST'>
        <input type='hidden'  name='idFrais' value='<?php $idFrais ?>'/>
        <input type='submit' value='Supprimer'/>       
    </form>
    
  </div>
  </div>
 