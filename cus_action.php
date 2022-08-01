<?php
    include 'config/db_connect.php';
    if(isset($_POST['btnadd'])){
        $no = $_POST['no'];
        $date = $_POST['date'];
        $cus_name = $_POST['cus_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $note = $_POST['note'];

        $sql = "INSERT INTO customer (no, date, cus_name, phone, email, note) VALUES ('$no','$date','$cus_name', '$phone', '$email', '$note')";
            $result = mysqli_query($connect, $sql);
            if($result){
                header('location: sale.php');
            }
            else
                echo "ERROR";
            }
    else if(isset($_POST['btnupdate'])){
        $no = $_POST['no'];
        $date = $_POST['date'];
        $cus_name = $_POST['cus_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $note = $_POST['note'];
        
        $sql = "UPDATE product SET 
                                   date = '$date',
                                   cus_name = '$cus_name',
                                   phone = '$phone',
                                   email = '$email',
                                   note = '$note'
                               WHERE no = '$no'";
        $result = mysqli_query($connect, $sql);
        if($result){
            header('location: customer.php');
        }else{
            echo "ERORR";
        }
    }
//else if(isset($_GET["id"])){
//     $id = $_GET["id"];
//
//     $sql = "DELETE FROM product WHERE pro_id = '$id'";
//     $result = mysqli_query($connect, $sql);
//     if ($result) {
//        header("location:product.php?message=delete");
//     }
//} 
?>