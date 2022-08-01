<?php include'config/db_connect.php';
$user_id = $_SESSION['user_id'];

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$id = $_GET["edit_id"];
	

	if(isset($_POST["btnadd"])){
		
		$v_course_id = $_GET["edit_id"];
		$v_note ="Sample";

		// copy & paste form table1 to table2
		$sql = "INSERT INTO attendance (att_course_id, att_student_id, att_yes, att_note)
				SELECT att_course_id, att_student_id, att_yes, att_note
				FROM attendance_sample
				WHERE att_note='$v_note'
				AND att_course_id='$v_course_id'
		 					";
		$result = mysqli_query($connect, $sql);

				// copy & paste form table1 to table2
				$today = date('Y-m-d');	
				$datetime = date('Y-m-d H:i:s');
				$user_id = $_SESSION['user_id'];
				$v_note ="Sample";
				$v_date     =$_POST["txt_date"];

				$sql_update = "UPDATE attendance SET att_date = '$v_date'
													, att_note = ''
													, att_user_id = '$user_id'
													, att_datetime = '$datetime'
													WHERE att_note = '$v_note'" ;
				mysqli_query($connect, $sql_update);
		
		header("location:attendance_student_check_teacher.php?edit_id=$v_course_id");
		
		
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
                	<div class="panel-body"><h3 class="text-primary">Copy & Paste Sample Attendance</h3>
                		
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								
								<div class="form-group col-xs-6">
		                            <label for ="">Choose Attendance Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $today; ?>" >
		                        </div>
								
								

								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Copy & Paste</button>
									<a href="attendance_copy_attendance_teacher.php?edit_id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
