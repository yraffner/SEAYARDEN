
<?php

include('connexion.php');
include('fonction.php');


$id = $_POST['id_user'];
$sql = "SELECT * FROM `utilisateur`
LEFT JOIN apprenti ON id_user = id_apprenti
LEFT JOIN formation ON apprenti.id_formation= formation.id_formation
LEFT JOIN session ON apprenti.id_session= session.id_session
LEFT JOIN entreprise ON apprenti.id_entreprise= entreprise.id_entreprise
WHERE id_user=" .$id;
$bdd->query($sql);
$reponse= $bdd->query($sql);
$don = $reponse->fetch();


?>



<fieldset><!--petit carré-->
<form method="post" name="formulaire"><!--crée un formulaire avec champs automatiquement disponibles dans le script PHP d"action-->
<input type = "hidden" name="id_user" value= "<?=$_POST["id_user"];?>"
<p>NOM <input type = "text" name="nom_user" value= "<?=$don["nom_user"];?>"></p>
<p>PRENOM <input type = "text" name="prenom_user" value="<?=$don["prenom_user"];?>"></p>
STATUT<input type = "text" name="statut" value="<?=retour_statut($don["email"],$bdd);?>"><br>
EMAIL <input type = "text" name="email" value="<?=$don["email"];?>"><br>
MOT DE PASSE <input type = "password" name="mdp" value="<?=$don["mdp"];?>"><hr>
<p>FORMATION <input type = "text" name="formation" value="<?=$don["libelle_formation"];?>"></p>
<p>SESSION <input type = "text" name="session" value= "<?=$don["libelle_session"];?>"><hr>
<input type = "text" name="id_entreprise" value= "<?=$don["id_entreprise"];?>"></p>
<p>ENTREPRISE <input type = "text" name="entreprise" value="<?=$don["nom_entreprise"];?>" disabled></p>
<p>ADRESSE <input type = "text" name="adresse" value="<?=$don["adresse"];?>"disabled></p>
VILLE <input type = "text" name="ville" value="<?=$don["ville"];?>"disabled>
CODE POSTAL <input type = "text" name="cp" value="<?=$don["cp"];?>"disabled>

<hr>
<p><input type = "submit" name="supprimer" value= "supprimer">
<input type = "submit" name="action_user" value= "">
<input type = "reset" name="" value= "intialiser">
</form>
</P>






</fieldset>


<?php
if(isset($_POST['selectionner'])){


}
 ?>
