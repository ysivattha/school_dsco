<?php
	include'config/db_connect.php';

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from tbl_user_active where ua_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$v_name = $_POST["catename"];
   		    $v_note = $_POST["note"];

			$sql = "UPDATE tbl_user_active 
							SET ua_name = '$v_name'
								, ua_note = '$v_note' 
							WHERE ua_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:user_active.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Category</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-12">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
		                            <label for ="">User Active:</label>                                          
		                       		<input class="form-control" required  name="catename" type="text" value = "<?php echo $row["ua_name"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["ua_note"]?></textarea>
		                          </div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Save</button>
									<a href="user_active.php" class="btn btn-danger">Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>