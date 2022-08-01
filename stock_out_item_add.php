<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	$errors = ""; 
	$sql = "SELECT * FROM stock_out_item AS A
									";
	$result = $connect->query($sql);

	$get_id = $_GET["sent_id"];
	if(isset($_POST["btnadd"])){
			$v_date =$_POST["txt_date"];
			$v_time =$_POST["txt_time"];
			$v_qtyout =$_POST["txt_qtyout"];
			$v_employee =$_POST["txt_employee"];
			$v_note =$_POST["txt_note"];
			$get_id = $_GET["sent_id"];

		$sql = "INSERT INTO stock_out_item (sout_date
								, sout_time 
								, sout_qtyout 
								, sout_employee
								, sout_note
								, sout_bill_item
											)
							VALUES
								('$v_date'
								, '$v_time'
								, '$v_qtyout'
								, '$v_employee'
								, '$v_note'
								, '$get_id'
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header("location:stock_out.php");
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
                	<div class="panel-body"><h2 class="text-primary">Add Big Truck</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">         
							
		                        <div class="form-group col-xs-6">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_date" type="date" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Time:</label>                                          
		                       		<input class="form-control" name="txt_time" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Qty_out:</label>                                          
		                       		<input class="form-control" name="txt_qtyout" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Employee:</label>                                          
		                       		<input class="form-control" name="txt_employee" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Note:</label>                                          
		                       		<input class="form-control" name="txt_note" type="text" >
		                        </div>

								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save</button>
									<a href="stock_out.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>
<?php include 'footer.php';?>
