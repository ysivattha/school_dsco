<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM truck_number AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_truck_num   =$_POST["txt_truck_num"];
		$v_truck_name     =$_POST["txt_truck_name"];

		$sql = "INSERT INTO truck_number (tnum_number
								, tnum_truck_id 
											)
							VALUES
								('$v_truck_num'
								, '$v_truck_name'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:truck_number.php?message=success');
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
                	<div class="panel-body"><h2 class="text-primary">Add Truck Number</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
							<div class="form-group col-xs-12">
		                            <label for ="">Truck Number:</label>                                          
		                       		<input class="form-control" name="txt_truck_num" type="text" >
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for ="">Name / Code:</label>
									<select class="form-control"  name="txt_truck_name">
										<?php
											$select1 = "SELECT * FROM truck";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['tr_id']==$row1['bo_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['tr_id']; ?>"><?= $row1['tr_name']; ?>(<?= $row1['tr_code']; ?>)</option>
										<?php endwhile; ?>
									</select>
		                        </div>
								

								<div class="form-group col-xs-6">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="truck_number.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
