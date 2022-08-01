<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM expense
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_date = $_POST["txt_date"];
		$v_expense_cat = $_POST["txt_expense_cat"];
		$v_description = $_POST["txt_description"];
		$v_amount = $_POST["txt_amount"];
		$v_pay_to = $_POST["txt_pay_to"];
		$v_note = $_POST["txt_note"];

		// insert expense
		$sql = "INSERT INTO expense (exp_date
								, exp_expense_cat
								, exp_description
								, exp_amount
								, exp_pay_to
								, exp_note
											)
							VALUES
								('$v_date'
								, '$v_expense_cat'
								, '$v_description'
								, '$v_amount'
								, '$v_pay_to'
								, '$v_note'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:expense_list.php?message=success');
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
                	<div class="panel-body"><h3 class="text-primary">Add Expense</h3>
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
									<label for = "">Expense_Category:</label>
									<select class = "form-control select2" name="txt_expense_cat">
									<option value="">===Select===</option>
										<?php
											$product = mysqli_query($connect,"SELECT * FROM expense_category ");
											while ($row1 = mysqli_fetch_assoc($product)) { ?>
											<option value="<?php echo $row1['exca_id']; ?>"><?php echo $row1['exca_name'];?></option>
										<?php 
										}
										?>   
									</select>
									<br><br>
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Description:</label>                                          
		                       		<input class="form-control" name="txt_description" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Amount:</label>                                          
		                       		<input class="form-control" name="txt_amount" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Pay_to:</label>                                          
		                       		<input class="form-control" name="txt_pay_to" type="text" >
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
