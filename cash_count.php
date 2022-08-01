<?php include 'config/db_connect.php';
 
$ex = "SELECT * FROM exchange";
$reex = $connect->query($ex);
$do = $reex->fetch_assoc();
$do_luy = $do['exchange'];

if(isset($_POST['btn_add'])){
    $v_date = @$_POST['txt_date'];
    $v_sheet = @$_POST['txt_sheet'];
    $v_employee = @$_POST['txt_employee'];
    $v_totel_dollar = @$_POST['txt_total_dollar'];
    $v_total_riel = @$_POST['txt_total_riel'];
    $v_convert_dollar = @$_POST['txt_convert_dollar'];
    $v_total_amount = @$_POST['txt_total_amount'];
    $v_note = @$_POST['txt_note'];
	$v_shift_status = @$_POST['txt_sheet_status'];
    $connect->query("INSERT INTO tbl_type_daily_amount (tda_option,tda_date,tda_sheet,tda_total_dollar,tda_total_riel,tda_convert_to_dollar,tda_total_amount, tda_employee,tda_note) 
        VALUES('$v_shift_status','$v_date','$v_sheet','$v_totel_dollar','$v_total_riel','$v_convert_dollar','$v_total_amount','$v_employee','$v_note')");
    $last_id = $connect->insert_id;


    $connect->query("INSERT INTO tbl_money_letter (ml_dailly_money_id) VALUES('$last_id')");


}else if (@$_GET['del_id']!=""){
    $del_id = @$_GET['del_id'];
    $connect->query("DELETE FROM tbl_type_daily_amount WHERE tda_id='$del_id'");
    $connect->query("DELETE FROM tbl_money_letter WHERE ml_dailly_money_id='$del_id'");
}else if (isset($_POST['btn_update'])){
    $v_id = @$_POST['txt_id'];
    $v_date = @$_POST['txt_date'];
    $v_sheet = @$_POST['txt_sheet'];
    $v_employee = @$_POST['txt_employee'];
    $v_totel_dollar = @$_POST['txt_total_dollar'];
    $v_total_riel = @$_POST['txt_total_riel'];
    $v_convert_dollar = @$v_total_riel/$do_luy;
    $v_total_amount = @$v_convert_dollar+$v_totel_dollar;
    $v_note = @$_POST['txt_note'];
	$v_status = @$_POST['txt_sheet_status'];
    $connect->query("UPDATE  tbl_type_daily_amount SET 
                                    tda_date='$v_date',
                                    tda_sheet='$v_sheet',
                                    tda_total_dollar='$v_totel_dollar',
                                    tda_total_riel='$v_total_riel',
                                    tda_convert_to_dollar='$v_convert_dollar',
                                    tda_total_amount='$v_total_amount',
                                    tda_employee='$v_employee',
                                    tda_note='$v_note',
									tda_option='$v_status'
                                    WHERE tda_id='$v_id'");
}


$from = "";
$to = "";   
?>
<?php include 'header.php';?>
<div class="row">
    <div style="clear:both"></div>
    </br>
    <input type="hidden" name="txt_exchange" value="<?= $do_luy ?>" />
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <button type="button" class="btn btn-primary"  data-toggle="modal" href='#modal-id'><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New </button>   
                <h3 class="text-primary"> Type Daily Amount Report</h3>
                <hr>
                <form class="form-inline" method="post" action="">
                    <div class="form-group">
                        <label for="email">From:</label>
                        <input type="text" class="form-control" id="datepicker" name="from" value="<?= @$_POST['from'] ?>" data-date-format="yyyy-mm-dd">
                    </div>
                    <div class="form-group">
                        <label for="pwd">To:</label>
                        <input type="text" class="form-control" id="datepicker1" name="to" value="<?= @$_POST['to'] ?>" data-date-format="yyyy-mm-dd">
                    </div>
                    <button type="submit" name="search" class="btn btn-success">Search</button>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-warning"><i class="fa fa-refresh" aria-hidden="true"></i> Clear</a>
                    <a href="dashboard.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                </form>
            </div>  
            <div id="order_table">
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php 
                            if(isset($_POST['search'])){
                                $from = $_POST['from'];
                                $to = $_POST['to'];
                                    echo '<table class="display nowrap table" width="100%" border="1" cellspacing="0">';
                                        echo '<thead>';
                                            echo '<tr>';
                                                echo '<th>#</th>';
                                                echo '<th>Print</th>';
                                                echo '<th>Date</th>';
                                                echo '<th>Sheet</th>';
                                                echo '<th>Employee</th>';
                                                echo '<th>Amount Dollar</th>';
                                                echo '<th>Amount Riel</th>';
                                                echo '<th>Convert to Dollar</th>';
                                                echo '<th>Total amount</th>';
                                                echo '<th>Note</th>';
                                                echo '<th class="text-center"><i class="fa fa-cog fa-fw fa-spin"></i> Action</th>';
                                            echo '</tr>';
                                        echo '</thead>';
                                        echo '<tbody>';
                                            $get_dt_amount = $connect->query("SELECT * FROM tbl_type_daily_amount AS A LEFT JOIN user AS C ON A.tda_employee=C.id WHERE tda_date BETWEEN '$from' AND '$to'");
                                            $i=0;
                                            $total_dollar = 0;
                                            $total_riel = 0;
                                            $conver_dollar = 0;
                                            $v_real_expense = 0;
                                            while($row = $get_dt_amount->fetch_assoc()){   
                                             
                                                $total_dollar += $row['tda_total_dollar'];
                                                $total_riel += $row['tda_total_riel'];
                                                $conver_dollar += $row['tda_convert_to_dollar'];
                                                $v_real_expense += $row['tda_real_expense'];
                                                echo '<tr>';
                                                    echo '<td>'. (++$i) .' </td>';
                                                    echo '<td class="text-center">
                                                        <a target="_blank" href="print_cash_count.php?cc_id='.$row['tda_id'].'" class="btn btn-xs btn-info"><i class="fa fa-print fa-fw"></i></a>
                                                    </td>';
                                                    echo '<td>'. $row['tda_date'].' </td>';
                                                    echo '<td>'.$row['tda_option'].' :: '. $row['tda_sheet'].' </td>';
                                                    echo '<td>'. $row['username'].' </td>';
                                                    echo '<td>$ '. number_format($row['tda_total_dollar'],2).' </td>';
                                                    echo '<td>R '. number_format($row['tda_total_riel'],2).' </td>';
                                                    echo '<td>$ '. number_format($row['tda_convert_to_dollar'],2).' </td>';
                                                    echo '<td>$ '. number_format($row['tda_total_amount'],2).' </td>';
                                                    echo '<td>'. $row['tda_note'].' </td>';
                                                    echo '<td class="text-center"> 
                                                        <a  data-toggle="modal" target="_blank" href="money_letter_detail.php?date='.$row['tda_date'].'&branch='.$row['tda_sheet'].'&money_id='.$row['tda_id'].'" class="btn btn-xs btn-primary" title="money detail"><i class="fa fa-money"></i></a> 
                                                        <a  data-toggle="modal" href="#'.$i.'" class="btn btn-xs btn-warning" title="edit"><i class="fa fa-edit"></i></a> 
                                                        <a href="cash_count.php?del_id='.$row['tda_id'].'" class="btn btn-xs btn-danger" title="delete" onclick="return confirm(\'Are you sure to delete?\')"><i class="fa fa-trash"></i></a> 
                                                     </td>';
                                                echo '</tr>';
                                                ?>
                                                    <div class="modal fade" id="<?= $i ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                    <h4 class="modal-title">Edit Daily Amount</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="" class="form_edit" method="POST" role="form">
                                                                        <input type="hidden" name="txt_id" value="<?= $row['tda_id'] ?>">
                                                                       <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Date</label>
                                                                                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                                                        <input type="text" class="form-control" name="txt_date" required value="<?= $row['tda_date'] ?>">
                                                                                        <div class="input-group-addon">
                                                                                            <span class="glyphicon glyphicon-th"></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
																					<div class="col-xs-6" style="padding-right: 0px;">
																						<div class="form-group">
																							<label for="">Status</label>
																						   <select required class="form-control" name="txt_sheet_status" required> 
																								<option value="">==status==</option>
																								<option <?= ($row['tda_option']=="បើកវេន")?('SELECTED'):(' ') ?> value="បើកវេន">Start</option>
																								<option <?= ($row['tda_option']=="បិទវេន")?('SELECTED'):(' ') ?> value="បិទវេន">End</option>
																						   </select>
																						</div>
																					</div>
																					<div class="col-xs-6">
																						<div class="form-group">
																							<label for="">Shift</label>
																						   <input type="text" required class="form-control" value="<?= $row['tda_sheet'] ?>" name="txt_sheet" required> 
																						</div>
																					</div>
																				</div>
                                                                            </div>
                                                                       </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Total Dollar</label>
                                                                                    <input type="text" class="form-control" value="<?= $row['tda_total_dollar'] ?>" name="txt_total_dollar" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Total Riel</label>
                                                                                    <input type="text" class="form-control" value="<?= $row['tda_total_riel'] ?>" name="txt_total_riel" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Employee</label>
                                                                                    <select required class="form-control" name="txt_employee" required>
                                                                                    <option value="">--Select Employee--</option>
                                                                                    <?php
                                                                                        $employee = mysqli_query($connect,"SELECT * FROM employee ORDER BY name_english ASC");
                                                                                        while ($row3 = mysqli_fetch_assoc($employee)) {
                                                                                            if($row['tda_employee'] == $row3['emp_id']){

                                                                                            echo '<option SELECTED="SELECTED" value="'.$row3['emp_id'].'">'.$row3['name_english'].' :: '.$row3['name_khmer'].'</option>';
                                                                                            }else{

                                                                                            echo '<option value="'.$row3['emp_id'].'">'.$row3['name_english'].' :: '.$row3['name_khmer'].'</option>';
                                                                                            }
                                                                                        }
                                                                                    ?>   
                                                                               </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <label for="">Note</label>
                                                                                    <input type="text" class="form-control" value="<?= $row['tda_note'] ?>" name="txt_note">
                                                                                </div>
                                                                            </div>
                                                                       </div>
                                                                        <div class="clearfix"></div>
                                                                        
                                                                    
                                                                        <button type="submit" name="btn_update" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Update</button>
                                                                        <button type="reset" class="btn btn-warning"><i class="fa fa-eraser fa-fw"></i>Reset</button>
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo fa-fw"></i> Cancel</button>
                                                                    </form> 
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                $i++; 
                                                } 
                                        echo '</tbody>';   
                                        echo '<tfoot>';
                                            echo '<tr>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                                echo '<th>$ '.number_format($total_dollar,2).'</th>';
                                                echo '<th>R '.number_format($total_riel,2).'</th>';
                                                echo '<th>$ '.number_format($conver_dollar,2).'</th>';
                                                echo '<th>$ '.number_format($total_dollar+$conver_dollar,2).'</th>';
                                                echo '<th></th>';
                                                echo '<th></th>';
                                            echo '</tr>';
                                        echo '</tfoot>'; 
                                    echo '</table>';
                                }
                         ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>









<!-- modal add -->
    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Type Daily Amount</h4>
                </div>
                <div class="modal-body">
                    <form action="" id="form_add" method="POST" role="form">
                    
                       <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                        <input type="text" class="form-control" name="txt_date" required value="<?= date('Y-m-d') ?>">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
								<div class="row">
									<div class="col-xs-6" style="padding-right: 0px;">
										<div class="form-group">
											<label for="">Status</label>
										   <select required class="form-control" name="txt_sheet_status" required> 
												<option value="">==status==</option>
												<option value="បើកវេន">Start</option>
												<option value="បិទវេន">End</option>
										   </select>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label for="">Shift</label>
										   <input type="text" required class="form-control" name="txt_sheet" required> 
										</div>
									</div>
								</div>
                            </div>
                       </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Total Dollar</label>
                                    <input type="text" class="form-control" value="0" name="txt_total_dollar" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Total Riel</label>
                                    <input type="text" class="form-control" value="0" name="txt_total_riel" required>
                                </div>
                            </div>
                       </div>
                    
                         <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Convert To Dollar</label>
                                    <input type="text" class="form-control" value="0" name="txt_convert_dollar" required readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Total Amount</label>
                                    <input type="text" class="form-control" value="0" name="txt_total_amount" required readonly>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Employee</label>
                                    <select required class="form-control" name="txt_employee" required>
                                    <option value="">--Select Employee--</option>
                                    <?php
                                        $employee = mysqli_query($connect,"SELECT * FROM user ORDER BY username ASC");
                                        while ($row3 = mysqli_fetch_assoc($employee)) {
                                            echo '<option SELECTED="SELECTED" value="'.$row3['id'].'">'.$row3['username'].'</option>';
                                        }
                                    ?>   
                               </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Note</label>
                                    <input type="text" class="form-control" value="" name="txt_note">
                                </div>
                            </div>
                       </div>
                    
                        
                    
                        <button type="submit" name="btn_add" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i>Add</button>
                        <button type="reset" class="btn btn-warning"><i class="fa fa-eraser fa-fw"></i>Reset</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo fa-fw"></i> Cancel</button>
                    </form><br><br>
                </div>
            </div>
        </div>
    </div>
<!-- end modal add -->

<script type="text/javascript" src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $exchange_rate = $("input[name=txt_exchange]").val();
        $('#form_add input').keyup(function(){
            $amount_riel = $('#form_add input[name=txt_total_riel]').val();
            $amount_dollar = $('#form_add input[name=txt_total_dollar]').val();
            $convert_dollar = $amount_riel/$exchange_rate;
            // $real_expense = $('#form_add input[name=txt_real_expense]').val();
            $('#form_add input[name=txt_convert_dollar]').val($convert_dollar.toFixed(2));
            $('#form_add input[name=txt_total_amount]').val((parseFloat($convert_dollar)+parseFloat($amount_dollar)).toFixed(2));
        });        
    });

</script>
<script>
    $(document).ready(function() {
        $('.display').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>

<?php include 'footer.php';?>