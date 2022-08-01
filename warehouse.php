<?php include'config/db_connect.php';

  $sql = "SELECT * FROM warehouse";  
  $result = $connect->query($sql);
  
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
    if(isset($_GET["id"])){
    $id = $_GET["id"];
      
    $sql = "DELETE FROM category WHERE cate_id = '$id'" ;
    $result = mysqli_query($connect, $sql);
    header("location:warehouse.php?message=delete");  
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
                        <h3 class="text-primary">Warehouse</h3>
                        <hr>
                  
                  				
               

                       </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>No</th>
                                            <th>Warehouse</th>
                                            <th>Note</th>
                                            <th></th>
                                            <th></th>
                                           <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=0;
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              // $v1=$row["cate_id"];
                                              $v_name =$row["wa_name"];
                                              $v_note =$row["wa_note"];
                                          ?>
                                          <tr>
                                            <td><?php echo ++$i;?></td> 
                                            <td><?php echo $v_name;?></td>
                                            <td><?php echo $v_note;?></td>
                                            <td> </td>
                                            <td> </td>
                                            <td align = "center">
                                            <a href="warehouse_edit.php?id=<?php echo $row['wa_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <!--        <a onclick = "return confirm('Are you sure to delete ?');" href="category.php?id=<?php echo $row['wa_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            -->    </td>
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