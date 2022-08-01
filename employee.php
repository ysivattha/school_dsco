<?php include'config/db_connect.php';

	$sql = "SELECT * FROM employee 
						";	
	$result = $connect->query($sql);
	
	if(isset($_POST["btnadd"])){
		$kname = $_POST["name_khmer"];
		$ename = $_POST["name_english"];
		$start = $_POST["starton"];
		$position = $_POST["position"];
		$phone = $_POST["phone"];
		$note = $_POST["note"];

	 
		 $sql = "INSERT INTO employee (name_khmer,name_english,start_on,position_id,phone,emp_note) 
		 					VALUES ('$kname', '$ename' , '$start', '$position', '$phone' , '$note')";
		 $result = mysqli_query($connect, $sql);
		 header('location:employee.php?message=success');
 }
 	if(isset($_GET["del_id"])){
		$id = $_GET["del_id"];
			
		$sql = "DELETE FROM employee WHERE emp_id = '$id'" ;
		$result = mysqli_query($connect, $sql);
		header("location:employee.php?message=delete");	
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
						<h3 class="text-primary">Employee / Teacher List</h3>	
							<a href="employee_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
							
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
								   <br>
                                    <thead>
                                        <tr>
                                            <th>No</th>
											<th>Photo</th>
											<th>Name_KH</th>
                                            <th>Name_EN</th>
                                            <th>Position</th>
                                            <th>Start_On</th>
											<th>Phone</th>
											<th>Address</th>
											<th>Note</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i=1;
											while($row = $result->fetch_assoc()) 
											
											{			
												$v1 =$i++;
												$v_name_kh =$row["emp_name_kh"];
												$v_name_en =$row["emp_name_en"];
												$v_position =$row["emp_position"];
												$v_date =$row["emp_start_on"];
												$v_phone =$row["emp_phone"];
												$v_address =$row["emp_address"];
												$v_note =$row["emp_note"];
												$v_photo =$row["emp_photo"];
										?>
										<tr>
											<td><?php echo $v1;?></td> 
											<td class="text-center">
												<?php
													if($v_photo == ""){
												?>
													<a href="img/teacher_photo/blank.png">
														<img height="50px" src="img/teacher_photo/blank.png"
													</a>
												<?php
													}else{
												?>
													<a href="img/teacher_photo/<?= $row['emp_photo'] ?>">
														<img height="50px" src="img/teacher_photo/<?= $row['emp_photo']; ?>"
													</a>
												<?php
													}
												?>
													<a href="upload_photo_teacher.php?sent_id=<?= $row['emp_id'] ?>&sent_img=<?= $row['emp_photo'] ?>">
													<i class="fa fa-pencil"></i>
													</a>
                                            </td>
											<td><?php echo $v_name_kh;?></td>
											<td><?php echo $v_name_en;?></td>
											<td><?php echo $v_position;?></td>
											<td>
												<?php
													if($v_date=="0000-00-00"){
														echo '';
													}else{
														echo date('d-M-Y',strtotime($v_date));
													}
													
												?>
											</td>
											<td><?php echo $v_phone;?></td>
											<td><?php echo $v_address;?></td>
											<td><?php echo $v_note;?></td>
											<td align="center">
												<a href="employee_edit.php?edit_id=<?php echo $row['emp_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
												<a onclick = "return confirm('Are you sure to delete ?');" href="employee.php?del_id=<?php echo $row['emp_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</td>
										</tr> 
										<?php
											}	 
										?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>