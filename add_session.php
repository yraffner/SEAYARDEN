<?php
include('connexion.php');
if(isset($_POST['retour'])){

header('Location:add_user.php');
}
if(isset($_POST['session']))
{
  $req = $bdd->prepare("INSERT INTO session(libelle_session) VALUES(?)");
  $req->execute (array($_POST['session']));
  echo "La session à bien été ajoutée!";
}

 ?>
<fieldset>
<form method="post" name="formulaire">
<p>SESSION <input type = "text" name="session" value="" required></p>


<hr>
<p>
<input type = "submit" name="ajouter" value= "ajouter">
<input type = "reset" value= "intialiser">
</form><form method="post" name="formulaire2">
<input type = "submit" name="retour" value= "retour"><!--pour qe bouton retour n interfere pas avec le required-->
</form>
</P>


</fieldset>
