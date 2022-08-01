<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    body {        
        width: 210mm;
        height: 100%;
        margin-top: 30px;
        margin-left: 5px;
        margin-right: 0px;
        padding: 0;
        font-size: 12pt; 
    }
    * {
    box-sizing: border-box;
    }

    /* Create three equal columns that floats next to each other */
    .column {
    float: left;
    width: 33.33%;
    padding: 10px;
    }
    .column2 {
    float: left;
    width: 40%;
    padding: 10px;
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
    .textright{
        text-align: right;
        padding-right: 33px;
    }

    /* table 1 */
    table, td, th {  
    border: 1px solid #ddd;
    text-align: left;
    }

    table {
    border-collapse: collapse;
    width: 100%;
    }

    th, td {
    padding: 7px;
    }
    </style>
</head>

<body>
<?php include 'config/db_connect.php'; ?>
<?php
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

    $id = $_GET["edit_id"]; 
    $today = date('Y-m-d');
    $sql = "SELECT * FROM payment
                        LEFT JOIN student ON student.stu_id=payment.pay_student_id
                        WHERE pay_id ='$id'
                                                ";
    $result = mysqli_query($connect, $sql);
    $row = $result->fetch_assoc();

    $v_pay_date = $row['pay_date'];
    $v_student_id = $row['pay_student_id'];
    $v_card_id = $row['stu_card_id'];
    $v_student_name_en = $row['stu_name_en'];
    $v_student_name_kh = $row['stu_name_kh'];
    $v_student_phone = $row['stu_phone'];
    $v_pay_note = $row['pay_note'];
    $v_discount = $row['pay_discount'];

    $v_date_alert = $row['pay_date_alert'];

    // get imag banner
    $id_img = 1;
    $sql_img = "SELECT * FROM school_info
                        WHERE in_id ='$id_img'
                                                ";
    $result_img = mysqli_query($connect, $sql_img);
    $row_img = $result_img->fetch_assoc();    
?>
    <div class="textcenter">
        <img height="210px" src="img/<?= $row_img['in_banner']; ?>">
    
    </div>
    <div class="textcenter">
        <h3 style="font-family:Khmer; color:black">បង្កាន់ដៃបង់ប្រាក់</h3>
        
    </div>
    
    <div class="row">
        <div class="textright">
            <spance style="font-family:Khmer; color:black">
                <b>
                    លេខបង្កាន់ដៃ ៈ 
                    <?php
                        echo $v_card_id;
                    ?>
                </b>
            </spance>
        </div>
        <div class="column">
                    <p style="font-family:Khmer; color:black">
                        ទទួលពីឈ្មោះ 
                        <?php
                            echo $v_student_name_kh;
                        ?>
                        ជាឡាតាំង ៈ
                        <?php
                            echo $v_student_name_en;
                        ?>
                    </p>
                    <p style="font-family:Khmer; color:black">
                        ទូរស័ព្ទ ៈ
                        <?php
                            echo $v_student_phone;
                        ?>
                    </p>
        </div>
        <div class="column"></div>
        <div class="column">
                    
                    <p style="font-family:Khmer; color:black">
                        ថ្ងៃខែឆ្នាំបង់ប្រាក់ :
                        <?php
                            if($v_pay_date=="0000-00-00"){
                                echo '';
                            }else{
                                echo date('d-M-Y',strtotime($v_pay_date));
                            }
                        ?>
                    </p>
                    <p style="font-family:Khmer; color:black">
                        ផ្សេងៗ :
                        <?php
                            echo $v_pay_note;
                        ?>
                    </p>
                    <p style="font-family:Khmer; color:black">
                        ត្រូវបង់បន្ត នៅថ្ងៃ:
                        <?php
                            if($v_date_alert=="0000-00-00"){
                                echo '';
                            }else{
                                echo date('d-M-Y',strtotime($v_date_alert));
                            }
                        ?>
                    </p>
        </div>
    </div>
    <div class="row ">
        <table>
            <thead>
                <tr>
                    <th style="background-color:#D3D3D3; text-align:center; width:2px; font-family:Khmer; ">លរ</th>
                    <th style="background-color:#D3D3D3; text-align:center; font-family:Khmer; ">បរិយាយ</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:3px ; font-family:Khmer; ">ចំនួន</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:9% ; font-family:Khmer; ">តម្លៃ</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:15% ; font-family:Khmer; ">សរុប</th>
                    <th style="background-color:#D3D3D3; text-align:center; width:26% ; font-family:Khmer; ">ផ្សេងៗ</th>
                </tr>
            </thead>
            <tbody>
                        <?php       
                                $id = $_GET["edit_id"];   
                                $sql_sub = "SELECT * FROM payment_detail
                                                    LEFT JOIN  item ON  item.ite_id=payment_detail.payd_item_id
                                                    WHERE payd_payment_id ='$id'
                                                                ";
                                $result_sub = mysqli_query($connect, $sql_sub);
                                                                
                                $i= 1;
                                $v_amount_total =0;
                                while($row_sub = $result_sub->fetch_assoc()) 
                                {		
                                    $v_amount_total +=$row_sub['payd_amount'];

                                    $v_item_id =$row_sub['payd_item_id'];
                                    $v_item_name =$row_sub['ite_name'];
                                    $v_qty =$row_sub['payd_qty'];
                                    $v_price =$row_sub['payd_price'];
                                    $v_amount =$row_sub['payd_amount'];
                                    $v_note =$row_sub['payd_note'];
                        ?>
                <tr>
                    <td> <?php echo $i++;?> </td>
                    <td style="font-family:Khmer; color:black"> 
                        <?php echo $v_item_name;?>
                    </td>
                    <td> <?php echo $v_qty;?> </td>
                    <td> <?php echo $v_price;?> </td>
                    <td>$ <?php echo $v_amount;?> </td>
                    <td> <?php echo $v_note;?> </td>
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

                    <td style="text-align:right">
                        <span >
                            <b> Sub_Total: </b> 
                        </span>
                        
                    </td>
                    <td>$
                        <span style="color:black">
                            <b> 
                                <?php
                                    $v_amount_total_show =number_format($v_amount_total,2);
                                    echo $v_amount_total_show;
                                ?>
                            </b> 
                        </span>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">
                        <span >
                            <b> Discount: </b> 
                        </span>
                        
                    </td>
                    <td>$
                        <span style="color:black">
                            <b> 
                                <?php
                                    $v_discount_show =number_format($v_discount,2);
                                    echo $v_discount_show;
                                ?>
                            </b> 
                        </span>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">
                        <span >
                            <b> Payment: </b> 
                        </span>
                        
                    </td>
                    <td>$
                        <span style="color:black">
                            <b> 
                                <?php
                                    $v_final_pay =$v_amount_total-$v_discount;
                                    $v_final_pay_show =number_format($v_final_pay,2);
                                    echo $v_final_pay_show;
                                ?>
                            </b> 
                        </span>
                    </td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="row">
        <div class="column">
                     
        </div>
        <div class="column"></div>
        <div class="column">
                    <p style="font-family:Khmer; color:black">
                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 ហត្ថលេខាអ្នកទទួល
                    </p>
                    <p style="font-family:Khmer; color:black">
                        <br><br>
                        ឈ្មោះ _____________________
                    </p>
        </div>
    </div>
    
</body>
</html>