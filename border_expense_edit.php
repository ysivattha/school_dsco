<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from border_expense where bor_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_date = $_POST["txt_date"];
			$v_customer = $_POST["txt_customer"];
			$v_description = $_POST["txt_description"];
			$v_qty = $_POST["txt_qty"];
			$v_kgs = $_POST["txt_kgs"];
			$v_cbm = $_POST["txt_cbm"];
			$v_total_kgs = $_POST["txt_total_kgs"];
			$v_total_cbm = $_POST["txt_total_cbm"];
			$v_tax = $_POST["txt_tax"];
			$v_price = $_POST["txt_price"];
			$v_amount = $_POST["txt_amount"];
			$v_vn_truck_no = $_POST["txt_vn_truck_no"];
			$v_remark = $_POST["txt_remark"];


			$sql = "UPDATE border_expense SET bor_date = '$v_date'
									, bor_customer = '$v_customer'
									, bor_description = '$v_description'
									, bor_qty = '$v_qty'
									, bor_kgs = '$v_kgs'
									, bor_cbm = '$v_cbm'
									, bor_total_kgs = '$v_total_kgs'
									, bor_total_cbm = '$v_total_cbm'
									, bor_tax = '$v_tax'
									, bor_price = '$v_price'
									, bor_amount = '$v_amount'
									, bor_vn_truck_no = '$v_vn_truck_no'
									, bor_remark = '$v_remark'
									WHERE bor_id = '$id'" ;

			mysqli_query($connect, $sql);
			header("location:border_expense.php?message=update");
	}	
?>

<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Border Expense</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								<div class="form-group col-xs-4">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $row["bor_date"]?>">
		                        </div>
								<div class="form-group col-xs-4">
									<label for ="">Customer:</label>                                          
									<select name="txt_customer" class="form-control select2" data-live-search="true">
										<?php
											$select1 = "SELECT * FROM customer";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bor_customer']==$row1['cus_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['cus_id']; ?>"><?= $row1['cus_name']; ?>(<?= $row1['cus_num_id']; ?>)</option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Description:</label>                                          
		                       		<input class="form-control" name="txt_description" type="text" value="<?php echo $row["bor_description"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Qty:</label>                                          
		                       		<input class="form-control" id="idqty" name="txt_qty" type="text" value="<?php echo $row["bor_qty"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">KGS:</label>                                          
		                       		<input class="form-control" id="idkgs" name="txt_kgs" type="text" value="<?php echo $row["bor_kgs"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">CBM:</label>                                          
		                       		<input class="form-control" id="idcbm" name="txt_cbm" type="text" value="<?php echo $row["bor_cbm"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Total_KGS:</label>                                          
		                       		<input class="form-control" readonly id="idtotal_kgs" name="txt_total_kgs" type="text" onClick="fun_total_kgs()" value="<?php echo $row["bor_total_kgs"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Total_CBM:</label>                                          
		                       		<input class="form-control" readonly id="idtotal_cbm" name="txt_total_cbm" type="text" onClick="fun_total_cbm()" value="<?php echo $row["bor_total_cbm"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Tax:</label>                                          
		                       		<input class="form-control" name="txt_tax" type="text" value="<?php echo $row["bor_tax"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Price:</label>                                          
		                       		<input class="form-control" name="txt_price" type="text" value="<?php echo $row["bor_price"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Amount:</label>                                          
		                       		<input class="form-control" name="txt_amount" type="text" value="<?php echo $row["bor_amount"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">VN_Truck_No:</label>                                          
		                       		<input class="form-control" name="txt_vn_truck_no" type="text" value="<?php echo $row["bor_vn_truck_no"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Remark:</label>                                          
		                       		<input class="form-control" name="txt_remark" type="text" value="<?php echo $row["bor_remark"]?>">
		                        </div>
								
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="border_expense.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	
<script type="text/javascript">
    function fun_total_kgs(){
        var idqty = document.getElementById('idqty').value;
        var idkgs = document.getElementById('idkgs').value;
        var idtotal_kgs = Number(idqty) * Number(idkgs);
        document.getElementById('idtotal_kgs').value = idtotal_kgs;
    }
	function fun_total_cbm(){
        var idqty = document.getElementById('idqty').value;
        var idcbm = document.getElementById('idcbm').value;
        var idtotal_cbm = Number(idqty) * Number(idcbm);
        document.getElementById('idtotal_cbm').value = idtotal_cbm;
    }
</script>
<?php include 'footer.php';?>