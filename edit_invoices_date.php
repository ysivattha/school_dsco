<?php
	include'config/db_connect.php';
	
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from invoice where transaction_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$date_sale = $_POST["date_sale"];

			$sql = "UPDATE invoice SET date_sell = '$date_sale'
										WHERE transaction_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:invoices.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Branch</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-12">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
		                            <label for ="">Date Sale:</label>                                          
		                       		<input class="form-control" required  name="date_sale" type="text" value = "<?php echo $row["date_sell"]?>">
		                        </div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Save</button>
									<a href="invoices.php" class="btn btn-danger">Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>