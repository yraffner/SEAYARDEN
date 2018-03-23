<html>
<head>
  <meta charset="utf-8" />
</head>
<body>
  <?php

  $variable = 1;
  echo($variable)."<br>";
  $variable2 = $variable + 1;
  echo($variable2);
  try{
    $bdd = new PDO('mysql:host =localhost;dbname=sea;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch(Exception $e)
  {
    die('error: ' . $e->getMessage());
  }
  ?>
</body>
</html>
