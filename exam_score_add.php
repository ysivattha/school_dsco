<?php include'config/db_connect.php';
$id = $_GET["id"];

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');


	if(isset($_POST["btnadd"])){

		$v_student = $_POST["txt_student"];
		$v_subject = $_POST["txt_subject"];
		$v_attendance = $_POST["txt_attendance"];
		$v_quiz = $_POST["txt_quiz"];
		$v_homework = $_POST["txt_homework"];
		$v_midterm = $_POST["txt_midterm"];
		$v_final = $_POST["txt_final"];
		$v_note = $_POST["txt_note"];

		$sql = "INSERT INTO student_score (sc_student_id
										, sc_subject_id
										, sc_attendance
										, sc_quiz
										, sc_homework
										, sc_midterm
										, sc_final
										, sc_note
										, sc_datetime
													)
									VALUES
										('$v_student'
										, '$v_subject'
										, '$v_attendance'
										, '$v_quiz'
										, '$v_homework'
										, '$v_midterm'
										, '$v_final'
										, '$v_note'
										, '$datetime'
														)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header("location:exam_score.php?id=$id");
		}
		
	}

?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
					<?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete Data</h4>';
                      echo '</div>';
                    }
                    ?>
		</div>
            <div class="panel panel-default">
                	<div class="panel-body"><h3 class="text-primary">Add Exam Score</h3>
                		
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								
								<div class = "from-group col-xs-12">
									<label for = "">Student:</label>
									<select class = "form-control select2" name="txt_student">
									<option value="">=== Choose ===</option>
										<?php
											$product = mysqli_query($connect,"SELECT * FROM student ");
											while ($row1 = mysqli_fetch_assoc($product)) { ?>
											<option value="<?php echo $row1['stu_id']; ?>">(<?php echo $row1['stu_card_id'];?>) <?php echo $row1['stu_name_en'];?></option>
										<?php 
										}
										?>   
									</select>
								</div>
								<div class = "from-group col-xs-12">
									<label for = "">Subject:</label>
									<select class = "form-control select2" name="txt_subject">
									<option value="">=== Choose ===</option>
										<?php
											$product = mysqli_query($connect,"SELECT * FROM course ");
											while ($row1 = mysqli_fetch_assoc($product)) { ?>
											<option value="<?php echo $row1['co_id']; ?>">(<?php echo $row1['co_name'];?>) <?php echo $row1['co_generation'];?></option>
										<?php 
										}
										?>   
									</select>
								</div>
								
								<div class="form-group col-xs-6">
		                            <label for ="">Attendance:</label>                                          
		                       		<input class="form-control" name="txt_attendance" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Quiz:</label>                                          
		                       		<input class="form-control" name="txt_quiz" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Homework:</label>                                          
		                       		<input class="form-control" name="txt_homework" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Midterm:</label>                                          
		                       		<input class="form-control" name="txt_midterm" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Final:</label>                                          
		                       		<input class="form-control" name="txt_final" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="exam_score.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
