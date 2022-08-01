<?php include'config/db_connect.php';

  if(isset($_POST["btnadd"])){
    $v_name = $_POST["txt_name"];
    $v_note = $_POST["txt_note"];

     $sql = "INSERT INTO warehouse 
                (wa_name,wa_note) 
              VALUES 
                ('$v_name', '$v_note')";
     $result = mysqli_query($connect, $sql);
     header('location:warehouse.php?message=success');
 }
    $get_id = $_GET["sent_id"];
    if(isset($_GET["del_id"])){
    $id = $_GET["del_id"];
      
    $sql = "DELETE FROM stock_out_item WHERE sout_id = '$id'" ;
    $result = mysqli_query($connect, $sql);
    header("location:stock_out_item.php?sent_id=$get_id");  
} 
?>

<?php include 'header.php';?>
          <div class="row">
            <div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add Category</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update Category</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete Category</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <h3 class="text-primary">Stock Out List</h3>
                        <a href="stock_out.php" class="btn btn-danger btn-sm"><i class="fa fa-undo"></i> Back</a>
								
                  
                       </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Qty_Out</th>
                                            <th>Employee</th>
                                            <th>Note</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $id = $_GET["sent_id"];
                                            $sql = "SELECT * FROM stock_out_item AS A
                                                              WHERE sout_bill_item = '$id'
                                                                                      ";  
                                            $result = $connect->query($sql);
                                            
                                            $i=0;
                                            while($row = $result->fetch_assoc()) 
                                            { 
                                              $v_date =$row["sout_date"];
                                              $v_time =$row["sout_time"];
                                              $v_bill_item =$row["sout_bill_item"];
                                              $v_qtyout =$row["sout_qtyout"];
                                              $v_employee =$row["sout_employee"];
                                              $v_note =$row["sout_note"];
                                          ?>
                                          <tr>
                                            <td align = "center">
                                              <a href="stock_out_item_edit.php?edit_id=<?php echo $row['sout_id']; ?>&sent_id=<?php echo $_GET["sent_id"]; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                              <a onclick = "return confirm('Are you sure to delete ?');" href="stock_out_item.php?del_id=<?php echo $row['sout_id']; ?>&sent_id=<?php echo $_GET["sent_id"]; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                            <td><?php echo ++$i;?></td> 
                                            <td>
                                                <?php
                                                    if($v_date=="0000-00-00"){
                                                        echo '';
                                                    }else{
                                                        echo date('d-M-Y',strtotime($v_date));
                                                    }
                                                    
                                                ?>
                                            </td>
                                            <td><?php echo $v_time;?></td>
                                            <td><?php echo $v_qtyout;?></td>
                                            <td><?php echo $v_employee;?></td>
                                            <td><?php echo $v_note;?></td>
                                            
                                            
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