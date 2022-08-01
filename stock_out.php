<?php include'config/db_connect.php'; 
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');

    
  
    if(isset($_GET["id"])){
    $id = $_GET["id"];
      
    $sql = "DELETE FROM tbl_wh_stock_out WHERE whso_id = '$id'" ;
    $result = mysqli_query($connect, $sql);
    header("location: wh_stock_out.php?message=delete");  
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
                        <h3 class="text-primary">Stock Out</h3>
                        
                <a href="dashboard.php" class="btn btn-danger"><i class="fa fa-undo" aria-hidden="true"></i> Back</a>
                  <br><br>
                  <form class="form-inline" method = "post" action="">
                    <div class="form-group">
                      <input type="text" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="DATE START" class="form-control" name = "from" value="<?= @$_POST['from'] ?>" >
                    </div>
                    <div class="form-group">
                      <input type="text" autocomplete="off" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="DATE END" class="form-control" name = "to" value="<?= @$_POST['to'] ?>"> 
                    </div>
                    <div class="form-group">
                      <select class="form-control select2" name = "txt_product"> 
                        <option value="">=== Choose Item ===</option>
                        <?php 
                          $emp_search = $connect->query("SELECT * FROM item ORDER BY ite_name ASC");
                          while ($row_emp = mysqli_fetch_object($emp_search)) {
                            if($row_emp->ite_id == @$_POST['txt_product']){
                              echo '<option SELECTED value="'.$row_emp->ite_id.'">'.$row_emp->ite_name.'</option>';
                            }else{
                              echo '<option value="'.$row_emp->ite_id.'">'.$row_emp->ite_name.'</option>';
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
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Student</th>
                                            <th>Course</th>
                                            <th>Item</th>
                                            <th>Qty_Out</th>
                                            <th>Price</th>
                                            <th>Amount</th>
                                            <th>Note</th>
                                           <th><i class="fa fa-cog" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                          if(isset($_POST['search'])){
                                            $from = $_POST['from'];
                                            $to = $_POST['to'];
                                                  if(@$_POST['txt_product'] != ""
                                                    AND @$_POST['from'] != ""
                                                    ){
                                                    $v_product = @$_POST['txt_product'];
                                                    $sql = "SELECT * FROM payment_detail
                                                                      LEFT JOIN payment ON payment.pay_id=payment_detail.payd_payment_id
                                                                      LEFT JOIN student ON student.stu_id=payment.pay_student_id
                                                                      LEFT JOIN course ON course.co_id=payment.pay_course_id
                                                                      LEFT JOIN item ON item.ite_id=payment_detail.payd_item_id
                                                                      WHERE pay_date BETWEEN '$from' AND '$to' 
                                                                      AND payd_item_id='$v_product'
                                                                      ORDER BY pay_date DESC      
                                                                      ";  
                                                    $result = $connect->query($sql);
                                                    echo "date+prodcut";
                                                  }
                                                  elseif(@$_POST['txt_product'] != ""){
                                                    $v_product = @$_POST['txt_product'];
                                                    $sql = "SELECT * FROM payment_detail
                                                                      LEFT JOIN payment ON payment.pay_id=payment_detail.payd_payment_id
                                                                      LEFT JOIN student ON student.stu_id=payment.pay_student_id
                                                                      LEFT JOIN course ON course.co_id=payment.pay_course_id
                                                                      LEFT JOIN item ON item.ite_id=payment_detail.payd_item_id
                                                                      WHERE payd_item_id='$v_product'
                                                                      ORDER BY pay_date DESC      
                                                                      ";  
                                                    $result = $connect->query($sql);
                                                    //echo "prodcut";
                                                  }
                                                  elseif(@$_POST['from'] != ""){
                                                    $v_product = @$_POST['txt_product'];
                                                    $sql = "SELECT * FROM payment_detail
                                                                      LEFT JOIN payment ON payment.pay_id=payment_detail.payd_payment_id
                                                                      LEFT JOIN student ON student.stu_id=payment.pay_student_id
                                                                      LEFT JOIN course ON course.co_id=payment.pay_course_id
                                                                      LEFT JOIN item ON item.ite_id=payment_detail.payd_item_id
                                                                      WHERE pay_date BETWEEN '$from' AND '$to' 
                                                                      ORDER BY pay_date DESC      
                                                                      ";  
                                                    $result = $connect->query($sql);
                                                    echo "date";
                                                  }
                                                  else{
                                                    $month =date('m');
                                                    $year =date('Y');
                                                    $sql = "SELECT * FROM payment_detail
                                                                      LEFT JOIN payment ON payment.pay_id=payment_detail.payd_payment_id
                                                                      LEFT JOIN student ON student.stu_id=payment.pay_student_id
                                                                      LEFT JOIN course ON course.co_id=payment.pay_course_id
                                                                      LEFT JOIN item ON item.ite_id=payment_detail.payd_item_id
                                                                      WHERE pay_date=$year
                                                                      ORDER BY pay_date DESC      
                                                                      ";  
                                                    $result = $connect->query($sql);
                                                    echo "please, choose for serach";
                                                  }
                                          }else{
                                            $month =date('m');
                                            $year =date('Y');
                                            $sql = "SELECT * FROM payment_detail
                                                              LEFT JOIN payment ON payment.pay_id=payment_detail.payd_payment_id
                                                              LEFT JOIN student ON student.stu_id=payment.pay_student_id
                                                              LEFT JOIN course ON course.co_id=payment.pay_course_id
                                                              LEFT JOIN item ON item.ite_id=payment_detail.payd_item_id
                                                              ORDER BY pay_date DESC      
                                                              ";  
                                            $result = $connect->query($sql);
                                          }

                                            $i=1;
                                            while($row = $result->fetch_assoc()) 
                                            {     
                                              
                                              $v1 =$i++;

                                              $v_date =$row["pay_date"];
                                              $v_student_id =$row["pay_student_id"];
                                              $v_name_en =$row["stu_name_en"];
                                              $v_name_kh =$row["stu_name_kh"];
                                              $v_pay_course_id =$row["pay_course_id"];
                                              $v_pay_course_name =$row["co_name"];

                                              $v_item_id =$row["payd_item_id"];
                                              $v_item_name =$row["ite_name"];
                                              $v_qty =$row["payd_qty"];
                                              $v_price =$row["payd_price"];
                                              $v_amount =$row["payd_amount"];
                                              $v_note =$row["payd_note"];
                                          ?>
                                          <tr>
                                            <td><?php echo $v1;?></td> 
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
                                            <td>
                                              <?php echo $v_name_en;?>
                                              <?php echo $v_name_kh;?>
                                            </td>
                                            <td><?php echo $v_pay_course_name;?></td>
                                            <td><?php echo $v_item_name;?></td>
                                            <td><?php echo $v_qty;?></td>
                                            <td><?php echo $v_price;?></td>
                                            <td><?php echo $v_amount;?></td>
                                            <td><?php echo $v_note;?></td>
                                            <td align = "center">
                                            
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