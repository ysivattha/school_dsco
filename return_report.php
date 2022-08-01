<?php include'config/db_connect.php';



  $sql = "SELECT * FROM return_pro A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN user C ON A.id = C.id "; 
  $result = $connect->query($sql);

  if (isset($_GET['id'])) {
    $id = $_GET['id'];
      $sql = "DELETE FROM return_pro WHERE re_id = '$id'";
      $result = mysqli_query($connect, $sql);
      if ($result) {
          header("location:return_report.php");
      }else{
          error;
      }
  }


?>
<?php include 'header.php';?>
          <div class="row">
                <div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add To Stock</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Return Product Successfully</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success delete from Stock</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                          <h2 class="text-primary">Return Product Record</h2>
                          <hr>
                          
                 <a href="return_product.php" class="btn btn-sm btn-danger "><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Qauntity</th>
                                            <th>Packet</th>
                                            <th>Username</th>
                                            <th>Note</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v1=$row["re_date"];
                                              $v2=$row["code"];
                                              $v3=$row["name_kh"];
                                              $v4=$row["re_qty"];
                                              $v5=$row["paket"];
                                              $v6=$row["username"];
                                              $v7=$row["re_note"];
                                          ?>
                                          <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $v1;?></td> 
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7 ?></td>
                                     
                                            
                                            <td align = "center">
                                          <!--   <a href="edit_stockin.php?id=<?php //echo $row['in_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a> -->
                                           <a onclick = "return confirm('Are you sure to delete ?');" href="return_report.php?id=<?php echo $row['re_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
            
          <?php include 'footer.php';?>