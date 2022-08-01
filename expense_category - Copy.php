<?php include'config/db_connect.php'; 
  $sql = "SELECT * FROM tbl_expense_category";  
  $result = $connect->query($sql);
  
  if(isset($_POST["btnadd"])){
    $v_name = $_POST["txt_name"];
    $v_note = $_POST["txt_note"];

     $sql = "INSERT INTO tbl_expense_category 
                (exca_name, exca_note) 
              VALUES 
                ('$v_name', '$v_note')";
     $result = mysqli_query($connect, $sql);
     header('location:expense_category.php?message=success');
 }
    if(isset($_GET["id"])){
    $id = $_GET["id"];
      
    $sql = "DELETE FROM tbl_expense_category WHERE exca_id = '$id'" ;
    $result = mysqli_query($connect, $sql);
    header("location:expense_category.php?message=delete");  
} 
?>

<?php include 'header.php';?>
          <div class="row">
            <div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add Record</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update Record</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete Record</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <h3 class="text-primary">Expense Category</h3>
                        
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add New</button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New</h4>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="">     
                          <div class="form-group col-xs-12">
                            <label for ="">Expense Category :</label>                                          
                            <input class="form-control" required  name="txt_name" type="text" placeholder="Category Name">          
                          </div>
                          <div class="form-group col-xs-12">
                            <label for="note">Note :</label>
                             <textarea class="form-control" rows="4" id="note" name = "txt_note"></textarea>
                          </div>
                          <div class="form-group col-xs-6">
                            <button type="submit" name = "btnadd" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                          </div> 
                        </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                  </div>
                </div>
                </div>
                <a href="dashboard.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>#</th>
                                            <th>Expense Category</th>
                                            <th>Note</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            $i=1; 
                                            while($row = $result->fetch_assoc()) 
                                            { 
                                                 
                                              $v1=$row["exca_id"];
                                              $v2=$row["exca_name"];
                                              $v3=$row["exca_note"];
                                          ?>
                                          <tr>
                                            <td><?php echo ($i++) ;?></td> 
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td align = "center">
                                            <a href="edit_expense_category.php?id=<?php echo $row['exca_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick = "return confirm('Are you sure to delete ?');" href="expense_category.php?id=<?php echo $row['exca_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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