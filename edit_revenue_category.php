<?php
	include'config/db_connect.php'; 
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from item where ite_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$v_name = $_POST["txt_name"];
   		    $v_note = $_POST["txt_note"];

			$sql = "UPDATE item 
						SET ite_name = '$v_name'
						, ite_note = '$v_note' 
						WHERE ite_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:revenue_category.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Revenue Category</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-12">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
		                            <label for ="">Revenue Category:</label>                                          
		                       		<input class="form-control" required  name="txt_name" type="text" value = "<?php echo $row["ite_name"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="4" id="note" name = "txt_note"><?php echo $row["ite_note"]?></textarea>
		                          </div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Save</button>
									<a href="revenue_category.php" class="btn btn-danger">Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>