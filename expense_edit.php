<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM expense WHERE exp_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_date = $_POST["txt_date"];
			$v_expense_cat = $_POST["txt_expense_cat"];
			$v_description = $_POST["txt_description"];
			$v_amount = $_POST["txt_amount"];
			$v_pay_to = $_POST["txt_pay_to"];
			$v_note = $_POST["txt_note"];
			
			$sql = "UPDATE expense SET exp_date = '$v_date'
									, exp_expense_cat = '$v_expense_cat'
									, exp_description = '$v_description'
									, exp_amount = '$v_amount'
									, exp_pay_to = '$v_pay_to'
									, exp_note = '$v_note'
									WHERE exp_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:expense_list.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Expense</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								
								<div class="form-group col-xs-12">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $row["exp_date"]?>">
		                        </div>
								<div class="form-group col-xs-12">
									<label for ="">Expense_Category:</label>
									<select class="form-control" name="txt_expense_cat" >
									<?php
										$select1 = "SELECT * FROM expense_category";
										$query1  = mysqli_query($connect,$select1);
										while($row1 = $query1->fetch_assoc()):
										$selected=($row['exp_expense_cat']==$row1['exca_id']?"selected":"");
									?>
									<option <?= $selected; ?> value="<?= $row1['exca_id']; ?>"><?= $row1['exca_name']; ?></option>
									<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Description:</label>                                          
		                       		<input class="form-control" name="txt_description" type="text" value="<?php echo $row["exp_description"]?>">
		                        </div>								
								<div class="form-group col-xs-12">
		                            <label for ="">Amount:</label>                                          
		                       		<input class="form-control" name="txt_amount" value="<?php echo $row["exp_amount"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Pay_to:</label>                                          
		                       		<input class="form-control" name="txt_pay_to" type="text" value="<?php echo $row["exp_pay_to"]?>">
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["exp_note"]?>">
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