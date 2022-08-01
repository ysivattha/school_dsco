<?php include 'config/db_connect.php';
 
$from = "";
$to = "";
	$sql = "SELECT * FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id ";
	$result = $connect->query($sql);
	 if(isset($_POST['search'])){
		$from = $_POST['from'];
		$to = $_POST['to'];
		 $sql = "SELECT * FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id  WHERE A.date_in between '$from' AND '$to'";	
		
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
                         	  <h3 class="text-primary">Expense By Daterange Search</h3>
                     <hr>
                   <form class="form-inline" method = "post" action="">
                      <div class="form-group">
                        <label for="email">From:</label>
                        <input type="text" class="form-control" id="datepicker" name = "from">
                      </div>
                      <div class="form-group">
                        <label for="pwd">To:</label>
                        <input type="text" class="form-control" id="datepicker1" name = "to"> 
                      </div>
                      <button type="submit" name="search" class="btn btn-success">Filter</button>
                     
                  </form> 
                        </div>
                        <div id="order_table">
	                        <div class="panel-body">
	                            <div class="table-responsive">
	                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
	                                
	                                    <thead>
	                                        <tr>
	                                        <th>Date</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Qauntity</th>
                                            <th>Packet</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Pay Amount</th>
                                            <th>Rest</th>
                                            <th>Expire Date</th>
                                            <th>Note</th>
                                            <th>Vender</th>
                                            <th>Employee</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                        <?php
                                            $total=0;
												while($row = $result->fetch_assoc()) 
												{			
													$v1=$row["date_in"];
                                              $v2=$row["code_in"];
                                              $v3=$row["name_kh"];
                                              $v4=$row["qty_in"];
                                              $v13=$row["paket"];
                                              $v5=$row["price"];
                                              $v6=$row["amount"];
                                              $v7=$row["payamount"];
                                              $v8=$row["rest_amount"];
                                              $v9=$row["expire_date"];
                                              $v10=$row["note_in"];
                                              $v11=$row["vendername_en"];
                                              $v12=$row["name_khmer"];
															
													
											?>
											<tr>
											    <td><?php echo $v1;?></td> 
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v13;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>
                                            <td><?php echo $v8;?></td>
                                            <td><?php echo $v9;?></td>
                                            <td><?php echo $v10;?></td>
                                            <td><?php echo $v11;?></td>
                                            <td><?php echo $v12;?></td>
								
												
											</tr> 
											<?php
                                                  
												}	 
											?>
								 </tbody>
                                        	
								<tfoot>	<tr>
											<th></th>
                                            <th></th>
                                            <th></th>
                                             <th></th>
                                            <th>Sum Total:</th>
                                            <th>
                                                 <?php $sum = "SELECT sum(price) FROM stockin WHERE date_in between '$from' AND '$to'";
											$result1 = $connect->query($sum);
											for($i=0; $row1 = $result1->fetch_assoc(); $i++){
											$subtotal=$row1['sum(price)'];
											echo  $subtotal. ' $ ';
											}?>
                                            </th>
                                           
                                            <th>
                                               <?php $sum = "SELECT sum(amount) FROM stockin WHERE date_in between '$from' AND '$to'";
											$result1 = $connect->query($sum);
											for($i=0; $row1 = $result1->fetch_assoc(); $i++){
											$subtotal=$row1['sum(amount)'];
											echo  $subtotal.'$';
											}?> 
                                            </th>
                                           
                                            <th>
                                                <?php $sum = "SELECT sum(payamount) FROM stockin WHERE date_in between '$from' AND '$to'";
											$result1 = $connect->query($sum);
											for($i=0; $row1 = $result1->fetch_assoc(); $i++){
											$subtotal=$row1['sum(payamount)'];
											echo  $subtotal.'$';
											}?> 
                                            </th>
                                            <th>
                                                <?php $sum = "SELECT sum(rest_amount) FROM stockin WHERE date_in between '$from' AND '$to'";
											$result1 = $connect->query($sum);
											for($i=0; $row1 = $result1->fetch_assoc(); $i++){
											$subtotal=$row1['sum(rest_amount)'];
											echo  $subtotal.'$';
											}?> 
                                            </th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
											<th></th> 
							    				   
							    			
							    			</tr>
	                                   
	                               </tfoot>
									</table>
	                            </div>	                             
	                          </div>
	                           
	                        </div>
                        
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>