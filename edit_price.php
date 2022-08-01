<?php
	include 'config/db_connect.php';

	$transaction_id = $_POST['id'];
	$invoice = $_POST['invoice'];
	$cash = $_POST['cash'];
	$q2 = $_POST['qty'];
	$pro= $_POST['code'];
	$new_price = $_POST['newprice'];
	$discount = $_POST['dis'];

	
	$qty = "";

	$product = "SELECT * FROM stockout WHERE code_out = '$pro' AND invoice = '$invoice'";
	$repro = $connect->query($product);
	       
		  		while($row = $repro->fetch_assoc()) 
		                                            {     
		            $code_out = $row["code_out"];
		            $qty = $row["qty_out"];
		            $price = $row["price"];
		            $inv_out = $row["invoice"];
		            
	}
	$discount1 = $discount / 100;
	$dis = $new_price * $discount1 * $qty;
	$amount = $new_price * $qty;
	$amount1 = $amount - $dis; 

	$balance = "UPDATE stockout SET price =  '$new_price' , 
					amount = '$amount1' ,
					discount = '$dis'
						WHERE 
					code_out = '$pro' AND invoice = '$invoice'";
	mysqli_query($connect, $balance); 
	header("location:sale.php?cash=$cash&invoice=$invoice");
	
	
	
						
 ?>