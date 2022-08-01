<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM shift WHERE sh_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_name = $_POST["txt_name"];
			$v_note = $_POST["txt_note"];

			$sql = "UPDATE shift SET sh_name = '$v_name'
									, sh_note = '$v_note'
									WHERE sh_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:shift.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Shift Info</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name="id" value = "<?php echo $id; ?>">          
								<div class="form-group col-xs-12">
		                            <label for ="">Name:</label>                                          
		                       		<input class="form-control" name="txt_name" type="text" value="<?php echo $row["sh_name"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["sh_note"]?>">
		                        </div>
		                        
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="shift.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>