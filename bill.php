<?php include 'config/db_connect.php';
    date_default_timezone_set("Asia/Bangkok");
    $today = date('Y-m-d');
	$datetime = date('Y-m-d H:i:s');
    $month = date('Y-m');

    $sql = "SELECT * FROM bill AS A
                        LEFT JOIN customer AS CUS ON CUS.cus_id=A.bi_customer
						LEFT JOIN border AS BOR ON BOR.bo_id=A.bi_border
                        ORDER BY A.bi_date DESC
                         ";
    $result = mysqli_query($connect, $sql);

    if(isset($_GET["id"])){
     $id = $_GET["id"];

     $sql = "DELETE FROM bill WHERE bi_id = '$id'";
     $result = mysqli_query($connect, $sql);
     if ($result) {
        header("location:bill.php?message=delete");
     }
} 
?>
<style>
    .fixTableHead {
      overflow-y: auto;
      height: 70%;
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
      padding-top: 5px;
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
                
                <a href="bill_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus-square-o"></i> Add New</a>
			
            </div>
            <div class="panel-body">
                <div class="fixTableHead">
                    <table class="display nowrap" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date Input</th>
                                <th>Bill No</th>
                                <th></th>
                                <th>Border</th>
                                <th>Origin</th>
                                <th>Customer</th>
                                <th>ETD</th>
                                <th>ETA</th>
                                <th>Handing Remark</th>
                                <th>Trans Mode</th>
                                <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php                                            
                                        	$i= 1;
											while($row = $result->fetch_assoc()) 
											{		
												$v_date   =$row["bi_date"];
                                                $v_number   =$row['bi_number'];
                                                $v_border  =$row["bo_name"];
												$v_origin  =$row["bi_origin"];
												$v_customer    =$row["cus_name"];
												$v_etd    =$row["bi_etd"];
                                                $v_eta     =$row["bi_eta"];
                                                $v_handing =$row["bi_handing"];
                                                $v_transfer =$row["bi_transfer"];
										?>
                                <tr>
                                    <td>
                                        <?php echo $i++;?>
                                    </td> 
                                    <td>
                                        <?php
                                            if($v_date=="0000-00-00"){
                                                echo '';
                                            }else{
                                                echo date('d-M-Y',strtotime($v_date));
                                            }
                                            
                                        ?> 
                                    </td>
                                    <td> <?php echo $v_number;?> </td>
                                    <td>
                                        <a href="bill_detail.php?id=<?php echo $row['bi_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Container Info</a>
									</td>
                                    <td> <?php echo $v_border;?> </td>
                                    <td> <?php echo $v_origin;?> </td>
                                    <td> <?php echo $v_customer;?> </td>
                                    <td> 
                                        <?php
                                            if($v_etd=="0000-00-00"){
                                                echo '';
                                            }else{
                                                echo date('d-M-Y',strtotime($v_etd));
                                            }
                                            
                                        ?> 
                                    </td>
                                    <td>
                                        <?php
                                            if($v_eta=="0000-00-00"){
                                                echo '';
                                            }else{
                                                echo date('d-M-Y',strtotime($v_eta));
                                            }
                                            
                                        ?> 
                                    </td>
                                    <td> <?php echo $v_handing;?> </td>
                                    <td> <?php echo $v_transfer;?> </td>
                                    <td class="text-center">
                                        <a href="bill_edit.php?id=<?php echo $row['bi_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
										<a onclick="return confirm('Are you sure to delete?');" href="bill.php?id=<?php echo $row['bi_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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