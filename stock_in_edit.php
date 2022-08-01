<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM stock_in WHERE sin_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_date = $_POST["txt_date"];
			$v_item = $_POST["txt_item"];
			$v_qty_in = $_POST["txt_qty_in"];
			$v_price_in   =$_POST["txt_price_in"];
				$v_amount_in =$v_qty_in*$v_price_in;

			$v_pay   =$_POST["txt_pay"];
				$v_ap =$v_amount_in-$v_pay;

			$v_supplier   =$_POST["txt_supplier"];
			$v_note   =$_POST["txt_note"];

			$sql = "UPDATE stock_in SET sin_date = '$v_date'
									, sin_item_id = '$v_item'
									, sin_qty_in = '$v_qty_in'
									, sin_price_in = '$v_price_in'
									, sin_amount_in = '$v_amount_in'
									, sin_pay = '$v_pay'
									, sin_ap = '$v_ap'
									, sin_supply_id = '$v_supplier'
									, sin_note = '$v_note'
									WHERE sin_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:stock_in.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Course Info</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								
								<div class="form-group col-xs-12">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $row["sin_date"]?>">
		                        </div>
								<div class="form-group col-xs-12">
									<label for ="">Product_Item:</label>
									<select class="form-control" name="txt_item" >
									<?php
										$select1 = "SELECT * FROM item";
										$query1  = mysqli_query($connect,$select1);
										while($row1 = $query1->fetch_assoc()):
										$selected=($row['sin_item_id']==$row1['ite_id']?"selected":"");
									?>
									<option <?= $selected; ?> value="<?= $row1['ite_id']; ?>"><?= $row1['ite_code']; ?> <?= $row1['ite_name']; ?></option>
									<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Qty_In:</label>                                          
		                       		<input class="form-control" name="txt_qty_in" type="text" value="<?php echo $row["sin_qty_in"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Price_In:</label>                                          
		                       		<input class="form-control" name="txt_price_in" type="text" value="<?php echo $row["sin_price_in"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Pay:</label>                                          
		                       		<input class="form-control" name="txt_pay" type="text" value="<?php echo $row["sin_pay"]?>">
		                        </div>
								<div class="form-group col-xs-12">
									<label for ="">Suppler:</label>
									<select class="form-control" name="txt_supplier" >
									<?php
										$select1 = "SELECT * FROM vender";
										$query1  = mysqli_query($connect,$select1);
										while($row1 = $query1->fetch_assoc()):
										$selected=($row['sin_supply_id']==$row1['vender_id']?"selected":"");
									?>
									<option <?= $selected; ?> value="<?= $row1['vender_id']; ?>"><?= $row1['vendername_en']; ?> <?= $row1['vendername_kh']; ?></option>
									<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["sin_note"]?>">
		                        </div>


								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="course.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>