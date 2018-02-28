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
  //  $req = $bdd->query('SELECT * FROM '.$table.' WHERE id='.$id);
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
    <title>Modifier la randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <a href="read.php">Liste des données</a>
    <h1>Modifier</h1>
    <form action="" method="post">
      <div>
        <input type="hidden" name="id" id="id" value="<?php if ($get) { echo $id; } ?>" >
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php if ($get) { echo $name; } ?>">
      </div>

      <div>
        <label for="difficulty">Difficulté</label>
        <select name="difficulty">
          <option value="très facile" <?php if ( ($get) && ($difficulty == "très facile") ) { echo "selected"; } ?>>Très facile</option>
          <option value="facile" <?php if ( ($get) && ($difficulty == "facile") ) { echo "selected"; } ?>>Facile</option>
          <option value="moyen" <?php if ( ($get) && ($difficulty == "moyen") ) { echo "selected"; } ?>>Moyen</option>
          <option value="difficile" <?php if ( ($get) && ($difficulty == "difficile") ) { echo "selected"; } ?>>Difficile</option>
          <option value="très difficile" <?php if ( ($get) && ($difficulty == "très difficile") ) { echo "selected"; } ?>>Très difficile</option>
        </select>
      </div>

      <div>
        <label for="distance">Distance</label>
        <input type="number" step="0.01" name="distance"  value="<?php if ($get) { echo $distance; } ?>">
      </div>
      <div>
        <label for="duration">Durée</label>
        <input type="time" name="duration"  value="<?php if ($get) { echo $duration; } ?>">
      </div>
      <div>
        <label for="height_difference">Dénivelé</label>
        <input type="number" name="height_difference"  value="<?php if ($get) { echo $height_difference; } ?>">
      </div>
      <button type="submit" name="button">Envoyer</button>
    </form>
    <p></p>
    <?php
    if ($succes){
      echo '<p style="color: #00862c;">La randonnée a été modifiée avec succès.</p>';
    }
    ?>
  </body>
</html>
