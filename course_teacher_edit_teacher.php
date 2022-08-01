<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM course WHERE co_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_teacher = $_POST["txt_teacher"];
			$v_assistant = $_POST["txt_assistant"];
			$v_room = $_POST["txt_room"];
			$v_shift = $_POST["txt_shift"];
			$v_day = $_POST["txt_day"];
			$v_note_teacher = $_POST["txt_note_teacher"];

			$sql = "UPDATE course SET co_teacher = '$v_teacher'
									, co_assistant = '$v_assistant'
									, co_room = '$v_room'
									, co_shift = '$v_shift'
									, co_day = '$v_day'
									, co_note_teacher = '$v_note_teacher'
									WHERE co_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:course_teacher_edit.php?edit_id=$id&message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
	  			<div class = "col-xs-12">
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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Teacher Info</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>"> 
								<div class="form-group col-xs-12">
									Class_Course:
									<label for =""> 
										<?php echo @$row["co_name"]?>
									</label>
									<br>

									Period:
									<label for =""> 
										<?php echo @$row["co_period"]?>
									</label>
									<br>

									Generation:
									<label for =""> 
										<?php echo @$row["co_generation"]?>
									</label> 
									<br>

								</div>        
								<div class="form-group col-xs-12">
									<label for ="">Teacher:</label>
									   <select class="form-control" name="txt_teacher" >
										<?php
											$select1 = "SELECT * FROM employee";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['co_teacher']==$row1['emp_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['emp_id']; ?>"><?= $row1['emp_name_en']; ?></option>
										<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Assistant:</label>
									<select class="form-control" name="txt_assistant" >
									<?php
										$select1 = "SELECT * FROM employee";
										$query1  = mysqli_query($connect,$select1);
										while($row1 = $query1->fetch_assoc()):
										$selected=($row['co_assistant']==$row1['emp_id']?"selected":"");
									?>
									<option <?= $selected; ?> value="<?= $row1['emp_id']; ?>"><?= $row1['emp_name_en']; ?></option>
									<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-12">
									<label for ="">Room:</label>
									   <select class="form-control" name="txt_room" >
										<?php
											$select1 = "SELECT * FROM room";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['co_room']==$row1['ro_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['ro_id']; ?>"><?= $row1['ro_name']; ?></option>
										<?php endwhile; ?>
									</select> 
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Shift:</label>
									   <select class="form-control" name="txt_shift" >
										<?php
											$select1 = "SELECT * FROM shift";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['co_shift']==$row1['sh_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['sh_id']; ?>"><?= $row1['sh_name']; ?></option>
										<?php endwhile; ?>
									</select>                                        
		                       	</div>
								   <div class="form-group col-xs-12">
		                            <label for ="">Day:</label>
									   <select class="form-control" name="txt_day" >
										<?php
											$select1 = "SELECT * FROM day";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['co_day']==$row1['day_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['day_id']; ?>"><?= $row1['day_name']; ?></option>
										<?php endwhile; ?>
									</select>                                        
		                       	</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note_teacher" type="text" value="<?php echo $row["co_note_teacher"]?>">
		                        </div>

								<div class="form-group col-xs-12">
									<a href="course_teacher.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>