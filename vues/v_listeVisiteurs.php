﻿ <div id="contenu">
      <h2>Mes fiches de frais</h2>
      <h3>Visiteurs à sélectionner : </h3>
      <form action="index.php?uc=etatFrais&action=voirEtatFrais" method="post">
      <div class="corpsForm">
         
      <p>
	 
        <label for="lstVisiteurs" accesskey="n">Visiteurs : </label>
        <select id="lstVisiteurs" name="lstVisiteurs">
            <?php
                        
			foreach ($lesVisiteurs as $unVisiteur)
			{
                            $id = $unVisiteur['id'];
			    $nom = $unVisiteur['nom'];
				$prenom = $unVisiteur['prenom'];
				
				if($id == $visiteurASelectionner){
				?>
				<option selected value="<?php echo $id ?>"><?php echo $nom."/".$prenom ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo $id ?>"><?php echo  $nom."/".$prenom ?> </option>
				<?php 
				}
			
			}
           
		   ?>    
            
        </select>
      </p>
      </div>
      <div class="piedForm">
          <form>
        <input id="ok" type="submit" value="Valider" size="20" />
        <input type="hidden" name="nom" value="<?php $nom?>"/>
        <input type="hidden" name="prenom" value="<?php $prenom?>"/>
        <input id="annuler" type="reset" value="Effacer" size="20" />
      </form> 
      </div>
        
      </form>