<?php include 'config/db_connect.php';
 
$ex = "SELECT * FROM exchange";
$reex = $connect->query($ex);
$do = $reex->fetch_assoc();
$do_luy = $do['exchange'];

if (isset($_POST['btn_add_dollar'])){
    $v_id = @$_POST['txt_money_latter_id'];
    $v_dollar_100 = @$_POST['txt_dollar_100'];
    $v_doller_50 = @$_POST['txt_dollar_50'];
    $v_dollar_20 = @$_POST['txt_dollar_20'];
    $v_dollar_10 = @$_POST['txt_dollar_10'];
    $v_dollar_5 = @$_POST['txt_dollar_5'];
    $v_dollar_2 = @$_POST['txt_dollar_2'];
    $v_dollar_1 = @$_POST['txt_dollar_1'];
    $v_amount_dollar = @$_POST['txt_amount_dollar_total'];
    $v_note_dollar = @$_POST['txt_note_dollar'];
    $connect->query("UPDATE  tbl_money_letter SET 
            ml_dollar_100='$v_dollar_100',
            ml_dollar_50='$v_doller_50',
            ml_dollar_20='$v_dollar_20',
            ml_dollar_10='$v_dollar_10',
            ml_dollar_5='$v_dollar_5',
            ml_dollar_2='$v_dollar_2',
            ml_dollar_1='$v_dollar_1',
            ml_dollar_total='$v_amount_dollar',
            ml_dollar_note='$v_note_dollar'
            WHERE ml_id='$v_id'");
}else if(isset($_POST['btn_add_riel'])){
    $v_id = @$_POST['txt_money_latter_id'];
    $v_riel_100000 = @$_POST['txt_riel_100000'];
    $v_riel_50000 = @$_POST['txt_riel_50000'];
    $v_riel_20000 = @$_POST['txt_riel_20000'];
    $v_riel_10000 = @$_POST['txt_riel_10000'];
    $v_riel_5000 = @$_POST['txt_riel_5000'];
    $v_riel_2000 = @$_POST['txt_riel_2000'];
    $v_riel_1000 = @$_POST['txt_riel_1000'];
    $v_riel_500 = @$_POST['txt_riel_500'];
    $v_riel_200 = @$_POST['txt_riel_200'];
    $v_riel_100 = @$_POST['txt_riel_100'];
    $v_riel_50 = @$_POST['txt_riel_50'];
    $v_amount_riel = @$_POST['txt_amount_riel_total'];
    $v_convert_to_dollar = @$_POST['txt_convert_to_dollar'];
    $v_note_riel = @$_POST['txt_note_riel'];
    $connect->query("UPDATE  tbl_money_letter SET 
            ml_riel_100000='$v_riel_100000',
            ml_riel_50000='$v_riel_50000',
            ml_riel_20000='$v_riel_20000',
            ml_riel_10000='$v_riel_10000',
            ml_riel_5000='$v_riel_5000',
            ml_riel_2000='$v_riel_2000',
            ml_riel_1000='$v_riel_1000',
            ml_riel_500='$v_riel_500',
            ml_riel_200='$v_riel_200',
            ml_riel_100='$v_riel_100',
            ml_riel_50='$v_riel_50',
            ml_riel_total='$v_amount_riel',
            ml_riel_convert_to_dollar='$v_convert_to_dollar',
            ml_riel_note='$v_note_riel'
            WHERE ml_id='$v_id'"); 
}


$date = @$_GET['date'];
$branch = @$_GET['branch'];


?>
<?php include 'header.php';?>

<!-- exchange rate -->
<input type="hidden" name="txt_exchange_rate" value="<?= $do_luy ?>">

<div class="row">
    <div style="clear:both"></div>
    </br>
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-primary"> Money Detail on <?= $date ?> :: Sheet <?= $branch ?> </h3>
                <!-- <a class="btn btn-danger" href="type_daily_amount.php"><i class="fa fa-arrow-left"></i> Back </a>    -->
                <a onclick="window.close();" class="btn btn-danger" href="#"><i class="fa fa-arrow-left"></i> Back </a>   
            </div>
            <div id="order_table">
                <div class="panel-body">
                    <?php 
                        $money_id = @$_GET['money_id'];
                        $money_detail = $connect->query("SELECT * FROM tbl_money_letter WHERE ml_dailly_money_id='$money_id'");
                        $row_money_detail = mysqli_fetch_object($money_detail);
                        // var_dump($row_money_detail);
                  
                    ?>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="#modal_dollar" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i></a>
                                                Dollar Money
                                            </th>
                                            <th>Qty Money</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>100 dollar ($)</td>
                                            <td><strong><?= $row_money_detail->ml_dollar_100 ?></strong></td>
                                            <td><strong>$ <?= number_format(($row_money_detail->ml_dollar_100)*100,2) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>50 dollar ($)</td>
                                            <td><strong><?= $row_money_detail->ml_dollar_50 ?></strong></td>
                                            <td><strong>$ <?= number_format(($row_money_detail->ml_dollar_50)*50,2) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>20 dollar ($)</td>
                                            <td><strong><?= $row_money_detail->ml_dollar_20 ?></strong></td>
                                            <td><strong>$ <?= number_format(($row_money_detail->ml_dollar_20)*20,2) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>10 dollar ($)</td>
                                            <td><strong><?= $row_money_detail->ml_dollar_10 ?></strong></td>
                                            <td><strong>$ <?= number_format(($row_money_detail->ml_dollar_10)*10,2) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>5 dollar ($)</td>
                                            <td><strong><?= $row_money_detail->ml_dollar_5 ?></strong></td>
                                            <td><strong>$ <?= number_format(($row_money_detail->ml_dollar_5)*5,2) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>2 dollar ($)</td>
                                            <td><strong><?= $row_money_detail->ml_dollar_2 ?></strong></td>
                                            <td><strong>$ <?= number_format(($row_money_detail->ml_dollar_2)*2,2) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>1 dollar ($)</td>
                                            <td><strong><?= $row_money_detail->ml_dollar_1 ?></strong></td>
                                            <td><strong>$ <?= number_format(($row_money_detail->ml_dollar_1)*1,2) ?></strong></td>
                                        </tr>
                                        <tr><td colspan="3">&nbsp;</td></tr>
                                        <tr>
                                            <td colspan="2">Total Amount Dollar ($):</td>
                                            <td><strong>$ <?= number_format($row_money_detail->ml_dollar_total,2) ?></strong></td>
                                        </tr>
                                        <tr><td colspan="3">&nbsp;</td></tr>
                                        <tr></tr>
                                        <tr>
                                            <td colspan="3">
                                                <i class="text-danger"><?= $row_money_detail->ml_dollar_note ?></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="#modal_riel" data-toggle="modal" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i></a>
                                                Riel Money
                                            </th>
                                            <th>Qty Money</th>
                                            <th>Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>10 0000 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_100000 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_100000)*100000,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>5 0000 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_50000 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_50000)*50000,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>2 0000 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_20000 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_20000)*20000,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>1 0000 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_10000 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_10000)*10000,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>5000 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_5000 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_5000)*5000,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>2000 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_2000 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_2000)*2000,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>1000 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_1000 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_1000)*1000,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>500 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_500 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_500)*500,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>200 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_200 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_200)*200,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>100 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_100 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_100)*100,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td>50 Riel (R)</td>
                                            <td><strong><?= $row_money_detail->ml_riel_50 ?></strong></td>
                                            <td><strong>R <?= number_format(($row_money_detail->ml_riel_50)*50,0) ?></strong></td>
                                        </tr>
                                        <tr><td colspan="3">&nbsp;</td></tr>
                                        <tr>
                                            <td colspan="2">Total Amount Riel (R)</td>
                                            <td><strong>R <?= number_format($row_money_detail->ml_riel_total,0) ?></strong></td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td colspan="2">Convert to Dollar ($)</td>
                                            <td><strong>$ <?= number_format($row_money_detail->ml_riel_convert_to_dollar,2) ?></strong></td>
                                        </tr>  
                                        </tr>
                                        <tr><td colspan="3">&nbsp;</td></tr>
                                        <tr></tr>
                                        <tr>
                                            <td colspan="3">
                                                <i class="text-danger"><?= $row_money_detail->ml_riel_note ?></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>









<!-- modal add -->
    <div class="modal fade" id="modal_dollar">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Type Daily Amount in Dollar</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" role="form">
                        <input readonly type="hidden" name="txt_money_latter_id" required value="<?= $row_money_detail->ml_id ?>"><br>

                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="form-group">
                                    <label for="">100 Dollar</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_dollar_100)?($row_money_detail->ml_dollar_100):(0) ?>" name="txt_dollar_100" data-value="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="">50 Dollar</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_dollar_50)?($row_money_detail->ml_dollar_50):(0) ?>" name="txt_dollar_50" data-value="50" required>
                                </div>
                                <div class="form-group">
                                    <label for="">20 Dollar</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_dollar_20)?($row_money_detail->ml_dollar_20):(0) ?>" name="txt_dollar_20" data-value="20" required>
                                </div>
                                <div class="form-group">
                                    <label for="">10 Dollar</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_dollar_10)?($row_money_detail->ml_dollar_10):(0) ?>" name="txt_dollar_10" data-value="10" required>
                                </div>
                                <div class="form-group">
                                    <label for="">5 Dollar</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_dollar_5)?($row_money_detail->ml_dollar_5):(0) ?>" name="txt_dollar_5" data-value="5" required>
                                </div>
                                <div class="form-group">
                                    <label for="">2 Dollar</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_dollar_2)?($row_money_detail->ml_dollar_2):(0) ?>" name="txt_dollar_2" data-value="2" required>
                                </div>
                                <div class="form-group">
                                    <label for="">1 Dollar</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_dollar_1)?($row_money_detail->ml_dollar_1):(0) ?>" name="txt_dollar_1" data-value="1" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Total Dollar ($)</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_dollar_total)?($row_money_detail->ml_dollar_total):(0) ?>" name="txt_amount_dollar_total" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Note Dollar</label>
                                    <textarea name="txt_note_dollar" class="form-control" rows="4"><?= $row_money_detail->ml_dollar_note ?></textarea>
                                </div>
                                <hr>
                                <button type="submit" name="btn_add_dollar" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i>Add</button>
                                <button type="reset" class="btn btn-warning"><i class="fa fa-eraser fa-fw"></i>Reset</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-fw"></i>Close</button>
                                <br><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_riel">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Type Daily Amount in Riel</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" role="form">
                        <input readonly type="hidden" name="txt_money_latter_id" required value="<?= $row_money_detail->ml_id ?>"><br>
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="form-group">
                                    <label for="">10 0000 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_100000)?($row_money_detail->ml_riel_100000):(0) ?>" name="txt_riel_100000" data-value="100000" required>
                                </div>
                                <div class="form-group">
                                    <label for="">5 0000 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_50000)?($row_money_detail->ml_riel_50000):(0) ?>" name="txt_riel_50000" data-value="50000" required>
                                </div>
                                <div class="form-group">
                                    <label for="">2 0000 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_20000)?($row_money_detail->ml_riel_20000):(0) ?>" name="txt_riel_20000" data-value="20000" required>
                                </div>
                                <div class="form-group">
                                    <label for="">10000 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_10000)?($row_money_detail->ml_riel_10000):(0) ?>" name="txt_riel_10000" data-value="10000" required>
                                </div>
                                <div class="form-group">
                                    <label for="">5000 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_5000)?($row_money_detail->ml_riel_5000):(0) ?>" name="txt_riel_5000" data-value="5000" required>
                                </div>
                                <div class="form-group">
                                    <label for="">2000 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_2000)?($row_money_detail->ml_riel_2000):(0) ?>" name="txt_riel_2000" data-value="2000" required>
                                </div>
                                <div class="form-group">
                                    <label for="">1000 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_1000)?($row_money_detail->ml_riel_1000):(0) ?>" name="txt_riel_1000" data-value="1000" required>
                                </div>
                                <div class="form-group">
                                    <label for="">500 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_500)?($row_money_detail->ml_riel_500):(0) ?>" name="txt_riel_500" data-value="500" required>
                                </div>
                                <div class="form-group">
                                    <label for="">200 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_200)?($row_money_detail->ml_riel_200):(0) ?>" name="txt_riel_200" data-value="200" required>
                                </div>
                                <div class="form-group">
                                    <label for="">100 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_100)?($row_money_detail->ml_riel_100):(0) ?>" name="txt_riel_100" data-value="100" required>
                                </div>
                                <div class="form-group">
                                    <label for="">50 Riel</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_50)?($row_money_detail->ml_riel_50):(0) ?>" name="txt_riel_50" data-value="50" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Total Riel (R)</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_total)?($row_money_detail->ml_riel_total):(0) ?>" name="txt_amount_riel_total" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Convert to Dollar ($)</label>
                                    <input type="number" min="0" class="form-control" value="<?= ($row_money_detail->ml_riel_convert_to_dollar)?($row_money_detail->ml_riel_convert_to_dollar):(0) ?>" name="txt_convert_to_dollar" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Note Riel</label>
                                    <textarea name="txt_note_riel" class="form-control" rows="4"><?= $row_money_detail->ml_riel_note ?></textarea>
                                </div>
                                <hr>
                                <button type="submit" name="btn_add_riel" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i>Add</button>
                                <button type="reset" class="btn btn-warning"><i class="fa fa-eraser fa-fw"></i>Reset</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-fw"></i>Close</button>
                                <br><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- end modal add -->

<script type="text/javascript" src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("input[name^=txt_dollar_]").keyup(function(){
            $total_dollar = 0;
            $("input[name^=txt_dollar_]").each(function(d){
                $total_dollar += parseInt($("input[name^=txt_dollar_]").eq(d).val()*$("input[name^=txt_dollar_]").eq(d).attr('data-value'));
            });
            $("input[name=txt_amount_dollar_total]").val($total_dollar);
        });
        $("input[name^=txt_riel_]").keyup(function(){
            $total_riel = 0;
            $("input[name^=txt_riel_]").each(function(d){
                $total_riel += parseInt($("input[name^=txt_riel_]").eq(d).val()*$("input[name^=txt_riel_]").eq(d).attr('data-value'));
            });
            $("input[name=txt_amount_riel_total]").val($total_riel);
            
            $exchange_rate = $("input[name=txt_exchange_rate]").val();
            $("input[name=txt_convert_to_dollar]").val($total_riel/$exchange_rate);


        });

    });
</script>

<?php include 'footer.php';?>