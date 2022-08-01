<?php include 'config/db_connect.php';
$user =@$_SESSION['user_id'];

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

    if(isset($_GET["del_id"])){
        $del_id = $_GET["del_id"];

        $sql = "DELETE FROM payment_detail WHERE payd_id = '$del_id'";
        $result = mysqli_query($connect, $sql);

        header("location:revenue_list.php");
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
                <h3 class="text-primary">Revenue List</h3>                
				<a href="revenue_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
                          
            </div>
			<div class="row">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">               
                <div class="col-sm-12">
                    
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="from" value="<?= @$_POST['from'] ?>">
                    </div>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="to" value="<?= @$_POST['to'] ?>">
                    </div>
                    <div class="col-sm-3">
                            <select name="txt_choose_type" class="form-control select2" >
                                <option value="0">=== Type ===</option>
                                <?php 
                                    $customer = $connect->query("SELECT * FROM item ORDER BY ite_id ASC");
                                    while($row_cus = mysqli_fetch_object($customer)){
                                        if($row_cus->ite_id  == @$_POST['txt_choose_type']){
                                            echo '<option SELECTED value="'.$row_cus->ite_id.'">'.$row_cus->ite_name.'</option>';

                                        }else{
                                            echo '<option value="'.$row_cus->ite_id.'">'.$row_cus->ite_name.'</option>';
                                            
                                        }
                                    }
                                ?>
                            </select>
                    </div>
                
                    
                    <div class="col-sm-4">
                        <div class="caption font-dark" style="display: inline-block;">
                            <button type="submit" name="search" id="sample_editable_1_new" class="btn btn-primary btn-sm"> Search
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="caption font-dark" style="display: inline-block;">
                            <a href="<?= $_SERVER['PHP_SELF'] ?>" id="sample_editable_1_new" class="btn btn-danger btn-sm"> Clear
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a href="revenue_print.php?from=<?php echo @$_POST['from']; ?>&to=<?php echo @$_POST['to']; ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print</a>
				
                        </div>

                    </div>
                    
                </div>
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
                                <th>Income_Type</th>
                                <th>Amount</th>
                                <th>Note</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                                    <?php     
                                            
                                            if(isset($_POST['search'])){
                                                $type = $_POST['txt_choose_type'];
                                                $from = $_POST['from'];
                                                $to = $_POST['to'];
                                                            if($_POST['from']!=""
                                                                AND $_POST['txt_choose_type']!="0"
                                                                ){                                                               

                                                                $sql = "SELECT * FROM payment_detail AS A
                                                                                    LEFT JOIN payment AS PAY ON PAY.pay_id=A.payd_payment_id
                                                                                    LEFT JOIN student AS STU ON STU.stu_id=PAY.pay_student_id
                                                                                    LEFT JOIN item AS ITEM ON ITEM.ite_id=A.payd_item_id
                                                                                    WHERE DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
                                                                                    AND payd_item_id=$type						
                                                                                    ORDER BY pay_date DESC, payd_id DESC	
                                                                                    ";
                                                                $result = mysqli_query($connect, $sql);                                                                
                                                                

                                                                // get count
                                                                $sql_count = "SELECT COUNT(payd_id) AS countid 
                                                                                    FROM payment_detail AS A
                                                                                    LEFT JOIN payment AS PAY ON PAY.pay_id=A.payd_payment_id
                                                                                    LEFT JOIN student AS STU ON STU.stu_id=PAY.pay_student_id
                                                                                    LEFT JOIN item AS ITEM ON ITEM.ite_id=A.payd_item_id
                                                                                    WHERE DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
                                                                                    AND payd_item_id=$type						
                                                                                    ORDER BY pay_date DESC, payd_id DESC				
                                                                                    ";
                                                                $result_count = mysqli_query($connect, $sql_count);
                                                                $row_count = $result_count->fetch_assoc();
                                                                $get_count = $row_count['countid'];
                                                        
                                                            }
                                                            elseif($_POST['from']!=""){                                                               

                                                                $sql = "SELECT * FROM payment_detail AS A
                                                                                    LEFT JOIN payment AS PAY ON PAY.pay_id=A.payd_payment_id
                                                                                    LEFT JOIN student AS STU ON STU.stu_id=PAY.pay_student_id
                                                                                    LEFT JOIN item AS ITEM ON ITEM.ite_id=A.payd_item_id
                                                                                    WHERE DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'						
                                                                                    ORDER BY pay_date DESC, payd_id DESC	
                                                                                    ";
                                                                $result = mysqli_query($connect, $sql);                                                                
                                                                

                                                                // get count
                                                                $sql_count = "SELECT COUNT(payd_id) AS countid 
                                                                                    FROM payment_detail AS A
                                                                                    LEFT JOIN payment AS PAY ON PAY.pay_id=A.payd_payment_id
                                                                                    LEFT JOIN student AS STU ON STU.stu_id=PAY.pay_student_id
                                                                                    LEFT JOIN item AS ITEM ON ITEM.ite_id=A.payd_item_id
                                                                                    WHERE DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                                    ORDER BY pay_date DESC, payd_id DESC				
                                                                                    ";
                                                                $result_count = mysqli_query($connect, $sql_count);
                                                                $row_count = $result_count->fetch_assoc();
                                                                $get_count = $row_count['countid'];
                                                        
                                                            }
                                                            elseif($_POST['txt_choose_type']!="0"){

                                                                $sql = "SELECT * FROM payment_detail AS A
                                                                                    LEFT JOIN payment AS PAY ON PAY.pay_id=A.payd_payment_id
                                                                                    LEFT JOIN student AS STU ON STU.stu_id=PAY.pay_student_id
                                                                                    LEFT JOIN item AS ITEM ON ITEM.ite_id=A.payd_item_id
                                                                                    WHERE payd_item_id=$type						
                                                                                    ORDER BY pay_date DESC, payd_id DESC	
                                                                                    ";
                                                                $result = mysqli_query($connect, $sql);                                                                
                                                                

                                                                // get count
                                                                $sql_count = "SELECT COUNT(payd_id) AS countid 
                                                                                    FROM payment_detail AS A
                                                                                    LEFT JOIN payment AS PAY ON PAY.pay_id=A.payd_payment_id
                                                                                    LEFT JOIN student AS STU ON STU.stu_id=PAY.pay_student_id
                                                                                    LEFT JOIN item AS ITEM ON ITEM.ite_id=A.payd_item_id
                                                                                    WHERE payd_item_id=$type					
                                                                                    ORDER BY pay_date DESC, payd_id DESC				
                                                                                    ";
                                                                $result_count = mysqli_query($connect, $sql_count);
                                                                $row_count = $result_count->fetch_assoc();
                                                                $get_count = $row_count['countid'];
                                                        
                                                            }
                                                            else{
                                                                $v_current_year_month=date('Y-m');
                                                                $sql = "SELECT * FROM payment_detail AS A
                                                                                    LEFT JOIN payment AS PAY ON PAY.pay_id=A.payd_payment_id
                                                                                    LEFT JOIN student AS STU ON STU.stu_id=PAY.pay_student_id
                                                                                    LEFT JOIN item AS ITEM ON ITEM.ite_id=A.payd_item_id
                                                                                    WHERE DATE_FORMAT(pay_date,'%Y-%m')='$v_current_year_month'						
                                                                                    ORDER BY pay_date DESC, payd_id DESC	
                                                                                    ";
                                                                $result = mysqli_query($connect, $sql);

                                                                // get count
                                                                $sql_count = "SELECT COUNT(payd_id) AS countid 
                                                                                    FROM payment_detail AS A
                                                                                    LEFT JOIN payment AS PAY ON PAY.pay_id=A.payd_payment_id
                                                                                    LEFT JOIN student AS STU ON STU.stu_id=PAY.pay_student_id
                                                                                    LEFT JOIN item AS ITEM ON ITEM.ite_id=A.payd_item_id
                                                                                    WHERE DATE_FORMAT(pay_date,'%Y-%m')='$v_current_year_month'						
                                                                                    ORDER BY pay_date DESC, payd_id DESC				
                                                                                    ";
                                                                $result_count = mysqli_query($connect, $sql_count);
                                                                $row_count = $result_count->fetch_assoc();
                                                                $get_count = $row_count['countid'];

                                                                echo "Please, choose date for serach";
                                                            }
                                            }else{
												
												$v_current_year_month=date('Y-m');
												$sql = "SELECT * FROM payment_detail AS A
                                                                    LEFT JOIN payment AS PAY ON PAY.pay_id=A.payd_payment_id
                                                                    LEFT JOIN student AS STU ON STU.stu_id=PAY.pay_student_id
                                                                    LEFT JOIN item AS ITEM ON ITEM.ite_id=A.payd_item_id
																	WHERE DATE_FORMAT(pay_date,'%Y-%m')='$v_current_year_month'						
																	ORDER BY pay_date DESC, payd_id DESC	
                                                                    ";
												$result = mysqli_query($connect, $sql);

                                                // get count
                                                $sql_count = "SELECT COUNT(payd_id) AS countid 
                                                                    FROM payment_detail AS A
																	LEFT JOIN payment AS PAY ON PAY.pay_id=A.payd_payment_id
                                                                    LEFT JOIN student AS STU ON STU.stu_id=PAY.pay_student_id
                                                                    LEFT JOIN item AS ITEM ON ITEM.ite_id=A.payd_item_id
																	WHERE DATE_FORMAT(pay_date,'%Y-%m')='$v_current_year_month'						
																	ORDER BY pay_date DESC, payd_id DESC				
																	";
												$result_count = mysqli_query($connect, $sql_count);
                                                $row_count = $result_count->fetch_assoc();
                                                $get_count = $row_count['countid'];

											}
                                            
                                                                           
                                        	$i =1;
                                            $count =0;
                                            $v_amount_total =0;
											while($row = $result->fetch_assoc()) 
											{		
                                                $v_id =$row["payd_id"];
                                                $count +=$i;
                                                
                                                $v_amount_total   +=$row["payd_amount"];

												$v_date   =$row["pay_date"];
                                                    
                                                $v_student_id   =$row["pay_student_id"];
                                                $v_card_id   =$row["stu_card_id"];
                                                $v_student_en   =$row["stu_name_en"];
                                                $v_student_kh   =$row["stu_name_kh"];

                                                $v_item   =$row["ite_name"];

                                                $v_amount   =$row["payd_amount"];
                                                $v_discount   =$row["pay_discount"];
                                                $v_pay   =$row["pay_pay"];
                                                $v_rest   =$row["pay_rest"];
                                                $v_date_alert   =$row["pay_date_alert"];
                                                $v_note   =$row["payd_note"];
                                                $v_type_alert   =$row["pay_stop_alert"];
                                                
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
                                        <?php echo $v_card_id;?> <?php echo $v_student_kh;?> 
                                    </td>
                                    <td> 
                                        <?php echo $v_item;?>
                                
                                    </td>
                                    <td>$ <?php echo $v_amount;?> </td>
                                    <td> <?php echo $v_note;?> </td>
                                    <td class="text-center">
                                        
                                            <a href="revenue_edit.php?edit_id=<?php echo $v_id ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										    <a onclick="return confirm('Are you sure to delete?');" href="revenue_list.php?del_id=<?php echo $v_id ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
										
                                        	
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

                                        <br>
                                        <span style="color:green">
                                            <b> Total: </b> 
                                        </span>
                                        <b>
                                            $ 
                                            <?php
                                                echo $v_amount_total;
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