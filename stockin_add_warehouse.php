<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from bill_item where bit_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_name = $_POST["txt_name"];

			$sql = "UPDATE bill_item SET bit_warehouse_id = '$v_name'
									WHERE bit_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:stock_in.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary"> To warehouse </h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								<div class="form-group col-xs-12">
		                            <label for ="">Warehouse:</label>
									   <select class="form-control" name="txt_name" >
										<?php
											$select1 = "SELECT * FROM warehouse";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bit_warehouse_id']==$row1['wa_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['wa_id']; ?>"><?= $row1['wa_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
		                        
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="stock_in.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>