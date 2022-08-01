<?php include 'config/db_connect.php';

	$sql = "SELECT * FROM con_invoice";	
	$result = $connect->query($sql);
	

	if(isset($_POST["btnadd"])){
		$id = $_POST["id"];
		$name = $_POST['editor1'];
		$note = $_POST['editor2'];

		if(!empty($_FILES['image']['size'])){
    	$image = $_FILES['image']['name'];
    	move_uploaded_file($_FILES['image']['tmp_name'],"img/$image");
    		$sql = "UPDATE con_invoice SET shop_name = '$name',
								shop_note = '$note',
								logo = '$image'
										WHERE
									c_id = '$id'
								";
			$result = mysqli_query($connect, $sql);
			if ($result) {
				header('location:con_inv.php?message=success');
			}else{
				echo "Error";
			}
		}else {
			$sql = "UPDATE con_invoice SET shop_name = '$name' ,
								shop_note = '$note'
									WHERE
								c_id = '$id'
								";
			$result = mysqli_query($connect, $sql);
			if ($result) {
				header('location:con_inv.php?message=success');
			}
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
							<h2 class="text-primary">Invoice Configuration</h2>
              				<hr>
							
						</div>
						<!-- <hr style = "border:1px solid #0081C2"> -->
						<div class="panel-body">
							<div class="table-responsive">
  							<table id="example" class="display" cellspacing="0" width="100%">
    							<thead>
									<tr>
										<th>No</th>
										<th>Logo</th>
										<th>Shop Name</th>
										<th>Shop Note</th>
										<th>Note</th>
										
									</tr>
    							</thead>
 
    							<tbody>
    								<?php 
    								while ($row = $result->fetch_assoc())
    								 {
    								     $t = $row['c_id'];
    								?>
	    							<tr>
	    								<td><?php echo $row['c_id']; ?></td>
	    								<td><img src="img/<?php echo $row['logo']?>" alt="" style = "width:100px;"></td>
										<td><?php echo $row['shop_name']; ?></td>
										<td><?php echo $row['shop_note'];?></td>
										<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#<?php echo $t;?>"> Change </button>
							 <!-- Modal -->
							 <div id="<?php echo $t;?>" class="modal fade" role="dialog">
								 <div class="modal-dialog modal-lg">
									 <!-- Modal content-->
									 <div class="modal-content">
										 <div class="modal-header">
											 <button type="button" class="close" data-dismiss="modal">&times;</button>
											 <h4 class="modal-title"> Change Invoice Tittle</h4>
										 </div>
										 <div class="modal-body">
					                       <form class="form-horizontal" method = "POST" action = "con_inv.php" enctype="multipart/form-data">
					                          <div class="form-group">
					                             <label class="control-label col-sm-2" for="email">Shop Logo:</label>
					                             <div class="col-sm-10">
					                               <input type="hidden" class="form-control" name="id" placeholder="" value = "<?php echo $row['c_id']; ?>">
					                               <input type="file" name = "image" class="form-control" onchange="loadFile(event)">
					                             </div>
					                          </div>
					                          <div class="form-group">
					                             <div class="col-sm-12 col-sm-offset-2">
					                               <img src="img/<?php echo $row['logo']?>" id="preview" alt="">
					                             </div>
					                          </div>
											  <div class="form-group">
					                             <label class="control-label col-sm-2" for="email">Shop name:</label>
					                             <div class="col-sm-10">
					                              <textarea id="editor1" name="editor1" rows="10" cols="80" class = "form-control">
					                              		<?php echo $row['shop_name']; ?>
                    								</textarea>
					                             </div>
					                          </div>
					                          <div class="form-group">
					                             <label class="control-label col-sm-2" for="email">Shop Note:</label>
					                             <div class="col-sm-10">
					                              <textarea class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name = "editor2"><?php echo $row['shop_note']; ?></textarea>
					                             </div>
					                          </div>
					                          
					                          <div class="form-group">
					                             <div class="col-sm-offset-2 col-sm-10">
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
							 </div>
							 </td>
						
                                <?php
                                    }
                                ?>
	    							</tr>
    							</tbody>
  					    </table>
		          </div>
						</div>
                    </div>
                </div>
            </div>
<?php include 'footer2.php';?>