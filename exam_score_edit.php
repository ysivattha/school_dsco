<?php
include'config/db_connect.php';
$sub_id = $_GET["sub_id"];	

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
	$id = $_GET["edit_id"];

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM student_score WHERE sc_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_student = $_POST["txt_student"];
			$v_subject = $_POST["txt_subject"];
			$v_attendance = $_POST["txt_attendance"];
			$v_quiz = $_POST["txt_quiz"];
			$v_homework = $_POST["txt_homework"];
			$v_midterm = $_POST["txt_midterm"];
			$v_final = $_POST["txt_final"];
			$v_note = $_POST["txt_note"];
			
			$sql = "UPDATE student_score SET sc_student_id = '$v_student'
												, sc_subject_id = '$v_subject'
												, sc_attendance = '$v_attendance'
												, sc_quiz = '$v_quiz'
												, sc_homework = '$v_homework'
												, sc_midterm = '$v_midterm'
												, sc_final = '$v_final'
												, sc_note = '$v_note'
											WHERE sc_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:exam_score.php?id=$id");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Exam Score</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>"> 
								 
								<div class="form-group col-xs-12">
		                        	<label for ="">Student:</label>                                          
	                                <select class = "form-control select2" name = "txt_student">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM student");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["sc_student_id"] == $row_select["stu_id"]){
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
		                        	<label for ="">Subject:</label>                                          
	                                <select class = "form-control select2" name = "txt_subject">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM course");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["sc_subject_id"] == $row_select["co_id"]){
												?>
													<option selected="selected" value="<?php echo $row_select['co_id']; ?>">(<?php echo $row_select['co_name'] ; ?>) <?php echo $row_select['co_generation'] ;?> </option>
												<?php
												}else{
												?>
													<option value="<?php echo $row_select['co_id']; ?>">(<?php echo $row_select['co_name'] ; ?>) <?php echo $row_select['co_generation'] ;?> </option>
												<?php
												}   
											}
										 ?>     
									</select> 
		                        </div>
								
								<div class="form-group col-xs-12">
		                            <label for ="">Attendance:</label>                                          
		                       		<input class="form-control" name="txt_attendance" type="text" value="<?php echo $row["sc_attendance"]?>" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Quiz:</label>                                          
		                       		<input class="form-control" name="txt_quiz" type="text" value="<?php echo $row["sc_quiz"]?>" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Homework:</label>                                          
		                       		<input class="form-control" name="txt_homework" type="text" value="<?php echo $row["sc_homework"]?>" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Midterm:</label>                                          
		                       		<input class="form-control" name="txt_midterm" type="text" value="<?php echo $row["sc_midterm"]?>" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Final:</label>                                          
		                       		<input class="form-control" name="txt_final" type="text" value="<?php echo $row["sc_final"]?>" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["sc_note"]?>" >
		                        </div>
								

								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="exam_score.php?id=<?php echo $sub_id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>