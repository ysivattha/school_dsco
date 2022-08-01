<?php include 'config/db_connect.php';
$user_id = $_SESSION['user_id'];

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$month = date('m');
$year = date('Y');


    if(isset($_GET["del_id"])){
     $id =$_GET["del_id"];
     $v_course_id =$_GET["edit_id"];

     $sql = "DELETE FROM attendance WHERE att_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:attendance_student_check.php?edit_id=$v_course_id");
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
            <div>
                <h3 class="text-primary">Report Student Attendance </h3>
                   
                <span style="text-align:center">Today is:
                    <?php
                        echo date('d-M-Y',strtotime($today));
                    ?>
                </span>            
                        
                <form class="form-inline" method = "post" action="" style="display: inline-block;">
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" placeholder="DATE START" autocomplete="off" data-date-format="yyyy-mm-dd" class="form-control" name = "from" value="<?= @$_POST['from'] ?>" >
                    </div>
                    <div class="form-group">
                      <input type="text" data-provide="datepicker" placeholder="DATE END" autocomplete="off" data-date-format="yyyy-mm-dd" class="form-control" name = "to" value="<?= @$_POST['to'] ?>"> 
                    </div>
                    <div class="form-group">
                            <select name="txt_choose_sub" class="form-control select2" >
                                <option value="0">=== Subject ===</option>
                                <?php 
                                    $customer = $connect->query("SELECT * FROM course AS A
                                                                            LEFT JOIN course_user_allow AS CU ON CU.cu_id=A.co_id
                                                                            WHERE cu_user_id='$user_id'
                                                                            ORDER BY co_name ASC");
                                    while($row_cus = mysqli_fetch_object($customer)){
                                        if($row_cus->co_id  == @$_POST['txt_choose_sub']){
                                            echo '<option SELECTED value="'.$row_cus->co_id.'">'.$row_cus->co_name.' : '.$row_cus->co_generation.'</option>';

                                        }else{
                                            echo '<option value="'.$row_cus->co_id.'">'.$row_cus->co_name.' : '.$row_cus->co_generation.'</option>';
                                            
                                        }
                                    }
                                ?>
                            </select>
                    </div>
                    <div class="form-group">
                            <select name="txt_choose_student" class="form-control select2" >
                                <option value="0">=== Student ===</option>
                                <?php 
                                    $customer = $connect->query("SELECT * FROM student ORDER BY stu_name_en ASC");
                                    while($row_cus = mysqli_fetch_object($customer)){
                                        if($row_cus->stu_id  == @$_POST['txt_choose_student']){
                                            echo '<option SELECTED value="'.$row_cus->stu_id.'">'.$row_cus->stu_name_en.' : '.$row_cus->stu_name_kh.'</option>';

                                        }else{
                                            echo '<option value="'.$row_cus->stu_id.'">'.$row_cus->stu_name_en.' : '.$row_cus->stu_name_kh.'</option>';
                                            
                                        }
                                    }
                                ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="search" class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                        <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Clear</a>
                    </div>
                </form> 
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
                                            
                                            if(isset($_POST['search'])){
                                                    if($_POST['from']!=""
                                                        AND $_POST['to']!=""
                                                        AND $_POST['txt_choose_sub']!="0"
                                                        AND $_POST['txt_choose_student']!="0"
                                                        ){

                                                        $from = $_POST['from'];
                                                        $to = $_POST['to'];
                                                        $v_choose_sub = $_POST['txt_choose_sub'];
                                                        $v_choose_student = $_POST['txt_choose_student'];
    
                                                        $sql = "SELECT * FROM attendance AS A
                                                                            LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
                                                                            LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                            WHERE DATE_FORMAT(att_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
                                                                            AND att_course_id ='$v_choose_sub'
                                                                            AND att_student_id ='$v_choose_student'
                                                                            ORDER BY att_course_id DESC, att_student_id ASC, att_date ASC
                                                                                                    ";
                                                        $result = mysqli_query($connect, $sql);
                                                    }
                                                    elseif($_POST['from']!=""
                                                        AND $_POST['to']!=""
                                                        AND $_POST['txt_choose_sub']!="0"
                                                        ){

                                                        $from = $_POST['from'];
                                                        $to = $_POST['to'];
                                                        $v_choose_sub = $_POST['txt_choose_sub'];
    
                                                        $sql = "SELECT * FROM attendance AS A
                                                                            LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
                                                                            LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                            WHERE DATE_FORMAT(att_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
                                                                            AND att_course_id ='$v_choose_sub'
                                                                            ORDER BY att_course_id DESC, att_student_id ASC, att_date ASC
                                                                                                    ";
                                                        $result = mysqli_query($connect, $sql);
                                                    }
                                                    elseif($_POST['from']!=""
                                                        AND $_POST['to']!=""
                                                        ){

                                                        $from = $_POST['from'];
                                                        $to = $_POST['to'];
                                                        $v_choose_sub = $_POST['txt_choose_sub'];
    
                                                        $sql = "SELECT * FROM attendance AS A
                                                                            LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
                                                                            LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                            WHERE DATE_FORMAT(att_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
                                                                            ORDER BY att_course_id DESC, att_student_id ASC, att_date ASC
                                                                                                    ";
                                                        $result = mysqli_query($connect, $sql);
                                                    }
                                                    elseif($_POST['txt_choose_sub']!="0"
                                                        ){

                                                        $from = $_POST['from'];
                                                        $to = $_POST['to'];
                                                        $v_choose_sub = $_POST['txt_choose_sub'];
    
                                                        $sql = "SELECT * FROM attendance AS A
                                                                            LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
                                                                            LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                            WHERE att_course_id ='$v_choose_sub'
                                                                            ORDER BY att_course_id DESC, att_student_id ASC, att_date ASC
                                                                                                    ";
                                                        $result = mysqli_query($connect, $sql);
                                                    }
                                                    else{
                                                        echo 'Please, input data for search';
                                                        $v_current_year_month=date('Y-m');
                                                        $sql = "SELECT * FROM attendance AS A
                                                                            LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
                                                                            LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                            WHERE DATE_FORMAT(att_date,'%Y-%m')='$v_current_year_month'
                                                                            ORDER BY att_course_id DESC, att_student_id ASC, att_date ASC
                                                                                                    ";
                                                        $result = mysqli_query($connect, $sql);
                                                    }

                                                    

                                            }else{
                                                 
                                                $v_current_year_month=date('Y-m');
                                                $sql = "SELECT * FROM attendance AS A
                                                                    LEFT JOIN course AS CO ON CO.co_id=A.att_course_id
                                                                    LEFT JOIN student AS ST ON ST.stu_id=A.att_student_id
                                                                    WHERE DATE_FORMAT(att_date,'%Y-%m')='$v_current_year_month'
                                                                    ORDER BY att_course_id DESC, att_student_id ASC, att_date ASC
                                                                                            ";
                                                $result = mysqli_query($connect, $sql);
                                            }

                                            
                                            
                                                
											                                                                           
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
                        <!--            <td> <?php echo date('d-M-Y',strtotime($v_date));?> </td>  -->
                                    <td><?php echo $v_date;?></td>
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
                                      
                                    </td>
                                </tr>
                                    <?php
                                        }	 
                                    ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>
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
                                            
                                    </td>
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
                                                                                WhERE att_date ='$today'
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
                                                                                WHERE att_date ='$today'
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
                                                                                WHERE att_date ='$today'
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
                            
                        
                                        
                </div>
                

            </div>
            

                                
                                
                            
                            
                        

        </div>
    </div>
</div>
</div>
<?php include 'footer.php';?>