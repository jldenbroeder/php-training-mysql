<?php
require 'notouch/sqlconnect.php';
$table = "hiking";
$get = false;
$succes = false;
if (isset($_POST['button'])){
  $id = $_POST['id'];
  if (isset($_POST['name'])){ $name = $_POST['name']; }
  else{ $name = ""; }
  if (isset($_POST['difficulty'])){ $difficulty = $_POST['difficulty']; }
  else{ $difficulty = ""; }
  if (isset($_POST['distance'])){ $distance = $_POST['distance']; }
  else{ $distance = ""; }
  if (isset($_POST['duration'])){ $duration = $_POST['duration']; }
  else{ $duration = ""; }
  if (isset($_POST['height_difference'])){ $height_difference = $_POST['height_difference']; }
  else{ $height_difference = ""; }

  $req = $bdd->prepare('UPDATE '.$table.' SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference WHERE id = :id');

  $req->execute(array(
    'id' => $id,
    'name' => $name,
    'difficulty' => $difficulty,
    'distance' => $distance,
    'duration' => $duration,
    'height_difference' => $height_difference
  ));
  $succes = true;
}

if (isset($_GET['id']))
{
  $get = true;
  $id = $_GET['id'];
  $req = $bdd->prepare('SELECT * FROM '.$table.' WHERE id= :id');
  $req->execute(array(
    'id' => $id
  ));
  $data = $req->fetch();
  $name = $data['name'];
  $difficulty = $data['difficulty'];
  $distance = $data['distance'];
  $duration = $data['duration'];
  $height_difference = $data['height_difference'];
  $req->closeCursor();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Supprimer la randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <a href="read.php">Retour à la liste des données</a>
    <h1>Supprimer</h1>
    <form action="" method="post">
      <div>
<?php if ($get) { 
  echo $name."<br />"; 
    echo $difficulty."<br />"; 
    echo $distance."<br />"; 
    echo $duration."<br />"; 
    echo $height_difference; 
} 
        ?>
      </div>
      <button type="submit" name="button">Confirmer la suppression</button>
    </form>
  </body>
</html>
