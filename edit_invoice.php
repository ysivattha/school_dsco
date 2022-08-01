<?php include'config/db_connect.php';

  date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

$errors = "";
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from invoice where inv_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$v_date = $_POST["txtdate"];
			$v_member = $_POST["txtmember"];
      $v_product = $_POST["txtproduct"];
      $v_amount = $_POST["txtamount"];
      $v_note = $_POST["txtnote"];
      $datetime = date('Y-m-d H:i:s');

			$sql = "UPDATE  invoice SET 
			 						inv_date = '$v_date'
			 					,	inv_member = '$v_member'
                ,	inv_product = '$v_product'
                ,	inv_amount = '$v_amount'
                ,	inv_note = '$v_note'
                ,	date_updated = '$datetime'
			 								WHERE inv_id = '$id' "; 

			$result = mysqli_query($connect, $sql);
			 if ($result) {
				 header('location:invoice.php?message=update');	
			 } 
		}
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h3 class="text-primary">Edit Invoice</h3>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							 <form class="form-horizontal" data-toggle="validator" role="form" method="POST" acion = "">
                        <div class="form-group">
                           <label class="control-label col-sm-2" for="email">Date:</label>
                           <div class="col-sm-8">
                              <input type="hidden" name="id" value = "<?php echo $id ?>"> 
                             <input type="date" required class="form-control" name="txtdate" value="<?php echo $row['inv_date']?>">
                           </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Member:</label>
                            <div class="col-sm-8">
                            <select class="form-control"  name="txtmember">
                            <?php
                                $select1 = "SELECT * FROM user ORDER BY id ASC";
                                $query1  = mysqli_query($connect,$select1);
                                while($row1 = $query1->fetch_assoc()):
                                $selected=($row['inv_member']==$row1['id']?"selected":"");
                            ?>
                              <option <?= $selected; ?> value="<?= $row1['id']; ?>">(<?= $row1['id']; ?>) <?= $row1['full_name']; ?></option>
                            <?php endwhile; ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Product:</label>
                          <div class="col-sm-8">
                            <select class="form-control"  name="txtproduct">
                              <?php
                                  $select1 = "SELECT * FROM product ORDER BY code ASC";
                                  $query1  = mysqli_query($connect,$select1);
                                  while($row1 = $query1->fetch_assoc()):
                                  $selected=($row['inv_product']==$row1['pro_id']?"selected":"");
                              ?>
                                <option <?= $selected; ?> value="<?= $row1['pro_id']; ?>">(<?= $row1['code']; ?>) <?= $row1['name_en']; ?></option>
                              <?php endwhile; ?>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Amount:</label>
                          <div class="col-sm-8">
                            <input type="number"  class="form-control" name="txtamount" value="<?php echo $row['inv_amount']?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Note:</label>
                          <div class="col-sm-8">
                            <textarea class="form-control"  name="txtnote" rows="3"><?= $row['inv_note']; ?></textarea>
                          </div>
                        </div>

                      <div class="form-group">
                         <div class="col-sm-offset-2 col-sm-10">
                           <button type="submit" class="btn btn-success btn-sm" name = "edit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                             <a href="invoice.php" class = "btn btn-danger btn-sm">Back</a>
                         </div>
                      </div>
                    </form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>
