<?php
	include'config/db_connect.php';
	
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from tbl_stock_adjust where sa_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$v_date_record = $_POST["txt_date_record"];
			$v_product_code = $_POST["txt_product_code"];
			$v_product = $_POST["txt_product"];
			$v_qty_add = $_POST["txt_qty_add"];
			$v_qty_minus = $_POST["txt_qty_minus"];
   		    $v_employee = $_POST["txt_employee"];
   		    $v_note = $_POST["txt_note"];

			$sql = "UPDATE tbl_stock_adjust SET sa_date_record = '$v_date_record'
												, sa_product_code = '$v_product_code' 
												, sa_product = '$v_product' 
												, sa_qty_add = '$v_qty_add' 
												, sa_qty_minus = '$v_qty_minus'
												, sa_employee = '$v_employee' 
												, sa_note = '$v_note' 
											WHERE sa_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:stock_adjust.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Stock Sell</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
		                            <label for ="">Date Record:</label>                                          
		                       		<input class="form-control" required  name="txt_date_record" type="date" value = "<?php echo $row["sa_date_record"]?>">
		                        </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Product Code:</label>                                          
                                <select class = "form-control" name = "txt_product_code">
									<?php
										$v_select = mysqli_query($connect,"SELECT * FROM tbl_item_menu WHERE 	im_sale_type ='1' ORDER BY im_name ASC");
										while ($row_select = mysqli_fetch_assoc($v_select)) { 
											if($row["sa_product_code"] == $row_select["im_id"]){
											?>
												<option selected="selected" value="<?php echo $row_select['im_id']; ?>"><?php echo $row_select['im_name'] ?></option>
											<?php
											}else{
											?>
												<option value="<?php echo $row_select['im_id']; ?>"><?php echo $row_select['im_name'] ?></option>
											<?php
											}   
										}
									 ?>     
								</select>           
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Qty Add:</label>                                          
                            <input class="form-control"   name="txt_qty_add" type="text" value = "<?php echo $row["sa_qty_add"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Qty Minus:</label>                                          
                            <input class="form-control"   name="txt_qty_minus" type="text" value = "<?php echo $row["sa_qty_minus"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Employee:</label> 
                            	<select class = "form-control" name = "txt_employee">
									<?php
										$v_select = mysqli_query($connect,"SELECT * FROM employee");
										while ($row_select = mysqli_fetch_assoc($v_select)) { 
											if($row["sa_employee"] == $row_select["emp_id"]){
											?>
												<option selected="selected" value="<?php echo $row_select['emp_id']; ?>"><?php echo $row_select['name_english']." :: ".$row_select['name_khmer'] ; ?></option>
											<?php
											}else{
											?>
												<option value="<?php echo $row_select['emp_id']; ?>"><?php echo $row_select['name_english']." :: ".$row_select['name_khmer'] ; ?></option>
											<?php
											}   
										}
									 ?>     
								</select>
                            </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="4" name = "txt_note"><?php echo $row["sa_note"]?></textarea>
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