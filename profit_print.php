<?php include 'config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$thismonth = date('Y-m');
$datetime = date('Y-m-d H:i:s');
$month = date('m');
$year = date('Y');
    
    if(isset($_GET["del_id"])){
     $id = $_GET["del_id"];

     $sql = "DELETE FROM petty_cash WHERE pe_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {    
        header("location:petty_cash.php?message=delete");
     }
} 
?>

<style>
    @media print {
        html, body {
            zoom: 95%;
            margin: 0 !important; 
            padding: 0 !important;
            overflow: hidden;
            height:100%; 
            padding-top:-0.50mm !important; 
        }
    }


#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 1px;
  overflow-y: hidden; /* Hide vertical scrollbar */
  overflow-x: hidden; /* Hide horizontal scrollbar */
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 0px;
  padding-bottom: 0px;
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
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

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
                <div class="col-sm-12">
                    <h3 class="text-center">Profit & Lose</h3>
                    <h4 class="text-center">
                        <?php
                            
                                            
                                            $from = @$_GET['from'];
                                            $to = @$_GET['to'];                                                        
                                            
                                            echo date('d-M-Y',strtotime($from))." To ";
                                            echo date('d-M-Y',strtotime($to));
                                        
                            
                            
                        ?>
                    </h4>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-8">
                        <div class="divleft80">
                            Date:
                            <?php
                                echo date('d-M-Y H:i:s',strtotime($datetime));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-8">
                        <div class="divleft80">
                                    
                                    <?php
                                        
                                                    
                                                        
                                                        $from = @$_GET['from'];
                                                        $to = @$_GET['to'];                                                        
                                     
                                                        // get all income
                                                        // get income=1
                                                        $category_in =1;
                                                        $sql_in1 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in1 = mysqli_query($connect, $sql_in1);
                                                        $row_in1 = $result_in1->fetch_assoc();
                                                        $income_in1 = $row_in1['sumamount'];

                                                        // get income=2
                                                        $category_in =2;
                                                        $sql_in2 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in2 = mysqli_query($connect, $sql_in2);
                                                        $row_in2 = $result_in2->fetch_assoc();
                                                        $income_in2 = $row_in2['sumamount'];

                                                        // get income=3
                                                        $category_in =3;
                                                        $sql_in3 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in3 = mysqli_query($connect, $sql_in3);
                                                        $row_in3 = $result_in3->fetch_assoc();
                                                        $income_in3 = $row_in3['sumamount'];

                                                        // get income=4
                                                        $category_in =4;
                                                        $sql_in4 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in4 = mysqli_query($connect, $sql_in4);
                                                        $row_in4 = $result_in4->fetch_assoc();
                                                        $income_in4 = $row_in4['sumamount'];

                                                        // get income=5
                                                        $category_in =5;
                                                        $sql_in5 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in5 = mysqli_query($connect, $sql_in5);
                                                        $row_in5 = $result_in5->fetch_assoc();
                                                        $income_in5 = $row_in5['sumamount'];

                                                        // get income=6
                                                        $category_in =6;
                                                        $sql_in6 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in6 = mysqli_query($connect, $sql_in6);
                                                        $row_in6 = $result_in6->fetch_assoc();
                                                        $income_in6 = $row_in6['sumamount'];

                                                        // get income=7
                                                        $category_in =7;
                                                        $sql_in7 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in7 = mysqli_query($connect, $sql_in7);
                                                        $row_in7 = $result_in7->fetch_assoc();
                                                        $income_in7 = $row_in7['sumamount'];

                                                        // get income=8
                                                        $category_in =8;
                                                        $sql_in8 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in8 = mysqli_query($connect, $sql_in8);
                                                        $row_in8 = $result_in8->fetch_assoc();
                                                        $income_in8 = $row_in8['sumamount'];

                                                        // get income=9
                                                        $category_in =9;
                                                        $sql_in9 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in9 = mysqli_query($connect, $sql_in9);
                                                        $row_in9 = $result_in9->fetch_assoc();
                                                        $income_in9 = $row_in9['sumamount'];

                                                        // get income=10
                                                        $category_in =10;
                                                        $sql_in10 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in10 = mysqli_query($connect, $sql_in10);
                                                        $row_in10 = $result_in10->fetch_assoc();
                                                        $income_in10 = $row_in10['sumamount'];

                                                        // get income=11
                                                        $category_in =11;
                                                        $sql_in11 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in11 = mysqli_query($connect, $sql_in11);
                                                        $row_in11 = $result_in11->fetch_assoc();
                                                        $income_in11 = $row_in11['sumamount'];

                                                        // get income=12
                                                        $category_in =12;
                                                        $sql_in12 = "SELECT SUM(payd_amount) AS sumamount 
                                                                  FROM payment_detail AS A
                                                                  LEFT JOIN payment AS B ON B.pay_id=A.payd_payment_id
                                                                  WHERE payd_item_id=$category_in	
                                                                  AND DATE_FORMAT(pay_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'					
                                                                  ";
                                                        $result_in12 = mysqli_query($connect, $sql_in12);
                                                        $row_in12 = $result_in12->fetch_assoc();
                                                        $income_in12 = $row_in12['sumamount'];
                                                        
                                                        
                                                        // get all income
                                                        $total_income =$income_in1
                                                                        + $income_in2
                                                                        + $income_in3
                                                                        + $income_in4
                                                                        + $income_in5
                                                                        + $income_in6
                                                                        + $income_in7
                                                                        + $income_in8
                                                                        + $income_in9
                                                                        + $income_in10
                                                                        + $income_in11
                                                                        + $income_in12;


                                                            // get all expense 
                                                            // get expense=1
                                                            $category =1;
                                                            $v_current_year_month=date('Y-m');
                                                            $sql_exp1 = "SELECT SUM(exp_amount) AS sumamount
                                                                        FROM expense AS A
                                                                        WHERE exp_expense_cat=$category	
                                                                        AND DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'		
                                                                        ";
                                                            $result_exp1 = mysqli_query($connect, $sql_exp1);
                                                            $row_exp1 = $result_exp1->fetch_assoc();
                                                            $get_exp1 = $row_exp1['sumamount'];

                                                            // get expense=2
                                                            $category =2;
                                                            $v_current_year_month=date('Y-m');
                                                            $sql_exp2 = "SELECT SUM(exp_amount) AS sumamount
                                                                        FROM expense AS A
                                                                        WHERE exp_expense_cat=$category	
                                                                        AND DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'		
                                                                        ";
                                                            $result_exp2 = mysqli_query($connect, $sql_exp2);
                                                            $row_exp2 = $result_exp2->fetch_assoc();
                                                            $get_exp2 = $row_exp2['sumamount'];

                                                            // get expense=3
                                                            $category =3;
                                                            $v_current_year_month=date('Y-m');
                                                            $sql_exp3 = "SELECT SUM(exp_amount) AS sumamount
                                                                        FROM expense AS A
                                                                        WHERE exp_expense_cat=$category	
                                                                        AND DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'		
                                                                        ";
                                                            $result_exp3 = mysqli_query($connect, $sql_exp3);
                                                            $row_exp3 = $result_exp3->fetch_assoc();
                                                            $get_exp3 = $row_exp3['sumamount'];

                                                            // get expense=4
                                                            $category =4;
                                                            $v_current_year_month=date('Y-m');
                                                            $sql_exp4 = "SELECT SUM(exp_amount) AS sumamount
                                                                        FROM expense AS A
                                                                        WHERE exp_expense_cat=$category	
                                                                        AND DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'		
                                                                        ";
                                                            $result_exp4 = mysqli_query($connect, $sql_exp4);
                                                            $row_exp4 = $result_exp4->fetch_assoc();
                                                            $get_exp4 = $row_exp4['sumamount'];

                                                            // get expense=5
                                                            $category =5;
                                                            $v_current_year_month=date('Y-m');
                                                            $sql_exp5 = "SELECT SUM(exp_amount) AS sumamount
                                                                        FROM expense AS A
                                                                        WHERE exp_expense_cat=$category	
                                                                        AND DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'		
                                                                        ";
                                                            $result_exp5 = mysqli_query($connect, $sql_exp5);
                                                            $row_exp5 = $result_exp5->fetch_assoc();
                                                            $get_exp5 = $row_exp5['sumamount'];

                                                            // get expense=6
                                                            $category =6;
                                                            $v_current_year_month=date('Y-m');
                                                            $sql_exp6 = "SELECT SUM(exp_amount) AS sumamount
                                                                        FROM expense AS A
                                                                        WHERE exp_expense_cat=$category	
                                                                        AND DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'		
                                                                        ";
                                                            $result_exp6 = mysqli_query($connect, $sql_exp6);
                                                            $row_exp6 = $result_exp6->fetch_assoc();
                                                            $get_exp6 = $row_exp6['sumamount'];

                                                            // get expense=7
                                                            $category =7;
                                                            $v_current_year_month=date('Y-m');
                                                            $sql_exp7 = "SELECT SUM(exp_amount) AS sumamount
                                                                        FROM expense AS A
                                                                        WHERE exp_expense_cat=$category	
                                                                        AND DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'		
                                                                        ";
                                                            $result_exp7 = mysqli_query($connect, $sql_exp7);
                                                            $row_exp7 = $result_exp7->fetch_assoc();
                                                            $get_exp7 = $row_exp7['sumamount'];

                                                            // get expense=8
                                                            $category =8;
                                                            $v_current_year_month=date('Y-m');
                                                            $sql_exp8 = "SELECT SUM(exp_amount) AS sumamount
                                                                        FROM expense AS A
                                                                        WHERE exp_expense_cat=$category	
                                                                        AND DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'		
                                                                        ";
                                                            $result_exp8 = mysqli_query($connect, $sql_exp8);
                                                            $row_exp8 = $result_exp8->fetch_assoc();
                                                            $get_exp8 = $row_exp8['sumamount'];

                                                            // get expense=9
                                                            $category =9;
                                                            $v_current_year_month=date('Y-m');
                                                            $sql_exp9 = "SELECT SUM(exp_amount) AS sumamount
                                                                        FROM expense AS A
                                                                        WHERE exp_expense_cat=$category	
                                                                        AND DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'		
                                                                        ";
                                                            $result_exp9 = mysqli_query($connect, $sql_exp9);
                                                            $row_exp9 = $result_exp9->fetch_assoc();
                                                            $get_exp9 = $row_exp9['sumamount'];

                                                            // total expense
                                                            $total_expense=$get_exp1
                                                                                +$get_exp2
                                                                                +$get_exp3
                                                                                +$get_exp4
                                                                                +$get_exp5
                                                                                +$get_exp6
                                                                                +$get_exp7
                                                                                +$get_exp8
                                                                                +$get_exp9;

                                                            // profit 
                                                            $profit= $total_income-$total_expense;
                                                            
                                                        
                                                        
                                                       
                                                    
                                                    
                                        
                                            
                                    ?>

                            <table id="customers" class="display nowrap" width="100%" cellspacing="0">
                                <thead>
                                    <th width="70%"> Income </th>
                                    <th width="30%">  </th>
                                            <?php
                                                //income name all
                                                    // income 1
                                                    $in_category=1;
                                                    $sql_in_name_1 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_1 = mysqli_query($connect, $sql_in_name_1);
                                                    $row_in_name_1 = $result_in_name_1->fetch_assoc();
                                                    $in_name_1 = $row_in_name_1['ite_name'];

                                                    // income 2
                                                    $in_category=2;
                                                    $sql_in_name_2 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_2 = mysqli_query($connect, $sql_in_name_2);
                                                    $row_in_name_2 = $result_in_name_2->fetch_assoc();
                                                    $in_name_2 = $row_in_name_2['ite_name'];

                                                    // income 3
                                                    $in_category=3;
                                                    $sql_in_name_3 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_3 = mysqli_query($connect, $sql_in_name_3);
                                                    $row_in_name_3 = $result_in_name_3->fetch_assoc();
                                                    $in_name_3 = $row_in_name_3['ite_name'];

                                                    // income 4
                                                    $in_category=4;
                                                    $sql_in_name_4 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_4 = mysqli_query($connect, $sql_in_name_4);
                                                    $row_in_name_4 = $result_in_name_4->fetch_assoc();
                                                    $in_name_4 = $row_in_name_4['ite_name'];

                                                    // income 5
                                                    $in_category=5;
                                                    $sql_in_name_5 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_5 = mysqli_query($connect, $sql_in_name_5);
                                                    $row_in_name_5 = $result_in_name_5->fetch_assoc();
                                                    $in_name_5 = $row_in_name_5['ite_name'];

                                                    // income 6
                                                    $in_category=6;
                                                    $sql_in_name_6 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_6 = mysqli_query($connect, $sql_in_name_6);
                                                    $row_in_name_6 = $result_in_name_6->fetch_assoc();
                                                    $in_name_6 = $row_in_name_6['ite_name'];

                                                    // income 7
                                                    $in_category=7;
                                                    $sql_in_name_7 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_7 = mysqli_query($connect, $sql_in_name_7);
                                                    $row_in_name_7 = $result_in_name_7->fetch_assoc();
                                                    $in_name_7 = $row_in_name_7['ite_name'];

                                                    // income 8
                                                    $in_category=8;
                                                    $sql_in_name_8 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_8 = mysqli_query($connect, $sql_in_name_8);
                                                    $row_in_name_8 = $result_in_name_8->fetch_assoc();
                                                    $in_name_8 = $row_in_name_8['ite_name'];

                                                    // income 9
                                                    $in_category=9;
                                                    $sql_in_name_9 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_9 = mysqli_query($connect, $sql_in_name_9);
                                                    $row_in_name_9 = $result_in_name_9->fetch_assoc();
                                                    $in_name_9 = $row_in_name_9['ite_name'];

                                                    // income 10
                                                    $in_category=10;
                                                    $sql_in_name_10 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_10 = mysqli_query($connect, $sql_in_name_10);
                                                    $row_in_name_10 = $result_in_name_10->fetch_assoc();
                                                    $in_name_10 = $row_in_name_10['ite_name'];

                                                    // income 11
                                                    $in_category=11;
                                                    $sql_in_name_11 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_11 = mysqli_query($connect, $sql_in_name_11);
                                                    $row_in_name_11 = $result_in_name_11->fetch_assoc();
                                                    $in_name_11 = $row_in_name_11['ite_name'];

                                                    // income 12
                                                    $in_category=12;
                                                    $sql_in_name_12 = "SELECT * FROM item AS A
                                                                      WHERE ite_id =$in_category			
                                                                      ";
                                                    $result_in_name_12 = mysqli_query($connect, $sql_in_name_12);
                                                    $row_in_name_12 = $result_in_name_12->fetch_assoc();
                                                    $in_name_12 = $row_in_name_12['ite_name'];


                                            ?>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_1 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in1;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_2 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in2;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_3 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in3;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_4 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in4;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_5 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in5;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_6 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in6;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_7 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in7;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_8 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in8;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_9 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in9;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_10 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in10;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_11 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in11;
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10">
                                            <?php echo $in_name_12 ?>
                                        </td>
                                        <td class="textleft10">$ 
                                            <?php
                                                echo @$income_in12;
                                            ?>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                                <tfoot>
                                    <td class="text-right"><b> Total Income </b></td>
                                    <td class="textleft10">
                                        <b>$
                                            <?php
                                                echo @$total_income;
                                            ?>
                                        </b>
                                    </td>
                                </tfoot>
                            </table>
                        </div>
                        <div class="divleft80">
                            <br>
                            <table id="customers" class="display nowrap" width="100%" cellspacing="0">
                                <thead>
                                    <th width="70%"> Expense </th>
                                    <th width="30%">  </th>
                                                <?php
                                                    

                                                            // expense name all
                                                            //name 1
                                                            $sql_exp_name = "SELECT * FROM expense_category AS A
                                                                            WHERE exca_id =1				
                                                                            ";
                                                            $result_exp_name = mysqli_query($connect, $sql_exp_name);
                                                            $row_exp_name = $result_exp_name->fetch_assoc();
                                                            $name_1 = $row_exp_name['exca_name'];

                                                            //name 2
                                                            $sql_exp_name = "SELECT * FROM expense_category AS A
                                                                            WHERE exca_id =2			
                                                                            ";
                                                            $result_exp_name = mysqli_query($connect, $sql_exp_name);
                                                            $row_exp_name = $result_exp_name->fetch_assoc();
                                                            $name_2 = $row_exp_name['exca_name'];

                                                            //name 3
                                                            $sql_exp_name = "SELECT * FROM expense_category AS A
                                                                            WHERE exca_id =3			
                                                                            ";
                                                            $result_exp_name = mysqli_query($connect, $sql_exp_name);
                                                            $row_exp_name = $result_exp_name->fetch_assoc();
                                                            $name_3 = $row_exp_name['exca_name'];

                                                            //name 4
                                                            $sql_exp_name = "SELECT * FROM expense_category AS A
                                                                            WHERE exca_id =4			
                                                                            ";
                                                            $result_exp_name = mysqli_query($connect, $sql_exp_name);
                                                            $row_exp_name = $result_exp_name->fetch_assoc();
                                                            $name_4 = $row_exp_name['exca_name'];

                                                            //name 5
                                                            $sql_exp_name = "SELECT * FROM expense_category AS A
                                                                            WHERE exca_id =5
                                                                            ";
                                                            $result_exp_name = mysqli_query($connect, $sql_exp_name);
                                                            $row_exp_name = $result_exp_name->fetch_assoc();
                                                            $name_5 = $row_exp_name['exca_name'];

                                                            //name 6
                                                            $sql_exp_name = "SELECT * FROM expense_category AS A
                                                                            WHERE exca_id =6
                                                                            ";
                                                            $result_exp_name = mysqli_query($connect, $sql_exp_name);
                                                            $row_exp_name = $result_exp_name->fetch_assoc();
                                                            $name_6 = $row_exp_name['exca_name'];

                                                            //name 7
                                                            $sql_exp_name = "SELECT * FROM expense_category AS A
                                                                            WHERE exca_id =7
                                                                            ";
                                                            $result_exp_name = mysqli_query($connect, $sql_exp_name);
                                                            $row_exp_name = $result_exp_name->fetch_assoc();
                                                            $name_7 = $row_exp_name['exca_name'];

                                                            //name 8
                                                            $sql_exp_name = "SELECT * FROM expense_category AS A
                                                                            WHERE exca_id =8
                                                                            ";
                                                            $result_exp_name = mysqli_query($connect, $sql_exp_name);
                                                            $row_exp_name = $result_exp_name->fetch_assoc();
                                                            $name_8 = $row_exp_name['exca_name'];

                                                            //name 9
                                                            $sql_exp_name = "SELECT * FROM expense_category AS A
                                                                            WHERE exca_id =9
                                                                            ";
                                                            $result_exp_name = mysqli_query($connect, $sql_exp_name);
                                                            $row_exp_name = $result_exp_name->fetch_assoc();
                                                            $name_9 = $row_exp_name['exca_name'];

                                                ?>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="textleft10"><?php echo $name_1 ?></td>
                                        <td class="textleft10">
                                                $ 
                                                <?php
                                                    echo @$get_exp1;
                                                ?>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10"><?php echo $name_2 ?></td>
                                        <td class="textleft10">
                                                $ 
                                                <?php
                                                    echo @$get_exp2;
                                                ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10"><?php echo $name_3 ?></td>
                                        <td class="textleft10">
                                                $ 
                                                <?php
                                                    echo @$get_exp3;
                                                ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10"><?php echo $name_4 ?></td>
                                        <td class="textleft10">
                                                $ 
                                                <?php
                                                    echo @$get_exp4;
                                                ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10"><?php echo $name_5 ?></td>
                                        <td class="textleft10">
                                                $ 
                                                <?php
                                                    echo @$get_exp5;
                                                ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10"><?php echo $name_6 ?></td>
                                        <td class="textleft10">
                                                $ 
                                                <?php
                                                    echo @$get_exp6;
                                                ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10"><?php echo $name_7 ?></td>
                                        <td class="textleft10">
                                                $ 
                                                <?php
                                                    echo @$get_exp7;
                                                ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10"><?php echo $name_8 ?></td>
                                        <td class="textleft10">
                                                $ 
                                                <?php
                                                    echo @$get_exp8;
                                                ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="textleft10"><?php echo $name_9 ?></td>
                                        <td class="textleft10">
                                                $ 
                                                <?php
                                                    echo @$get_exp9;
                                                ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <td class="text-right"><b> Total Expense </b></td>
                                    <td class="textleft10">
                                        <b>
                                            $ 
                                            <?php
                                                echo @$total_expense;
                                            ?>
                                        </b>
                                    </td>
                                </tfoot>
                            </table>
                        </div>
                        <div class="divleft80">
                            <br>
                            <table id="customers" class="display nowrap" width="100%" cellspacing="0">
                                <thead>
                                    <th width="70%"> Profit </th>
                                    <th width="30%">  
                                            
                                    </th>
                                </thead>
                                <tbody>
                                    <tr>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <td class="text-right"><b>Total Profit </b></td>
                                    <td class="textleft10">
                                        <b>
                                            $ 
                                            <?php
                                                echo @$profit;
                                            
                                            ?>
                                        </b>
                                    </td>
                                </tfoot>
                            </table>

                            
                        </div>
                        
                                    <!-- Sign place -->
                                    <div class="col-md-12">
                                        <br>
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
</div>