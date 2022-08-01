<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from truck where tr_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_tr_num   =0;
			$v_tr_type     =$_POST["txt_tr_type"];
			$v_tr_name  =$_POST["txt_tr_name"];
			$v_tr_cheque  =$_POST["txt_tr_cheque"];
			$v_tr_code     =$_POST["txt_tr_code"];
			$v_tr_phone   =$_POST["txt_tr_phone"];
			$v_tr_unit     =$_POST["txt_tr_unit"];
			$v_tr_address     =$_POST["txt_tr_address"];
			$datetime = date('Y-m-d H:i:s');
			
			$sql = "UPDATE truck SET tr_num = '$v_tr_num'
										, tr_type = '$v_tr_type' 
										, tr_name = '$v_tr_name' 
										, tr_cheque = '$v_tr_cheque' 
										, tr_code = '$v_tr_code' 
										, tr_phone = '$v_tr_phone'
										, tr_unit = '$v_tr_unit'
										, tr_address = '$v_tr_address'
										, tr_datetime = '$datetime'
									WHERE tr_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:truck.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Big Truck</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								
		                        <div class="form-group col-xs-6">
		                            <label for ="">Type Truck:</label>                                          
		                       		<input class="form-control" name="txt_tr_type" type="text" value="<?php echo $row["tr_type"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Name:</label>                                          
		                       		<input class="form-control" name="txt_tr_name" type="text" value="<?php echo $row["tr_name"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Name of Cheque:</label>                                          
		                       		<input class="form-control" name="txt_tr_cheque" type="text" value="<?php echo $row["tr_cheque"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Code:</label>                                          
		                       		<input class="form-control" name="txt_tr_code" type="text" value="<?php echo $row["tr_code"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Phone:</label>                                          
		                       		<input class="form-control" name="txt_tr_phone" type="text" value="<?php echo $row["tr_phone"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Unit Truck:</label>                                          
		                       		<input class="form-control" name="txt_tr_unit" type="text" value="<?php echo $row["tr_unit"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Address:</label>                                          
		                       		<input class="form-control" name="txt_tr_address" type="text" value="<?php echo $row["tr_address"]?>">
		                        </div>

		                    
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="truck.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>