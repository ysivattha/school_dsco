<?php include'config/db_connect.php';
 
$invoice = "";
if(isset($_GET["invoice"])){
	$invoice = $_GET["invoice"];
	$sql = "SELECT A.*,B.cus_name from  invoice AS A LEFT JOIN customer AS B ON B.no=A.cus where inv_no = '$invoice'";
	$result = mysqli_query($connect, $sql);
	$row = mysqli_fetch_array($result);
    $total_amount=$row['amount'];
    $pay_dollar=$row['pay_dollar'];
    $pay_riel=$row['pay_riel'];
    $do_luy = $row['exchange_rate'];
    $pun = $row['vat'];
    $discount = $row['discount'];
}
$ci = "SELECT * FROM con_invoice";
$rci = $connect->query($ci);
$c = $rci->fetch_assoc();
    
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content = "1; URL=table_order.php">
	<link rel="stylesheet" href="print_offline/bootstrap.min.css">
	<script src="print_offline/jquery.min.js"></script>
	<style type="text/css">
		*{ font-family: 'khmer os content'; font-size: 10px!important; }
		@media print {
            .table thead tr th{
                -webkit-print-color-adjust: exact;
                background: #222 !important;
                color: #fff !important;
            }
            .table tfoot tr td.bg{
                -webkit-print-color-adjust: exact;
                background: #444 !important;
                color: #fff !important;
            }
            .table *{ padding-bottom: 2px!important; padding-top: 2px!important; }

        }
	</style>
</head>
<body onload="window.print();">
	<div class="container">
		<div class="row">
			<div id="content">
				<div class="col-xs-4 text-center">
					<img src="img/<?php echo $c['logo']?>" alt="">
				</div>	
				<div class="col-xs-8 text-center" style="padding-left: 0px;">
					<p><?php echo $c['shop_name'] ?></p>
				</div>	
				<hr>
				<div class="text-center">
					<h5 style="font-family: 'Khmer OS Muol Light'">
						បង្កាន់ដៃបង់ប្រាក់ / RECEIPT
					</h5>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6" style="padding-right: 0px;">លេខបង្កាន់ដៃ / Receipt No</div>
			<div class="col-xs-6">: <?= sprintf('%08d',$row['inv_no']) ?></div>
		</div>
		<div class="row">
			<div class="col-xs-6" style="padding-right: 0px;">អ្នកគិតលុយ / Cashier</div>
			<div class="col-xs-6">: <?= $row ['cashier_name'] ?></div>
		</div>
		<div class="row">
			<div class="col-xs-6" style="padding-right: 0px;">កាលបរិច្ឆេទ / Date</div>
			<div class="col-xs-6">: <?= $row['date_sell'] ?></div>
		</div>
		<div class="row">
			<div class="col-xs-6" style="padding-right: 0px;">លេខរៀងរង់ចាំ / Waitting No</div>
			<div class="col-xs-6">: <?= sprintf('%03d',$row['waitting_no']) ?></div>
		</div>

	</div><br>
	<div class="container-fliud">
		<table class="table table-hover table-responsive">
			<thead>
		      	<tr">
		        	<th class="text-center">បរិយាយ<br>Description</th>
		        	<th class="text-center">ចំនួន<br>QTY</th>
		        	<th class="text-center">តម្លៃ<br>Price</th>
		        	<th class="text-center">ចុះថ្លៃ<br>Discount</th>
		        	<th class="text-center">សរុប<br>AMN</th>
		      </tr>
		    </thead>
			<tbody>
		    	<?php
		    		$item = "SELECT *,SUM(A.od_amount) as sum_qty FROM tbl_order_detail AS A LEFT JOIN tbl_item_menu AS B ON B.im_id=A.od_product_id 
		    		WHERE od_invoice_id!='0' AND od_invoice_id='$invoice' 
		    		GROUP BY A.od_product_id,A.od_discount
		    		ORDER BY A.od_id ASC";
		    		$reitem = mysqli_query($connect , $item);
		    		$i = 1;
		    		$sum_discount = 0;
		    		$v_sum_by_item = 0;
		    		while($row1 = $reitem->fetch_assoc()) 
                	{   
	                	$items = $row1['od_product_name'].' : '.$row1['im_name_kh'];
	                	$qty = $row1['sum_qty']; 
	                	$price = $row1['od_price'];
	                	$discount = $row1['od_discount'];
                		$sum_discount += ($qty*$price)*$discount/100;
	                	$amount = $qty*$price-(($qty*$price)*$discount/100);			    	
                		$v_sum_by_item += $amount;
	                ?>
		      		<tr>
				      <td><?= $items; ?></td>
				      <td class="text-center"><?= $qty; ?></td>
				      <td class="text-center"><?= currency_auto($price); ?></td>
				      <td class="text-center"><?= number_format((float)$discount,0); ?>%</td>
				      <td class="text-right"><?= currency_auto($amount) ;?></td>
			      	</tr>
		      	<?php
		      		$i++;
		   		}
		   		$total_amount = $v_sum_by_item;
		       	?>
		    </tbody>
		    <tfoot>
		    	<tr style="display: none;">
			      	<td colspan="3" style="text-align:right"><b>Sub Total ($) :</b></td>
			      	<td colspan="2" class="text-right">
			      	<?php
						$v_sub_total=$total_amount-$total_amount*$pun/100;
						echo  '$ ' . number_format($v_sub_total,2);
					?>
			      	</td>
		    	</tr>
		    	<tr>
	              	<td colspan="3" style="text-align:right"><b>VAT (<?= $pun ?>%) :</b></td>
	              	<td colspan="2" class="text-right">
	              		<?php $v_vat=$total_amount*$pun/100; ?>
	              		$ <?= number_format($v_vat,2) ?>
	              	</td>
	            </tr>
				<tr>
	              	<td colspan="3" style="text-align:right"><b>Discount ($) :</b></td>
	              	<td colspan="2" class="text-right">
	              		$ <?= number_format((float)$sum_discount,2) ?>
	              	</td>
	            </tr>
				<tr>
			      	<td colspan="3" style="text-align:right"><b>Total ($) :</b></td>
			      	<td colspan="2" class="text-right">
			      		<?php
							$subtotal=$v_sub_total+$v_vat-$sum_discount;
							echo  ' $ ' . number_format($subtotal,2);
						?>
			      	</td>
		    	</tr>
		    	<tr>	      
			      	<td colspan="3" style="text-align:right"><b>សរុបជារៀល (៛) :</b></td>
			      	<td colspan="2" class="text-right">
			      		<?php
							$riel = $subtotal * $do_luy;
							echo number_format($riel,0). ' ៛';
						?>
			      	</td>
		    	</tr>
		    </tfoot>
		</table>
	</div>	
	<center> <?= $c['shop_note'] ?> </center>
</body>
</html> 
<?php 
  function currency_auto($m){
    GLOBAL $do_luy;
    GLOBAL $v_sale_kh;
    if($v_sale_kh!=1)
      return number_format($m,2);
    else
      return number_format(($m*$do_luy));
  }
?>


