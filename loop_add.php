<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');


	if(isset($_POST["btnadd"])){
		$v_name = $_POST["txt_name"];
		$v_note = $_POST["txt_note"];
	
		
		$sql = "INSERT INTO a_tbl (a_name)
				SELECT a_name 
				FROM a_tbl
				WHERE a_group=1
		 					";
		 $result = mysqli_query($connect, $sql);
		 header('location:loop_add.php?message=success');
	}

?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
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
            <div class="panel panel-default">
                	<div class="panel-body"><h2 class="text-primary">Add Car</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-12">
		                            <label for ="">Name:</label>                                          
		                       		<input class="form-control" name="txt_name" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Name:</label>                                          
		                       		<input class="form-control" name="txt_name" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" >
		                        </div>
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="car.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
		<div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$sql = "SELECT * FROM a_tbl";	
											$result = $connect->query($sql);
											while($row = $result->fetch_assoc())
											{	
												$v_id=$row["a_id"];		
												$v_name=$row["a_name"];	
										?>
										<tr>
											<td><?php echo $v_id;?></td>
											<td><?php echo $v_name;?></td>
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

<?php include 'footer.php';?>
