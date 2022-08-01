<?php include'config/db_connect.php';

?>
<?php include 'header.php';?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-cubes fa-fw"></i>Sale Report by Session</h2>
        </div>
    </div>
    <br>
    <div class="row">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="col-sm-2" style="padding-right: 0px;">
                <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    <input name="txt_date_start" value="<?= @$_POST['txt_date_start'] ?>" REQUIRED type="text" class="form-control" placeholder="date from" autocomplete="off">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2" style="padding-right: 0px;">
                <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                    <input name="txt_date_end" value="<?= @$_POST['txt_date_end'] ?>" REQUIRED type="text" class="form-control" placeholder="date to" autocomplete="off">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2" style="padding-right: 0px;">
                <select required="" name="txt_session" class="form-control">
                    <?php
                        if(isset($_POST['btn_search'])){
                            $v_from = @$_POST['txt_date_start'];
                            $v_to = @$_POST['txt_date_end'];
                            $sql_session = $connect->query("SELECT * FROM tbl_order_session WHERE DATE_FORMAT(os_session_date,'%Y-%m-%d') >= '$v_from' AND DATE_FORMAT(os_session_date,'%Y-%m-%d') <= '$v_to' ORDER BY os_session_date DESC,os_open_sesstion_date ASC");
                            while ($row_session = mysqli_fetch_object($sql_session)) {
                                if($row_session->os_id==@$_POST['txt_session']){
                                    echo '<option SELECTED value="'.$row_session->os_id.'">'.substr($row_session->os_open_sesstion_date,0,11).' :: '.substr($row_session->os_open_sesstion_date,11,5).' -- '.substr($row_session->os_close_sesstion_date,11,5).'</option>';   
                                }else{
                                    echo '<option value="'.$row_session->os_id.'">'.substr($row_session->os_open_sesstion_date,0,11).' :: '.substr($row_session->os_open_sesstion_date,11,5).' -- '.substr($row_session->os_close_sesstion_date,11,5).'</option>';
                                }
                            }
                        }else{
                            echo '<option value="">==choose session==</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="col-sm-3">
                <div class="caption font-dark" style="display: inline-block;">
                    <button type="submit" name="btn_search" id="sample_editable_1_new" class="btn btn-primary"> Search
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div class="caption font-dark" style="display: inline-block;">
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" id="sample_editable_1_new" class="btn btn-danger"> Clear
                        <i class="fa fa-refresh"></i>
                    </a>
                </div>

            </div>
        </form>
    </div>
    <br>
    <div class="portlet-body">
        <div id="sample_1_wrapper" class="dataTables_wrapper">
            <table id="example" class="display nowrap" width="100%" cellspacing="0">
                <thead>
                    <tr role="row">
                        <th>N&deg; #</th>
                        <th>Date</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Discount</th>
                        <th class="text-center">Amount</th>
                        <th>Saler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(isset($_POST['btn_search'])){
                            $v_session = @$_POST['txt_session'];
                            $sql_session = $connect->query("SELECT * FROM tbl_order_session WHERE os_id='$v_session'");
                            $row_session = mysqli_fetch_object($sql_session);
                            $v_from = @$row_session->os_open_sesstion_date;
                            $v_to = @$row_session->os_close_sesstion_date;

                            $data_query = $connect->query("SELECT *,SUM(od_amount) AS s_qty, DATE_FORMAT(od_submit_date_time,'%Y-%m-%d') AS s_date,SUM(od_amount*od_price) as s_total,SUM(od_amount*od_price*od_amount*od_discount/100) AS s_discount FROM tbl_order_detail WHERE od_submit_date_time BETWEEN '$v_from' AND '$v_to' GROUP BY  DATE_FORMAT(od_submit_date_time,'%Y-%m-%d') ORDER BY od_submit_date_time DESC");
                        }else{
                            $current_date = date('Y-m-d');
                            $data_query = $connect->query("SELECT *,SUM(od_amount) AS s_qty, DATE_FORMAT(od_submit_date_time,'%Y-%m-%d') AS s_date,SUM(od_amount*od_price) as s_total,SUM(od_amount*od_price*od_amount*od_discount/100) AS s_discount FROM tbl_order_detail WHERE DATE_FORMAT(od_submit_date_time,'%Y-%m-%d') = '$current_date' GROUP BY  DATE_FORMAT(od_submit_date_time,'%Y-%m-%d') ORDER BY od_submit_date_time DESC");
                        }
                        $no = 0;
                        $sum_qty = 0;
                        $sum_discount = 0;
                        $sum_amount = 0;
                        while ($row_data = mysqli_fetch_object($data_query)) {
                            $v_amount = $row_data->s_total-$row_data->s_discount;
                            $sum_qty += $row_data->s_qty;
                            $sum_discount += $row_data->s_discount;
                            $sum_amount += $v_amount;
                            echo '<tr>';
                                echo "<td>".(++$no)."</td>";
                                echo "<td>$row_data->s_date</td>";
                                echo '<th class="text-center">'.number_format($row_data->s_qty,0).'</th>';
                                echo '<th class="text-center">$ '.number_format((float)$row_data->s_discount,2).'</th>';
                                echo '<th class="text-center">$ '.number_format($v_amount,2).'</th>';
                                echo "<td>--</td>";
                            echo '</tr>';
                        }
                    ?> 
                </tbody>
                <tfoot>
                    <th colspan="2" class="text-right">Grand Total : </th>
                    <th class="text-center"><?= number_format($sum_qty,0) ?></th>
                    <th class="text-center">$ <?= number_format((float)$sum_discount,2) ?></th>
                    <th class="text-center">$ <?= number_format($sum_amount,2) ?></th>
                    <th colspan="1"></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>   
<script type="text/javascript" src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('[name=txt_date_start],[name=txt_date_end]').change(function(){
            $v_date_start = $('[name=txt_date_start]').val();
            $v_date_end = $('[name=txt_date_end]').val();
            if($v_date_start && $v_date_end){
                // alert($v_date_start);
                // alert($v_date_end);
                $.ajax({url: "api_ajx_load_session.php?s="+$v_date_start+"&e="+$v_date_end, success: function(result){
                    $("[name=txt_session]").html(result);
                }});
            }
        });
    });
</script> 
<?php include 'footer.php';?>