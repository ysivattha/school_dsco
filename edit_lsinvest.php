<?php include'config/db_connect.php';

    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from lsinvest where ls_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$v_total_pv = $_POST["txt_total_pv"];
			$v_cost_pv = $_POST["txt_cost_pv"];
			$v_total_leader = $_POST["txt_total_leader"];
		
			$sql = "UPDATE lsinvest SET ls_total_pv ='$v_total_pv'
										, ls_cost_pv ='$v_cost_pv'
										, ls_total_leader ='$v_total_leader'
												WHERE
												ls_id = '$id'";
			mysqli_query($connect, $sql);
			header("location:lsinvest.php?message=update");
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
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-12">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Total PV:</label>                                          
									<input class="form-control" name="txt_total_pv" type="text" value = "<?php echo $row["ls_total_pv"]?>">    
								</div>
								<div class="form-group col-xs-12">
									<label for ="">Cost PV:</label>                                          
									<input class="form-control" name="txt_cost_pv" type="text" value = "<?php echo $row["ls_cost_pv"]?>">    
								</div>
								<div class="form-group col-xs-12">
									<label for ="">Total Leader:</label>                                          
									<input class="form-control" name="txt_total_leader" type="text" value = "<?php echo $row["ls_total_leader"]?>">    
								</div>
								<div class="form-group col-xs-12">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
                					<a href="lsinvest.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>
