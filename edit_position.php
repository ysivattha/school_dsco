<?php include'config/db_connect.php';

    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from position where position_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$pos = $_POST["pos"];
			
		
			$sql = "UPDATE position SET position ='$pos'
									
												WHERE
										   position_id = '$id'";
			mysqli_query($connect, $sql);
			header("location:position.php?message=update");
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
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Position:</label>                                          
									<input class="form-control" required name="pos" type="text" placeholder="Position" value = "<?php echo $row["position"]?>">    
								</div>
								<div class="form-group col-xs-12">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
                					<a href="position.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>
