<?php
	include'config/db_connect.php'; 
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from tbl_expense_list where exp_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

   		    $v_date_record = $_POST["txt_date_record"];
		    $v_description = $_POST["txt_description"];
		    $v_expense_category = $_POST["txt_expense_category"];
		    $v_amount = $_POST["txt_amount"];
		    $v_employee = $_POST["txt_employee"];
		    $v_note = $_POST["txt_note"];

			$sql = "UPDATE tbl_expense_list 
						SET exp_date_record = '$v_date_record'
						, exp_description = '$v_description' 
						, exp_expense_category = '$v_expense_category' 
						, exp_amount = '$v_amount' 
						, exp_employee = '$v_employee' 
						, exp_note = '$v_note' 

						WHERE exp_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:expense_list.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Expense List</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-12">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
		                            <label for ="">Date Record:</label>                                          
		                       		<input class="form-control" required  name="txt_date_record" type="date" value = "<?php echo $row["exp_date_record"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for ="">Description:</label>                                          
		                       		<input class="form-control" required  name="txt_description" type="text" value = "<?php echo $row["exp_description"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                        	<label for ="">Revenue Category:</label>                                          
	                                <select class = "form-control" name = "txt_expense_category">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM tbl_expense_category");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["exp_expense_category"] == $row_select["exca_id"]){
												?>
													<option selected="selected" value="<?php echo $row_select['exca_id']; ?>"><?php echo $row_select['exca_name'] ; ?></option>
												<?php
												}else{
												?>
													<option value="<?php echo $row_select['exca_id']; ?>"><?php echo $row_select['exca_name'] ; ?></option>
												<?php
												}   
											}
										 ?>     
									</select> 
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for ="">Amount:</label>                                          
		                       		<input class="form-control" required  name="txt_amount" type="text" value = "<?php echo $row["exp_amount"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                        	<label for ="">Employee:</label> 
	                            	<select class = "form-control" name = "txt_employee">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM employee");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["whsi_employee"] == $row_select["emp_id"]){
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
		                            <textarea class="form-control" rows="4" id="note" name = "txt_note"><?php echo $row["exp_note"]?></textarea>
		                          </div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Save</button>
									<a href="expense_list.php" class="btn btn-danger">Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>