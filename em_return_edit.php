<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from bill_item where bit_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_GET["id"];

			$bit_arrived_pp_date    =$_POST["txt_arrived_pp_date"];
			$bit_ret_border_date    =$_POST["txt_ret_border_date"];
			$bit_ret_port_date    =$_POST["txt_ret_port_date"];
			$v_txt_arrived    =$_POST["txt_arrived"];
			$v_storage    =$_POST["txt_storage"];
			$v_dummerage    =$_POST["txt_dummerage"];
			$v_destination_em     =$_POST["txt_destination_em"];
			$v_price =$_POST["txt_price"];
			$v_empty_return_note =$_POST["txt_empty_return_note"];

			$sql = "UPDATE bill_item SET bit_storage = '$v_storage'
									, bit_dummerage = '$v_dummerage'
									, bit_destination_em = '$v_destination_em'
									, bit_price = '$v_price'
									, bit_empty_return_note = '$v_empty_return_note'
									, bit_arrived_pp_date = '$bit_arrived_pp_date'
									, bit_ret_border_date = '$bit_ret_border_date'
									, bit_ret_port_date = '$bit_ret_port_date'
									WHERE bit_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:em_return.php?message=update");
	}	
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />


<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h3 class="text-primary">Edit EM & Return</h3>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name="id" value = "<?php echo $id; ?>">          
								
		                        								
								<div class="form-group col-xs-6">
		                            <label for ="">Arrived PP Date:</label>                                          
		                       		<input class="form-control" name="txt_arrived_pp_date" type="date" value="<?php echo $row["bit_arrived_pp_date"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Ret Border Date:</label>                                          
		                       		<input class="form-control" name="txt_ret_border_date" type="date" value="<?php echo $row["bit_ret_border_date"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Ret Port Date:</label>                                          
		                       		<input class="form-control" name="txt_ret_port_date" type="date" value="<?php echo $row["bit_ret_port_date"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Storage:</label>                                          
		                       		<input class="form-control" name="txt_storage" type="text" value="<?php echo $row["bit_storage"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Dummerage:</label>                                          
		                       		<input class="form-control" name="txt_dummerage" type="text" value="<?php echo $row["bit_dummerage"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Destination_em_return:</label>                                          
		                       		<input class="form-control" name="txt_destination_em" type="text" value="<?php echo $row["bit_destination_em"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Price:</label>                                          
		                       		<input class="form-control" name="txt_price" type="number" value="<?php echo $row["bit_price"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Empty Return Note:</label>                                          
		                       		<input class="form-control" name="txt_empty_return_note" type="text" value="<?php echo $row["bit_empty_return_note"]?>">
		                        </div>
	
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="em_return.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	
<?php include 'footer.php';?>