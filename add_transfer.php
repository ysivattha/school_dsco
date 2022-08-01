<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM transfer A 
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){
		$v_date 	= date('Y-m-d H:i:s');
		$v_from_user	= $_POST["txt_from_user"];
		$v_to_user 	= $_POST["txt_to_user"];
		$v_amount 	= $_POST["txtamount"];
		$v_apporved 	= 1;
		$v_note 	= $_POST["txtnote"];

		$sql = "INSERT INTO transfer (tran_datetime
								, tran_from_id 
								, tran_to_id 
								, tran_amount
								, tran_approved
								, tran_note
											)
							VALUES
								('$v_date'
								, '$v_from_user'
								, '$v_to_user'
								, '$v_amount'
								, '$v_apporved'
								, '$v_note'
													)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:transfer.php?message=success');
		}
		
	}

?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
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
            <div class="panel panel-default">
                	<div class="panel-body"><h2 class="text-primary">Add Transfer</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">                  
								
								<div class="form-group col-xs-12">
									<label for ="">From User:</label>                                          
									<select class = "form-control" name="txt_from_user" required>
										<option value="">Select Member</option>
											<?php
											$v_select1 = mysqli_query($connect,"SELECT * FROM user");
											while ($row1 = mysqli_fetch_assoc($v_select1)) { ?>
											<option value="<?php echo $row1['id']; ?>"><?php echo $row1['full_name']; ?></option>
											<?php 
											}
											?>   
									</select>   
								</div>
								<div class="form-group col-xs-12">
									<label for ="">To User:</label>                                          
									<select class = "form-control" name="txt_to_user" required>
										<option value="">Select Member</option>
											<?php
											$v_select1 = mysqli_query($connect,"SELECT * FROM user");
											while ($row1 = mysqli_fetch_assoc($v_select1)) { ?>
											<option value="<?php echo $row1['id']; ?>"><?php echo $row1['full_name']; ?></option>
											<?php 
											}
											?>   
									</select>   
								</div>
								
								<div class="form-group col-xs-12">
									<label for ="">Amount:</label>                                          
									<input class="form-control" required name="txtamount" type="number" >    
								</div>
								<div class="form-group col-xs-12">
									<label for="note">Note:</label>
									<textarea class="form-control" rows="3" name="txtnote"></textarea>
								</div>
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i> Save</button>
                					<a href="transfer.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
