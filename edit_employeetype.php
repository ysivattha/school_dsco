<?php include'config/db_connect.php';

    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from employeetype where etid = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$v_id = $_POST["id"];
			$v_name = $_POST["txtname"];
			$v_note = $_POST["txtnote"];
		
			$sql = "UPDATE employeetype SET etname ='$v_name'
											,etnote ='$v_note'
										WHERE etid = '$id'";
			mysqli_query($connect, $sql);
			header("location:employeetype.php?message=update");
	}

?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                
                	<div class="panel-body"><h2 class="text-primary">Edit Position</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-12">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Type:</label>                                          
									<input class="form-control" required name="txtname" type="text" value = "<?php echo $row["etname"]?>">    
								</div>
								<div class="form-group col-xs-12">
									<label for ="">Note:</label>                                          
									<input class="form-control" name="txtnote" type="text" value = "<?php echo $row["etnote"]?>">    
								</div>
								<div class="form-group col-xs-12">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
                					<a href="employeetype.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>
