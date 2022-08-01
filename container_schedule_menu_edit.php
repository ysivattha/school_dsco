<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from container_schedule_menu where conm_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_show = $_POST["txt_show"];

			$sql = "UPDATE container_schedule_menu SET conm_show_hide = '$v_show'
									WHERE conm_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:container_schedule_menu.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Show/Hide</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								<div class="form-group col-xs-12">
		                            <label for ="">Show / Hide:</label>                                          
									<select class="form-control" name="txt_show">
										<?php
											$select1 = "SELECT * FROM menu_show_hide";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['conm_show_hide']==$row1['msh_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['msh_id']; ?>"><?= $row1['msh_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
		                        
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="container_schedule_menu.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>