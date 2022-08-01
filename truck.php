<?php include 'config/db_connect.php';

    $sql = "SELECT * FROM truck AS A
                        ORDER BY tr_code ASC
                                ";
    $result = mysqli_query($connect, $sql);


    if(isset($_GET["id"])){
     $id = $_GET["id"];

     $sql = "DELETE FROM truck WHERE tr_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:truck.php?message=delete");
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
                
                <a href="truck_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o"></i> Add New</a>
                <a href="truck_number.php" class="btn btn-primary btn-sm"><i class="fa fa-list"></i> Truck Number</a>
			
            </div>
            <div class="panel-body">
                <div class="fixTableHead">
                    <table class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Truck Number</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Name of Cheque</th>
                                
                                <th>Phone</th>
                                <th>Unit</th>
                                <th>Address</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php                                            
                                        	$i= 1;
                                            $total=0;
											while($row = $result->fetch_assoc()) 
											{	
                                                $total+= $row["tr_unit"];   

												$v_tr_num   =$row["tr_num"];
                                                $v_tr_type     =$row["tr_type"];
                                                $v_tr_name  =$row["tr_name"];
												$v_tr_cheque  =$row["tr_cheque"];
												$v_tr_code     =$row["tr_code"];
												$v_tr_phone   =$row["tr_phone"];
                                                $v_tr_unit     =$row["tr_unit"];
                                                $v_tr_address     =$row["tr_address"];
                                                
										?>
                                <tr>
                                    <td> <?php echo $v_tr_code;?></td>
                                    <td>
                                    <?php 
                                            $v_tr_id=$row["tr_id"];;
                                            $sql_t = "SELECT * FROM truck_number AS A
                                                                    WHERE tnum_truck_id=$v_tr_id
                                                                                        ";
                                                $result_t = mysqli_query($connect, $sql_t);
                                                while($row_t = $result_t->fetch_assoc())
                                                {
                                                    echo $row_t["tnum_number"]."<br>";
                                                }
												
                                         ?>                       
                                    </td>
                                    <td> <?php echo $v_tr_type;?></td>
                                    <td> <?php echo $v_tr_name;?></td>
                                    <td> <?php echo $v_tr_cheque;?></td>
                                    
                                    <td> <?php echo $v_tr_phone;?></td>
                                    <td> <?php echo $v_tr_unit;?></td>
                                    <td> <?php echo $v_tr_address;?></td>
                                    <td class="text-center">
                                        <a href="truck_edit.php?id=<?php echo $row['tr_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										<a onclick="return confirm('Are you sure to delete?');" href="truck.php?id=<?php echo $row['tr_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                    <?php
                                        }	 
                                    ?>
                        </tbody>
                        <tfood>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total: </th>
                                <th>
                                    <?php
                                        echo "$total";
                                    ?>
                                </th>                    
                                <th></th>
                            </tr>
                        </tfood>

                    </table>
                                        
                                        
                </div>

            </div>

        </div>
    </div>
</div>
</div>
<?php include 'footer.php';?>