<?php include 'config/db_connect.php';
    date_default_timezone_set("Asia/Bangkok");
    $today = date('Y-m-d');
    $datetime = date('Y-m-d H:i:s');
    $tomorrow = date("Y-m-d", strtotime("+1 day"));
    $month = date('Y-m');

    if(isset($_GET["del_id"])){
        $id = $_GET["del_id"];
   
        $sql = "DELETE FROM bill_item 
                       WHERE bit_id = '$id'
                       ";
        $result = mysqli_query($connect, $sql);
           if ($result) {
               header("location:container_schedule.php?message=delete");
               }
       } 

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
            <h4 class="text-primary">EM Return</h4>
                <div class="fixTableHead">
                    <table class="nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                <th>Completed</th>
                                <th>Bill_No</th>
                                <th>Border</th>
                                <th>CustomerID</th>
                                <th>ETD</th>
                                <th>Cont_No</th>
                                <th>Seal_No</th>
                                <th>Cont_Type</th>
                                <th>Qty</th>
                                <th>Package_Type</th>
                                <th>GW</th>
                                <th>CBM</th>
                                <th>Destination</th>
                                <th>Note</th>
                                <th>Truck_No</th>
                                <th>Truck_Qty</th>
                                <th>Handling_Remarks</th>

                                <th>Arrived_PP_Date</th>
                                <th>Ret_Border_Date</th>
                                <th>Ret_Port_Date</th>
                                <th>Storage</th>
                                <th>Dummerage</th>
                                <th>Destination</th>
                                <th>Price</th>
                                <th>Empty_Return_Note</th>
                                
                                
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                                    <?php   
                                       
                                            // else clear
                                            $sql = "SELECT * FROM bill AS A
                                            LEFT JOIN bill_item AS BI ON BI.bit_bill_id=A.bi_id
                                            LEFT JOIN border AS BOR ON BOR.bo_id=A.bi_border
                                            LEFT JOIN container_type AS CONT ON CONT.cont_id=BI.bit_cont_type
                                            LEFT JOIN customer AS CUS ON CUS.cus_id=A.bi_customer
                                            LEFT JOIN destination AS DE ON DE.de_id=BI.bit_destination
                                            LEFT JOIN package_type AS PAC ON PAC.pa_id=BI.bit_pack_type
                                            LEFT JOIN truck_number AS TNUM ON TNUM.tnum_id=BI.bit_truck_no
                                            LEFT JOIN export_text AS EXT ON EXT.et_id=BI.bit_export
                                            LEFT JOIN text_completed AS COM ON COM.tcom_id=BI.bit_completed
                                            WHERE BI.bit_completed<2
                                            ORDER BY A.bi_id ASC
                                                                                    ";
                                            $result = mysqli_query($connect, $sql);

                                            $total=0;      
                                            $count=0;              
                                            $i= 1;
											while($row = $result->fetch_assoc()) 
											{
                                                $total += $row["bit_qty"];   
                                                $count += 1;  

												$v_number   =$row['bi_number'];
                                                $v_border  =$row["bo_name"];
                                                $v_customer  =$row["cus_num_id"];

                                                $v_con_no   =$row["bit_con_no"];
												$v_seal_no  =$row["bit_seal_no"];
                                                $v_cont_type  =$row["cont_name"];
                                                
                                                $v_handing  =$row["bi_handing"];
												$v_etd    =$row["bi_etd"];
                                                $v_eta     =$row["bi_eta"];
                                                $v_tran_mode =$row["bi_transfer"];
                                                $v_commodity =$row["bit_commodity"];
                                                $v_destination =$row["de_name"];
                                                $v_qty =$row["bit_qty"];
                                                $v_pack_type =$row["pa_name"];
                                                $v_gw =$row["bit_gw"];
                                                $v_cbm =$row["bit_cbm"];
                                                $v_truck_no_vn =$row["bit_truck_no_vn"];
                                                $v_note =$row["bit_note"];
                                                $v_note1 =$row["bit_note1"];
                                                $v_note2 =$row["bit_note2"];
                                                $v_reefer_con =$row["bit_reefer_con"];

                                                $v_truck_no =$row["tnum_number"];
                                                $v_ap_trucking_vendor =$row["bit_ap_trucking_vendor"];
                                                $v_delivery_date =$row["bit_delivery_date"];

                                                $v_bit_arrived_pp_date =$row["bit_arrived_pp_date"];
                                                $v_bit_ret_border_date =$row["bit_ret_border_date"];
                                                $v_bit_ret_port_date =$row["bit_ret_port_date"];
                                                $v_bit_storage =$row["bit_storage"];
                                                $v_bit_dummerage =$row["bit_dummerage"];
                                                $v_bit_destination_em =$row["bit_destination_em"];
                                                $v_bit_price =$row["bit_price"];
                                                $v_bit_empty_return_note =$row["bit_empty_return_note"];

                                                $v_export =$row["et_name"];
                                                $v_highlight_start =@$row["bi_highlight_start"];
                                                $v_highlight_end =@$row["bi_highlight_end"];
                                                $v_bit_completed =@$row["tcom_name"];

									?>
                                    <?php

                                        $datetime = date('Y-m-d H:i:s');
                                        if($datetime>=$v_highlight_start and $datetime<=$v_highlight_end ){
                                    ?>
                                        <tr style="background-color:#ffff99">
                                    <?php
                                        }else{
                                    ?>
                                        <tr>
                                    <?php
                                        }
                                    ?>
                                
                                    
                                    <td class="text-center">
                                        <a href="em_return_edit.php?id=<?php echo $row['bit_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> 
                                        <!--                    <a href="container_schedule_edit_complete.php?id=<?php echo $row['bit_id']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-check"></i></a>
                                                                <a onclick="return confirm('Are you sure to delete?');" href="container_schedule.php?del_id=<?php echo $row['bit_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                        -->                
                                    </td>
                                    <td> <?php echo $v_bit_completed;?> </td>
                                    <td> <?php echo $v_number;?> </td>
                                    <td> <?php echo $v_border;?> </td>
                                    <td> <?php echo $v_customer;?> </td>
                                    <td>
                                                <?php
                                                    if($v_eta=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_eta));
                                                    }
                                                    
                                                ?>
                                    </td>
                                    <td> <?php echo $v_con_no;?> </td>
                                    <td> <?php echo $v_seal_no;?> </td>
                                    <td> <?php echo $v_cont_type;?> </td>
                                    <td> <?php echo $v_qty;?> </td>
                                    <td> <?php echo $v_pack_type;?> </td>
                                    <td> <?php echo $v_gw;?> </td>
                                    <td> <?php echo $v_cbm;?> </td>
                                    <td> <?php echo $v_destination;?> </td>
                                    <td> <?php echo $v_note;?> </td>
                                    <td> <?php echo $v_truck_no;?> </td>
                                    <td> <?php echo $v_qty;?> </td>
                                    <td> <?php echo $v_handing;?> </td>

                                    <td> 
                                                <?php
                                                    if($v_bit_arrived_pp_date=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_bit_arrived_pp_date));
                                                    }
                                                    
                                                ?>
                                    </td>
                                    <td> 
                                                <?php
                                                    if($v_bit_ret_border_date=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_bit_ret_border_date));
                                                    }
                                                    
                                                ?>
                                    </td>
                                    <td> 
                                                <?php
                                                    if($v_bit_ret_port_date=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_bit_ret_port_date));
                                                    }
                                                    
                                                ?>
                                     </td>
                                    <td> <?php echo $v_bit_storage;?> </td>
                                    <td> <?php echo $v_bit_dummerage;?> </td>
                                    <td> <?php echo $v_bit_destination_em;?> </td>
                                    <td> <?php echo $v_bit_price;?> </td>
                                    <td> <?php echo $v_bit_empty_return_note;?> </td>
                                    
                                       
                                        </tr>
                                    
                                        
                                <?php
                                    }	 
                                ?>
                        </tbody>
                        <tfood>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Count:
                                    <br>
                                    <?php
                                        echo "$count";
                                    ?>
                                </th>                                
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </tr>
                        </tfood>

                    </table>
                                        
                                        
                </div>

            </div>
            </div> <!-- fixTableHead -->

        
        

    </div>
</div>
</div>
<?php include 'footer.php';?>
