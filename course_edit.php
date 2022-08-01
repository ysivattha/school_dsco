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

			$v_name = $_POST["txt_name"];
			$v_class = $_POST["txt_class"];
			$v_note = $_POST["txt_note"];
			$v_period   =$_POST["txt_period"];
        	$v_generation   =$_POST["txt_generation"];
			$v_finish   =$_POST["txt_finish"];
			$v_fee   =$_POST["txt_fee"];
			$v_time   =$_POST["txt_time"];


			$sql = "UPDATE course SET co_name = '$v_name'
									, co_class = '$v_class'
									, co_note = '$v_note'
									, co_period = '$v_period'
									, co_generation = '$v_generation'
									, co_finish = '$v_finish'
									, co_fee = '$v_fee'
									, co_time = '$v_time'
									WHERE co_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:course.php?message=update");
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
		                            <label for ="">Course:</label>                                          
		                       		<input class="form-control" name="txt_name" type="text" value="<?php echo $row["co_name"]?>">
		                        </div>
								<div class="form-group col-xs-12">
									<label for ="">Class:</label>
									<select class="form-control" name="txt_class" >
									<?php
										$select1 = "SELECT * FROM class";
										$query1  = mysqli_query($connect,$select1);
										while($row1 = $query1->fetch_assoc()):
										$selected=($row['co_class']==$row1['cl_id']?"selected":"");
									?>
									<option <?= $selected; ?> value="<?= $row1['cl_id']; ?>"><?= $row1['cl_name']; ?></option>
									<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-xs-12">
									<label for ="">Time:</label>
									<select class="form-control" name="txt_time" >
									<?php
										$select1 = "SELECT * FROM time_learn";
										$query1  = mysqli_query($connect,$select1);
										while($row1 = $query1->fetch_assoc()):
										$selected=($row['co_time']==$row1['ti_id']?"selected":"");
									?>
									<option <?= $selected; ?> value="<?= $row1['ti_id']; ?>"><?= $row1['ti_name']; ?></option>
									<?php endwhile; ?>
									</select>
								</div>
								
								<div class="form-group col-xs-12">
		                            <label for ="">Period:</label>                                          
		                       		<input class="form-control" name="txt_period" type="text" value="<?php echo $row["co_period"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Generation:</label>                                          
		                       		<input class="form-control" name="txt_generation" type="text" value="<?php echo $row["co_generation"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Fee:</label>                                          
		                       		<input class="form-control" name="txt_fee" type="number" value="<?php echo $row["co_fee"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["co_note"]?>">
		                        </div>
								<div class="form-group col-xs-12">
									<label for ="">Class_Finish:</label>
									<select class="form-control" name="txt_finish" >
									<?php
										$select1 = "SELECT * FROM text_finish";
										$query1  = mysqli_query($connect,$select1);
										while($row1 = $query1->fetch_assoc()):
										$selected=($row['co_finish']==$row1['f_name']?"selected":"");
									?>
									<option <?= $selected; ?> value="<?= $row1['f_name']; ?>"><?= $row1['f_name']; ?></option>
									<?php endwhile; ?>
									</select>
								</div>

								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="course.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>