<?php include'config/db_connect.php';
$user_id = $_SESSION['user_id'];

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	

	$errors = ""; 
	$sql = "SELECT * FROM course AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_date = $_POST["txt_date"];
		$v_student = $_POST["txt_student"];
		$v_course   =$_POST["txt_course"];
		$v_discount   =$_POST["txt_discount"];
		$v_pay   =$_POST["txt_pay"];
		$v_rest   =$_POST["txt_rest"];
		$v_date_alert   =$_POST["txt_date_alert"];

		$user_id = $_SESSION['user_id'];
		$v_note   =$_POST["txt_note"];
		$v_stop_alert   ="Alert";

		$sql = "INSERT INTO payment (pay_date
								, pay_student_id
								, pay_course_id
								, pay_discount
								, pay_pay
								, pay_rest
								, pay_date_alert
								, pay_user_id
								, pay_note
								, pay_stop_alert
											)
							VALUES
								('$v_date'
								, '$v_student'
								, '$v_course'
								, '$v_discount'
								, '$v_pay'
								, '$v_rest'
								, '$v_date_alert'
								, '$user_id'
								, '$v_note'
								, '$v_stop_alert'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
		// update alert paid
				// get max id
				$sql_max = "SELECT MAX(pay_id) AS maxid FROM payment
						";  
				$result_max = $connect->query($sql_max);
				$row_max = $result_max->fetch_assoc();
				$get_max_id =$row_max['maxid'];

				// get max id end
			$v_student = $_POST["txt_student"];
			$v_paid = "Paid";
			$sql = "UPDATE payment SET pay_stop_alert = '$v_paid'
									WHERE pay_student_id = '$v_student'
									AND pay_id < $get_max_id
									" ;
			mysqli_query($connect, $sql);
		// update alert paid

			header('location:received_payment.php?message=success');
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
                	<div class="panel-body"><h3 class="text-primary">Add Payment</h3>
                		
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-12">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" >
		                        </div>
								<div class="form-group col-xs-12">
									<label for ="">Student:</label>                                          
										<select class = "form-control select2" style = "width:100%" name="txt_student">
											<option value="">==== Choose ====</option>
												<?php
												$v_select = mysqli_query($connect,"SELECT * FROM student");
												while ($row1 = mysqli_fetch_assoc($v_select)) { ?>
												<option value="<?php echo $row1['stu_id']; ?>">(<?php echo $row1['stu_card_id'] ;?>) <?php echo $row1['stu_name_en'] ;?> : <?php echo $row1['stu_name_kh'] ;?> </option>
												<?php 
												}
												?>   
										</select>
								</div>
								<div class="form-group col-xs-12">
									<label for ="">Course:</label>                                          
										<select class = "form-control select2" style = "width:100%" name="txt_course">
											<option value="">==== Choose ====</option>
												<?php
												$v_select = mysqli_query($connect,"SELECT * FROM course AS A
																					LEFT JOIN time_learn AS TL ON TL.ti_id=A.co_time");
												while ($row1 = mysqli_fetch_assoc($v_select)) { ?>
												<option value="<?php echo $row1['co_id']; ?>">(<?php echo $row1['co_name'] ;?>) <?php echo $row1['co_generation'] ;?> <?php echo $row1['ti_name'] ;?> </option>
												<?php 
												}
												?>   
										</select>           
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Discount:</label>                                          
		                       		<input class="form-control" name="txt_discount" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Pay:</label>                                          
		                       		<input class="form-control" name="txt_pay" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Rest:</label>                                          
		                       		<input class="form-control" name="txt_rest" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Date Alert:</label>                                          
		                       		<input class="form-control" name="txt_date_alert" type="date" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="received_payment.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
