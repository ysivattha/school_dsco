<?php include 'config/db_connect.php';


    if(isset($_GET["id"])){
     $id = $_GET["id"];

     $sql = "DELETE FROM customer WHERE cus_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:customer.php?message=delete");
     }
} 
?>

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
                <h2 class="text-primary">Total Truck </h2>
                <hr>
            </div>
            <div class="panel-body">
                 
                

                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Truck Number</th>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            </tr>
                            <?php
                                foreach($connect->query('SELECT tnum_number,bit_truck_no,COUNT(bit_qty) 
                                                                FROM bill_item AS A
                                                                INNER JOIN truck_number AS TN ON TN.tnum_id=A.bit_truck_no
                                                                GROUP BY bit_truck_no') as $row) {
                                echo "<tr>"; 
                                    echo "<td>" . $row['tnum_number'] . "</td>";
                                    echo "<td>" . $row['COUNT(bit_qty)'] . "</td>";
                                    echo "<td>"  . "</td>";
                                    echo "<td>"  . "</td>";
                                    echo "<td>"  . "</td>";
                                    echo "<td>"  . "</td>";
                                    echo "<td>"  . "</td>";
                                echo "</tr>"; 
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