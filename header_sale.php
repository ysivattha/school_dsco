<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!--<link href="plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
  <link href="plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />-->
  <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/1.2.3/css/buttons.dataTables.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Chenla" rel="stylesheet">
  <style type="text/css">
      *{ font-family: 'Chenla',"Source Sans Pro", sans-serif; }
  </style>
  <style type="text/css">
    label{ font-family: 'khmer os content'; font-weight: normal; }
    .btn_items{
      width: 100%; border-radius: 0px; height: 75px; margin-bottom: 20px;
      white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .table_body_result tr td:nth-child(3),.table_body_result tr td:nth-child(4),.table_body_result tr td:nth-child(5){
      text-align: center;
    }
    .table_body_result tr td:nth-child(6){
      text-align: right;
    }
    .table_body_result tr td.v_td_qty{
      background: #ddd; border: 1px dashed #000;
    }
    button,a{ border-radius: 0px!important; }
  </style>
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand">POS</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="table_order.php"><strong>Table Order</strong></a></li>
            <li class="dropdown user user-menu pull-left">
            <a for="qp" style="cursor: pointer;">
                Sale KH
                <input type="checkbox" id="qp" <?= (file_get_contents("stable_file/currency_kh.txt"))?('checked'):('') ?>>
                <script type="text/javascript">
                  document.getElementById('qp').onchange = function(){
                    $qp_value = this.checked;
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                        //alert(this.responseText);
                        window.location.reload();
                      }
                    };
                    xmlhttp.open("GET", "stable_file/direct_ajx.php?q=" + $qp_value, true);
                    xmlhttp.send();
                  };
                </script>
            </a>
          </li>
          </ul>
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="img/logo.png" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $show['username'] ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="img/logo.png" class="img-circle" alt="User Image">
                  <p>
                    <?php echo $show['username'] ?>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                  </div>
                  <div class="pull-right">
                    <a href="logout.php" class="btn btn-default btn-flat">Log out</a>
                  </div>
                  <div class="">

                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="content-wrapper"><br>
    <div class="container-fluid">
