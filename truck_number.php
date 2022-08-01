<?php include 'config/db_connect.php';

    $sql = "SELECT * FROM truck_number AS A
                        LEFT JOIN truck AS TR ON TR.tr_id=A.tnum_truck_id
                        ORDER BY tnum_truck_id ASC
                                ";
    $result = mysqli_query($connect, $sql);


    if(isset($_GET["id"])){
     $id = $_GET["id"];

     $sql = "DELETE FROM truck_number WHERE tnum_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:truck_number.php?message=delete");
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
                      echo '<h4>Success Add truck</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update truck</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete truck</h4>';
                      echo '</div>';
                    }
                    ?>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h2 class="text-primary">Truck Number</h2>
                <hr>
                <a href="truck.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
                <a href="truck_number_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o"></i> Add New</a>
            
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Truck Number</th>
                                <th>Code</th>
                                <th></th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php                                            
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{	
                                                $v_t_num   =$row["tnum_number"];
                                                $v_t_truck_id  =$row["tr_code"];
                                                $v_t_truck_name  =$row["tr_name"];
                                                
										?>
                                <tr>
                                    <td>
                                        <?php echo $i++;?>
                                    </td>
                                    <td> <?php echo $v_t_num;?></td>
                                    <td> <?php echo $v_t_truck_name;?>(<?php echo $v_t_truck_id;?>)
                                    </td>
                                    <td class="text-center">
                                    	<a onclick="return confirm('Are you sure to delete?');" href="truck_number.php?id=<?php echo $row['tnum_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                    <td></td>
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