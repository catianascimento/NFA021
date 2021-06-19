<?php

if(isset($_COOKIE["roles"]))
{
	$roles = $_COOKIE["roles"];

	/*if ($roles == 2){
		print("EH ADMIN");
	}else{
		print($roles);
	}*/
	
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>PHP CRUD EXEMPLE</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
	<link rel="stylesheet" href="css/draganddrop.css">

    <!-- FONT AWESOEM -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
	<?php include('css/draganddrop.js'); ?>
	</script>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index_produit.php">Restaurant</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
		<ul class="nav navbar-nav navbar-left">
			<?php 
			if ($roles == 2){
				echo '<li class="nav-item">
				  <a class="nav-link" href="index_produit.php">Produits</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="index_categorie.php">Categories</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="index_utilisateur.php">Utilisateurs</a>
				</li>
				';
			}
			?>
			<li class="nav-item">
			  <a class="nav-link" href="index_stock.php">Stocks</a>
			</li>
			<li class="nav-item">
				  <a class="nav-link" href="index_refrigerateur.php">Refrigerateurs</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="index_log.php">Logs</a>
			</li>
		</ul>
	</div>
	<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
		<ul class="nav navbar-nav navbar-right ">
			<li class="nav-item">
				<form method="GET" action="index_produit.php">
					<?php
					if(isset($_GET["suppCookie"])){
						setCookie("login", "", -3600);
						setCookie("roles", "", -3600);
						header("location:index.php");
					}?>
				  <button type="submit" class="btn btn-link btn-logout" name="suppCookie">Logout</button>
				</form>
			</li>
	    </ul>
    </div>
  </div>
</nav>
