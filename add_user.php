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
    <p>STATUT <select name="statut">
      <option value = "0"></option>
      <option value = "apprenti">apprenti</option>
      <option value = "visiteur">visiteur</option>
      <option value = "responsable de filiere">responsable de filiere</option>
    </select></p>
    EMAIL <input type = "email" name="email" value="" required><br>
    MOT DE PASSE <input type = "password" name="mdp" value="" required><hr>
    <p>FORMATION <select name="formation"></p>
      <option value = "0"></option>
      <?php

      foreach ($formations as $formation)
      {
        echo("<option value =\"".$formation['id_formation']."\">".$formation['libelle_formation']."</option>");
      }
      ?>
    </select></p>
    <p>SESSION <select name="session"><hr>
      <option value = "0"></option>
      <?php

      foreach ($sessions as $session)
      {
        echo("<option value =\"".$session['id_session']."\">".$session['libelle_session']."</option>");
      }
      ?>
    </select></p>
    <input type = "hidden" name="id_entreprise" value= ""></p>
    <p>ENTREPRISE <select name="entreprise">
      <option value = "0"></option>
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
//gestion des boutons
include('connexion.php');
if(isset($_POST['ajouter'])){


  if(($_POST['statut'])!='0') {
    if($_POST['statut']=='visiteur'){
      //ajoute un utilisateur dans la table utilisateur
      $req = $bdd->prepare("INSERT INTO UTILISATEUR(nom_user, prenom_user, email, mdp) VALUES(?,?,?,?)");
      $req->execute (array($_POST['nom_user'],$_POST['prenom_user'],$_POST['email'],$_POST['mdp']));
      $dernierId = $bdd->lastInsertId();
      //ajoute l id de l'utilisateur dans la table visiteur
      $req = $bdd->prepare("INSERT INTO VISITEUR(id_visiteur) VALUES(?)");
      $req->execute (array($dernierId));
      echo "L'Utilisateur à bien été ajouté!";
    }
    if($_POST['statut']=='responsable de filiere'){
      //ajoute un utilisateur dans la table utilisateur
      $req = $bdd->prepare("INSERT INTO UTILISATEUR(nom_user, prenom_user, email, mdp) VALUES(?,?,?,?)");
      $req->execute (array($_POST['nom_user'],$_POST['prenom_user'],$_POST['email'],$_POST['mdp']));
      $dernierId = $bdd->lastInsertId();
      //ajoute l id de l'utilisateur dans la table responsable_de_filiere
      $req = $bdd->prepare("INSERT INTO RESPONSABLE_DE_FILIERE(id_responsable_de_filiere) VALUES(?)");
      $req->execute (array($dernierId));
      echo "L'Utilisateur à bien été ajouté!";
    }
    if($_POST['statut']=='apprenti'){
      //verifier si les combos sont remplis
      if(($_POST['formation']!='0') && ($_POST['session']!='0') && ($_POST['entreprise']!='0')){
        //ajoute un utilisateur dans la table utilisateur
        $req = $bdd->prepare("INSERT INTO UTILISATEUR(nom_user, prenom_user, email, mdp) VALUES(?,?,?,?)");
        $req->execute (array($_POST['nom_user'],$_POST['prenom_user'],$_POST['email'],$_POST['mdp']));
        $dernierId = $bdd->lastInsertId();

        //ajoute l id de l'utilisateur dans la table apprenti ainsi que les id session,formation et entreprise
        $req = $bdd->prepare("INSERT INTO APPRENTI(id_apprenti, id_session, id_formation, id_entreprise) VALUES(?,?,?,?)");
        $req->execute (array($dernierId, $_POST['session'],$_POST['formation'],$_POST['entreprise']));
        echo "L'Utilisateur à bien été ajouté!";
      }
      else{
        echo("veuillez renseigner formation,session et une entreprise");
      }


    }
  }
  //si pas de statut renseigné
  else{
    echo("veuillez renseigner un statut, l'utilisateur n'a pas été rajouté");
  }


}
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
?>
