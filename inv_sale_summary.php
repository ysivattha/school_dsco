<?php include 'config/db_connect.php';
 
$from = ""; 
$to = "";
	//$sql = "SELECT *,SUM(amount) as sum_amount FROM invoice A LEFT JOIN customer B ON A.cus=B.no GROUP BY A.date_sell ORDER BY A.date_sell DESC";
	// $result = $connect->query($sql);
	 if(isset($_POST['search'])){
		$from = $_POST['from'];
		$to = $_POST['to'];
		 $sql = "SELECT *,SUM(amount) as sum_amount,SUM(amount*vat/100) as sum_vat FROM invoice A 
		 					LEFT JOIN customer B ON A.cus=B.no 
		 					WHERE A.date_sell between '$from' AND '$to' 
		 					GROUP BY A.date_sell ORDER BY A.date_sell DESC";	
		
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
                         	  <h3 class="text-primary">Invoice Sale Summary</h3>
                     <hr>
                   <form class="form-inline" method = "post" action="">
                      <div class="form-group">
                        <label>From:</label>
                        <input type="date" value="<?= @$_POST['from'] ?>" class="form-control" name = "from" value="<?= @$_POST['from'] ?>">
                      </div>
                      <div class="form-group">
                        <label>To:</label>
                        <input type="date" value="<?= @$_POST['to'] ?>" class="form-control" name = "to" value="<?= @$_POST['to'] ?>"> 
                      </div>
                      <button type="submit" name="search" class="btn btn-success">Search</button>
                      <a href="inv_sale_summary.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                  </form> 
                        </div>
                        <div id="order_table">
	                        <div class="panel-body">
	                            <div class="table-responsive">
	                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
	                                
	                                    <thead> 
	                                        <tr>
	                                            <th>No</th>
	                                            <th>Date</th>
	                                            <th>Discount</th>
	                                            <th>Total</th>
	                                            <th>VAT</th>
	                                            <th>Cost</th>
	                                            <th>Revenue</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                        <?php
                                            $total=0;
                                            $i=1;
                                            $total_amount = 0;
                                            $total_sum_vat = 0;
                                            $total_discount = 0;
                                            $total_sub_total = 0;
                                            
                                            $total_cost = 0;
                                            $total_revenue = 0;
												while(@$row = mysqli_fetch_assoc(@$result)) 
												{			
													$v1=$row["transaction_id"];
													$v2=$row["inv_no"];
													$v7=$row['date_sell'];
													$v3=$row["cashier_name"];
													$v4=$row["cus_name"];
													$v5=$row['sum_amount'];
													$v6=$row["vat"]*$v5/100;
													
											?>
											<tr>
											    <td><?php echo $i?></td>
												<td><?php echo $v7;?></td>
												<td>$
													<?php 
														$get_discount = $connect->query("SELECT SUM((A.od_amount*A.od_price)*A.od_discount/100) AS s_discount from tbl_order_detail AS A RIGHT JOIN invoice AS I ON I.inv_no=A.od_invoice_id WHERE I.date_sell ='$v7'");
														$row_get_discount = mysqli_fetch_object($get_discount);
														$v_discount = $row_get_discount->s_discount;
														echo number_format($v_discount,2);
													?>
												</td>
												<td><?php echo number_format($row['sum_amount']-$v_discount,2);?></td>
												<td><?php echo number_format($row['sum_vat'],2);?></td>
												<td>$
													<?php 
														$get_cost = $connect->query("SELECT * from tbl_order_detail AS A RIGHT JOIN invoice AS I ON I.inv_no=A.od_invoice_id LEFT JOIN tbl_item_menu AS P ON P.im_name=A.od_product_name WHERE I.date_sell ='$v7'");
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
													 	$v_revenue = $v5-$v_discount-$v6-$v_cost;
													 	echo number_format($v_revenue,2);
													 	$total_revenue += $v_revenue;
													 ?>
												</td>
											</tr> 
											<?php
												$total_amount += $row['sum_amount']-$v_discount;
	                                            $total_sum_vat += $row['sum_vat'];
	                                            $total_sub_total += $row['sum_amount']-$row['sum_vat'];
                                                $i++; 
												}	 
											?>	
											<tfoot>
											<tr>
											<th></th>
											<th>Total :</th> 
											<th>$ <?= number_format($total_discount,2) ?></th>
											<th>$ <?= number_format($total_amount,2) ?></th>
											<th>$ <?= number_format($total_sum_vat,2) ?></th>
											<th>$ <?= number_format($total_cost,2) ?></th>
											<th>$ <?= number_format($total_revenue,2) ?></th>
							    			</tr>
							    		</tfoot>
	                                    </tbody>
	                                    
									</table>
	                            </div>	                             
	                          </div>
	                           
	                        </div>
                        
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>