<?php include'config/db_connect.php';

  
  if(isset($_POST["btnadd"])){
    $v_name = $_POST["txt_name"];
    $v_name_kh = $_POST["txt_name_kh"];
    $v_sale_type = $_POST["txt_sale_type"];
    $v_category = $_POST["txt_category"];
    $v_cost = $_POST["txt_cost"];
    $v_price = $_POST["txt_price"];
    $v_note = $_POST["txt_note"];
     $sql = "INSERT INTO tbl_item_menu 
               (im_name,im_name_kh,im_category,im_note,im_sale_type,im_cost,im_price) 
              VALUES 
               ('$v_name','$v_name_kh','$v_category', '$v_note','$v_sale_type','$v_cost','$v_price')";
     $result = mysqli_query($connect, $sql);
     if ($result) {
         header('location:'.$_SERVER['PHP_SELF'].'?message=success');
     }
}
if(isset($_GET["id"])){
     $id = $_GET["id"];

     $sql = "DELETE FROM tbl_item_menu WHERE im_id = '$id'";
     $result = mysqli_query($connect, $sql);
     $connect->query("DELETE FROM tbl_set_ingredient WHERE si_name_menu='$id'");
     if ($result) {
        header('location:'.$_SERVER['PHP_SELF'].'?message=delete');
     }
} 

$sql = "SELECT * FROM tbl_item_menu AS A LEFT JOIN tbl_input_type_data AS B ON B.itd_id=A.im_sale_type LEFT JOIN category AS C ON C.cate_id=A.im_category ORDER BY im_id DESC";  
$result = $connect->query($sql);
?>
<?php include 'header.php';?>
          <div class="row">
                <div class = "col-xs-12">
                  <?php
                    if (!empty($_GET['message']) && $_GET['message'] == 'success') {
                      echo '<div class="alert alert-success">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Add ...</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'update') {
                      echo '<div class="alert alert-info">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Update ...</h4>';
                      echo '</div>';
                    }
                    else if (!empty($_GET['message']) && $_GET['message'] == 'delete') {
                      echo '<div class="alert alert-danger">' ;
                      echo '<button type="button" class="close" data-dismiss="alert">&times;</button>'; 
                      echo '<h4>Success Delete ...</h4>';
                      echo '</div>';
                    }
                    ?>
                </div>
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <h2 class="text-primary">Item Menu</h2>
                            <hr>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add New *</button>
                            
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
                          <div class="form-group col-xs-6">
                            <label for ="">Item Name En:</label>                                          
                            <input autocomplete="off" class="form-control"   required name="txt_name" type="text" >          
                            <br>
                            <label for ="">Item Name Kh:</label>                                          
                            <input autocomplete="off" class="form-control"   required name="txt_name_kh" type="text" >          
                            <br>
                            <label for ="">Item Note:</label>                                          
                            <input autocomplete="off" class="form-control" name="txt_note" type="text"> 

                            <br>
                            <label for ="" style="display: none;">Item Menu Type:</label>                                          
                            <select style="display: none;" name="txt_sale_type" class="form-control" onchange="show_hide_right_input(this.value)">
                              <?php 
                                $get_sale_type = $connect->query("SELECT * FROM tbl_input_type_data WHERE itd_id='1' ORDER BY itd_name ASC");
                                while ($row_sale_type = mysqli_fetch_object($get_sale_type)) {
                                  echo '<option value="'.$row_sale_type->itd_id.'">'.$row_sale_type->itd_name.'</option>';
                                }
                              ?>
                            </select> 
                          </div>
                          <div class="form-group col-xs-6 right_input">

                            <label for ="">Category:</label>                                          
                            <select name="txt_category" class="form-control" required="">
                              <option value="">==choose category==</option>
                              <?php 
                                $get_cate = $connect->query("SELECT * FROM category ORDER BY category_name ASC");
                                while ($row_cate = mysqli_fetch_object($get_cate)) {
                                  echo '<option value="'.$row_cate->cate_id.'">'.$row_cate->category_name.'</option>';
                                }
                              ?>
                            </select>          
                            <br>
                            <label for ="">Cost:</label>                                          
                            <input autocomplete="off" class="form-control" value="0.00"  required name="txt_cost" type="text" >          
                            <br>
                            <label for ="">Price:</label>                                          
                            <input autocomplete="off" class="form-control" value="0.00"  required name="txt_price" type="text"> 

                            <br>
                          </div>
                          <div class="clearfix"></div>
                          <div class="col-md-12">
                            <button type="submit" name = "btnadd" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Save changes</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <br>
                            <br>
                          </div>
                        </form>
                    </div>
                  </div>
                  <div class="modal-footer">
                    
                  </div>
                  </div>
                </div>
                </div>
                
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>No</th>
                                            <th>Item Name En</th>
                                            <th>Item Name Kh</th>
                                            <th class="text-center">Image</th>
                                            <th>Sale Type</th>
                                            <th>Category</th>
                                            <th>Cost</th>
                                            <th>Price</th>
                                            <th>Item Note</th>
                                            <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=0;
                                            while($row = @$result->fetch_assoc()) 
                                            {   
                                              echo '<tr>';  
                                                echo '<td>'.(++$i).'</td>';  
                                                echo '<td>'.$row['im_name'].'</td>';  
                                                echo '<td>'.$row['im_name_kh'].'</td>';  
                                                echo '<td class="text-center">
                                                  <a href="img/product/'.$row['im_image'].'">
                                                    <img height="50px" src="img/product/'.$row['im_image'].'"
                                                  </a><a href="upload_photo.php?im_id='.$row['im_id'].'&im_image='.$row['im_image'].'">
                                                   <i class="fa fa-pencil"></i>
                                                  </a>
                                                </td>';  
                                                echo '<td>'.$row['itd_name'].'</td>'; 
                                                echo '<td>'.$row['category_name'].'</td>'; 
                                                if($row['itd_id']==1){
                                                  echo '<td>$ '.number_format($row['im_cost'],2).'</td>';  
                                                  echo '<td>$ '.number_format($row['im_price'],2).'</td>';  
                                                }else{
                                                  echo '<td class="text-center">--</td>';  
                                                  echo '<td class="text-center">--</td>';  
                                                } 
                                                echo '<td>'.$row['im_note'].'</td>';  
                                              ?>
                                            <td align = "center">
                                            <a href="ingredient_set.php?im_id=<?= $row['im_id'] ?>" class="btn btn-primary btn-xs">Set Ingredient <i class="fa fa-cubes"></i></a>
                                            <a href="edit_item_menu.php?id=<?php echo $row['im_id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                            <a onclick = "return confirm('Are you sure to delete ?');" href="<?= $_SERVER['PHP_SELF'] ?>?id=<?php echo $row['im_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
          <script type="text/javascript" src="plugins/jQuery/jquery-2.2.3.min.js"></script>
          <script type="text/javascript">
            function show_hide_right_input(id){
              if(id==1){
                $('.right_input').fadeIn();
              }else if(id==0){
                $('.right_input').fadeOut();
                $('input[name=txt_cost]').val('0.00');
                $('input[name=txt_price]').val('0.00');
              }
            }1
            // $('.right_input').fadeOut();
          </script>

          <?php include 'footer.php';?>