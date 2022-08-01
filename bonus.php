<?php include 'config/db_connect.php';

$errors = "";
	$sql = "SELECT * FROM bonus AS A 
						LEFT JOIN user AS U ON U.id=A.b_receiver
						LEFT JOIN receivedyn AS RE ON RE.re_id=A.b_received
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
							<h3 class = "text-primary"><i class="fa fa-list" aria-hidden="true"></i> Bonus</h3>
							<hr>
                        </div>
							  <!-- Modal -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date Time</th>
                                            <th>Sender(ID)</th>
                                            <th>Receiver</th>
											<th>Amount</th>
											<th>Confirm</th>
											<th>Description</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i = 1;
											$total=0;
											while($row = $result->fetch_assoc())
											{
												$total+= $row["b_amount"];   

												$v_datetime =$row["b_datetime"];
												$v_sender =$row["b_sender"];
												$v_full_name =$row["full_name"];
												$v_full_name_id =$row["b_receiver"];
												$v_amount =$row["b_amount"];
												$v_received =$row["re_name"];
												$v_description =$row["b_description"];

										?>
										<tr>
											<td><?php echo $i++;?></td>
											<td><?php echo $v_datetime;?></td>
											<td>
												<?php echo $v_sender; ?>
											</td>
											<td>
												<?php echo $v_full_name; ?>(<?php echo $v_full_name_id; ?>)
											</td>
											<td>
												$ <?php echo $v_amount;?>
											</td>
											<td>
												
												<?php
													if($v_received == "Waiting"){
												?>
													<?php echo $v_received;?> 
													<a href="approved_bonus.php?id=<?php echo $row['b_id']; ?>" class="btn btn-success"> Received</a>
																												
													
												<?php
													}else{
												?>
													<?php echo $v_received;?>
												<?php
													}
												?>
											</td>
											<td><?php echo $v_description;?></td>
											<td align="center">
											
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
