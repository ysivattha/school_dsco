<?php
	include'config/db_connect.php'; 
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from tbl_wh_stock_in where whsi_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$v_date_record = $_POST["txt_date_record"];
			$v_letter_no = $_POST["txt_letter_no"];
			$v_product_code = $_POST["txt_product_code"];
			$v_product = $_POST["txt_product"];
			$v_qty_in = $_POST["txt_qty_in"];
			$v_cost = $_POST["txt_cost"];
			$v_price = $_POST["txt_price"];
			$v_unit = $_POST["txt_unit"];
			$v_received_from = $_POST["txt_received_from"];
   		    $v_employee = $_POST["txt_employee"];
   		    $v_expire_date = $_POST["txt_expire_date"];
   		    $v_note = $_POST["txt_note"];

			$sql = "UPDATE tbl_wh_stock_in SET whsi_date_record = '$v_date_record'
												, whsi_letter_no = '$v_letter_no' 
												, whsi_product_code = '$v_product_code' 
												, whsi_product = '$v_product' 
												, whsi_qty_in = '$v_qty_in' 
												, whsi_cost = '$v_cost' 
												, whsi_price = '$v_price' 
												, whsi_unit = '$v_unit' 
												, whsi_received_from = '$v_received_from' 
												, whsi_employee = '$v_employee' 
												, whsi_expire_date = '$v_expire_date' 
												, whsi_note = '$v_note' 
											WHERE whsi_id = '$id'" ;
			mysqli_query($connect, $sql);
			$connect->query("UPDATE product SET price_dolla='$v_price',price_riel='$v_cost' WHERE pro_id='$v_product_code'");
			header("location:wh_stock_in.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Warehouse Stock In</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
		                            <label for ="">Date Record:</label>                                          
		                       		<input class="form-control" required  name="txt_date_record" type="date" value = "<?php echo $row["whsi_date_record"]?>">
		                        </div>
		                        <div class="form-group col-xs-6">
                            <label for ="">Letter No:</label>                                          
                            <input class="form-control" required  name="txt_letter_no" type="text" value = "<?php echo $row["whsi_letter_no"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Product Code:</label>                                          
                                <select class = "form-control" name = "txt_product_code">
									<?php
										$v_select = mysqli_query($connect,"SELECT * FROM product");
										while ($row_select = mysqli_fetch_assoc($v_select)) { 
											if($row["whsi_product_code"] == $row_select["pro_id"]){
											?>
												<option selected="selected" value="<?php echo $row_select['pro_id']; ?>"><?php echo $row_select['code']." :: ".$row_select['ref'] ; ?></option>
											<?php
											}else{
											?>
												<option value="<?php echo $row_select['pro_id']; ?>"><?php echo $row_select['code']." :: ".$row_select['ref'] ; ?></option>
											<?php
											}   
										}
									 ?>     
								</select>           
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Qty In:</label>                                          
                            <input class="form-control"   name="txt_qty_in" type="text" value = "<?php echo $row["whsi_qty_in"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Unit:</label>  
                            <select name="txt_unit" class="form-control select2" style="width: 100%;">
                              <option value="">==choose unit==</option>
                              <?php 
                                $get_unit = $connect->query("SELECT * FROM tbl_unit ORDER BY u_name_en ASC"); 
                                while ($row_unit = mysqli_fetch_object($get_unit)) {
                                	if($row_unit->u_id == $row["whsi_unit"])
                                  		echo '<option SELECTED value="'.$row_unit->u_id.'">'.$row_unit->u_name_en.' :: '.$row_unit->u_name_kh.'</option>';
                                	else
                                  		echo '<option value="'.$row_unit->u_id.'">'.$row_unit->u_name_en.' :: '.$row_unit->u_name_kh.'</option>';
                                }
                              ?>
                            </select>    
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Cost:</label>                                          
                            <input class="form-control" autocomplete="off"  name="txt_cost" type="text" value = "<?php echo $row["whsi_cost"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Received From:</label> 
                            <select class = "form-control select2" name = "txt_received_from" required>
                                <option value="">==== Select and Choose ====</option>
                                <?php
                                  	$v_select = mysqli_query($connect,"SELECT * FROM vender");
                                  	while ($row_select = mysqli_fetch_assoc($v_select)) {
                                  		if($row_select['vendername_en'] == $row["whsi_received_from"])
                                  			echo '<option SELECTED value="'.$row_select['vendername_en'].'">'.$row_select['vendername_en'].'</option>';
                                  		else
                                  			echo '<option value="'.$row_select['vendername_en'].'">'.$row_select['vendername_en'].'</option>';
                                	}
                                 ?>   
                              </select>           
                          </div>
                        	<div class="form-group col-xs-6">
                            	<label for ="">Price:</label>                                          
                            	<input class="form-control" autocomplete="off"  name="txt_price" type="text" value = "<?php echo $row["whsi_price"]?>">          
                          	</div>
                          <div class="form-group col-xs-6">
                            <label for ="">Employee:</label> 
                            	<select class = "form-control" name = "txt_employee">
									<?php
										$v_select = mysqli_query($connect,"SELECT * FROM employee");
										while ($row_select = mysqli_fetch_assoc($v_select)) { 
											if($row["whsi_employee"] == $row_select["emp_id"]){
											?>
												<option selected="selected" value="<?php echo $row_select['emp_id']; ?>"><?php echo $row_select['emp_name_kh']." :: ".$row_select['emp_name_en'] ; ?></option>
											<?php
											}else{
											?>
												<option value="<?php echo $row_select['emp_id']; ?>"><?php echo $row_select['emp_name_kh']." :: ".$row_select['emp_name_en'] ; ?></option>
											<?php
											}   
										}
									 ?>     
								</select>
                            </div>
                            <div class="form-group col-xs-6">
                              	<label for ="">Expire Date:</label>                                          
                              	<input class="form-control" required  name="txt_expire_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" autocomplete="off" type="text" placeholder="Expire Date" value="<?= $row['whsi_expire_date'] ?>">    
                            </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="4" name = "txt_note"><?php echo $row["whsi_note"]?></textarea>
		                          </div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Save</button>
									<a href="wh_stock_in.php" class="btn btn-danger">Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>