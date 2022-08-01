<?php include'config/db_connect.php'; 

if(isset($_POST['search'])){
  $from = $_POST['from'];
  $to = $_POST['to'];
  if(@$_POST['txt_product'] != ""){
    $v_product = @$_POST['txt_product'];
    $sql = "SELECT * FROM tbl_wh_stock_adjust AS A
                    LEFT JOIN product AS B ON A.whsa_product_code=B.pro_id
                    LEFT JOIN employee AS C ON A.whsa_employee=C.emp_id
                    LEFT JOIN tbl_unit AS D ON D.u_id=A.whsa_unit
                    WHERE A.whsa_date_record BETWEEN '$from' AND '$to' AND A.whsa_product_code='$v_product'
                          ";  
    $result = $connect->query($sql);
  }else{
    $sql = "SELECT * FROM tbl_wh_stock_adjust AS A
                    LEFT JOIN product AS B ON A.whsa_product_code=B.pro_id
                    LEFT JOIN employee AS C ON A.whsa_employee=C.emp_id
                    LEFT JOIN tbl_unit AS D ON D.u_id=A.whsa_unit
                    WHERE A.whsa_date_record BETWEEN '$from' AND '$to'
                          ";  
    $result = $connect->query($sql);
  }
}else{
  $v_date = date('Y-m');
  $sql = "SELECT * FROM tbl_wh_stock_adjust AS A
                    LEFT JOIN product AS B ON A.whsa_product_code=B.pro_id
                    LEFT JOIN employee AS C ON A.whsa_employee=C.emp_id
                    LEFT JOIN tbl_unit AS D ON D.u_id=A.whsa_unit
                    WHERE DATE_FORMAT(A.whsa_date_record,'%Y-%m')='$v_date'
                          ";  
  $result = $connect->query($sql);
}
  
  if(isset($_POST["btnadd"])){
    $v_date_record = $_POST["txt_date_record"];
    $v_letter_no = $_POST["txt_letter_no"];
    $v_product_code = $_POST["txt_product_code"];
    $v_qty_add = $_POST["txt_qty_add"];
    $v_qty_minus = $_POST["txt_qty_minus"];
    $v_unit = $_POST["txt_unit"];
    $v_approved_by = $_POST["txt_approved_by"];
    $v_employee = $_POST["txt_employee"];
    $v_note = $_POST["txt_note"];

     $sql = "INSERT INTO tbl_wh_stock_adjust 
                          (whsa_date_record
                            ,whsa_letter_no
                            ,whsa_product_code
                            ,whsa_qty_add
                            ,whsa_qty_minus
                            ,whsa_unit
                            ,whsa_approved_by
                            ,whsa_employee
                            ,whsa_note
                            ) 
              VALUES 
                ('$v_date_record'
                  , '$v_letter_no'
                  , '$v_product_code'
                  , '$v_qty_add'
                  , '$v_qty_minus'
                  , '$v_unit'
                  , '$v_approved_by'
                  , '$v_employee'
                  , '$v_note')";
     $result = mysqli_query($connect, $sql);
     header('location:wh_stock_adjust.php?message=success');
 }
    if(isset($_GET["id"])){
    $id = $_GET["id"];
      
    $sql = "DELETE FROM tbl_wh_stock_adjust WHERE whsa_id = '$id'" ;
    $result = mysqli_query($connect, $sql);
    header("location: wh_stock_adjust.php?message=delete");  
} 
?>

<?php include 'header.php';?>
          <div class="row">
            <div class = "col-xs-12">
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
                        <h3 class="text-primary"> Stock Adjust</h3>
                        
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> Add New </button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Add New *</h4>
                  </div>
                  <div class="modal-body">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="">     
                          <div class="form-group col-xs-6">
                            <label for ="">Date Record:</label>                                          
                            <input class="form-control" required  name="txt_date_record" type="date" placeholder="date..">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Letter No:</label>                                          
                            <input class="form-control" required  name="txt_letter_no" type="text" placeholder="letter no..">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Product Code:</label>                                          
                                  <select class = "form-control select2" style = "width:100%" name = "txt_product_code" id = "code">
                                    <option value="">Select Product</option>
                                        <?php
                                          $product = mysqli_query($connect,"SELECT * FROM product WHERE pro_id IN (SELECT whsi_product_code FROM tbl_wh_stock_in)");
                                          while ($row1 = mysqli_fetch_assoc($product)) { ?>
                                          <option value="<?php echo $row1['pro_id']; ?>"><?php echo $row1['code']." :: ".$row1['ref'] ;?></option>
                                        <?php 
                                        }
                                         ?>   
                                  </select>           
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Unit:</label>                                           
                            <select name="txt_unit" class="form-control select2" style="width: 100%;">
                              <option value="">==choose unit==</option>
                              <?php 
                                $get_unit = $connect->query("SELECT * FROM tbl_unit ORDER BY u_name_en ASC"); 
                                while ($row_unit = mysqli_fetch_object($get_unit)) {
                                  echo '<option value="'.$row_unit->u_id.'">'.$row_unit->u_name_en.' :: '.$row_unit->u_name_kh.'</option>';
                                }
                              ?>
                            </select>          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Qty Add:</label>                                          
                            <input class="form-control" required  name="txt_qty_add" type="text" placeholder="qty add..">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Qty Minus:</label>                                          
                            <input class="form-control" required  name="txt_qty_minus" type="text" placeholder="qty minus..">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Approved By:</label>                                          
                            <input class="form-control" required  name="txt_approved_by" type="text" placeholder="received from..">          
                          </div>
                          <div class="form-group col-xs-6">
                            <label for ="">Employee:</label>                                          
                              <select class = "form-control" name = "txt_employee" required>
                                   <option value="">Select Employee</option>
                                    <?php
                                       $employee = mysqli_query($connect,"SELECT * FROM employee");
                                        while ($row3 = mysqli_fetch_assoc($employee)) { ?>
                                       <option value="<?php echo $row3['emp_id']; ?>"><?php echo $row3['emp_name_kh'];?> :: <?php echo $row3['emp_name_en'];?></option>
                                    <?php 
                                    }
                                     ?>   
                               </select>
                            </div>
                          <div class="form-group col-xs-12">
                            <label for="note">Note:</label>
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
                <br><br>
                  <form class="form-inline" method = "post" action="">
                    <div class="form-group">
                      <input type="text" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" required="" placeholder="DATE START" class="form-control" name = "from" value="<?= @$_POST['from'] ?>" >
                    </div>
                    <div class="form-group">
                      <input type="text" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" required="" placeholder="DATE END" class="form-control" name = "to" value="<?= @$_POST['to'] ?>"> 
                    </div>
                    <div class="form-group">
                      <select class="form-control select2" name = "txt_product"> 
                        <option value="">=== choose Product ===</option>
                        <?php 
                          $emp_search = $connect->query("SELECT * FROM product GROUP BY ref ORDER BY ref ASC");
                          while ($row_emp = mysqli_fetch_object($emp_search)) {
                            if($row_emp->pro_id == @$_POST['txt_product']){
                              echo '<option SELECTED value="'.$row_emp->pro_id.'">'.$row_emp->ref.' :: '.$row_emp->name_kh.'</option>';
                            }else{
                              echo '<option value="'.$row_emp->pro_id.'">'.$row_emp->ref.' :: '.$row_emp->name_kh.'</option>';
                            }
                          }
                         ?>
                      </select>
                    </div>
                    <button type="submit" name="search" class="btn btn-success"><i class="fa fa-search fa-fw"></i>Search</button>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Clear</a>
                  </form> 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <!-- <th>ID</th> -->
                                            <th>#</th>
                                            <th>Date Record</th>
                                            <th>Letter In No</th>
                                            <th>Photo</th>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Qty Add</th>
                                            <th>Qty Minus</th>
                                            <th>Unit</th>
                                            <th>Approved By</th>
                                            <th>Employee</th>
                                            <th>Note</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=1;
                                            $sum_qty_add = 0;
                                            $sum_qty_minus = 0;
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              $sum_qty_add += $row["whsa_qty_add"];
                                              $sum_qty_minus += $row["whsa_qty_minus"];
                                              $v1=$i++;
                                              $v2=$row["whsa_date_record"];
                                              $v3=$row["whsa_letter_no"];
                                              $v4=$row["code"];
                                              $v5=$row["ref"];
                                              $v6=$row["whsa_qty_add"];
                                              $v6a=$row["whsa_qty_minus"];
                                              $v7=$row["u_name_en"];
                                              $v8=$row["whsa_approved_by"];
                                              $v9=$row["emp_name_en"];
                                              $v10=$row["whsa_note"];
                                          ?>
                                          <tr>
                                            <td><?php echo $v1;?></td> 
                                            <td><?php echo $v2;?></td>
                                            <td><?php echo $v3;?></td>
                                            <td><img src="img/product/<?= $row['photo'] ?>" height="50px"/></td>
                                            <td><?php echo $v4;?></td>
                                            <td><?php echo $v5;?></td>
                                            <td class="text-center"><?php echo $v6;?></td>
                                            <td class="text-center"><?php echo $v6a;?></td>
                                            <td><?php echo $v7;?></td>
                                            <td><?php echo $v8;?></td>
                                            <td><?php echo $v9;?></td>
                                            <td><?php echo $v10;?></td>

                                            <td align = "center">
                                            <a href="edit_wh_stock_adjust.php?id=<?php echo $row['whsa_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a onclick = "return confirm('Are you sure to delete ?');" href="wh_stock_adjust.php?id=<?php echo $row['whsa_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                          </tr> 
                                          <?php
                                            }  
                                          ?>
                                    </tbody>
                                    <tfoot>
                                      <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-center"><?= ((isset($_POST['search']))?(number_format($sum_qty_add,0)):('')) ?></th>
                                        <th class="text-center"><?= ((isset($_POST['search']))?(number_format($sum_qty_minus,0)):('')) ?></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                      </tr>
                                    </tfoot>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
          <?php include 'footer.php';?>