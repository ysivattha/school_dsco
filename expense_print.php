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
                <h3 class="text-primary">Expnese List (Print)</h3>   
                
                
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="customers" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Expense_Category</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Pay_To</th>
                                    <th>Note</th>
                                    <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                </tr>
                        </thead>
                        <tbody>
                                    <?php     
                                            
											$from = $_GET['from'];
											$to = $_GET['to'];
                                            $expense = $_GET['txt_choose_exp'];

                                            if($_GET['from']!=""
                                                AND $_GET['txt_choose_exp']!="0"
                                                ){
                                                $sql = "SELECT * FROM expense
                                                        LEFT JOIN expense_category ON expense_category.exca_id=expense.exp_expense_cat
                                                        WHERE DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
                                                        AND exp_expense_cat=$expense
                                                        ORDER BY exp_date DESC
                                                        ";
                                                $result = mysqli_query($connect, $sql); 
                                            }elseif($_GET['from']!=""
                                                ){
                                                $sql = "SELECT * FROM expense
                                                        LEFT JOIN expense_category ON expense_category.exca_id=expense.exp_expense_cat
                                                        WHERE DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
                                                        ORDER BY exp_date DESC
                                                        ";
                                                $result = mysqli_query($connect, $sql);
                                            }elseif($_GET['txt_choose_exp']!="0"
                                                ){
                                                $sql = "SELECT * FROM expense
                                                        LEFT JOIN expense_category ON expense_category.exca_id=expense.exp_expense_cat
                                                        WHERE exp_expense_cat=$expense
                                                        ORDER BY exp_date DESC
                                                        ";
                                                $result = mysqli_query($connect, $sql);
                                            }else{
                                                $v_current_year_month=date('Y-m');
                                                $v_current_year =date('Y');
                                                $sql = "SELECT * FROM expense
                                                        LEFT JOIN expense_category ON expense_category.exca_id=expense.exp_expense_cat
                                                        WHERE DATE_FORMAT(exp_date,'%Y')='$v_current_year'
                                                        ORDER BY exp_date DESC
                                                        ";
                                                $result = mysqli_query($connect, $sql);
                                                //echo '4';
                                            }
                                              
										                                                                            
                                        	$i =1;
                                            $v_count =0;
                                            $v_amount_total =0;
											while($row = $result->fetch_assoc()) 
											{		
                                                $v_amount_total +=$row["exp_amount"];
                                                $i_count =1;
                                                $v_count +=$i_count;

                                                $v_date =$row["exp_date"];
                                                $v_expense_cat =$row["exca_name"];
                                                $v_description =$row["exp_description"];
                                                $v_amount =$row["exp_amount"];
                                                $v_pay_to =$row["exp_pay_to"];
                                                $v_note =$row["exp_note"];
                                                
										?>
                                <tr>
                                        <td><?php echo $i++ ;?></td> 
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
                                        <td><?php echo $v_expense_cat;?></td>
                                        <td><?php echo $v_description;?></td>
                                        <td><?php echo $v_amount;?></td>
                                        <td><?php echo $v_pay_to;?></td>
                                        <td><?php echo $v_note;?></td>
                                        <td align = "center">
                                        
                                        </td>
                                </tr> 
                                    <?php
                                        }	 
                                    ?>
                            </tbody>
                            
                        </table>
                        
                                    <span style="color:red">
                                        <br>
                                        <span style="color:black">
                                            <b> Count: </b> 
                                        </span>
                                        <b>
                                            
                                            <?php
                                                echo $v_count;
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

