<?php 
if(!isset($_COOKIE["login"]))
{
 header("location:index.php");
}
?>

<?php
include("db.php");
$refrigerateurId = '';
$min_temperature= '';
$max_temperature= '';

if  (isset($_GET['id'])) {
  $refrigerateur_id = $_GET['id'];
  $refrigerateur_code = $_GET['code'];
}

?>
<?php include('includes/header.php'); ?>


<div class="container p-4">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="card">
	  
		  <div class="card-header text-center">
			Temperatures Enregistrees - Refrigerateur: <?php echo $refrigerateur_code; ?>
		  </div>
		  <div class="card-body">
			  <form>
				<table class="table table-bordered table-striped" >
				 <thead class="thead-dark">
				  <tr class="text-center">
					<th>Min</th>
					<th>Max</th>
					<th>Datetime</th>
					<th>Refrigerateur Id</th>
				  </tr>
				</thead>
				<tbody id="myTable">
				  <?php
				  $query = "select * from refrigerateur_temperature rt left join refrigerateur r on rt.refrigerateur_id = r.id where r.id=".$refrigerateur_id." order by rt.date_time desc;";
				  $result_temperature = mysqli_query($conn, $query);    

				  while($row = mysqli_fetch_assoc($result_temperature)) { ?>
				  <tr>
					<td class="text-center"><?php echo $row['min_temperature']; ?></td>
					<td class="text-center"><?php echo $row['max_temperature']; ?></td>
					<td class="text-center"><?php echo $row['date_time']; ?></td>
					<td class="text-center"><?php echo $row['refrigerateur_id']; ?></td>
				  </tr>
				  <?php } ?>
		    
				</tbody>
			  </table>
			  </form>
			</div>
      </div>
    </div>
  </div>
</div>


<?php include('includes/footer.php'); ?>
