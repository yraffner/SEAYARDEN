<?php
include('connexion.php');
if(isset($_POST['retour'])){

header('Location:add_user.php');
}
if(isset($_POST['entreprise'],$_POST['adresse'],$_POST['ville'],$_POST['cp'] ))
{
  $req = $bdd->prepare("INSERT INTO ENTREPRISE(nom_entreprise, ville, cp, adresse) VALUES(?,?,?,?)");
  $req->execute (array($_POST['entreprise'],$_POST['ville'],$_POST['cp'],$_POST['adresse']));
  echo "L'entreprise à bien été ajoutée!";
}

 ?>
<fieldset>
<form method="post" name="formulaire">
<p>ENTREPRISE <input type = "text" name="entreprise" value="" required></p>
<p>ADRESSE <input type = "text" name="adresse" value="" required></p>
VILLE <input type = "text" name="ville" value="" required>
CODE POSTAL <input type = "number" max="99999" name="cp" value="" required>

<hr>
<p>
<input type = "submit" name="ajouter" value= "ajouter">
<input type = "reset" value= "intialiser">
</form><form method="post" name="formulaire2">
<input type = "submit" name="retour" value= "retour"><!--pour qe bouton retour n interfere pas avec le required-->
</form>
</P>


</fieldset>
