<?php include'config/db_connect.php';

  $sql = "SELECT * FROM food_stockin A INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id"; 
  $result = $connect->query($sql);
  
  if(isset($_POST["btnadd"])){
    $date      = $_POST["date"];
    $code      = $_POST["code"];
    $product   = $_POST["product"];
    $qauntity  = $_POST["qauntity"];
    $price     = $_POST["price"];
    $amount    = $_POST["amount"];
    $payamount = $_POST["payamount"];
    $rest      = $_POST["rest"];
    $expire    = $_POST["expire"];
    $vender    = $_POST["vender"];
    $employee  = $_POST["employee"];
    $note      = $_POST["note"];
    $qty_left = '0';

    $sql = "INSERT INTO food_stockin 
              (date_in,fcode_in,pro_id,qty_in,qty_left,price,amount,payamount,rest_amount,expire_date,note_fin,vender_id,emp_id) 
          VALUES 
              ('$date', '$code', '$product', '$qauntity', '$qty_left', '$price', '$amount', '$payamount', '$rest', '$expire', '$note', '$vender', '$employee')";
       $result = mysqli_query($connect, $sql);
       header('location:food_stockin.php?message=success');
     
}
if(isset($_GET["id"])){
    $id = $_GET["id"];

     $sql = "DELETE FROM food_stockin WHERE fin_id = '$id'";
     $result = mysqli_query($connect, $sql);
     header("location:food_stockin.php?message=delete");
     
} 

?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock</li>
        <li class="active">Items stock in</li>
      </ol>
          <div class="row">
                <div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add To Stock</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update To Stock</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success delete from Stock</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Food To Stock</button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add To Stock</h4>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12 details">
                        <form method="post" enctype="multipart/form-data" action="">     
                          <div class="form-group col-xs-12">
                            <label for ="">Date:</label>                                          
                            <input class="form-control"  readonly required name="date" type="text" placeholder="Date add to Stock" id="datepicker">          
                          </div>
                          <div class = "from-group col-xs-6">
                            <label for = "">Code:</label>
                            <select class = "form-control" name = "code">
                              <option value="">Select Code</option>
                                  <?php
                                    $product = mysqli_query($connect,"SELECT * FROM product Where cate_id = 1 ");
                                    while ($row1 = mysqli_fetch_assoc($product)) { ?>
                                    <option value="<?php echo $row1['code']; ?>"><?php echo $row1['code'];?> :: <?php echo $row1['name_kh'];?></option>
                                  <?php 
                                  }
                                   ?>   
                            </select>
                          </div>
                          <div class = "from-group col-xs-6">
                            <label for = "">Product:</label>
                            <select class = "form-control" name = "product">
                              <option value="">Select Product</option>
                                  <?php
                                    $product = mysqli_query($connect,"SELECT * FROM product where cate_id = 1");
                                    while ($row1 = mysqli_fetch_assoc($product)) { ?>
                                    <option value="<?php echo $row1['pro_id']; ?>"><?php echo $row1['name_en'];?> :: <?php echo $row1['name_kh'];?></option>
                                  <?php 
                                  }
                                   ?>   
                            </select>
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Qauntity</label>                                          
                            <input class="form-control quantity"   required name="qauntity" type="number" placeholder="Qauntity">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Price:</label>                                          
                            <input class="form-control price"   required name="price" type="text" placeholder="Price">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Amount:</label>                                          
                            <input class="form-control amount"   required readonly name="amount" type="number" placeholder="Amount">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Pay Amount:</label>                                          
                            <input class="form-control pay"   required name="payamount" type="text" placeholder="Pay Amount">    
                          </div>
                          <div class = "form-group col-xs-6">
                            <label for = "">Rest:</label>                                     
                            <input class="form-control rest"   required readonly name="rest" type="number" placeholder="Rest"> 
                          </div>
                          <div class = "form-group col-xs-6">
                            <label for = "">Expire Date:</label>                                     
                             <input class="form-control"   required name="expire" type="text" placeholder="Expire Date" id="datepicker1"> 
                          </div>
                          <div class = "from-group col-xs-6">
                              <label for = "">Vender:</label>
                              <select class = "form-control" name = "vender">
                                <option value="">Select Product</option>
                                    <?php
                                      $vender = mysqli_query($connect,"SELECT * FROM vender");
                                      while ($row2 = mysqli_fetch_assoc($vender)) { ?>
                                      <option value="<?php echo $row2['vender_id']; ?>"><?php echo $row2['vendername_en'];?> :: <?php echo $row2['vendername_kh'];?></option>
                                    <?php 
                                    }
                                     ?>   
                              </select>
                          </div>
                          <div class = "from-group col-xs-6">
                              <label for = "">Employee:</label>
                                <select class = "form-control" name = "employee">
                                   <option value="">Select Employee</option>
                                    <?php
                                       $employee = mysqli_query($connect,"SELECT * FROM employee");
                                        while ($row3 = mysqli_fetch_assoc($employee)) { ?>
                                       <option value="<?php echo $row3['emp_id']; ?>"><?php echo $row3['name_khmer'];?> :: <?php echo $row3['name_english'];?></option>
                                    <?php 
                                    }
                                     ?>   
                               </select>
                          </div>
                          <div class="form-group col-xs-12">
                            <label for="note">Note:</label>
                             <textarea class="form-control" rows="4" id="note" name = "note"></textarea>
                          </div>
                          <div class="form-group col-xs-6">
                            <button type="submit" name = "btnadd" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Save changes</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                          </div> 
                        </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                  </div>
                </div>
                </div>
                <a href="food_stock.php" class="btn btn-sm btn-danger btn-flat pull-right"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Date</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Name(kh)</th>
                                            <th>Quintity</th>
                                            <th>Packet</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Pay Amount</th>
                                            <th>Rest</th>
                                            <th>Expire Date</th>
                                            <th>Note</th>
                                            <th>Vender</th>
                                            <th>Employee</th>
                                            <th>Add More</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v1=$row["date_in"];
                                              $v2=$row["fcode_in"];
                                              $v3=$row["name_en"];
                                              $v14=$row["name_kh"];
                                              $v4=$row["qty_in"];
                                              $v13=$row["paket"];
                                              $v5=$row["price"];
                                              $v6=$row["amount"];
                                              $v7=$row["payamount"];
                                              $v8=$row["rest_amount"];
                                              $v9=$row["expire_date"];
                                              $v10=$row["note_fin"];
                                              $v11=$row["vendername_en"];
                                              $v12=$row["name_khmer"];
                                          ?>

                                          <tr>
                                            <td><?php echo $v1;?></td> 
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v14;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v13;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>
                                            <td><?php echo $v8;?></td>
                                            <td><?php echo $v9;?></td>
                                            <td><?php echo $v10;?></td>
                                            <td><?php echo $v11;?></td>
                                            <td><?php echo $v12;?></td>
                                            <td align = "center">
                                            <a href="more_food_stockin.php?id=<?php echo $row['fin_id']; ?>" class="btn btn-primary"><i class="fa fa-plus-square-o"></i></a>
                                            </td>
                                            <td align = "center">
                                            <a href="edit_food_stockin.php?id=<?php echo $row['fin_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick = "return confirm('Are you sure to delete ?');" href="food_stockin.php?id=<?php echo $row['fin_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>

                                          </tr> 
                                          <?php
                                            }  
                                          ?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            
          <?php include 'footer.php';?>