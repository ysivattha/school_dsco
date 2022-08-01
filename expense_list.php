<?php include'config/db_connect.php'; 


  if(isset($_POST['search'])){
    $from = $_POST['from'];
    $to = $_POST['to'];
    $expense = $_POST['txt_choose_exp'];

        if($_POST['from']!=""
            AND $_POST['txt_choose_exp']!="0"
          ){
            $sql = "SELECT * FROM expense
            LEFT JOIN expense_category ON expense_category.exca_id=expense.exp_expense_cat
            WHERE DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
            AND exp_expense_cat=$expense
            ORDER BY exp_date DESC
            ";
        }elseif($_POST['from']!=""){
          $sql = "SELECT * FROM expense
          LEFT JOIN expense_category ON expense_category.exca_id=expense.exp_expense_cat
          WHERE DATE_FORMAT(exp_date,'%Y-%m-%d') BETWEEN '$from' AND '$to'
          ORDER BY exp_date DESC
          ";
        }elseif($_POST['txt_choose_exp']!="0"){
            $sql = "SELECT * FROM expense
            LEFT JOIN expense_category ON expense_category.exca_id=expense.exp_expense_cat
            WHERE exp_expense_cat=$expense
            ORDER BY exp_date DESC
            ";
        }else{
            $v_current_year_month=date('Y-m');
            $v_current_year =date('Y');
            $sql = "SELECT * FROM expense
                    LEFT JOIN expense_category ON expense_category.exca_id=expense.exp_expense_cat
                    WHERE DATE_FORMAT(exp_date,'%Y')='$v_current_year'
                    ORDER BY exp_date DESC
                    ";
            echo "Please, choose for serach";
        }    
          
      
  }else{
    $v_current_year_month =date('Y-m');
    $v_current_year =date('Y');
    $sql = "SELECT * FROM expense
            LEFT JOIN expense_category ON expense_category.exca_id=expense.exp_expense_cat
            WHERE DATE_FORMAT(exp_date,'%Y')='$v_current_year'
            ORDER BY exp_date DESC
            ";
  }


  $result = $connect->query($sql);
  

    if(isset($_GET["del_id"])){
    $id = $_GET["del_id"];
      
    $sql = "DELETE FROM expense WHERE exp_id='$id'" ;
    $result = mysqli_query($connect, $sql);
    header("location:expense_list.php?message=delete");  
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
                        <h3 class="text-primary">Expense List </h3>
                        <a href="expense_add.php" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
                            
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
                        
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                  </div>
                </div>
                </div>
                <!-- <a href="dashboard.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a> -->
                
                <div class="row">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">               
                <div class="col-sm-12">
                    
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="from" value="<?= @$_POST['from'] ?>">
                    </div>
                    <div class="col-sm-2">
                        <input type="date" class="form-control" name="to" value="<?= @$_POST['to'] ?>">
                    </div>
                    <div class="col-sm-3">
                            <select name="txt_choose_exp" class="form-control select2" >
                                <option value="0">=== Expense ===</option>
                                <?php 
                                    $customer = $connect->query("SELECT * FROM expense_category ORDER BY exca_id ASC");
                                    while($row_cus = mysqli_fetch_object($customer)){
                                        if($row_cus->exca_id  == @$_POST['txt_choose_exp']){
                                            echo '<option SELECTED value="'.$row_cus->exca_id.'">'.$row_cus->exca_name.'</option>';

                                        }else{
                                            echo '<option value="'.$row_cus->exca_id.'">'.$row_cus->exca_name.'</option>';
                                            
                                        }
                                    }
                                ?>
                            </select>
                    </div>
                    <div class="col-sm-4">
                        <div class="caption font-dark" style="display: inline-block;">
                            <button type="submit" name="search" id="sample_editable_1_new" class="btn btn-primary btn-sm"> Search
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                        <div class="caption font-dark" style="display: inline-block;">
                            <a href="<?= $_SERVER['PHP_SELF'] ?>" id="sample_editable_1_new" class="btn btn-danger btn-sm"> Clear
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a href="expense_print.php?from=<?php echo @$_POST['from']; ?>&to=<?php echo @$_POST['to']; ?>&txt_choose_exp=<?php echo @$_POST['txt_choose_exp']; ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print</a>
				
                        </div>

                    </div>
                    
                </div>
                </form>
            </div>

                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                               <table id="example" class="display nowrap" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Expense_Category</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Pay_To</th>
                                            <th>Note</th>
                                            <th>Upload</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            $i=1;
                                            $v_amount_total =0;
                                            while($row = $result->fetch_assoc()) 
                                            { 
                                              $v_amount_total +=$row["exp_amount"];

                                              $v_date =$row["exp_date"];
                                              $v_expense_cat =$row["exca_name"];
                                              $v_description =$row["exp_description"];
                                              $v_amount =$row["exp_amount"];
                                              $v_pay_to =$row["exp_pay_to"];
                                              $v_note =$row["exp_note"];
                                              $v_photo =$row["exp_photo"];
                                          ?>
                                          <tr>
                                            <td><?php echo $i++ ;?></td> 
                                            <td>
                                                  <?php
                                                  if($v_date=="0000-00-00"){
                                                    echo '';
                                                  }
                                                  elseif($v_date==""){
                                                    echo '';
                                                  }	
                                                  else{
                                                    echo date('d-M-Y',strtotime($v_date));
                                                  }
                                                  ?>
                                            </td>
                                            <td><?php echo $v_expense_cat;?></td>
                                            <td><?php echo $v_description;?></td>
                                            <td><?php echo $v_amount;?></td>
                                            <td><?php echo $v_pay_to;?></td>
                                            <td><?php echo $v_note;?></td>
                                            <td>
                                                <?php
                                                  if($v_photo == ""){
                                                ?>
                                                  <a href="img/expense_photo/blank.png" target="_blank">
                                                    <img height="50px" src="img/expense_photo/blank.png"
                                                  </a>
                                                <?php
                                                  }else{
                                                ?>
                                                  <a href="img/expense_photo/<?=$row['exp_photo']?>" target="_blank">
                                                    <img height="50px" src="img/expense_photo/<?= $row['exp_photo']; ?>"
                                                  </a>
                                                <?php
                                                  }
                                                ?>
                                                <a href="upload_photo_expense.php?sent_id=<?= $row['exp_id'] ?>&sent_img=<?= $row['exp_photo'] ?>">
                                                  <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                            <td align = "center">
                                              <a href="expense_edit.php?edit_id=<?php echo $row['exp_id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                              <a onclick = "return confirm('Are you sure to delete ?');" href="expense_list.php?del_id=<?php echo $row['exp_id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                              <a href="expense_one_print.php?print_id=<?php echo $row['exp_id']; ?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
                                              
                                              
                          
                                            </td>
                                          </tr> 
                                          <?php
                                            }  
                                          ?>
                                    </tbody>
                                    <tfoot>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th>$ <?= number_format($v_amount_total,2) ?></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                    </tfoot>
                                </table>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
          <?php include 'footer.php';?>