
<?php include'config/db_connect.php'; 
    if(isset($_GET["id"])){
		$code = $_GET["id"];
		$sql = "SELECT * from product where code = $code";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(isset($_POST['btn_save'])){
		$code = $_POST["code"];
		$new_code = $_POST["txt_new_code"];
		$connect->query("UPDATE product SET code='$new_code' WHERE code='$code'");
		$connect->query("UPDATE stockin SET code_in='$new_code' WHERE code_in='$code'");
		$connect->query("UPDATE stockout SET code_out='$new_code' WHERE code_out='$code'");
		header("location:product.php?message=update");	
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
									<input type = "hidden" name = "code" value = "<?php echo $code; ?>">
									<label for ="">Old Code:</label>                                          
									<input class="form-control" readonly="" required type="text" placeholder="Code" value = "<?php echo $row["code"]?>">    
								</div>
								<div class="form-group col-xs-6">
		                            <label for ="">New Code:</label>                                          
		                            <input class="form-control" autocomplete="off"  required name="txt_new_code" type="text" placeholder="new code" value = "<?php echo $row["code"]?>" oninput="validate_product_code(this)">          
		                        </div>

								<div class="form-group col-xs-6">
									<a href="product.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
									<button type="submit" value = "update" name="btn_save" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	<script type="text/javascript">
      function validate_product_code(e){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              if(this.responseText != 0){
                e.style.border = '1px solid red';
              }else{
                e.style.border = '1px solid green';
              }
          }
        };
        xmlhttp.open("GET", "ajx_product_validate_code.php?code=" + e.value, true);
        xmlhttp.send();
      }
    </script>
<?php include 'footer.php';?>