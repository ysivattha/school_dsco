<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
	$id = $_GET["edit_id"];

	if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM payment WHERE pay_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}

	if(isset($_GET["del_id"])){
	$del_id = $_GET["del_id"];
	$main_id = $_GET["main_id"];

	$sql = "DELETE FROM payment_detail WHERE payd_id = '$del_id'";
	$result = mysqli_query($connect, $sql);
	
		header("location:received_payment_detail.php?edit_id=$main_id");
	}

	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_date = $_POST["txt_date"];
			$v_student = $_POST["txt_student"];
			$v_course   =$_POST["txt_course"];
			$v_product   =$_POST["txt_product"];
			$v_amount   =$_POST["txt_amount"];
			$v_discount   =$_POST["txt_discount"];
			$v_pay   =$_POST["txt_pay"];
			$v_rest   =$_POST["txt_rest"];
			$v_date_alert   =$_POST["txt_date_alert"];

			$user_id = $_SESSION['user_id'];
			$v_note   =$_POST["txt_note"];

			$sql = "UPDATE payment SET pay_date = '$v_date'
									, pay_student_id = '$v_student'
									, pay_course_id = '$v_course'
									, pay_product_id = '$v_product'
									, pay_amount = '$v_amount'
									, pay_discount = '$v_discount'
									, pay_pay = '$v_pay'
									, pay_rest = '$v_rest'
									, pay_date_alert = '$v_date_alert'
									, pay_user_id = '$user_id'
									, pay_note = '$v_note'
									WHERE pay_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:received_payment.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                	<h3 class="text-primary">Payment Detail</h3>
                	                
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>"> 
								<div class="form-group col-xs-4">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" readonly name="txt_date" type="date" value="<?php echo $row["pay_date"]?>" >
		                        </div>  
								<div class="form-group col-xs-4">
		                        	<label for ="">Student:</label>                                          
	                                <select class = "form-control select2" readonly name = "txt_student">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM student");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["pay_student_id"] == $row_select["stu_id"]){
												?>
													<option selected="selected" value="<?php echo $row_select['stu_id']; ?>">(<?php echo $row_select['stu_card_id'] ; ?>) <?php echo $row_select['stu_name_en'] ;?> : <?php echo $row_select['stu_name_kh'] ;?> </option>
												<?php
												} 
											}
										 ?>     
									</select> 
		                        </div>
								<div class="form-group col-xs-4">
		                        	<label for ="">Course:</label>                                          
	                                <select class = "form-control select2" name = "txt_course">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM course");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["pay_course_id"] == $row_select["co_id"]){
												?>
													<option selected="selected" value="<?php echo $row_select['co_id']; ?>"><?php echo $row_select['co_name'] ; ?></option>
												<?php
												} 
											}
										 ?>     
									</select> 
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Discount:</label>                                          
		                       		<input class="form-control" readonly name="txt_discount" type="text" value="<?php echo $row["pay_discount"]?>" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Pay:</label>                                          
		                       		<input class="form-control" readonly name="txt_pay" type="text" value="<?php echo $row["pay_pay"]?>" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Rest:</label>                                          
		                       		<input class="form-control" readonly name="txt_rest" type="text" value="<?php echo $row["pay_rest"]?>" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Date Alert:</label>                                          
		                       		<input class="form-control" readonly name="txt_date_alert" type="date" value="<?php echo $row["pay_date_alert"]?>" >
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" readonly name="txt_note" type="text" value="<?php echo $row["pay_note"]?>" >
		                        </div>
								

								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
									<a href="received_payment_edit.php?edit_id=<?php echo $id; ?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
									
									<a href="received_payment.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>

					<!-- sub table -->
					<div class="panel-body">
						<div class="table-responsive">
							<table id="example" class="display nowrap" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Item</th>
										<th>Qty</th>
										<th>Price</th>
										<th>Amount</th>
										<th>Note</th>
										<th class="text-center"><i class="fa fa-cog" aria-hidden="true"> </i>
											<?php
												$get_id = $_GET["edit_id"];
											?>
											<a href="item_add.php?edit_id=<?php echo $get_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
												
										</th>
									</tr>
								</thead>
								<tbody>
											<?php    
													$sub_id = $_GET["edit_id"];   
													$sql_sub = "SELECT * FROM payment_detail
																	LEFT JOIN item ON item.ite_id=payment_detail.payd_item_id
																	WHERE payd_payment_id=$sub_id
															";
													$result_sub = mysqli_query($connect, $sql_sub);
																				
													$i= 1;
													$v_amount_total =0;
													while($row_sub = $result_sub->fetch_assoc()) 
													{	
														$v_amount_total   +=$row_sub["payd_amount"];

														$v_id   =$row_sub["payd_id"];
														$v_payment_id   =$row_sub["payd_payment_id"];
														$v_item_id   =$row_sub["ite_name"];
														$v_qty   =$row_sub["payd_qty"];
														$v_price   =$row_sub["payd_price"];
														$v_amount_get   =$row_sub["payd_amount"];
															$v_amount =number_format($v_amount_get,2);

														$v_note   =$row_sub["payd_note"];
												?>
										<tr>
											<td> <?php echo $v_item_id;?> </td>
											<td> <?php echo $v_qty;?> </td>
											<td> <?php echo $v_price;?> </td>
											<td> <?php echo $v_amount;?> </td>
											<td> <?php echo $v_note;?> </td>
											<td class="text-center">
												<a href="item_edit.php?edit_id=<?php echo $v_id ?>&main_id=<?php echo $v_payment_id ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
												<a onclick="return confirm('Are you sure to delete?');" href="received_payment_detail.php?del_id=<?php echo $v_id ?>&main_id=<?php echo $v_payment_id ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
											<?php
												}	 
											?>
								</tbody>
								<tfoot>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td>Total: 
											<?php
												echo $v_amount_total;
											?>
										</td>
										<td></td>
										<td></td>
									</tr>
								</tfoot>
							</table>				
						</div>
					</div> <!-- sub table -->


				</div>
			</div>
		</div>
<?php include 'footer.php';?>