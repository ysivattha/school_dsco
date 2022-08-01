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
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

			$v_date = $_POST["txt_date"];
			$v_student = $_POST["txt_student"];
			$v_course   =$_POST["txt_course"];
			$v_product   =$_POST["txt_product"];
			$v_discount   =$_POST["txt_discount"];
			$v_pay   =$_POST["txt_pay"];
			$v_rest   =$_POST["txt_rest"];
			$v_date_alert   =$_POST["txt_date_alert"];

			$user_id = $_SESSION['user_id'];
			$v_note   =$_POST["txt_note"];
			$show_id = $_GET["edit_id"];

			$sql = "UPDATE payment SET pay_date = '$v_date'
									, pay_student_id = '$v_student'
									, pay_course_id = '$v_course'
									, pay_product_id = '$v_product'
									, pay_discount = '$v_discount'
									, pay_pay = '$v_pay'
									, pay_rest = '$v_rest'
									, pay_date_alert = '$v_date_alert'
									, pay_user_id = '$user_id'
									, pay_note = '$v_note'
									WHERE pay_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:received_payment_detail.php?edit_id=$show_id");
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
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>"> 
								<div class="form-group col-xs-6">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" value="<?php echo $row["pay_date"]?>" >
		                        </div>  
								<div class="form-group col-xs-6">
		                        	<label for ="">Student:</label>                                          
	                                <select class = "form-control select2" name = "txt_student">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM student");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["pay_student_id"] == $row_select["stu_id"]){
												?>
													<option selected="selected" value="<?php echo $row_select['stu_id']; ?>">(<?php echo $row_select['stu_card_id'] ; ?>) <?php echo $row_select['stu_name_en'] ;?> : <?php echo $row_select['stu_name_kh'] ;?> </option>
												<?php
												}else{
												?>
													<option value="<?php echo $row_select['stu_id']; ?>">(<?php echo $row_select['stu_card_id'] ; ?>) <?php echo $row_select['stu_name_en'] ;?> : <?php echo $row_select['stu_name_kh'] ;?> </option>
												<?php
												}   
											}
										 ?>     
									</select> 
		                        </div>
								<div class="form-group col-xs-6">
		                        	<label for ="">Course:</label>                                          
	                                <select class = "form-control select2" name = "txt_course">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM course");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["pay_course_id"] == $row_select["co_id"]){
												?>
													<option selected="selected" value="<?php echo $row_select['co_id']; ?>"><?php echo $row_select['co_name'] ; ?></option>
												<?php
												}else{
												?>
													<option value="<?php echo $row_select['co_id']; ?>"><?php echo $row_select['co_name'] ; ?> <?php echo $row_select['co_generation'] ; ?></option>
												<?php
												}   
											}
										 ?>     
									</select> 
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Discount:</label>                                          
		                       		<input class="form-control" name="txt_discount" type="text" value="<?php echo $row["pay_discount"]?>" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Pay:</label>                                          
		                       		<input class="form-control" name="txt_pay" type="text" value="<?php echo $row["pay_pay"]?>" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Rest:</label>                                          
		                       		<input class="form-control" name="txt_rest" type="text" value="<?php echo $row["pay_rest"]?>" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Date Alert:</label>                                          
		                       		<input class="form-control" name="txt_date_alert" type="date" value="<?php echo $row["pay_date_alert"]?>" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["pay_note"]?>" >
		                        </div>
								

								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="received_payment_detail.php?edit_id=<?php echo $id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>