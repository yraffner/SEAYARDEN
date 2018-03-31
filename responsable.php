<h1>Responsable de filière</h1>
<?php
try{
  $bdd = new PDO('mysql:host =localhost;dbname=sea;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
  die('error: ' . $e->getMessage());
}

        echo '<pre>';
        print_r($tableau);
        echo  '</pre>';

$sql = "SELECT * FROM utilisateur";
$bdd->query($sql);
$reponse= $bdd->query($sql);
$donnees = $reponse->fetchAll();
$tableau = array($donnees);
echo '<pre>';
print_r($tableau);
echo  '</pre>';



?>
