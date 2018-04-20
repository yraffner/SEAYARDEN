<?php
include('connexion.php');
if(isset($_POST['retour'])){

header('Location:add_user.php');
}
if(isset($_POST['formation']))
{
  $req = $bdd->prepare("INSERT INTO FORMATION(libelle_formation) VALUES(?)");
  $req->execute (array($_POST['formation']));
  echo "La formation à bien été ajoutée!";
}
//if(isset($_POST['supprimer']))
//{
//  $req = $bdd->prepare(" FORMATION(libelle_formation) VALUES(?)");
//  $req->execute (array($_POST['formation']));
//  echo "La formation à bien été ajoutée!";
//}

 ?>
<fieldset>
<form method="post" name="formulaire">
<p>FORMATION <input type = "text" name="formation" value="" required></p>


<hr>
<p>
<input type = "submit" name="ajouter" value= "ajouter">
<input type = "submit" name="supprimer" value= "supprimer">
</form><form method="post" name="formulaire2">
<input type = "submit" name="retour" value= "retour"><!--pour qe bouton retour n interfere pas avec le required-->
</form>
</P>


</fieldset>
