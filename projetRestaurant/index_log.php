<?php include("db.php"); ?>
<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>
<?php include('includes/header.php'); 
echo '';
?>

<?php
$result = mysqli_query($conn, "SELECT count(*) FROM historique;");

$nombreDeLignes = mysqli_fetch_array($result)[0];

// Libérer de la mémoire
mysqli_free_result($result);

// Pagination
$page = 1;
$taillePage = 10;

if(isset($_GET["page"])){
	$page = $_GET["page"];
}

$decal = ($page - 1) * $taillePage;

$tri = "login";
$triSens = "ASC";

if(isset($_GET["tri"])){
	if($_GET["tri"] == 1){
		$tri = "login";
	}
	else if($_GET["tri"] == 2){
		$tri = "action";
	}
}

if(isset($_GET["sens"])){
	if($_GET["sens"] == 1){
		$triSens = "ASC";
	}
	else {
		$triSens = "DESC";
	}
}

$filtre = "";
$filtreLog = "";

if(isset($_POST["filtre"])){
	print($_POST["filtre"]);
	$filtreLog = $_POST["filtre"];
	
	if($filtreLog != ""){
		$filtre = "WHERE u.login LIKE '%$filtreLog%'";
	}
}

$sql = "SELECT * FROM historique hist left join utilisateur u on hist.utilisateur_id = u.id $filtre ORDER BY $tri $triSens LIMIT $taillePage OFFSET $decal;";

$result = mysqli_query($conn, $sql);
$nbrePages = ceil($nombreDeLignes / $taillePage);

if($nombreDeLignes == 0){
	echo "<div>Aucun produit à afficher.</div>";
}
else {
}
?>

<main class="container">
  <br>
  <div class="row">
    <div class="col-md-9">
      <!-- MESSAGES -->
      <?php if (isset($_SESSION['message'])) { ?>
      <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
        <?= $_SESSION['message']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php session_unset(); } ?>
    </div>
	</div>
  <br>
  <p>Filtrer : </p>  
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  
  
  <div class="row">
    <div class="col-md-12 table-responsive">
      <table class="table table-striped table-bordered table-sm " id='pagination'>
        <thead class="thead-dark">
          <tr class="text-center">
            <th>Utilisateur    <a href='./index_log.php?tri=1&sens=1'>A-Z</a> <a href='./index_log.php?tri=1&sens=2'>Z-A</a></th>
			<th>Action    <a href='./index_log.php?tri=2&sens=1'>A-Z</a> <a href='./index_log.php?tri=2&sens=2'>Z-A</a></th>
			<th>Date and Time    <a href='./index_log.php?tri=3&sens=1'>A-Z</a> <a href='./index_log.php?tri=3&sens=2'>Z-A</a></th>
          </tr>
        </thead>
		 <?php
			echo "<tr class='text-center'>";
			echo "<td><input type='text' name='filtre' value='$filtre'/><input type='submit' value='Filtrer'/></td>";
			echo "<td></td>";
			echo "<td></td>";
			echo "</tr>";
            echo "<tr class='text-center'>";
			while ($ligne = mysqli_fetch_assoc($result)) {
				$login = $ligne["login"];
				$action = $ligne["action"];
				$datetime = $ligne["date_and_time"];
				
				echo "<td class='text-center'>$login</td>";
				echo "<td class='text-center'>$action</td>";
				echo "<td class='text-center'>$datetime</td>";
				echo "<tr class='text-center'>";
			}
          ?>		  
        </tbody>	
		<nav aria-label="Page navigation example">
		  <ul class="pagination float-right">
		    <?php
			for($i=1;$i<=$nbrePages;$i++){
						echo "<li class='page-item'><a class='page-link' href='./index_log.php?page=$i'>$i</a></li>";
					}?>
		  </ul>
		</nav>
    </table>
    </div>
	
  </div>
  
	  <!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Ajouter Produit</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form action="save_produit.php" method="POST">
			 	<div class="form-row">
						<div class="form-group col-md-7">
						  <label for="nom">Nom:</label>
						  <input name="nom" type="text" class="form-control form-control-sm" placeholder="Nom">
						</div>
						<div class="form-group col-md-5">
							<legend class="col-form-label pt-0 col-sm-4">Status:</legend>
							<div class="col-sm-8">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="OK" checked>
									<label class="form-check-label" for="inlineRadio1">OK</label>
									
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="RETIRE">
									<label class="form-check-label" for="inlineRadio2">RETIRE</label>
								</div>
							</div>
						</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-9">
						<label for="categorie_id">Categorie:</label>
						<select class="form-control form-control-sm" aria-label="Default select example" name="categorie_id">
						<?php
							$query = "select * from categorie";
							$result_categories = mysqli_query($conn, $query);    
							while($row = mysqli_fetch_assoc($result_categories)) { ?>
								<option value="<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></option>
							<?php } ?>	
						</select>
					</div>
					<div class="form-group col-md-3">
					  <label for="duree">Conservation (heures):</label>
					  <input name="duree" type="number" class="form-control form-control-sm" placeholder="Duree">
					</div>
				</div>
				<div class="form-row text-center">
					<div class="form-group col-md-12">
						<input type="submit" name="save_produit" class="btn btn-success btn-block" value="Save Produit">
					</div>
				</div>
			  </form>
		  </div>
		</div>
	  </div>
	</div>
	
	<?php
		echo '<script>
		$(document).ready(function(){
		  $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#pagination tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
	
		</script>';
		
		?>
		
		
</main>

<?php include('includes/footer.php'); ?>
