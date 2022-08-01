<?php include'config/db_connect.php';

  $sql = "SELECT * FROM food_stockout";
  $result = $connect->query($sql);
  

?>
<?php include 'header.php';?>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="">Stock Food</li>
        <li class="active">Food stock Out</li>
      </ol>
          <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          <a href="food_stock.php" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>Invoice_No</th>
                                            <th>Code</th>
                                            <th>Name(En)</th>
                                            <th>Name(Kh)</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>VAT</th>
                                            <th>Date</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                             
                                              $v2=$row["fo_invoice_no"];
                                              $v3=$row["fo_code"];
                                              $v4=$row["fo_name_e"];
                                              $v5=$row["fo_name_k"];
                                              $v6=$row["fo_qtyout"];
                                              $v7=$row["fo_price"];
                                              $v8=$row["fo_amount"];
                                              $v9=$row["fo_vat"];
                                              $v10=$row["fo_date"];                                              
                                          ?>
                                          <tr>
                                             
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>
                                            <td><?php echo $v8;?></td>
                                            <td><?php echo $v9;?></td>
                                            <td><?php echo $v10;?></td>
                                          
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