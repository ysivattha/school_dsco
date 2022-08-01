<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM truck AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_tr_num   =0;
		$v_tr_type     =$_POST["txt_tr_type"];
		$v_tr_name  =$_POST["txt_tr_name"];
		$v_tr_cheque  =$_POST["txt_tr_cheque"];
		$v_tr_code     =$_POST["txt_tr_code"];
		$v_tr_phone   =$_POST["txt_tr_phone"];
		$v_tr_unit     =$_POST["txt_tr_unit"];
		$v_tr_address     =$_POST["txt_tr_address"];
		$datetime = date('Y-m-d H:i:s');

		$sql = "INSERT INTO truck (tr_num
								, tr_type 
								, tr_name 
								, tr_cheque
								, tr_code
								, tr_phone
								, tr_unit
								, tr_address
								, tr_datetime
											)
							VALUES
								('$v_tr_num'
								, '$v_tr_type'
								, '$v_tr_name'
								, '$v_tr_cheque'
								, '$v_tr_code'
								, '$v_tr_phone'
								, '$v_tr_unit'
								, '$v_tr_address'
								, '$datetime'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:truck.php?message=success');
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
                	<div class="panel-body"><h2 class="text-primary">Add Big Truck</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">         
							
		                        <div class="form-group col-xs-6">
		                            <label for ="">Type Truck:</label>                                          
		                       		<input class="form-control" name="txt_tr_type" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Name:</label>                                          
		                       		<input class="form-control" name="txt_tr_name" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Name of Cheque:</label>                                          
		                       		<input class="form-control" name="txt_tr_cheque" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Code:</label>                                          
		                       		<input class="form-control" name="txt_tr_code" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Phone:</label>                                          
		                       		<input class="form-control" name="txt_tr_phone" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Unit Truck:</label>                                          
		                       		<input class="form-control" name="txt_tr_unit" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Address:</label>                                          
		                       		<input class="form-control" name="txt_tr_address" type="text" >
		                        </div>

								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="truck.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
