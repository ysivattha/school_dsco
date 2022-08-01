<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM course_student WHERE cs_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_student = $_POST["txt_student"];
			$v_date = $_POST["txt_date"];
			$v_note   =$_POST["txt_note"];

			$sql = "INSERT INTO course_student (cs_course_id
									, cs_student_id
									, cs_date_join
									, cs_note
												)
								VALUES
									('$v_student'
									'$v_student'
									, '$v_date'
									, '$v_note'
												)";
			$result = mysqli_query($connect, $sql);
			header("location:course.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit student in class</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "text" name = "id" value = "<?php echo $id; ?>">   
							<input type = "text" name = "course_id" value = "<?php echo $_GET["course_id"]; ?>">       
								
								<div class="form-group col-xs-12">
									<label for ="">Student:</label>
									   <select class="form-control select2" name="txt_student" >
										<?php
											$select1 = "SELECT * FROM student";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['co_teacher']==$row1['stu_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['stu_id']; ?>"><?= $row1['stu_name_en']; ?> : <?= $row1['stu_name_kh']; ?> (<?= $row1['stu_card_id']; ?>)</option>
										<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $today ?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row['cs_note'] ?>">
		                        </div>

								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="course_add_student.php?edit_id=<?php echo $_GET["course_id"]; ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>