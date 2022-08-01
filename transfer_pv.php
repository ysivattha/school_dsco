<?php include 'config/db_connect.php';

$errors = "";
$user_id = $_SESSION['user_id'];
	$sql = "SELECT * FROM transfer_pv AS A 
						LEFT JOIN user AS U ON U.id=A.tranpv_to_id
						LEFT JOIN transferyn AS TYN ON TYN.tyn_id=A.tranpv_approved
						ORDER BY tranpv_id DESC
										";
	$result = $connect->query($sql);

	$sql1 = "SELECT full_name FROM transfer_pv AS A 
						LEFT JOIN user AS U ON U.id=A.tranpv_from_id
										";
	$result1 = $connect->query($sql1);
	
	if(isset($_GET["id"])){
		$id = $_GET["id"];

		$sql = "DELETE FROM transfer_pv WHERE tranpv_id = '$id'";
		$result = mysqli_query($connect, $sql);
		if(result){
			header("location:transfer_pv.php?message=delete");
		}
		
	}

?>
<style>
	.pright{
		text-align: right !important;
	}
</style>
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
							<div class="pright">		
							</div>
							<h3 class = "text-primary"><i class="fa fa-list" aria-hidden="true"></i> PV Sent to</h3>
							<a href="add_transfer_pv.php" class = "btn btn-primary btn-sm"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</a>
                         
						</div>
						
							  <!-- Modal -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
											<th>No</th>
                                            <th>
												Date
											</th>
											<th>
												From (ID)
											</th>
											<th>
												To (ID)
											</th>
											
											<th>
												Amount
											</th>
											<th>
												Apprroved
											</th>
											<th>
												Note
											</th>
											<th>Action</th>
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
												$total+= $row["tranpv_amount"];   

												$v_date =$row["tranpv_datetime"];
												$v_from_id =$row["tranpv_from_id"];
												$v_to_id =$row["tranpv_to_id"];												
												$v_to_id_name =$row["full_name"];
												$v_amount =$row["tranpv_amount"];
												$v_apporoved =$row["tyn_name"];
												$v_note =$row["tranpv_note"];
										
										?>
										
											<tr>
												<td><?php echo $i++;?></td>
												<td>
													<?php echo $v_date;?>
												</td>
												<td>
													(<?php echo $v_from_id; ?>)
												</td>
												<td>
													(<?php echo $v_to_id; ?>)
												</td>
												<td>
														<span class="text-danger">
															 $ <?php echo $v_amount;?>
														</span>
												</td>
												<td>
														<?php
															if($row["tyn_name"] == "Waiting"){
														?>
															<?php echo $v_apporoved;?> 
															<b><span class="text-primary"> Approved</span> </b>
															
														<?php
															}else{
														?>
															<?php echo $v_apporoved;?>
														<?php
															}
														?>
													
												</td>
												<td>
														<?php echo $v_note;?>
												</td>
												<td align="center">
													<?php
														if($row["tyn_name"] == "Waiting"){
													?>
														<a onclick = "return confirm('Are you sure to delete ?');" href="transfer_pv.php?id=<?php echo $row['tranpv_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
									
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>
