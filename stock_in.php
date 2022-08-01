<?php include'config/db_connect.php'; 
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

    
  
    if(isset($_GET["del_id"])){
    $id = $_GET["del_id"];
      
    $sql = "DELETE FROM stock_in WHERE sin_id = '$id'" ;
    $result = mysqli_query($connect, $sql);
    header("location: stock_in.php?message=delete");  
} 
?>

<?php include 'header.php';?>
          <div class="row">
            <div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update Data</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete Data</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <h3 class="text-primary">Stock In</h3>
                        <a href="stock_in_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New </a>
				       
                
                  <br><br>
                  <form class="form-inline" method = "post" action="">
                    <div class="form-group">
                      <input type="text" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="DATE START" class="form-control" name = "from" value="<?= @$_POST['from'] ?>" >
                    </div>
                    <div class="form-group">
                      <input type="text" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="DATE END" class="form-control" name = "to" value="<?= @$_POST['to'] ?>"> 
                    </div>
                    <div class="form-group">
                      <select class="form-control select2" name = "txt_product"> 
                        <option value="">=== Choose Item ===</option>
                        <?php 
                          $emp_search = $connect->query("SELECT * FROM item ORDER BY ite_name ASC");
                          while ($row_emp = mysqli_fetch_object($emp_search)) {
                            if($row_emp->ite_id == @$_POST['txt_product']){
                              echo '<option SELECTED value="'.$row_emp->ite_id.'">'.$row_emp->ite_code." ".$row_emp->ite_name.'</option>';
                            }else{
                              echo '<option value="'.$row_emp->ite_id.'">'.$row_emp->ite_code." ".$row_emp->ite_name.'</option>';
                            }
                          }
                         ?>
                      </select>
                    </div>
                    <button type="submit" name="search" class="btn btn-success"><i class="fa fa-search fa-fw"></i>Search</button>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Clear</a>
                  </form> 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Product_Item</th>
                                            <th>Qty_In</th>
                                            <th>Pirce_In</th>
                                            <th>Amount_In</th>
                                            <th>Pay</th>
                                            <th>Account_Payable</th>
                                            <th>Supply</th>
                                            <th>Note</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                          if(isset($_POST['search'])){
                                            $from = $_POST['from'];
                                            $to = $_POST['to'];
                                                  if(@$_POST['txt_product'] != ""
                                                    AND @$_POST['from'] != ""
                                                    ){
                                                    $v_product = @$_POST['txt_product'];
                                                    
                                                    $sql = "SELECT * FROM stock_in
                                                                      LEFT JOIN item ON item.ite_id=stock_in.sin_item_id
                                                                      LEFT JOIN vender ON vender.vender_id=stock_in.sin_supply_id
                                                                      WHERE sin_date BETWEEN '$from' AND '$to' 
                                                                      AND sin_item_id='$v_product'
                                                                      ORDER BY sin_date DESC      
                                                                      ";  
                                                    $result = $connect->query($sql);
                                                    echo "date+prodcut";
                                                  }
                                                  elseif(@$_POST['txt_product'] != ""){
                                                    $v_product = @$_POST['txt_product'];

                                                    $sql = "SELECT * FROM stock_in
                                                                      LEFT JOIN item ON item.ite_id=stock_in.sin_item_id
                                                                      LEFT JOIN vender ON vender.vender_id=stock_in.sin_supply_id
                                                                      WHERE sin_item_id='$v_product'
                                                                      ORDER BY sin_date DESC      
                                                                      ";  
                                                    $result = $connect->query($sql);
                                                    echo "prodcut";
                                                  }
                                                  elseif(@$_POST['from'] != ""){
                                                    $v_product = @$_POST['txt_product'];
                                                    
                                                    $sql = "SELECT * FROM stock_in
                                                                      LEFT JOIN item ON item.ite_id=stock_in.sin_item_id
                                                                      LEFT JOIN vender ON vender.vender_id=stock_in.sin_supply_id
                                                                      WHERE sin_date BETWEEN '$from' AND '$to'
                                                                      ORDER BY sin_date DESC      
                                                                      ";  
                                                    $result = $connect->query($sql);
                                                    echo "date";
                                                  }
                                                  else{
                                                    $month =date('m');
                                                    $year =date('Y');
                                                    $sql = "SELECT * FROM stock_in
                                                                      LEFT JOIN item ON item.ite_id=stock_in.sin_item_id
                                                                      LEFT JOIN vender ON vender.vender_id=stock_in.sin_supply_id
                                                                      WHERE MONTH(sin_date) ='$month'
                                                                      ORDER BY sin_date DESC      
                                                                      ";  
                                                    $result = $connect->query($sql);
                                                    echo "please, choose for serach";
                                                  }
                                          }else{
                                            $month =date('m');
                                            $year =date('Y');
                                            $sql = "SELECT * FROM stock_in
                                                              LEFT JOIN item ON item.ite_id=stock_in.sin_item_id
                                                              LEFT JOIN vender ON vender.vender_id=stock_in.sin_supply_id
                                                              WHERE MONTH(sin_date) ='$month'
                                                              ORDER BY sin_date DESC      
                                                              ";  
                                            $result = $connect->query($sql);
                                          }

                                            $i=1;
                                            $v_qty_in_total =0;
                                            $v_amount_in_total =0;
                                            $v_ap_total =0;
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v_qty_in_total +=$row["sin_qty_in"];
                                              $v_amount_in_total +=$row["sin_amount_in"];
                                              $v_ap_total +=$row["sin_ap"];

                                              $v1 =$i++;
                                              $v_date =$row["sin_date"];
                                              $v_item_code =$row["ite_code"];
                                              $v_item_name =$row["ite_name"];
                                              $v_qty_in =$row["sin_qty_in"];
                                              $v_price_in =$row["sin_price_in"];
                                              $v_amount_in =$row["sin_amount_in"];
                                              $v_pay =$row["sin_pay"];
                                              $v_ap =$row["sin_ap"];

                                              $v_supply_id =$row["vendername_en"];
                                              $v_note =$row["sin_note"];
                                          ?>
                                          <tr>
                                            <td><?php echo $v1;?></td> 
                                            <td>
                                              <?php
                                                if($v_date=="0000-00-00"){
                                                  echo '';
                                                }
                                                elseif($v_date==""){
                                                  echo '';
                                                }	
                                                else{
                                                  echo date('d-M-Y',strtotime($v_date));
                                                }
                                                
                                              ?>
                                            </td>
                                            <td>
                                              <?php echo $v_item_code;?>
                                              <?php echo $v_item_name;?>
                                            </td>
                                            <td><?php echo $v_qty_in;?></td>
                                            <td><?php echo $v_price_in;?></td>
                                            <td><?php echo $v_amount_in;?></td>
                                            <td><?php echo $v_pay;?></td>
                                            <td><?php echo $v_ap;?></td>
                                            <td><?php echo $v_supply_id;?></td>
                                            <td><?php echo $v_note;?></td>
                                            <td align = "center">
                                              <a href="stock_in_edit.php?edit_id=<?php echo $row['sin_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										                          <a onclick="return confirm('Are you sure to delete?');" href="stock_in.php?del_id=<?php echo $row['sin_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    
                                            </td>
                                          </tr> 
                                          <?php
                                            }  
                                          ?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Total:</th>
                                        <th>
                                          <?php
                                            echo "$v_qty_in_total";
                                          ?>
                                        </th>
                                        <th></th>
                                        <th>
                                          <?php
                                            echo "$v_amount_in_total";
                                          ?>
                                        </th>
                                        <th></th>
                                        <th>
                                          <?php
                                            echo "$v_ap_total";
                                          ?>
                                        </th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                      </tr>
                                    </tfoot>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
          <?php include 'footer.php';?>