<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
	$id = $_GET["edit_id"];

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM student_transport WHERE st_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_date = $_POST["txt_date"];
			$v_student = $_POST["txt_student"];
			$v_location = $_POST["txt_location"];
			$v_fee = $_POST["txt_fee"];
			$v_note = $_POST["txt_note"];

			$sql = "UPDATE student_transport SET st_date = '$v_date'
												, st_student_id = '$v_student'
												, st_location = '$v_location'
												, st_fee = '$v_fee'
												, st_note = '$v_note'									
											WHERE st_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:student_transport.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Student Transport</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>"> 
								<div class="form-group col-xs-12">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $row["st_date"]?>" >
		                        </div>  
								<div class="form-group col-xs-12">
		                        	<label for ="">Student:</label>                                          
	                                <select class = "form-control select2" name = "txt_student">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM student");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["st_student_id"] == $row_select["stu_id"]){
												?>
													<option selected="selected" value="<?php echo $row_select['stu_id']; ?>">(<?php echo $row_select['stu_id'] ; ?>) <?php echo $row_select['stu_name_en'] ;?> : <?php echo $row_select['stu_name_kh'] ;?> </option>
												<?php
												}else{
												?>
													<option value="<?php echo $row_select['stu_id']; ?>">(<?php echo $row_select['stu_id'] ; ?>) <?php echo $row_select['stu_name_en'] ;?> : <?php echo $row_select['stu_name_kh'] ;?> </option>
												<?php
												}   
											}
										 ?>     
									</select> 
		                        </div>
								
								<div class="form-group col-xs-12">
		                            <label for ="">Location:</label>                                          
		                       		<input class="form-control" name="txt_location" type="text" value="<?php echo $row["st_location"]?>" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Fee_Charge:</label>                                          
		                       		<input class="form-control" name="txt_fee" type="text" value="<?php echo $row["st_fee"]?>" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["st_note"]?>" >
		                        </div>
								

								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="student_transport.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>