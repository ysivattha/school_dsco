<?php include 'config/db_connect.php';

    $sql = "SELECT * FROM border_expense AS A
                        LEFT JOIN customer AS CUS ON CUS.cus_id=A.bor_customer
                        ORDER BY bor_date ASC
                                    ";
    $result = mysqli_query($connect, $sql);


    if(isset($_GET["del_id"])){
     $id = $_GET["del_id"];

     $sql = "DELETE FROM border_expense 
                    WHERE bor_id  = '$id'
                                          ";
     $result = mysqli_query($connect, $sql);
        if ($result) {
            header("location:border_expense.php?message=delete");
            }
    } 
?>
<style>
    .fixTableHead {
      overflow-y: auto;
      height: 78%;
    }
    .fixTableHead thead th {
      position: sticky;
      top: -1;
      text-align: center;
    }
    table {
      border-collapse: collapse;        
      width: 100%;
    }
    th,
    td {
      padding: 8px 15px;
      border: 1px solid #a2a8a3;
      text-align: left;
    }
    th {
      background: #a2a8a3;
      
    }
</style>
<?php include 'header.php';?>
<div class="row">
    <div class="col-xs-12">
        <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add Customer</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update Customer</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete Customer</h4>';
                      echo '</div>';
                    }
                    ?>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4 class="text-primary">Border Expense</h4>
                <a href="border_expense_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
				
            </div>
            <div class="panel-body">
                <div class="fixTableHead">
                    <table class="nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer_Code</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>KGS</th>
                                <th>CBM</th>
                                <th>Total_KGS</th>
                                <th>Total_CBM</th>
                                <th>Tax</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>VN_Truck_No</th>
                                <th>Remark</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php                                            
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{		
												        $v_id   =$row["bor_id"];
                                $v_date =$row['bor_date'];
                                $v_customer  =$row["cus_num_id"];
                                $v_description  =$row["bor_description"];
                                $v_qty     =$row["bor_qty"];
                                $v_kgs    =$row["bor_kgs"];
                                $v_cbm     =$row["bor_cbm"];
                                $v_total_kgs =$row["bor_total_kgs"];
                                $v_total_cbm =$row["bor_total_cbm"];
                                $v_tax =$row["bor_tax"];
                                $v_price =$row["bor_price"];
                                $v_amount =$row["bor_amount"];
                                $v_vn_truck_no =$row["bor_vn_truck_no"];
                                $v_remark =$row["bor_remark"];
										?>
                                <tr>
                                    
                                    <td> 
                                        <?php
                                            if($v_date=="0000-00-00"){
                                                echo '';
                                            }else{
                                                echo date('d-M-Y',strtotime($v_date));
                                            }
                                            
                                        ?> 
                                    </td>
                                    <td> <?php echo $v_customer;?> </td>
                                    <td> <?php echo $v_description;?> </td>
                                    <td> <?php echo $v_qty;?> </td>
                                    <td> <?php echo $v_kgs;?> </td>
                                    <td> <?php echo $v_cbm;?> </td>
                                    <td> <?php echo $v_total_kgs;?> </td>
                                    <td> <?php echo $v_total_cbm;?> </td>
                                    <td> <?php echo $v_tax;?> </td>
                                    <td> <?php echo $v_price;?> </td>
                                    <td> <?php echo $v_amount;?> </td>
                                    <td> <?php echo $v_vn_truck_no;?> </td>
                                    <td> <?php echo $v_remark;?> </td>
                                    <td class="text-center">
                                        <a href="border_expense_edit.php?id=<?php echo $row['bor_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										                    <a onclick="return confirm('Are you sure to delete?');" href="border_expense.php?del_id=<?php echo $row['bor_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
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
</div>

<?php include 'footer.php';?>