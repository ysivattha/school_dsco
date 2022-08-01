<?php include 'config/db_connect.php';

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

        
    if(isset($_GET["del_id"])){
     $id = $_GET["del_id"];
     $v_course_id =$_GET["sent_id"];

     $sql = "DELETE FROM course_user_allow WHERE cu_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:course_user_allow.php?edit_id=$v_course_id");
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
                <h3 class="text-primary">Allow User</h3>
                
                <a href="attendance.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Course</th>
                                <th>User</th>
                                <th>Note</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php     
											$id = $_GET["edit_id"];    
                                            $sql = "SELECT * FROM course_user_allow AS A
																LEFT JOIN course AS CO ON CO.co_id=A.cu_course_id
                                                                LEFT JOIN user AS U ON U.id=A.cu_user_id
                                                                WHERE cu_course_id='$id'
                                                                            			";
                                            $result = mysqli_query($connect, $sql);
                                                                           
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{
                                                $v_date   =$row["cu_date"];
												$v_course_id   =$row["cu_course_id"];
												$v_course   =$row["co_name"];
                                                $v_user_id   =$row["cu_user_id"];
                                                $v_user   =$row["full_name"];
                                                $v_note   =$row["cu_note"];
										?>
                                <tr>
                                    <td> <?php echo $i++;?> </td>
                                    <td>
                                                <?php
                                                    if($v_date=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_date));
                                                    }
                                                    
                                                ?> 
                                    </td>
                                    <td> <?php echo $v_course;?> </td>
                                    <td> <?php echo $v_user;?> </td>
                                    <td> <?php echo $v_note;?> </td>
                                    <td class="text-center">
                                        <a onclick="return confirm('Are you sure to delete?');" href="course_user_allow.php?del_id=<?php echo $row['cu_id']; ?>&sent_id=<?php echo $row['cu_course_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                   
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