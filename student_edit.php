<?php include'config/db_connect.php';

    if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM student WHERE stu_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
		$id = $_POST["id"];
		
		$v_date_register = $_POST["txt_date_register"];
		$v_card_id = $_POST["txt_card_id"];
		$v_name_en = $_POST["txt_name_en"];
		$v_name_kh = $_POST["txt_name_kh"];
		$v_sex = $_POST["txt_sex"];
		$v_dateofbirth = $_POST["txt_dateofbirth"];
		$v_national = $_POST["txt_national"];
		$v_phone = $_POST["txt_phone"];
		$v_address = $_POST["txt_address"];
		$v_note = $_POST["txt_note"];
		$v_stop = $_POST["txt_stop"];

			$sql = "UPDATE student SET stu_date_register ='$v_date_register'
									, stu_card_id 	= '$v_card_id' 
									, stu_name_en 	= '$v_name_en'
									, stu_name_kh 	= '$v_name_kh'
									, stu_sex 	= '$v_sex'
									, stu_dateofbirth	= '$v_dateofbirth'
									, stu_national		= '$v_national'
									, stu_phone		= '$v_phone'
									, stu_address	= '$v_address'
									, stu_note		= '$v_note'
									, stu_stop		= '$v_stop'
										WHERE stu_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:student.php?message=update");
	}
?>
<?php include 'header.php';?>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body"><h3 class="text-primary">Edit Student</h3>
                	
                </div>

                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
							<input type = "hidden" name="id" value = "<?php echo $id; ?>">
								<div class="form-group col-xs-4">
		                            <label for ="">Date_Register:</label>                                          
		                       		<input class="form-control" name="txt_date_register" type="date" value="<?php echo $row["stu_date_register"]?>">
		                        </div>
		                        <div class="form-group col-xs-4">
		                            <label for ="">Card_ID:</label>                                          
		                       		<input class="form-control" name="txt_card_id" type="text" value="<?php echo $row["stu_card_id"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Name_EN:</label>                                          
		                       		<input class="form-control" name="txt_name_en" type="text" value="<?php echo $row["stu_name_en"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Name_KH :</label>                                          
		                       		<input class="form-control" name="txt_name_kh" type="text" value="<?php echo $row["stu_name_kh"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Sex:</label>                                          
		                       		<input class="form-control" name="txt_sex" type="text" value="<?php echo $row["stu_sex"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Date_of_birth:</label>                                          
		                       		<input class="form-control" name="txt_dateofbirth" type="date" value="<?php echo $row["stu_dateofbirth"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">National:</label>                                          
		                       		<input class="form-control" name="txt_national" type="text" value="<?php echo $row["stu_national"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Phone:</label>                                          
		                       		<input class="form-control" name="txt_phone" type="text" value="<?php echo $row["stu_phone"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Address:</label>                                          
		                       		<input class="form-control" name="txt_address" type="text" value="<?php echo $row["stu_address"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="2" name="txt_note"><?php echo $row["stu_note"]?></textarea>
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Stop Learning:</label>
									   <select class="form-control" name="txt_stop" >
										<?php
											$select1 = "SELECT * FROM text_stop";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['stu_stop']==$row1['stop_name']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['stop_name']; ?>"><?= $row1['stop_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>							

								<div class="form-group col-xs-12">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="student.php" class="btn btn-danger"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>