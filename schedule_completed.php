<?php include 'config/db_connect.php';
    date_default_timezone_set("Asia/Bangkok");
    $today = date('Y-m-d');
	  $datetime = date('Y-m-d H:i:s');
    $month = date('Y-m');


?>
<style>
    .fixTableHead {
      overflow-y: auto;
      height: 78%;
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
    tfoot {
      background: #a2a8a3;
      
    }
</style>
<?php include 'header.php';?>
<div class="row">
    <div class="col-xs-12">
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

                          <form class="form-inline" method = "post" action="">
                              <div class="form-group">
                                <label>From:</label>
                                <input type="date" class="form-control" name = "from" value="<?= @$_POST['from'] ?>" >
                              </div>
                              <div class="form-group">
                                <label>To:</label>
                                <input type="date" class="form-control" name = "to" value="<?= @$_POST['to'] ?>"> 
                              </div>
                              <div class="form-group">
                                <select class="form-control select2" name = "txt_customer"> 
                                  <option value="">=== choose code ===</option>
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
            
                <div class="fixTableHead">
                    <table class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                <th class="text-danger">Completed</th>
                                <th>ETA</th>
                                <th>Border</th>
                                <th>Bill No</th>
                                <th>Container No</th>
                                <th>Seal No</th>
                                <th>Cont Type</th>
                                <th>Customer ID</th>
                                <th>Handing Re</th>
                                <th>QTY</th>
                                <th>Package Type</th>
                                <th>GW</th>
                                <th>CBM</th>
                                <th>Reefer Con</th>
                                <th>Truck No</th>
                                <th>AP Trucking Vendor</th>
                                <th>Delivery Date</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                                    <?php           
                                        
                                        if(isset($_POST['search'])){
                                            $dateStart = $_POST['from'];
                                            $dateEnd = $_POST['to'];
                                                if($_POST['txt_customer'] != ""){
                                                $v_customer = $_POST['txt_customer'];
                                                        $sql = "SELECT * FROM bill AS A
                                                        LEFT JOIN bill_item AS BI ON BI.bit_bill_id=A.bi_id
                                                        LEFT JOIN border AS BOR ON BOR.bo_id=A.bi_border
                                                        LEFT JOIN container_type AS CONT ON CONT.cont_id=BI.bit_cont_type
                                                        LEFT JOIN customer AS CUS ON CUS.cus_id=A.bi_customer
                                                        LEFT JOIN destination AS DE ON DE.de_id=BI.bit_destination
                                                        LEFT JOIN package_type AS PAC ON PAC.pa_id=BI.bit_pack_type
                                                        LEFT JOIN truck_number AS TNUM ON TNUM.tnum_id=BI.bit_truck_no
                                                        LEFT JOIN export_text AS EXT ON EXT.et_id=BI.bit_export
                                                        LEFT JOIN text_completed AS TC ON TC.tcom_id=BI.bit_completed
                                                        WHERE BI.bit_completed=2
                                                        AND A.bi_eta >='$dateStart' AND  A.bi_eta <='$dateEnd' 
                                                        AND CUS.cus_id='$v_customer'
                                                        ORDER BY A.bi_id ASC
                                                                                ";
                                                        $result = mysqli_query($connect, $sql);

                                                }else{
                                                    
                                                    $sql = "SELECT * FROM bill AS A
                                                        LEFT JOIN bill_item AS BI ON BI.bit_bill_id=A.bi_id
                                                        LEFT JOIN border AS BOR ON BOR.bo_id=A.bi_border
                                                        LEFT JOIN container_type AS CONT ON CONT.cont_id=BI.bit_cont_type
                                                        LEFT JOIN customer AS CUS ON CUS.cus_id=A.bi_customer
                                                        LEFT JOIN destination AS DE ON DE.de_id=BI.bit_destination
                                                        LEFT JOIN package_type AS PAC ON PAC.pa_id=BI.bit_pack_type
                                                        LEFT JOIN truck_number AS TNUM ON TNUM.tnum_id=BI.bit_truck_no
                                                        LEFT JOIN export_text AS EXT ON EXT.et_id=BI.bit_export
                                                        LEFT JOIN text_completed AS TC ON TC.tcom_id=BI.bit_completed
                                                        WHERE BI.bit_completed=2
                                                        AND A.bi_eta >='$dateStart' AND  A.bi_eta <='$dateEnd' 
                                                        ORDER BY A.bi_id ASC
                                                                                ";
                                                        $result = mysqli_query($connect, $sql);
                                                } 

                                        }else{
                                                        $sql = "SELECT * FROM bill AS A
                                                        LEFT JOIN bill_item AS BI ON BI.bit_bill_id=A.bi_id
                                                        LEFT JOIN border AS BOR ON BOR.bo_id=A.bi_border
                                                        LEFT JOIN container_type AS CONT ON CONT.cont_id=BI.bit_cont_type
                                                        LEFT JOIN customer AS CUS ON CUS.cus_id=A.bi_customer
                                                        LEFT JOIN destination AS DE ON DE.de_id=BI.bit_destination
                                                        LEFT JOIN package_type AS PAC ON PAC.pa_id=BI.bit_pack_type
                                                        LEFT JOIN truck_number AS TNUM ON TNUM.tnum_id=BI.bit_truck_no
                                                        LEFT JOIN export_text AS EXT ON EXT.et_id=BI.bit_export
                                                        LEFT JOIN text_completed AS TC ON TC.tcom_id=BI.bit_completed
                                                        WHERE BI.bit_completed=2
                                                        ORDER BY A.bi_id ASC
                                                                                ";
                                                        $result = mysqli_query($connect, $sql);
                                                        
                                        }
    
                                              $total_qty =0;
                                        	    $i= 1;
                                              while($row = $result->fetch_assoc()) 
                                              {		
                                                    $total_qty  +=$row['bit_qty'];

                                                $v_border   =$row["bo_name"];
                                                $v_number  =$row['bi_number'];
                                                $v_con_no   =$row['bit_con_no'];
                                                $v_seal_no   =$row['bit_seal_no'];
                                                $v_cont_type  =$row['cont_name'];
                                                $v_customer  =$row['cus_num_id'];
                                                $v_handing  =$row['bi_handing'];

                                                $v_qty  =$row['bit_qty'];
                                                $v_pack_type  =$row['pa_name'];
                                                $v_gw  =$row['bit_gw'];
                                                $v_cbm  =$row['bit_cbm'];

                                                $v_reefer_con  =$row['bit_reefer_con'];
                                                $v_truck_no  =$row['tnum_number'];
                                                $v_ap_trucking_vendor  =$row['bit_ap_trucking_vendor'];
                                                $v_delivery_date  =$row['bit_delivery_date'];
                                                $v_completed  =$row['tcom_name'];
                                                
                                                $v_eta  =$row['bi_eta'];

										?>
                                <tr>
                                
                                    <td class="text-center">
                                        <a href="schedule_completed_edit.php?id=<?php echo $row['bit_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
									</td>
                                    <td class="text-danger"> <?php echo $v_completed;?> </td>
                                    <td> 
                                                <?php
                                                    if($v_eta=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_eta));
                                                    }
                                                    
                                                ?>
                                    </td>
                                    <td> <?php echo $v_border;?> </td>
                                    <td> <?php echo $v_number;?> </td>
                                    <td> <?php echo $v_con_no;?> </td>
                                    <td> <?php echo $v_seal_no;?> </td>
                                    <td> <?php echo $v_cont_type;?> </td>
                                    <td> <?php echo $v_customer;?> </td>
                                    <td> <?php echo $v_handing;?> </td>
                                    <td> <?php echo $v_qty;?> </td>
                                    <td> <?php echo $v_pack_type;?> </td>
                                    <td> <?php echo $v_gw;?> </td>
                                    <td> <?php echo $v_cbm;?> </td>
                                    <td> 
                                                <?php
                                                    $sql_ree="SELECT * FROM truck_number
                                                                        WHERE tnum_id='$v_reefer_con' ";
                                                    $result_ree = mysqli_query($connect, $sql_ree);
                                                    $row_ree = $result_ree->fetch_assoc();
                                                    $get_ree=$row_ree['tnum_number'];
                                                    echo $get_ree;
                                                ?>
                                    </td>
                                    <td> <?php echo $v_truck_no;?> </td>
                                    <td> <?php echo $v_ap_trucking_vendor;?> </td>
                                    <td>
                                        <?php
                                            if($v_delivery_date=="0000-00-00"){
                                                echo '';
                                            }else{
                                                echo date('d-M-Y',strtotime($v_delivery_date));
                                            }
                                            
                                        ?> 
                                    </td>
                                    
                                </tr>
                                    <?php
                                        }	 
                                    ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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
                            <td class="text-center">
                              <?php
                                $sql_tr="SELECT *, COUNT(bit_reefer_con) AS count_tr FROM bill_item
                                                        WHERE bit_completed =2 
                                                        AND bit_reefer_con >0
                                                                                ";
                                $result_tr = mysqli_query($connect, $sql_tr);
                                $row_tr = $result_tr->fetch_assoc();
                                $get_tr =$row_tr['count_tr'];
                                echo $get_tr;
                              ?>
                            </td>
                            <td class="text-center">
                              <?php
                                $sql_tr="SELECT *, COUNT(bit_truck_no) AS count_tr FROM bill_item
                                                        WHERE bit_completed =2 
                                                        AND bit_truck_no >0
                                                                                ";
                                $result_tr = mysqli_query($connect, $sql_tr);
                                $row_tr = $result_tr->fetch_assoc();
                                $get_tr =$row_tr['count_tr'];
                                echo $get_tr;
                              ?>
                            </td>
                            <td></td>
                            <td></td>

                          </tr>
                        </tfoot>
                    </table>
                           <!-- Total Container -->
                           <h4 class="text-primary"> Total Container</h4>
                           <table style="width:14%" class='table table-bordered'>
                            <tr>
                            <th>Container</th><th>Count</th>
                            </tr>
                            <?php
                            $connect = new mysqli($servername, $username, $password, $dbname);
                            foreach($connect->query('SELECT *,COUNT(*)
                            FROM bill_item AS A
                            LEFT JOIN container_type AS CON ON CON.cont_id=A.bit_cont_type
                            WHERE bit_completed =2 
                            GROUP BY A.bit_cont_type') as $row) {
                            echo "<tr>";
                            echo "<td>" . $row['cont_name'] . "</td>";
                            echo "<td>" . $row['COUNT(*)'] . "</td>";
                            echo "</tr>"; 
                            }
                            ?>
                            </tbody>
                          </table>
                <!-- Total Container -->
                </div>

            </div>
            
        </div>
        
    </div>
</div>
</div>
<?php include 'footer_v1.php';?>