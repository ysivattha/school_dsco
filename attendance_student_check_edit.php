<?php
	include'config/db_connect.php';
	$user_id = $_SESSION['user_id'];

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
	$id = $_GET["edit_id"];

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM attendance WHERE att_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_student = $_POST["txt_student"];
			$v_date = $_POST["txt_date"];
			$v_course   =$_POST["txt_attendance_type"];
				if($v_course=="Yes"){
					$v_att_yes ="Yes";
				}elseif($v_course=="A"){
					$v_att_a ="A";
				}else{
					$v_att_p ="P";
				}
			$v_note   =$_POST["txt_note"];
			$user_id = $_SESSION['user_id'];
			$v_course_id = $_GET["course_id"];

			$sql = "UPDATE attendance SET att_course_id = '$v_course_id'
									, att_student_id = '$v_student'
									, att_date = '$v_date'
									, att_yes = '$v_att_yes'
									, att_a = '$v_att_a'
									, att_p = '$v_att_p'
									, att_note = '$v_note'
									, att_user_id = '$user_id'
									, att_datetime = '$datetime'
									WHERE att_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:attendance_student_check.php?edit_id=$v_course_id");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Course Info</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>"> 
								<div class="form-group col-xs-12">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $row["att_date"]?>" >
		                        </div>  
								<div class="form-group col-xs-12">
		                        	<label for ="">Student:</label>                                          
	                                <select class = "form-control select2" name = "txt_student">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM student");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["att_student_id"] == $row_select["stu_id"]){
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
		                        	<label for ="">Attendance Type:</label>                                          
	                                <select class = "form-control select2" name = "txt_attendance_type">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM text_attendance");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["att_yes"] == $row_select["ta_name"]){
												?>
													<option selected="selected" value="<?php echo $row_select['ta_name']; ?>"><?php echo $row_select['ta_name'] ; ?></option>
												<?php
												}else{
												?>
													<option value="<?php echo $row_select['ta_name']; ?>"><?php echo $row_select['ta_name'] ; ?> </option>
												<?php
												}   
											}
										 ?>     
									</select> 
		                        </div>
								
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["att_note"]?>" >
		                        </div>
								

								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="attendance_student_check.php?edit_id=<?php echo $row['att_course_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>