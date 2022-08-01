<?php include'config/db_connect.php';

?>
<?php 
	$v_os_id = @$_GET['os_id'];
	$get_data = $connect->query("SELECT B.username,A.*,DATE_FORMAT(os_open_sesstion_date,'%H:%i:%s') as start_time,DATE_FORMAT(os_close_sesstion_date,'%H:%i:%s') as end_time FROM tbl_order_session AS A LEFT JOIN user AS B ON B.id=A.os_staff_name WHERE os_id='$v_os_id'");
	$row_session_data = mysqli_fetch_object($get_data);
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content = "1; URL=index.php">
	<link rel="stylesheet" href="print_offline/bootstrap.min.css">
	<style type="text/css">
		*{ font-family: 'khmer os content'; font-size: 11px; }
		td,th{ padding: 0px!important; }
		p{ margin-top: 0px!important; margin-bottom: 0px!important; }
	</style>
</head>
<body onload="window.print();">
	<div class="container">
		<br>
		<p class="text-center">
		    <h4 class="text-center">Sale Summary<h4>
		</p>
		<br>
		<p class="text-center">Session Time : <strong><?= $row_session_data->start_time ?></strong> - <strong><?= $row_session_data->end_time ?></strong></p>
		<p class="text-center">on Date : <strong><?= $row_session_data->os_session_date ?></strong></p>
		<p class="text-center">closed by : <strong><?= $row_session_data->username ?></strong></p>
		<br>
		<!-- <table class="table table-hover">
			<thead>
				<tr>
					<th>Item Sale Summary</th>
					<th class="text-center">Qty </th>
					<th class="text-right"> Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$data_start = $row_session_data->os_open_sesstion_date;
					$data_end = $row_session_data->os_close_sesstion_date;
					$get_sale_data = $connect->query("SELECT od_product_name,SUM(od_amount) as s_qty,SUM(od_price*od_amount) as s_amount FROM tbl_order_detail WHERE od_submit_date_time BETWEEN '$data_start' AND '$data_end' 
						GROUP BY od_product_name
						ORDER BY s_qty DESC
						");
					$v_sum_qty = 0;
					$v_sub_total = 0;
					while ($row_sale = mysqli_fetch_object($get_sale_data)) {
						$v_sum_qty += $row_sale->s_qty;
						$v_sub_total += $row_sale->s_amount;
						echo '<tr>';
							echo '<td>'.$row_sale->od_product_name.'</td>';
							echo '<th class="text-center">'.number_format($row_sale->s_qty,0).'</th>';
							echo '<th class="text-right">'.number_format($row_sale->s_amount,2).'</th>';
						echo '</tr>';
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td class="text-right">Sub Total : </td>
					<th class="text-center"><?= number_format($v_sum_qty,0) ?></th>
					<th class="text-right">$ <?= number_format($v_sub_total,2) ?></th>
				</tr>
			</tfoot>
		</table> -->
		<!-- <br> -->
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Item Discount Summary</th>
					<th class="text-left">Dis</th>
					<th class="text-center">Qty</th>
					<th class="text-right"> Amount</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$data_start = $row_session_data->os_open_sesstion_date;
					$data_end = $row_session_data->os_close_sesstion_date;
					$get_sale_data = $connect->query("SELECT B.discount,A.od_product_name,SUM(A.od_amount) as s_qty,SUM(A.od_price*A.od_amount) as s_amount FROM tbl_order_detail AS A INNER JOIN invoice AS B ON B.inv_no=A.od_invoice_id WHERE A.od_submit_date_time BETWEEN '$data_start' AND '$data_end' 
						GROUP BY A.od_product_name,B.discount
						ORDER BY B.discount DESC
						");
					$v_sum_qty = 0;
					$v_sub_total = 0;
					while ($row_sale = mysqli_fetch_object($get_sale_data)) {
						$v_sum_qty += $row_sale->s_qty;
						$v_sub_total += $row_sale->s_amount-($row_sale->s_amount*$row_sale->discount/100);
						echo '<tr>';
							echo '<td>'.$row_sale->od_product_name.'</td>';
							echo '<th class="text-left">'.$row_sale->discount.'%</th>';
							echo '<th class="text-center">'.number_format($row_sale->s_qty,0).'</th>';
							echo '<th class="text-right">'.number_format($row_sale->s_amount-($row_sale->s_amount*$row_sale->discount/100),2).'</th>';
						echo '</tr>';
					}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2" class="text-right">Sub Total : </td>
					<th class="text-center"><?= number_format($v_sum_qty,0) ?></th>
					<th class="text-right">$ <?= number_format($v_sub_total,2) ?></th>
				</tr>
			</tfoot>
		</table>
	</div><br>
</body>
</html>


