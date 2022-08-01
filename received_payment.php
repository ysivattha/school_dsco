<?php include 'config/db_connect.php';
$user =@$_SESSION['user_id'];
    if(isset($_GET["del_id"])){
     $id = $_GET["del_id"];

     $sql = "DELETE FROM payment WHERE pay_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:received_payment.php?message=delete");
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
                <h3 class="text-primary">Received Payment</h3>
                
                <a href="received_payment_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
				
                <form class="form-inline" method = "post" action="" style="display: inline-block;">
                  <div class="form-group">
                    <input type="text" data-provide="datepicker" placeholder="DATE START" autocomplete="off" data-date-format="yyyy-mm-dd" class="form-control" required="" name = "from" value="<?= @$_POST['from'] ?>" >
                  </div>
                  <div class="form-group">
                    <input type="text" data-provide="datepicker" placeholder="DATE END" autocomplete="off" data-date-format="yyyy-mm-dd" class="form-control" required="" name = "to" value="<?= @$_POST['to'] ?>"> 
                  </div>
                  
                  <button type="submit" name="search" class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                  <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Clear</a>
                  <a href="received_payment_print.php?from=<?php echo @$_POST['from']; ?>&to=<?php echo @$_POST['to']; ?>" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print</a>
				
                </form>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Student</th>
                                <th>Course</th>
                                <th>Time</th>
                                <th>Pay_For</th>
                                <th>Full_Fee</th>
                                <th>Discount</th>
                                <th>Pay</th>
                                <th>Rest</th>
                                <th>Date_Alert</th>
                                <th>Type</th>
                                <th>Note</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php    
                                        if(isset($_POST['search'])){
                                            $from = $_POST['from'];
                                            $to = $_POST['to'];
                                            $v_current_year_month=date('Y-m');

                                            $sql = "SELECT * FROM payment AS A
                                                                LEFT JOIN student AS STU ON STU.stu_id=A.pay_student_id
                                                                LEFT JOIN course AS COU ON COU.co_id=A.pay_course_id
                                                                LEFT JOIN time_learn AS TIM ON TIM.ti_id=COU.co_time
                                                                WHERE DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
                                                                AND (pay_note)!='Other Revenue'
                                                                ";
                                            $result = mysqli_query($connect, $sql);

                                            // count
                                            $sql_count = "SELECT COUNT(pay_id) AS countpay
                                                                , SUM(pay_pay) AS sumpay
                                                                , SUM(pay_rest) AS sumrest
                                                            FROM payment AS A
                                                            WHERE DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
                                                            AND (pay_note)!='Other Revenue'
                                                            ";	
                                            $result_count = $connect->query($sql_count);
                                            $row_count = $result_count->fetch_assoc();
                                            $get_count = $row_count['countpay'];
                                            $get_sum = $row_count['sumpay'];
                                            $get_sumrest = $row_count['sumrest'];
                                            //echo $get_count;
                                        
                                        }else{
                                            $v_current_year_month=date('Y-m');
                                            $v_alert = "Alert";
                                            $sql = "SELECT * FROM payment AS A
                                                                LEFT JOIN student AS STU ON STU.stu_id=A.pay_student_id
                                                                LEFT JOIN course AS COU ON COU.co_id=A.pay_course_id
                                                                LEFT JOIN time_learn AS TIM ON TIM.ti_id=COU.co_time
                                                                WHERE pay_stop_alert='$v_alert'
                                                                AND (pay_note)!='Other Revenue'
                                                                ORDER BY A.pay_id DESC
                                                                ";
                                            $result = mysqli_query($connect, $sql);

                                            // count
                                            $sql_count = "SELECT COUNT(pay_id) AS countpay
                                                                , SUM(pay_pay) AS sumpay
                                                                , SUM(pay_rest) AS sumrest
                                                            FROM payment AS A
                                                            WHERE pay_stop_alert='$v_alert'
                                                            AND (pay_note)!='Other Revenue'
                                                            ";	
                                            $result_count = $connect->query($sql_count);
                                            $row_count = $result_count->fetch_assoc();
                                            $get_count = $row_count['countpay'];
                                            $get_sum = $row_count['sumpay'];
                                            $get_sumrest = $row_count['sumrest'];
                                            //echo $get_count;
                                        }    
                                            
                                                                           
                                        	$i= 1;
                                            $v_amount_total=0;
                                            $v_rest_total=0;
                                            $v_pay_total=0;
											while($row = $result->fetch_assoc()) 
											{	
                                                    $main_id = $row["pay_id"];   
													$sql_sub = "SELECT SUM(payd_amount) AS sumamount FROM payment_detail
																	LEFT JOIN item ON item.ite_id=payment_detail.payd_item_id
																	WHERE payd_payment_id=$main_id
															";
													$result_sub = mysqli_query($connect, $sql_sub);
                                                    $row_sub = $result_sub->fetch_assoc();
                                                    $v_amount   =$row_sub["sumamount"];

                                                

												$v_date   =$row["pay_date"];
                                                $v_student_id   =$row["pay_student_id"];
                                                $v_card_id   =$row["stu_card_id"];
                                                $v_student_en   =$row["stu_name_en"];
                                                $v_student_kh   =$row["stu_name_kh"];

                                                $v_course   =$row["co_name"];
                                                $v_product   =$row["pay_product_id"];
                                                $v_course_generation   =$row["co_generation"];
                                                $v_time_id   =$row["co_time"];
                                                $v_time   =$row["ti_name"];
                                                
                                                    
                                                
                                                $v_discount   =$row["pay_discount"];
                                                $v_pay   =$row["pay_pay"];

                                                    $v_rest =$v_amount-$v_discount-$v_pay;
                                                $v_date_alert   =$row["pay_date_alert"];
                                                $v_note   =$row["pay_note"];
                                                $v_stop_alert   =$row["pay_stop_alert"];

                                                // total show

                                                $v_amount_total   +=$row_sub["sumamount"];
                                                $v_rest_total +=$v_amount-$v_discount-$v_pay;
                                                $v_pay_total   +=$row["pay_pay"];
                                                
										?>
                                <tr>
                                    <td> <?php echo $i++;?> </td>
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
                                    <td> 
                                        (<?php echo $v_card_id;?>) <?php echo $v_student_en;?> : <?php echo $v_student_kh;?> 
                                    </td>
                                    <td> 
                                        <?php echo $v_course;?> : <?php echo $v_course_generation;?>  
                                
                                    </td>
                                    <td> <?php echo $v_time;?> </td>
                                    <td> 
                                        <a href="received_payment_detail.php?edit_id=<?php echo $row['pay_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-list"> </i> Pay Detail</a>
									    <a href="print_receipt_en.php?edit_id=<?php echo $row['pay_id']; ?>" class="btn btn-info btn-sm"><i class="fa fa-print"> </i> Print Receipt</a>
										<a href="received_payment_class_history.php?sent_id=<?php echo $v_student_id; ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> Print Class History </a>
							
                                    </td>
                                    <td>$ <?php echo $v_amount;?> </td>
                                    <td>$ <?php echo $v_discount;?> </td>
                                    <td>$ <?php echo $v_pay;?> </td>
                                    <td>$ <?php echo $v_rest;?> </td>
                                    <td>
                                                <?php
                                                    if($v_date_alert=="0000-00-00"){
                                                        echo '';
                                                    }
                                                    elseif($v_date_alert==""){
                                                        echo '';
                                                    }	
                                                    else{
                                                        echo date('d-M-Y',strtotime($v_date_alert));
                                                    }
                                                ?>   
                                    </td>
                                    <td> <?php echo $v_stop_alert;?> </td>
                                    <td> <?php echo $v_note;?> </td>

                                    <td class="text-center">
                                        <a href="received_payment_edit.php?edit_id=<?php echo $row['pay_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										<a onclick="return confirm('Are you sure to delete?');" href="received_payment.php?del_id=<?php echo $row['pay_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                    <?php
                                        }	 
                                    ?>
                            </tbody>
                        </table>

                        <span style="color:blue">
                            <b> Count: </b> 
                        </span>
                        <span style="color:red">
                            <b> 
                                <?php
                                    echo $get_count;
                                ?>
                            </b> 
                        </span>

                        <br>
                        <span style="color:green">
                            <b> All Total: </b> 
                        </span>
                        <span style="color:red">
                            <b> 
                                <?php
                                    echo $v_amount_total;
                                ?>
                            </b> 
                        </span> 

                        <br>
                        <span style="color:blue">
                            <b> Pay Total: </b> 
                        </span>
                        <span style="color:red">
                            <b> 
                                <?php
                                    echo $v_pay_total;
                                ?>
                            </b> 
                        </span>

                        <br>
                        <span style="color:blue">
                            <b> Rest Total (A/R): </b> 
                        </span>
                        <span style="color:red">
                            <b> 
                                <?php                                    
                                    echo $v_rest_total;
                                ?>
                            </b> 
                        </span>   
                        
                        
                                        
                </div>

            </div>

        </div>
    </div>
</div>
</div>
<?php include 'footer.php';?>