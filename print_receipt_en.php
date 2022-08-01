<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo</title>
</head>
<style>
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
    .textcenter{
        text-align: center;
    }
    .foo
    {
        padding-right: 50px;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php include 'config/db_connect.php'; ?>
<body style="width: 793.700787px;height:1122.519685px ;">

<?php
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

    $id = $_GET["edit_id"]; 
    $today = date('Y-m-d');
    $sql = "SELECT * FROM payment
                        LEFT JOIN student ON student.stu_id=payment.pay_student_id
                        LEFT JOIN course ON course.co_id=payment.pay_course_id
                        LEFT JOIN time_learn ON time_learn.ti_id=course.co_time
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

    $v_course = $row['co_name'];
    $v_time = $row['ti_name'];

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
        <img height="220px" src="img/<?= $row_img['in_banner']; ?>">
    
    </div>
    <div class="textcenter">
        <br>
        <h3 style="font-family:Khmer; color:black">
                    វិ័ក័យប័ត្រ
                    <br> INVOICE
        </h3>
        
    </div>
    

    
    
    <main style="font-size: 15px; margin-left: 60px; margin-right: 40px;">
        <div style="display: flex; width: 800px; flex-direction: row-reverse; ">
            <input style="width: 80px;height:28px" type="text" value="<?php echo $v_card_id; ?>">
            <label style="margin-right: 20px;">St/Inv No:</label>

        </div>
        <div style=" margin-top: 20px; margin-bottom: 20px; display: flex; justify-content: space-between; width: 800px;height:120px ">
            <div>
                <div style="margin-bottom: 2px; ">
                    <label style="font-family:Khmer OS Battambang ; width:100px; height:18px" for="fname ">សិស្សឈ្មោះ</label>
                    <input style="font-family:Khmer OS Battambang ; width:250px; height:28px" type="text " id="fname " name="fname " value="<?php echo $v_student_name_kh; ?>" >
                </div>
                <div style="margin-bottom: 2px; ">
        
                    <label style="font-family:Khmer OS Battambang ; width:100px; height:18px" for="fname ">Name:</label>
                    <input style="font-family:Khmer OS Battambang ; width:250px; height:28px" type="text " id="fname " name="fname " value="<?php echo $v_student_name_en; ?>" >
                </div>
                <div style="margin-bottom: 2px; ">
        
                    <label style="font-family:Khmer OS Battambang ; width:100px; height:18px" for="fname ">Course:</label>
                    <input style="font-family:Khmer OS Battambang ; width:250px; height:28px" type="text " id="fname " name="fname " value="<?php echo $v_course; ?>" >
                </div>
                <div style="margin-bottom: 2px; ">
        
                    <label style="font-family:Khmer OS Battambang ; width:100px; height:18px" for="fname ">Time:</label>
                    <input style="font-family:Khmer OS Battambang ; width:250px; height:28px" type="text " id="fname " name="fname " value="<?php echo $v_time; ?>" >
                </div>
                <div style="margin-bottom: 2px; ">
        
                    <label style="font-family:Khmer OS Battambang ; width:100px; height:18px" for="fname ">Phone: </label>
                    <input style="font-family:Khmer OS Battambang ; width:250px; height:28px" type="text " id="fname " name="fname " value="<?php echo $v_student_phone; ?>" >
                </div>
        
            </div>
            <div>
                <div style="margin-bottom: 2px; margin-left: 0px">
                    <label for="fname " style=" margin-right: 5px ">Payment Date:</label>
                    <input style="width: 250px;height:28px " type="text " id="fname " name="fname " value="<?php echo $v_pay_date; ?>" >
                </div>
                <div style="margin-bottom: 2px; ">
                    <label for="fname " style="margin-right: 5px; ">Next Payment:</label>
                    <input style="width: 250px;height:28px " type="text " id="fname " name="fname " value="<?php echo $v_date_alert; ?>" >
                </div>
                <div style="margin-bottom: 2px; ">
                    <label for="fname " style="margin-right: 55px; ">Noted:</label>
                    <input style="width: 250px;height:28px " type="text " id="fname " name="fname " value="<?php echo $v_pay_note; ?>" >
                </div>
            </div>

        </div>
        <br>
        

        <table>
            <br>
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

        <div>

        </div>
        <div style="display: flex;flex-direction: row-reverse ; margin-right: 100px;margin-top: 20px">
            <p>
                Receive Payment by
            </p>
        </div>
        <div style="display: flex;flex-direction: row-reverse ; margin-right: 100px;margin-top: 20px">
            <p>
                _ _ _ _ _ _ _ _ _ _ _
            </p>
        </div>

    </main>

    

    
</body>
</html>