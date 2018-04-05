<?php

session_start();

$title = "ACCUEIL";
echo('<h1>'.$title.'</h1>');

echo('<form method="get" action="connexion.php"><p>
<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
</p>
<p><input type="submit" value="Connexion" /></p></form>');

//verifie si les champs sont renseignés par l'user
if (!empty($_GET['pseudo']) && !empty($_GET['password'])){

  $email = $_GET['pseudo'];

  //Connection à la base de données
include('connexion.php');
  //Requete à la base
  $sql = "SELECT * FROM utilisateur";
  $bdd->query($sql);
  $reponse= $bdd->query($sql);
  $donnees = $reponse->fetchAll();
  $verifformulaire = false;//false si pseudo et password incorrects sinon true

  //Parcours des utilisateurs
  foreach ($donnees as $unutilisateur){

    // SI le pseudo est correct
    if($_GET['pseudo'] == $unutilisateur[3]){

      //SI le mdp est correct
      if($_GET['password'] == $unutilisateur[4]){
        $verifformulaire = true;

      }
    }
  }
  if ($verifformulaire == false)
  {
    echo 'erreur identifiants';
  }
  else {
    $script = retour_statut($email,$bdd).".php";

    header("Location: http://localhost/SEAYARDEN/".$script);
  }
}else {
  echo 'remplir le formulaire svp';
}












?>
