<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM payment_detail WHERE payd_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_item = $_POST["txt_item"];
			$v_qty = $_POST["txt_qty"];
			$v_price = $_POST["txt_price"];
				$v_amount =$v_qty*$v_price;
			$v_note = $_POST["txt_note"];
					
			$sql = "UPDATE payment_detail SET payd_item_id = '$v_item'
									, payd_qty = '$v_qty'
									, payd_price = '$v_price'
									, payd_amount = '$v_amount'
									, payd_note = '$v_note'
									WHERE payd_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:revenue_list.php");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                	<h2 class="text-primary">Edit Item</h2>
                	
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>"> 
								<div class="form-group col-xs-12">
		                            <label for ="">Item:</label>
									   <select class="form-control" name="txt_item" >
										<?php
											$select1 = "SELECT * FROM item";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['payd_item_id']==$row1['ite_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['ite_id']; ?>"><?= $row1['ite_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>       
								<div class="form-group col-xs-12">
		                            <label for ="">Qty:</label>                                          
		                       		<input class="form-control" name="txt_qty" type="text" value="<?php echo $row["payd_qty"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Price:</label>                                          
		                       		<input class="form-control" name="txt_price" type="text" value="<?php echo $row["payd_price"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["payd_note"]?>">
		                        </div>
		                        
								<div class="form-group col-xs-12">
									
										<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
										<a href="revenue_list.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
												
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>