<?php include 'config/db_connect.php';

	$sql = "SELECT * FROM invoice WHERE pay = 1 ";	
	$result = $connect->query($sql);
	
	// if(isset($_POST["btnadd"])){
	// 	$no = $_POST["no"];
	// 	$kname = $_POST["name_khmer"];
	// 	$ename = $_POST["name_english"];
	// 	$phone = $_POST["phone"];
	// 	$addr = $_POST["addr"];
	// 	$note = $_POST["note"];

	// 	 $sql = "INSERT INTO vender 
	// 	 						(no, vendername_kh,vendername_en,phone,address,note) 
	// 	 					VALUES 
	// 	 						('$no', '$kname', '$ename' ,'$phone' , '$addr', '$note')";
	// 	 $result = mysqli_query($connect, $sql);
	// 	 header('location:vender.php?message=success');
 // }
    if(isset($_GET["id"])){
		$id = $_GET["id"];
			
		$sql = "DELETE FROM invoice WHERE transaction_id = '$id'" ;
		$result = mysqli_query($connect, $sql);
		header("location:recieve.php?message=delete");	
}	
?>
<?php include 'header.php';?>
	<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Recieve List</li>
      </ol>
	<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         Invoice 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          	<th>#Invoice</th>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Cashier Name</th>
                                            <th>Customer Name</th>
                                            <th>Amount</th>
                                            <th>Vat</th>
                                            <th>Pay</th>
                                            <th>Order More</th>
                                            <th>Detail</th>
											 <?php
                                            if ($show['position_id'] == 1)
											{
											?>
											<th><i class="fa fa-cog" aria-hidden="true"></i></th>
											<?php
											}
											?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
											while($row = $result->fetch_assoc()) 
											{			
												$v1=$row["transaction_id"];
												$v2=$row["inv_no"];
												$v7=$row['date_sell'];
												$v3=$row["cashier_name"];
												$v4=$row["cus"];
												$v5=$row["amount"];
												$v6=$row["vat"];
												$v8=$row["pay"];
												
										?>
										<tr>
											<td><?php echo $v1;?></td>
											<td><?php echo $v2;?></td>
											<td><?php echo $v7;?></td>
											<td><?php echo $v3;?></td>
											<td><?php echo $v4;?></td>
											<td><?php echo $v5;?></td>
											<td><?php echo $v6;?></td>
											<td><a href = "inv.php?cus=<?php echo $v4?>&cash=cash&invoice=<?php echo $v2?>&pay=2" class = "btn btn-success"><i class="fa fa-money" aria-hidden="true"></i
></td>
											<td><a href = "inv.php?cus=<?php echo $v4?>&cash=cash&invoice=<?php echo $v2?>&pay=1" class = "btn btn-success">+<i class="fa fa-cutlery" aria-hidden="true"></i
></a></td>
											<td><a href="detail_invoice.php?id=<?php echo $row['inv_no']; ?>" class="btn btn-primary"><i class="fa fa-file-text-o" aria-hidden="true"></i></a></td>
											<?php
											if ($show['position_id'] == 1)
											{
											?>
											<td align = "center">
											<a onclick = "return confirm('Are you sure to delete ?');" href="invoices.php?id=<?php echo $row['transaction_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
											</td>
											<?php
											}	 
										?>
										</tr> 
										<?php
											}	 
										?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
<?php include 'footer.php';?>