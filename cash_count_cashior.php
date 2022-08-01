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
    $v_convert_dollar = @$_POST['txt_convert_to_dollar'];
    $v_total_amount = $v_convert_dollar+$v_totel_dollar;
    $v_note = @$_POST['txt_note'];
    $v_status = @$_POST['txt_sheet_status'];
    $connect->query("INSERT INTO tbl_type_daily_amount (tda_option,tda_date,tda_sheet,tda_total_dollar,tda_total_riel,tda_convert_to_dollar,tda_total_amount, tda_employee,tda_note) 
        VALUES('$v_status','$v_date','$v_sheet','$v_totel_dollar','$v_total_riel','$v_convert_dollar','$v_total_amount','$v_employee','$v_note')");
    $last_id = $connect->insert_id;

	
	$v_dollar_100 = @$_POST['txt_dollar_100'];
    $v_doller_50 = @$_POST['txt_dollar_50'];
    $v_dollar_20 = @$_POST['txt_dollar_20'];
    $v_dollar_10 = @$_POST['txt_dollar_10'];
    $v_dollar_5 = @$_POST['txt_dollar_5'];
    $v_dollar_2 = @$_POST['txt_dollar_2'];
    $v_dollar_1 = @$_POST['txt_dollar_1'];
	
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
	
    $connect->query("INSERT INTO tbl_money_letter (
				ml_dailly_money_id,
				ml_dollar_100,
				ml_dollar_50,
				ml_dollar_20,
				ml_dollar_10,
				ml_dollar_5,
				ml_dollar_2,
				ml_dollar_1,
				ml_dollar_total,
				ml_riel_100000,
				ml_riel_50000,
				ml_riel_20000,
				ml_riel_10000,
				ml_riel_5000,
				ml_riel_2000,
				ml_riel_1000,
				ml_riel_500,
				ml_riel_200,
				ml_riel_100,
				ml_riel_50,
				ml_riel_total,
				ml_riel_convert_to_dollar,
				ml_grand_total,
				ml_employee
				
				) VALUES(
				'$last_id',
				'$v_dollar_100',
				'$v_doller_50',
				'$v_dollar_20',
				'$v_dollar_10',
				'$v_dollar_5',
				'$v_dollar_2',
				'$v_dollar_1',
				'$v_totel_dollar',
				'$v_riel_100000',
				'$v_riel_50000',
				'$v_riel_20000',
				'$v_riel_10000',
				'$v_riel_5000',
				'$v_riel_2000',
				'$v_riel_1000',
				'$v_riel_500',
				'$v_riel_200',
				'$v_riel_100',
				'$v_riel_50',
				'$v_total_riel',
				'$v_convert_dollar',
				'$v_total_amount',
				'$v_employee'
				)");		
				
		echo '<script> window.location.replace("print_cash_count_cashior.php?cc_id='.$last_id.'"); </script>';
				
}else if (@$_GET['del_id']!=""){
    
}else if (isset($_POST['btn_update'])){
    
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
            </div> 
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
                                            $get_dt_amount = $connect->query("SELECT * FROM tbl_type_daily_amount AS A LEFT JOIN employee AS C ON A.tda_employee=C.emp_id WHERE tda_date BETWEEN '$from' AND '$to'");
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
                                                    echo '<td>'. $row['tda_sheet'].' </td>';
                                                    echo '<td>'. $row['name_english'].' </td>';
                                                    echo '<td>$ '. number_format($row['tda_total_dollar'],2).' </td>';
                                                    echo '<td>R '. number_format($row['tda_total_riel'],2).' </td>';
                                                    echo '<td>$ '. number_format($row['tda_convert_to_dollar'],2).' </td>';
                                                    echo '<td>$ '. number_format($row['tda_total_amount'],2).' </td>';
                                                    echo '<td>'. $row['tda_note'].' </td>';
                                                    echo '<td class="text-center"> 
                                                        <a  data-toggle="modal" target="_blank" href="money_letter_detail.php?date='.$row['tda_date'].'&branch='.$row['tda_sheet'].'&money_id='.$row['tda_id'].'" class="btn btn-xs btn-primary" title="money detail"><i class="fa fa-money"></i></a> 
                                                        </td>';
                                                echo '</tr>';
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
                    
                        <input type="hidden" value="<?= $_SESSION['user_id'] ?>" name="txt_employee">
						<input type="hidden" value="0" name="txt_convert_to_dollar">
						<input type="hidden" name="txt_exchange_rate" value="<?= $do_luy ?>"/>

						</div>
						 <div class="">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="">100 Dollar</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_dollar_100" data-value="100" required>
									</div>
									<div class="form-group">
										<label for="">50 Dollar</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_dollar_50" data-value="50" required>
									</div>
									<div class="form-group">
										<label for="">20 Dollar</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_dollar_20" data-value="20" required>
									</div>
									<div class="form-group">
										<label for="">10 Dollar</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_dollar_10" data-value="10" required>
									</div>
									<div class="form-group">
										<label for="">5 Dollar</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_dollar_5" data-value="5" required>
									</div>
									<div class="form-group">
										<label for="">2 Dollar</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_dollar_2" data-value="2" required>
									</div>
									<div class="form-group">
										<label for="">1 Dollar</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_dollar_1" data-value="1" required>
									</div>
									<div class="form-group">
										<label for="">Total Dollar ($)</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_total_dollar" required readonly>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="">10 0000 Riel</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_riel_100000" data-value="100000" required>
									</div>
									<div class="form-group">
										<label for="">5 0000 Riel</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_riel_50000" data-value="50000" required>
									</div>
									<div class="form-group">
										<label for="">2 0000 Riel</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_riel_20000" data-value="20000" required>
									</div>
									<div class="form-group">
										<label for="">10000 Riel</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_riel_10000" data-value="10000" required>
									</div>
									<div class="form-group">
										<label for="">5000 Riel</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_riel_5000" data-value="5000" required>
									</div>
									<div class="form-group">
										<label for="">2000 Riel</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_riel_2000" data-value="2000" required>
									</div>
									<div class="form-group">
										<label for="">1000 Riel</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_riel_1000" data-value="1000" required>
									</div>
									<div class="form-group">
										<label for="">500 Riel</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_riel_500" data-value="500" required>
									</div>
									
									<input type="hidden" min="0" class="form-control" value="0" name="txt_riel_200" data-value="200" required>
							
									<div class="form-group">
										<label for="">100 Riel</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_riel_100" data-value="100" required>
									</div>
									<input type="hidden" min="0" class="form-control" value="0" name="txt_riel_50" data-value="50" required>
								
									<div class="form-group">
										<label for="">Total Riel (R)</label>
										<input type="number" min="0" class="form-control" value="0" name="txt_total_riel" required readonly>
									</div>
								</div>
                       </div>
						
                        <button type="submit" style="margin-left: 15px;" name="btn_add" class="btn btn-primary"><i class="fa fa-plus fa-fw"></i>Add</button>
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
    $(document).ready(function() {
        $('.display').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("input[name^=txt_dollar_]").keyup(function(){
            $total_dollar = 0;
            $("input[name^=txt_dollar_]").each(function(d){
                $total_dollar += parseInt($("input[name^=txt_dollar_]").eq(d).val()*$("input[name^=txt_dollar_]").eq(d).attr('data-value'));
            });
            $("input[name=txt_total_dollar]").val($total_dollar);
        });
        $("input[name^=txt_riel_]").keyup(function(){
            $total_riel = 0;
            $("input[name^=txt_riel_]").each(function(d){
                $total_riel += parseInt($("input[name^=txt_riel_]").eq(d).val()*$("input[name^=txt_riel_]").eq(d).attr('data-value'));
            });
            $("input[name=txt_total_riel]").val($total_riel);
            
            $exchange_rate = $("input[name=txt_exchange_rate]").val();
            $("input[name=txt_convert_to_dollar]").val($total_riel/$exchange_rate);
        });

    });
</script>
<?php include 'footer.php';?>