<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$bill_id = $_GET["bill_id"];
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from bill_item where bit_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_con_no   =$_POST['txt_con_no'];
			$v_seal_no =$_POST["txt_seal_no"];
			$v_cont_type  =$_POST["txt_cont_type"];
			$v_commodity   =$_POST["txt_commodity"];
			$v_qty   =$_POST["txt_qty"];
			$v_pack_type   =$_POST["txt_pack_type"];
			$v_gw     =$_POST["txt_gw"];
			$v_cbm =$_POST["txt_cbm"];
			$v_destination =$_POST["txt_destination"];
			$v_truck_no_vn =$_POST["txt_truck_no_vn"];
			$v_note =$_POST["txt_note"];
			$v_note1 =$_POST["txt_note1"];
			$v_note2 =$_POST["txt_note2"];
			$datetime = date('Y-m-d H:i:s');

			$sql = "UPDATE bill_item SET bit_con_no = '$v_con_no'
										, bit_seal_no = '$v_seal_no' 
										, bit_cont_type = '$v_cont_type' 
										, bit_commodity = '$v_commodity' 
										, bit_qty = '$v_qty'
										, bit_pack_type = '$v_pack_type' 
										, bit_gw = '$v_gw'
										, bit_cbm = '$v_cbm'
										, bit_destination = '$v_destination'
										, bit_truck_no_vn= '$v_truck_no_vn'
										, bit_note= '$v_note'
										, bit_note1= '$v_note1'
										, bit_note2= '$v_note2'
										, bit_datetime = '$datetime'
									WHERE bit_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:bill_detail.php?id=$bill_id");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Bill Item</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">         
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>"> 
								<div class="form-group col-xs-6">
		                            <label for ="">Con No:</label>                                          
		                       		<input class="form-control" name="txt_con_no" type="text" value="<?php echo $row["bit_con_no"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Seal No:</label>                                          
		                       		<input class="form-control" name="txt_seal_no" type="text" value="<?php echo $row["bit_seal_no"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Cont Type:</label>                                          
									<select class="form-control"  name="txt_cont_type">
										<?php
											$select1 = "SELECT * FROM container_type";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bit_cont_type']==$row1['cont_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['cont_id']; ?>"><?= $row1['cont_name']; ?></option>
										<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-xs-6">
		                            <label for ="">Commodity:</label>                                          
		                       		<input class="form-control" name="txt_commodity" type="text" value="<?php echo $row["bit_commodity"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">QTY:</label>                                          
		                       		<input class="form-control" name="txt_qty" type="number" value="<?php echo $row["bit_qty"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Pcak Type:</label>                                          
									<select class="form-control"  name="txt_pack_type">
										<?php
											$select1 = "SELECT * FROM package_type";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bit_pack_type']==$row1['pa_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['pa_id']; ?>"><?= $row1['pa_name']; ?></option>
										<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-xs-6">
		                            <label for ="">GW:</label>                                          
		                       		<input class="form-control" name="txt_gw" type="text" value="<?php echo $row["bit_gw"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">CBM:</label>                                          
		                       		<input class="form-control" name="txt_cbm" type="text" value="<?php echo $row["bit_cbm"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Destination:</label> 
									<select class="form-control"  name="txt_destination">
										<?php
											$select1 = "SELECT * FROM destination";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bit_destination']==$row1['de_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['de_id']; ?>"><?= $row1['de_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Truck No VN:</label>                                          
		                       		<input class="form-control" name="txt_truck_no_vn" type="text" value="<?php echo $row["bit_truck_no_vn"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["bit_note"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Note1:</label>                                          
		                       		<input class="form-control" name="txt_note1" type="text" value="<?php echo $row["bit_note1"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Note2:</label>                                          
		                       		<input class="form-control" name="txt_note2" type="text" value="<?php echo $row["bit_note2"]?>">
		                        </div>
								
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="bill_detail.php?id=<?php echo $bill_id ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>