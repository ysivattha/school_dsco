<?php include 'config/db_connect.php';

$errors = "";
	$sql = "SELECT * FROM transfer AS A 
						LEFT JOIN user AS U ON U.id=A.tran_to_id
						LEFT JOIN transferyn AS TYN ON TYN.tyn_id=A.tran_approved
										";
	$result = $connect->query($sql);

	$sql1 = "SELECT full_name FROM transfer AS A 
						LEFT JOIN user AS U ON U.id=A.tran_from_id
										";
	$result1 = $connect->query($sql1);
	
	if(isset($_GET["id"])){
		$id = $_GET["id"];

		$sql = "DELETE FROM transfer WHERE tran_id = '$id'";
		$result = mysqli_query($connect, $sql);
		if(result){
			header("location:transfer.php?message=delete");
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
							<h3 class = "text-primary"><i class="fa fa-list" aria-hidden="true"></i> Transfer</h3>
							<hr>
                            <a href="add_transfer.php" class="btn btn-primary"><i class="fa fa-plus-square-o"></i> Add New</a>
						</div>
						
							  <!-- Modal -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date Time</th>
                                            <th>Sender</th>
                                            <th>Receiver</th>
											<th>Amount</th>
											<th>Approved</th>
											<th>Note</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											// show name from id
											while($row1 = $result1->fetch_assoc())
											{
												$v_from_id_name =$row1["full_name"];
										
										?>
                                        <?php
											$i = 1;
											$total=0;
											while($row = $result->fetch_assoc())
											{
												$total+= $row["tran_amount"];   

												$v_date =$row["tran_datetime"];
												$v_from_id =$row["tran_from_id"];
												$v_to_id =$row["tran_to_id"];												
												$v_to_id_name =$row["full_name"];
												$v_amount =$row["tran_amount"];
												$v_apporoved =$row["tyn_name"];
												$v_note =$row["tran_note"];
										
										?>
										
											<tr>
												<td><?php echo $i++;?></td>
												<td><?php echo $v_date;?></td>
												<td>
													<?php echo $v_from_id_name; ?>(<?php echo $v_from_id; ?>)
												</td>
												<td>
													<?php echo $v_to_id_name; ?>(<?php echo $v_to_id; ?>)
												</td>
												<td>
													$ <?php echo $v_amount;?>
												</td>
												<td>
													<?php
														if($row["tyn_name"] == "Waiting"){
													?>
														<?php echo $v_apporoved;?> 
														<a href="approved_transfer.php?id=<?php echo $row['tran_id']; ?>" class="btn btn-success"> Approved</a>
														
													<?php
														}else{
													?>
														<?php echo $v_apporoved;?>
													<?php
														}
													?>
													
												</td>
												<td><?php echo $v_note;?></td>
												<td align="center">
													<?php
														if($row["tyn_name"] == "Waiting"){
													?>
														<a onclick = "return confirm('Are you sure to delete ?');" href="transfer.php?id=<?php echo $row['tran_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
													<?php
														}
													?>

												</td>
											</tr>
										<?php
											}
										?>
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
