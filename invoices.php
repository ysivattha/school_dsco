<?php include 'config/db_connect.php';
  	
	$v_current_date = date('Y-m-d');
	$sql = "SELECT *,SUM((od_amount*od_price)*od_discount/100) AS s_discount FROM invoice A 
				LEFT JOIN customer B ON A.cus=B.no 
				LEFT JOIN tbl_table AS C ON C.t_id=A.inv_table
				LEFT JOIN tbl_order_detail AS D ON D.od_invoice_id=A.inv_no
				WHERE A.date_sell='$v_current_date'
				GROUP BY A.inv_no ORDER by A.inv_no DESC  ";	
	$result = $connect->query($sql);

	if(isset($_POST['search'])){
		$from = $_POST['from'];
		$to = $_POST['to'];
	 	$sql = "SELECT *,SUM((od_amount*od_price)*od_discount/100) AS s_discount FROM invoice A 
		 					LEFT JOIN customer B ON A.cus=B.no 
		 					LEFT JOIN tbl_table AS C ON C.t_id=A.inv_table
		 					LEFT JOIN tbl_order_detail AS D ON D.od_invoice_id=A.inv_no
		 					WHERE A.date_sell >= '$from' AND A.date_sell <='$to' GROUP BY A.inv_no ORDER by A.inv_no DESC ";	
		
		$result = $connect->query($sql);
		
	}

	$v = "SELECT * FROM vat";
	$rev = $connect->query($v);
	$a = $rev->fetch_assoc();
	$pun = $a['vat'];

    if(isset($_GET["id"])){
    	$inv = $_GET["inv"];
		$id = $_GET["id"];
			
		$sql = "DELETE FROM invoice WHERE transaction_id = '$id'" ;
		$result = mysqli_query($connect, $sql);
		if($result){
			$de_inv = "DELETE FROM tbl_order_detail WHERE od_invoice_id = '$inv'";
			$result_inv = mysqli_query($connect, $de_inv);
		}
		header("location:invoices.php?message=delete");
}	
?>
<?php include 'header.php';?>
	<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                         <h3 class="text-primary">Re-Print Invoice</h3>
                         <hr> 

                <form class="form-inline" method = "post" action="">
		              <div class="form-group">
		                <label>From:</label>
		                <input type="date" class="form-control" name = "from" value="<?= @$_POST['from'] ?>">
		              </div>
		              <div class="form-group">
		                <label>To:</label>
		                <input type="date" class="form-control" name = "to" value="<?= @$_POST['to'] ?>"> 
		              </div>
		              <button type="submit" name="search" class="btn btn-success">Search</button>
		              
		              <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Clear</a>
                </form> 

                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>No</th>
                                            <th>#Invoice</th>
                                            <th>Table</th>
                                            <th>Date</th>
                                            <th>Cashier Name</th>
                                            <th>Sub Total</th>
                                            <th>Vat</th>
                                            <th>Discount</th>
                                            <th>Total</th>
                                           
                                            <th class="text-center">Detail</th>
                                            <th class="text-center">Re-print</th>
											<th class="text-center">Action</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total=0;
                                        $i=1;
                                         $total_amount = 0;
                                            $total_vat = 0;
                                            $total_discount = 0;
                                            $total_grandtotal = 0;
											while($row = $result->fetch_assoc()) 
											{			
												$v1=$row["transaction_id"];
												$v2=$i;
												$v7=$row['date_sell'];
												$v3=$row["cashier_name"];
												$v_sub_total = $row["amount"]-$row["amount"]*$row["vat"]/100;
												$v_total=$row["amount"]-$row["s_discount"];
												$v_vat=$row["amount"]*$row["vat"]/100;
												$s_discount = $row["s_discount"];
												
												$total_amount += $v_sub_total;
		                                        $total_vat += $v_vat;
		                                        $total_discount += $s_discount;
		                                        $total_grandtotal += $v_total;
												
										?>
										<tr>
											<td><?php echo $v2;?></td>
										    <td><?= sprintf('%08d',$row['inv_no']) ?></td>
											<td><?= $row['t_name'] ?></td>
											<td><?php echo $v7;?>
												<a href="edit_invoices_date.php?id=<?php echo $row['transaction_id']; ?>">
	                                               <i class="fa fa-pencil"></i>
	                                            </a>
											</td>
											<td><?php echo $v3;?></td>
											<td>$ <?php echo number_format($v_sub_total,2) ?></td>
											<td>$ <?php echo number_format($v_vat,2) ?></td>
											<td>$ <?= number_format($s_discount,2) ?></td>
											<td>$ <?php echo number_format($v_total,2) ;?></td>
											<td class="text-center"><a target="_blank" href="detail_invoice.php?id=<?php echo $row['inv_no']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>
											<td class="text-center"><a href = "print_80.php?invoice=<?php echo $row['inv_no'];?>" class = "btn btn-success btn-xs"><i class="fa fa-print" aria-hidden="true"></i></a>
											
											</td>
											<?php
											if ($show['position_id'] == 1)
											{
											?>
											<td class="text-center">
											<a onclick = "return confirm('Are you sure to delete ?');" href="invoices.php?id=<?php echo $row['transaction_id']; ?>&inv=<?php echo $row['inv_no']?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
											</td>
											<?php
											}else{
											?>
											<td>
											<a onclick = "return confirm('Are you sure to delete ?');" href="invoices.php?id=<?php echo $row['transaction_id']; ?>" class="btn btn-danger disabled btn-xs"><i class="fa fa-trash"></i></a>
											<?php
											}
											?>
											</td>
										</tr> 
										<?php
                                           $i++;
											}	 
										?>
										
										
												
											
						    			
                                    </tbody>
                                   	<tfoot>
                                   		<th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Total:</th>
                                        <th>$ <?= number_format($total_amount,2) ?></th> 
										<th>$ <?= number_format($total_vat,2) ?></th> 
										<th>$ <?= number_format($total_discount,2) ?></th>
										<th>$ <?= number_format($total_grandtotal,2) ?></th> 
                                        <th></th>
										<th></th>
										<th></th>
                                   	</tfoot>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>