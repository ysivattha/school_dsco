<?php 
$v_permission_page="login";
require_once 'config/db_connect.php';
if(@$_SESSION['user_id']){
	header('location: dashboard.php');
}

 $errors = "";  
if( !empty($_POST) ) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	if( empty($username) == true OR empty($password) == true ) {
		$errors = "<div class = 'alert alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						<h6>No username/password in field</h6></div>
		";
	} 
	else {
		// if username exists
		$sql = "SELECT * FROM user WHERE username = '$username'";
		$query = $connect->query($sql);
		if( $query->num_rows > 0 ) {
		// check username and password
			$password = md5($password);

			$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
			$query = $connect->query($sql);
			$result = $query->fetch_array();

			$connect->close();

			if($query->num_rows == 1) {				
				$_SESSION['logged_in'] = true;
				$_SESSION['user_id'] = $result['id'];

				header('location:dashboard.php');
				exit();
			}	
			else {
				$errors = "<div class = 'alert alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						<h6>Username/Password combination is incorrect</h6></div>
		";
			}
		} 	
		else {
			$errors = "<div class = 'alert alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>&times;</button>
						<h6>User name password not correct</h6></div>
		";
		}
	}

}

?>
<?php 

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Welcome</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="style/style.css">
</head>
<body style = "background:lightblue">
<section class="content">
	<div class = "row">
		<div class = "col-md-4 col-md-offset-4 col-xs-12">
			<div class="box box-primary">
			<!-- <?php
			 $query = "SELECT * FROM company where cid = 1";
			 $result1 = mysqli_query($connect, $query);    
			 ?> -->
				<div class="box-header with-border">
				  <h3 class="box-title">
				 Welcome: Login<?php
				// $row = mysqli_fetch_assoc($result1);
				// 	echo '<strong style="color: #000;"> '.$row['company_name'].'</strong>';
				?> 
				</h3>
				</div>
				<div class = "row">
					<div class = "col-xs-12">
						<center><img src="img/logo.jpg"​ width="170px" class ="img-responsive">
								<h3>School Management System</h3>
						</center>
					</div>
				</div>
				<form class="form-horizontal" action = "" method = "post" data-toggle="validator" role="form">
				  <div class="box-body">
				  	<div class="form-group">	
						<div class="col-sm-12">	
								<?php echo $errors;?>
						</div>
				  	</div>
					<div class="form-group">
					  <div class="col-sm-12">
						<input type="text" required class="form-control" id="inputName" name = "username" placeholder="Username" autofocus="" autocomplete="off">
					  </div>
					</div>
					<div class="form-group">
					  <div class="col-sm-12">
						<input type="password" required class="form-control" id="inputName" name = "password" placeholder="Password" autocomplete="off">
					  </div>
					</div>
				  </div>
				  <div class="box-footer">
					<button type="submit" style="border-radius: 0px;" class="btn btn-primary btn-lg btn-block"><i class="fa fa-sign-in" aria-hidden="true"> </i> Login</button><br>
				  </div>
				</form>
			</div>
        </div>
	</div>
</section>
		<!-- jQuery 2.2.3 -->
		<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="plugins/fastclick/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="dist/js/app.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="dist/js/demo.js"></script>
		<script src="dist/js/validator.min.js"></script>

  
</body>
</html>