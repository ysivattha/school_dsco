<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM course AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_name = $_POST["txt_name"];
		$v_class = $_POST["txt_class"];
		$v_note = $_POST["txt_note"];
		$v_period   =$_POST["txt_period"];
        $v_generation   =$_POST["txt_generation"];
		$v_fee   =$_POST["txt_fee"];
		$v_time   =$_POST["txt_time"];

		$sql = "INSERT INTO course (co_name
								, co_class
								, co_note
								, co_period
								, co_generation
								, co_fee
								, co_time
											)
							VALUES
								('$v_name'
								, '$v_class'
								, '$v_note'
								, '$v_period'
								, '$v_generation'
								, '$v_fee'
								, '$v_time'
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
                	<div class="panel-body"><h2 class="text-primary">Add Course</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-12">
		                            <label for ="">Course:</label>                                          
		                       		<input class="form-control" name="txt_name" type="text" >
		                        </div>
								<div class = "from-group col-xs-12">
									<label for = "">Class:</label>
									<select class = "form-control select2" name="txt_class">
									<option value="">===Select===</option>
										<?php
											$product = mysqli_query($connect,"SELECT * FROM class ");
											while ($row1 = mysqli_fetch_assoc($product)) { ?>
											<option value="<?php echo $row1['cl_id']; ?>"><?php echo $row1['cl_name'];?></option>
										<?php 
										}
										?>   
									</select>
									<br><br>
								</div>
								<div class = "from-group col-xs-12">
									<label for = "">Time:</label>
									<select class = "form-control select2" name="txt_time">
									<option value="">===Select===</option>
										<?php
											$product = mysqli_query($connect,"SELECT * FROM time_learn ");
											while ($row1 = mysqli_fetch_assoc($product)) { ?>
											<option value="<?php echo $row1['ti_id']; ?>"><?php echo $row1['ti_name'];?></option>
										<?php 
										}
										?>   
									</select>
									<br><br>
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Period:</label>                                          
		                       		<input class="form-control" name="txt_period" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Generation:</label>                                          
		                       		<input class="form-control" name="txt_generation" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Fee:</label>                                          
		                       		<input class="form-control" name="txt_fee" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
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
