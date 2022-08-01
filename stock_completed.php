<?php include 'config/db_connect.php';
    date_default_timezone_set("Asia/Bangkok");
    $today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
    $month = date('Y-m');
    
    if(isset($_GET["del_id"])){
     $id = $_GET["del_id"];

     $sql = "DELETE FROM truck WHERE tr_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:truck.php?message=delete");
     }
} 
?>
<style>
    .fixTableHead {
      overflow-y: auto;
      height: auto;
    }
    .fixTableHead thead th {
      position: sticky;
      top: -1;
      text-align: center;
    }
    table {
      border-collapse: collapse;        
      width: 100%;
    }
    th,
    td {
      padding: 8px 15px;
      border: 1px solid #a2a8a3;
      text-align: left;
    }
    th {
      background: #a2a8a3;
      
    }
    .divsubtable{
        padding-left: 30px;
    }
</style>
<?php include 'header.php';?>
<div class="row">
    <div class="col-xs-12">
        <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add truck</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update truck</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete truck</h4>';
                      echo '</div>';
                    }
                    ?>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
                
            <div class="panel-body">
                <div>
                <h4 class="text-primary">Stock Completed</h4>

                            <form class="form-inline" method = "post" action="">
                              <div class="col-sm-3"></div>
                              <div class="form-group">
                                <select class="form-control select2" name = "txt_customer"> 
                                  <option value="0">=== choose code ===</option>
                                  <?php 
                                    $emp_search = $connect->query("SELECT * FROM customer 
                                                                            ORDER BY cus_num_id ASC");
                                    while ($row_emp = mysqli_fetch_object($emp_search)) {
                                      if($row_emp->cus_id == @$_POST['txt_customer']){
                                        echo '<option SELECTED value="'.$row_emp->cus_id.'">'.$row_emp->cus_num_id.' :: '.$row_emp->cus_name.'</option>';
                                      }else{
                                        echo '<option value="'.$row_emp->cus_id.'">'.$row_emp->cus_num_id.' :: '.$row_emp->cus_name.'</option>';
                                      }
                                    }
                                   ?>
                                </select>
                              </div>
                              <button type="submit" name="search" class="btn btn-success">Search</button>
                              <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Clear</a>
                              </div>
                            </form> 
                </div>
                <div class="fixTableHead">
                    <table class="display nowrap" width="100%" cellspacing="0">
                        <thead>

                        </thead>
                        <tbody>
                                    <?php   
                                            if(isset($_POST['search'])){
                                                if($_POST['txt_customer'] != ""){
                                                    $v_customer =$_POST['txt_customer'];
                                                    $sql = "SELECT * FROM customer AS A
                                                    WHERE cus_id='$v_customer'
                                                    ORDER BY cus_num_id ASC
                                                                                ";
                                                    $result = mysqli_query($connect, $sql);
                                                }
                                            }else{
                                                $sql = "SELECT * FROM customer AS A
                                                                ORDER BY cus_num_id ASC
                                                                            ";
                                                $result = mysqli_query($connect, $sql);
                                            } 

                                        	$i= 1;
                                            $total=0;
											while($row = $result->fetch_assoc()) 
											{	

												$v_customer_id   =$row["cus_num_id"];
                                                $v_cus_id   =$row["cus_id"];
                                                
										?>
                                <tr>
                                    <td>
                                            <?php
                                                $v_cus_id   =$row["cus_id"];
                                                //echo $v_customer_id;
                                                $sql_cus = "SELECT COUNT(bit_id) AS countcus FROM  bill_item AS A
                                                                    LEFT JOIN bill AS BILL ON BILL.bi_id=A.bit_bill_id
                                                                    WHERE BILL.bi_customer='$v_cus_id'
                                                                            ";
                                                $result_cus = mysqli_query($connect, $sql_cus);
                                                $row_cus = $result_cus->fetch_assoc();
                                                $get_cus = $row_cus['countcus'];
                                                //echo $get_cus;
                                            ?>


                                            <?php
                                                if($get_cus > 0){
                                            ?>
                                                   Customer ID: <b> <?php echo $v_customer_id;?> </b>             
                                            <!-- loop item bill start -->
                                            <div class="divsubtable">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th>Completed</th>
                                                        <th>Bill_No</th>
                                                        <th>Cont.No</th>
                                                        <th>ETD</th>
                                                        <th>ETA</th>
                                                        <th>Destination</th>
                                                        <th>Qty_in</th>
                                                        <th class="text-danger">Qty_out</th>
                                                        <th>Qty_Bal.</th>
                                                        <th>GW</th>
                                                        <th>CBM</th>
                                                        <th>Package</th>
                                                        <th>Handing</th>
                                                        <th>Commodity</th>
                                                        <th>Customer</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php   
                                                            $v_name = "stock_completed";
                                                            $sql_bill = "SELECT * FROM bill AS A
                                                            LEFT JOIN bill_item AS BI ON BI.bit_bill_id=A.bi_id
                                                            LEFT JOIN destination AS DE ON DE.de_id=BI.bit_destination
                                                            LEFT JOIN package_type AS PA ON PA.pa_id=BI.bit_pack_type
                                                            LEFT JOIN customer AS CUS ON CUS.cus_id=A.bi_customer
                                                            WHERE bi_customer='$v_cus_id'
                                                            AND BI.bit_stock_completed='$v_name'
                                                            ORDER BY bi_customer ASC
                                                                                        ";
                                                            $result_bill = mysqli_query($connect, $sql_bill); 
                                                          
                                                                                     
                                                $i= 1;
                                                $total_qty=0;
                                                while($row_bill = $result_bill->fetch_assoc()) 
                                                {	  
                                                    $total_qty  +=$row_bill['bit_qty'];

                                                    $v_bi_number   =$row_bill["bi_number"];
                                                    $v_bit_con_no   =$row_bill["bit_con_no"];
                                                    $v_bi_etd   =$row_bill["bi_etd"];
                                                    $v_bi_eta   =$row_bill["bi_eta"];
                                                    $v_bit_destination   =$row_bill["de_name"];
                                                    $v_bit_qty   =$row_bill["bit_qty"];
                                                    $v_bit_gw   =$row_bill["bit_gw"];
                                                    $v_bit_cbm   =$row_bill["bit_cbm"];
                                                    $v_bit_pack_type   =$row_bill["pa_name"];
                                                    $v_bi_handing   =$row_bill["bi_handing"];
                                                    $v_bit_commodity   =$row_bill["bit_commodity"];
                                                    $v_bi_customer   =$row_bill["cus_name"];
                                                    $v_stock_completed   =$row_bill["bit_stock_completed"];
                                                    
                                                ?>

                                                    <tr>
                                                        <td> 
                                                            
                                                            <a href="stock_completed_update.php?id=<?php echo $row_bill['bit_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> </a>
                                                            <?php echo $v_stock_completed;?>
                                                        </td>
                                                        <td> <?php echo $v_bi_number;?></td>
                                                        <td> <?php echo $v_bit_con_no;?></td>
                                                        <td>
                                                            <?php
                                                            if($v_bi_etd=="0000-00-00"){
                                                                echo '';
                                                            }else{
                                                                echo date('d-M-Y',strtotime($v_bi_etd));
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if($v_bi_eta=="0000-00-00"){
                                                                echo '';
                                                            }else{
                                                                echo date('d-M-Y',strtotime($v_bi_eta));
                                                            }
                                                            ?>
                                                        </td>
                                                        <td> <?php echo $v_bit_destination;?></td>
                                                        <td> <?php echo $v_bit_qty;?></td>
                                                        <td>
                                                                <?php 
                                                                        $v_bitid  =$row_bill['bit_id'];
                                                                        $sql_out ="SELECT SUM(sout_qtyout) AS sumqtyout FROM stock_out_item
                                                                                                WHERE sout_bill_item='$v_bitid' ";
                                                                            $result_out = mysqli_query($connect, $sql_out);
                                                                            $row_out = $result_out->fetch_assoc();
                                                                            $get_out = $row_out['sumqtyout'];
                                                                            echo $get_out;
                                                                ?> 

                                                        </td>
                                                        <td class="text-danger">
                                                                <?php
                                                                    $v_balance = $v_bit_qty-$get_out;
                                                                    echo $v_balance;
                                                                ?> 
                                                        </td>
                                                        <td> <?php echo $v_bit_gw;?></td>
                                                        <td> <?php echo $v_bit_cbm;?></td>
                                                        <td> <?php echo $v_bit_pack_type;?></td>
                                                        <td> <?php echo $v_bi_handing;?></td>
                                                        <td> <?php echo $v_bit_commodity;?></td>
                                                        <td> <?php echo $v_bi_customer;?></td>
                                                
                                                    </tr>

                                                <?php
                                                    }	 
                                                ?>
                                                <tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                        Total:
                                                        </td>
                                                        <td>
                                                        <?php
                                                            echo $total_qty;
                                                        ?>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-center"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>

                                                    </tr>
                                                </tfoot>
                                            </table>
                                            </div>
                                            <!-- loop item bill end-->
                                            
                                            <?php
                                                }
                                            ?>

                                            
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
</div>
<?php include 'footer.php';?>