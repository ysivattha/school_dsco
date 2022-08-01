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
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="prints/paper.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--   	<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=250px, height=auto,"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 250px; font-size: 10px; font-family: arial;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script> -->
</head>
<body onload="window.print();">
	
	<div class = "container">
		<div class = "row">
			<div class = "col-md-4">
				<div class = "papera5" id = "content">
					<img src="img/invbw.png" class = "img-responsive" />
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
					        <th>Items</th>
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
					    <tbody>
					    	<tr>
					    	  <td></td>
					    	  <td></td>
						      <td></td>
						      <td></td>
						      <td><b>VAT:</b></td>
						      <td><?php
						      	$sum= "SELECT sum(amount) FROM stockout WHERE invoice = '$invoice'";
								$result1 = $connect->query($sum);
								for($i=0; $row1 = $result1->fetch_assoc(); $i++){
								$subtotal=$row1['sum(amount)'];
								$vattotal = $subtotal * $pun;
								echo $vattotal. ' $ ';
								}
								?>
						      </td>
					    	</tr>
					    </tbody>
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
			
		</div>
		<!-- <a href="javascript:Clickheretoprint()" style="font-size:20px;"><button class="btn btn-success"><i class="icon-print"></i> Print</button></a> -->
			
</body>
</html>


