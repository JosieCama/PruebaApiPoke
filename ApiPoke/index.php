<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }

    $pokemons = file_get_contents('https://pokeapi.co/api/v2/pokemon/?offset=0&limit=1118');
    $jsonPokemons = json_decode($pokemons);
    
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pokemon API</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container my-4">
      <?php require 'header.php' ?>
      <?php if(!empty($user)): ?>
        <br> <h2>Bienvenido: <?= $user['email']; ?></h2>
        <a href="logout.php"><h5>SALIR</h5></a> 
        <?php else: ?>
          <h1>Por favor ingrese o registrese</h1>
        <a href="login.php">Ingresar</a> o
        <a href="signup.php">Registrarse</a>
      <?php endif; ?>
      <?php if(!empty($user)): ?>
        <div class="list-group ">
          <?php 
            for ($i=0; $i < $jsonPokemons->count ; $i++) { 
              $id = str_replace('https://pokeapi.co/api/v2/pokemon/', '', $jsonPokemons->results[$i]->url);
              $id = str_replace('/', '', $id);
              echo "<a href='pokemon.php?id=$id'class='list-group-item list-group-item-action list-group-item-success'>" . $jsonPokemons->results[$i]->name . "</a>";
            }
          ?>
          <?php endif; ?>
        </div>
    </div>
    
  </body>
</html>