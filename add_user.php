<fieldset><!--petit carré-->
<form method="post" name="formulaire"><!--crée un formulaire avec champs automatiquement disponibles dans le script PHP d"action-->
<input type = "hidden" name="id_user" value= "">
<p>NOM <input type = "text" name="nom_user" value= ""></p>
<p>PRENOM <input type = "text" name="prenom_user" value=""></p>
STATUT<input type = "text" name="statut" value=""><br>
EMAIL <input type = "text" name="email" value=""><br>
MOT DE PASSE <input type = "password" name="mdp" value=""><hr>
<p>FORMATION <input type = "text" name="formation" value=""></p>
<p>SESSION <input type = "text" name="session" value= ""><hr>
<input type = "hidden" name="id_entreprise" value= ""></p>
<p>ENTREPRISE <input type = "text" name="entreprise" value=""></p>
<p>ADRESSE <input type = "text" name="adresse" value=""></p>
VILLE <input type = "text" name="ville" value="">
CODE POSTAL <input type = "text" name="cp" value="">

<hr>
<p>
<input type = "submit" name="ajouter" value= "ajouter">
<input type = "reset" value= "intialiser">
<input type = "submit" name="retour" value= "retour">
</form>
</P>






</fieldset>

<?php

if(isset($_POST['retour'])){

header('Location:responsable.php');
}


?>
