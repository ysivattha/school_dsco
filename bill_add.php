<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
	$month = date('Y-m');

	$errors = ""; 
	$sql = "SELECT * FROM bill AS A
									";
	$result = $connect->query($sql);

	if(isset($_POST["btnadd"])){

		$v_number   =$_POST['txt_bi_number'];
		$v_border  =$_POST["txt_bi_border"];
		$v_origin  =$_POST["txt_bi_origin"];
		$v_customer    =$_POST["txt_bi_customer"];
		$v_etd    =$_POST["txt_bi_etd"];
		$v_eta     =$_POST["txt_bi_eta"];
		$v_handing =$_POST["txt_bi_handing"];
		$v_transfer =$_POST["txt_bi_transfer"];
		$v_date   =$_POST["txt_bi_date"];

		$today = $_POST["txt_bi_eta"];
		$today1159 = date('Y-m-d', strtotime($today . ' -1 day'));
		$show_start_1201 = $today1159." 12:01:01";
	
		$tomorrow = date('Y-m-d', strtotime($today . ' +0 day'));
		$show_end_1159 = $tomorrow." 11:59:59";

		$dup=mysqli_query($connect, "SELECT * FROM bill
                                        WHERE bi_number='$v_number'
                                        ");
		if(mysqli_num_rows($dup)>0)
		{
			$dup_inv = "this invoice number has ready, please input new";
		}else{

				$sql = "INSERT INTO bill (bi_number
										, bi_border 
										, bi_origin 
										, bi_customer
										, bi_etd
										, bi_eta
										, bi_handing
										, bi_transfer
										, bi_date
										, bi_highlight_start
										, bi_highlight_end
													)
									VALUES
										('$v_number'
										, '$v_border'
										, '$v_origin'
										, '$v_customer'
										, '$v_etd'
										, '$v_eta'
										, '$v_handing'
										, '$v_transfer'
										, '$v_date'
										, '$show_start_1201'
										, '$show_end_1159'
														)";
				$result = mysqli_query($connect, $sql);
				if($result){
					$sql_max = "SELECT MAX(bi_id) AS maxid FROM bill
													";
					$result_max = $connect->query($sql_max);
					$row_max = $result_max->fetch_assoc();
					$get_max = $row_max['maxid'];

					header("location:bill_detail.php?id=$get_max");
				}
		}


	}

?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

<?php include 'header.php';?>
      <div class="row">
        <div class="col-lg-12">
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
            <div class="panel panel-default">
                	<div class="panel-body"><h2 class="text-primary">Add Bill</h2>
                		<hr>
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-6">
		                            <label for ="">Bill No:</label>                                          
		                       		<input class="form-control" required name="txt_bi_number" type="text" value="<?php echo @$v_invoice; ?>">
										<span style="color:red">
											<?php
												echo @$dup_inv;
											?>
										</span>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Border:</label> 
									<select class="form-control select2" name="txt_bi_border" data-live-search="true" >
									<option value="">=== choose here ===</option>
										<?php
											$select1 = "SELECT * FROM border";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bi_border']==$row1['bo_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['bo_id']; ?>"><?= $row1['bo_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Origin:</label>                                          
		                       		<input class="form-control" name="txt_bi_origin" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer:</label> 
									
									<select name="txt_bi_customer" class="form-control select2" data-live-search="true" >
									<option value="">=== choose here ===</option>
										<?php
										
											$select1 = "SELECT * FROM customer";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bi_customer']==$row1['cus_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['cus_id']; ?>"><?= $row1['cus_num_id'].' : '.$row1['cus_name']; ?></option>
										<?php endwhile; ?>
									</select>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">ETD:</label>                                          
		                       		<input class="form-control"  name="txt_bi_etd" id="id_text_date_start" type="date" onchange="gettext()">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">ETA:</label>                                          
		                       		<input class="form-control" required name="txt_bi_eta" id="id_text_date_end" type="date" onchange="gettext()" >
									   <p id="demo" style="color:red"></p>
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Handing Remark:</label>                                          
		                       		<input class="form-control" name="txt_bi_handing" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Transer Mode:</label>                                          
		                       		<input class="form-control" name="txt_bi_transfer" type="text" >
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Date Input:</label>                                          
		                       		<input class="form-control" required name="txt_bi_date" type="date" >
		                        </div>

								<div class="form-group col-xs-12">
									<button type="submit" name="btnadd" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Save & Add Container</button>
									<a href="bill.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
					</div>
				</div>
			
		</div>

	<script>
		function gettext(){

            const startdate = document.getElementById('id_text_date_start').value
            const enddate = document.getElementById('id_text_date_end').value

            let greeting;

            if (enddate < startdate) {
                greeting = "the ETA Date cannot before than ETD Date";
            }else{
                greeting = " "
            }

            document.getElementById("demo").innerHTML = greeting;
        
		}
    
    </script>

<?php include 'footer.php';?>