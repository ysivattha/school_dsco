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
			$id = $_POST["id"];
			$v_export   =$_POST['txt_export'];

			$sql = "UPDATE bill_item SET bit_export = '$v_export'
									WHERE bit_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:con_schedule_export.php");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Update Export</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								
		                        
								<div class="form-group col-xs-6">
										<label for ="">Choose Export:</label>   
										<select class = "form-control" name = "txt_export">
											<option value="">==== Choose here ====</option>
												<?php
													$position = mysqli_query($connect,"SELECT * FROM export_text");
													while ($rows = mysqli_fetch_assoc($position)) { 
												?>
													<option value="<?php echo $rows['et_id']; ?>"><?php echo $rows['et_name']; ?></option>
												<?php	
													}
												?>	
										</select>    
								</div>
								
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="container_schedule.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Close</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
<?php include 'footer.php';?>