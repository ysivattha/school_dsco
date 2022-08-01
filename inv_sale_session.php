<?php include 'config/db_connect.php';
// check if user is not logged in 
// ob_start();
// session_start();
if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
$from = "";
$to = "";
	//$sql = "SELECT *,SUM(amount) as sum_amount FROM invoice A LEFT JOIN customer B ON A.cus=B.no GROUP BY A.date_sell ORDER BY A.date_sell DESC";
	// $result = $connect->query($sql);
	if(isset($_POST['search'])){
		$from = $_POST['from'];
		$to = $_POST['to'];
	 	// $sql = "SELECT *,SUM(amount) as sum_amount FROM invoice A 
		 // 					LEFT JOIN customer B ON A.cus=B.no 
		 // 					WHERE DATE_FORMAT(A.date_sell,'%Y-%m-%d') between '$from' AND '$to' 
		 // 					GROUP BY DATE_FORMAT(A.date_sell,'%Y-%m-%d') ORDER BY A.date_sell DESC";	
		$sql = "SELECT * FROM tbl_order_session A 
		 					WHERE DATE_FORMAT(A.os_session_date,'%Y-%m') between '$from' AND '$to' 
		 					ORDER BY A.os_id DESC";	
		$result = $connect->query($sql);
		
	}else{
		$current_date = date('Y-m');
		$sql = "SELECT * FROM tbl_order_session A 
		 					WHERE DATE_FORMAT(A.os_session_date,'%Y-%m') = '$current_date'
		 					ORDER BY A.os_id DESC";	
		$result = $connect->query($sql);
	}
	
	$v = "SELECT * FROM vat";
	$rev = $connect->query($v);
	$a = $rev->fetch_assoc();
	$pun = $a['vat'];
	
	
	
?>
<?php include 'header.php';?>
		<div class="row">
		 
                <div style="clear:both"></div>  
                </br>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                         	  <h3 class="text-primary">Session Sale Summary</h3>
                     <hr>
                   <form class="form-inline" method = "post" action="">
                      <div class="form-group">
                        <label>From:</label>
                        <input type="text" required="" value="<?= @$_POST['from'] ?>" class="form-control" name = "from" value="<?= @$_POST['from'] ?>" data-provide="datepicker" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="YYYY-MM-DD">
                      </div>
                      <div class="form-group">
                        <label>To:</label>
                        <input type="text" required="" value="<?= @$_POST['to'] ?>" class="form-control" name = "to" value="<?= @$_POST['to'] ?>" data-provide="datepicker" data-date-format="yyyy-mm-dd" autocomplete="off" placeholder="YYYY-MM-DD"> 
                      </div>
                      <button type="submit" name="search" class="btn btn-success">Search</button>
                      <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                  </form> 
                        </div>
                        <div id="order_table">
	                        <div class="panel-body">
	                            <div class="table-responsive">
	                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
	                                    <thead>
	                                        <tr>
	                                            <th>No</th>
	                                            <th>Date</th>
	                                            <th class="text-right">Start Time</th>
	                                            <th class="text-left">End Time</th>
	                                            <th class="text-center">Action</th>
	                                        </tr>
	                                    </thead>
	                                    <tbody>
	                                        <?php
	                                        	$i = 0;
												while($row = mysqli_fetch_assoc($result)) 
												{			
													echo '<tr>';
														echo '<td>'.++$i.'</td>';
														echo '<td>'.$row['os_session_date'].'</td>';
														echo '<th class="text-right">'.date("H:i:sa", strtotime($row['os_open_sesstion_date'])).'</th>';
														echo '<th class="text-left">'.date("H:i:sa", strtotime($row['os_close_sesstion_date'])).'</th>';
														echo '<th class="text-center">
															<a href="print_close_session.php?os_id='.$row['os_id'].'" target="_blank" class="btn btn-xs btn-primary">View / Print <i class="fa fa-print"></i></a>
														</th>';
													echo '</tr>';
												}	
											?>
	                                    </tbody>
									</table>
	                            </div>	                             
	                          </div>
	                           
	                        </div>
                        
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>