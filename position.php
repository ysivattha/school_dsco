<?php include 'config/db_connect.php';

$errors = ""; 
	$sql = "SELECT * FROM position";	
	$result = $connect->query($sql);
	
	if(isset($_POST["btnadd"])){
		$v_name = $_POST["txtname"];
		$v_note = $_POST["txtnote"];
		
		$sql = "INSERT INTO employeetype 
		 						(etname
								 ,etnote
								 ) 
		 					VALUES 
		 						('$v_name'
								 ,'$v_note'
								 )";
		 $result = mysqli_query($connect, $sql);
		 header('location:employeetype.php?message=success');
		 
 }
    if(isset($_GET["id"])){
		$id = $_GET["id"];
			
		$sql = "DELETE FROM employeetype WHERE etid = '$id'";
		$result = mysqli_query($connect, $sql);
		header("location:employeetype.php?message=delete");	
}	
?>
<?php include 'header.php';?>
	<div class="row">
		<div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add Position</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update Position</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete Position</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                       
                        	<div class="panel-body"><h2 class="text-primary">Position</h2>
			                	<hr>
			                
                    <!--        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New </button>
					-->		  <!-- Modal -->
							  <div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
									</div>
									<div class="modal-body">
										<div class="col-md-12">
												<form method="post" enctype="multipart/form-data" action="">     
													<div class="form-group col-xs-12">
														<label for ="">Type:</label>                                          
													  	<input class="form-control" required name="txtname" type="text" placeholder="type...">  
													</div>     
													<div class="form-group col-xs-12">
														<label for ="">Note:</label>                                          
													  	<input class="form-control" name="txtnote" type="text" placeholder="note...">  
													</div>              
													<div class="form-group col-xs-12">
														<button type="submit" name = "btnadd" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Save changes</button>
														<button type="reset" class="btn btn-default">Reset</button>
													</div> 
												</form>
										</div>
									</div>
									<div class="modal-footer">
									  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
									</div>
								  </div>
								</div>
							  </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type</th>
											<th>Note</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											while($row = $result->fetch_assoc())
											{	
												$v_id=$row["position_id"];		
												$v_name=$row["position"];	
												$v_note=$row["note"];	
										?>
										<tr>
											<td><?php echo $v_id;?></td>
											<td><?php echo $v_name;?></td>
											<td><?php echo $v_note;?></td>
											<td align = "center">
									<!--		<a href="edit_employeetype.php?id=<?php echo $row['position_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
											<a onclick = "return confirm('Are you sure to delete ?');" href="employeetype.php?id=<?php echo $row['position_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
									-->		</td>
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