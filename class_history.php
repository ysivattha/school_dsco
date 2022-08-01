<?php include 'config/db_connect.php';

    

    if(isset($_GET["del_id"])){
     $id = $_GET["del_id"];

     $sql = "DELETE FROM course WHERE co_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:course.php?message=delete");
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
                <h3 class="text-primary">History Class Info</h3>
                <a href="student.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
							         
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Course</th>
                                <th>Period</th>
                                <th>Time</th>
                                <th>Generation</th>
                                <th>Student</th>
                                <th>Date_Join</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php     
                                            $id = $_GET["sent_id"];    
                                            $sql = "SELECT * FROM course_student AS A
                                                            LEFT JOIN course AS C ON C.co_id=A.cs_course_id
                                                            LEFT JOIN time_learn AS TIM ON TIM.ti_id=C.co_time
                                                            LEFT JOIN student AS S ON S.stu_id=A.cs_student_id
                                                            WHERE cs_student_id=$id
                                                                                                            ";
                                            $result = mysqli_query($connect, $sql);
                                                                           
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{		
												$v_course   =$row["co_name"];
                                                $v_period   =$row["co_period"];
                                                $v_generation  =$row["co_generation"];
                                                $v_time  =$row["ti_name"];

                                                $v_name_en  =$row["stu_name_en"];
                                                $v_name_kh  =$row["stu_name_kh"];
                                                $v_card_id  =$row["stu_card_id"];

                                                $v_date_join  =$row["cs_date_join"];
										?>
                                <tr>
                                    
                                    <td> <?php echo $i++;?> </td>
                                    <td> <?php echo $v_course;?> </td>
                                    <td> <?php echo $v_period;?> </td>
                                    <td> <?php echo $v_time;?> </td>
                                    <td> <?php echo $v_generation;?> </td>
                                    <td> 
                                        (<?php echo $v_card_id;?>)
                                        <?php echo $v_name_en;?> :
                                        <?php echo $v_name_kh;?> 
                                    </td>
                                    <td> 
                                                <?php
													if($v_date_join=="0000-00-00"){
														echo '';
													}else{
														echo date('d-M-Y',strtotime($v_date_join));
													}
													
												?> 
                                    </td>
                                    <td class="text-center">
                                    
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