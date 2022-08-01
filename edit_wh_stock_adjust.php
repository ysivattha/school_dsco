<?php
	include'config/db_connect.php'; 
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from tbl_wh_stock_adjust where whsa_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$v_date_record = $_POST["txt_date_record"];
			$v_letter_no = $_POST["txt_letter_no"];
			$v_product_code = $_POST["txt_product_code"];
			$v_product = $_POST["txt_product"];
			$v_qty_add = $_POST["txt_qty_add"];
			$v_qty_minus = $_POST["txt_qty_minus"];
			$v_unit = $_POST["txt_unit"];
			$v_approved_by = $_POST["txt_approved_by"];
   		    $v_employee = $_POST["txt_employee"];
   		    $v_note = $_POST["txt_note"];

			$sql = "UPDATE tbl_wh_stock_adjust SET whsa_date_record = '$v_date_record'
												, whsa_letter_no = '$v_letter_no' 
												, whsa_product_code = '$v_product_code' 
												, whsa_product = '$v_product' 
												, whsa_qty_add = '$v_qty_add' 
												, whsa_qty_minus = '$v_qty_minus' 
												, whsa_unit = '$v_unit' 
												, whsa_approved_by = '$v_approved_by' 
												, whsa_employee = '$v_employee' 
												, whsa_note = '$v_note' 
											WHERE whsa_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:wh_stock_adjust.php?message=update");
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
		                       		<input class="form-control" required  name="txt_date_record" type="date" value = "<?php echo $row["whsa_date_record"]?>">
		                        </div>
		                        <div class="form-group col-xs-6">
                            <label for ="">Letter No:</label>                                          
                            <input class="form-control" required  name="txt_letter_no" type="text" value = "<?php echo $row["whsa_letter_no"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Product Code:</label>                                          
                                <select class = "form-control" name = "txt_product_code">
									<?php
										$v_select = mysqli_query($connect,"SELECT * FROM product");
										while ($row_select = mysqli_fetch_assoc($v_select)) { 
											if($row["whsa_product_code"] == $row_select["pro_id"]){
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
                            <label for ="">Qty Add:</label>                                          
                            <input class="form-control"   name="txt_qty_add" type="text" value = "<?php echo $row["whsa_qty_add"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Qty Minus:</label>                                          
                            <input class="form-control"   name="txt_qty_minus" type="text" value = "<?php echo $row["whsa_qty_minus"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Unit:</label>                                             
                            <select name="txt_unit" class="form-control select2" style="width: 100%;">
                              <option value="">==choose unit==</option>
                              <?php 
                                $get_unit = $connect->query("SELECT * FROM tbl_unit ORDER BY u_name_en ASC"); 
                                while ($row_unit = mysqli_fetch_object($get_unit)) {
                                	if($row_unit->u_id == $row["whsa_unit"])
                                  		echo '<option SELECTED value="'.$row_unit->u_id.'">'.$row_unit->u_name_en.' :: '.$row_unit->u_name_kh.'</option>';
                                	else
                                  		echo '<option value="'.$row_unit->u_id.'">'.$row_unit->u_name_en.' :: '.$row_unit->u_name_kh.'</option>';
                                }
                              ?>
                            </select>     
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Approved By:</label>                                          
                            <input class="form-control"   name="txt_approved_by" type="text" value = "<?php echo $row["whsa_approved_by"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Employee:</label> 
                            	<select class = "form-control" name = "txt_employee">
									<?php
										$v_select = mysqli_query($connect,"SELECT * FROM employee");
										while ($row_select = mysqli_fetch_assoc($v_select)) { 
											if($row["whsa_employee"] == $row_select["emp_id"]){
											?>
												<option selected="selected" value="<?php echo $row_select['emp_id']; ?>"><?php echo $row_select['emp_name_en']." :: ".$row_select['emp_name_kh'] ; ?></option>
											<?php
											}else{
											?>
												<option value="<?php echo $row_select['emp_id']; ?>"><?php echo $row_select['emp_name_en']." :: ".$row_select['emp_name_kh'] ; ?></option>
											<?php
											}   
										}
									 ?>     
								</select>
                            </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="4" name = "txt_note"><?php echo $row["whsa_note"]?></textarea>
		                          </div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Save</button>
									<a href="wh_stock_adjust.php" class="btn btn-danger">Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>