<?php include'config/db_connect.php';


 	if(isset($_GET["del_id"])){
		$id = $_GET["del_id"];
			
		$sql = "DELETE FROM student_transport WHERE st_id = '$id'" ;
		$result = mysqli_query($connect, $sql);
		header("location:student_transport.php?message=delete");	
	}	
	if(isset($_GET["stop_id"])){
		$id = $_GET["stop_id"];
		$v_stop = 'Stop';
			
		$sql = "UPDATE student_transport SET st_stop = '$v_stop'									
											WHERE st_id = '$id'" ;
		mysqli_query($connect, $sql);
		header("location:student_transport.php?message=update");	
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
						<h3 class="text-primary">Student Transport</h3>	
							<a href="student_transport_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
							
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
								   <br>
                                    <thead>
                                        <tr>
                                            <th>No</th>
											<th>Date</th>
											<th>Student</th>
                                            <th>Location</th>
											<th>Fee_Charge</th>
											<th>Note</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
												$v_stop ='On_going';
												$sql = "SELECT * FROM student_transport AS A 
																	LEFT JOIN student AS STU ON STU.stu_id=A.st_student_id
																	WHERE st_stop ='$v_stop'
																	OR ISNULL(st_stop)
																							";	
												$result = $connect->query($sql);
										
											$i =1;
											$v_fee_total =0;
											while($row = $result->fetch_assoc()) 											
											{			
												$v_fee_total +=$row["st_fee"];

												$v1 =$i++;
												$v_id =$row["st_id"];
												$v_date =$row["st_date"];
												$v_student_id =$row["st_student_id"];
												$v_location =$row["st_location"];
												$v_fee =$row["st_fee"];
												$v_note =$row["st_note"];

												$v_name_en =$row["stu_name_en"];
												$v_name_kh =$row["stu_name_kh"];
												$v_phone =$row["stu_phone"];

										?>
										<tr>
											<td><?php echo $v1;?></td>
											<td>
												<?php
													if($v_date=="0000-00-00"){
														echo '';
													}
													elseif($v_date==""){
														echo '';
													}
													else{
														echo date('d-M-Y',strtotime($v_date));
													}
													
												?>
											</td>
											<td>
												<?php echo $v_name_en;?> : <?php echo $v_name_kh;?>
											</td>
											<td><?php echo $v_location;?></td>
											<td>$ <?php echo $v_fee;?></td>
											<td><?php echo $v_note;?></td>
											
											
											<td align="center">
												<a onclick = "return confirm('Are you sure to prcessing... ?');" href="student_transport.php?stop_id=<?php echo $row['st_id']; ?>" class="btn btn-success btn-sm"><i class="fa fa-times"></i> Stop</a>
											
												<a href="student_transport_edit.php?edit_id=<?php echo $row['st_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>.</a>
												<a onclick = "return confirm('Are you sure to delete ?');" href="student_transport.php?del_id=<?php echo $row['st_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>.</a>
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
											<td>Total:</td>
											<td>$
												<?php
													$v_fee_total_show =number_format($v_fee_total,2);
													echo $v_fee_total_show;
												?>
											</td>
											<td></td>
											<td></td>
										</tr>
									</tfoot>
                                </table>
								
								
									<span style="color:blue">
										 Student Total: 
									</span>
									<span style="color:red">
										<b> 
											<?php
												$v_stop ="Stop";
												$v_ongoing ="On_going"; 
												$sql_count = "SELECT count(st_id) AS countnum FROM student_transport AS A 
																						LEFT JOIN student AS STU ON STU.stu_id=A.st_student_id
																						WHERE ISNULL(st_stop)
																						OR st_stop ='$v_ongoing'
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