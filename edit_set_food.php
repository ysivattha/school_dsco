<?php include'config/db_connect.php';

    if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from set_food where set_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}	
	if(!empty($_POST["id"])){
			$id = $_POST["id"];
			$food = $_POST["food"];
		    $item = $_POST["item"];
		    $unit = $_POST["unit"];
		    $qauntity = $_POST["qauntity"];
		    $price = $_POST["price"];
		    $amount = $_POST["amount"];
		    $snote = $_POST["note"];

			$sql = "UPDATE set_food SET code = '$item'
									, unit 	  = '$unit' 
									, qty  	  = '$qauntity'
									, price   = '$price'
									, amount = '$amount'
									, main_code  = '$food'
									, snote    = '$snote'
												WHERE
										   set_id = '$id'";
			mysqli_query($connect, $sql);
			header("location:set_food1.php?message=update");
	}

?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock Food</li>
        <li class="active">Set Food</li>
      </ol>
          <h3>កំណត់មុខម្ហូប​កាត់ស្តុក</h3>
          <form class =  "details" method="post" enctype="multipart/form-data" action="">     
                         <div class = "form-group col-xs-6">
                         <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                          <label for = "">Food(មុខម្ហូប):</label>
                            <select class = "form-control" name = "food" required >
                              <option value="">Select item</option>
                                  <?php
                                    $product = mysqli_query($connect,"SELECT * FROM stockin A INNER JOIN product B ON A.pro_id = B.pro_id WHERE B.cate_id = 1 ");
                                    while ($row1 = mysqli_fetch_assoc($product)) { ?>
                                    <option value="<?php echo $row1['code_in']; ?>"><?php echo $row1['code_in']; ?>-<?php echo $row1['name_en'];?> - <?php echo $row1['name_kh'];?></option>
                                  <?php 
                                  }
                                   ?>   
                            </select>
                          </div>
                          <div class = "form-group col-xs-6">
                            <label for = "">Items(គ្រឿងផ្សំ):</label>
                            <select class = "form-control" name = "item" required >
                              <option value="">Select item</option>
                                  <?php
                                    $product = mysqli_query($connect,"SELECT * FROM food_stockin A INNER JOIN product B ON A.pro_id = B.pro_id  ");
                                    while ($row1 = mysqli_fetch_assoc($product)) { ?>
                                    <option value="<?php echo $row1['fcode_in']; ?>"><?php echo $row1['fcode_in']; ?>-<?php echo $row1['name_en'];?> - <?php echo $row1['name_kh'];?></option>
                                  <?php 
                                  }
                                   ?>   
                            </select>
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Unit(ខ្នាត):</label>                                          
                            <input class="form-control"   required name="unit" type="text" placeholder="Unit" value = "<?php echo $row["unit"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Qauntity(ចំនួន):</label>                                          
                            <input class="form-control quantity"   min=1 required name="qauntity" type="text" placeholder="Qauntity" value = "<?php echo $row["qty"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Price(តំលៃរាយ):</label>                                          
                            <input class="form-control price"   required name="price" type="text" placeholder="Price" value = "<?php echo $row["price"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Amount(សរុប):</label>                                          
                            <input class="form-control amount"   required  name="amount"  type="text" placeholder="Amount" value = "<?php echo $row["amount"]?>">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for="note">Note(ចំណាំ):</label>
                             <textarea class="form-control" rows="4" id="note" name = "note"><?php echo $row["snote"]?></textarea>
                          </div>
                          <div class="form-group col-xs-12">
                           <button type="submit" value = "update" class="btn btn-primary"><i class="fa fa-edit fa-fw"></i>Update</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                          </div> 
                        </form>
<?php include 'footer.php';?>