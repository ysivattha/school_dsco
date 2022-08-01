<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM student AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_date_register = $_POST["txt_date_register"];
		$v_card_id = $_POST["txt_card_id"];
		$v_name_en = $_POST["txt_name_en"];
		$v_name_kh = $_POST["txt_name_kh"];
		$v_sex = $_POST["txt_sex"];
		$v_dateofbirth = $_POST["txt_dateofbirth"];
		$v_national =$_POST["txt_national"];
		$v_phone = $_POST["txt_phone"];
		$v_address = $_POST["txt_address"];
		$v_note = $_POST["txt_note"];

		$sql = "INSERT INTO student (stu_date_register
								, stu_card_id 
								, stu_name_en 
								, stu_name_kh
								, stu_sex
								, stu_dateofbirth
								, stu_national
								, stu_phone
								, stu_address
								, stu_note
											)
							VALUES
								('$v_date_register'
								, '$v_card_id'
								, '$v_name_en'
								, '$v_name_kh'
								, '$v_sex'
								, '$v_dateofbirth'
								, '$v_national'
								, '$v_phone'
								, '$v_address'
								, '$v_note'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:student.php?message=success');
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
                	<div class="panel-body"><h2 class="text-primary">Add Student</h2>
                		
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-4">
		                            <label for ="">Date_Register:</label>                                          
		                       		<input class="form-control" name="txt_date_register" type="date" >
		                        </div>
		                        <div class="form-group col-xs-4">
		                            <label for ="">Card_ID:</label>                                          
		                       		<input class="form-control" name="txt_card_id" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Name_EN:</label>                                          
		                       		<input class="form-control" name="txt_name_en" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Name_KH :</label>                                          
		                       		<input class="form-control" name="txt_name_kh" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Sex:</label>                                          
		                       		<input class="form-control" name="txt_sex" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Date_of_birth:</label>                                          
		                       		<input class="form-control" name="txt_dateofbirth" type="date" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">National:</label>                                          
		                       		<input class="form-control" name="txt_national" type="text" >
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
									<a href="student.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
