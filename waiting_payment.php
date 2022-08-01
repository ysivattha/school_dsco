<?php include 'config/db_connect.php';
$user =@$_SESSION['user_id'];

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');


    if(isset($_GET["update_id"])){
        $id = $_GET["update_id"];
        $v_alert = "Alert";

        $sql = "UPDATE payment SET pay_stop_alert = '$v_alert'
								WHERE pay_id = '$id'" ;
        mysqli_query($connect, $sql);
        header("location:stop_alert_payment.php?message=update");
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
                <h3 class="text-primary">Waiting Payment List</h3>
                
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                <th>Note</th>
                                <th>Date</th>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Pay_For</th>
                                <th>Full_Fee</th>
                                <th>Discount</th>
                                <th>Pay</th>
                                <th>Rest</th>
                                <th>Alert</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                                    <?php     
                                            
                                            $v_stop_alert = "Waiting_Pay";
                                            $sql = "SELECT * FROM payment AS A
                                                                LEFT JOIN student AS STU ON STU.stu_id=A.pay_student_id
                                                                LEFT JOIN course AS COU ON COU.co_id=A.pay_course_id
                                                                WhERE A.pay_stop_alert = '$v_stop_alert'
                                                                                                    ";
                                            $result = mysqli_query($connect, $sql);
                                                                           
                                        	$i= 1;
                                            $v_amount_total =0;
											while($row = $result->fetch_assoc()) 
											{		
                                                $v_amount_total   +=$row["pay_amount"];

                                                
												$v_date   =$row["pay_date"];
                                                $v_student_id   =$row["pay_student_id"];
                                                $v_student_code   =$row["stu_card_id"];
                                                $v_student_en   =$row["stu_name_en"];
                                                $v_student_kh   =$row["stu_name_kh"];

                                                $v_course   =$row["co_name"];
                                                $v_product   =$row["pay_product_id"];
                                                $v_course_generation   =$row["co_generation"];

                                                $v_amount   =$row["pay_amount"];
                                                $v_discount   =$row["pay_discount"];
                                                $v_pay   =$row["pay_pay"];
                                                $v_rest   =$row["pay_rest"];
                                                $v_date_alert   =$row["pay_date_alert"];
                                                $v_note   =$row["pay_note"];
                                                
										?>
                                <tr>
                                    <td class="text-center">
                                        
                                        <a onclick="return confirm('Are you sure to set alert?');" href="stop_alert_payment.php?update_id=<?php echo $row['pay_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Set Alert</a>
                                   
                                    </td>
                                    <td> <?php echo $v_note;?> </td>
                                    <td> <?php echo $v_date;?> </td>
                                    <td> 
                                        (<?php echo $v_student_code;?>) <?php echo $v_student_en;?> : <?php echo $v_student_kh;?> 
                                    </td>
                                    <td> 
                                        <?php echo $v_course;?> : <?php echo $v_course_generation;?>  
                                
                                    </td>
                                    <td> 
                                        <?php echo $v_product;?>
                                
                                    </td>
                                    <td>$ <?php echo $v_amount;?> </td>
                                    <td>$ <?php echo $v_discount;?> </td>
                                    <td>$ <?php echo $v_pay;?> </td>
                                    <td>$ <?php echo $v_rest;?> </td>
                                    <td> <?php echo $v_date_alert;?> </td>
                                    

                                    
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
                                    <td>Total: </td>
                                    <td>$ 
                                        <?php
                                            echo $v_amount_total;
                                        ?>
                                    </td>
                                    <td></td>
                                    <td></td>
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