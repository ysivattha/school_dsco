<?php 
include_once 'config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$date = strtotime($today);
$date1 = strtotime("+7 day", $date);
$date2 = date('Y-m-d', $date1);
//echo $date2; 

?>
<?php include 'header.php';?>
	 <!-- Content Header (Page header) -->
      
    
  <div class="panel-heading">
      <section class="content-header">
        <style>
          .pcenter{
            text-align: center;
          }
        </style>
      </section>
      <p class="pcenter">
        <img src="img/logo.jpg" alt="" width="150px">
      </p>
    <h3 class="text-center">School Management System </h3>
  </div>

  <div class="row">
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                <img class="img-circle" src="img/our-students.jpg" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username">Student</h3>
              <h5 class="widget-user-desc">All Class, All Subject</h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="student.php">Student Active <span class="pull-right badge bg-blue">
                        
                        <?php
                            $sql_count = "SELECT count(stu_id) AS countnum FROM student AS A
                                    WHERE stu_stop is NULL
                                    OR stu_stop ='Learning'
                                                            ";	
                            $result_count = $connect->query($sql_count);
                            $row_count = $result_count->fetch_assoc();
                            $get_count = $row_count['countnum'];
                            echo $get_count;
                          ?>
                </span></a></li>
                <li><a href="student_stop.php">Student Stop <span class="pull-right badge bg-red">
                  
                          <?php
                              $sql_count = "SELECT count(stu_id) AS countnum FROM student AS A
                                      WHERE stu_stop = 'Stop'
                                                              ";	
                              $result_count = $connect->query($sql_count);
                              $row_count = $result_count->fetch_assoc();
                              $get_count = $row_count['countnum'];
                              echo $get_count;
                            ?>
                </span></a></li>
                <li><a href="student_all.php">Student All <span class="pull-right badge bg-green">

                            <?php
                              $sql_count = "SELECT count(stu_id) AS countnum FROM student AS A
                                                                        ";	
                              $result_count = $connect->query($sql_count);
                              $row_count = $result_count->fetch_assoc();
                              $get_count = $row_count['countnum'];
                              echo $get_count;
                            ?>
                </span></a></li>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">Subject Courses</h3>
              <h5 class="widget-user-desc">Class &amp; Room</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="img/book.jpg" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header" style="background-color:yellow">

                            <?php
                              $sql_count = "SELECT count(co_id) AS countnum FROM course AS A
                                                      WHERE co_finish !='Finish'
                                                                        ";	
                              $result_count = $connect->query($sql_count);
                              $row_count = $result_count->fetch_assoc();
                              $get_count = $row_count['countnum'];
                              echo $get_count;
                            ?>
                    </h5>
                    <a href="course.php">
                      <span class="description-text">On going</span>
                    </a>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header" style="background-color:blue">

                            <?php
                              $sql_count = "SELECT count(co_id) AS countnum FROM course AS A
                                                      WHERE co_finish ='Finish'
                                                                        ";	
                              $result_count = $connect->query($sql_count);
                              $row_count = $result_count->fetch_assoc();
                              $get_count = $row_count['countnum'];
                              echo $get_count;
                            ?>
                    </h5>
                    <a href="course_finish.php">
                      <span class="description-text">Finished</span>
                    </a>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header" style="background-color:green">
                    
                            <?php
                              $sql_count = "SELECT count(co_id) AS countnum FROM course AS A
                                                                        ";	
                              $result_count = $connect->query($sql_count);
                              $row_count = $result_count->fetch_assoc();
                              $get_count = $row_count['countnum'];
                              echo $get_count;
                            ?>
                    </h5>
                    <a href="course_all.php">
                      <span class="description-text">All Course</span>
                    </a>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green" style="background: url('../dist/img/photo1.png') center center;">
              <h3 class="widget-user-username">Payment</h3>
              <h5 class="widget-user-desc">Strudent Pay Fee</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="img/dollar.jpg" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">
                      <span style="color:red">
                      
                            $ <?php
                              $sql_count = "SELECT sum(pay_pay) AS sumnum FROM payment AS A
                                                                        ";	
                              $result_count = $connect->query($sql_count);
                              $row_count = $result_count->fetch_assoc();
                              $get_count = $row_count['sumnum'];
                              echo $get_count;
                            ?>
                      </span>
                    </h5>
                    <a href="received_payment.php">
                      <span class="description-text">Received</span>
                    </a>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">
                      <span style="color:blue">
                        
                            $ <?php
                              $sql_count = "SELECT sum(pay_rest) AS sumnum FROM payment AS A
                                                                        ";	
                              $result_count = $connect->query($sql_count);
                              $row_count = $result_count->fetch_assoc();
                              $get_count = $row_count['sumnum'];
                              echo $get_count;
                            ?>
                      </span>
                    </h5>
                    <a href="received_payment.php">
                      <span class="description-text">A/R</span>
                    </a>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">
                      <span style="color:green">

                            $ <?php
                              $sql_count = "SELECT sum(pay_amount) AS sumnum FROM payment AS A
                                                                        ";	
                              $result_count = $connect->query($sql_count);
                              $row_count = $result_count->fetch_assoc();
                              $get_count = $row_count['sumnum'];
                              echo $get_count;
                            ?>
                      </span>
                    </h5>
                    <a href="received_payment.php">
                      <span class="description-text">Total Payment</span>
                    </a>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<!-- =========================================================== -->

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-sm-3">
            <div class="widget-user-header bg-red">
              <span class=""><i class="fa fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Count Teacher:</span>
                <span class="info-box-number">
                    <?php
                      $sql_count = "SELECT count(emp_id) AS countnum FROM employee AS A
                                                                ";	
                      $result_count = $connect->query($sql_count);
                      $row_count = $result_count->fetch_assoc();
                      $get_count = $row_count['countnum'];
                      echo $get_count;
                    ?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3">
            <div class="widget-user-header bg-blue">
              <span class=""><i class="fa fa-dollar"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Count Supplier:</span>
                <span class="info-box-number">
                    <?php
                      $sql_count = "SELECT count(vender_id) AS countnum FROM vender AS A
                                                                ";	
                      $result_count = $connect->query($sql_count);
                      $row_count = $result_count->fetch_assoc();
                      $get_count = $row_count['countnum'];
                      echo $get_count;
                    ?>
                  </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-sm-3">
            <div class="widget-user-header bg-gray">
              <span class=""><i class="fa fa-arrows"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Count Room:</span>
                <span class="info-box-number">
                    <?php
                      $sql_count = "SELECT count(ro_id) AS countnum FROM room AS A
                                                                ";	
                      $result_count = $connect->query($sql_count);
                      $row_count = $result_count->fetch_assoc();
                      $get_count = $row_count['countnum'];
                      echo $get_count;
                    ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-sm-3">
            <div class="widget-user-header bg-yellow">
              <span class=""><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Count Car:</span>
                <span class="info-box-number">
                    <?php
                      $sql_count = "SELECT count(car_id) AS countnum FROM car AS A
                                                                ";	
                      $result_count = $connect->query($sql_count);
                      $row_count = $result_count->fetch_assoc();
                      $get_count = $row_count['countnum'];
                      echo $get_count;
                    ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

<!-- =========================================================== -->      
  
<?php include 'footer.php';?>
