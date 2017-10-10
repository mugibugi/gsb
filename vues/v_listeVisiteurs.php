 <div id="contenu">
      <h2>Mes fiches de frais</h2>
      <h3>Visiteurs à sélectionner : </h3>
      <form action="index.php?uc=etatFrais&action=voirEtatFrais" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstVisiteurs" accesskey="n">Visiteurs : </label>
        <select id="lstVisiteurs" name="lstVisiteurs">
            <?php
                        echo " Bonjour";
			foreach ($lesVisiteurs as $unVisiteur)
			{
			    $nom = $unVisiteur['nom'];
				$prenom = $unVisiteur['prenom'];
				
				if($nom == $visiteurASelectionner){
				?>
				<option selected value="<?php echo $nom ?>"><?php echo $prenom ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo $nom ?>"><?php echo  $prenom ?> </option>
				<?php 
				}
			
			}
           
		   ?>    
            
        </select>
      </p>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </p> 
      </div>
        
      </form>