<?php

session_start();

$title = "connexion";
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
    $script = retour_statut($email,$bdd).".php";

    header("Location: http://localhost/SEAYARDEN/".$script);
  }
}else {
  echo 'remplir le formulaire svp';
}


function retour_statut($email,$bdd)
{
  $statut ="";
  $sousrequete = " IN (SELECT `id_user` FROM `utilisateur` WHERE `email` = '".$email."')";
  $sql = "SELECT COUNT(*) as apprenti FROM apprenti WHERE id_apprenti".$sousrequete;

  $bdd->query($sql);
  $reponse= $bdd->query($sql);
  $donneesapp = $reponse->fetchAll();

  $sql = "SELECT COUNT(*) as responsable FROM responsable_de_filiere WHERE id_responsable_de_filiere".$sousrequete;

  $bdd->query($sql);
  $reponse= $bdd->query($sql);
  $donneesres = $reponse->fetchAll();

  $sql = "SELECT COUNT(*) as visiteur FROM visiteur WHERE id_visiteur".$sousrequete;

  $bdd->query($sql);
  $reponse= $bdd->query($sql);
  $donneesvis = $reponse->fetchAll();

if($donneesapp[0]['apprenti'] == 1)
{
    $statut = "apprenti";
}
elseif($donneesres[0]['responsable'] == 1){
  $statut =  "responsable";
}
elseif($donneesvis[0]['visiteur'] == 1)
{
  $statut = "visiteur";
}
return $statut;
}










?>
