<?php
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
