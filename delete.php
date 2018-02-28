<?php
require 'notouch/sqlconnect.php';
$table = "hiking";
$get = false;

if (isset($_POST['button'])){
  $id = $_POST['id'];
  $req = $bdd->prepare('DELETE FROM '.$table.' WHERE id = :id');
  $req->execute(array(
    'id' => $id
  ));
  header('Location: read.php');
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
        <p>
          <?php if ($get) { 
  echo $name."<br />"; 
  echo "Difficulté: ".ucfirst($difficulty)."<br />"; 
  echo "Distance: ".$distance." km<br />"; 
  echo "Durée: ".$duration."<br />"; 
  echo "Dénivelé: ".$height_difference." m"; 
} 
          ?>
        </p>
        <input type="hidden" name="id" value="<?= $id ?>">
      </div>
      <button type="submit" name="button">Confirmer la suppression</button>
    </form>
  </body>
</html>
