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

			$v_trucking = $_POST["txt_trucking"];
			$v_unload = $_POST["txt_unload"];
			$v_trucking_unload = $_POST["txt_trucking_unload"];
			$v_big_truck_customer = $_POST["txt_big_truck_customer"];
			$v_big_truck_unload = $_POST["txt_big_truck_unload"];
			$v_note = $_POST["txt_note"];

			$sql = "UPDATE trucking_unload SET tu_trucking = '$v_trucking'
												,tu_unload = '$v_unload'
												,tu_trucking_unload = '$v_trucking_unload'
												,tu_big_truck_customer = '$v_big_truck_customer'
												,tu_big_truck_unload = '$v_big_truck_unload'
												,tu_note = '$v_note'
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
                	<h2 class="text-primary"> Completed </h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								<div class="form-group col-xs-12">
		                            <label for ="">Trucking:</label>
									   <select class="form-control" name="txt_trucking" >
										<?php
											$select1 = "SELECT * FROM text_yes_no";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['tu_trucking']==$row1['tyn_name']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['tyn_name']; ?>"><?= $row1['tyn_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Unload:</label>
									   <select class="form-control" name="txt_unload" >
										<?php
											$select1 = "SELECT * FROM text_yes_no";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['tu_unload']==$row1['tyn_name']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['tyn_name']; ?>"><?= $row1['tyn_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Trucking and Unload:</label>
									   <select class="form-control" name="txt_trucking_unload" >
										<?php
											$select1 = "SELECT * FROM text_yes_no";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['tu_trucking_unload']==$row1['tyn_name']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['tyn_name']; ?>"><?= $row1['tyn_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Big Truck to Customer:</label>
									   <select class="form-control" name="txt_big_truck_customer" >
										<?php
											$select1 = "SELECT * FROM text_yes_no";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['tu_big_truck_customer']==$row1['tyn_name']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['tyn_name']; ?>"><?= $row1['tyn_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Big Truck and Unload:</label>
									   <select class="form-control" name="txt_big_truck_unload" >
										<?php
											$select1 = "SELECT * FROM text_yes_no";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['tu_big_truck_unload']==$row1['tyn_name']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['tyn_name']; ?>"><?= $row1['tyn_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["tu_note"]?>">
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