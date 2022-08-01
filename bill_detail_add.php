<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
	$month = date('Y-m');

	if(isset($_POST["btnadd"])){
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
		$bill_id = $_GET["bill_id"];

		$sql = "INSERT INTO bill_item (bit_con_no
								, bit_seal_no 
								, bit_cont_type 
								, bit_commodity
								, bit_qty
								, bit_pack_type
								, bit_gw
								, bit_cbm
								, bit_destination
								, bit_truck_no_vn
								, bit_note
								, bit_note1
								, bit_note2
								, bit_datetime
								, bit_bill_id
											)
							VALUES
								('$v_con_no'
								, '$v_seal_no'
								, '$v_cont_type'
								, '$v_commodity'
								, '$v_qty'
								, '$v_pack_type'
								, '$v_gw'
								, '$v_cbm'
								, '$v_destination'
								, '$v_truck_no_vn'
								, '$v_note'
								, '$v_note1'
								, '$v_note2'
								, '$datetime'
								, '$bill_id'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header("location:bill_detail.php?id='$id' ");
		}
		
	}

?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
					<?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete Data</h4>';
                      echo '</div>';
                    }
                    ?>
		</div>
            <div class="panel panel-default">
                	<div class="panel-body"><h2 class="text-primary">Add Item</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">  
							<input type = "hidden" name = "id" value = "<?php echo $_GET["bill_id"]; ?>">        
								
								<div class="form-group col-xs-6">
		                            <label for ="">Con No:</label>                                          
		                       		<input class="form-control" name="txt_con_no" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Seal No:</label>                                          
		                       		<input class="form-control" name="txt_seal_no" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Container Type:</label> 
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
		                       		<input class="form-control" name="txt_commodity" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">QTY:</label>                                          
		                       		<input class="form-control" name="txt_qty" type="number" >
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
		                       		<input class="form-control" name="txt_gw" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">CBM:</label>                                          
		                       		<input class="form-control" name="txt_cbm" type="text" >
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
		                       		<input class="form-control" name="txt_truck_no_vn" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Note1:</label>                                          
		                       		<input class="form-control" name="txt_note1" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Note2:</label>                                          
		                       		<input class="form-control" name="txt_note2" type="text" >
		                        </div>

								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="bill.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
									
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
