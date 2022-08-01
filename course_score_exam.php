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
                <h3 class="text-primary">Course Info</h3>
                
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Course</th>
                                <th>Class</th>
                                <th>Time</th>
                                <th></th>
                                <th>Period</th>
                                <th>Generation</th>
                                <th>Fee</th>
                                <th>Note</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php         
                                            $sql = "SELECT * FROM course AS A
                                                            LEFT JOIN class AS CL ON CL.cl_id=A.co_class
                                                            LEFT JOIN time_learn AS TL ON TL.ti_id=A.co_time
                                                            WHERE co_finish !='Finish'
                                                                            ";
                                            $result = mysqli_query($connect, $sql);
                                                                           
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{		
												$v_course_id =$row['co_id'];
                                                $v_name   =$row["co_name"];
                                                $v_note   =$row["co_note"];
                                                $v_period   =$row["co_period"];
                                                $v_generation   =$row["co_generation"];
                                                $v_fee   =$row["co_fee"];
                                                $v_class_id   =$row["co_class"];
                                                $v_class   =$row["cl_name"];
                                                $v_time   =$row["ti_name"];
										?>
                                <tr>
                                    <td> <?php echo $i++;?> </td>
                                    <td> <?php echo $v_name;?> </td>
                                    <td> <?php echo $v_class;?> </td>
                                    <td> <?php echo $v_time;?> </td>
                                    <td>
                                        <a href="exam_score.php?id=<?php echo $row['co_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Exam Score</a>
                                        
                                    </td>
                                    <td> <?php echo $v_period;?> </td>
                                    <td> <?php echo $v_generation;?> </td>
                                    <td>$ <?php echo $v_fee;?> </td>
                                    <td> <?php echo $v_note;?> </td>
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