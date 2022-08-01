<?php include'config/db_connect.php';

if(isset($_GET["id"])){
		$inv = $_GET["id"];
		$sql = "SELECT * from tbl_order_detail where od_invoice_id = '$inv' ";
		$result = mysqli_query($connect, $sql);		
	}
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Invoice Detail</li>
      </ol>
	<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a href="invoices.php" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-undo" aria-hidden="true"></i>Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th class="text-center">Quantity</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Discount</th>
                                            <th class="text-center">Amount</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $v_total = 0;					
                                            while($row = $result->fetch_assoc()) 
                                            {                   
                                                $v_amount =  $row['od_price']*$row['od_amount']-(($row['od_price']*$row['od_amount'])*$row['od_discount']/100);              
                                                $v_total += $v_amount;
										?>
										<tr>
											<td><?= sprintf('%08d',$row['od_invoice_id']) ?></td>
											<td><?= $row['od_submit_date_time'] ?></td>
											<td><?= $row['od_product_name'] ?></td>
											<th class="text-center"><?= number_format($row['od_amount'],0) ?></th>
                                            <th class="text-center"><?= number_format($row['od_price'],2) ?></th>
											<th class="text-center"><?= number_format($row['od_discount'],0) ?> %</th>
											<th class="text-center"><?= number_format($v_amount,2) ?></th>				
										</tr> 
										<?php
											}	 
										?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th class="text-right">Total:</th>
                                            <th class="text-center">$ <?= number_format($v_total,2) ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>