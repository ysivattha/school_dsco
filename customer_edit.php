<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from customer where cus_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_cus_num_id = $_POST["txt_num_id"];
			$v_cus_name = $_POST["txt_name"];
   		    $v_cus_address = $_POST["txt_address"];
			$v_cus_country = $_POST["txt_country"];
			$v_cus_city = $_POST["txt_city"];
			$v_cus_phone = $_POST["txt_phone"];
			$v_cus_note = $_POST["txt_note"];

			$sql = "UPDATE customer SET cus_num_id = '$v_cus_num_id'
										, cus_name = '$v_cus_name'
										, cus_address = '$v_cus_address' 
										, cus_country = '$v_cus_country' 
										, cus_city = '$v_cus_city' 
										, cus_phone = '$v_cus_phone' 
										, cus_note = '$v_cus_note'
										, cus_datetime = '$datetime'
									WHERE cus_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:customer.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Customer</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								<div class="form-group col-xs-6">
		                            <label for ="">Customer ID:</label>                                          
		                       		<input class="form-control" name="txt_num_id" type="text" value="<?php echo $row["cus_num_id"]?>">
		                        </div>
		                        <div class="form-group col-xs-6">
		                            <label for ="">Customer Name:</label>                                          
		                       		<input class="form-control" name="txt_name" type="text" value="<?php echo $row["cus_name"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer Address:</label>                                          
		                       		<input class="form-control" name="txt_address" type="text" value="<?php echo $row["cus_address"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer County:</label>                                          
		                       		<input class="form-control" name="txt_country" type="text" value="<?php echo $row["cus_country"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer City:</label>                                          
		                       		<input class="form-control" name="txt_city" type="text" value="<?php echo $row["cus_city"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer Phone:</label>                                          
		                       		<input class="form-control" name="txt_phone" type="text" value="<?php echo $row["cus_phone"]?>">
		                        </div>

		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="3" name="txt_note"><?php echo $row["cus_note"]?></textarea>
		                          </div>
								<div class="form-group col-xs-6">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="customer.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>