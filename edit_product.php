<?php include'config/db_connect.php'; 
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from product where pro_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$code = $_POST["code"];
			$ref = $_POST["ref"];
		    $paket = $_POST["paket"];
		    $category = $_POST["category"];
		    $en = $_POST["en"];
		    $kh = $_POST["kh"];
		    $priced = $_POST["priced"];
		    $pricek = $_POST["pricek"];
		    $image = "no_photo.png";
		    $note = $_POST["note"];

		    if(!empty($_FILES['image']['size']) ){
   			$image = $_FILES['image']['name'];

    		move_uploaded_file($_FILES['image']['tmp_name'],"img/product/$image");
		
			$sql = "UPDATE product SET code ='$code'
									, ref 	  	  = '$ref'
									, paket 	  = '$paket' 
									, name_en  	  = '$en'
									, name_kh 	  = '$kh'
									, price_dolla = '$priced'
									, price_riel  = '$pricek'
									, photo 	  = '$image'
									, note_pro    = '$note'
									, cate_id     = '$category'
												WHERE
										   pro_id = '$id'";
			$result = mysqli_query($connect, $sql);
			if ($result) {
				header("location:product.php?message=update");	
			}
		}else{
				$sql = "UPDATE product SET code ='$code'
									, ref 	  	  = '$ref'
									, paket 	  = '$paket' 
									, name_en  	  = '$en'
									, name_kh 	  = '$kh'
									, price_dolla = '$priced'
									, price_riel  = '$pricek'
									, note_pro    = '$note'
									, cate_id     = '$category'
												WHERE
										   pro_id = '$id'";
			$result = mysqli_query($connect, $sql);
			if ($result) {
				header("location:product.php?message=update");	
			}
		}
}
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h3 class="text-primary">Edit Product</h3>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Code:</label>                                          
									<input class="form-control" readonly="" required name="code" type="text" placeholder="Name(kh)" value = "<?php echo $row["code"]?>">    
								</div>
								<div class="form-group col-xs-6">
		                            <label for ="">Ref Name:</label>                                          
		                            <input class="form-control"   required name="ref" type="text" placeholder="ref" value = "<?php echo $row["ref"]?>">          
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Paket:</label>                                          
		                            <input class="form-control"   required name="paket" type="text" placeholder="Paket" value = "<?php echo $row["paket"]?>">          
		                        </div>
		                        <div class = "form-group col-xs-6">
		                            <label for = "">Category:</label>
		                            <select class = "form-control select2" name = "category">
		                                    <?php
											$select1 = "select * from category";
											$query1  = mysqli_query($connect,$select1);
											while($row1	= $query1->fetch_assoc()):
												$selected=($row['cate_id']==$row1['cate_id']?"selected":"");
												?>
												<option <?= $selected; ?> value="<?= $row1['cate_id']; ?>"><?= $row1['category_name']; ?></option>
											<?php endwhile; ?>
		                            </select>
		                        </div>
		                       	<div class="form-group col-xs-6">
		                            <label for ="">Name:(En):</label>                                          
		                            <input class="form-control"   required name="en" type="text" placeholder="English" value = "<?php echo $row["name_en"]?>">          
		                        </div>
		                        <div class="form-group col-xs-6">
		                            <label for ="">Name(Kh):</label>                                          
		                            <input class="form-control"   required name="kh" type="text" placeholder="Khmer" value = "<?php echo $row["name_kh"]?>">          
		                        </div>
		                        <div class="form-group col-xs-6">
		                            <label for ="">Price:</label>                                          
		                            <input class="form-control"   required name="priced" type="text" placeholder="$" value = "<?php echo $row["price_dolla"]?>">          
		                        </div>
		                        <div class="form-group col-xs-6">
		                            <label for ="">Cost:</label>                                          
		                            <input class="form-control"   required name="pricek" type="text" placeholder="៛" value = "<?php echo $row["price_riel"]?>" >          
		                        </div>
		                        <div class = "form-group col-xs-12">
		                        	<div class="row">
			                        	<div class = "col-xs-6">
				                            <label for = "">photo:</label>                                     
				                            <input type="file"   id = "phot" name="image" onchange="loadFile(event)" />
				                        </div>
				                        <div class = "col-xs-6">
			                            <img src = "img/product/<?php echo $row["photo"]?>" width = "200px" id="preview">
			                            </div>
		                            </div>
		                        </div>
		                        <div class="form-group col-xs-12">
		                            <label for="note">Note:</label>
		                             <textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["note_pro"]?></textarea>
		                        </div>	
								<div class="form-group col-xs-6">
									<a href="product.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php include 'footer.php';?>