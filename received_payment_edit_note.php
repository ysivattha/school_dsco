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

			$v_note   =$_POST["txt_note"];
			$v_date_alert   =$_POST["txt_date_alert"];
			$v_text_alert   =$_POST["txt_alert"];

			$sql = "UPDATE payment SET pay_note = '$v_note'
									, pay_date_alert = '$v_date_alert'
									, pay_stop_alert = '$v_text_alert'
									WHERE pay_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:payment.php?message=update");
	}	
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Note Info</h2>
                	
                </div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>"> 
								
								<div class="form-group col-xs-12">
		                            <label for ="">Date_Alert:</label>                                          
		                       		<input class="form-control" name="txt_date_alert" type="date" value="<?php echo $row["pay_date_alert"]?>" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" value="<?php echo $row["pay_note"]?>" >
		                        </div>
								<div class="form-group col-xs-12">
		                        	<label for ="">Status:</label>                                          
	                                <select class = "form-control select2" name = "txt_alert">
										<?php
											$v_select = mysqli_query($connect,"SELECT * FROM text_stop_alert");
											while ($row_select = mysqli_fetch_assoc($v_select)) { 
												if($row["pay_stop_alert"] == $row_select["sa_name"]){
												?>
													<option selected="selected" value="<?php echo $row_select['sa_name']; ?>"><?php echo $row_select['sa_name'] ; ?></option>
												<?php
												}else{
												?>
													<option value="<?php echo $row_select['sa_name']; ?>"><?php echo $row_select['sa_name'] ; ?></option>
												<?php
												}   
											}
										 ?>     
									</select> 
		                        </div>
								

								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="payment.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>