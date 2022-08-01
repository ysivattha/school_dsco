<?php include 'config/db_connect.php';

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

$v_edit_id =$_GET["edit_id"];

    if(isset($_GET["del_id"])){
     $id =$_GET["del_id"];
     $v_course_id =$_GET["edit_id"];

     $sql = "DELETE FROM attendance WHERE att_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:attendance_student_check_teacher.php?edit_id=$v_course_id");
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
                <h3 class="text-primary">Add Student Attendance </h3>
                    <a href="attendance_teacher.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
                    <a href="attendance_add_teacher.php?edit_id=<?php echo $v_edit_id; ?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Add Attendance</a>
                    <a href="attendance_copy_attendance_teacher.php?edit_id=<?php echo $v_edit_id; ?>" class="btn btn-primary btn-sm"><i class="fa fa-copy"></i> Copy Attendance</a>
                
                <span style="text-align:center">Today is:
                    <?php
                        echo date('d-M-Y',strtotime($today));
                    ?>
                </span>
            </div>

            

            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Subject</th>
                                <th>Student</th>
                                <th>Date_Attendance</th>
                                <th>Join_Class</th>
                                <th>Note</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php     

                                            
                                                $id = $_GET["edit_id"];
                                                $v_course_id =$_GET["edit_id"]; 
                                                $today = date('Y-m-d');
                                                $sql = "SELECT * FROM attendance AS A
                                                                    LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
                                                                    LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                    WHERE att_course_id ='$id'
                                                                    AND att_date ='$today'
                                                                                            ";
                                                $result = mysqli_query($connect, $sql);
											                                                                           
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{		
												$v_course_id   =$row["att_course_id"];
												$v_course   =$row["co_name"];
                                                $v_student_en   =$row["stu_name_en"]; 
												$v_student_kh  =$row["stu_name_kh"]; 
												$v_date   =$row["att_date"];
                                                $v_note   =$row["att_note"];

                                                $v_att_y   =$row["att_yes"];
                                                $v_att_a   =$row["att_a"];
                                                $v_att_p   =$row["att_p"];
										?>
                                <tr>
                                    <td> <?php echo $i++;?> </td>
                                    <td> <?php echo $v_course;?> </td>
                                    <td> 
                                        <?php echo $v_student_en;?> <?php echo $v_student_kh;?> 
									</td>
                                    <td> <?php echo date('d-M-Y',strtotime($v_date));?> </td>
                                    <td>
                                            <?php echo $v_att_y; ?>
                                        <span style="background-color: #FFFF00">
                                            <?php echo $v_att_a; ?>
                                        </span>
                                        <span style="background-color: #add8e6">
                                            <?php echo $v_att_p; ?>
                                        </span>
                                    </td>
                                    <td> <?php echo $v_note; ?> </td>
                                    <td class="text-center">
                                        <a href="attendance_student_check_edit_teacher.php?edit_id=<?php echo $row['att_id']; ?>&course_id=<?php echo $row['att_course_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										<a onclick="return confirm('Are you sure to delete?');" href="attendance_student_check_teacher.php?del_id=<?php echo $row['att_id']; ?>&edit_id=<?php echo $row['att_course_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                      
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
                                    <td>
                                            <p>
                                                <span style="color:red">
                                                    <b> Total: </b>
                                                </span>
                                                        <?php
                                                                $sql = "SELECT count(att_id) AS countyes FROM attendance AS A
                                                                                LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
                                                                                LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                                WHERE att_course_id ='$id'
                                                                                AND att_date ='$today'
                                                                                AND att_yes ='Yes'
                                                                                                        ";
                                                                $result = mysqli_query($connect, $sql);
                                                                $row = $result->fetch_assoc();
                                                                $get = $row['countyes'];
                                                                //echo $get;
                                                        ?>
                                                <br> Yes=<b> <?php echo $get; ?></b>

                                                        <?php
                                                                $sql = "SELECT count(att_id) AS counta FROM attendance AS A
                                                                                LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
                                                                                LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                                WHERE att_course_id ='$id'
                                                                                AND att_date ='$today'
                                                                                AND att_a ='A'
                                                                                                        ";
                                                                $result = mysqli_query($connect, $sql);
                                                                $row = $result->fetch_assoc();
                                                                $get = $row['counta'];
                                                                //echo $get;
                                                        ?>
                                                <br> A=<b> <?php echo $get; ?></b>

                                                        <?php
                                                                $sql = "SELECT count(att_id) AS countp FROM attendance AS A
                                                                                LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
                                                                                LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                                WHERE att_course_id ='$id'
                                                                                AND att_date ='$today'
                                                                                AND att_p ='P'
                                                                                                        ";
                                                                $result = mysqli_query($connect, $sql);
                                                                $row = $result->fetch_assoc();
                                                                $get = $row['countp'];
                                                                //echo $get;
                                                        ?>
                                                <br> P=<b> <?php echo $get; ?></b>
                                            </p>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>

                        </table>
                            <div class="form-group col-xs-4">
                                <p>
                                    <span style="color:red">
                                        <b> Note: </b>
                                    </span>
                                    <br> -Come to class = Yes
                                    <br> -Absent = A
                                    <br> -Permission = P
                                </p>
                            <div> 
                        
                                        
                </div>
                

            </div>
            

                                
                                
                            
                            
                        

        </div>
    </div>
</div>
</div>
<?php include 'footer.php';?>