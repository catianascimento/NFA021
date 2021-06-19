<?php include("db.php"); 
?>

<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php
$tableContent = '';
$filter = '';

$selectStmt = $conn->query('select *, sp.id sp_id, p.id p_id from stock_produit sp join produit p on sp.produit_id = p.id');

$stocks = $selectStmt->fetch_all(MYSQLI_ASSOC);
foreach ($stocks as $stock)
{
    $tableContent = $tableContent.'<tr>'.
            '<td class="text-center">'.$stock['date_dinsertion'].'</td>'
            .'<td class="text-center">'.$stock['quantite'].'</td>'
			.'<td class="text-center">'.$stock['status'].'</td>'
			.'<td class="text-center">'.$stock['nom'].'</td>'
			.'<td class="text-center"><a href="edit_stock.php?id='.$stock['sp_id'].'" class="btn btn-outline-info btn-rounded waves-effect">
                <i class="fas fa-marker"></i>
              </a>
			  
			  <a href="delete_stock_produit.php?id='.$stock['sp_id'].'" class="btn btn-outline-danger btn-rounded waves-effect">
                <i class="far fa-trash-alt"></i>
              </a></td>';
}

if(isset($_POST['search']))
{
	//$date_dinsertion = $_POST['date_dinsertion'];
	$filter = $_POST['filter'];
	
	$tableContent = '';
	if($filter=='ALL'){
		$selectStmt = $conn->query('select *, sp.id sp_id, p.id p_id  from stock_produit sp join produit p on sp.produit_id = p.id');
	}else{
		$selectStmt = $conn->query("select *, sp.id sp_id, p.id p_id  from stock_produit sp join produit p on sp.produit_id = p.id where DATE_ADD(sp.date_dinsertion , INTERVAL p.duree_de_conservation_en_jours DAY)<NOW()");
	}
		
	$stocks = $selectStmt->fetch_all(MYSQLI_ASSOC);
	foreach ($stocks as $stock)
	{
		$tableContent = $tableContent.'<tr>'.
			'<td class="text-center">'.$stock['date_dinsertion'].'</td>'
            .'<td class="text-center">'.$stock['quantite'].'</td>'
			.'<td class="text-center">'.$stock['status'].'</td>'
			.'<td class="text-center">'.$stock['nom'].'</td>'
			.'<td class="text-center"><a href="edit_stock.php?id='.$stock['sp_id'].'" class="btn btn-outline-info btn-rounded waves-effect">
                <i class="fas fa-marker"></i>
              </a>
			  
			  <a href="delete_stock_produit.php?id='.$stock['sp_id'].'" class="btn btn-outline-danger btn-rounded waves-effect">
                <i class="far fa-trash-alt"></i>
              </a></td>';
	}
   
}
?>

<?php include('includes/header.php'); ?>

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
	
	<div class="col-md-3">
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-outline-success btn-rounded waves-effect" data-toggle="modal" data-target="#stockModal" >
		  Add Stock
		</button>
	</div>
	</div>
	<div class="form-row">
		<form action="index_stock.php" method="POST">
			<div class="form-group col-md-12">
				<label for="filter">Filtrer : </label>  
				<select name="filter" id="filter">
					<option value="ALL">ALL</option>
					<option value="EXPIRED" <?php if($filter == 'EXPIRED'){echo 'selected';}?>>EXPIRED</option>
				</select>
				<input type="submit" name="search" value="OK">
			</div>
		</form>
	</div>
	<div class="col-md-12 table-responsive">
		<table class="table table-striped table-bordered table-sm" >
		<thead class="thead-dark">
			<tr class="text-center">
				<th>Date d'insertion</th>
				<th>Quantite</th>
				<th>Status</th>
				<th>Produit</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="myTable">
			<?php
				echo $tableContent;
			?>				  
		</tbody>
		</table>
	</div>

  
	  <!-- Modal -->
	<div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Ajouter Stock</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="card-body">
			  <form action="save_stock.php" method="POST">
				<div class="form-row row justify-content-between">
					<div class="form-group col">
					  <label for="quantite">Quantite:</label>
					  <input name="quantite" id="quantite" type="number" class="form-control form-control-sm" placeholder="Quantite">
					</div>
					
					<div class="form-group col-md-3">
						<label for="status">Status:</label>
						<select name="status" class="form-control form-control-sm" id="status">
							<option value="OK">OK</option>
							<option value="RETIRE">RETIRE</option>
						</select>
					</div>
				</div>
				<div class="form-row row justify-content-between">
				<div class="form-group col-md-7">
					<label for="produit">Produit:</label>
					<select class="form-control form-control-sm" aria-label="Default select example" name="produit" id="produit">
					<?php
						$query = "select * from produit";
						$result_produits = mysqli_query($conn, $query);    
						while($row = mysqli_fetch_assoc($result_produits)) { ?>
							<option value="<?php echo $row['id']; ?>"><?php echo $row['nom']; ?></option>
						<?php } ?>	
					</select>
				</div>
				</div>
				<div class="form-row text-center">
					<div class="form-row text-center">
					<div class="form-group col-md-12">
						<input type="submit" name="save_stock" class="btn btn-success btn-block" value="Save Stock">
					</div>
				</div>
				</div>
			  </form>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	
	<?php
		echo '<script>
		$(document).ready(function(){
		  $("#myInput").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#myTable tr").filter(function() {
			  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		  });
		});
		</script>';?>
</main>

<?php include('includes/footer.php'); ?>
