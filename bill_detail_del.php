<?php include 'config/db_connect.php';

    if(isset($_GET["id"])){
     $id = $_GET["id"];
     $bill_id = $_GET["bill_id"];

     $sql = "DELETE FROM bill_item WHERE bit_id = '$id'";
     $result = mysqli_query($connect, $sql);
     $row = mysqli_fetch_array($result);	
    }
    header("location:bill_detail.php?id=$bill_id");
?>

