<?php
	include'config/db_connect.php';
	
	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * from bill where bi_id = $id";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	
	}
	if(!empty($_POST["id"])){
			$id = $_POST["id"];

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

			$sql = "UPDATE bill SET bi_border = '$v_border'
									, bi_origin = '$v_origin'
									, bi_customer = '$v_customer'
									, bi_etd = '$v_etd'
									, bi_eta = '$v_eta'
									, bi_handing = '$v_handing'
									, bi_transfer = '$v_transfer'
									, bi_date = '$v_date'
									, bi_highlight_start = '$show_start_1201'
									, bi_highlight_end = '$show_end_1159'
									WHERE bi_id = '$id'" ;
			mysqli_query($connect, $sql);
			header("location:bill.php?message=update");
	}	
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />


<?php include 'header.php';?>
      <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                	<h2 class="text-primary">Edit Bill</h2>
                	<hr>
                </div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">
							<input type = "hidden" name = "id" value = "<?php echo $id; ?>">          
								
		                        <div class="form-group col-xs-6">
		                            <label for ="">Bill No:</label>                                          
		                       		<input class="form-control" readonly ​name="txt_bi_number" type="text" value="<?php echo $row["bi_number"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Border:</label>                                          
									<select class="form-control"  name="txt_bi_border">
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
		                       		<input class="form-control" name="txt_bi_origin" type="text" value="<?php echo $row["bi_origin"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Customer:</label>                                          
									<select name="txt_bi_customer" class="selectpicker form-control" data-show-subtext="false" data-live-search="true">
										<?php
											$select1 = "SELECT * FROM customer";
											$query1  = mysqli_query($connect,$select1);
											while($row1 = $query1->fetch_assoc()):
											$selected=($row['bi_customer']==$row1['cus_id']?"selected":"");
										?>
										<option <?= $selected; ?> value="<?= $row1['cus_id']; ?>"><?= $row1['cus_name']; ?>(<?= $row1['cus_num_id']; ?>)</option>
										<?php endwhile; ?>
									</select>
								</div>
								<div class="form-group col-xs-6">
		                            <label for ="">ETD:</label>                                          
		                       		<input class="form-control" name="txt_bi_etd" id="id_text_date_start" type="date" value="<?php echo $row["bi_etd"]?>" onchange="gettext()">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">ETA:</label>                                          
		                       		<input class="form-control" name="txt_bi_eta" id="id_text_date_end" type="date" value="<?php echo $row["bi_eta"]?>" onchange="gettext()">
									   <p id="demo" style="color:red"></p>
								</div>
								<div class="form-group col-xs-6">
		                            <label for ="">Handing Remark:</label>                                          
		                       		<input class="form-control" name="txt_bi_handing" type="text" value="<?php echo $row["bi_handing"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Tran Mode:</label>                                          
		                       		<input class="form-control" name="txt_bi_transfer" type="text" value="<?php echo $row["bi_transfer"]?>">
		                        </div>
								<div class="form-group col-xs-6">
		                            <label for ="">Date:</label>                                          
		                       		<input class="form-control" name="txt_bi_date" type="date" value="<?php echo $row["bi_date"]?>">
		                        </div>
								
								<div class="form-group col-xs-12">
									<button type="submit" value="update" class="btn btn-primary btn-sm"><i class="fa fa-edit fa-fw"></i> Update</button>
									<a href="bill.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								</div> 
							</form>
						</div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>