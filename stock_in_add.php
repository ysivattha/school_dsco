<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM stock_in
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_date = $_POST["txt_date"];
		$v_item = $_POST["txt_item"];
		$v_qty_in = $_POST["txt_qty_in"];
		$v_price_in   =$_POST["txt_price_in"];
			$v_amount_in =$v_qty_in*$v_price_in;

        $v_pay   =$_POST["txt_pay"];
			$v_ap =$v_amount_in-$v_pay;

		$v_supplier   =$_POST["txt_supplier"];
		$v_note   =$_POST["txt_note"];

		$sql = "INSERT INTO stock_in (sin_date
								, sin_item_id
								, sin_qty_in
								, sin_price_in
								, sin_amount_in
								, sin_pay
								, sin_ap
								, sin_supply_id
								, sin_note
											)
							VALUES
								('$v_date'
								, '$v_item'
								, '$v_qty_in'
								, '$v_price_in'
								, '$v_amount_in'
								, '$v_pay'
								, '$v_ap'
								, '$v_supplier'
								, '$v_note'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:stock_in.php?message=success');
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
                	<div class="panel-body"><h3 class="text-primary">Add Stock In</h3>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-12">
		                            <label for ="">Class:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $today; ?>" >
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
		                            <label for ="">Qty_In:</label>                                          
		                       		<input class="form-control" name="txt_qty_in" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Price_In:</label>                                          
		                       		<input class="form-control" name="txt_price_in" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Pay:</label>                                          
		                       		<input class="form-control" name="txt_pay" type="text" >
		                        </div>
								<div class = "from-group col-xs-12">
									<label for = "">Suppler:</label>
									<select class = "form-control select2" name="txt_supplier">
									<option value="">===Select===</option>
										<?php
											$product = mysqli_query($connect,"SELECT * FROM vender ");
											while ($row1 = mysqli_fetch_assoc($product)) { ?>
											<option value="<?php echo $row1['vender_id']; ?>"><?php echo $row1['vendername_en'];?> <?php echo $row1['vendername_kh'];?></option>
										<?php 
										}
										?>   
									</select>
									<br><br>
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="stock_in.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
