<?php
	include'config/db_connect.php'; 
	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from category where cate_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$cate = $_POST["catename"];
   		    $note = $_POST["note"];

			$sql = "UPDATE category SET category_name = '$cate', note_cate = '$note' WHERE cate_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:category.php?message=update");
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
		                            <label for ="">Category Name:</label>                                          
		                       		<input class="form-control" required  name="catename" type="text" placeholder="Category Name" value = "<?php echo $row["category_name"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["note_cate"]?></textarea>
		                          </div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
									<a href="category.php" class="btn btn-danger">Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>