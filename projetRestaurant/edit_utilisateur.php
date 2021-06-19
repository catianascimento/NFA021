<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php
include("db.php");
$adresse_mail = '';
$login= '';
$mot_de_passe= '';
$nom= '';
$prenom ='';

if  (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "select * from utilisateur u WHERE id=$id";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $adresse_mail = $row['adresse_mail'];
	$login = $row['login'];
    $mot_de_passe = $row['mot_de_passe'];
	$nom = $row['nom'];
	$prenom = $row['prenom'];
	$role = $row['role_id'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $nom= $_POST['nom'];
  $prenom= $_POST['prenom'];
  $mot_de_passe= $_POST['mot_de_passe'];
  $adresse_mail= $_POST['adresse_mail'];
  $login = $_POST['login'];
  $role = $_POST['role'];

  $query = "UPDATE utilisateur set nom = '$nom', prenom = '$prenom', mot_de_passe = '$mot_de_passe', adresse_mail = '$adresse_mail', login = '$login', role_id = $role WHERE id=$id";
  mysqli_query($conn, $query); 
  
  $_SESSION['message'] = 'mise à jour ok';
  $_SESSION['message_type'] = 'attention';
  header('Location: index_utilisateur.php');
}

?>
<?php include('includes/header.php'); ?>
<div class="container p-4">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="card">
	  
		  <div class="card-header text-center">
			Edit Utilisateur
		  </div>
		  <div class="card-body">
			  <form action="edit_utilisateur.php?id=<?php echo $_GET['id']; ?>" method="POST">
				<div class="form-row">
						<div class="form-group col-md-6">
						  <label for="nom">Nom:</label>
						  <input name="nom" type="text" class="form-control form-control-sm" placeholder="Nom" value="<?php echo $nom; ?>">
						</div>
						<div class="form-group col-md-6">
						  <label for="prenom">Prenom:</label>
						  <input name="prenom" type="text" class="form-control form-control-sm" placeholder="Prenom" value="<?php echo $prenom; ?>">
						</div>
				</div>
				<div class="form-row">
						<div class="form-group col">
						  <label for="adresse_mail">Adresse mail:</label>
						  <input name="adresse_mail" type="text" class="form-control form-control-sm" placeholder="Email" value="<?php echo $adresse_mail; ?>">
						</div>
						
						<div class="form-group col">
						  <label for="login">Login:</label>
						  <input name="login" type="text" class="form-control form-control-sm" placeholder="Login" value="<?php echo $login; ?>">
						</div>
						<div class="form-group col">
						  <label for="mot_de_passe">Mot de passe:</label>
						  <input name="mot_de_passe" type="password" class="form-control form-control-sm" placeholder="Mot de passe" value="<?php echo $mot_de_passe; ?>">
						</div>				
				</div>
				<div class="form-row">
						<div class="form-group col-md-6">
						    <label for="role">Role:</label>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="role" id="admin" value="2" <?php if($role==2){ echo 'checked';} ?>>
							  <label class="form-check-label" for="admin">Admin</label>
							</div>
							<div class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" name="role" id="utilisateur" value="1" <?php if($role==1){echo 'checked';}?>>
							  <label class="form-check-label" for="utilisateur">Utilisateur</label>
							</div>
						</div>
				</div>
				<div class="form-row text-center">
					<div class="form-group col-md-12">
						<button class="btn-success" name="update">
							Update
						</button>
					</div>
				</div>	
				
				</form>
			</div>
      </div>
    </div>
  </div>
</div>


<?php include('includes/footer.php'); ?>
