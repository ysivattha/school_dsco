<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from trucking_unload where tu_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_border = $_POST["txt_border"];
			$v_code = $_POST["txt_code"];
			$v_ctnr = $_POST["txt_ctnr"];
			$v_type = $_POST["txt_type"];
			$v_eta = $_POST["txt_eta"];
			$v_qty = $_POST["txt_qty"];
			$v_gw = $_POST["txt_gw"];
			$v_cbm = $_POST["txt_cbm"];

			$sql = "UPDATE trucking_unload SET tu_border_id = '$v_border'
												,tu_code = '$v_code'
												,tu_ctnr = '$v_ctnr'
												,tu_type = '$v_type'
												,tu_eta = '$v_eta'
												,tu_qty = '$v_qty'
												,tu_gw = '$v_gw'
												,tu_cbm = '$v_cbm'
											WHERE tu_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:trucking_unload.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary"> Edit Trucking and Unload </h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								<div class="form-group col-xs-6">
		                            <label for ="">Border:</label>
									   <select class="form-control" name="txt_border" >
										<?php
											$select1 = "SELECT * FROM border";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['tu_border_id']==$row1['bo_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['bo_id']; ?>"><?= $row1['bo_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Code:</label>
									   <select class="form-control" name="txt_code" >
										<?php
											$select1 = "SELECT * FROM customer";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['tu_code']==$row1['cus_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['cus_id']; ?>"><?= $row1['cus_num_id']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">CTNR:</label>                                          
		                       		<input class="form-control" name="txt_ctnr" type="text" value="<?php echo $row["tu_ctnr"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Type:</label>
									   <select class="form-control" name="txt_type" >
										<?php
											$select1 = "SELECT * FROM container_type";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['tu_type']==$row1['cont_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['cont_id']; ?>"><?= $row1['cont_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">ETA:</label>                                          
		                       		<input class="form-control" name="txt_eta" type="date" value="<?php echo $row["tu_eta"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">QTY:</label>                                          
		                       		<input class="form-control" name="txt_qty" type="number" value="<?php echo $row["tu_qty"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">GW:</label>                                          
		                       		<input class="form-control" name="txt_gw" type="number" value="<?php echo $row["tu_gw"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">CBM:</label>                                          
		                       		<input class="form-control" name="txt_cbm" type="number" value="<?php echo $row["tu_cbm"]?>">
		                        </div>
								
		                        
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="trucking_unload.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>