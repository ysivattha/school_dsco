<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM stock_out_item WHERE sout_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}

	$get_id = $_GET["sent_id"];
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_date =$_POST["txt_date"];
			$v_time =$_POST["txt_time"];
			$v_qtyout =$_POST["txt_qtyout"];
			$v_employee =$_POST["txt_employee"];
			$v_note =$_POST["txt_note"];
			
			$sql = "UPDATE stock_out_item SET sout_date = '$v_date'
										, sout_time = '$v_time' 
										, sout_qtyout = '$v_qtyout' 
										, sout_employee = '$v_employee' 
										, sout_note = '$v_note' 
									WHERE sout_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:stock_out_item.php?sent_id=$get_id"); 
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Stock Out</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								
		                        <div class="form-group col-xs-6">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $row["sout_date"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Time:</label>                                          
		                       		<input class="form-control" name="txt_time" type="text" value="<?php echo $row["sout_time"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Qty_out:</label>                                          
		                       		<input class="form-control" name="txt_qtyout" type="text" value="<?php echo $row["sout_qtyout"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Employee:</label>                                          
		                       		<input class="form-control" name="txt_employee" type="text" value="<?php echo $row["sout_employee"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["sout_note"]?>">
		                        </div>
		                    
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="stock_out_item.php?sent_id=<?php echo $_GET["sent_id"]; ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>