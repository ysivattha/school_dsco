<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$user_id = $_SESSION['user_id'];

	$sql = "SELECT * FROM transfer_pv A 
									";
	$result = $connect->query($sql);
	$row = mysqli_fetch_array($result);	

	if(isset($_POST["btnadd"])){
		$v_date 	= date('Y-m-d H:i:s');
		$v_from_user	= $_POST["txt_from_user"];
		$v_to_user 	= $_POST["txt_to_user"];
		$v_amount 	= $_POST["txtamount"];
		$v_apporved 	= 1;
		$v_note 	= $_POST["txtnote"];

		$sql = "INSERT INTO transfer_pv (tranpv_datetime
								, tranpv_from_id 
								, tranpv_to_id 
								, tranpv_amount
								, tranpv_approved
								, tranpv_note
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
			header('location:transfer_pv.php?message=success');
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
					
                	<div class="panel-body">
					
						<h2 class="text-primary">Add Transfer PV</h2>
					
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-6">
							<form method="post" enctype="multipart/form-data" action="">                  
								
								<div class="form-group col-xs-12">
									<label for ="">Your ID:</label>   
									<input class="form-control" readonly name="txt_from_user" value = "<?php echo $_SESSION['user_id']; ?>" type="number" >
								</div>
								<div class="form-group col-xs-12">
									<label for ="">To User:</label>   
									<input class="form-control" required name="txt_to_user" type="number" >                                       
									 
								</div>
								
								<div class="form-group col-xs-12">
									<label for ="">Amount:</label>                                          
									<input class="form-control" required name="txtamount" type="number" >    
								</div>
								<div class="form-group col-xs-12">
									<label for="note">Note:</label>
									<textarea class="form-control" rows="2" name="txtnote"></textarea>
								</div>
								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="transfer_pv.php" class = "btn btn-danger btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                         
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
