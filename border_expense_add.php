<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
	$month = date('Y-m');

	$errors = ""; 
	$sql = "SELECT * FROM border_expense AS A
									";
	$result = $connect->query($sql);
	$row = $result->fetch_assoc();

	if(isset($_POST["btnadd"])){
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

		$sql = "INSERT INTO border_expense (bor_date
								, bor_customer 
								, bor_description 
								, bor_qty
								, bor_kgs
								, bor_cbm
								, bor_total_kgs
								, bor_total_cbm
								, bor_tax
								, bor_price
								, bor_amount
								, bor_vn_truck_no
								, bor_remark
											)
							VALUES
								('$v_date'
								, '$v_customer'
								, '$v_description'
								, '$v_qty'
								, '$v_kgs'
								, '$v_cbm'
								, '$v_total_kgs'
								, '$v_total_cbm'
								, '$v_tax'
								, '$v_price'
								, '$v_amount'
								, '$v_vn_truck_no'
								, '$v_remark'
												)";

		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:border_expense.php?message=success');
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
                	<div class="panel-body"><h2 class="text-primary">Add Border Expense</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-4">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" >
		                        </div>
		                        <div class="form-group col-xs-4">
		                            <label for ="">Customer:</label> 
									
									<select name="txt_customer" class="form-control select2" data-live-search="true" >
									<option value="">=== choose here ===</option>
										<?php
										
											$select1 = "SELECT * FROM customer";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bor_customer']==$row1['cus_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['cus_id']; ?>"><?= $row1['cus_num_id'].' : '.$row1['cus_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Description:</label>                                          
		                       		<input class="form-control" name="txt_description" type="text" >
		                        </div>

								<div class="form-group col-xs-4">
		                            <label for ="">Qty:</label>                                          
		                       		<input class="form-control" id="idqty" name="txt_qty" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">KGS:</label>                                          
		                       		<input class="form-control" id="idkgs" name="txt_kgs" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">CBM:</label>                                          
		                       		<input class="form-control" id="idcbm" name="txt_cbm" type="text" >
		                        </div>

								<div class="form-group col-xs-4">
		                            <label for ="">Total_KGS:</label>                                          
		                       		<input class="form-control" readonly id="idtotal_kgs" name="txt_total_kgs" type="text" onClick="fun_total_kgs()">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Total_CBM:</label>                                          
		                       		<input class="form-control" readonly id="idtotal_cbm" name="txt_total_cbm" type="text" onClick="fun_total_cbm()">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Tax:</label>                                          
		                       		<input class="form-control" name="txt_tax" type="text" >
		                        </div>

								<div class="form-group col-xs-4">
		                            <label for ="">Price:</label>                                          
		                       		<input class="form-control" name="txt_price" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Amount:</label>                                          
		                       		<input class="form-control" name="txt_amount" type="text" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">VN_Truck_No:</label>                                          
		                       		<input class="form-control" name="txt_vn_truck_no" type="text" >
		                        </div>

								<div class="form-group col-xs-4">
		                            <label for ="">Remark:</label>                                          
		                       		<input class="form-control" name="txt_remark" type="text" >
		                        </div>
		                        
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="border_expense.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
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
