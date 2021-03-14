<?php 	

	$pokemon = file_get_contents('https://pokeapi.co/api/v2/pokemon/'. $_GET['id']);
    $jsonPokemon = json_decode($pokemon);

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
 		<br>
 		<br>
 		<a href="index.php" class="btn btn-success">VER TODOS LOS POKEMONS</a>
 		<br><br>
 		<h1><?php echo $jsonPokemon->name; ?></h1>
 		<br>
 		<h2>Experiencia Inicial: <?php echo $jsonPokemon->base_experience; ?></h2>
 		<br>
 		<h2>Altura: <?php echo $jsonPokemon->height; ?></h2>
 		<br>
 		<h2>Peso: <?php echo $jsonPokemon->weight ?></h2>
 		<br>
 		<img src="<?php echo $jsonPokemon->sprites->front_default ?>">
 		<img src="<?php echo $jsonPokemon->sprites->back_default ?>">
 		<br><br>
 		<h2>Habilidades</h2>
 		<?php 
 			for ($i=0; $i < count($jsonPokemon->abilities) ; $i++) { 
          
          		echo"<li>";
          		echo  $jsonPokemon->abilities[$i]->ability->name ;
          		echo "</li>";    
        	}
 	 	?>
 	</div>
 </body>
</html>