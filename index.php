<html>
<head>
  <meta charset="utf-8" />
</head>
<body>
  <?php
  try{
    $bdd = new PDO('mysql:host =localhost;dbname=sea;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch(Exception $e)
  {
    die('error: ' . $e->getMessage());
  }
  $bdd->exec("UPDATE utilisateur SET email = 'imbo@imbo.com' WHERE nom_user = 'imbo'");
  $reponse = $bdd->query('SELECT * FROM utilisateur');
  while ($donnees = $reponse->fetch())
  {
    var_dump($donnees);
  }

  $reponse->closeCursor();
  include("./menu.php");
  include("./connexion.php");
  ?>
</body>
</html>
