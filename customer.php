<?php include 'config/db_connect.php';

    $sql = "SELECT * FROM customer
                        ORDER BY cus_num_id ASC
                                    ";
    $result = mysqli_query($connect, $sql);


    if(isset($_GET["id"])){
     $id = $_GET["id"];

     $sql = "DELETE FROM customer 
                    WHERE cus_id = '$id'
                    ORDER BY cus_num_id
                    ";
     $result = mysqli_query($connect, $sql);
        if ($result) {
            header("location:customer.php?message=delete");
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
                <h4 class="text-primary">Customer</h4>
                <a href="customer_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o"></i> Add New</a>
				
            </div>
            <div class="panel-body">
                <div class="fixTableHead">
                    <table class="nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Phone</th>
                                <th>Note</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php                                            
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{		
												$v_cus_num_id   =$row["cus_num_id"];
                                                $v_cus_name     =$row['cus_name'];
                                                $v_cus_address  =$row["cus_address"];
												$v_cus_country  =$row["cus_country"];
												$v_cus_city     =$row["cus_city"];
												$v_cus_phone    =$row["cus_phone"];
                                                $v_cus_note     =$row["cus_note"];
                                                $v_cus_datetime =$row["cus_datetime"];
										?>
                                <tr>
                                    <td>
                                        <?php echo $i++;?>
                                    </td> 
                                    <td> <?php echo $v_cus_num_id;?> </td>
                                    <td> <?php echo $v_cus_name;?> </td>
                                    <td> <?php echo $v_cus_address;?> </td>
                                    <td> <?php echo $v_cus_country;?> </td>
                                    <td> <?php echo $v_cus_city;?> </td>
                                    <td> <?php echo $v_cus_phone;?> </td>
                                    <td> <?php echo $v_cus_note;?> </td>
                                    <td class="text-center">
                                        <a href="customer_edit.php?id=<?php echo $row['cus_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										<a onclick="return confirm('Are you sure to delete?');" href="customer.php?id=<?php echo $row['cus_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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