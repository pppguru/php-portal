<?php

	include "inc_db.php";

	$SiteNameURL = strtolower($_SERVER['HTTP_HOST']);

	if ($SiteNameURL == 'activation.simplevoip.us') {
			$url = "activation/index.php";
			Header("Location: $url");
			exit();	
	}

	$msg = $_REQUEST['msg'];


	function processAfterLogin($userId, $roleInfo){
		// server should keep session data for AT LEAST 1 week
		ini_set('session.gc_maxlifetime', 3600 * 24 * 7);
		// each client should remember their session id for 1 week
		session_set_cookie_params(3600 * 24 * 7);

		if ($roleInfo == 1) {
			// echo "<script>alert('admin');</script>";

    		session_start();
			$_SESSION['loggedin'] = 'YES';
			$_SESSION['user'] = 'admin';
			$_SESSION['userID'] = $userId;
			$_SESSION['roleInfo'] = $roleInfo;
			$url = "orders.php";

			Header("Location: $url");
			exit();
    	}
    	else if ($roleInfo == 2) {
    		// echo "<script>alert('cis');</script>";

    		session_start();
			$_SESSION['loggedin'] = 'YES';
			$_SESSION['user'] = 'cis';
			$_SESSION['userID'] = $userId;
			$_SESSION['roleInfo'] = $roleInfo;
			$url = "orders.php";

			Header("Location: $url");
			exit();
    	}
    	else if ($roleInfo == 3) {
    		// echo "<script>alert('customer');</script>";

    		session_start();
			$_SESSION['loggedin'] = 'YES';
			$_SESSION['user'] = 'customer';
			$_SESSION['userID'] = $userId;
			$_SESSION['roleInfo'] = $roleInfo;
			$url = "orders.php";

			Header("Location: $url");
			exit();
    	}
    	else
    		$msg = "Incorrect password. Please try again.";
	}

	if ($_REQUEST['action'] == 'logout')  // --------------------- Logout ------------------------- //
	{

		unset($_SESSION['loggedin']);
		session_start();
		session_unset();
	    session_destroy();
	}
	else if ($_REQUEST['action'] == 'login')  // --------------------- Login ------------------------- //
	{
		$emailAddr = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$query = "SELECT tblUsers.userId as userId, tblUsers.email as email, tblUserRoles.userRoleId as role FROM tblUsers, tblUserRoles where tblUsers.userTypeId = tblUserRoles.userRoleId AND tblUsers.email='{$emailAddr}' AND tblUsers.password=md5('{$password}')";

		mysql_select_db($db);
        $result = mysql_query($query, $conn);
        $firstResult = mysql_fetch_array($result, MYSQL_ASSOC);
 
        if($firstResult) {
        	$role = $firstResult["role"];
        	$userId = $firstResult["userId"];
        	processAfterLogin($userId, $role);
        }
        else
        	$msg = "Incorrect password. Please try again.";
	}
	else if ($_REQUEST['action'] == 'forgetPassword') {   // --------------------- Forget Password Handler ------------------------- //
		$emailAddr = $_REQUEST['email'];
		$query = "SELECT userId FROM tblUsers where email='" . $emailAddr . "'";

		mysql_select_db($db);
        $result = mysql_query($query, $conn);
        
        if($firstResult = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$hostName = WEB_HOST;
			$encrypt = md5(90*13+$firstResult['userId']);

			$pwrurl = "http://" . WEB_HOST. "/reset_password.php?q=" . $encrypt;
			
			$subject = "Reset Password";
			$msgBody = "Dear SimpleVoIP user:\n\nTo reset your password - please visit \n{$pwrurl}\n\nThanks,\nThe Management";
			// $msg = wordwrap($msg,70);
			
			$headers = 'From: noreply@simplevoip.us' . "\r\n" .
			'Reply-To: noreply@simplevoip.us' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
			
			$mailto = $emailAddr;
			$mail1 = mail($mailto, $subject, $msgBody, $headers);
			
			echo "<div class='alert alert-success cm'><strong>Success!</strong> We sent you the email to reset the password.</div>";
		}
		else {
			echo "<div class='alert alert-danger cm'><strong>Failed!</strong> Account not found please signup now!!</div>";
		}
	}
?>




<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<title>SimpleVoIP Orders - Login</title>
		<meta name="description" content="Login">


		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
		<link rel="shortcut icon" href="images/favicon.ico">

		<!-- Web Fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Raleway:700,400,300' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

		<!-- Bootstrap core CSS -->
		<link href="bootstrap/css/bootstrap.css" rel="stylesheet">

		<!-- Font Awesome CSS -->
		<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

		<!-- Fontello CSS -->
		<link href="fonts/fontello/css/fontello.css" rel="stylesheet">

		<!-- Plugins -->
		<link href="plugins/magnific-popup/magnific-popup.css" rel="stylesheet">
		<link href="css/animations.css" rel="stylesheet">
		<link href="plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
		<link href="plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
		<link href="plugins/hover/hover-min.css" rel="stylesheet">		
		
		<link href="plugins/jquery.countdown/jquery.countdown.css" rel="stylesheet">
		<!-- the project core CSS file -->
		<link href="css/style.css" rel="stylesheet" >

		<!-- Color Scheme (In order to change the color scheme, replace the blue.css with the color scheme that you prefer)-->
		<link href="css/skins/light_blue.css" rel="stylesheet">

		<!-- Custom css --> 
		<link href="css/custom.css" rel="stylesheet">
	</head>

	<!-- body classes:  -->
	<!-- "boxed": boxed layout mode e.g. <body class="boxed"> -->
	<!-- "pattern-1 ... pattern-9": background patterns for boxed layout mode e.g. <body class="boxed pattern-1"> -->
	<!-- "transparent-header": makes the header transparent and pulls the banner to top -->
	<!-- "page-loader-1 ... page-loader-6": add a page loader to the page (more info @components-page-loaders.html) -->
	<body class="no-trans   ">

		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop circle"><i class="icon-up-open-big"></i></div>
		
		<!-- page wrapper start -->
		<!-- ================ -->
		<div class="page-wrapper">
		
			<!-- background image -->
			<div class="fullscreen-bg"></div>

			<!-- banner start -->
			<!-- ================ -->
			<div class="pv-40 light-translucent-bg">
				<div class="container">
					<div class="object-non-visible text-center" data-animation-effect="fadeInDownSmall" data-effect-delay="100">
						<strong><?php echo $msg; ?></strong>
						<div class="form-block center-block p-30 light-gray-bg border-clear">
							
							<h2 class="title text-left">SimpleVoIP Login</h2>
						
							<form action="index.php" class="form-horizontal text-left" method=post>
								
								<div class="form-group has-feedback">
									<label for="email" class="col-sm-3 control-label">Email</label>
									<div class="col-sm-8" style="margin-bottom: 20px">
										<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
										<i class="fa fa-envelope form-control-feedback"></i>
									</div>

									<label for="password" class="col-sm-3 control-label">Password</label>
									<div class="col-sm-8">
										<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
										<i class="fa fa-lock form-control-feedback"></i>
									</div>
								</div>
							
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-3">
										<button type="submit" class="btn btn-group btn-default btn-animated">Log In <i class="fa fa-user"></i></button>
									</div>
								</div>

								<div class="col-sm-offset-3 etc-login-form col-sm-6">
									<p>Forgot your password? <a href="#" data-target="#pwdModal" data-toggle="modal">Click here</a></p>
								</div>

								<input type="hidden" name="action" value="login">
							</form>
							
						</div>
						
					</div>
				</div>
			</div>
			<!-- banner end -->

			<!--Forget Password Modal-->
			<div id="pwdModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog">
			  <div class="modal-content">
			      <div class="modal-header" style=" background-color: white;">
			          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			          <h1 class="text-center" style="text-transform: none;">What's My Password?</h1>
			      </div>
			      <div class="modal-body">
			          <div class="col-md-12">
			                <div class="panel panel-default">
			                    <div class="panel-body">
			                        <div class="text-center">
			                          
			                          <p style="margin-bottom: 0px">If you have forgotten your password you can reset it here.</p>
			                            <div class="panel-body">
			                                <fieldset style="background-color: white">
			                                	<form action="index.php" class="form-horizontal text-left" method=post>
				                                    <div class="form-group">
				                                    	<input type="email" class="form-control input-lg" id="email" name="email" placeholder="E-mail Address" required>
				                                    </div>
				                                    <input class="btn btn-lg btn-primary btn-block" value="Reset password" type="submit">

				                                    <input type="hidden" name="action" value="forgetPassword"/>
			                                    </form>
			                                </fieldset>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			      </div>
			      <div class="modal-footer" style="border-top: 0px;">
			          <div class="col-md-12">
			          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
					  </div>	
			      </div>
			  </div>
			  </div>
			</div>

			
		</div>
		<!-- page-wrapper end -->

		<!-- JavaScript files placed at the end of the document so the pages load faster -->
		<!-- ================================================== -->
		<!-- Jquery and Bootstap core js files -->
		<script type="text/javascript" src="plugins/jquery.min.js"></script>
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

		<!-- Modernizr javascript -->
		<script type="text/javascript" src="plugins/modernizr.js"></script>

		<!-- Magnific Popup javascript -->
		<script type="text/javascript" src="plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		
		<!-- Appear javascript -->
		<script type="text/javascript" src="plugins/waypoints/jquery.waypoints.min.js"></script>

		<!-- Count To javascript -->
		<script type="text/javascript" src="plugins/jquery.countTo.js"></script>
		
		<!-- Parallax javascript -->
		<script src="plugins/jquery.parallax-1.1.3.js"></script>

		<!-- Contact form -->
		<script src="plugins/jquery.validate.js"></script>

		<!-- Owl carousel javascript -->
		<script type="text/javascript" src="plugins/owl-carousel/owl.carousel.js"></script>
		
		<!-- SmoothScroll javascript -->
		<script type="text/javascript" src="plugins/jquery.browser.js"></script>
		<script type="text/javascript" src="plugins/SmoothScroll.js"></script>

		<!-- Count Down javascript -->
		<script type="text/javascript" src="plugins/jquery.countdown/jquery.plugin.js"></script>
		<script type="text/javascript" src="plugins/jquery.countdown/jquery.countdown.js"></script>
		<script type="text/javascript" src="js/coming.soon.config.js"></script>

		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="js/template.js"></script>

		<!-- Custom Scripts -->
		<script type="text/javascript" src="js/custom.js"></script>

		<!-- Form Validation -->
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
	</body>
</html>
