<?php include 'config/db_connect.php';

date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

$errors = "";
if(isset($_GET["id"])){
	$id = $_GET["id"];

	$sql = "SELECT * from ewallet_pv AS A
						left join user AS U ON U.id=A.epv_member
						where A.epv_member = '$id'
						ORDER BY A.epv_datetime DESC ";
	$result = mysqli_query($connect, $sql);
}	

?>
<?php include 'header.php';?>
	<div class="row">
		<div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Add user</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Update user</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                      echo '<h4>Success Delete user</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
							<h3 class = "text-primary"><i class="fa fa-list" aria-hidden="true"></i> Ewallet</h3>
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
											<th>Date Time</th>
											<th>Beginning</th>
											<th>Add</th>
											<th>Minus</th>
											<th>Balance</th>
											<th>Description</th>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											$i = 1;
											while($row = $result->fetch_assoc())
											{
												
												$v_fullname =$row["full_name"];
												$v_userid =$row["epv_member"];
												$v_datetime =$row["epv_datetime"];
												$v_begining =$row["epv_cashbegining"];
												$v_add =$row["epv_cashadd"];
												$v_minus =$row["epv_cashminus"];
												$v_balance =$row["epv_cashbalance"];
												$v_description =$row["epv_description"];

                                            
										?>
										<tr>
											<td><?php echo $i++;?></td>
											<td><?php echo $v_fullname;?>(<?php echo $v_userid;?>)</td>
											<td><?php echo $v_datetime;?>
											<td><?php echo $v_begining;?>
											<td><?php echo $v_add;?>
											<td><?php echo $v_minus;?>
											<td><?php echo $v_balance;?>
											<td><?php echo $v_description;?>
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
