<?php
	include'config/db_connect.php'; 
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from tbl_wh_stock_out where whso_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$v_date_record = $_POST["txt_date_record"];
			$v_letter_no = $_POST["txt_letter_no"];
			$v_product_code = $_POST["txt_product_code"];
			$v_product = $_POST["txt_product"];
			$v_qty_out = $_POST["txt_qty_out"];
			$v_unit = $_POST["txt_unit"];
			$v_sent_to = $_POST["txt_sent_to"];
   		    $v_employee = $_POST["txt_employee"];
   		    $v_note = $_POST["txt_note"];

			$sql = "UPDATE tbl_wh_stock_out SET whso_date_record = '$v_date_record'
												, whso_letter_no = '$v_letter_no' 
												, whso_product_code = '$v_product_code' 
												, whso_product = '$v_product' 
												, whso_qty_out = '$v_qty_out' 
												, whso_unit = '$v_unit' 
												, whso_sent_to = '$v_sent_to' 
												, whso_employee = '$v_employee' 
												, whso_note = '$v_note' 
											WHERE whso_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:wh_stock_out.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Warehouse Stock Out</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
		                            <label for ="">Date Record:</label>                                          
		                       		<input class="form-control" required  name="txt_date_record" type="date" value = "<?php echo $row["whso_date_record"]?>">
		                        </div>
		                        <div class="form-group col-xs-6">
                            <label for ="">Letter No:</label>                                          
                            <input class="form-control" required  name="txt_letter_no" type="text" value = "<?php echo $row["whso_letter_no"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Product Code:</label>                                          
                                <select class = "form-control" name = "txt_product_code">
									<?php
										$v_select = mysqli_query($connect,"SELECT * FROM product WHERE pro_id IN (SELECT whsi_product_code FROM tbl_wh_stock_in)");
										while ($row_select = mysqli_fetch_assoc($v_select)) { 
											if($row["whso_product_code"] == $row_select["pro_id"]){
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
                            <label for ="">Qty Out:</label>                                          
                            <input class="form-control"   name="txt_qty_out" type="text" value = "<?php echo $row["whso_qty_out"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Unit:</label>                                          
                            <select name="txt_unit" class="form-control select2" style="width: 100%;">
                              <option value="">==choose unit==</option>
                              <?php 
                                $get_unit = $connect->query("SELECT * FROM tbl_unit ORDER BY u_name_en ASC"); 
                                while ($row_unit = mysqli_fetch_object($get_unit)) {
                                	if($row_unit->u_id == $row["whso_unit"])
                                  		echo '<option SELECTED value="'.$row_unit->u_id.'">'.$row_unit->u_name_en.' :: '.$row_unit->u_name_kh.'</option>';
                                	else
                                  		echo '<option value="'.$row_unit->u_id.'">'.$row_unit->u_name_en.' :: '.$row_unit->u_name_kh.'</option>';
                                }
                              ?>
                            </select>          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Sent To:</label>                                          
                            <input class="form-control"   name="txt_sent_to" type="text" value = "<?php echo $row["whso_sent_to"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Employee:</label> 
                            	<select class = "form-control" name = "txt_employee">
									<?php
										$v_select = mysqli_query($connect,"SELECT * FROM employee");
										while ($row_select = mysqli_fetch_assoc($v_select)) { 
											if($row["whso_employee"] == $row_select["emp_id"]){
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
		                            <textarea class="form-control" rows="4" name = "txt_note"><?php echo $row["whso_note"]?></textarea>
		                          </div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Save</button>
									<a href="wh_stock_out.php" class="btn btn-danger">Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>