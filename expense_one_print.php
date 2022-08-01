<?php include 'config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$thismonth = date('Y-m');
$datetime = date('Y-m-d H:i:s');
$month = date('m');
$year = date('Y');

$id = $_GET["print_id"];
$sql = "SELECT * FROM expense AS A
                LEFT JOIN expense_category AS ECAT ON ECAT.exca_id=A.exp_expense_cat
                WHERE exp_id = $id";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($result);

$get_date =$row['exp_date'];

$get_expense_cat =$row['exca_name'];
$get_description =$row['exp_description'];
$get_amount =$row['exp_amount'];
$get_pay_to =$row['exp_pay_to'];
$get_note =$row['exp_note'];

if(isset($_GET["del_id"])){
     $id = $_GET["del_id"];

     $sql = "DELETE FROM petty_cash WHERE pe_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {    
        header("location:petty_cash.php?message=delete");
     }
} 
// get imag banner
$id_img = 1;
$sql_img = "SELECT * FROM school_info
                    WHERE in_id ='$id_img'
                                            ";
$result_img = mysqli_query($connect, $sql_img);
$row_img = $result_img->fetch_assoc(); 

?>

<style>
    @media print {
        html, body {
            zoom: 100%;
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
.textcenter{
    text-align: center;
}
.title_center{
    p
}

</style>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />


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
                    <p class="text-center">
                        <img src="img/<?= $row_img['in_banner']; ?>" style="
            width:820px;
            height:170px;
            border: solid 0px #CCC"/>
                    </p>
                </div>
                <div class="col-sm-12">
                    <h3 style="text-align:center">Expense Voucher</h3>
                    <h4 style="text-align:center">
                        *****
                    </h4>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">
                        <div class="divleft80">
                            <h4>
                                Date:
                                <?php
                                    echo $get_date;
                                ?>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">
                        <div class="divleft80">
                                    
                                    

                            <table id="customers" class="display nowrap" width="100%" cellspacing="0">
                                <thead>
                                    <th> Description </th>
                                    <th> Amount </th>
                                    <th> Pay to </th>
                                    <th> Note </th>
                                            
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <b><?php echo $get_expense_cat; ?></b>
                                            <br>
                                            <?php echo $get_description; ?>
                                        </td>
                                        <td>
                                            <?php echo $get_amount; ?>
                                        </td>
                                        <td>
                                            <?php echo $get_pay_to; ?>
                                        </td>
                                        <td>
                                            <?php echo $get_note; ?>
                                        </td>
                                    </tr>
                                    
                                    
                                </tbody>
                                
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