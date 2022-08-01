<?php include 'config/db_connect.php';

$errors = "";
	$sql = "SELECT * FROM invoice AS A 
						LEFT JOIN product AS PRO ON PRO.pro_id=A.inv_product
						LEFT JOIN user AS U ON U.id=A.inv_member
						LEFT JOIN paidyn AS PA ON PA.paid_id=A.inv_paid
										";
	$result = $connect->query($sql);

	
    if(isset($_GET["id"])){
		$id = $_GET["id"];

		$sql = "DELETE FROM invoice WHERE inv_id = '$id'";
		$result = mysqli_query($connect, $sql);
		if(result){
			header("location:invoice.php?message=delete");
		}
		
}
?>
<?php include 'header.php';?>
	<div class="row">
		<div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Add Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Update Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Delete Data</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
							<h3 class = "text-primary"><i class="fa fa-list" aria-hidden="true"></i> Invoice</h3>
							<hr>
                            <a href="add_invoice.php" class="btn btn-primary"><i class="fa fa-plus-square-o"></i> Add New</a>
						</div>
						
							  <!-- Modal -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Member</th>
                                            <th>Product</th>
											<th>Amount</th>
											<th>Paid</th>
											<th>Note</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i = 1;
											$total=0;
											while($row = $result->fetch_assoc())
											{
												$total+= $row["inv_amount"];   

												$v_date =$row["inv_date"];
												$v_member =$row["full_name"];
												$v_member_id =$row["inv_member"];
												$v_product =$row["name_en"];
												$v_product_code =$row["code"];
												$v_amount =$row["inv_amount"];
												$v_paid =$row["paid_name"];
												$v_note =$row["inv_note"];

										?>
										<tr>
											<td><?php echo $i++;?></td>
											<td><?php echo $v_date;?></td>
											<td>
												<?php echo $v_member; ?>(<?php echo $v_member_id; ?>)
											</td>
											<td>
												<?php echo $v_product; ?>(<?php echo $v_product_code; ?>)
											</td>
											<td>
												$ <?php echo $v_amount;?>
											</td>
											<td>
												<?php
													if($row["paid_name"] == "Waiting"){
												?>
													<?php echo $v_paid;?> 
													<a href="approved_invoice.php?id=<?php echo $row['inv_id']; ?>" class="btn btn-success"> Approved</a>
													
															
													
												<?php
													}else{
												?>
													<?php echo $v_paid;?>
												<?php
													}
												?>
												
											</td>
											<td><?php echo $v_note;?></td>
											<td align="center">
												<?php
													if($row["paid_name"] == "Waiting"){
												?>
													<a href="edit_invoice.php?id=<?php echo $row['inv_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
													<a onclick = "return confirm('Are you sure to delete ?');" href="invoice.php?id=<?php echo $row['inv_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
												<?php
													}
												?>

											</td>
										</tr>
										<?php
											}
										?>
                                    </tbody>
									<tfood>
										<tr>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th>Total: $
												<?php
													echo "$total";
												?>
											</th>                    
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</tfood>
									
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>
