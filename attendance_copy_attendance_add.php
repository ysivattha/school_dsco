<?php include'config/db_connect.php';
$user_id = $_SESSION['user_id'];

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$id = $_GET["edit_id"];
	

	if(isset($_POST["btnadd"])){
		
		$v_student = $_POST["txt_student"];
		
		$v_note   ="Sample";
		$user_id = $_SESSION['user_id'];
		$v_course_id = $_GET["edit_id"];
		$today = date('Y-m-d');
		$v_att_yes ="Yes";
		$v_att_a ="";
		$v_att_p ="";

		$sql = "INSERT INTO attendance_sample (att_course_id
								, att_student_id
								, att_date
								, att_yes
								, att_a
								, att_p
								, att_note
								, att_user_id
								, att_datetime
											)
							VALUES
								('$v_course_id'
								, '$v_student'
								, '$today'
								, '$v_att_yes'
								, '$v_att_a'
								, '$v_att_p'
								, '$v_note'
								, '$user_id'
								, '$datetime'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header("location:attendance_copy_attendance.php?edit_id=$v_course_id");
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
                	<div class="panel-body"><h3 class="text-primary">Add Sample Attendance</h3>
                		
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								
								<div class="form-group col-xs-12">
									<label for ="">Student:</label>                                          
										<select class = "form-control select2" style="width:100%" name="txt_student">
											<option value="">==== Choose ====</option>
												<?php
												$v_select = mysqli_query($connect,"SELECT * FROM student");
												while ($row1 = mysqli_fetch_assoc($v_select)) { ?>
												<option value="<?php echo $row1['stu_id']; ?>">(<?php echo $row1['stu_id'] ;?>) <?php echo $row1['stu_name_en'] ;?> : <?php echo $row1['stu_name_kh'] ;?> </option>
												<?php 
												}
												?>   
										</select>           
								</div>
								
								

								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="attendance_copy_attendance.php?edit_id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
