<?php include'config/db_connect.php';

  date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

$errors = "";
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from transfer where tran_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$v_approved = 2;
      $datetime = date('Y-m-d H:i:s');

			$sql = "UPDATE  transfer SET 
			 						tran_approved = '$v_approved'
                ,	tran_datetime = '$datetime'
			 								WHERE tran_id = '$id' "; 

			$result = mysqli_query($connect, $sql);
			 
         // start add network profit 13 line
              //start ewallet minus sender
              $v_datetime 	= date('Y-m-d H:i:s');
              $v_member	= $_POST["txt_from_user"];
              $v_cashbeginning = $_POST["txtlastbalancefromsender"];
                $add = 0;
                $minus = $_POST["txtamount"];
              $v_cashbalance 	= $v_cashbeginning+$add-$minus;
              $v_description 	= "transfer out";

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
              //end insert ewallet sender
              //start insert ewallet receiver
              $v_datetime 	= date('Y-m-d H:i:s');
              $v_member	= $_POST["txt_to_user"];
              $v_cashbeginning = $_POST["txtlastbalancetoreceiver"];
                $add = $_POST["txtamount"];
                $minus = 0;
              $v_cashbalance 	= $v_cashbeginning+$add-$minus;
              $v_description 	= "transfer in";

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
              //end insert ewallet receiver

         // end network
        
				 header('location:transfer.php?message=update');	
			   
		}
?>
<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h3 class="text-primary">Approved Invoice</h3>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							 <form class="form-horizontal" data-toggle="validator" role="form" method="POST" acion = "">
                        <input type="hidden" name="id" value = "<?php echo $id ?>">
                        
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">From User:</label>
                            <div class="col-sm-8">
                              <input type="number" readonly class="form-control" name="txt_from_user" value="<?php echo $row['tran_from_id']?>">
                        
                            </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">To User:</label>
                            <div class="col-sm-8">
                              <input type="number" readonly class="form-control" name="txt_to_user" value="<?php echo $row['tran_to_id']?>">
                        
                            </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Amount:</label>
                          <div class="col-sm-8">
                            <input type="number" readonly class="form-control" name="txtamount" value="<?php echo $row['tran_amount']?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Note:</label>
                          <div class="col-sm-8">
                            <textarea class="form-control" name="txtnote" rows="3"><?= $row['tran_note']; ?></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                         <div class="col-sm-offset-2 col-sm-10">
                           <button type="submit" class="btn btn-success btn-sm" name = "edit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                             <a href="transfer.php" class = "btn btn-danger btn-sm">Back</a>
                         </div>
                        </div>
                        
  
                    <!-- start get sender balance  -->
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Last Balance Sender :</label>
                                    <div class="col-sm-3">
                                        <?php
                                            $v_id = @$row['tran_from_id'];
                                            $selectpid = "SELECT * from ewallet
                                                                    WHERE ew_member='$v_id'
                                                                    ORDER BY ew_id DESC LIMIT 1
                                                                    ";
                                            $querypid  = mysqli_query($connect,$selectpid);
                                            $rowpid = $querypid->fetch_assoc();
                                        ?>
                                        <input type="hidden" class="form-control" value="<?php echo @$rowpid['ew_cashbalance']+0;  ?>" name="txtlastbalancefromsender"  >
                                        
                                    </div>
                        </div>

                    <!-- start get receiver balance  -->
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Last Balance Receiver :</label>
                                    <div class="col-sm-3">
                                        <?php
                                            $v_id = @$row['tran_to_id'];
                                            $selectpid = "SELECT * from ewallet
                                                                    WHERE ew_member='$v_id'
                                                                    ORDER BY ew_id DESC LIMIT 1
                                                                    ";
                                            $querypid  = mysqli_query($connect,$selectpid);
                                            $rowpid = $querypid->fetch_assoc();
                                        ?>
                                        <input type="hidden" class="form-control" value="<?php echo @$rowpid['ew_cashbalance']+0;  ?>" name="txtlastbalancetoreceiver"  >
                                        
                                    </div>
                        </div>
                        
                        <p>
                          <hr>
                        </p>
                    <!-- end get product pv  -->
                        
                        
                     

                        
                    </form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>
