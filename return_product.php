<?php include'config/db_connect.php';



  $sql = "SELECT * FROM stockin A  INNER JOIN product B ON A.pro_id = B.pro_id INNER JOIN employee C ON A.emp_id = C.emp_id INNER JOIN vender D ON A.vender_id = D.vender_id"; 
  $result = $connect->query($sql);
  
  if(isset($_POST["return"])){
        $id = $_POST["id"];
        $qty      = $_POST["qty"];
        $date      = $_POST["date"];
        $note      = $_POST["note"];
        $pro      = $_POST['pro'];
        $user    = $_SESSION['user_id'];

        $sql = "INSERT INTO return_pro (re_id, pro_id, re_date, re_qty, re_note, id) VALUES (NULL, '$pro', '$date', '$qty', '$note', '$user')";
              $result = mysqli_query($connect, $sql);
            if ($result){
              $sql1 = "UPDATE stockin SET qty_left = qty_left - '$qty' WHERE in_id = '$id'" ;
              $result1 = mysqli_query($connect, $sql1);
              if ($result1) {
                  header("location:return_product.php?message=update");
                echo "success";
                }
                else{
                  echo "error";
                } 
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
                          <h2 class="text-primary">Return Product To Stock</h2>
                          <hr>
                          
                 <a href="index.php" class="btn btn-sm btn-danger "><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                 <a href="return_report.php" class="btn btn-sm btn-warning "><i class="fa fa-id-badge" aria-hidden="true"></i> Retrun Product Record</a>

                            
                <!-- Modal -->
      
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
                                            <th>Price</th>
                                            <th>Amount</th>
                                           <!--  <th>Pay Amount</th>
                                            <th>Rest</th>
                                            <th>Expire Date</th>
                                            <th>Note</th> -->
                                            <th>Vender</th>
                                            <th>Employee</th>
                                            <th>Return</th>
                                           <!-- <th><i class="fa fa-cog" aria-hidden="true"></i></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 1;
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v1=$row["date_in"];
                                              $v2=$row["code_in"];
                                              $v3=$row["name_kh"];
                                              $v4=$row["qty_in"];
                                              $v13=$row["paket"];
                                              $v5=$row["price"];
                                              $v6=$row["amount"];
                                              $v7=$row["payamount"];
                                              $v8=$row["rest_amount"];
                                              $v9=$row["expire_date"];
                                              $v10=$row["note_in"];
                                              $v11=$row["vendername_en"];
                                              $v12=$row["name_khmer"];
                                          ?>
                                          <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $v1;?></td> 
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v13;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v6;?></td>
                                         <!--    <td><?php echo $v7;?></td>
                                            <td><?php echo $v8;?></td>
                                            <td><?php echo $v9;?></td>
                                            <td><?php echo $v10;?></td> -->
                                            <td><?php echo $v11;?></td>
                                            <td><?php echo $v12;?></td>
                                            <td >
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#<?php echo $row['in_id'];?>"><i class="fa fa-undo" aria-hidden="true"></i></button>
                                              <div id="<?php echo $row['in_id'];?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                  <!-- Modal content-->
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      <h4 class="modal-title">Return Product</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-horizontal" method="post" action="">
                                                          <div class="form-group">
                                                            <label class="control-label col-sm-2" for="email">Qty:</label>
                                                            <div class="col-sm-10">
                                                              <input type="hidden" name = "id" value="<?php echo $row['in_id']; ?>">
                                                              <input type="hidden" name = "pro" value="<?php echo $row['pro_id']; ?>">
                                                              <input type="number" class="form-control" name="qty" placeholder="" name = "qty">
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label class="control-label col-sm-2" for="email">Date:</label>
                                                            <div class="col-sm-10">
                                                              <input type="text" class="form-control" name="date" id = "datepicker" placeholder="" >
                                                            </div>
                                                          </div>
                                                          <div class="form-group">
                                                            <label class="control-label col-sm-2" for="pwd">Note:</label>
                                                            <div class="col-sm-10"> 
                                                                <textarea name="note" id="" class="form-control" rows="4"></textarea>
                                                            </div>
                                                          </div>
                                                          <div class="form-group"> 
                                                            <div class="col-sm-offset-2 col-sm-10">
                                                              <button type="submit" class="btn btn-success" name = "return">Return</button>
                                                               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                          </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                  </div>

                                                </div>
                                              </div>
                                            </td>
                                            <!-- <td align = "center"> -->
                                          <!--   <a href="edit_stockin.php?id=<?php //echo $row['in_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a> -->
                                        <!--     <a onclick = "return confirm('Are you sure to delete ?');" href="stockin.php?id=<?php echo $row['in_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td> -->

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