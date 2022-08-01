<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM customer AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_cus_num_id = $_POST["txt_num_id"];
		$v_cus_name = $_POST["txt_name"];
		$v_cus_address = $_POST["txt_address"];
		$v_cus_country = $_POST["txt_country"];
		$v_cus_city = $_POST["txt_city"];
		$v_cus_phone = $_POST["txt_phone"];
		$v_cus_note = $_POST["txt_note"];

		$sql = "INSERT INTO customer (cus_num_id
								, cus_name 
								, cus_address 
								, cus_country
								, cus_city
								, cus_phone
								, cus_note
											)
							VALUES
								('$v_cus_num_id'
								, '$v_cus_name'
								, '$v_cus_address'
								, '$v_cus_country'
								, '$v_cus_city'
								, '$v_cus_phone'
								, '$v_cus_note'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:customer.php?message=success');
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
                	<div class="panel-body"><h2 class="text-primary">Add Customer</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-6">
		                            <label for ="">Customer ID:</label>                                          
		                       		<input class="form-control" name="txt_num_id" type="text" >
		                        </div>
		                        <div class="form-group col-xs-6">
		                            <label for ="">Customer Name:</label>                                          
		                       		<input class="form-control" name="txt_name" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer Address:</label>                                          
		                       		<input class="form-control" name="txt_address" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer County:</label>                                          
		                       		<input class="form-control" name="txt_country" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer City:</label>                                          
		                       		<input class="form-control" name="txt_city" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer Phone:</label>                                          
		                       		<input class="form-control" name="txt_phone" type="text" >
		                        </div>

		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="3" name="txt_note"> </textarea>
		                          </div>
								<div class="form-group col-xs-6">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="customer.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
