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
                <h3 class="text-primary">Course All</h3>
                
                <a href="course.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Course</th>
                                <th></th>
                                <th>Period</th>
                                <th>Generation</th>
                                <th>Note</th>
                                <th>Finish</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php         
                                            $sql = "SELECT * FROM course
                                                                WHERE co_finish='Finish'
                                                                            ";
                                            $result = mysqli_query($connect, $sql);
                                                                           
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{		
												$v_name   =$row["co_name"];
                                                $v_note   =$row["co_note"];
                                                $v_period   =$row["co_period"];
                                                $v_generation   =$row["co_generation"];
                                                $v_finish   =$row["co_finish"];
										?>
                                <tr>
                                    <td> <?php echo $i++;?> </td>
                                    <td> <?php echo $v_name;?> </td>
                                    <td>
                                        <a href="course_add_student.php?edit_id=<?php echo $row['co_id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-users"></i> Students</a>
                                        <a href="course_teacher_edit.php?edit_id=<?php echo $row['co_id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-user"></i> Teacher</a>
									
                                    </td>
                                    <td> <?php echo $v_period;?> </td>
                                    <td> <?php echo $v_generation;?> </td>
                                    <td> <?php echo $v_note;?> </td>
                                    <td> <?php echo $v_finish;?> </td>
                                    <td class="text-center">
                                        <a href="course_edit.php?edit_id=<?php echo $row['co_id']; ?>" class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>
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