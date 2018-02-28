<?php
require 'notouch/sqlconnect.php';
$table = "hiking";

$req = $bdd->prepare('SELECT * FROM '.$table);
$req->execute(array());
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <table width=75% >
      <tr>
        <th>Randonnée</th>
        <th>Difficulté</th>
        <th>Dst.</th>
        <th>Dur.</th>
        <th>Déniv.+</th>
      </tr>
      <?php
      while ($data = $req->fetch())
      {
      ?>
      <tr>
        <td><a href="update.php?id=<?php echo $data['id']; ?>"><?php echo $data['name']; ?></a></td>
        <td><?php echo $data['difficulty']; ?></td>
        <td><?php echo $data['distance']." km"; ?></td>
        <td><?php echo $data['duration']; ?></td>
        <td><?php echo $data['height_difference']." m"; ?></td>
      </tr>
      <?php
      }
      $req->closeCursor();
      ?>
    </table>
    <p><a href="create.php">Ajouter des données</a></p>
  </body>
</html>
