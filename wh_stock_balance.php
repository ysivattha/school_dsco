<?php include'config/db_connect.php'; 
  $sql = "SELECT *,SUM(whsi_qty_in) AS total_qty_in FROM product AS A 
                          LEFT JOIN tbl_wh_stock_in AS B ON A.pro_id=B.whsi_product_code 
                          GROUP BY B.whsi_product_code
                            ";  
  $result = $connect->query($sql);
  

?>
<?php include 'header.php';?>
          <div class="row">
                
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <h2 class="text-primary"> Stock Balance</h2>
                            <hr>
                            

                
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>No</th>
                                            <th>Photo</th>
                                            <th>Code</th>
                                            <th>Ref_Name</th>
                                            <th>Name(Kh)</th>
                                            <th>Qty In</th>
                                            <th>Qty Out</th>
                                            <th>Qty Adjust</th>    
                                            <th>Balance</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1;
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v1=$i;
                                              $v2=$row["code"];
                                              $v3=$row["ref"];
                                              $v4=$row["name_kh"];
                                             
                                              
                                              
                                          ?>
                                          <tr>
                                            <td><?php echo $v1;?></td> 
                                            <td><img src="img/product/<?= $row['photo'] ?>" height="50px"/></td>
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>

                                            <td>

                                              <?php $v_total_sum_qty_stockin =($row['total_qty_in'])?($row['total_qty_in']):("0")  ?>
                                              <?php echo $v_total_sum_qty_stockin ;?>

                                            </td>
                                            <td>

                                              <?php 
                                                $v_out_id = $row['pro_id']; ;
                                                $get_qty_out = $connect->query("SELECT SUM(whso_qty_out) AS total_qty_out FROM  tbl_wh_stock_out WHERE whso_product_code='$v_out_id'");
                                                $row_out = mysqli_fetch_assoc($get_qty_out);
                                                
                                                $v_total_sum_qty_stockout =($row_out['total_qty_out'])?($row_out['total_qty_out']):("0") ; 
                                                echo $v_total_sum_qty_stockout ;
                                              ?>

                                            </td>
                                            <td>
                                              <?php 
                                                $v_add_id = $row['pro_id']; ;
                                                $get_qty_add = $connect->query("SELECT SUM(whsa_qty_add) AS total_qty_add FROM  tbl_wh_stock_adjust WHERE whsa_product_code='$v_add_id'");
                                                $row_add = mysqli_fetch_assoc($get_qty_add);
                                                $v_total_sum_qty_add =($row_add['total_qty_add'])?($row_add['total_qty_add']):("0") ; 

                                                $v_minus_id = $row['pro_id']; ;
                                                $get_qty_minus = $connect->query("SELECT SUM(whsa_qty_minus) AS total_qty_minus FROM  tbl_wh_stock_adjust WHERE whsa_product_code='$v_minus_id'");
                                                $row_minus = mysqli_fetch_assoc($get_qty_minus);
                                                $v_total_sum_qty_minus =($row_minus['total_qty_minus'])?($row_minus['total_qty_minus']):("0") ; 

                                                $v_qty_adjust=$v_total_sum_qty_add-$v_total_sum_qty_minus;
                                                echo @$v_qty_adjust;
                                              ?>

                                            </td>
                                            <td>
                                                <?php echo $v_total_sum_qty_stockin-$v_total_sum_qty_stockout+@$v_qty_adjust ?>
                                            </td>

                                            
                                            <td align = "center">
                                            
                                            </td>
                                          </tr> 
                                          <?php
                                                $i++;
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