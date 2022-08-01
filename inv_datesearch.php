<?php include 'config/db_connect.php';
 
$from = "";
$to = ""; 
	$v_current_date = date('Y-m-d');
	$sql = "SELECT *,SUM((od_amount*od_price)*od_discount/100) AS s_discount FROM invoice A 
		LEFT JOIN customer B ON A.cus=B.no 
		LEFT JOIN tbl_table AS C ON C.t_id=A.inv_table
		LEFT JOIN tbl_order_detail AS D ON D.od_invoice_id=A.inv_no
		WHERE A.date_sell ='$v_current_date'
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
	
	
	
?>
<?php include 'header.php';?>
		<div class="row">
		 
                <div style="clear:both"></div>  
                </br>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                         	  <h3 class="text-primary">Sale Invoice by Date</h3>
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
                      
                      <a href="inv_datesearch.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Clear</a>
                  </form> 
                        </div>
                        <div id="order_table">
	                        <div class="panel-body">
	                            <div class="table-responsive">
	                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
	                                
	                                    <thead>
	                                        <tr>
	                                            <!-- <th>ID</th> -->
	                                            <th>No</th>
	                                            <th>Invoice #</th>
	                                            <th>Table</th>
	                                            <th>Date</th>
	                                            <th>Cashier Name</th>
	                                            <th>Discount</th>
	                                            <th>Total</th>
	                                            <th>Vat</th>
	                                            <th>Cost</th>
	                                            <th>Revenue</th>
	                                            <th>Detail</th>
	                                            <?php
	                                            if ($show['position_id'] == 1)
												{
												?>
												<th><i class="fa fa-cog" aria-hidden="true"></i></th>
												<?php
												}
												?>
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
                                            $total_cost = 0;
                                            $total_revenue = 0;
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
												<td><?php echo $v7;?></td>
												<td><?php echo $v3;?></td>
												<td>$ <?= number_format($s_discount,2) ?></td>
												<td>$ <?php echo number_format($v_total,2) ;?></td>
												<td>$ <?php echo number_format($v_vat,2) ?></td>
												<td>$
													<?php 
														$get_cost = $connect->query("SELECT * from tbl_order_detail AS A LEFT JOIN tbl_item_menu AS P ON P.im_name=A.od_product_name where od_invoice_id = '$v2'");
														$v_cost = 0;
														while($row_get_cost = mysqli_fetch_object($get_cost)){
															$v_cost += $row_get_cost->im_cost*$row_get_cost->od_amount;
														}
														echo number_format($v_cost,2);
														$total_cost += $v_cost;
													?>
												</td>
												<td>$
													 <?php
													 	$v_revenue = $v_total-$v_vat-$v_cost;
													 	echo number_format($v_revenue,2);
													 	$total_revenue += $v_revenue;
													 ?>
												</td>
												<td class="text-center"><a target="_blank" href="detail_invoice.php?id=<?php echo $row['inv_no']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>
												<?php
												if ($show['position_id'] == 1)
												{
												?>
												<td class="text-center">
												<a onclick = "return confirm('Are you sure to delete ?');" href="invoices.php?id=<?php echo $row['transaction_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
												</td>
												<?php
												}
												?>
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
											<th>Total : </th>
											<th>$ <?= number_format($total_discount,2) ?></th>
											<th>$ <?= number_format($total_grandtotal,2) ?></th> 
											<th>$ <?= number_format($total_vat,2) ?></th> 
											<th>$ <?= number_format($total_cost,2) ?></th>
											<th>$ <?= number_format($total_revenue,2) ?></th>
	                                        <th></th>
	                                        <th></th>
	                                           
	                                    </tfoot>
	                                    
									</table>
	                            </div>	                             
	                          </div>
	                           
	                        </div>
                        
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>