<?php include 'config/db_connect.php'; 
	$sql = "SELECT * FROM vender";	
	$result = $connect->query($sql);
	
	
    if(isset($_GET["id"])){
		$id = $_GET["id"];
			
		$sql = "DELETE FROM vender WHERE vender_id = '$id'" ;
		$result = mysqli_query($connect, $sql);
		header("location:vender.php?message=delete");	
}	
?>
<?php include 'header.php';?>
	<div class="row">
		<div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add vender</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update vender</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete vender</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <h3 class="text-primary">Supplier List</h3>
							<a href="vendor_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
				  
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>No</th>
                                            <th>Name_KH</th>
                                            <th>Name_EN</th>
                                            <th>Phone</th>
                                            <th>Address</th>
											<th>Note</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{			
												// $v1=$row["vender_id"];
												
												$v3=$row["vendername_kh"];
												$v4=$row["vendername_en"];
												$v5=$row["phone"];
												$v6=$row["address"];
												$v7=$row["note"];
										?>
										<tr>
											<!-- <td><?php //echo $v1;?></td> -->
											<td><?php echo $i++;?></td>
											<td><?php echo $v3;?></td>
											<td><?php echo $v4;?></td>
											<td><?php echo $v5;?></td>
											<td><?php echo $v6;?></td>
											<td><?php echo $v7;?></td>
											<td>
											<a href="edit_vender.php?id=<?php echo $row['vender_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a onclick = "return confirm('Are you sure to delete ?');" href="vender.php?id=<?php echo $row['vender_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
											</td>
										</tr> 
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