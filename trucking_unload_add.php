<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
	$month = date('Y-m');

	$errors = ""; 
	$sql = "SELECT * FROM trucking_unload AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){

		$v_border  =$_POST["txt_border"];
		$v_customer  =$_POST["txt_customer"];
		$v_ctnr    =$_POST["txt_ctnr"];
		$v_type    =$_POST["txt_type"];
		$v_eta    =$_POST["txt_eta"];
		$v_qty     =$_POST["txt_qty"];
		$v_gw =$_POST["txt_gw"];
		$v_cbm =$_POST["txt_cbm"];

		$sql = "INSERT INTO trucking_unload (tu_border_id
								, tu_code 
								, tu_ctnr 
								, tu_type 
								, tu_eta
								, tu_qty
								, tu_gw
								, tu_cbm
											)
							VALUES
								('$v_border'
								, '$v_customer'
								, '$v_ctnr'
								, '$v_type'
								, '$v_eta'
								, '$v_qty'
								, '$v_gw'
								, '$v_cbm'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:trucking_unload.php?message=success');
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
                	<div class="panel-body"><h2 class="text-primary">Add Tracking & Unload</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">         
							
								<div class="form-group col-xs-6">
		                            <label for ="">Border:</label> 
									<select class="form-control select2"  name="txt_border" data-live-search="true">
									<option value="">=== choose here ===</option>
										<?php
											$select1 = "SELECT * FROM border";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bi_border']==$row1['bo_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['bo_id']; ?>"><?= $row1['bo_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer:</label> 
									<select class="form-control select2"  name="txt_customer" data-live-search="true">
									<option value="">=== choose here ===</option>
										<?php
											$select1 = "SELECT * FROM customer";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bi_customer']==$row1['cus_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['cus_id']; ?>"><?= $row1['cus_name']; ?>(<?= $row1['cus_num_id']; ?>)</option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">CTNR:</label>                                          
		                       		<input class="form-control" name="txt_ctnr" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Type:</label> 
									<select class="form-control select2"  name="txt_type" data-live-search="true">
									<option value="">=== choose here ===</option>
										<?php
											$select1 = "SELECT * FROM container_type";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['tu_type']==$row1['cont_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['cont_id']; ?>"><?= $row1['cont_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">ETA:</label>                                          
		                       		<input class="form-control" name="txt_eta" type="date" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">QTY:</label>                                          
		                       		<input class="form-control" name="txt_qty" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">GW:</label>                                          
		                       		<input class="form-control" name="txt_gw" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">CBM:</label>                                          
		                       		<input class="form-control" name="txt_cbm" type="text" >
		                        </div>
								

								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="trucking_unload.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
