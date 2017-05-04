<?php
error_reporting(1);
ob_start();
	$flag = NULL;
	if( isset($_POST['register-submit']) )
	{
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$connection = mysqli_connect('localhost','root','','experiment');
		$query = "INSERT INTO `information` (`firstName`, `lastName`, `email`, `password`) VALUES ('$firstName', '$lastName', '$email', '$password')";
		$result = mysqli_query($connection,$query);
		if ($result) {
			$flag = 1;
		}
	}
	
	if ( isset($_POST['login-submit']) )
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$connection = mysqli_connect('localhost','root','','experiment');
		$query = "SELECT email,password,firstName,lastName FROM `information` WHERE email='$username'";
		$result = mysqli_query($connection,$query);
		$row = mysqli_fetch_array($result);
		if ( $row['email']==$username && $row['password']==$password ) {
			$flag = -1;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<title>TASK 2017</title>
</head>
<body style="padding-top: 50px;">
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
			<?php
			if ($flag==1)
			{
				echo "<div class=\"alert alert-success\" role=\"alert\">
  						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
  						<strong class=\"text-center\">Registration Successful!</strong>
					  </div>";
			}

			if ($flag==-1)
			{
				session_start();
				$_SESSION["firstName"] = $row['firstName'];
				$_SESSION["lastName"] = $row['lastName'];
				echo "<div class=\"alert alert-success\" role=\"alert\">
  						<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
  						<strong class=\"text-center\">Login Successful! Redirecting...</strong>
					  </div>";
				header("refresh:3;url='members.php'");
			}
			?>
				<h1 class="text-center">TASK <strong>2017</strong></h1>
				<div class="panel panel-login" id="panel-login">
					<div class="panel-heading" id="panel-heading">
						<div class="row">
							<div class="col-xs-6" id="register-form-link-holder">
								<a href="#" class="active btn btn-block form-link" id="register-form-link">Sign Up</a>
							</div>
							<div class="col-xs-6" id="login-form-link-holder">
								<a href="#" class=" btn btn-block form-link" id="login-form-link">Log In</a>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="register-form" action="" method="post" role="form" style="display: block;">
									<div><h4 class="text-center" style="margin-top: 10px;margin-bottom: 25px;">Sign Up for Free</h4></div>
									<div class="form-group row col-sm-12">
										<div class="col-sm-7" id="firstNameHolder">
											<input type="text" name="firstName" id="username" tabindex="1" class="form-control" placeholder="First Name*" value="" required>
										</div>
										<div class="col-sm-7" id="lastNameHolder">
											<input type="text" name="lastName" id="username" tabindex="1" class="form-control" placeholder="Last Name*" value="" required>
										</div>
									</div>
									<div class="form-group row col-sm-12">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address*" value="" required>
									</div>
									<div class="form-group row col-sm-12">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Set A Password*" required>
									</div>
									<div class="form-group row col-sm-12">
										<div class="row">
											<div class="col-sm-12" id="btn-register-holder">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-block btn-register" value="GET STARTED">
											</div>
										</div>
									</div>
								</form>
								<form id="login-form" action="" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Email Address*" value="" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password*" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-12" id="btn-login-holder">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-block btn-login" value="Log In">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);

</script>

</html>