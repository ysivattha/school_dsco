<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM payment
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$vmain_date = $_POST["txt_date"];
		$vmain_note   =$_POST["txt_note"];

			// insert payment
			$sql_main = "INSERT INTO payment (pay_date
									, pay_note
												)
								VALUES
									('$vmain_date'
									, '$vmain_note'
													)";
			$result_main = mysqli_query($connect, $sql_main);

			// get last payment id
			$sql_get = "SELECT * FROM payment
							ORDER BY pay_id DESC
							LIMIT 1
						";
			$result_get = $connect->query($sql_get);
			$row_get = $result_get->fetch_assoc();
			$get_last_id =$row_get["pay_id"];

		$v_item = $_POST["txt_item"];
		$v_qty = 1;
		$v_price = $_POST["txt_amount"];
		$v_amount = $_POST["txt_amount"];
		$v_note   =$_POST["txt_note"];

		// insert payment detail
		$sql = "INSERT INTO payment_detail (payd_payment_id
								, payd_item_id
								, payd_qty
								, payd_price
								, payd_amount
								, payd_note
											)
							VALUES
								('$get_last_id'
								, '$v_item'
								, '$v_qty'
								, '$v_price'
								, '$v_amount'
								, '$v_note'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:revenue_list.php?message=success');
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
                	<div class="panel-body"><h3 class="text-primary">Add Revenue</h3>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-12">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $today; ?>">
		                        </div>
								<div class = "from-group col-xs-12">
									<label for = "">Product_Item:</label>
									<select class = "form-control select2" name="txt_item">
									<option value="">===Select===</option>
										<?php
											$product = mysqli_query($connect,"SELECT * FROM item ");
											while ($row1 = mysqli_fetch_assoc($product)) { ?>
											<option value="<?php echo $row1['ite_id']; ?>"><?php echo $row1['ite_code'];?> <?php echo $row1['ite_name'];?></option>
										<?php 
										}
										?>   
									</select>
									<br><br>
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Amount:</label>                                          
		                       		<input class="form-control" name="txt_amount" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="revenue_list.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
