<?php include 'inc_header.php';


if ($_REQUEST['action'] == 'createTemplate') // Adding a template
{
    $now = date("Y-m-d");
    $sql = "INSERT INTO apTemplates (type, templateName, phoneModelID, lastUpdated, config, accountId, isDefault) VALUES ('CUSTOMER', '{$_REQUEST['templateName']}', {$_REQUEST['phoneModel']}, '$now', '{$_REQUEST['configText']}', '{$_REQUEST['customerAccountID']}', {$_REQUEST['isDefaultOption']})";

    mysql_select_db($db);
    $retval = mysql_query( $sql, $conn );
    if(! $retval )
    {
        die('Could not add template: ' . mysql_error());
    }

    //Update the other records
    if ($_REQUEST['isDefaultOption'] == 1 && $_REQUEST['customerAccountID'] != '0'){
        $myTemplateID = mysql_insert_id();

        $sql = "UPDATE apTemplates SET isDefault=0 WHERE accountId='{$_REQUEST['customerAccountID']}' AND templateID!={$myTemplateID}";

        mysql_select_db($db);
        $retval = mysql_query( $sql, $conn );
    }

    //Go Back to customer manage page

    $url = "customerManage.php";
    Header("Location: $url");
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
    <title>SimpleVoIP - Add Template</title>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">


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

    <!-- banner start -->
    <!-- ================ -->
    <div class="pv-40 light-translucent-bg">
        <div class="container">
            <div class="object-non-visible text-center" data-animation-effect="fadeInDownSmall" data-effect-delay="100">

                <div class="form-block center-block p-30 light-gray-bg border-clear">

                    <h2 class="title text-left">Add Template</h2>
                    <form action="newTemplateAdd.php" class="form-horizontal text-left" method="post">

                        <div class="form-group has-feedback">
                            <label for="customerID" class="col-sm-3 control-label">Customer</label>
                            <div class="col-sm-8">
                                <select name="customerAccountID" id="customerAccountID" required>
                                    <option value='0'>--Please Select--</option>
                                    <?php
                                    $sql = "SELECT * FROM tblCustomers ORDER BY customer";
                                    mysql_select_db($db);
                                    $retval = mysql_query( $sql, $conn );
                                    while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
                                        ?>


                                        <option value='<?php echo $row['kazooAccountID'] ?>'><?php echo $row['customer'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="phoneModel" class="col-sm-3 control-label">Phone Model</label>

                            <div class="col-sm-8">
                                <select name="phoneModel" id="phoneModel" required>
                                    <?php
                                    $sql = "SELECT * FROM apPhoneModels ORDER BY phoneModel";
                                    mysql_select_db($db);
                                    $retval = mysql_query( $sql, $conn );
                                    while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
                                        ?>


                                        <option value='<?php echo $row['phoneModelID'] ?>'><?php echo $row['phoneModel'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="templateName" class="col-sm-3 control-label">Template Name</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="templateName" name="templateName" required>

                            </div>
                        </div>


                        <div class="form-group has-feedback">
                            <label for="configText" class="col-sm-3 control-label">Config</label>
                            <div class="col-sm-8">
                                <textarea  class="form-control" id="configText" name="configText" rows=5 required></textarea>
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="isDefaultOption" class="col-sm-3 control-label">isDefault</label>
                            <div class="col-sm-8">
                                <select name=isDefaultOption id=isDefaultOption >
                                    <option value='1'>YES</option>
                                    <option value='0'>NO</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-8">

                                <button type="submit" class="btn btn-group btn-default btn-animated">Create Template <i class="fa fa-book"></i></button>
                                <a href="customerManage.php"  class="btn btn-group btn-warning btn-animated">Cancel <i class="fa fa-remove"></i></a>
                                <input type="hidden" name="action" value="createTemplate">

                            </div>
                        </div>
                    </form>

                </div>


            </div>
        </div>
    </div>
    <!-- banner end -->



</div>

<!-- JavaScript files placed at the end of the document so the pages load faster -->
<!-- ================================================== -->
<script>
    function add_location() {

        customerID = document.getElementById('customerID').value;

        if (!customerID) {
            alert("Please select a customer first!");
            return;
        }
        thediv = '#addbutton';
        siteNumber = document.getElementById('siteNumber').value;
        streetnumber = document.getElementById('streetnumber').value;
        street = document.getElementById('street').value;
        suite = document.getElementById('suite').value;
        city = document.getElementById('city').value;
        state = document.getElementById('state').value;
        zip = document.getElementById('zip').value;
        email = document.getElementById('email').value;

        $(thediv).html('Working... <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');

        $.ajax({
            type: "GET",
            url: "ajax_functions.php?fn=new-location&email="+email+"&customerID="+customerID+"&siteNumber="+siteNumber+"&streetnumber="+streetnumber+"&street="+street+"&suite="+suite+"&city="+city+"&state="+state+"&zip="+zip,

            success: function(data){


                $(thediv).html(data);

                get_locations();

            }
        });

    }
    function get_locations() {
        thediv = '#locationDiv';


        $(thediv).html('Working... <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');

        $.ajax({
            type: "GET",
            url: "ajax_functions.php?fn=get-locations&customerID="+document.getElementById('customerID').value,

            success: function(data){


                $(thediv).html(data);

                //Add default value
                var locationSeletor = document.getElementById("locationID");
                var option = document.createElement("option");
                option.text = "CUSTOMER CONTACT";
                option.value = 0;
                option.selected = true;
                locationSeletor.add(option, 0);
            }
        });

    }
</script>
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
</body>
</html>
