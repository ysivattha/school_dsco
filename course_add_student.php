<?php include 'config/db_connect.php';

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

        

    if(isset($_GET["del_id"])){
     $id = $_GET["del_id"];
     $v_course_id =$_GET["sent_id"];

     $sql = "DELETE FROM course_student WHERE cs_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:course_add_student.php?edit_id=$v_course_id");
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
                <h3 class="text-primary">Student in class</h3>
            
                <div class="col-md-12">
                    <div class="col-md-8">
                        
                        <a href="course.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
                        <?php
                            $id = $_GET["edit_id"]; 
                            ?>
                        <a href="course_add_student_print.php?edit_id=<?php echo $id; ?>" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print</a>
                    </div>
                    <div class="col-md-4">
                        
                            Teacher: <b>
                                        <?php
                                            $id = $_GET["edit_id"];    
                                            $sql_get = "SELECT * FROM course_student AS A
																LEFT JOIN course AS CO ON CO.co_id=A.cs_course_id
																LEFT JOIN employee AS EMP ON EMP.emp_id=CO.co_teacher
                                                                LEFT JOIN time_learn AS TL ON TL.ti_id=CO.co_time
                                                                LEFT JOIN room AS ROOM ON ROOM.ro_id=CO.co_room
                                                                WHERE cs_course_id='$id'
                                                                            			";
                                            $result_get = mysqli_query($connect, $sql_get);
                                            $row_get = $result_get->fetch_assoc();
                                            $teacher =$row_get['emp_name_kh'];
                                            $time =$row_get['ti_name'];
                                            $room =$row_get['ro_name'];
                                            echo $teacher;
                                        ?>
                                    </b>
                        <br> Time: <b>
                                        <?php
                                            echo $time;
                                        ?>
                                    </b>
                        <br> Room: <b>
                                        <?php
                                            echo $room;
                                        ?>
                                    </b>
                    </div>
                </div>
							
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Course</th>
                                <th>(ID)Student</th>
                                <th>Date_Join</th>
                                <th>Note</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php     
											$id = $_GET["edit_id"];    
                                            $sql = "SELECT * FROM course_student AS A
																LEFT JOIN course AS CO ON CO.co_id=A.cs_course_id
																LEFT JOIN student AS ST ON ST.stu_id=A.cs_student_id
                                                                WHERE cs_course_id='$id'
                                                                            			";
                                            $result = mysqli_query($connect, $sql);
                                                                           
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{		
												$v_course_id   =$row["cs_course_id"];
												$v_course   =$row["co_name"];
                                                
												$v_card_id   =$row["stu_card_id"];
                                                $v_student_en   =$row["stu_name_en"]; 
												$v_student_kh  =$row["stu_name_kh"]; 
												$v_date   =$row["cs_date_join"];
                                                $v_note   =$row["cs_note"];
										?>
                                <tr>
                                    <td> <?php echo $i++;?> </td>
                                    <td> <?php echo $v_course;?> </td>
                                    <td> (<?php echo $v_card_id;?>) <?php echo $v_student_en;?> <?php echo $v_student_kh;?> 
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
                                        <a onclick="return confirm('Are you sure to delete?');" href="course_add_student.php?del_id=<?php echo $row['cs_id']; ?>&sent_id=<?php echo $row['cs_course_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                   
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
</div>
<?php include 'footer.php';?>