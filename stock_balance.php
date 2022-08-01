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
                        <h3 class="text-primary">Stock Balance</h3>
                      
                
                  
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>No</th>
                                            <th>Product_Item</th>
                                            <th>Qty_In</th>
                                            <th>Oty_Out</th>
                                            <th>Balance</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            $sql = "SELECT * FROM item
                                                              ORDER BY ite_code ASC
                                                              ";  
                                            $result = $connect->query($sql);

                                            $i=1;
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              
                                              $v1 =$i++;
                                              $v_item_id =$row["ite_id"];
                                              $v_item_code =$row["ite_code"];
                                              $v_item_name =$row["ite_name"];

                                              // sum qty in
                                              $v_item_id =$row["ite_id"];
                                              $sql_in = "SELECT SUM(sin_qty_in) AS SUMQTYIN FROM stock_in
                                                                WHERE sin_item_id=$v_item_id
                                                                ";  
                                              $result_in = $connect->query($sql_in);
                                              $row_in = $result_in->fetch_assoc();
                                              $sumqtyin =$row_in['SUMQTYIN'];

                                              // sum qty out
                                              $v_item_id =$row["ite_id"];
                                              $sql_out = "SELECT SUM(payd_qty) AS SUMQTYOUT FROM payment_detail
                                                                WHERE payd_item_id=$v_item_id
                                                                ";  
                                              $result_out = $connect->query($sql_out);
                                              $row_out = $result_out->fetch_assoc();
                                              $sumqtyout =$row_out['SUMQTYOUT'];

                                              // balance 
                                              $qty_balance =$sumqtyin-$sumqtyout;

                                          ?>
                                          <tr>
                                            <td><?php echo $v1;?></td>
                                            <td>
                                              <?php echo $v_item_code;?>
                                              <?php echo $v_item_name;?>
                                            </td>
                                            <td>
                                              <?php
                                                echo $sumqtyin;
                                              ?>
                                            </td>
                                            <td>
                                              <?php
                                                echo $sumqtyout;
                                              ?>
                                            </td>
                                            <td>
                                              <?php
                                                echo $qty_balance;
                                              ?>
                                            </td>
                                            <td align = "center">
                                              
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