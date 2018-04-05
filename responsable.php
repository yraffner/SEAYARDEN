<h1>Responsable de filière</h1>
<?php

include('connexion.php');
include('fonction.php');



?>
<table>
<tr>
<th>NOM</th>
<th>PRÉNOM</th>
<th>STATUT</th>
<th></th>
</tr>
<?php
$sql = "SELECT * FROM utilisateur";
$bdd->query($sql);
$reponse= $bdd->query($sql);
$donnees = $reponse->fetchAll();
foreach($donnees as $ligne){

echo "<tr>";
echo "<td>".$ligne["nom_user"]."<form method='post' name='btn_choix' action='form_user.php'><input type='hidden' name='id_user' value='".$ligne["id_user"]."'></td>";
echo "<td>".$ligne["prenom_user"]."</td>";
$email = $ligne["email"];
echo "<td>".retour_statut($email,$bdd)."</td>";
echo "<td><input type = 'submit' name='selectionner' value= 'Choisir'></form></td>";
echo"</tr>";

}
?>
</table>
<form method='post' name='add_user' action='add_user.php'><input type = 'submit' name='' value= 'ajouter'></form>

<?php
//var_dump($_POST);


/*echo '<pre>';
print_r($donnees);
echo  '</pre>';

$sql = "SELECT * FROM rdv";
$bdd->query($sql);
$reponse= $bdd->query($sql);
$donnees = $reponse->fetchAll();
echo '<pre>';
print_r($donnees);
echo  '</pre>';*/

?>
