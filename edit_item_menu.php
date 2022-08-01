
<?php include'config/db_connect_header.php';

    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from tbl_item_menu where im_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
		$id = $_POST["id"];
		$v_name = $_POST["txt_name"];
		$v_name_kh = $_POST["txt_name_kh"];
	 	$v_category = $_POST["txt_category"];
		$v_cost = $_POST["txt_cost"];
    	$v_price = $_POST["txt_price"];
	    $v_note = $_POST["txt_note"];
	
		$sql = "UPDATE tbl_item_menu SET im_name ='$v_name',im_name_kh ='$v_name_kh'
								, im_category 	  	  = '$v_category'
								, im_note 	  	  = '$v_note'
								, im_cost 	  	  = '$v_cost'
								, im_price 	  	  = '$v_price'
											WHERE
									   	im_id = '$id'";
		$result = mysqli_query($connect, $sql);
		if ($result) {
			header("location:item_menu.php?message=update");	
		}
	}
				
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h3 class="text-primary">Edit Item Menu</h3>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">                  
								<div class="form-group col-xs-6">
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Item Name En:</label> 
									<input class="form-control" required name="txt_name" type="text" value = "<?php echo $row["im_name"]?>">        
									
									<br>
									<input type = "hidden" name = "id" value = "<?php echo $id; ?>">
									<label for ="">Item Name Kh:</label> 
									<input class="form-control" required name="txt_name_kh" type="text" value = "<?php echo $row["im_name_kh"]?>">        
									
									<br>
		                            <label for="note">Item Note:</label>
		                            <textarea class="form-control" id="note" name="txt_note"><?php echo $row["im_note"]?></textarea>
									<br>

									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
									<a href="item_menu.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
								</div> 
								<?php if($row["im_sale_type"]){ ?>
								<div class="form-group col-xs-6 right_input">
		                            <label for ="">Cost:</label>                                          
		                            <input autocomplete="off" class="form-control" value="<?php echo $row["im_cost"]?>"  required name="txt_cost" type="text" >          
		                            <br>
		                            <label for ="">Price:</label>                                          
		                            <input autocomplete="off" class="form-control" value="<?php echo $row["im_price"]?>"  required name="txt_price" type="text"> 

		                            <br>
		                            <label for ="">Category:</label>                                          
		                            <select name="txt_category" class="form-control" required="">
		                              <option value="">==choose category==</option>
		                              <?php 
		                                $get_cate = $connect->query("SELECT * FROM category ORDER BY category_name ASC");
		                                while ($row_cate = mysqli_fetch_object($get_cate)) {
		                                	if($row_cate->cate_id == $row["im_category"])
		                                  		echo '<option SELECTED value="'.$row_cate->cate_id.'">'.$row_cate->category_name.'</option>';
		                                	else
		                                  		echo '<option value="'.$row_cate->cate_id.'">'.$row_cate->category_name.'</option>';
		                                }
		                              ?>
		                            </select>  
		                          </div>
		                        <?php }else{ ?>
									<input type="hidden" autocomplete="off" class="form-control" value="0.00"  required name="txt_cost" type="text" >  
									<input type="hidden" autocomplete="off" class="form-control" value="0.00"  required name="txt_price" type="text">
		                    	<?php } ?>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php include 'footer.php';?>