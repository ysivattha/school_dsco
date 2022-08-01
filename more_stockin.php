<?php include'config/db_connect.php';

$time = date("Y-m-d h:i:A");
    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from stockin where in_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
  	if(!empty($_POST["id"])){
  			$id = $_POST["id"];
  			$date      = $_POST["date"];
		    $code      = $_POST["code"];
		    $product   = $_POST["product"];
		    $qauntity  = $_POST["balance"];
		  	$more      = $_POST["more"];
		  	$left      = $_POST["left"];
		    $price     = $_POST["price"];
		    $amount    = $_POST["amount"];
		    $payamount = $_POST["payamount"];
		    $rest      = $_POST["rest"];
		    $expire    = $_POST["expire"];
		    $vender    = $_POST["vender"];
		    $employee  = $_POST["employee"];
		    $note      = $_POST["note"];

        $sql = "INSERT INTO stockin_report
              (date_in,code_in,pro_id,qty_in,qty_left,qty_addmore ,price ,amount,payamount,rest_amount,expire_date,note_reportin,vender_id,emp_id) 
          VALUES 
              ('$date', '$code', '$product', '$qauntity', '$left', '$more', '$price', '$amount', '$payamount', '$rest', '$expire', '$note', '$vender', '$employee')";
         $result = mysqli_query($connect, $sql);

      if ($result){
        $sql = "UPDATE stockin SET qty_in = qty_in + '$more'
							  ,	amount = 	amount  + '$amount'
                              , payamount = payamount + '$payamount'
                              , rest_amount = rest_amount + '$rest'
                                 WHERE 
                           pro_id = '$product'" ;
        mysqli_query($connect, $sql);
        header("location:stockin.php?message=update");
          echo "success";
      }
      else{
        echo "error";
      }	
	}
?>
<?php include 'header.php';?>
	<div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
              
                   	<div class = "panel-body">
                    <h2 class="text-primary">
                      Add More To Stock
                    </h2>
                    <hr>
						<div class="col-md-12 well details">
						<form method="post" enctype="multipart/form-data" action="">     
                          <div class="form-group col-xs-6">
                          	 <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                            <label for ="">Date:</label>                                          
                            <input class="form-control"  readonly required name="date" type="text" placeholder="Date add to Stock" value = "<?php echo $time;?>">          
                          </div>
                          <div class="form-group col-xs-6">
                           
                            <label for ="">code:</label>                                          
                            <input class="form-control"   readonly required name="code" type="text" placeholder="code" value = "<?php echo $row["code_in"]?>">  
                          </div>
                          <div class = "from-group col-xs-6">
                            <label for = "">Product:</label>
                            <select class = "form-control" name = "product">
                            <option value="<?php echo $row['pro_id']; ?>">
          							  			<?php 
          									  		$code = $row['pro_id'];
          									  		$viewcate = mysqli_query($connect,"SELECT * FROM product WHERE pro_id = '$code'");
          									  		$display = mysqli_fetch_assoc($viewcate);
          									  		echo $display['name_en']." :: ".$display['name_kh'];
          							  			 ?>
          							       </option>
                                        <!-- <option value="">Select Product</option>
                                            <?php
                                              $product = mysqli_query($connect,"SELECT * FROM product");
                                              while ($row1 = mysqli_fetch_assoc($product)) { ?>
                                              <option value="<?php echo $row1['pro_id']; ?>"><?php echo $row1['name_en'];?> :: <?php echo $row1['name_kh'];?></option>
                                            <?php 
                                            }
                                             ?>    -->
                            </select>
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Old_qty</label>                                          
                            <input class="form-control"   readonly required name="qauntity" type="number" placeholder="Qauntity" value = "<?php echo $row["qty_in"]?>">       
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Qty_left</label>                                          
                            <input class="form-control"   readonly required name="left" type="number" placeholder="Qty_left" value = "<?php echo $row["qty_left"]?>">       
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Balance</label>                                          
                            <input class="form-control"   readonly required name="balance" type="number" placeholder="" value = "<?php $in = $row['qty_in']; $out = $row['qty_left']; $balance =  $in - $out ;
                                 echo $balance?>">       
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Add more</label>                                          
                            <input class="form-control quantity"   required name="more" type="text" placeholder="Add More" >
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Cost:</label>                                          
                            <input class="form-control price"   readonly required name="price" type="text" placeholder="Price" value = "<?php echo $row["price"]?>">         
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Amount:</label>                                          
                            <input class="form-control amount"   required readonly name="amount" type="text" placeholder="Amount" value = "0">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Pay Amount:</label>                                          
                            <input class="form-control pay"   required name="payamount" type="text" placeholder="Pay Amount">           
                          </div>
                          <div class = "form-group col-xs-6">
                            <label for = "">Rest:</label>                                     
                            <input class="form-control rest"   required readonly name="rest" type="text" placeholder="Rest">       
                          </div>
                          <div class = "form-group col-xs-6">
                            <label for = "">Expire Date:</label>                                     
                             <input class="form-control"    required name="expire" type="text" placeholder="Expire Date" > 
                          </div>
                          <div class = "from-group col-xs-6">
                              <label for = "">Vender:</label>
                              <select class = "form-control" name = "vender">
                                <?php
                                  $select1 = "select * from vender";
                                  $query1  = mysqli_query($connect,$select1);
                                  while($row1 = $query1->fetch_assoc()):
                                    $selected=($row['vender_id']==$row1['vender_id']?"selected":"");
                                    ?>
                                    <option <?= $selected; ?> value="<?= $row1['vender_id']; ?>"><?= $row1['vendername_en']; ?> <?php echo $row1['vendername_kh'];?></option>
                                  <?php endwhile; ?>  
                              </select>
                          </div>
                          <div class = "from-group col-xs-6">
                              <label for = "">Employee:</label>
                                <select class = "form-control" name = "employee">
                                <?php
                                  $select1 = "select * from employee";
                                  $query1  = mysqli_query($connect,$select1);
                                  while($row1 = $query1->fetch_assoc()):
                                    $selected=($row['emp_id']==$row1['emp_id']?"selected":"");
                                    ?>
                                    <option <?= $selected; ?> value="<?= $row1['emp_id']; ?>"><?= $row1['name_khmer']; ?> <?php echo $row1['name_english'];?></option>
                                  <?php endwhile; ?>
                               </select>
                          </div>
                          <div class="form-group col-xs-12">
                            <label for="note">Note:</label>
                             <textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["note_in"]?></textarea>
                          </div>
								<div class="form-group col-xs-6">
									<button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
                  <a href="stockin.php" class="btn btn-danger">Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include 'footer.php';?>