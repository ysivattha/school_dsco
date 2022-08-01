<?php include'config/db_connect.php';

  date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

$errors = "";
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from user where id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$user = $_POST["user"];
			$v_position = $_POST["txt_pos"];
      $v_fullname = $_POST["txt_fullname"];
      $v_sponcer_id = 1;
      $datetime = date('Y-m-d H:i:s');

			$sql = "UPDATE user SET 
			 						username = '$user'
			 					,	position_id = '$v_position'
                ,	full_name = '$v_fullname'
                ,	date_updated = '$datetime'
			 								WHERE id = '$id' "; 

			$result = mysqli_query($connect, $sql);
			 if ($result) {
				 header('location:user.php?message=update');	
			 } 
		}
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h3 class="text-primary">Edit User</h3>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							 <form class="form-horizontal" data-toggle="validator" role="form" method="POST" acion = "">
                        <div class="form-group">
                           <label class="control-label col-sm-2" for="email">Username:</label>
                           <div class="col-sm-8">
                              <input type="hidden" name="id" value = "<?php echo $row['id']?>"> 
                             <input type="text" id="inputName" required class="form-control" name="user" value="<?php echo $row['username']?>">
                           </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="email">Position:</label>
                            <div class="col-sm-8">
                            <select class="form-control"  name="txt_pos">
                            <?php
                                $select1 = "select * from position";
                                $query1  = mysqli_query($connect,$select1);
                                while($row1 = $query1->fetch_assoc()):
                                $selected=($row['position_id']==$row1['position_id']?"selected":"");
                            ?>
                              <option <?= $selected; ?> value="<?= $row1['position_id']; ?>"><?= $row1['position']; ?></option>
                            <?php endwhile; ?>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="email">Full Name:</label>
                          <div class="col-sm-8">
                            <input type="text"  class="form-control" name="txt_fullname" value="<?php echo $row['full_name']?>">
                          </div>
                        </div>
                          
                      <div class="form-group">
                         <div class="col-sm-offset-2 col-sm-10">
                           <button type="submit" class="btn btn-success btn-sm" name = "edit"><i class="fa fa-floppy-o"></i> Save</button>
                             <a href="user.php" class = "btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
                         </div>
                      </div>
                    </form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>
