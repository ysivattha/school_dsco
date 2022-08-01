<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM customer AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_name_kh = $_POST["txt_name_kh"];
		$v_name_en = $_POST["txt_name_en"];
		$v_position = $_POST["txt_position"];
		$v_start_on = $_POST["txt_start_on"];
		$v_phone = $_POST["txt_phone"];
		$v_address = $_POST["txt_address"];
		$v_note = $_POST["txt_note"];

		$sql = "INSERT INTO employee (emp_name_kh
								, emp_name_en 
								, emp_position 
								, emp_start_on
								, emp_phone
								, emp_address
								, emp_note
											)
							VALUES
								('$v_name_kh'
								, '$v_name_en'
								, '$v_position'
								, '$v_start_on'
								, '$v_phone'
								, '$v_address'
								, '$v_note'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:employee.php?message=success');
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
                	<div class="panel-body"><h2 class="text-primary">Add Employee</h2>
                		
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-4">
		                            <label for ="">Name_KH:</label>                                          
		                       		<input class="form-control" name="txt_name_kh" type="text" >
		                        </div>
		                        <div class="form-group col-xs-4">
		                            <label for ="">Name_EN:</label>                                          
		                       		<input class="form-control" name="txt_name_en" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Position:</label>                                          
		                       		<input class="form-control" name="txt_position" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Start_On:</label>                                          
		                       		<input class="form-control" name="txt_start_on" type="date" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Phone:</label>                                          
		                       		<input class="form-control" name="txt_phone" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Address:</label>                                          
		                       		<input class="form-control" name="txt_address" type="text" >
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="2" name="txt_note"> </textarea>
		                        </div>

								<div class="form-group col-xs-6">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="employee.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
