<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM course_student AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_getid = $_GET["edit_id"];
		$v_date = $_POST["txt_date"];
		$v_student = $_POST["txt_student"];
		$v_note = $_POST["txt_note"];

		$sql = "INSERT INTO course_student (cs_course_id
										, cs_date_join
										, cs_student_id
										, cs_note
													)
									VALUES
										('$v_getid'
										, '$v_date'
										, '$v_student'
										, '$v_note'
														)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:course.php?message=success');
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
                	<div class="panel-body"><h3 class="text-primary">Add student to class</h3>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-12">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $today; ?>" >
		                        </div>
								<div class = "from-group col-xs-12">
									<label for = "">Student:</label>
									<select class = "form-control select2" name="txt_student">
									<option value="">===Select here===</option>
										<?php
											$product = mysqli_query($connect,"SELECT * FROM student ");
											while ($row1 = mysqli_fetch_assoc($product)) { ?>
											<option value="<?php echo $row1['stu_id']; ?>">(<?php echo $row1['stu_card_id'];?>) <?php echo $row1['stu_name_en'];?></option>
										<?php 
										}
										?>   
									</select>
								</div>
								<div class="form-group col-xs-12">
									<br>
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="course.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
