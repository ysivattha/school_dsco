<?php include 'config/db_connect.php';

$errors = "";

	$id = $_GET["id"];
	$sql = "SELECT * FROM user AS A 
				LEFT JOIN position AS B ON A.position_id = B.position_id
				WHERE id=$id
							";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$user = $_POST["user"];
		$pass = $_POST["pass"];
		$pos = $_POST["pos"];

		 $sql = "INSERT INTO user
		 						(username, password ,position_id)
		 					VALUES
		 						('$user', md5('$pass'), '$pos')";
		 $result = mysqli_query($connect, $sql);
		 if($result){
			header('location:user_user.php?message=success');
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
                      echo '<h4>Success Add Data.</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Update Data.</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Delete Data.</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
							<h3 class = "text-primary"><i class="fa fa-user-circle-o" aria-hidden="true"></i> User Management</h3>
							<hr>
                        </div>
							  <!-- Modal -->
							  <div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New</h4>
									</div>
									<div class="modal-body">
										<form class="form-horizontal" method="post" enctype="multipart/form-data" action="" data-toggle="validator" role="form">
												  <div class="form-group">
												    <label class="control-label col-sm-3" for="email">Username:</label>
												    <div class="col-sm-9">
												      	<input class="form-control" id="inputName" required name="user" type="text" placeholder="username">
												    </div>
												  </div>
												  <div class="form-group">
												    <label class="control-label col-sm-3" for="pwd">Password:</label>
												    <div class="col-sm-9"> 
												      <input class="form-control" data-minlength="6" id="inputPassword" required name="pass" type="password" placeholder="password">
												      <div class="help-block">Note : Minimum of 6 characters</div>
												    </div>
												  </div>
												  <div class="form-group">
												    <label class="control-label col-sm-3" for="pwd">Confirm Password:</label>
												    <div class="col-sm-9"> 
												      <input class="form-control" required  type="password" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Sorry, These don't match" placeholder="Confirm" required>
												      <div class="help-block with-errors"></div>
												    </div>
												  </div>
												  <div class="form-group">
												    <label class="control-label col-sm-3" for="pwd">Position:</label>
												    <div class="col-sm-9"> 
												      <select class = "form-control" name = "pos" id="inputName" required>
							                              <option value="">Select Positon</option>
							                                  <?php
							                                    $position = mysqli_query($connect,"SELECT * FROM position");
							                                    while ($row1 = mysqli_fetch_assoc($position)) { ?>
							                                    <option value="<?php echo $row1['position_id']; ?>"><?php echo $row1['position']; ?></option>
							                                  <?php 
							                                  }
							                                   ?>   
							                            </select>
												    </div>
												  </div>
												  <div class="form-group"> 
												    <div class="col-sm-offset-3 col-sm-9">
												      <button type="submit" name = "btnadd" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Save</button>
												      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												    </div>
												  </div>
											</form>
									</div>
									<div class="modal-footer">
									  
									</div>
								  </div>
								</div>
							  </div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Position</th>
											<th>Full Name</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i = 1;
											while($row = $result->fetch_assoc())
											{
												
												$v_user_id =$row["id"];
												$v_username =$row["username"];
												$v_password =$row["password"];
												$v_position =$row["position"];
												$v_fullname =$row["full_name"];

										?>
										<tr>
											<td><?php echo $i++;?></td>
											<td><?php echo $v_username;?></td>
											<td><?php echo "*****";?>
												<a href="edit_user_password_user.php?id=<?php echo $row['id']; ?>" ><i class="fa fa-edit"></i></a>
											</td>
											<td><?php echo $v_position;?></td>
											<td><?php echo $v_fullname;?>
												(<?php echo $v_user_id; ?>)
											</td>
											<td align="center">
											
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
