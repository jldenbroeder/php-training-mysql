<?php
require 'notouch/sqlconnect.php';
$table = "hiking";
$succes = false;
if (isset($_POST['button'])){
  if (isset($_POST['name'])){ $name = htmlspecialchars($_POST['name']); }
  else{ $name = ""; }
  if (isset($_POST['difficulty'])){ $difficulty = htmlspecialchars($_POST['difficulty']); }
  else{ $difficulty = ""; }
  if (isset($_POST['distance'])){ $distance = htmlspecialchars($_POST['distance']); }
  else{ $distance = ""; }
  if (isset($_POST['duration'])){ $duration = htmlspecialchars($_POST['duration']); }
  else{ $duration = ""; }
  if (isset($_POST['height_difference'])){ $height_difference = htmlspecialchars($_POST['height_difference']); }
  else{ $height_difference = ""; }

  $req = $bdd->prepare('INSERT INTO '.$table.'
  (name, difficulty, distance, duration, height_difference) 
  VALUES 
  (:name, :difficulty, :distance, :duration, :height_difference)
  ');
  $req->execute(array(
    'name' => $name,
    'difficulty' => $difficulty,
    'distance' => $distance,
    'duration' => $duration,
    'height_difference' => $height_difference
  ));
  $succes = true;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ajouter une randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <a href="read.php">Liste des données</a>
    <h1>Ajouter</h1>
    <form action="" method="post">
      <div>
        <label for="name">Name</label>
        <input type="text" name="name" value="">
      </div>

      <div>
        <label for="difficulty">Difficulté</label>
        <select name="difficulty">
          <option value="très facile">Très facile</option>
          <option value="facile">Facile</option>
          <option value="moyen">Moyen</option>
          <option value="difficile">Difficile</option>
          <option value="très difficile">Très difficile</option>
        </select>
      </div>

      <div>
        <label for="distance">Distance</label>
        <input type="number" step="0.01" name="distance" value="">
      </div>
      <div>
        <label for="duration">Durée</label>
        <input type="time" name="duration" value="">
      </div>
      <div>
        <label for="height_difference">Dénivelé</label>
        <input type="number" name="height_difference" value="">
      </div>
      <button type="submit" name="button">Envoyer</button>
    </form>
    <p></p>
    <?php
    if ($succes){
      echo '<p style="color: #00862c;">La randonnée a été ajoutée avec succès.</p>';
    }
    ?>
  </body>
</html>
