<?php
include_once 'config/db_connect.php';
date_default_timezone_set("Asia/Bangkok");
$today = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$date = strtotime($today);
$date1 = strtotime("+7 day", $date);
$date2 = date('Y-m-d', $date1);
//echo $date2; 

if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM user WHERE id = $user_id";
  $query = $connect->query($sql);
  $show = $query->fetch_array();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="Font-Awesome-master/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <link rel="stylesheet" href="prints/paper.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="offline/jquery.dataTables.min.css">
  <link rel="stylesheet" href="offline/buttons.dataTables.min.css">

  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link href="https://fonts.googleapis.com/css?family=Chenla" rel="stylesheet">
  <style type="text/css">
      *{ font-family: 'Chenla',"Source Sans Pro", sans-serif; }
  </style>
  <style>
        .menu-item{
            list-style:none;
        } 
        .menu-item a{
            padding:20px;
            padding-bottom:10px;
            
            color:#1B3E70;
            text-decoration:none;
        }.menu-item a:hover{
                background-color:#1B3E70;
              color:white;
        }
        .menu-item .active{
             background-color:#1B3E70;
             color:white;
        
        }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header --> 
  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>S</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>System</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>      <!-- Navbar Right Menu -->
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
      
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="img/logo.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Hello : <?php echo $show['username'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="img/logo.png" class="img-circle" alt="User Image">

                <p>
                  
                  <small>Hello : <?php echo $show['username'] ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                <?php
                  if ($show ['position_id'] == 1){
                ?>
              
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="user.php" class="btn btn-default btn-flat">User</a>
                </div>
                <?php
                }
                ?>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat"> <i class="fa fa-power-off" aria-hidden="true"> </i>  Log out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <!-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> -->
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/logo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $show['username'] ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      
      <!-- /.search form -->

      <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="header">LIST</li>
			<?php
      if($show['position_id'] == 1){
    ?>
      <li><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i><span>Home</span></a></li>
      <li><a href="dashboard_report.php"><i class="fa fa-dashboard" aria-hidden="true"></i><span>Dashboard Report</span></a></li>
      
        
        
      <li>----------------</li>    
            <li><a href="student.php"><i class="fa fa-users" aria-hidden="true"></i><span>Student Active </span></a></li>
            <li class="menu-item"><a href="student_stop.php"><i class="fa fa-times" aria-hidden="true"></i><span>Student Stop </span></a></li>
            <li class="menu-item"><a href="student_all.php"><i class="fa fa-list" aria-hidden="true"></i><span>Student All </span></a></li>
          
            <li class="menu-item"><a href="student_transport.php"><i class="fa fa-car" aria-hidden="true"></i><span>Student Transport </span></a></li>
            <li class="menu-item"><a href="student_transport_stop.php"><i class="fa fa-times" aria-hidden="true"></i><span>Student Tran. Stop </span></a></li>
            
        
      
      
      <li>----------------</li>

          <li><a href="course_score_exam.php"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Exam Score</span></a></li>
          

        <li>----------------</li>
        <li class="menu-item active"><a href="received_payment.php"><i class="fa fa-dollar" aria-hidden="true"></i><span>Received Payment</span></a></li>
        <li><a href="alert_payment.php"><i class="fa fa-bell" aria-hidden="true"></i><span>Alert Payment

                  <span style="color:red">
										(<?php
                        $v_alert = "Alert";
                        $sql_count = "SELECT count(pay_id) AS countnum FROM payment AS A
                                            LEFT JOIN student AS STU ON STU.stu_id=A.pay_student_id
                                            LEFT JOIN course AS COU ON COU.co_id=A.pay_course_id
                                            WHERE A.pay_date_alert <= '$date2'
                                            AND A.pay_stop_alert IS NULL
                                            OR A.pay_stop_alert = '$v_alert'
                                                                                ";
                        $result_count = mysqli_query($connect, $sql_count);
                        $row_count = $result_count->fetch_assoc();
												$get_count = $row_count['countnum'];
												echo $get_count;
											?>)
									</span>
        </span></a></li>
        <li><a href="waiting_payment.php"><i class="fa fa-info" aria-hidden="true"></i><span>Waiting Payment

                  <span style="color:red">
										(<?php
                        $v_alert = "Waiting_Pay";
                        $sql_count = "SELECT count(pay_id) AS countnum FROM payment AS A
                                            LEFT JOIN student AS STU ON STU.stu_id=A.pay_student_id
                                            LEFT JOIN course AS COU ON COU.co_id=A.pay_course_id
                                            WHERE A.pay_date_alert <= '$date2'
                                            AND A.pay_stop_alert IS NULL
                                            OR A.pay_stop_alert = '$v_alert'
                                                                                ";
                        $result_count = mysqli_query($connect, $sql_count);
                        $row_count = $result_count->fetch_assoc();
												$get_count = $row_count['countnum'];
												echo $get_count;
											?>)
									</span>
        </span></a></li>
        <li><a href="stop_alert_payment.php"><i class="fa fa-times" aria-hidden="true"></i><span>Stop Alert List</span></a></li>
        <li><a href="item_list.php"><i class="fa fa-flag" aria-hidden="true"></i><span>Item List</span></a></li>
        
        <li>----------------</li>

        <li><a href="attendance.php"><i class="fa fa-check" aria-hidden="true"></i><span>Attendance Student</span></a></li>
        <li><a href="attendance_report.php"><i class="fa fa-file" aria-hidden="true"></i><span>Attendance Student</span></a></li>
          
        <li>----------------</li>
        <li><a href="course.php"><i class="fa fa-pencil" aria-hidden="true"></i><span>Subject Course</span></a></li>
        <li><a href="class.php"><i class="fa fa-book" aria-hidden="true"></i><span>Class</span></a></li>
        <li><a href="course_finish.php"><i class="fa fa-arrow-left" aria-hidden="true"></i><span>Finish Class</span></a></li>
        <li><a href="course_all.php"><i class="fa fa-list" aria-hidden="true"></i><span>All Class</span></a></li>
        
         
        <li>----------------</li>
        <li><a href="employee.php"><i class="fa fa-user-circle-o" aria-hidden="true"></i><span>Employee</span></a></li>
        <li><a href="vender.php"><i class="fa fa-user" aria-hidden="true"></i><span>Supplier</span></a></li>
        
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dollar"></i><span>Account</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
          <ul class="treeview-menu">
            <li><a href="revenue_list.php"><i class="fa fa-arrow-right" aria-hidden="true"></i><span> Revenue</span></a></li>
            <li><a href="expense_list.php"><i class="fa fa-arrow-right" aria-hidden="true"></i><span> Expense</span></a></li>
            <li><a href="profit_list.php"><i class="fa fa-arrow-right" aria-hidden="true"></i><span> Profit</span></a></li>
            <li><a href="revenue_category.php"><i class="fa fa-cube" aria-hidden="true"></i><span> Revenue Category</span></a></li>
            <li><a href="expense_category.php"><i class="fa fa-cube" aria-hidden="true"></i><span> Expense Category</span></a></li>
         
          </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cube"></i><span>Stock Stationary</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
          <ul class="treeview-menu">
            <li><a href="product.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span> Product</span></a></li>
            <li><a href="category.php"><i class="fa fa-cubes" aria-hidden="true"></i><span> Category</span></a></li>
            <li><a href="wh_stock_in.php"><i class="fa fa-arrow-down" aria-hidden="true"></i><span> Stock In</span></a></li>
            <li><a href="wh_stock_out.php"><i class="fa fa-arrow-right" aria-hidden="true"></i><span> Stock Out</span></a></li>
            <li><a href="wh_stock_adjust.php"><i class="fa fa-arrow-up" aria-hidden="true"></i><span> Stock Adjust</span></a></li>
            <li><a href="wh_stock_balance.php"><i class="fa fa-list" aria-hidden="true"></i><span> Stock Balance</span></a></li>
          
          </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cog"></i><span>Setting</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
          <ul class="treeview-menu">
            <li><a href="car.php"><i class="fa fa-truck" aria-hidden="true"></i><span> Car</span></a></li>
            <li><a href="room.php"><i class="fa fa-arrow-right" aria-hidden="true"></i><span> Room</span></a></li>
            <li><a href="shift.php"><i class="fa fa-arrows" aria-hidden="true"></i><span> Shift</span></a></li>
            <li><a href="time.php"><i class="fa fa-calendar" aria-hidden="true"></i><span> Time</span></a></li>
            <li><a href="day.php"><i class="fa fa-clock-o" aria-hidden="true"></i><span> Day</span></a></li>
            
            <li>-</li>
            <li><a href="user_user.php?id=<?php echo $show['id']; ?> "><i class="fa fa-key" aria-hidden="true"></i><span> Your Password</span></a></li>
            <li><a href="user.php"><i class="fa fa-user" aria-hidden="true"></i><span> User Management</span></a></li>
            <li><a href="about.php"><i class="fa fa-info-circle" aria-hidden="true"></i><span>About System​ </span></a></li>
          </ul>
      </li>

		<?php
		}else if($show['position_id'] == 2){
      ?>
      
      
    <?php
		}else if($show['position_id'] == 3){
    ?>
      
      
    <?php
		}else if($show['position_id'] == 4){ // user teacher
    ?>

      <li><a href="course_teacher.php"><i class="fa fa-pencil" aria-hidden="true"></i><span>Class Course</span></a></li>
        
      <li><a href="attendance_teacher.php"><i class="fa fa-check" aria-hidden="true"></i><span>Attendance Student</span></a></li>
      <li><a href="attendance_report_teacher.php"><i class="fa fa-file" aria-hidden="true"></i><span>Attendance Report</span></a></li>
      <li>---------------</li>
      <li><a href="exam_score_teacher.php"><i class="fa fa-circle-o" aria-hidden="true"></i><span>Exam Score</span></a></li>
           
      
      <li><a href="user_user.php?id=<?php echo $show['id']; ?> "><i class="fa fa-key" aria-hidden="true"></i><span> Your Password</span></a></li>
            
    <?php
    }
    ?>
    <li><a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i><span>Logout</span></a></li>

		
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

<script>
   $('.menu-item a').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
        });
</script>