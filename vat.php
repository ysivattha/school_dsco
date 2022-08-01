<?php include 'config/db_connect.php';

$errors = ""; 


if(empty($_SESSION['user_id'])) {
	header('location:index.php');
	exit();
}
	$sql = "SELECT * FROM vat";	
	$result = $connect->query($sql);
	

	if(isset($_POST["btnadd"])){
		$vat = $_POST["vat"];
		$note = $_POST['note'];
	
		$sql = "UPDATE vat SET vat = '$vat' ,
								note = '$note'
								WHERE
								vat_id = 1
								";
			$result = mysqli_query($connect, $sql);
			header('location:vat.php?message=success');


}
 
    if(isset($_GET["id"])){
		$id = $_GET["id"];
			
		$sql = "DELETE FROM vat WHERE id = '$id'";
		$result = mysqli_query($connect, $sql);
		header("location:user.php?message=delete");	
}	
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vender List</li>
      </ol>
	<div class="row">
		<div class = "col-xs-12">
                <div class="col-lg-12">
                	<div class = "row">
                		<div class = "col-xs-12">
                		<?php echo $errors;?>
                		</div>
                	</div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> ផ្លាស់ប្តូរ VAT</button>
							  <!-- Modal -->
							  <div class="modal fade" id="myModal" role="dialog">
								<div class="modal-dialog">
								  <div class="modal-content">
									<div class="modal-header">
									  <button type="button" class="close" data-dismiss="modal">&times;</button>
									  <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i>ផ្លាស់ប្តូរ VAT</h4>
									</div>
									<div class="modal-body">
										<div class="col-md-12">
												<form method="post" enctype="multipart/form-data" action="">     
													<div class="form-group col-xs-6">
														<label for ="">VAT:</label>                                          
													  	<input class="form-control" required name="vat" type="text" placeholder="Ex:0.1">  
													</div>   
													<div class="form-group col-xs-12">
														<label for="note">Note:</label>
														 <textarea class="form-control" rows="4" id="note" name = "note"></textarea>
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
                                            <th>#</th>
                                            <th>Vat</th>
											<th>Note</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											while($row = $result->fetch_assoc()) 
											{		
												$v3=$row["vat_id"];	
												$v1=$row["vat"];
												$v2=$row["note"];			
										?>
										<tr>
											<td><?php echo $v3;?></td>
											<td><?php echo $v1;?></td>
											<td><?php echo $v2;?></td>
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