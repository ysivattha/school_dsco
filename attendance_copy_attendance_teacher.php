<?php include 'config/db_connect.php';

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');


    if(isset($_GET["del_id"])){
     $id = $_GET["del_id"];
     $v_course_id =$_GET["sent_course_id"];

     $sql = "DELETE FROM attendance_sample WHERE att_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:attendance_copy_attendance_teacher.php?edit_id=$v_course_id");
     }
} 
?>

<?php include 'header.php';?>
<div class="row">
    <div class="col-xs-12">
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
            <div class="panel-body">
                <h3 class="text-primary">Copy Sample Attendance</h3>

                <a href="attendance_student_check_teacher.php?edit_id=<?php echo $_GET['edit_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
                <a href="attendance_copy_attendance_add_teacher.php?edit_id=<?php echo $_GET['edit_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add Student</a>
                <a href="attendance_copy_attendance_sent_teacher.php?edit_id=<?php echo $_GET['edit_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Copy & Past Attendance</a>
               
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Course</th>
                                <th>Student</th>
                                <th>Date</th>
                                <th>Note</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php     
											$id = $_GET["edit_id"];    
                                            $sql = "SELECT * FROM attendance_sample AS A
																LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
																LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                WHERE att_course_id='$id'
                                                                            			";
                                            $result = mysqli_query($connect, $sql);
                                                                           
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{		
												$v_course_id   =$row["att_course_id"];
												$v_course   =$row["co_name"];
                                                $v_student_en   =$row["stu_name_en"]; 
												$v_student_kh  =$row["stu_name_kh"]; 
                                                $v_note   =$row["att_note"];
                                                $v_date   =$row["att_date"];
										?>
                                <tr>
                                    <td> <?php echo $i++;?> </td>
                                    <td> <?php echo $v_course;?> </td>
                                    <td> <?php echo $v_student_en;?> <?php echo $v_student_kh;?> 
									</td>
                                    <td>
                                                <?php
                                                    if($v_date=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_date));
                                                    }
                                                    
                                                ?> 
                                    </td>
                                    <td> <?php echo $v_note;?> </td>
                                    <td class="text-center">
                                        <a onclick="return confirm('Are you sure to delete?');" href="attendance_copy_attendance_teacher.php?del_id=<?php echo $row['att_id']; ?>&sent_course_id=<?php echo $row['att_course_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                      
                                    </td>
                                </tr>
                                    <?php
                                        }	 
                                    ?>
                        </tbody>
                        </table>
                        
                        <p>
                            <b>Note:</b>
                            You can use copy & paste attendance 
                            <br> -step1, you need to (add student) to this list.
                            <br> -step2, you can use (copy & paste attendance) button.
                            <br> -step3, system will copy only studnet name in this list sample to attendance list with show date.
                        </p>
                                        
                </div>

            </div>

        </div>
    </div>
</div>
</div>
<?php include 'footer.php';?>