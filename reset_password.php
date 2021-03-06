<?php

	include "inc_db.php";

	if ($_REQUEST['action'] == 'resetPassword'){

		$newPassword = $_REQUEST['newpassword'];
		$encrypt = $_REQUEST['encrypt'];

        $query = "SELECT userId FROM tblUsers where md5(90*13+userId)='".$encrypt."'";

        mysql_select_db($db);
        $result = mysql_query($query, $conn);
        $firstResult = mysql_fetch_array($result, MYSQL_ASSOC);

        if(count($firstResult)>=1)
        {
 			$query = "update tblUsers set password='".md5($newPassword)."' where userId='".$firstResult['userId']."'";
        	mysql_query($query, $conn);
 			
        	$message = "Your password changed sucessfully <a href='index.php'>click here to login</a>.";
        }
        else
        {
            $message = "Invalid key please try again. <a href='reset_password.php?q=" . $encrypt . "'>Forget Password?</a>";
        }
        echo $message;
        exit();
	}

?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<head>
		<meta charset="utf-8">
		<title>SimpleVoIP Orders - Reset Password</title>
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
						<div class="form-block center-block p-30 light-gray-bg border-clear">
							
							<h2 class="title text-left">SimpleVoIP Reset Password</h2>
						
							<form action="reset_password.php" class="form-horizontal text-left" method=post id="resetpassword-form" data-toggle="validator">
								
								<div class="form-group has-feedback">
									<label for="newPassword" class="col-sm-4 control-label">New Password</label>
									<div class="form-group col-sm-8">
										<i class="fa fa-lock form-control-feedback"></i>
										<input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" style="margin-bottom: 20px" required>
									</div>

									<label for="confirmPassword" class="col-sm-4 control-label">Confirm Password</label>
									<div class="form-group col-sm-8">
										<i class="fa fa-lock form-control-feedback"></i>
										<input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
									</div>
								</div>
							
								<div class="form-group">
									<div class="col-sm-offset-4 col-sm-3">
										<button type="submit" class="btn btn-primary btn-default btn-animated">Reset Password <i class="fa fa-key"></i></button>
									</div>
								</div>


								<input type="hidden" name="encrypt" value="<?php echo $_REQUEST['q']; ?>">
								<input type="hidden" name="action" value="resetPassword">
							</form>
							
						</div>
						
					</div>
				</div>
			</div>
			<!-- banner end -->
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

<script type="text/javascript">
	
	$(document).ready(function() {
    	$('#resetpassword-form').bootstrapValidator({
    		fields: {
	            newpassword: {
	                validators: {
                        stringLength: {
                        	min: 6,
                        	message: 'Minimum of 6 characters'
                    	}
	                }
	            },
	            confirmpassword: {
		            validators: {
		                identical: {
		                    field: 'newpassword',
		                    message: 'The password and its confirm are not the same'
		                }
		            }
         		},
	        }
        });
	});

</script>