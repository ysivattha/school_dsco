<?php include'config/db_connect.php';

	date_default_timezone_set("Asia/Bangkok");
	$today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
	$month = date('Y-m');

	if(isset($_GET["id"])){
		$id = $_GET["id"];
		$sql = "SELECT * FROM bill AS A
							LEFT JOIN customer AS CUS ON CUS.cus_id=A.bi_customer
							LEFT JOIN border AS BOR ON BOR.bo_id=A.bi_border
							WHERE bi_id = $id
												";
		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_array($result);	

		$v_etd=$row["bi_etd"];
	}

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

		$sql = "INSERT INTO bill (bi_number
								, bi_border 
								, bi_origin 
								, bi_customer
								, bi_etd
								, bi_eta
								, bi_handing
								, bi_transfer
								, bi_date
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
												)";
		$result = mysqli_query($connect, $sql);
		if($result){
			header('location:bill.php?message=success');
		}
		
	}

?>
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
                	<div class="panel-body"><h2 class="text-primary">Add Customer</h2>
                	
                	</div>
                   	<div class = "panel-body">
						<div class="col-md-12">
							<form method="post" enctype="multipart/form-data" action="">         
								<div class="form-group col-xs-6">
									<div class="col-xs-4"> 
		                            	<label for ="">Bill No:</label>   
									</div> 
									<div class="col-xs-8">                                  
		                       			<input readonly class="form-control" name="txt_bi_number" type="text" value="<?php echo $row["bi_number"]?>">
									</div>
		                        </div>
								<div class="form-group col-xs-6">
									<div class="col-xs-4"> 
										<label for ="">Border:</label>
									</div> 
									<div class="col-xs-8">                                           
										<input readonly class="form-control" name="txt_bi_border" type="text" value="<?php echo $row["bo_name"]?>">
									</div>
		                        </div>
								<div class="form-group col-xs-6">
									<div class="col-xs-4"> 
										<label for ="">Origin:</label>  
									</div> 
									<div class="col-xs-8">                                       
										<input readonly class="form-control" name="txt_bi_origin" type="text" value="<?php echo $row["bi_origin"]?>">
									</div>
		                        </div>
								<div class="form-group col-xs-6">
									<div class="col-xs-4"> 
										<label for ="">Customer:</label>      
									</div> 
									<div class="col-xs-8"> 										
										<input readonly class="form-control" name="txt_bi_customer" type="text" value="<?php echo $row["cus_name"]?>">
									</div>
		                        </div>
								<div class="form-group col-xs-6">
									<div class="col-xs-4"> 
										<label for ="">ETD:</label>  
									</div> 
									<div class="col-xs-8"> 	                                        
										<input readonly class="form-control" name="txt_bi_etd" type="text" value="<?php echo date('d-M-Y',strtotime($row["bi_etd"])); ?>">
									</div>
		                        </div>
								<div class="form-group col-xs-6"> 
									<div class="col-xs-4"> 
										<label for ="">ETA:</label>  
									</div> 
									<div class="col-xs-8"> 	                                        
										<input readonly class="form-control" name="txt_bi_eta" type="text" value="<?php echo date('d-M-Y',strtotime($row["bi_eta"])); ?>">
									</div>
		                        </div>
								<div class="form-group col-xs-6">
									<div class="col-xs-4"> 
										<label for ="">Handing Remark:</label>     
									</div> 
									<div class="col-xs-8"> 	                                     
										<input readonly class="form-control" name="txt_bi_handing" type="text" value="<?php echo $row["bi_handing"]?>">
									</div>
		                        </div>
								<div class="form-group col-xs-6">
									<div class="col-xs-4">
										<label for ="">Tran Mode:</label>  
									</div> 
									<div class="col-xs-8">                                     
		                       			<input readonly class="form-control" name="txt_bi_transfer" type="text" value="<?php echo $row["bi_transfer"]?>">
									</div> 	   
		                        </div>
								<div class="form-group col-xs-6">
									<div class="col-xs-4">
		                           		<label for ="">Date:</label>    
									</div> 
									<div class="col-xs-8">  	                                         
		                       			<input readonly class="form-control" name="txt_bi_date" type="date" value="<?php echo $row["bi_date"]?>">
									</div> 	 
		                        </div>

								<div class="form-group col-xs-12">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="bill_detail_add.php?bill_id=<?php echo $_GET["id"]; ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Container Info</a>
									<a href="bill.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
									
								</div> 
							</form>
							
						</div>
						
						<!-- item sub table -->
						<h3>Container Info</h3>
						<div class="table-responsive">
							<table id="example" class="display nowrap" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>No</th>
										<th>Con No</th>
										<th>Seal No</th>
										<th>Cont Type</th>
										<th>Conmodity</th>
										<th>QTY</th>
										<th>Pack Type</th>
										<th>GW</th>
										<th>CBM</th>
										<th>Destination</th>
										<th>Truck No VN</th>
										<th>Note</th>
										<th>Note1</th>
										<th>Note2</th>
										<th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
									</tr>
								</thead>
								<tbody>
											<?php                                            
													$i= 1;
													$sql = "SELECT * FROM bill_item AS A
																		LEFT JOIN container_type AS CONT ON CONT.cont_id=A.bit_cont_type
																		LEFT JOIN package_type AS PACK ON PACK.pa_id=A.bit_pack_type
																		LEFT JOIN destination AS DES ON DES.de_id=A.bit_destination
																		WHERE bit_bill_id=$id 
																		";
													$result = mysqli_query($connect, $sql);
													while($row = $result->fetch_assoc()) 
													{	
														$v_con_no   =$row['bit_con_no'];
														$v_seal_no  =$row["bit_seal_no"];
														$v_cont_type  =$row["cont_name"];
														$v_commodity  =$row["bit_commodity"];
														$v_qty    =$row["bit_qty"];
														$v_pack_type    =$row["pa_name"];
														$v_gw     =$row["bit_gw"];
														$v_cbm =$row["bit_cbm"];
														$v_destination =$row["de_name"];
														$v_truck_no_vn =$row["bit_truck_no_vn"];
														$v_note =$row["bit_note"];
														$v_note1 =$row["bit_note1"];
														$v_note2 =$row["bit_note2"];
												?>
										<tr>
											<td>
												<?php echo $i++;?>
											</td> 
											<td> <?php echo $v_con_no;?> </td>
											<td> <?php echo $v_seal_no;?> </td>
											<td> <?php echo $v_cont_type;?> </td>
											<td> <?php echo $v_commodity;?> </td>
											<td> <?php echo $v_qty;?> </td>
											<td> <?php echo $v_pack_type;?> </td>
											<td> <?php echo $v_gw;?> </td>
											<td> <?php echo $v_cbm;?> </td>
											<td> <?php echo $v_destination;?> </td>
											<td> <?php echo $v_truck_no_vn;?> </td>
											<td> <?php echo $v_note;?> </td>
											<td> <?php echo $v_note1;?> </td>
											<td> <?php echo $v_note2;?> </td>
											<td class="text-center">
												<a href="bill_detail_edit.php?id=<?php echo $row['bit_id']; ?> && bill_id=<?php echo $row['bit_bill_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
												<a onclick="return confirm('Are you sure to delete?');" href="bill_detail_del.php?id=<?php echo $row['bit_id']; ?>&&bill_id=<?php echo $row['bit_bill_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
											</td>
										</tr>
											<?php
												}	 
											?>
								</tbody>
							</table>			
						</div>


					</div> <!-- div class panel-body -->
				</div>
			
		</div>
<?php include 'footer.php';?>
