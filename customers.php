<?php include 'inc_header.php';
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title>SimpleVoIP Manage Customers</title>

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

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

    <!-- breadcrumb start -->
    <!-- ================ -->
    <div class="breadcrumb-container">
        <div class="container">
            <ol class="breadcrumb">
                <li><img src="images/SimpleVolP125px.jpg"></li>
                <li><i class="fa fa-phone pr-10"></i><a href="orders.php">Orders</a></li>
                <li><i class="fa fa-book fa-1 pr-10"></i><a href="customers.php">Customers</a></li>
                <?php
                if($_SESSION['user'] == 'admin'){
                    echo "<li><i class='fa fa-users pr-10'></i><a href='manageUsers.php'>Admin Panel</a></li>";
                }
                ?>
                <li><i class="fa fa-user pr-10"></i><a href="changePassword.php">Profile</a></li>
                <li><i class="fa fa-sign-out pr-10"></i><a href="index.php?action=logout">Logout</a></li>
            </ol>
        </div>
    </div>
    <!-- breadcrumb end -->

    <!-- main-container start -->
    <!-- ================ -->
    <section class="main-container padding-bottom-clear">
        <div class="container-fluid">
            <!-- main start -->
            <!-- ================ -->
            <div class="main">
                <h1>SimpleVoIP Manage Customers</h1>
                <!-- page-title start -->
                <!-- ================ -->
<!--                <a href='customerAdd.php'  type="button" class="btn btn-group btn-sm btn-success btn-animated">Add New Customer <i class="fa fa-phone"></i></a>-->

                <p><?php echo $_SESSION['msg']; $_SESSION['msg']=''; ?></p>
                <div class="separator-2"></div>
                <!-- page-title end -->


            </div>
            <!-- main end -->
        </div>
    </section>
    <!-- main-container end -->


    <!--Add New Member Modal-->
    <div id="signUpModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style=" background-color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h1 class="text-center" style="text-transform: none;">Add New Member</h1>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="text-center">

                                    <p style="margin-bottom: 0px">Do you want to add the new account?</p>

                                    <div class="panel-body">
                                        <fieldset style="background-color: white">
                                            <form action="manageUsers.php" class="form-horizontal text-left" method=post id='register-form'>
                                                <div class="form-group  has-feedback">
                                                    <div class="col-sm-12">
                                                        <i class="fa fa-envelope form-control-feedback"></i>
                                                        <input type="email" class="form-control input-lg" id="email" name="email" placeholder="E-mail Address" required required style="margin-bottom: 20px"/>

                                                    </div>

                                                    <div class="col-sm-12">
                                                        <i class="fa fa-lock form-control-feedback"></i>
                                                        <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Password" required required style="margin-bottom: 20px"/>

                                                    </div>

                                                    <div class="selectContainer col-sm-12">
                                                        <select class="form-control" name="userLevel">
                                                            <option value="">Choose a user level</option>
                                                            <option value="2">CIS</option>
                                                            <option value="3">CUSTOMER</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input class="btn btn-lg btn-primary btn-block" value="Register" type="submit">

                                                <input type="hidden" name="action" value="addMember">
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





    <!-- section start -->
    <!-- ================ -->
    <section>
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">
                    <?php

                    $sql = "SELECT * FROM tblCustomers;";  //Fetch all customers

                    mysql_select_db($db);
                    $retval = mysql_query( $sql, $conn );

                    if(! $retval )
                    {
                        die('Could not get data: ' . mysql_error());
                    }


                    ?>
                    <h2>Customers</h2>

                    <table class="table table-hover">
                        <thead>
                        <tr>

                            <th>Customer ID</th>
                            <th>Customer</th>
                            <th>Author Name</th>
                            <th>Customer Code</th>
                            <th>Monitored?</th>
                            <th>CIS Customer</th>
                            <th>Actions</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $numNo = 0;
                        while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
                        {
                            $numNo ++;
                            ?>
                            <tr>
                                <td nowrap><?php echo $row['customerID'];?></td>
                                <td nowrap><?php echo $row['customer'];?></td>
                                <td nowrap><?php echo $row['authname'];?></td>
                                <td nowrap><?php echo $row['customercode'];?></td>
                                <td nowrap><?php echo (isset($row['monitored'])) ? 'YES' : 'NO';?></td>
                                <td nowrap><?php echo (isset($row['cisCustomer'])) ? $row['cisCustomer'] : '';?></td>
                                <td nowrap>
                                    <div id="actions">
                                        <form action="customerManage.php" method=post style="margin: 0px 0;">
                                            <button class="btn btn-group btn-sm btn-success">Select</button>
                                            <input type="hidden" name="customerID" value="<?php echo $row['customerID']; ?>">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>


                </div> <!-- end column-->

            </div>	<!--end row-->

        </div><!--end container-->


    </section>
    <!-- section end -->

</div>
<!-- page-wrapper end -->

<!-- JavaScript files placed at the end of the document so the pages load faster -->
<!-- ================================================== -->
<!-- Jquery and Bootstap core js files -->
<script type="text/javascript" src="plugins/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

<!-- Modernizr javascript -->
<script type="text/javascript" src="plugins/modernizr.js"></script>

<!-- Isotope javascript -->
<script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>

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

<!-- Initialization of Plugins -->
<script type="text/javascript" src="js/template.js"></script>

<!-- Custom Scripts -->
<script type="text/javascript" src="js/custom.js"></script>

<!-- Form Validation -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>
</body>

<script type="text/javascript">

    $(document).ready(function() {
        $('#register-form').bootstrapValidator({
            fields: {
                email: {
                    validators: {
                        emailAddress: {
                            message: 'Please input a valid email address'
                        }
                    }
                },
                password: {
                    validators: {
                        stringLength: {
                            min: 6,
                            message: 'Minimum of 6 characters'
                        }
                    }
                },
                userLevel: {
                    validators: {
                        notEmpty: {
                            message: 'Please select your level'
                        }
                    }
                }
            }
        });
    });

</script>
</html>
