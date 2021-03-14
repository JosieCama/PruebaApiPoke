<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
  }
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    
    $message =  '';
    if (!$results) {
      
      $message = 'Lo siento, no se encontraron coincidencias';
      
    }else{
      
      if (count($results)<= 0) {
        $message = 'Lo siento, no se encontraron coincidencias';
        
      }else{
          
        if ($_POST['password'] == $results['password']) {
          $_SESSION['user_id'] = $results['id'];
          header("Location: index.php");
        } else {
          $message = 'Los siento, no se encontraron coincidencias';
        }
      }
      
    }
    
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ingresar</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="container">
      <?php require 'header.php' ?>

      <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
      <?php endif; ?>
      <h1>INGRESAR</h1>
      <span>O <a href="signup.php">REGISTRARSE</a></span>

      <form action="login.php" method="POST">
        <input name="email" type="text" placeholder="Ingresa tu correo electronico">
        <input name="password" type="password" placeholder="Ingresa tu contraseña">
        <input type="submit" value="Submit">
      </form>
    </div>
    
  </body>
</html>
