<?php include("db.php"); ?>

<?php

if(isset($_COOKIE["login"]))
{
 header("location:index_produit.php");
}

$message = '';
if(isset($_POST["login"]))
{
	$login = $_POST["user_email"];
	$mot_de_passe = $_POST["user_password"];
	if(empty($_POST["user_email"]) || empty($_POST["user_password"]))
	{
	  $message = "<div class='alert alert-danger'>Veuillez saisir le login et le mot de passe, svp!</div>";
	}
	else
	{
		$query = "SELECT * FROM utilisateur u WHERE u.login = '$login'";
		$utilisateurs = mysqli_query($conn, $query);   
	  
		$result = mysqli_fetch_assoc($utilisateurs);
		if(password_verify($mot_de_passe, $result['mot_de_passe'])){
			setcookie("login", $result['login'], time()+3600);
			setcookie("roles", $result['role_id'], time()+3600);
			header("location:index_produit.php");
		}
		else{
			$message = '<div class="alert alert-danger">Mot de passe incorrect</div>';
		}
	  }
	}


?>


<!DOCTYPE html>
<html>
 <head>
  <title>Projet Restaurant NFA021</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  <div class="container">
   
   <br />
	   <div class="row">	
		   <div class="col-md-5 col-md-offset-3">
		   <h2 align="center">Projet Restaurant NFA021</h2>
		   <br/>
		   <br/>
		   <br/>
			   <div class="panel panel-default">
				
				<div class="panel-heading ">Login</div>
				<div class="panel-body ">
				 <span><?php echo $message; ?></span>
				 <form method="post" >
				  <div class="form-group col-md-12">
				   <label>Login:</label>
				   <input type="text" name="user_email" id="user_email" class="form-control" />
				  </div>
				  <div class="form-group col-md-12">
				   <label>Mot de passe:</label>
				   <input type="password" name="user_password" id="user_password" class="form-control" />
				  </div>
				  <div class="form-group text-center col-md-12">
				   <input type="submit" name="login" id="login" class="btn btn-info" value="Login" />
				  </div>
				 </form>
				</div>
			   </div>
		   </div>
		</div>
   <br />
  
  </div>
 </body>
</html>
