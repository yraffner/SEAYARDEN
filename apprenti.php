<h1>Apprenti</h1>
<?php
try{
  $bdd = new PDO('mysql:host =localhost;dbname=sea;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
  die('error: ' . $e->getMessage());
}


$sql = "SELECT * FROM dispo";
$bdd->query($sql);
$reponse= $bdd->query($sql);
$donnees = $reponse->fetchAll();
echo '<pre>';
print_r($donnees);
echo  '</pre>';



?>
