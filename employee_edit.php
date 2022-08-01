<?php include'config/db_connect.php';

    if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM employee WHERE emp_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
		$id = $_POST["id"];
		
		$v_name_kh = $_POST["txt_name_kh"];
		$v_name_en = $_POST["txt_name_en"];
		$v_position = $_POST["txt_position"];
		$v_start_on = $_POST["txt_start_on"];
		$v_phone = $_POST["txt_phone"];
		$v_address = $_POST["txt_address"];
		$v_address = $_POST["txt_note"];
		
				$sql = "UPDATE employee SET emp_name_kh ='$v_name_kh'
									, emp_name_en 	= '$v_name_en' 
									, emp_position 	= '$v_position'
									, emp_start_on 	= '$v_start_on'
									, emp_phone 	= '$v_phone'
									, emp_address	= '$v_address'
									, emp_note		= '$v_address'
										WHERE emp_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:employee.php?message=update");
	}
?>
<?php include 'header.php';?>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body"><h3 class="text-primary">Edit Employee</h3>
                	
                </div>

                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
							<input type = "hidden" name="id" value = "<?php echo $id; ?>">
							<div class="form-group col-xs-4">
		                            <label for ="">Name_KH:</label>                                          
		                       		<input class="form-control" name="txt_name_kh" type="text" value="<?php echo $row["emp_name_kh"]?>">
		                        </div>
		                        <div class="form-group col-xs-4">
		                            <label for ="">Name_EN:</label>                                          
		                       		<input class="form-control" name="txt_name_en" type="text" value="<?php echo $row["emp_name_en"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Position:</label>                                          
		                       		<input class="form-control" name="txt_position" type="text" value="<?php echo $row["emp_position"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Start_On:</label>                                          
		                       		<input class="form-control" name="txt_start_on" type="date" value="<?php echo $row["emp_start_on"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Phone:</label>                                          
		                       		<input class="form-control" name="txt_phone" type="text" value="<?php echo $row["emp_phone"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Address:</label>                                          
		                       		<input class="form-control" name="txt_address" type="text" value="<?php echo $row["emp_address"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="2" name="txt_note"><?php echo $row["emp_note"]?></textarea>
		                        </div>

								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="employee.php" class="btn btn-danger"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>