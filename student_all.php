<?php include'config/db_connect.php';

	$sql = "SELECT * FROM student AS A
												";	
	$result = $connect->query($sql);
	
	if(isset($_POST["btnadd"])){
		$v_date_register = $_POST["txt_date_register"];
		$v_card_id = $_POST["txt_card_id"];
		$v_name_en = $_POST["txt_name_en"];
		$v_name_kh = $_POST["txt_name_kh"];
		$v_sex = $_POST["txt_sex"];
		$v_dateofbirth = $_POST["txt_dateofbirth"];
		$v_phone = $_POST["txt_phone"];
		$v_address = $_POST["txt_address"];
	 
		 $sql = "INSERT INTO student (stu_date_register
		 							, stu_card_id
									, stu_name_en
									, stu_name_kh
									, stu_sex
									, stu_dateofbirth
									, stu_phone
									, stu_address
												) 
		 					VALUES ('$v_date_register'
							 		, '$v_card_id' 
									, '$v_name_en'
									, '$v_name_kh'
									, '$v_sex' 
									, '$v_dateofbirth'
									, '$v_phone'
									, '$v_address'
												)";
		 $result = mysqli_query($connect, $sql);
		 header('location:student.php?message=success');
 }
 	if(isset($_GET["del_id"])){
		$id = $_GET["del_id"];
			
		$sql = "DELETE FROM student WHERE stu_id = '$id'" ;
		$result = mysqli_query($connect, $sql);
		header("location:student.php?message=delete");	
}	
	
?>
<?php include 'header.php';?>
	<div class="row">
				<div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add employee</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update employee</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete employee</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
						<h3 class="text-primary">Student All</h3>	
							<a href="student.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
							
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
								   <br>
                                    <thead>
                                        <tr>
                                            <th>No</th>
											<th>Photo</th>
                                            <th>Card_ID</th>
                                            <th>Name_EN</th>
                                            <th>Name_KH</th>
											<th></th>
											<th>Sex</th>
											<th>Phone</th>
											<th>Note</th>
											<th>Date_Register</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i=1;
											while($row = $result->fetch_assoc()) 
											
											{			
												$v1 =$i++;
												$v_date =$row["stu_date_register"];
												$v_card_id =$row["stu_card_id"];
												$v_name_en =$row["stu_name_en"];
												$v_name_kh =$row["stu_name_kh"];
												$v_sex =$row["stu_sex"];
												$v_dateofbirth =$row["stu_dateofbirth"];
												$v_national =$row["stu_national"];
												$v_phone =$row["stu_phone"];
												$v_address =$row["stu_address"];
												$v_photo =$row["stu_photo"];
												$v_note =$row["stu_note"];
										?>
										<tr>
											<td><?php echo $v1;?></td>
											<td class="text-center">
                                              <a href="img/student_photo/<?= $row['stu_photo'] ?>">
                                                <img height="50px" src="img/student_photo/<?= $row['stu_photo'] ?>"
                                              </a>
                                              <a href="upload_photo_student.php?sent_id=<?= $row['stu_id'] ?>&sent_img=<?= $row['stu_photo'] ?>">
                                               <i class="fa fa-pencil"></i>
                                              </a>
                                            </td>
											
											<td><?php echo $v_card_id;?></td>
											<td><?php echo $v_name_en;?></td>
											<td><?php echo $v_name_kh;?></td>
											<td>
												
												<a href="history_pay.php?sent_id=<?php echo $row['stu_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-dollar"></i> History Pay</a>
												<a href="class_history.php?sent_id=<?php echo $row['stu_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-arrow-right"></i> Histroy Class</a>
											
											</td>
											<td><?php echo $v_sex;?></td>
											<td><?php echo $v_phone;?></td>
											<td><?php echo $v_note;?></td>
											<td>
												<?php
													if($v_date=="0000-00-00"){
														echo '';
													}else{
														echo date('d-M-Y',strtotime($v_date));
													}
													
												?>
											</td>
											
											<td align="center">
												<a onclick = "return confirm('Are you sure to delete ?');" href="student_all.php?del_id=<?php echo $row['stu_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											
											</td>
										</tr> 
										<?php
											}	 
										?>
                                    </tbody>
                                </table>
								<span style="color:blue">
									<b> Student Total: </b> 
								</span>
								<span style="color:red">
									<b> 
										<?php
											$sql_count = "SELECT count(stu_id) AS countnum FROM student AS A
																						";	
											$result_count = $connect->query($sql_count);
											$row_count = $result_count->fetch_assoc();
											$get_count = $row_count['countnum'];
											echo $get_count;
										?>
									</b> 
								</span>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>