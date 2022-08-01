<?php include'config/db_connect.php';

$invoice = "";
if(isset($_GET["invoice"])){
		$invoice = $_GET["invoice"];
		$sql = "SELECT * from  invoice where inv_no = '$invoice'";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	$ex = "SELECT * FROM exchange";
	$reex = $connect->query($ex);
	$do = $reex->fetch_assoc();
	$do_luy = $do['exchange'];

	$v = "SELECT * FROM vat";
	$rev = $connect->query($v);
	$a = $rev->fetch_assoc();
	$pun = $a['vat'];

$select = "SELECT * FROM invoice Order by transaction_id desc";
  $query_select = $connect->query($select);
  $sel = $query_select->fetch_array();
  $tt = $query_select->num_rows;
  $no = $sel['transaction_id'];
  $no1 = $sel['inv_no'];
  $finalcode = '';

  if($tt > 0 ){
     $finalcode = $no1 + 1;
  }
  else{
     $finalcode = $no + 1;
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
 	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="prints/paper.css">
	<link rel="stylesheet" href="print_offline/bootstrap.min.css">
	<script src="print_offline/jquery.min.js"></script>
	<script src="print_offline/bootstrap.min.js"></script>
	 <link rel="stylesheet" href="Font-Awesome-master/css/font-awesome.min.css">

	<!--<script>
		window.print();
	</script>-->
</head>
<body>
</br>
	<div class = "container">
		</br>
		<div class = "row">
			<div class = "col-md-4 col-md-offset-4">
				<div class = "paper" id = "content">
					<img src="img/4inv.png" class = "img-responsive" />
					<center><img src="img/inv1.png"></center>
					<div class = "row">
						<div class="col-xs-12">
							<div class = "col-xs-12">
								<b>លេខវិក័យបត្រ័ :</b> <?php echo $row['transaction_id']?>
							</div>
							<div class = "col-xs-12">
								<b>អតិថិជន :</b><?php echo $row['cus']?>
							</div>
							<div class = "col-xs-12">
								<b>ថ្ងែខែឆ្នាំ :</b><?php echo $row['date_sell']?>
							</div>
							<!-- <div class = "col-xs-12">
								<b>បានបង់ :</b> <?php
										$p = $row['pay']; 
										if( $p == 1){
											echo 'មិនទាន់';
										}
										else{
											echo 'បង់រួច';
										}
								?>
							</div> -->
							<div class = "col-xs-12">
								<b>អ្នកលក់ :</b> <?php echo $row ['cashier_name']?>
							</div>
						</div>
					</div>
					</br>
					<div class = "row">
						<div class = "col-xs-12">
						<table class="table table-responsive">
					    <thead>
					      <tr>
					        <th>No</th>
					        <th>Item(S)</th>
					        <th>Qty</th>
					        <th>price</th>
					        <th>amount</th>
					        <th>discount</th>
					      </tr>
					    </thead>
					    <tbody>
					    	<?php
					    		$item = "SELECT * FROM stockout WHERE invoice = '$invoice'";
					    		$reitem = mysqli_query($connect , $item);
					    		$i = 1;
					    		while($row1 = $reitem->fetch_assoc()) 
                            {   
                            	$items = $row1['pro_nameen'];
                            	$qty = $row1['qty_out']; 
                            	$price = $row1['price'];
                            	$amount = $row1['amount'];
                            	$discount = $row1['discount'];
					    	?>
					      <tr>
						      <td><?php echo $i; ?></td>
						      <td><?php echo $items;?></td>
						      <td><?php echo $qty;?></td>
						      <td>$ <?php echo $price;?></td>
						      <td>$ <?php echo $amount;?></td>
						      <td>$ <?php echo $discount;?></td>
					      </tr>
					      <?php
					      $i++;
					   		}
					       ?>
					    </tbody>
					    <tbody>
					    	<tr>
					    	  <td></td>
					    	   <td></td>
						      <td></td>
						      <td></td>
						      <td><b>សរុប:</b></td>
						      <td><?php
						      	$sum= "SELECT sum(amount) FROM stockout WHERE invoice = '$invoice'";
								$result2 = $connect->query($sum);
								for($i=0; $row1 = $result2->fetch_assoc(); $i++){
								$subtotal=$row1['sum(amount)'];
								$riel = $subtotal * $do_luy;
								echo $riel. ' ៛ ';
								}
								?>
						      </td>
					    	</tr>
					    </tbody>
					      <tbody>
					    	<tr>
					    	  <td></td>
					    	  <td></td>
						      <td></td>
						      <td></td>
						      <td><b>Discount:</b></td>
						      <td><?php
						      	$sum= "SELECT sum(discount) FROM stockout WHERE invoice = '$invoice'";
								$result2 = $connect->query($sum);
								for($i=0; $row1 = $result2->fetch_assoc(); $i++){
								$dis=$row1['sum(discount)'];
								echo ' $ ' . $dis ;
								}
								?>
						      </td>
					    	</tr>
					    </tbody>
					   <!--  <tbody>
					    	<tr>
					    	  <td></td>
					    	  <td></td>
						      <td></td>
						      <td></td>
						      <td><b>VAT:</b></td>
						      <td><?php
						  //     	$sum= "SELECT sum(amount) FROM stockout WHERE invoice = '$invoice'";
								// $result1 = $connect->query($sum);
								// for($i=0; $row1 = $result1->fetch_assoc(); $i++){
								// $subtotal=$row1['sum(amount)'];
								// $vattotal = $subtotal * $pun;
								// echo $vattotal. ' $ ';
								//}
								?>
						      </td>
					    	</tr>
					    </tbody> -->
					    <tfoot>
					    	<tr>
					    	  <td></td>
						      <td></td>
						      <td></td>
						      <td></td>
						      <td><b>Total:</b></td>
						      <td>
						      	<?php
								$sum= "SELECT sum(amount) FROM stockout WHERE invoice = '$invoice'";
								$result1 = $connect->query($sum);
								for($i=0; $row1 = $result1->fetch_assoc(); $i++){
								$subtotal=$row1['sum(amount)'];
								echo  ' $ ' . $subtotal;
								}
								?>
						      </td>
					    	</tr>
					    </tfoot>
					  </table>
					  </div>
					</div>
					<div class = "row">
						<div class = "col-xs-12​ col-xs-offset-1" style = "margin-bottom:20px;">
							<u>បញ្ជាក់</u>
							<li>ទំនិញដែលទិញហើយមិនអាចដូរវិញបានទេ​ ។</li>
							<li >សូមពិនិត្យទំនិញ និង តំលៃ មុនពេលចាកចេញ ។</li>
						</div>
					</div>
				</div>
				</div>
		</div>
		<div class = "row">
			<div class = "col-md-4 col-md-offset-4">
			<a href = "print_80.php?invoice=<?php echo $invoice?>" class = "btn btn-primary btn-block"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
			
			<a href = "sale.php?cash=cash&invoice=<?php echo $finalcode?>" class = "btn btn-danger btn-block"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
			</div>
			</br>
			</br>
			</br>
			
		</div>		
	</div>		
</body>
 --></html>


