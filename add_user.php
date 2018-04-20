<?php
include('connexion.php');
$req = $bdd->prepare("SELECT * FROM entreprise");
$req->execute ();
$entreprises =$req->fetchAll();
$req = $bdd->prepare("SELECT * FROM session");
$req->execute ();
$sessions =$req->fetchAll();
$req = $bdd->prepare("SELECT * FROM formation");
$req->execute ();
$formations =$req->fetchAll();
//var_dump($entreprises);//affiche le parcours de la table entreprise
?>
<fieldset><!--petit carré-->
  <form method="post" name="formulaire"><!--crée un formulaire avec champs automatiquement disponibles dans le script PHP d"action-->
    <input type = "hidden" name="id_user" value= "" required>
    <p>NOM <input type = "text" name="nom_user" value= "" required></p>
    <p>PRENOM <input type = "text" name="prenom_user" value="" required></p>
    STATUT<input type = "text" name="statut" value="" required><br>
    EMAIL <input type = "email" name="email" value="" required><br>
    MOT DE PASSE <input type = "password" name="mdp" value="" required><hr>
    <p>FORMATION <select name="formation"></p>
      <?php

      foreach ($formations as $formation)
      {
        echo("<option value =\"".$formation['id_formation']."\">".$formation['libelle_formation']."</option>");
      }
      ?>
    </select></p>
    <p>SESSION <select name="session"><hr>
      <?php

      foreach ($sessions as $session)
      {
        echo("<option value =\"".$session['id_session']."\">".$session['libelle_session']."</option>");
      }
      ?>
    </select></p>
    <input type = "hidden" name="id_entreprise" value= ""></p>
    <p>ENTREPRISE <select name="entreprise">

      <?php

      foreach ($entreprises as $entreprise)
      {
        echo("<option value =\"".$entreprise['id_entreprise']."\">".$entreprise['nom_entreprise']."-".$entreprise['cp']."</option>");
      }
      ?>
    </select></p>
    <hr>
    <p>
      <input type = "submit" name="ajouter" value= "ajouter">
      <input type = "reset" value= "intialiser">
      </form><form method="post" name="formulaire2">
      <input type = "submit" name="retour" value= "retour"><!--pour qe bouton retour n interfere pas avec le required-->
      </form>
      <form method="post" name="formulaire3">
      <input type="submit" name="addentreprise" value="addentreprise">
      <input type="submit" name="addsession" value="addsession">
      <input type="submit" name="addformation" value="addformation">
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
if(isset($_POST['addsession'])){
  header('Location:add_session.php');

}
if(isset($_POST['addformation'])){
  header('Location:add_formation.php');

}
if(isset($_POST['nom_user'],$_POST['prenom_user'],$_POST['email'],$_POST['mdp'] ))
{
  $req = $bdd->prepare("INSERT INTO UTILISATEUR(nom_user, prenom_user, email, mdp) VALUES(?,?,?,?)");
  $req->execute (array($_POST['nom_user'],$_POST['prenom_user'],$_POST['email'],$_POST['mdp']));
  echo "L'Utilisateur à bien été ajouté!";
}
?>
