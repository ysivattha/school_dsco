<?php include'config/db_connect.php';

    if(isset($_GET["edit_id"])){
		$id = $_GET["edit_id"];
		$sql = "SELECT * FROM student_parent AS A
							LEFT JOIN student AS STU ON STU.stu_id=A.stup_main_id
							WHERE stup_main_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
		$id = $_POST["id"];
		
		$v_farther_name = $_POST["txt_farther_name"];
		$v_farther_national = $_POST["txt_farther_national"];
		$v_farther_occupation = $_POST["txt_farther_occupation"];
		$v_farther_phone = $_POST["txt_farther_phone"];
		$v_farther_card_id = $_POST["txt_farther_card_id"];
		$v_mother_name = $_POST["txt_mother_name"];
		$v_mother_national = $_POST["txt_mother_national"];
		$v_mother_occupation = $_POST["txt_mother_occupation"];
		$V_mother_phone = $_POST["txt_mother_phone"];
		$v_mother_card_id = $_POST["txt_mother_card_id"];
		$v_address = $_POST["txt_address"];
		$v_note = $_POST["txt_note"];


		// get count student id
		$id = $_GET["edit_id"];
		$sql_count = "SELECT COUNT(stup_id) AS countnum FROM student_parent
											WHERE stup_main_id='$id'
													";	
		$result_count = $connect->query($sql_count);
		$row_count = $result_count->fetch_assoc();
		$get_count = $row_count['countnum'];

		if($get_count==1){

			$sql = "UPDATE student_parent SET stup_farther_name ='$v_farther_name'
									, stup_farther_national = '$v_farther_national' 
									, stup_farther_occupation = '$v_farther_occupation'
									, stup_farther_phone = '$v_farther_phone'
									, stup_farther_card_id 	= '$v_farther_card_id'
									, stup_mother_name	= '$v_mother_name'
									, stup_mother_national	= '$v_mother_national'
									, stup_mother_occupation = '$v_mother_occupation'
									, stup_mother_phone	= '$V_mother_phone'
									, stup_mother_card_id = '$v_mother_card_id'
									, stup_address	= '$v_address'
									, stup_note		= '$v_note'
										WHERE stup_main_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:student_parent_edit.php?edit_id=$id&message=update");

		}elseif($get_count==0){

			$id = $_GET["edit_id"];
			$sql = "INSERT INTO student_parent (stup_farther_name
		 							, stup_farther_national
									, stup_farther_occupation
									, stup_farther_phone
									, stup_farther_card_id
									, stup_mother_name
									, stup_mother_national
									, stup_mother_occupation
									, stup_mother_phone
									, stup_mother_card_id
									, stup_address
									, stup_note
									, stup_main_id
															) 
		 					VALUES ('$v_farther_name'
							 		, '$v_farther_national' 
									, '$v_farther_occupation'
									, '$v_farther_phone'
									, '$v_farther_card_id' 
									, '$v_mother_name'
									, '$v_mother_national'
									, '$v_mother_occupation'
									, '$V_mother_phone'
									, '$v_mother_card_id'
									, '$v_address'
									, '$v_note'
									, '$id'
													)";
		 	$result = mysqli_query($connect, $sql);
			header("location:student_parent_edit.php?edit_id=$id&message=update");
		}
			
	}
?>
<?php include 'header.php';?>
	<div class="row">
				<div class = "col-xs-12">
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
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body"><h3 class="text-primary">Parent Info</h3>
                	
                </div>

                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
							<input type = "hidden" name="id" value = "<?php echo $id; ?>">
								<div class="form-group col-xs-4">
									Card_ID:
									<label for =""> 
										<?php echo @$row["stu_card_id"]?>
									</label>
									<br>

									Student_Name_KH:
									<label for =""> 
										<?php echo @$row["stu_name_kh"]?>
									</label>
									<br>

									Student_Name_EN:
									<label for =""> 
										<?php echo @$row["stu_name_en"]?>
									</label> 
									<br>

									Date_of_birth:
									<label for =""> 
												<?php
													$v_date=@$row["stu_dateofbirth"];
													if($v_date=="0000-00-00"){
														echo '';
													}else{
														echo date('d-M-Y',strtotime($v_date));
													}
													
												?>
										
									</label> 
									<br>

									National:
									<label for =""> 
										<?php echo @$row["stu_national"]?>
									</label> 
									<br>

									Address:
									<label for =""> 
										<?php echo @$row["stu_address"]?>
									</label> 
									<br>
								</div>
								<div class="form-group col-xs-12">
									
								</div>
								<div class="form-group col-xs-4">
		                            <label for ="">Farther_Name:</label>                                          
		                       		<input class="form-control" name="txt_farther_name" type="text" value="<?php echo @$row["stup_farther_name"]?>">
		                        </div>
		                        <div class="form-group col-xs-4">
		                            <label for ="">Farther_National:</label>                                          
		                       		<input class="form-control" name="txt_farther_national" type="text" value="<?php echo @$row["stup_farther_national"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Farther_Occupation:</label>                                          
		                       		<input class="form-control" name="txt_farther_occupation" type="text" value="<?php echo @$row["stup_farther_occupation"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Farther_Phone:</label>                                          
		                       		<input class="form-control" name="txt_farther_phone" type="text" value="<?php echo @$row["stup_farther_phone"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Farther_Card_ID:</label>                                          
		                       		<input class="form-control" name="txt_farther_card_id" type="text" value="<?php echo @$row["stup_farther_card_id"]?>">
		                        </div>
								<div class="form-group col-xs-12">
									
								</div>
								<div class="form-group col-xs-4">
		                            <label for ="">Mother_Name:</label>                                          
		                       		<input class="form-control" name="txt_mother_name" type="text" value="<?php echo @$row["stup_mother_name"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Mother_National:</label>                                          
		                       		<input class="form-control" name="txt_mother_national" type="text" value="<?php echo @$row["stup_mother_national"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Mother_Occupation:</label>                                          
		                       		<input class="form-control" name="txt_mother_occupation" type="text" value="<?php echo @$row["stup_mother_occupation"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Mother_Phone:</label>                                          
		                       		<input class="form-control" name="txt_mother_phone" type="text" value="<?php echo @$row["stup_mother_phone"]?>">
		                        </div>
								<div class="form-group col-xs-4">
		                            <label for ="">Mother_Card_ID:</label>                                          
		                       		<input class="form-control" name="txt_mother_card_id" type="text" value="<?php echo @$row["stup_mother_card_id"]?>">
		                        </div>
								<div class="form-group col-xs-12">
									
								</div>
								<div class="form-group col-xs-12">
		                            <label for ="">Address:</label>                                          
		                       		<input class="form-control" name="txt_address" type="text" value="<?php echo @$row["stup_address"]?>">
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                            <textarea class="form-control" rows="2" name="txt_note"><?php echo @$row["stup_note"]?></textarea>
		                        </div>							

								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="student.php" class="btn btn-danger"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>