<?php include 'config/db_connect.php';


    $result = mysqli_query($connect, 'SELECT SUM(cont_id) AS value_sum FROM container_type
                                                                                        '); 
    $row = mysqli_fetch_assoc($result); 
    $sum = $row['value_sum'];

    

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
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-primary">Total Container </h3>
                <hr>
            </div>
            <div>
                 
                    <table width="33%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            </tr>
                            <?php
                                foreach($connect->query('SELECT cont_name,bit_cont_type,SUM(bit_qty)
                                                                FROM bill_item AS A
                                                                INNER JOIN container_type AS CT ON CT.cont_id=A.bit_cont_type
                                                                GROUP BY bit_cont_type') as $row) {
                                echo "<tr>"; 
                                    echo "<td>" . $row['cont_name'] . "</td>";
                                    echo "<td>" . $row['SUM(bit_qty)'] . "</td>";
                                echo "</tr>"; 
                                }
                            ?>
                        </tbody>
                        </table>
               
                
                
                

                </div>

            

        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-primary"> On going </h3>
                <hr>
            </div>
            <div>
                 
                    <table width="33%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            </tr> 
                            <?php
                                foreach($connect->query('SELECT cont_name,bit_cont_type,COALESCE(SUM(bit_qty),0)
                                                                FROM bill_item AS A
                                                                INNER JOIN container_type AS CT ON CT.cont_id=A.bit_cont_type
                                                                WHERE A.bit_completed=1
                                                                GROUP BY bit_cont_type') as $row) {
                                echo "<tr>"; 
                                    echo "<td>" . $row['cont_name'] . "</td>";
                                    echo "<td>" . $row['COALESCE(SUM(bit_qty),0)'] . "</td>";
                                echo "</tr>"; 
                                }
                            ?>
                        </tbody>
                        </table>
               
                
                
            
            
                <div class="table-responsive">
                    
                    </div>

                </div>

            

        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-primary"> Completed </h3>
                <hr>
            </div>
            <div>
                 
                    <table width="33%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            </tr>
                            <?php
                                foreach($connect->query('SELECT cont_name,bit_cont_type,SUM(bit_qty)
                                                                FROM bill_item AS A
                                                                INNER JOIN container_type AS CT ON CT.cont_id=A.bit_cont_type
                                                                WHERE A.bit_completed=2
                                                                GROUP BY bit_cont_type') as $row) {
                                echo "<tr>"; 
                                    echo "<td>" . $row['cont_name'] . "</td>";
                                    echo "<td>" . $row['SUM(bit_qty)'] . "</td>";
                                echo "</tr>"; 
                                }
                            ?>
                        </tbody>
                        </table>
               
                
                
            
            
                <div class="table-responsive">
                    
                    </div>

                </div>

            

        </div>
    </div>

</div>
</div>
<?php include 'footer.php';?>