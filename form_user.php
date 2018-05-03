
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
$req = $bdd->prepare("SELECT * FROM formation");
$req->execute ();
$formations =$req->fetchAll();
$req = $bdd->prepare("SELECT * FROM entreprise");
$req->execute ();
$entreprises =$req->fetchAll();
$req = $bdd->prepare("SELECT * FROM session");
$req->execute ();
$sessions =$req->fetchAll();


?>



<fieldset><!--petit carré-->
<form method="post" name="formulaire"><!--crée un formulaire avec champs automatiquement disponibles dans le script PHP d"action-->
<input type = "hidden" name="id_user" value= "<?=$_POST["id_user"];?>"
<p>NOM <input type = "text" name="nom_user" value= "<?=$don["nom_user"];?>"></p>
<p>PRENOM <input type = "text" name="prenom_user" value="<?=$don["prenom_user"];?>"></p>
<p>STATUT <select name="statutCombo">
  <?php
//creation de la variable statut
  $statut = retour_statut($don["email"],$bdd);

  ?>
  <!-- le php sert a selectionner le statut de l utilisateur dans un combo -->
  <option value = "apprenti" <?php if($statut == "apprenti"){echo('selected');}?> >apprenti</option>
  <option value = "visiteur" <?php if($statut == "visiteur"){echo('selected');}?> >visiteur</option>
  <option value = "responsable de filiere" <?php if($statut == "responsable"){echo('selected');}?>>responsable de filiere</option>

</select></p>
EMAIL <input type = "email" name="email" value="<?=$don["email"];?>"><br>
MOT DE PASSE <input type = "password" name="mdp" value="<?=$don["mdp"];?>"><hr>
<p>FORMATION <select name="formationCombo" ></p>
  <option value = "0"></option>
  <?php

  foreach ($formations as $formation)
  {
?>
    <option value ="<?php echo($formation['id_formation']);?>" <?php if($don['id_formation']== $formation['id_formation']){echo('selected');} ?> ><?php echo($formation['libelle_formation']);?> </option>
<?php
  }
  ?>
</select></p>
<p>SESSION <select name="sessionCombo" ></p>
  <option value = "0"></option>
  <?php

  foreach ($sessions as $session)
  {
?>
    <option value ="<?php echo($session['id_session']);?>" <?php if($don['id_session']== $session['id_session']){echo('selected');} ?> ><?php echo($session['libelle_session']);?> </option>
<?php
  }
  ?>
</select></p>
<input type = "hidden" name="id_entreprise" value= "<?=$don["id_entreprise"];?>"></p>
<p>ENTREPRISE <input type = "text" name="entreprise" value="<?=$don["nom_entreprise"];?>" disabled></p>
<p>ADRESSE <input type = "text" name="adresse" value="<?=$don["adresse"];?>"disabled></p>
VILLE <input type = "text" name="ville" value="<?=$don["ville"];?>"disabled>
CODE POSTAL <input type = "text" name="cp" value="<?=$don["cp"];?>"disabled>

<hr>
<p><input type = "submit" name="supprimer" value= "supprimer">
<input type = "submit" name="modifier" value= "modifier">
<input type = "submit" name="retour" value= "retour">
</form>
</P>






</fieldset>


<?php


if(isset($_POST['retour'])){

header('Location:responsable.php');
}





if(isset($_POST['supprimer'])){
  if($statut=="apprenti"){
   $req = $bdd->prepare("DELETE FROM apprenti WHERE id_apprenti =  ".$id);
  }
  if($statut=="responsable"){
    $req = $bdd->prepare("DELETE FROM responsable_de_filiere WHERE id_responsable_de_filiere =  ".$id);
  }
  if($statut=="visiteur"){
    $req = $bdd->prepare("DELETE FROM visiteur WHERE id_visiteur =  ".$id);
  }
  $req->execute ();
  $req = $bdd->prepare("DELETE FROM utilisateur WHERE id_user =  ".$id);
  $req->execute ();
  header('Location:responsable.php');
}
if(isset($_POST['modifier'])){

}
 ?>
