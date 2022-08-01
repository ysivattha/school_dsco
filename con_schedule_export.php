<?php include 'config/db_connect.php';
    date_default_timezone_set("Asia/Bangkok");
    $today = date('Y-m-d');
    $datetime = date('Y-m-d H:i:s');
    $tomorrow = date("Y-m-d", strtotime("+1 day"));
    $month = date('Y-m');

?>

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
            <div class="row">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">               
                    <div class="col-sm-2">
                    
                    </div>
                    
                        <div class="col-sm-2 " >
                            <input type="date" class="form-control" name="txt_start_date" value="<?= @$_POST['txt_start_date'] ?>"> 
                        </div>
                        <div class="col-sm-2 " >
                            <input type="date" class="form-control" name="txt_end_date" value="<?= @$_POST['txt_end_date'] ?>"> 
                        </div>
                        <div class="col-sm-2" >
                            <select name="txt_choose" class="form-control">
                                <option value="0">==== Choose here ====</option>
                                <?php 
                                    $customer = $connect->query("SELECT * FROM export_text ORDER BY et_id DESC");
                                    while($row_cus = mysqli_fetch_object($customer)){
                                        if($row_cus->et_id == @$_POST['txt_choose']){
                                            echo '<option SELECTED value="'.$row_cus->et_id.'">'.$row_cus->et_name.'</option>';

                                        }else{
                                            echo '<option value="'.$row_cus->et_id.'">'.$row_cus->et_name.'</option>';
                                            
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    
                    <div class="col-sm-2">
                        <div class="caption font-dark" style="display: inline-block;">
                            <button type="submit" name="btn_search" id="sample_editable_1_new" class="btn btn-primary"> Export
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="caption font-dark" style="display: inline-block;">
                            <a href="<?= $_SERVER['PHP_SELF'] ?>" id="sample_editable_1_new" class="btn btn-danger"> Clear
                                <i class="fa fa-refresh"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-2">
                                            <div class="text-right">
                                                <a href="container_schedule_menu.php">
                                                    <i class="fa fa-cog" aria-hidden="true"></i> Show/Hide
                                                </a>
                                            </div>
                    </div>
                </form>
            </div>
            
            <div class="panel-body">
                
                <div class="table-responsive">
                    <table id="example" class="nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <!-- start show menu export 1 -->
                                <?php
                                    $sqlshow1 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=1 ";
                                    $resultshow1 = mysqli_query($connect, $sqlshow1);
                                    $rowshow1 = $resultshow1->fetch_assoc();
                                    $v_border1 =$rowshow1["conm_show_hide"];

                                    if($v_border1==1){
                                ?>
                                        <th>Export</th>
                                <?php
                                    }
                                ?>
                                <!-- end -->
                                <!-- start show menu border 2 -->
                                <?php
                                    $sqlshow2 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=2 ";
                                    $resultshow2 = mysqli_query($connect, $sqlshow2);
                                    $rowshow2 = $resultshow2->fetch_assoc();
                                    $v_border2 =$rowshow2["conm_show_hide"];

                                    if($v_border2==1){
                                ?>
                                        <th>Border</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu bill no 3 -->
                                <?php
                                    $sqlshow3 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=3 ";
                                    $resultshow3 = mysqli_query($connect, $sqlshow3);
                                    $rowshow3 = $resultshow3->fetch_assoc();
                                    $v_border3 =$rowshow3["conm_show_hide"];

                                    if($v_border3==1){
                                ?>
                                        <th>Bill No</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu container no 4 -->
                                <?php
                                    $sqlshow4 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=4 ";
                                    $resultshow4 = mysqli_query($connect, $sqlshow4);
                                    $rowshow4 = $resultshow4->fetch_assoc();
                                    $v_border4 =$rowshow4["conm_show_hide"];

                                    if($v_border4==1){
                                ?>
                                        <th>Container No</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu seal no 5 -->
                                <?php
                                    $sqlshow5 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=5 ";
                                    $resultshow5 = mysqli_query($connect, $sqlshow5);
                                    $rowshow5 = $resultshow5->fetch_assoc();
                                    $v_border5 =$rowshow5["conm_show_hide"];

                                    if($v_border5==1){
                                ?>
                                        <th>Seal No</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu container type 6 -->
                                <?php
                                    $sqlshow6 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=6 ";
                                    $resultshow6 = mysqli_query($connect, $sqlshow6);
                                    $rowshow6 = $resultshow6->fetch_assoc();
                                    $v_border6 =$rowshow6["conm_show_hide"];

                                    if($v_border6==1){
                                ?>
                                        <th>Cont Type</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu customer id 7 -->
                                <?php
                                    $sqlshow7 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=7 ";
                                    $resultshow7 = mysqli_query($connect, $sqlshow7);
                                    $rowshow7 = $resultshow7->fetch_assoc();
                                    $v_border7 =$rowshow7["conm_show_hide"];

                                    if($v_border7==1){
                                ?>
                                        <th>Customer ID</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu handing remark 8 -->
                                <?php
                                    $sqlshow8 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=8 ";
                                    $resultshow8 = mysqli_query($connect, $sqlshow8);
                                    $rowshow8 = $resultshow8->fetch_assoc();
                                    $v_border8 =$rowshow8["conm_show_hide"];

                                    if($v_border8==1){
                                ?>
                                        <th>Handing Remark</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu etd 9 -->
                                <?php
                                    $sqlshow9 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=9 ";
                                    $resultshow9 = mysqli_query($connect, $sqlshow9);
                                    $rowshow9 = $resultshow9->fetch_assoc();
                                    $v_border9 =$rowshow9["conm_show_hide"];

                                    if($v_border9==1){
                                ?>
                                        <th>ETD</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu eta 10 -->
                                <?php
                                    $sqlshow10 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=10 ";
                                    $resultshow10 = mysqli_query($connect, $sqlshow10);
                                    $rowshow10 = $resultshow10->fetch_assoc();
                                    $v_border10 =$rowshow10["conm_show_hide"];

                                    if($v_border10==1){
                                ?>
                                        <th>ETA</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu tran mode 11 -->
                                <?php
                                    $sqlshow11 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=11 ";
                                    $resultshow11 = mysqli_query($connect, $sqlshow11);
                                    $rowshow11 = $resultshow11->fetch_assoc();
                                    $v_border11 =$rowshow11["conm_show_hide"];

                                    if($v_border11==1){
                                ?>
                                        <th>Tran Mode</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu commodity 12 -->
                                <?php
                                    $sqlshow12 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=12 ";
                                    $resultshow12 = mysqli_query($connect, $sqlshow12);
                                    $rowshow12 = $resultshow12->fetch_assoc();
                                    $v_border12 =$rowshow12["conm_show_hide"];

                                    if($v_border12==1){
                                ?>
                                        <th>Commodity</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu destination 13 -->
                                <?php
                                    $sqlshow13 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=13 ";
                                    $resultshow13 = mysqli_query($connect, $sqlshow13);
                                    $rowshow13 = $resultshow13->fetch_assoc();
                                    $v_border13 =$rowshow13["conm_show_hide"];

                                    if($v_border13==1){
                                ?>
                                        <th>Destination</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu qty 14 -->
                                <?php
                                    $sqlshow14 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=14 ";
                                    $resultshow14 = mysqli_query($connect, $sqlshow14);
                                    $rowshow14 = $resultshow14->fetch_assoc();
                                    $v_border14 =$rowshow14["conm_show_hide"];

                                    if($v_border14==1){
                                ?>
                                        <th>QTY</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu package type 15 -->
                                <?php
                                    $sqlshow15 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=15 ";
                                    $resultshow15 = mysqli_query($connect, $sqlshow15);
                                    $rowshow15 = $resultshow15->fetch_assoc();
                                    $v_border15 =$rowshow15["conm_show_hide"];

                                    if($v_border15==1){
                                ?>
                                        <th>Package Type</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu gw 16 -->
                                <?php
                                    $sqlshow16 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=16 ";
                                    $resultshow16 = mysqli_query($connect, $sqlshow16);
                                    $rowshow16 = $resultshow16->fetch_assoc();
                                    $v_border16 =$rowshow16["conm_show_hide"];

                                    if($v_border16==1){
                                ?>
                                        <th>GW</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu cbm 17 -->
                                <?php
                                    $sqlshow17 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=17 ";
                                    $resultshow17 = mysqli_query($connect, $sqlshow17);
                                    $rowshow17 = $resultshow17->fetch_assoc();
                                    $v_border17 =$rowshow17["conm_show_hide"];

                                    if($v_border17==1){
                                ?>
                                        <th>CBM</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu truck no vn 18 -->
                                <?php
                                    $sqlshow18 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=18 ";
                                    $resultshow18 = mysqli_query($connect, $sqlshow18);
                                    $rowshow18 = $resultshow18->fetch_assoc();
                                    $v_border18 =$rowshow18["conm_show_hide"];

                                    if($v_border18==1){
                                ?>
                                        <th>Truck_No_VN</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu note 19 -->
                                <?php
                                    $sqlshow19 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=19 ";
                                    $resultshow19 = mysqli_query($connect, $sqlshow19);
                                    $rowshow19 = $resultshow19->fetch_assoc();
                                    $v_border19 =$rowshow19["conm_show_hide"];

                                    if($v_border19==1){
                                ?>
                                        <th>Note</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu note1 20 -->
                                <?php
                                    $sqlshow20 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=20 ";
                                    $resultshow20 = mysqli_query($connect, $sqlshow20);
                                    $rowshow20 = $resultshow20->fetch_assoc();
                                    $v_border20 =$rowshow20["conm_show_hide"];

                                    if($v_border20==1){
                                ?>
                                        <th>Note1</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu note2 21 -->
                                <?php
                                    $sqlshow21 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=21 ";
                                    $resultshow21 = mysqli_query($connect, $sqlshow21);
                                    $rowshow21 = $resultshow21->fetch_assoc();
                                    $v_border21 =$rowshow21["conm_show_hide"];

                                    if($v_border21==1){
                                ?>
                                        <th>Note2</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu reefer con 22 -->
                                <?php
                                    $sqlshow22 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=22 ";
                                    $resultshow22 = mysqli_query($connect, $sqlshow22);
                                    $rowshow22 = $resultshow22->fetch_assoc();
                                    $v_border22 =$rowshow22["conm_show_hide"];

                                    if($v_border22==1){
                                ?>
                                        <th>Reefer Con</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu truck no 23 -->
                                <?php
                                    $sqlshow23 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=23 ";
                                    $resultshow23 = mysqli_query($connect, $sqlshow23);
                                    $rowshow23 = $resultshow23->fetch_assoc();
                                    $v_border23 =$rowshow23["conm_show_hide"];

                                    if($v_border23==1){
                                ?>
                                        <th>Truck No</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu ap trucking vendor 24 -->
                                <?php
                                    $sqlshow24 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=24 ";
                                    $resultshow24 = mysqli_query($connect, $sqlshow24);
                                    $rowshow24 = $resultshow24->fetch_assoc();
                                    $v_border24 =$rowshow24["conm_show_hide"];

                                    if($v_border24==1){
                                ?>
                                        <th>AP Trucking Vendor</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu delivery date 25 -->
                                <?php
                                    $sqlshow25 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=25 ";
                                    $resultshow25 = mysqli_query($connect, $sqlshow25);
                                    $rowshow25 = $resultshow25->fetch_assoc();
                                    $v_border25 =$rowshow25["conm_show_hide"];

                                    if($v_border25==1){
                                ?>
                                        <th>Delivery Date</th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                <!-- start show menu action 26 -->
                                <?php
                                    $sqlshow26 = "SELECT * FROM container_schedule_menu AS A
                                                                WHERE conm_id=26 ";
                                    $resultshow26 = mysqli_query($connect, $sqlshow26);
                                    $rowshow26 = $resultshow26->fetch_assoc();
                                    $v_border26 =$rowshow26["conm_show_hide"];

                                    if($v_border26==1){
                                ?>
                                        <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                <?php
                                    }
                                ?>
                                <!-- end  -->
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                                    <?php   
                                            if(isset($_POST['btn_search'])){
                                                
                                                if(@$_POST['txt_start_date']!=""
                                                    or @$_POST['txt_end_date']!=""
                                                                                ){
                                                    $v_choose = @$_POST['txt_choose'];
                                                    $v_start_date = $_POST['txt_start_date'];
                                                    $v_end_date = $_POST['txt_end_date'];

                                                    $sql = "SELECT * FROM bill AS A
                                                    LEFT JOIN bill_item AS BILL ON BILL.bit_bill_id=A.bi_id
                                                    LEFT JOIN export_text AS EXT ON EXT.et_id=BILL.bit_export
                                                    LEFT JOIN border AS BOR ON BOR.bo_id=A.bi_border
                                                    LEFT JOIN container_type AS CONT ON CONT.cont_id=BILL.bit_cont_type
                                                    LEFT JOIN customer AS CUS ON CUS.cus_id=A.bi_customer
                                                    LEFT JOIN destination AS DE ON DE.de_id=BILL.bit_destination
                                                    LEFT JOIN package_type AS PAC ON PAC.pa_id=BILL.bit_pack_type
                                                    WHERE A.bi_eta>='$v_start_date' AND A.bi_eta<='$v_end_date'
                                                                                                         ";
                                                $result = mysqli_query($connect, $sql);  
                                                
                                                }
                                                elseif(@$_POST['txt_choose']!=""){
                                                    $v_choose = @$_POST['txt_choose'];
                                                    $v_start_date = $_POST['txt_start_date'];
                                                    $v_end_date = $_POST['txt_end_date'];

                                                $sql = "SELECT * FROM bill AS A
                                                LEFT JOIN bill_item AS BILL ON BILL.bit_bill_id=A.bi_id
                                                LEFT JOIN export_text AS EXT ON EXT.et_id=BILL.bit_export
                                                LEFT JOIN border AS BOR ON BOR.bo_id=A.bi_border
                                                LEFT JOIN container_type AS CONT ON CONT.cont_id=BILL.bit_cont_type
                                                LEFT JOIN customer AS CUS ON CUS.cus_id=A.bi_customer
                                                LEFT JOIN destination AS DE ON DE.de_id=BILL.bit_destination
                                                LEFT JOIN package_type AS PAC ON PAC.pa_id=BILL.bit_pack_type
                                                WHERE BILL.bit_export = '$v_choose'
                                                ORDER BY CUS.cus_num_id ASC
                                                                                                     ";
                                                $result = mysqli_query($connect, $sql);
                                                }
                    
                                            }else{

                                                $sql = "SELECT * FROM bill AS A
                                                LEFT JOIN bill_item AS BILL ON BILL.bit_bill_id=A.bi_id
                                                LEFT JOIN export_text AS EXT ON EXT.et_id=BILL.bit_export
                                                LEFT JOIN border AS BOR ON BOR.bo_id=A.bi_border
                                                LEFT JOIN container_type AS CONT ON CONT.cont_id=BILL.bit_cont_type
                                                LEFT JOIN customer AS CUS ON CUS.cus_id=A.bi_customer
                                                LEFT JOIN destination AS DE ON DE.de_id=BILL.bit_destination
                                                LEFT JOIN package_type AS PAC ON PAC.pa_id=BILL.bit_pack_type
                                                ORDER BY CUS.cus_num_id ASC
                                                                                                    ";
                                                $result = mysqli_query($connect, $sql);
                    
                                            }
                                            
                                        

                                            $total=0;      
                                            $count=0;              
                                            $i= 1;
											while($row = $result->fetch_assoc()) 
											{
                                                $total += $row["bit_qty"];   
                                                $count += 1;  

												$v_border  =$row["bo_name"];
                                                $v_number   =$row['bi_number'];
                                                $v_con_no   =$row["bit_con_no"];
												$v_seal_no  =$row["bit_seal_no"];
                                                $v_cont_type  =$row["cont_name"];
                                                $v_customer  =$row["cus_num_id"];
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
                                                $v_truck_no =$row["bit_truck_no"];
                                                $v_ap_trucking_vendor =$row["bit_ap_trucking_vendor"];
                                                $v_delivery_date =$row["bit_delivery_date"];

                                                $v_export =$row["et_name"];
                                                $v_highlight_start =@$row["bi_highlight_start"];
                                                $v_highlight_end =@$row["bi_highlight_end"];

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
                                
                                    
                                    
                                    <!-- start show menu export 1 -->
                                    <?php
                                        if($v_border1==1){
                                    ?>
                                            <td>
                                                <a href="container_schedule_export.php?id=<?php echo $row['bit_id']; ?>" ><i class="fa fa-pencil"></i></a>
                                                <?php echo $v_export;?> 
                                            </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu border 2 -->
                                    <?php
                                        if($v_border2==1){
                                    ?>
                                            <td> <?php echo $v_border;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end -->
                                    <!-- start show menu bill no 3 -->
                                    <?php
                                        if($v_border3==1){
                                    ?>
                                            <td> <?php echo $v_number;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu container no 4 -->
                                    <?php
                                        if($v_border4==1){
                                    ?>
                                            <td> <?php echo $v_con_no;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu seal no 5 -->
                                    <?php
                                        if($v_border5==1){
                                    ?>
                                            <td> <?php echo $v_seal_no;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu container type 6 -->
                                    <?php
                                        if($v_border6==1){
                                    ?>
                                            <td> <?php echo $v_cont_type;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu customer id 7 -->
                                    <?php
                                        if($v_border7==1){
                                    ?>
                                            <td> <?php echo $v_customer;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu handing remark 8 -->
                                    <?php
                                        if($v_border8==1){
                                    ?>
                                            <td> <?php echo $v_handing;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu etd 9 -->
                                    <?php
                                        if($v_border9==1){
                                    ?>
                                            <td>
                                                <?php
                                                    if($v_etd=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_etd));
                                                    }
                                                    
                                                ?>
                                            </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu eta 10 -->
                                    <?php
                                        if($v_border10==1){
                                    ?>
                                            <td>
                                                <?php
                                                    if($v_eta=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_eta));
                                                    }
                                                    
                                                ?>
                                            </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu tran mode 11 -->
                                    <?php
                                        if($v_border11==1){
                                    ?>
                                            <td> <?php echo $v_tran_mode;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu commodity 12 -->
                                    <?php
                                        if($v_border12==1){
                                    ?>
                                            <td> <?php echo $v_commodity;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu destination 13 -->
                                    <?php
                                        if($v_border13==1){
                                    ?>
                                            <td> <?php echo $v_destination;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu qty 14 -->
                                    <?php
                                        if($v_border14==1){
                                    ?>
                                            <td> <?php echo $v_qty;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu package type 15 -->
                                    <?php
                                        if($v_border15==1){
                                    ?>
                                            <td> <?php echo $v_pack_type;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu gw 16 -->
                                    <?php
                                        if($v_border16==1){
                                    ?>
                                            <td> <?php echo $v_gw;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu cmb 17 -->
                                    <?php
                                        if($v_border17==1){
                                    ?>
                                            <td> <?php echo $v_cbm;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu truck no vn 18 -->
                                    <?php
                                        if($v_border18==1){
                                    ?>
                                            <td> <?php echo $v_truck_no_vn;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu note 19 -->
                                    <?php
                                        if($v_border19==1){
                                    ?>
                                            <td> <?php echo $v_note;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu note1 20 -->
                                    <?php
                                        if($v_border20==1){
                                    ?>
                                            <td> <?php echo $v_note1;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu note2 21 -->
                                    <?php
                                        if($v_border21==1){
                                    ?>
                                            <td> <?php echo $v_note2;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu reefer con 22 -->
                                    <?php
                                        if($v_border22==1){
                                    ?>
                                            <td> <?php echo $v_reefer_con;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu truck 23 -->
                                    <?php
                                        if($v_border23==1){
                                    ?>
                                            <td> <?php echo $v_truck_no;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu truck 24 -->
                                    <?php
                                        if($v_border24==1){
                                    ?>
                                            <td> <?php echo $v_ap_trucking_vendor;?> </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu delivery date 24 -->
                                    <?php
                                        if($v_border24==1){
                                    ?>
                                            <td>
                                                <?php
                                                    if($v_delivery_date=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_delivery_date));
                                                    }
                                                    
                                                ?>
                                            </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    <!-- start show menu action 26 -->
                                    <?php
                                        if($v_border26==1){
                                    ?>
                                            <td class="text-center">
                                            
                                            </td>
                                    <?php
                                        }
                                    ?>
                                    <!-- end  -->
                                    
                                            
                                            
                                            
                                            

                                            
                                        </tr>
                                    
                                        
                                <?php
                                    }	 
                                ?>
                        </tbody>
                        <tfood>
                            <tr>
                                <th></th>
                                <th> </th>
                                <th>Sum QTY:
                                    <?php
                                        echo "$total";
                                    ?>
                                </th>                    
                                
                                <th>Count :
                                    <?php
                                        echo "$count";
                                    ?>
                                </th>      
                            </tr>
                        </tfood>

                    </table>
                                        
                                        
                </div>

            </div>

        </div>
        

    </div>
</div>
</div>

<?php include 'footer.php';?>