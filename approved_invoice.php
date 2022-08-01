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
			$v_paid = 1;
      $datetime = date('Y-m-d H:i:s');

			$sql = "UPDATE  invoice SET 
			 						inv_paid = '$v_paid'
                ,	date_updated = '$datetime'
			 								WHERE inv_id = '$id' "; 

			$result = mysqli_query($connect, $sql);
			 
         // start add network profit 13 line
         //start up-lin 0 yourself         
         $v_datetime 	= date('Y-m-d H:i:s');
         $v_sender	= $_POST["txtmember"];
         $v_receiver 	= $_POST["txtmember"];
          $point = $_POST["txtproduct_pv"];
          $percent = (15/100);
         $v_amount 	= ($point*$percent);
         $v_received 	= 1;
         $v_description 	= 'get bonus 15%, buyer is yourself';
     
         $sql = "INSERT INTO bonus (b_datetime
                     , b_sender 
                     , b_receiver 
                     , b_amount
                     , b_received
                     , b_description
                           )
                   VALUES
                     ('$v_datetime'
                     , '$v_sender'
                     , '$v_receiver'
                     , '$v_amount'
                     , '$v_received'
                     , '$v_description'
                               )";
         $result = mysqli_query($connect, $sql);
         //end up-lin 0 yourself  
         //start up-lin 1        
         $v_datetime 	= date('Y-m-d H:i:s');
         $v_sender	= $_POST["txtmember"];
         $v_receiver 	= $_POST["txtidline1"];
          $point = $_POST["txtproduct_pv"];
          $percent = (4/100);
         $v_amount 	= ($point*$percent);
         $v_received 	= 1;
         $v_description 	= 'get bonus 4%, you are upline1 from buyer';
     
         $sql = "INSERT INTO bonus (b_datetime
                     , b_sender 
                     , b_receiver 
                     , b_amount
                     , b_received
                     , b_description
                           )
                   VALUES
                     ('$v_datetime'
                     , '$v_sender'
                     , '$v_receiver'
                     , '$v_amount'
                     , '$v_received'
                     , '$v_description'
                               )";
         $result = mysqli_query($connect, $sql);
         //end up-lin 1
          //start up-lin 2       
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline2"];
           $point = $_POST["txtproduct_pv"];
           $percent = (4/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 4%, you are upline2 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 2 
          //start up-lin 3       
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline3"];
           $point = $_POST["txtproduct_pv"];
           $percent = (4/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 4%, you are upline3 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 3
          //start up-lin 4      
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline4"];
           $point = $_POST["txtproduct_pv"];
           $percent = (4/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 4%, you are upline4 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 4
          //start up-lin 5   
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline5"];
           $point = $_POST["txtproduct_pv"];
           $percent = (4/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 4%, you are upline5 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 5
          //start up-lin 6 
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline6"];
           $point = $_POST["txtproduct_pv"];
           $percent = (4/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 4%, you are upline6 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 6
          //start up-lin 7
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline7"];
           $point = $_POST["txtproduct_pv"];
           $percent = (4/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 4%, you are upline7 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 7
          //start up-lin 8
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline8"];
           $point = $_POST["txtproduct_pv"];
           $percent = (4/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 4%, you are upline8 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 8
          //start up-lin 9
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline9"];
           $point = $_POST["txtproduct_pv"];
           $percent = (4/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 4%, you are upline9 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 9
          //start up-lin 10
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline10"];
           $point = $_POST["txtproduct_pv"];
           $percent = (4/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 4%, you are upline10 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 10
          //start up-lin 11
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline11"];
           $point = $_POST["txtproduct_pv"];
           $percent = (3/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 3%, you are upline11 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 11
          //start up-lin 12
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline12"];
           $point = $_POST["txtproduct_pv"];
           $percent = (2/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 2%, you are upline12 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 12
          //start up-lin 13
          $v_datetime 	= date('Y-m-d H:i:s');
          $v_sender	= $_POST["txtmember"];
          $v_receiver 	= $_POST["txtidline13"];
           $point = $_POST["txtproduct_pv"];
           $percent = (1/100);
          $v_amount 	= ($point*$percent);
          $v_received 	= 1;
          $v_description 	= 'get bonus 1%, you are upline13 from buyer';
      
          $sql = "INSERT INTO bonus (b_datetime
                      , b_sender 
                      , b_receiver 
                      , b_amount
                      , b_received
                      , b_description
                            )
                    VALUES
                      ('$v_datetime'
                      , '$v_sender'
                      , '$v_receiver'
                      , '$v_amount'
                      , '$v_received'
                      , '$v_description'
                                )";
          $result = mysqli_query($connect, $sql);
          //end up-lin 13
         
         // end network
        
				 header('location:invoice.php?message=update');	
			   
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
                        <div class="form-group">
                           <label class="control-label col-sm-2" for="email">Date:</label>
                           <div class="col-sm-8">
                              <input type="hidden" name="id" value = "<?php echo $id ?>">
                             <input type="date" disabled required class="form-control" name="txtdate" value="<?php echo $row['inv_date']?>">
                           </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Member:</label>
                            <div class="col-sm-8">
                            <select class="form-control" readonly name="txtmember">
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
                            <select class="form-control" readonly name="txtproduct">
                              <?php
                                  $selectpro = "SELECT * FROM product ORDER BY code ASC";
                                  $querypro  = mysqli_query($connect,$selectpro);
                                  while($rowpro = $querypro->fetch_assoc()):
                                  $selected=($row['inv_product']==$rowpro['pro_id']?"selected":"");
                              ?>
                                <option <?= $selected; ?> value="<?= $rowpro['pro_id']; ?>">(<?= $rowpro['code']; ?>) <?= $rowpro['name_en']; ?></option>
                              <?php endwhile; ?>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-2" for="">Amount:</label>
                          <div class="col-sm-8">
                            <input type="number"  class="form-control" disabled name="txtamount" value="<?php echo $row['inv_amount']?>">
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
                        
  <!-- start bonus network 13 line  -->
                    <!-- start get product pv  -->
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Product ID :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id = @$_GET["id"];
                                            $selectpid = "SELECT * from invoice
                                                                    WHERE inv_id='$v_id'
                                                                    ORDER BY inv_id DESC LIMIT 1
                                                                    ";
                                            $querypid  = mysqli_query($connect,$selectpid);
                                            $rowpid = $querypid->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowpid['inv_product'];  ?>" name="txtupdateone"  >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Product PV :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_pv = @$rowpid['inv_product'];
                                            $selectpv = "SELECT * from product
                                                                    WHERE pro_id='$v_id_pv'
                                                                    ORDER BY pro_id DESC LIMIT 1
                                                                    ";
                                            $querypv  = mysqli_query($connect,$selectpv);
                                            $rowpv = $querypv->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowpv['product_pv'];  ?>" name="txtproduct_pv"  >
                                        
                                    </div>
                        </div>
                        <p>
                          <hr>
                        </p>
                    <!-- end get product pv  -->
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line1 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline1 = @$row['inv_member'];
                                            $selectline1 = "SELECT * from user
                                                                    WHERE id='$v_id_upline1'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline1  = mysqli_query($connect,$selectline1);
                                            $rowline1 = $queryline1->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline1['sponcer_id'];  ?>" name="txtidline1"  >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line2 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline2 = @$rowline1['sponcer_id'];
                                            $selectline2 = "SELECT * from user
                                                                    WHERE id='$v_id_upline2'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline2  = mysqli_query($connect,$selectline2);
                                            $rowline2 = $queryline2->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control"  value="<?php echo @$rowline2['sponcer_id'];  ?>" name="txtidline2" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line3 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline3 = @$rowline2['sponcer_id'];
                                            $selectline3 = "SELECT * from user
                                                                    WHERE id='$v_id_upline3'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline3  = mysqli_query($connect,$selectline3);
                                            $rowline3 = $queryline3->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline3['sponcer_id'];?>" name="txtidline3" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line4 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline4 = @$rowline3['sponcer_id'];
                                            $selectline4 = "SELECT * from user
                                                                    WHERE id='$v_id_upline4'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline4  = mysqli_query($connect,$selectline4);
                                            $rowline4 = $queryline4->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline4['sponcer_id'];?>" name="txtidline4" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line5 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline5 = @$rowline4['sponcer_id'];
                                            $selectline5 = "SELECT * from user
                                                                    WHERE id='$v_id_upline5'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline5  = mysqli_query($connect,$selectline5);
                                            $rowline5 = $queryline5->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline5['sponcer_id'];?>" name="txtidline5" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line6 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline6 = @$rowline5['sponcer_id'];
                                            $selectline6 = "SELECT * from user
                                                                    WHERE id='$v_id_upline6'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline6  = mysqli_query($connect,$selectline6);
                                            $rowline6 = $queryline6->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline6['sponcer_id'];?>" name="txtidline6" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line7 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline7 = @$rowline6['sponcer_id'];
                                            $selectline7 = "SELECT * from user
                                                                    WHERE id='$v_id_upline7'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline7  = mysqli_query($connect,$selectline7);
                                            $rowline7 = $queryline7->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline7['sponcer_id'];?>" name="txtidline7" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line8 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline8 = @$rowline7['sponcer_id'];
                                            $selectline8 = "SELECT * from user
                                                                    WHERE id='$v_id_upline8'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline8  = mysqli_query($connect,$selectline8);
                                            $rowline8 = $queryline8->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline8['sponcer_id'];?>" name="txtidline8" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line9 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline9 = @$rowline8['sponcer_id'];
                                            $selectline9 = "SELECT * from user
                                                                    WHERE id='$v_id_upline9'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline9  = mysqli_query($connect,$selectline9);
                                            $rowline9 = $queryline9->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline9['sponcer_id'];?>" name="txtidline9" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line10 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline10 = @$rowline9['sponcer_id'];
                                            $selectline10 = "SELECT * from user
                                                                    WHERE id='$v_id_upline10'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline10  = mysqli_query($connect,$selectline10);
                                            $rowline10 = $queryline10->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline10['sponcer_id'];?>" name="txtidline10" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line11 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline11 = @$rowline10['sponcer_id'];
                                            $selectline11 = "SELECT * from user
                                                                    WHERE id='$v_id_upline11'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline11  = mysqli_query($connect,$selectline11);
                                            $rowline11 = $queryline11->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline11['sponcer_id'];?>" name="txtidline11" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line12 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline12 = @$rowline11['sponcer_id'];
                                            $selectline12 = "SELECT * from user
                                                                    WHERE id='$v_id_upline12'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline12  = mysqli_query($connect,$selectline12);
                                            $rowline12 = $queryline12->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline12['sponcer_id'];?>" name="txtidline12" >
                                        
                                    </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3 hidden" >Up-Line13 :</label>
                                    <div class="col-sm-9">
                                        <?php
                                            $v_id_upline13 = @$rowline12['sponcer_id'];
                                            $selectline13 = "SELECT * from user
                                                                    WHERE id='$v_id_upline13'
                                                                    ORDER BY id DESC LIMIT 1
                                                                    ";
                                            $queryline13  = mysqli_query($connect,$selectline13);
                                            $rowline13 = $queryline13->fetch_assoc();
                                        ?>
                                        <input readonly type="hidden" class="form-control" value="<?php echo @$rowline13['sponcer_id'];?>" name="txtidline13" >
                                        
                                    </div>
                        </div>
                        
<!-- end bonus network 13 line  -->
                        
                    </form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>
