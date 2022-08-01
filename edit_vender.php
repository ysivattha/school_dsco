<?php include'config/db_connect.php'; 
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from vender where vender_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$kname = $_POST["name_khmer"];
			$ename = $_POST["name_english"];
			$phone = $_POST["phone"];
			$addr = $_POST["addr"];
			$note = $_POST["note"];
		
				$sql = "UPDATE vender SET 
									vendername_kh = '$kname' 
									, vendername_en = '$ename'
									, phone 		= '$phone'
									, address  		= '$addr'
									, note 			= '$note'
									WHERE vender_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:vender.php?message=update");
	}
?>
<?php include 'header.php';?>
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Vendor</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                    
								<div class="form-group col-xs-6">
									<label for ="">Vender Name(kh):</label>  
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">                                        
									<input class="form-control" required name="name_khmer" type="text" placeholder="Name(kh)" value = "<?php echo $row["vendername_kh"]?>">    
								</div>
								<div class="form-group col-xs-6">
									<label for ="">vender Name(en):</label>                                          
									<input class="form-control" required name="name_english" type="text" placeholder="Name(en)" value = "<?php echo $row["vendername_en"]?>">
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Phone:</label>                                          
									<input class="form-control" required name="phone" type="text" placeholder="Phone" value = "<?php echo $row["phone"]?>">   
								</div>
								<div class="form-group col-xs-6">
									<label for ="">Address:</label>                                          
									<input class="form-control" required  name="addr" type="text" placeholder="Address" value = "<?php echo $row["address"]?>">      
								</div>
								<div class="form-group col-xs-12">
									<label for="note">Note:</label>
									<textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["note"]?></textarea>
								</div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
									<a href="vender.php" class="btn btn-danger">Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>