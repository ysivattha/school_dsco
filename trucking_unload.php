<?php include 'config/db_connect.php';
    date_default_timezone_set("Asia/Bangkok");
    $today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
    $month = date('Y-m');



    if(isset($_GET["id"])){
     $id = $_GET["id"];

     $sql = "DELETE FROM trucking_unload WHERE tu_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:trucking_unload.php?message=delete");
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
    <div class="col-lg-12 col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h4 class="text-primary">Trucking & Unload</h4>
                <a href="trucking_unload_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o"></i> Add New</a>
			
            </div>
            <div class="panel-body">
                <div class="fixTableHead">
                    <table class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                <th>BorderID</th>
                                <th>Code</th>
                                <th>CTNR</th>
                                <th>Type</th>
                                <th>ETA</th>
                                <th>QTY</th>
                                <th>GW</th>
                                <th>CBM</th>
                                <th>Trucking</th>
                                <th>Unload</th>
                                <th>Trucking_and_Unload</th>
                                <th>Big_Truck_to_Customer</th>
                                <th>Big_Truck_and_Unload</th>
                                <th>Note</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                                    <?php                                            
                                        $sql = "SELECT * FROM trucking_unload AS A
                                                                LEFT JOIN border AS BOR ON BOR.bo_id=A.tu_border_id
                                                                LEFT JOIN customer AS CUS ON CUS.cus_id=A.tu_code
                                                                LEFT JOIN container_type AS CONT ON CONT.cont_id=A.tu_type
                                                                            ";
                                        $result = mysqli_query($connect, $sql);
                                                            
                                        $i= 1;
                                        while($row = $result->fetch_assoc()) 
                                        {		
                                            $v_border_id  =$row["bo_name"];
                                            $v_code  =$row["cus_num_id"];
                                            $v_ctnr  =$row["tu_ctnr"];
                                            $v_type  =$row["cont_name"];
                                            $v_eta  =$row["tu_eta"];
                                            $v_qty =$row["tu_qty"];
                                            $v_gw  =$row["tu_gw"];
                                            $v_cbm  =$row["tu_cbm"];
                                            $v_trucking =$row["tu_trucking"];
                                            $v_unload  =$row["tu_unload"];
                                            $v_trucking_unload =$row["tu_trucking_unload"];
                                            $v_big_truck_customer =$row["tu_big_truck_customer"];
                                            $v_big_truck_unload  =$row["tu_big_truck_unload"];
                                            $v_note=$row["tu_note"];

									?>
                                <tr>
                                    <td class="text-center">
                                        <a href="trucking_unload_edit.php?id=<?php echo $row['tu_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Update</a>
                                        
                                        <a href="trucking_unload_add_edit.php?id=<?php echo $row['tu_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
									                      <a onclick="return confirm('Are you sure to delete?');" href="trucking_unload.php?id=<?php echo $row['tu_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                    <td> <?php echo $v_border_id;?> </td>
                                    <td> <?php echo $v_code;?> </td>
                                    <td> <?php echo $v_ctnr;?> </td>
                                    <td> <?php echo $v_type;?> </td>
                                    <td> <?php echo date('d-M-Y',strtotime($v_eta)); ?> </td>
                                    <td> <?php echo $v_qty;?> </td>
                                    <td> <?php echo $v_gw;?> </td>
                                    <td> <?php echo $v_cbm;?> </td>
                                    <td> <?php echo $v_trucking;?> </td>
                                    <td> <?php echo $v_unload;?> </td>
                                    <td> <?php echo $v_trucking_unload;?> </td>
                                    <td> <?php echo $v_big_truck_customer;?> </td>
                                    <td> <?php echo $v_big_truck_unload;?> </td>
                                    <td> <?php echo $v_note;?> </td>

                                    
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