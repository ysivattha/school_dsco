<?php include 'config/db_connect.php';

$errors = ""; 
	$sql = "SELECT * FROM exchange";	
	$result = $connect->query($sql);
	

	if(isset($_POST["btnadd"])){
		$ex = $_POST["name"];
		$note = $_POST['note'];
	
		$sql = "UPDATE exchange SET exchange = '$ex' ,
								note = '$note'
								WHERE
								exchange_id = 1
								";
			$result = mysqli_query($connect, $sql);
			header('location:exchange.php?message=success');


}
 
    if(isset($_GET["id"])){
		$id = $_GET["id"];
			
		$sql = "DELETE FROM user WHERE id = '$id'";
		$result = mysqli_query($connect, $sql);
		header("location:user.php?message=delete");	
}	
?>
<?php include 'header.php';?>
	<div class="row">
		<div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add </h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update </h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete </h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-sm-12">
                    <div class="panel panel-default">
                    		<div class="panel-body">
							<h2 class="text-primary">Exchange Rate</h2>
              				<hr>
							
						</div>
						<!-- <hr style = "border:1px solid #0081C2"> -->
						<div class="panel-body">
							<div class="table-responsive">
  							<table id="example" class="display" cellspacing="0" width="100%">
    							<thead>
									<tr>
										<th>No</th>
										<th>Exchange Rate</th>
										<td>Change</td>
										
									</tr>
    							</thead>
    							<tfoot>
    								<tr>
				                      <th>No</th>
				                      <th>Exchange Rate</th>
				                      <td>Change</td>
    								</tr>
    							</tfoot>
    							<tbody>
    								<?php while ($row = $result->fetch_assoc())
    								 {
    								     $t = $row['exchange_id'];
    								?>
	    							<tr>
										<td><?php echo $row['exchange_id']; ?></td>
										<td><?php echo $row['exchange'];?></td>
										<?php if ($show['position_id'] == 1){ ?>
										<td><button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#<?php echo $t;?>"><i class="fa fa-usd" aria-hidden="true"></i> Change </button>
							 <!-- Modal -->
							 <div id="<?php echo $t;?>" class="modal fade" role="dialog">
								 <div class="modal-dialog">
									 <!-- Modal content-->
									 <div class="modal-content">
										 <div class="modal-header">
											 <button type="button" class="close" data-dismiss="modal">&times;</button>
											 <h4 class="modal-title"><i class="fa fa-usd" aria-hidden="true"></i> Change</h4>
										 </div>
										 <div class="modal-body">
					                       <form class="form-horizontal" method = "POST" action = "">
					                          <div class="form-group">
					                             <label class="control-label col-sm-3" for="email">Exchange Rate:</label>
					                             <div class="col-sm-9">
					                               <input type="hidden" class="form-control" name="id" placeholder="" value = "<?php echo $row['exchange_id']; ?>">
					                               <input type="number" class="form-control"  name="name" placeholder="" value = "<?php echo $row['exchange']; ?>">
					                             </div>
					                          </div>
					                          
					                          <div class="form-group">
					                             <div class="col-sm-offset-3 col-sm-9">
					                               <button type="submit" name = "btnadd" class="btn btn-success btn-sm"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
					                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> Close</button>
					                             </div>
					                          </div>
					                        </form>
										 </div>
										 <div class="modal-footer">

										 </div>
									 </div>
								 </div>
							 </div></td>
							 <?php
                                    }else{
                                ?>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm disabled" data-toggle="modal" data-target="#<?php echo $t;?>"><i class="fa fa-usd" aria-hidden="true"></i> Change </button>
                                </td>
                                <?php
                                    }
                                ?>
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