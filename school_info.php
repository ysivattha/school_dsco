<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	
		$id = 1;
		$sql = "SELECT * FROM school_info WHERE in_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_name_kh = $_POST["txt_name_kh"];
			$v_name_en = $_POST["txt_name_en"];
			$v_phone = $_POST["txt_phone"];
			$v_email = $_POST["txt_email"];
			$v_website = $_POST["txt_website"];
			$v_address = $_POST["txt_address"];

			$sql = "UPDATE school_info SET in_name_kh = '$v_name_kh'
											, in_name_en = '$v_name_en'
											, in_phone = '$v_phone'
											, in_email = '$v_email'
											, in_website = '$v_website'
											, in_address = '$v_address'
											WHERE in_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:school_info.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
	  <div class="col-xs-12">
        <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete Data</h4>';
                      echo '</div>';
                    }
                    ?>
    </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">School Info</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name="id" value = "<?php echo $id; ?>">          
								<div class="form-group col-xs-12">
		                            <label for ="">School Name(KH):</label>                                          
		                       		<input class="form-control" name="txt_name_kh" type="text" value="<?php echo $row["in_name_kh"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">School Name(EN):</label>                                          
		                       		<input class="form-control" name="txt_name_en" type="text" value="<?php echo $row["in_name_en"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Phone:</label>                                          
		                       		<input class="form-control" name="txt_phone" type="text" value="<?php echo $row["in_phone"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Email:</label>                                          
		                       		<input class="form-control" name="txt_email" type="text" value="<?php echo $row["in_email"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Website:</label>                                          
		                       		<input class="form-control" name="txt_website" type="text" value="<?php echo $row["in_website"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Address:</label>                                          
		                       		<input class="form-control" name="txt_address" type="text" value="<?php echo $row["in_address"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for ="">Banner:
										<a href="upload_photo_banner.php?sent_id=1&sent_img=<?= $row['in_banner'] ?>">
											<i class="fa fa-pencil"></i>
										</a>
									</label>                                          
									<a href="img/<?= $row['in_banner'] ?>">
										<img height="90px" src="img/<?= $row['in_banner']; ?>"
									</a>
									
		                        </div>
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="dashboard.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>