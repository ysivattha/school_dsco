<?php include'config/db_connect.php';
$id = $_GET["id"];

 	if(isset($_GET["del_id"])){
		$del_id = $_GET["del_id"];
		$id = $_GET["sub_id"];
			
		$sql = "DELETE FROM student_score WHERE sc_id = '$del_id'" ;
		$result = mysqli_query($connect, $sql);
		header("location:exam_score.php?id=$id");	
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
                        
						<h3 class="text-primary">Exam Score</h3>
						<div class="panel-body">	
							<a href="course_score_exam.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
							<a href="exam_score_add.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
							
								
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
								   <br>
                                    <thead>
                                        <tr>
                                            <th>No</th>
											<th>Student</th>
                                            <th>Subject</th>
											<th>Attendance</th>
											<th>Quiz</th>
											<th>H.W/Assignment</th>
											<th>Midterm</th>
											<th>Final</th>
											<th>Total</th>
											<th>Result</th>
											<th>Grade</th>
											<th>Rank</th>
											<th>Note</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
													
													$id = $_GET["id"];
													$v_current_year_month=date('Y-m');
													$sql = "SELECT * FROM student_score AS A
																		LEFT JOIN student AS STU ON STU.stu_id=A.sc_student_id
																		LEFT JOIN course AS CO ON CO.co_id=A.sc_subject_id 
																		WHERE DATE_FORMAT(sc_datetime,'%Y-%m')='$v_current_year_month'
																		AND sc_subject_id=$id
																								";	
													$result = $connect->query($sql);
											
												
										
											$i =1;
											while($row = $result->fetch_assoc()) 											
											{			
						
												$v1 =$i++;
												$v_student_id =$row["sc_student_id"];
												$v_student_en =$row["stu_name_en"];
												$v_student_kh =$row["stu_name_kh"];

												$v_subject_id =$row["sc_subject_id"];
												$v_subject_name =$row["co_name"];
												$v_subject_generation =$row["co_generation"];

												$v_attendance =$row["sc_attendance"];
												$v_quiz =$row["sc_quiz"];
												$v_homework =$row["sc_homework"];
												$v_midterm =$row["sc_midterm"];
												$v_final =$row["sc_final"];
												$v_note =$row["sc_note"];
												$v_total =$v_attendance+$v_quiz+$v_homework+$v_midterm+$v_final;
												$v_average_get =$v_total/5;
													$v_average = number_format($v_average_get,2);
												
												if($v_total>50){
													$v_pass = "Pass";
												}else{
													$v_pass = "Fail";
												}

												
												

										?>
										<tr>
											<td><?php echo $v1;?></td>
											<td>
												<?php echo $v_student_en;?> : <?php echo $v_student_kh;?>
											</td>
											<td><?php echo $v_subject_name;?></td>
											<td><?php echo $v_attendance;?></td>
											<td><?php echo $v_quiz;?></td>
											<td><?php echo $v_homework;?></td>
											<td><?php echo $v_midterm;?></td>
											<td><?php echo $v_final;?></td>
											<td><?php echo $v_total;?></td>
											<td>
												<?php 
													
													if($v_pass=="Fail"){
														echo '<span style="color:red;">'.$v_pass.'</span>';
													}else{
														echo $v_pass;
													}
												?>
											</td>
											<td>
												<?php 
													/*
														A 95-100
														B+ 89-94
														B 83-88
														C+ 77-82
														C 71-76
														D+ 65-70
														D 60-64
														E 50-59
														F 0-49
													*/
													if($v_total>=101){
														echo 'check again';	
													}
													elseif($v_total>=95){
														echo 'A';
													}
													elseif($v_total>=89){
														echo 'B+';
													}
													elseif($v_total>=83){
														echo 'B';
													}
													elseif($v_total>=77){
														echo 'C+';
													}
													elseif($v_total>=71){
														echo 'C';
													}
													elseif($v_total>=65){
														echo 'D+';
													}
													elseif($v_total>=60){
														echo 'D';
													}
													elseif($v_total>=50){
														echo 'E';
													}
													else{
														echo 'F';
													}
													
												?>
											</td>
											<td>
													
											</td>
											<td><?php echo $v_note;?></td>
											
											<td align="center">
												
												<a href="exam_score_edit.php?edit_id=<?php echo $row['sc_id']; ?>&sub_id=<?php echo $row['sc_subject_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
												<a onclick = "return confirm('Are you sure to delete ?');" href="exam_score.php?del_id=<?php echo $row['sc_id']; ?>&sub_id=<?php echo $row['sc_subject_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
											<td></td>
											<td></td>
											<td>
												
											</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
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
												$sql_count = "SELECT count(sc_id) AS countnum FROM student_score AS A 
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
										<p>
										<b>Student Score </b>
											<br>-Attendance 10% 
											<br>-Quiz 10% 
											<br>-Homework=Assignment 10% 
											<br>-Midterm 20% 
											<br>-Final 50% 

										</p>
										<p>
											<b>Grade</b>
											<br>-A Score 95-100
											<br>-B+ Score 89-94
											<br>-B Score 83-88
											<br>-C+Score  77-82
											<br>-C Score 71-76
											<br>-D+ Score 65-70
											<br>-D Score 60-64
											<br>-E Score 50-59
											<br>-F Score 0-49
										</p>
                </div>
            </div>
<?php include 'footer.php';?>