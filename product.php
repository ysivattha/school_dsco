<?php include'config/db_connect.php'; 

  
  if(isset($_POST["btnadd"])){
    $code = $_POST["code"];
    $ref = $_POST["ref"];
    $paket = $_POST["paket"];
    $category = $_POST["category"];
    $en = $_POST["en"];
    $kh = $_POST["kh"];
    $priced = $_POST["priced"];
    $pricek = $_POST["pricek"];
    $image = "no_photo.png";
    $note = $_POST["note"];

    if(!empty($_FILES['image']['size'])){
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],"img/product/$image");

       $sql = "INSERT INTO product 
                 (code,ref,paket,name_en,name_kh,price_dolla,price_riel,photo,note_pro,cate_id) 
                VALUES 
                 ('$code', '$ref' ,'$paket', '$en','$kh','$priced','$pricek','$image','$note','$category')";
       $result = mysqli_query($connect, $sql);
       header('location:product.php?message=success');
    }else{
       $sql = "INSERT INTO product 
                 (code,ref,paket,name_en,name_kh,price_dolla,price_riel,photo,note_pro,cate_id) 
                VALUES 
                 ('$code', '$ref' ,'$paket', '$en','$kh','$priced','$pricek','no_photo.png','$note','$category')";
       $result = mysqli_query($connect, $sql);
       header('location:product.php?message=success');
    }
}
if(isset($_GET["id"])){
    $id = $_GET["id"];
    $sql = "DELETE FROM product WHERE pro_id = '$id'";
    $result = mysqli_query($connect, $sql);
    header("location:product.php?message=delete");
} 
  $sql = "SELECT * FROM product INNER JOIN category ON product.cate_id = category.cate_id";  
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
                            <h3 class="text-primary">Product</h3>
                            
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add New </button>
                            <a href="dashboard.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                            
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New Product</h4>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="" autocomplete="off">     
                          <div class="form-group col-xs-6">
                            <label for ="">Code:</label>                                          
                            <input class="form-control" autofocus=""  required name="code" type="text" oninput="validate_product_code(this)" placeholder="Code">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Ref Name:</label>                                          
                            <input class="form-control"   required name="ref" type="text" placeholder="Ref">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Packet / Unit:</label>                                          
                            <input class="form-control"   required name="paket" type="text" placeholder="Paket">          
                          </div>
                          <div class = "form-group col-xs-6">
                            <label for = "">Category:</label>
                            <select class = "form-control select2" name = "category" required style="width: 100%;">
                              <option value="">Select Catetegory</option>
                                  <?php
                                    $position = mysqli_query($connect,"SELECT * FROM category");
                                    while ($row1 = mysqli_fetch_assoc($position)) { ?>
                                    <option value="<?php echo $row1['cate_id']; ?>"><?php echo $row1['category_name']; ?></option>
                                  <?php 
                                  }
                                   ?>   
                            </select>
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Name:(En):</label>                                          
                            <input class="form-control"   required name="en" type="text" placeholder="English">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Name(Kh):</label>                                          
                            <input class="form-control"   required name="kh" type="text" placeholder="Khmer">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Price:</label>                                          
                            <input class="form-control"   required name="priced" type="text" placeholder="លក់ចេញ">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Cost:</label>                                          
                            <input class="form-control"   required name="pricek" type="text" placeholder="ទិញចូល">          
                          </div>
                          <div class = "form-group col-xs-12">
                            <label for = "">photo:</label>                                     
                            <input type="file"   id = "phot" name="image" onchange="loadFile(event)" />
                          </div>
                          <div class = "form-group col-xs-12">                                    
                              <img src="" alt="" id="preview">
                          </div>
                          <div class="form-group col-xs-12">
                            <label for="note">Note:</label>
                             <textarea class="form-control" rows="4" id="note" name = "note"></textarea>
                          </div>
                          <div class="form-group col-xs-6">
                            <button type="submit" name = "btnadd" class="btn btn-primary"><i class="fa fa-save fa-fw"></i>Save changes</button>
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
                
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>No</th>
                                            <th>Code</th>
                                            <th>Ref_Name</th>
                                            <th>Photo</th>
                                            <th>Packet</th>
                                            <th>Name(En)</th>
                                            <th>Name(Kh)</th>
                                            <th>Price</th>
                                            <th>Cost</th>    
                                            <th>Note</th>
                                            <th>Category</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1;
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $v1=$i;
                                              $v2=$row["code"];
                                              $v12=$row["ref"];
                                              $v3=$row["paket"];
                                              $v4=$row["name_en"];
                                              $v5=$row["name_kh"];
                                              $v6=$row["price_dolla"];
                                              $v7=$row["price_riel"];
                                             
                                              $v9=$row["photo"];
                                              $v10=$row["note_pro"];
                                              $v11=$row["category_name"];
                                          ?>
                                          <tr>
                                            <td><?php echo $v1;?></td> 
                                            <td><?php echo $v2;?> <a href="edit_product_code.php?id=<?= $v2 ?>" title="edit code"><i class="fa fa-pencil"></i></a></td>
                                            <td><?php echo $v12;?></td>
                                            <td><?php echo '<img src="img/product/' . $v9 . '" style="width: 50px;" alt="Logo">';?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td><?php echo $v6;?></td>
                                            <td><?php echo $v7;?></td>  
                                            <td><?php echo $v10;?></td>
                                            <td><?php echo $v11;?></td>
                                            <td align = "center">
                                            <a href="edit_product.php?id=<?php echo $row['pro_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick = "return confirm('Are you sure to delete ?');" href="product.php?id=<?php echo $row['pro_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                          </tr> 
                                          <?php
                                                $i++;
                                            }  
                                        
                                          ?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
              function validate_product_code(e){
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      if(this.responseText != 0){
                        e.style.border = '1px solid red';
                      }else{
                        e.style.border = '1px solid green';
                      }
                  }
                };
                xmlhttp.open("GET", "ajx_product_validate_code.php?code=" + e.value, true);
                xmlhttp.send();
              }
            </script>
          <?php include 'footer.php';?>