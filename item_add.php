<?php include'config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

	$get_id = $_GET["edit_id"];

	$errors = ""; 
	$sql = "SELECT * FROM payment_detail
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_item = $_POST["txt_item"];
		$v_qty = $_POST["txt_qty"];
		$v_price = $_POST["txt_price"];
			$v_amount =$v_qty*$v_price;
		$v_note = $_POST["txt_note"];

		$get_id = $_GET["edit_id"];

		$sql = "INSERT INTO payment_detail (payd_payment_id
								, payd_item_id
								, payd_qty
								, payd_price
								, payd_amount
								, payd_note
											)
							VALUES
								('$get_id'
								, '$v_item'
								, '$v_qty'
								, '$v_price'
								, '$v_amount'
								, '$v_note'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header("location:received_payment_detail.php?edit_id=$get_id");
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
                	<div class="panel-body"><h2 class="text-primary">Add Item</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								
								<div class = "from-group col-xs-12">
									<label for = "">Item:</label>
									<select class = "form-control" name="txt_item">
									<option value=""> === Choose === </option>
										<?php
											$product = mysqli_query($connect,"SELECT * FROM item");
											while ($row1 = mysqli_fetch_assoc($product)) { ?>
											<option value="<?php echo $row1['ite_id']; ?>"><?php echo $row1['ite_name'];?> </option>
										<?php 
										}
										?>   
									</select>
									<br>
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Qty:</label>                                          
		                       		<input class="form-control" name="txt_qty" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Price:</label>                                          
		                       		<input class="form-control" name="txt_price" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="received_payment_detail.php?edit_id=<?php echo $get_id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
