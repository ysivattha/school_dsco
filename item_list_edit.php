<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM item WHERE ite_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_code = $_POST["txt_code"];
			$v_name = $_POST["txt_name"];
			$v_note = $_POST["txt_note"];

			$sql = "UPDATE item SET ite_code = '$v_code'
									, ite_name = '$v_name'
									, ite_note = '$v_note'
									WHERE ite_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:item_list.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Item Info</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
								<div class="form-group col-xs-12">
		                            <label for ="">Code:</label>                                          
		                       		<input class="form-control" name="txt_code" type="text" value="<?php echo $row["ite_code"]?>" >
		                        </div>          
								<div class="form-group col-xs-12">
		                            <label for ="">Name:</label>                                          
		                       		<input class="form-control" name="txt_name" type="text" value="<?php echo $row["ite_name"]?>" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Other:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["ite_note"]?>" >
		                        </div>
		                        
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="item_list.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>