<?php

session_start();

$title = "connexion";
echo('<h1>'.$title.'</h1>');

echo('<form method="get" action="connexion.php"><p>
<label for="pseudo">Pseudo :</label><input name="pseudo" type="text" id="pseudo" /><br />
<label for="password">Mot de Passe :</label><input type="password" name="password" id="password" />
</p>
<p><input type="submit" value="Connexion" /></p></form>');

//verifie si les champs sont renseignés
if (!empty($_GET['pseudo']) && !empty($_GET['password'])){

  //Connection à la base de données
  try{
    $bdd = new PDO('mysql:host =localhost;dbname=sea;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch(Exception $e)
  {
    die('error: ' . $e->getMessage());
  }
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
    header('Location: http://localhost/SEAYARDEN/accueil.php');
  }
}else {
  echo 'remplir le formulaire svp';
}















?>
