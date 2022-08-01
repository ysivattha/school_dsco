<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM room AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_name = $_POST["txt_name"];
		$v_note = $_POST["txt_note"];

		$sql = "INSERT INTO room (ro_name
								, ro_note
											)
							VALUES
								('$v_name'
								, '$v_note'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:room.php?message=success');
		}
		
	}

?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
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
            <div class="panel panel-default">
                	<div class="panel-body"><h2 class="text-primary">Add Room</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-12">
		                            <label for ="">Name:</label>                                          
		                       		<input class="form-control" name="txt_name" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="room.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
