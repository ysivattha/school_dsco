<?php include'config/db_connect.php';

	$sql = "SELECT * FROM student
						LEFT JOIN course_student ON course_student.cs_student_id=student.stu_id
						LEFT JOIN course ON course.co_id=course_student.cs_course_id
						LEFT JOIN time_learn ON time_learn.ti_id=course.co_time
						WHERE stu_stop is NULL
						OR stu_stop ='Learning'
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
<style>
@media print 
{
    @page {
      size: A4; /* DIN A4 standard, Europe */
	  margin-top: 0.6cm;
    }
    html, body {
        width: 210mm;
        /* height: 297mm; */
        height: 282mm;
        font-size: 11px;
        background: #FFF;
        overflow:visible;
    }
    body {
        padding-top:0mm;
    }
}

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  overflow-y: hidden; /* Hide vertical scrollbar */
  overflow-x: hidden; /* Hide horizontal scrollbar */
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #ADD8E6;
  color: black;
}
</style>

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
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        				
							
                            <div class="table-responsive">
							<h3 class="text-primary">Student Active (Print)</h3>	
                               <table id="customers" class="display nowrap" width="100%" cellspacing="0">
								   <br>
                                    <thead>
                                        <tr>
                                            <th>No</th>
											<th>Photo</th>
                                            <th>Card_ID</th>
                                            <th>Name_EN</th>
                                            <th>Name_KH</th>
											<th>Sex</th>
											<th>Phone</th>
											<th>Course</th>
											<th>Time</th>
											<th>Date_Register</th>
											<th>Other</th>
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

												$v_course_name =$row["co_name"];
												$v_time_learn =$row["ti_name"];
										?>
										<tr>
											<td><?php echo $v1;?></td>
											<td class="text-center">
												<?php
													if($v_photo == ""){
												?>
													
														<img height="50px" src="img/student_photo/blank.png">
													
												<?php
													}else{
												?>
													
														<img height="50px" src="img/student_photo/<?= $row['stu_photo']; ?>"
													
												<?php
													}
												?>
													
                                            </td>
											
											<td><?php echo $v_card_id;?></td>
											<td><?php echo $v_name_en;?></td>
											<td><?php echo $v_name_kh;?></td>
											
											<td><?php echo $v_sex;?></td>
											<td><?php echo $v_phone;?></td>
											<td><?php echo $v_course_name;?></td>
											<td><?php echo $v_time_learn;?></td>
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
											
											<td align="center">
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
																WHERE stu_stop is NULL
																OR stu_stop ='Learning'
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
