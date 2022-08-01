<?php include'config/db_connect.php';


//$join = "SELE * FROM invoice INNER JOIN customer ON cus = cus_name";
//$result = mysqli_query($connect, $join);

$invoice = "";
if(isset($_GET["invoice"])){
		$invoice = $_GET["invoice"];
		$sql = "SELECT * from  invoice A INNER JOIN customer B ON A.cus = B.no where inv_no = '$invoice'";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);
        $pay_dollar=$row['pay_dollar'];
        $pay_riel=$row['pay_riel'];
        
	}	
	$ex = "SELECT * FROM exchange";
	$reex = $connect->query($ex);
	$do = $reex->fetch_assoc();
	$do_luy = $do['exchange'];

	$v = "SELECT * FROM vat";
	$rev = $connect->query($v);
	$a = $rev->fetch_assoc();
	$pun = $a['vat'];
 
	$ci = "SELECT * FROM con_invoice";
	$rci = $connect->query($ci);
	$c = $rci->fetch_assoc();
    
?>
<?php 
	$cc_id = @$_GET['cc_id'];
	$get_dt_amount = $connect->query("SELECT * FROM tbl_type_daily_amount AS A LEFT JOIN user AS C ON A.tda_employee=C.id LEFT JOIN position AS P ON P.position_id=C.position_id WHERE tda_id = '$cc_id' ");
	$row_cc = mysqli_fetch_object($get_dt_amount);
?>
<?php 
	$get_money_detail = $connect->query("SELECT * FROM tbl_money_letter WHERE 	ml_dailly_money_id='$cc_id'");
	$row_money_detail = mysqli_fetch_object($get_money_detail);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="prints/paper.css">
	<meta http-equiv="refresh" content = "1; URL=cash_count.php">
	<link rel="stylesheet" href="print_offline/bootstrap.min.css">
	<script src="print_offline/jquery.min.js"></script>
	<script src="print_offline/bootstrap.min.js"></script>
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
	<div class = "paper">
		<div class = "row">
			<div class = "col-md-4">
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
							របាយការណ៍រាប់ប្រាក់ 
						</h5>
					</div>
				</div>
				<hr>
				<div class = "" id = "content">
					<center>
						<h5>តារាងសាច់ប្រាក់</h5>
					</center>
					
					<div class = "row">
						<div class="col-xs-6">
							<div class = "col-xs-12">
								<b>ថ្ងៃខែឆ្នាំ : </b><?= $row_cc->tda_date ?>
							</div>
							<div class = "col-xs-12">
								<b><?= $row_cc->tda_option ?> : </b><?= $row_cc->tda_sheet ?>
							</div>
						</div>
						<div class="col-xs-6">
							<div class = "col-xs-12">
								<b>ឈ្មោះបុគ្គលិក : </b><div class="pull-right"><?= $row_cc->username ?></div>
							</div>
							
							<div class = "col-xs-12">
								<b>តួនាទី : </b><div class="pull-right"><?= $row_cc->position ?></div>
							</div>
						</div>
					</div>
					<hr>
					<center>
						<p>ចំនួនទឹកប្រាក់</p>
					</center>
					<div class = "row">
						<div class="col-xs-6">
							<div class = "col-xs-12">
								<b>លុយដុល្លារ : </b>$ <?= number_format($row_money_detail->ml_dollar_total,0) ?>​
							</div>
							<div class = "col-xs-12">
								<b>លុយខ្មែរ : </b><?= $row_money_detail->ml_riel_total ?> ៛
							</div>
						</div>
						<div class="col-xs-6">
							<div class = "col-xs-12">
								<b>ប្ដូរទៅដុល្លារ : </b><div class="pull-right"> $<?= number_format($row_money_detail->ml_riel_convert_to_dollar,0) ?></div>
							</div>
							
							<div class = "col-xs-12">
								<b>សរុបរួម : </b><div class="pull-right">$ <?= number_format($row_money_detail->ml_grand_total,0) ?></div>
							</div>
						</div>
					</div>
					<hr>
					<center>
						<p>ក្រដាស់ប្រាក់</p>
					</center>
					<div class = "row">
						<div class = "col-sm-12">
						<table class="table table-responsive">
					    <tbody>
					    	
					    	<?php 
					    		echo '<tr>
							        <th class="text-center">ក្រដាស់ប្រាក់ដុល្លា៖</th>
							        <th class="text-center">ចំនួន</th>
							        <th class="text-center">សរុប</th>
							      </tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>100 Dollar</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_dollar_100.'</td>';
					    				echo '<td class="text-right">$ '.@number_format($row_money_detail->ml_dollar_100*100).'</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>50 Dollar</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_dollar_50.'</td>';
					    				echo '<td class="text-right">$ '.@number_format($row_money_detail->ml_dollar_50*50).'</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>20 Dollar</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_dollar_20.'</td>';
					    				echo '<td class="text-right">$ '.@number_format($row_money_detail->ml_dollar_20*20).'</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>10 Dollar</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_dollar_10.'</td>';
					    				echo '<td class="text-right">$ '.@number_format($row_money_detail->ml_dollar_10*10).'</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>5 Dollar</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_dollar_5.'</td>';
					    				echo '<td class="text-right">$ '.@number_format($row_money_detail->ml_dollar_5*5).'</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>2 Dollar</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_dollar_2.'</td>';
					    				echo '<td class="text-right">$ '.@number_format($row_money_detail->ml_dollar_2*2).'</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>1 Dollar</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_dollar_1.'</td>';
					    				echo '<td class="text-right">$ '.@number_format($row_money_detail->ml_dollar_1*1).'</td>';
					    			echo '</tr>';
									echo '<tr>';
					    				echo '<td class="text-right" colspan="3"><strong>Total Dollar : $ '.number_format($row_money_detail->ml_dollar_total,0).'</strong></td>';
					    			echo '</tr>';
					    	




					    		echo '<tr><td colspan="3" class="text-center"><strong>&nbsp;</strong></td></tr>';
					    		echo '<tr>
							        <th class="text-center">ក្រដាស់ប្រាក់រៀល៖</th>
							        <th class="text-center">ចំនួន</th>
							        <th class="text-center">សរុប</th>
							      </tr>';

					    		
					    			echo '<tr>';
					    				echo '<td>10 0000 RIEL</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_riel_100000.'</td>';
					    				echo '<td class="text-right">'.@number_format($row_money_detail->ml_riel_100000*100000).'  ៛</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>5 0000 RIEL</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_riel_50000.'</td>';
					    				echo '<td class="text-right">'.@number_format($row_money_detail->ml_riel_50000*50000).'  ៛</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>2 0000 RIEL</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_riel_20000.'</td>';
					    				echo '<td class="text-right">'.@number_format($row_money_detail->ml_riel_20000*20000).'  ៛</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>1 0000 RIEL</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_riel_10000.'</td>';
					    				echo '<td class="text-right">'.@number_format($row_money_detail->ml_riel_10000*10000).'  ៛</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>5000 RIEL</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_riel_5000.'</td>';
					    				echo '<td class="text-right">'.@number_format($row_money_detail->ml_riel_5000*5000).'  ៛</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>2000 RIEL</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_riel_2000.'</td>';
					    				echo '<td class="text-right">'.@number_format($row_money_detail->ml_riel_2000*2000).'  ៛</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>1000 RIEL</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_riel_1000.'</td>';
					    				echo '<td class="text-right">'.@number_format($row_money_detail->ml_riel_1000*1000).'  ៛</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>500 RIEL</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_riel_500.'</td>';
					    				echo '<td class="text-right">'.@number_format($row_money_detail->ml_riel_500*500).'  ៛</td>';
					    			echo '</tr>';
					    		
					    			echo '<tr>';
					    				echo '<td>100 RIEL</td>';
					    				echo '<td class="text-center">'.@$row_money_detail->ml_riel_100.'</td>';
					    				echo '<td class="text-right">'.@number_format($row_money_detail->ml_riel_100*100).'  ៛</td>';
					    			echo '</tr>';
									
									echo '<tr>';
					    				echo '<td class="text-right" colspan="3"><strong>Total Riel : '.number_format($row_money_detail->ml_riel_total,0).' ៛</strong></td>';
					    			echo '</tr>';
					    		
					    	

					    	?>
					    </tbody>
						<tbody>
					    	
					  </table>
					 </div>
					</div>
					<div style="margin-right: 10px; width: 35%; height: 50px; border-bottom: 1px dotted #444; float: right;">
						<p class="text-center" style="transform: translate(0px,60px);">ហត្ថលេខា</p>
					</div>
					<div class="clearfix"></div>
				</div>
				</div>
		</div>
			
		</div>
		<script type="text/javascript">
			setTimeout(function(){
				window.close();
			},100);
		</script>
</body>
</html>


