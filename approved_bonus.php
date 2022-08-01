<?php include'config/db_connect.php';

  date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

$errors = "";
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from bonus where b_id = $id";

		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$v_received = 2;
      $datetime = date('Y-m-d H:i:s');

			$sql = "UPDATE  bonus SET 
			 						b_received = '$v_received'
                ,	b_datetime = '$datetime'
			 								WHERE b_id = '$id' "; 

			$result = mysqli_query($connect, $sql);

 //start add ewaleet         
 $v_datetime 	= date('Y-m-d H:i:s');
 $v_member	= $_POST["txtreceiver"];
 $v_cashbeginning = $_POST["txtlastbalance"];
   $add = $_POST["txtamount"];
   $minus = 0;
 $v_cashbalance 	= $v_cashbeginning+$add-$minus;
 $v_description = $_POST["txtdescription"];

 $sql = "INSERT INTO ewallet (ew_datetime
                            , ew_member 
                            , ew_cashbegining 
                            , ew_cashadd
                            , ew_cashminus
                            , ew_cashbalance
                            , ew_description
                                  )
                          VALUES
                            ('$v_datetime'
                            , '$v_member'
                            , '$v_cashbeginning'
                            , '$add'
                            , '$minus'
                            , '$v_cashbalance'
                            , '$v_description'
                                      )";
 $result = mysqli_query($connect, $sql);
 //end add ewaleet  

				 header('location:bonus.php?message=update');	
			   
		}
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h3 class="text-primary">Received Bonus</h3>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							 <form class="form-horizontal" data-toggle="validator" role="form" method="POST" acion = "">
                    <input type="hidden" name="id" value = "<?php echo $id ?>">
                        
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Receiver ID:</label>
                          <div class="col-sm-8">
                            <input type="number"  class="form-control" readonly name="txtreceiver" value="<?php echo $row['b_receiver']?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Amount:</label>
                          <div class="col-sm-8">
                            <input type="number"  class="form-control" readonly name="txtamount" value="<?php echo $row['b_amount']?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Description:</label>
                          <div class="col-sm-8">
                            <input type="text"  class="form-control" readonly name="txtdescription" value="<?php echo $row['b_description']?>">
                          </div>
                        </div>
                        
                        <div class="form-group">
                         <div class="col-sm-offset-2 col-sm-10">
                           <button type="submit" class="btn btn-success btn-sm" name = "edit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                             <a href="bonus.php" class = "btn btn-danger btn-sm">Back</a>
                         </div>
                        </div>

                      <!-- start get receiver cash begin -->
                      <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Last Balance :</label>
                                    <div class="col-sm-3">
                                        <?php
                                            $v_id = @$row['b_receiver'] ;
                                            $selectbegin = "SELECT * from ewallet
                                                                    WHERE ew_member='$v_id'
                                                                    ORDER BY ew_id DESC LIMIT 1
                                                                    ";
                                            $querybegin  = mysqli_query($connect,$selectbegin);
                                            $rowbegin = $querybegin->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowbegin['ew_cashbalance']+0;  ?>" name="txtlastbalance"  >
                                        
                                    </div>
                      </div>
                      
                        
                    </form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>
