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

<style>
@media print 
{
    @page {
      size: A4; /* DIN A4 standard, Europe */
	  margin-top: 0.5cm;
    }
    html, body {
        width: 210mm;
        /* height: 297mm; */
        height: 282mm;
        font-size: 11px;
        background: #FFF;
        overflow:visible;
    }
    body {
        padding-top:0mm;
    }
}

#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  overflow-y: hidden; /* Hide vertical scrollbar */
  overflow-x: hidden; /* Hide horizontal scrollbar */
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #ADD8E6;
  color: black;
}

.column {
  float: left;
  width: 50%;
  padding: 10px;
  height: 100%; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

</style>

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
                <h3 class="text-primary">Revenue List (Print)</h3>                
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="customers" class="display nowrap" width="100%" cellspacing="0">
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
                                            
												$from = $_GET['from'];
												$to = $_GET['to'];

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


                            <!-- Sign place -->
                            <div class="col-lg-12 col-md-12">
                                        <div class="column">
                                            <p style="text-align:center">
                                                ថ្ងៃទី .......... ខែ............ ឆ្នាំ 20...
                                                <br>
                                                            អ្នកប្រគល់
                                                <br>
                                                <br>
                                                <br>
                                                _______________________
                                            </p>
                                        
                                        </div>
                                        <div class="column">
                                            <p style="text-align:center">
                                                ថ្ងៃទី .......... ខែ............ ឆ្នាំ 20...
                                                <br>
                                                        អ្នកទទួល
                                                        <br>
                                                <br>
                                                <br>
                                                _______________________
                                            </p>
                                        </div>
                                    </div>
                                        
                </div>

            </div>

        </div>
    </div>
</div>
</div>
