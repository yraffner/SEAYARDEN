<?php
include('connexion.php');
$req = $bdd->prepare("SELECT * FROM entreprise");
$req->execute ();
$entreprises =$req->fetchAll();
//var_dump($entreprises);//affiche le parcours de la table entreprise
?>
<fieldset><!--petit carré-->
<form method="post" name="formulaire"><!--crée un formulaire avec champs automatiquement disponibles dans le script PHP d"action-->
<input type = "hidden" name="id_user" value= "">
<p>NOM <input type = "text" name="nom_user" value= ""></p>
<p>PRENOM <input type = "text" name="prenom_user" value=""></p>
STATUT<input type = "text" name="statut" value=""><br>
EMAIL <input type = "email" name="email" value=""><br>
MOT DE PASSE <input type = "password" name="mdp" value=""><hr>
<p>FORMATION <input type = "text" name="formation" value=""></p>
<p>SESSION <input type = "text" name="session" value= ""><hr>
<input type = "hidden" name="id_entreprise" value= ""></p>
<p>ENTREPRISE <select name="entreprise">

<?php

foreach ($entreprises as $entreprise)
{
  echo("<option value =\"".$entreprise['id_entreprise']."\">".$entreprise['nom_entreprise']."</option>");
}
 ?>
</select></p>
<hr>
<p>
<input type = "submit" name="ajouter" value= "ajouter">
<input type = "reset" value= "intialiser">
<input type = "submit" name="retour" value= "retour">
<input type="submit" name="addentreprise" value="addentreprise"></p>
</form>
</P>






</fieldset>

<?php
include('connexion.php');
if(isset($_POST['retour'])){

header('Location:responsable.php');
}

if(isset($_POST['addentreprise'])){
header('Location:add_entreprise.php');

}
?>
