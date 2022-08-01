<?php include'config/db_connect.php';

?>
<?php include 'header.php';?>
<div class="portlet light bordered">
    <div class="row">
        <div class="col-xs-12">
            <h2><i class="fa fa-cubes fa-fw"></i>Sale Report by Items</h2>
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
            <div class="col-sm-2" style="padding-right: 0px; display: none;">
                <select name="txt_sale_type" class="form-control">
                    <option value="">All Sale Type</option>
                  <?php 
                    $get_sale_type = $connect->query("SELECT * FROM tbl_input_type_data ORDER BY itd_name ASC");
                    while ($row_sale_type = mysqli_fetch_object($get_sale_type)) {
                        if($row_sale_type->itd_id == @$_POST['txt_sale_type'])
                            echo '<option SELECTED value="'.$row_sale_type->itd_id.'">'.$row_sale_type->itd_name.'</option>';
                        else
                            echo '<option value="'.$row_sale_type->itd_id.'">'.$row_sale_type->itd_name.'</option>';
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
                        <th>Product Name</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Discount</th>
                        <th class="text-center">Amount</th>
                        <th>Saler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(isset($_POST['btn_search'])){
                            $v_from = @$_POST['txt_date_start'];
                            $v_to = @$_POST['txt_date_end'];
                            $v_sale_type = @$_POST['txt_sale_type'];
                            if($v_sale_type != ''){
                                $data_query = $connect->query("SELECT *,SUM(od_amount) AS s_qty,SUM(od_amount*od_price*od_amount*od_discount/100) AS s_discount FROM tbl_order_detail AS A WHERE DATE_FORMAT(od_submit_date_time,'%Y-%m-%d') BETWEEN '$v_from' AND '$v_to' AND A.od_client_id='$v_sale_type' GROUP BY od_product_id ORDER BY od_submit_date_time DESC"); 
                            }else{
                                $data_query = $connect->query("SELECT *,SUM(od_amount) AS s_qty,SUM(od_amount*od_price*od_amount*od_discount/100) AS s_discount FROM tbl_order_detail AS A WHERE DATE_FORMAT(od_submit_date_time,'%Y-%m-%d') BETWEEN '$v_from' AND '$v_to' GROUP BY od_product_id ORDER BY od_submit_date_time DESC");
                            }


                            
                        }else{
                            $current_date = date('Y-m-d');
                            $data_query = $connect->query("SELECT *,SUM(od_amount) AS s_qty,SUM(od_amount*od_price*od_amount*od_discount/100) AS s_discount FROM tbl_order_detail AS A WHERE DATE_FORMAT(od_submit_date_time,'%Y-%m-%d') = '$current_date' GROUP BY od_product_id ORDER BY od_submit_date_time DESC");
                        }
                        $no = 0;
                        $sum_qty = 0;
                        $sum_price = 0;
                        $sum_discount = 0;
                        $sum_amount = 0;
                        while ($row_data = mysqli_fetch_object($data_query)) {
                            $v_amount = $row_data->s_qty*$row_data->od_price-$row_data->s_discount;
                            $sum_price += $row_data->od_price;
                            $sum_qty += $row_data->s_qty;
                            $sum_discount += $row_data->s_discount;
                            $sum_amount += $v_amount;
                            echo '<tr>';
                                echo "<td>".(++$no)."</td>";
                                echo "<td>$row_data->od_product_name</td>";
                                echo '<th class="text-center">$ '.number_format($row_data->od_price,2).'</th>';
                                echo '<th class="text-center">'.number_format($row_data->s_qty,0).'</th>';
                                echo '<th class="text-center">$ '.number_format((float)$row_data->s_discount,2).'</th>';
                                echo '<th class="text-center">$ '.number_format($v_amount,2).'</th>';
                                echo "<td>--</td>";
                            echo '</tr>';
                        }
                    ?> 
                </tbody>
                <tfoot>
                    <th colspan="3" class="text-right">Total : </th>
                    <th class="text-center"><?= number_format($sum_qty,0) ?></th>
                    <th class="text-center">$ <?= number_format((float)$sum_discount,2) ?></th>
                    <th class="text-center">$ <?= number_format($sum_amount,2) ?></th>
                    <th colspan="1"></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php';?>