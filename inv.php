<?php
include'config/db_connect.php';

	$time = date("m/d/Y");

	$ex = "SELECT * FROM exchange";
	$reex = $connect->query($ex);
	$do = $reex->fetch_assoc();
	$do_luy = $do['exchange'];

	$v = "SELECT * FROM vat";
	$rev = $connect->query($v);
	$a = $rev->fetch_assoc();
	$pun = $a['vat'];
?>
<?php include 'header.php';?>
<div class="panel">
    <div class="panel-heading">
		
    </div>
    <div class="panel-body">
		<img class = "img-responsive" src = "img/2.png">
	<form action="incomming.php" method="post">
			<div class = "row">
			<!-- </br> -->
			<center><img src = "img/inv1.png" class = "img-responsive"></center>
			<div class="form-group col-xs-6 col-xs-offset-2">
		    <label for="">អតិថិជន:​ ទូទៅ</label>
		    <input type="hidden"  name = "cus" value = "<?php echo $_GET['cus']?>">
		  </div>
		  <div class="form-group col-xs-4">
		    <label for="">អ្នកលក់:  <?php echo $show['username']?></label>
		    <input type="hidden"  name = "seller "value = "<?php echo $show['username']?>">
		  </div>
		  <div class="form-group col-xs-6 col-xs-offset-2">
		    <label for="pwd">វិកយ័បត្រ័:  <?php echo $_GET['invoice']?></label>
		    <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
		    <input type="hidden" name="cash" value="<?php echo $_GET['cash']; ?>" />
		  </div>
		   <div class="form-group col-xs-4">
		    <label for="pwd">ថ្ងៃខែឆ្នាំ: <?php echo $time?></label>
		    <input type="hidden" class="form-control" name = "date" value = "<?php echo $time?>">
		  </div>
		 <!--  <div class="form-group col-xs-6 col-xs-offset-2">
		    <label for="pwd">បង់ប្រាក់:</label>
		    <select name = "pay" style = "width:20%">
		    	<option value="1">Not yet Pay</option>
		    	<option value="2">Paid</option>
		    </select>
		    <input type = "hidden"  value="<?php echo $_GET['pay']?>">
		  
		  </div> -->
		</div>
    </div>
    <div class="panel panel-danger">
			<div class="panel-heading">	
						
						<label>Barcode <i class="fa fa-barcode" aria-hidden="true"></i> : </label>
			      <!--    	<select name = "product" class="form-control select2" style = "width:40%" >
					        <option value="">Select Product</option>
                                  <?php
                                    $product = mysqli_query($connect,"SELECT * FROM product INNER JOIN stockin ON product.pro_id = stockin.pro_id");
                                    while ($row1 = mysqli_fetch_assoc($product))// { ?>
                                    <option value="<?php echo $row1['code']; ?>"><?php echo $row1['code'];?> <?php echo $row1['ref'];?> - <?php echo $row1['name_en'];?> - <?php echo $row1['name_kh'];?></option>
                                  <?php 
                                 // }
                                   ?>

					     </select> -->
					     <input type="text" class = "form-control" name="product" style = "width:50%" autofocus> 
					    <!--  <label>Discount<i class="fa fa-percent" aria-hidden="true"></i> : </label>
			         		<input type="text" class = "form-control" name="dis" style = "width:10%"> -->
			</div>
			<div class = "panel-body">
      		<div class = "row">
      			<div class = "col-md-1">
				<h6><b>Quantity:</b></h6>
			     </div>
			     <div class = "col-md-2">
				<input type="text" class = "form-control" name="qty" value="1"  placeholder="Qty" autocomplete="off" required>
			     </div>
			     <div class = "col-md-1">
				<h6><b>Discount:<i class="fa fa-percent" aria-hidden="true"></i></b></h6>
			     </div>
			     <div class = "col-md-2"><input type="text" name="discount" class = "form-control" value="" autocomplete="off"/>
			     </div>
			     <div class = "col-md-2">
			     	<Button type="submit" class="btn btn-danger"><i class="fa fa-plus-square" aria-hidden="true"></i> Add</button>
			     </div>
		     	</form>
      		</div>
			<hr style="border:2px solid #DD4B39">
			<div class="table-responsive">          
				  <table class="table">
				  	<thead>
					  <tr>
						<!-- <th><label>
						<?php 
						if( $_GET['pay'] == 1){
							echo '<span class="label label-danger">Not yet Pay</span>';
						}
						else{
							echo '<span class="label label-success">Paid</span>';
						}
						?></label> -->
						</th>
						<th></th>
						<th></th>
						<th></th>
						<!-- <th></th> -->
						<th></th>

					  </tr>
					</thead>
					<thead>
					  <tr>
						<th>កូដ</th>
						<th>Name</th>
						<th>ឈ្មោះទំនិញ</th>
						<th>ចំនួន</th>
						<th>តំលៃ</th>
						<th>សរុប</th>
						<th>បញ្ចុះតំលៃ</th>
						<!-- <th>VAT</th> -->
						<th>
						<i class="fa fa-cog fa-spin fa-2x fa-fw"></i>
						<span class="sr-only">Loading...</span>
						កែប្រែ
						</th>
					  </tr>
					</thead>
					 <tbody>
			    <?php 
			    	$id=$_GET['invoice'];
			    	
			    	$sql = "SELECT * FROM stockout WHERE invoice = '$id' ";	
					$result = $connect->query($sql);
					while($row = $result->fetch_assoc()) 
						{			
							$barcode=$row["code_out"];
							$name_en=$row["pro_nameen"];
							$name_kh=$row["pro_namekh"];
							$qty=$row["qty_out"];
							$price='$'.$row["price"];
							$dis = '$'.$row["discount"];
							$amount ='$'. $row['amount'];
							$vat = 	'$'. $row['vat']	;				
			    	?>
					      <tr>
					        <td><?php echo $barcode;?></td>
					        <td><?php echo $name_en;?></td>
					        <td><?php echo $name_kh;?></td>
					        <td><?php echo $qty;?></td>
					        <td><?php echo $price;?></td>
					        <td><?php echo $amount;?></td>
					        <td><?php echo $dis;?></td>
					        <!-- <td><?php echo $vat;?></td> -->
					        <td>
					        	<button type="button" class="btn btn-info " data-toggle="modal" data-target="#<?php echo $row['transaction_id']?>"><i class="fa fa-edit"></i></button>

								<!-- Modal -->
								<div id="<?php echo $row['transaction_id']?>" class="modal fade" role="dialog">
								  <div class="modal-dialog">

								    <!-- Modal content-->
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal">&times;</button>
								        <h4 class="modal-title">Code : <?php echo $row['code_out']?></h4>
								      </div>

								      <div class="modal-body">
								       		<form action="edit_price.php" method = "post">
								       			<div class="form-group col-sm-6">
								       				<label for="">Old Price :</label>
								       				<input type="text" name = "oldprice" class="form-control" value="<?php echo $price?>">
								       			</div>
								       			<div class="form-group col-sm-6">
								       				<label for="">New price :</label>
								       				<input type="text" name = "newprice" class="form-control">
								       			</div>
								       			<div class="form-group col-sm-6">
								       				<label for="">Discount:</label>
								       				<input type="text" name = "dis" class="form-control" placeholder="%">
								       			</div>
								       			<div class="form-group">
								       				<input type="hidden" name = "id" class="form-control" value="<?php echo $row['transaction_id']?>">
								       				<input type="hidden" name = "invoice" class="form-control" value="<?php echo $_GET['invoice']; ?>">
								       				<input type="hidden" name = "cash" class="form-control" value="<?php echo $_GET['cash']; ?>">
								       				<input type="hidden" name = "qty" class="form-control" value="<?php echo $row['qty_out'];?>">
								       				<input type="hidden" name = "code" class="form-control" value="<?php echo $row['code_out'];?>">
								       			</div>
								       			<div class="form-group col-sm-12">
								       				<button type = "submit" class = "btn btn-success ">Change</button>
								       				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
								       			</div>
								       		</form>
								      </div>
								      <div class="modal-footer">
								      
								      </div>
								    </div>

								  </div>
								</div>
					        	<a href="delete_item.php?id=<?php echo $row['transaction_id'];?>&invoice=<?php echo $_GET['invoice']; ?>&cash=<?php echo $_GET['cash']; ?>&qty=<?php echo $row['qty_out'];?>&code=<?php echo $row['code_out'];?>" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
							</td>
					      </tr>
			    	  <?php
			  		}
			      ?>
			    </tbody>
			    <tbody>
			<tfoot>
    		<tr>   
    		    <td></td>
    		    <td></td>
    		    <td></td> 
    		    <td><label><b>សរុបជា ($) :</b></label></td>
    		    <td>
    		    	<td><strong style="font-size: 15px; color: #222222;">
				<?php
				$id=$_GET['invoice'];
				$sum= "SELECT sum(amount) FROM stockout WHERE invoice = '$id'";
				$result1 = $connect->query($sum);
				for($i=0; $row1 = $result1->fetch_assoc(); $i++){
				$subtotal=$row1['sum(amount)'];
				echo $subtotal. ' $ ';
				}
				?>
				</strong></td>
    		    </td>		   
    			<td></td>
    		</tr>
    		<tr>   
    		    <td></td>
    		    <td></td>
    		    <td></td> 
    		    <td><label><b>សរុបជា (៛) :</b></label></td>
    		    <td>
    		    	<td><strong style="font-size: 15px; color: #222222;">
				<?php
				$id=$_GET['invoice'];
				$sum= "SELECT sum(amount) FROM stockout WHERE invoice = '$id'";
				$result1 = $connect->query($sum);
				for($i=0; $row1 = $result1->fetch_assoc(); $i++){
				$subtotal=$row1['sum(amount)'];
				$riel = $subtotal * $do_luy;
				echo $riel. ' ៛ ';
				}
				?>
				</strong></td>
    		    </td>

    			<td>
  				 <!-- <a rel="facebox" href="check_out.php?pt=<?php //echo $_GET['id']?>&invoice=<?php //echo $_GET['invoice']?>&total=<?php //echo $subtotal;?>&totalk=<?php //echo $riel;?>" class = "btn btn-success">Sale Now!</a>
    				<input type="submit" class="btn btn-info" name="skip" value="Skip">-->
    			</td>
    		</tr>
    		<tr>   
    		    <td></td>
    		    <td></td>
    		    <td></td> 
    		    <td><label><b>បញ្ចុះតំលៃសរុប:</b></label></td>
    		    <td>
    		    	<td><strong style="font-size: 15px; color: #222222;">
				<?php
				$id=$_GET['invoice'];
				$sum= "SELECT sum(discount) FROM stockout WHERE invoice = '$id'";
				$result1 = $connect->query($sum);
				for($i=0; $row1 = $result1->fetch_assoc(); $i++){
				$disc=$row1['sum(discount)'];
				echo $disc. ' $ ';
				}
				?>
				</strong></td>
    		    </td>

    			<td>
    			</td> 
    		</tr>
    		<!-- <tr>    -->
    		    <!-- <td></td>
    		    <td></td>
    		    <td></td> 
    		    <td><label><b>VAT:</b></label></td>
    		    <td>
    		    	<td><strong style="font-size: 12px; color: #222222;"> -->
				<?php
				// $id=$_GET['invoice'];
				// $sum= "SELECT sum(amount) FROM stockout WHERE invoice = '$id'";
				// $result1 = $connect->query($sum);
				// for($i=0; $row1 = $result1->fetch_assoc(); $i++){
				// $subtotal=$row1['sum(amount)'];
				// $vattotal = $subtotal * $pun;
				// echo $vattotal. ' $ ';
				// }
				?>
				<!-- </strong></td> -->
    		    <!-- </td> -->

    			<!-- <td> -->
    			<!-- </td>  -->
    		<!-- </tr> -->
    		</tfoot>
			    </tbody>
				  </table>
				  </div>
			</div>
			<!-- <div class = "panel-footer"> -->
			<div class = "row">
				<div class = "col-md-2 pull-right">
				<a href="save_sale.php?cash=<?php echo $_GET['cash']?>&invoice=<?php echo $_GET['invoice']?>&total=<?php echo $subtotal;?>&totalk=<?php echo $riel;?>&cashier=<?php echo $show['username'];?>&date=<?php echo $time;?>&vat=<?php echo $vattotal ?>" class = "btn btn-primary btn-lg"><i class="fa fa-money" aria-hidden="true"></i> Preview</a>
			</div>
		</div>
		</br>
			</div>
		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
      </div>
</div>
<?php include 'footer.php';?>