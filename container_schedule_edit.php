<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * FROM bill_item AS A
							WHERE bit_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_reefer_con   =$_POST['txt_bit_reefer_con'];
			$v_bit_truck_no  =$_POST["txt_bit_truck_no"];
							// get vendor name
							$set_id=$v_reefer_con + $v_bit_truck_no;
							$sql_name = "SELECT * FROM truck_number AS A
										LEFT JOIN truck AS TR ON TR.tr_id=A.tnum_truck_id
										WHERE tnum_id = $set_id";
							$result_name = mysqli_query($connect, $sql_name);
							$row_name = mysqli_fetch_array($result_name);
							$get_name = $row_name['tr_name'];	
			$v_bit_ap_trucking_vendor  =$get_name;
			$v_bit_delivery_date    =$_POST["txt_bit_delivery_date"];

			$sql = "UPDATE bill_item SET bit_reefer_con = '$v_reefer_con'
										, bit_truck_no = '$v_bit_truck_no' 
										, bit_ap_trucking_vendor = '$v_bit_ap_trucking_vendor' 
										, bit_delivery_date = '$v_bit_delivery_date'
									WHERE bit_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:container_schedule_edit.php?id=$id");
	}
	if(isset($_POST["btnreset"])){
		$id = $_GET["id"];
		$v_bit_reefer_con = 0;
		$v_bit_truck_no = 0;
		$v_bit_ap_trucking_vendor = '';
	
		$sql = "UPDATE bill_item SET bit_reefer_con = '$v_bit_reefer_con'
									,bit_truck_no = '$v_bit_truck_no'
									, bit_ap_trucking_vendor = '$v_bit_ap_trucking_vendor'  
									WHERE bit_id = '$id'" ;
		mysqli_query($connect, $sql);
		header("location:container_schedule_edit.php?id=$id");
	}

?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Truck Schedule</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								
		                        <div class="form-group col-xs-12">
									<label for ="">Reefer Con:</label> 
										<?php
											if($row['bit_reefer_con']==0 and $row['bit_truck_no']==0){
										?>
											                                 
												<select class = "form-control select2"  name = "txt_bit_reefer_con" >
												<?php
													$v_select = mysqli_query($connect,"SELECT * FROM truck_number ORDER BY tnum_id ASC ");
															while ($get_select = mysqli_fetch_assoc($v_select)) {  
														if($row['bit_reefer_con'] == $get_select['tnum_id']){
												?>
														<option selected="selected" value="<?php echo $get_select['tnum_id']; ?>"><?php echo $get_select['tnum_number']; ?></option>
												<?php
														}else{
												?>
														<option value="<?php echo $get_select['tnum_id']; ?>"><?php echo $get_select['tnum_number']; ?></option>
												<?php
														}   
													}
												?>    
												</select>
										<?php
											}elseif($row['bit_reefer_con']>0){
										?>
											<select class = "form-control select2"  name = "txt_bit_reefer_con" >
												<?php
													$v_select = mysqli_query($connect,"SELECT * FROM truck_number ORDER BY tnum_id ASC ");
															while ($get_select = mysqli_fetch_assoc($v_select)) {  
														if($row['bit_reefer_con'] == $get_select['tnum_id']){
												?>
														<option selected="selected" value="<?php echo $get_select['tnum_id']; ?>"><?php echo $get_select['tnum_number']; ?></option>
												<?php
														}else{
												?>
														<option value="<?php echo $get_select['tnum_id']; ?>"><?php echo $get_select['tnum_number']; ?></option>
												<?php
														}   
													}
												?>    
												</select>
										<?php
											}
										?>
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Truck No:</label> 
										<?php
											if($row['bit_reefer_con']==0 and $row['bit_truck_no']==0){
										?>												
													<select class = "form-control select2" id="txt2" name = "txt_bit_truck_no" >
													<?php
														$v_select = mysqli_query($connect,"SELECT * FROM truck_number ORDER BY tnum_id ASC ");
																while ($get_select = mysqli_fetch_assoc($v_select)) {  
															if($row['bit_truck_no'] == $get_select['tnum_id']){
													?>
															<option selected="selected" value="<?php echo $get_select['tnum_id']; ?>"><?php echo $get_select['tnum_number']; ?></option>
													<?php
															}else{
													?>
															<option value="<?php echo $get_select['tnum_id']; ?>"><?php echo $get_select['tnum_number']; ?></option>
													<?php
															}   
														}
													?>    
													</select>
										<?php
											}elseif($row['bit_truck_no']>0){
										?>
													<select class = "form-control select2" id="txt2" name = "txt_bit_truck_no" >
													<?php
														$v_select = mysqli_query($connect,"SELECT * FROM truck_number ORDER BY tnum_id ASC ");
																while ($get_select = mysqli_fetch_assoc($v_select)) {  
															if($row['bit_truck_no'] == $get_select['tnum_id']){
													?>
															<option selected="selected" value="<?php echo $get_select['tnum_id']; ?>"><?php echo $get_select['tnum_number']; ?></option>
													<?php
															}else{
													?>
															<option value="<?php echo $get_select['tnum_id']; ?>"><?php echo $get_select['tnum_number']; ?></option>
													<?php
															}   
														}
													?>    
													</select>
										<?php
											}
										?>

								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">AP Truck Vendor:</label>
									
											<input class="form-control" readonly name="txt_bit_ap_trucking_vendor" type="text" 
											value="<?php echo $row["bit_ap_trucking_vendor"] ?>"
											>
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Delivery Date:</label>                                          
		                       		<input class="form-control" name="txt_bit_delivery_date" type="date" value="<?php echo $row["bit_delivery_date"] ?>"> 
		                        </div>
								
								<div class="form-group col-xs-12">
									<button type="submit" value="btnreset" name="btnreset" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Show Text</button>
									&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 

									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="container_schedule.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Close</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
<?php include 'footer_v1.php';?>