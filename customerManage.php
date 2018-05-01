<?php include 'inc_header.php';

	if ($_REQUEST['action'] == 'removeContact') {   //---------- Remove Contact -------------//

		$contactID 	= $_REQUEST['contactID'];

		$query = "DELETE FROM tblContacts where id = '{$contactID}'";

		mysql_select_db($db);
        $result = mysql_query($query, $conn);
        
        if($result) {
        	echo "<div class='alert alert-success cm'><strong>Success!</strong> Successfully removed the contact.</div>";
        	
		}
		else {
			echo "<div class='alert alert-danger cm'><strong>Failed!</strong> Failed to remove the contact.</div>";
		}
	}
    else if ($_REQUEST['action'] == 'removeTemplate') {   //---------- Remove Template -------------//

        $templateID = $_REQUEST['templateID'];

        $query = "DELETE FROM apTemplates where templateID = '{$templateID}'";

        mysql_select_db($db);
        $result = mysql_query($query, $conn);

        if($result) {
            echo "<div class='alert alert-success cm'><strong>Success!</strong> Successfully removed the template.</div>";

        }
        else {
            echo "<div class='alert alert-danger cm'><strong>Failed!</strong> Failed to remove the template.</div>";
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
		<title>SimpleVoIP Manage Contacts</title>
	
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
						<h1>SimpleVoIP Manage Contacts</h1>
						<!-- page-title start -->
						<!-- ================ -->


                        <form action="customerManage.php">
                            <?php
                                $searchKey = $_REQUEST['searchKey'];
                                $customerID = $_REQUEST['customerID'];

                                if ($_REQUEST['submit'] == 'reset') {
                                    $searchKey = "";
                                    $customerID = "";
                                }
                            ?>

                            Search Key: <input type=text id=searchKey name=searchKey value="<?php echo $searchKey?>" >

                            <select name=customerID id=customerID >
                                <option value=''>--Please Select--</option>
                                <?php
                                $sql = "SELECT * FROM tblCustomers ORDER BY customer";
                                mysql_select_db($db);
                                $retval = mysql_query( $sql, $conn );
                                while($row2 = mysql_fetch_array($retval, MYSQL_ASSOC)) {
                                    ?>
                                    <option value='<?php echo $row2['customerID'] ?>' <?php if ($row2['customerID'] == $_REQUEST['customerID'] && $_REQUEST['submit'] != 'reset')  echo " selected" ?>><?php echo $row2['customer'] ?></option>
                                <?php } ?>

                            </select>
                            <input type=submit value="Filter"> <input type=submit value="reset" name='submit'>
                        </form>

<!--						<div class="separator-2"></div>-->
						<!-- page-title end -->
						

					</div>
					<!-- main end -->
				</div>
			</section>
			<!-- main-container end -->



            <section>
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12">
                            <!-- tabs start -->
                            <!-- ================ -->
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs style-1" role="tablist">
                                <li class='active'><a href="#htab1" role="tab" data-toggle="tab"><i class="fa fa-users pr-10"></i>Contacts</a></li>
                                <li><a href="#htab2" role="tab" data-toggle="tab"><i class="fa fa-map-marker pr-10"></i>Locations</a></li>
                                <?php
                                if($_SESSION['user'] == 'admin'){
                                    echo "<li><a href=\"#htab3\" role=\"tab\" data-toggle=\"tab\"><i class=\"fa fa-cogs pr-10\"></i>Configs</a></li>";
                                }
                                ?>


                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="htab1">
                                    <!-- section start -->
                                    <!-- ================ -->

                                    <?php

                                    $s = "";
                                    if ($_REQUEST['submit'] != 'reset') {
                                        if ($searchKey) {
                                            $s = " WHERE (tblContacts.phone1 LIKE '%{$searchKey}%' OR tblContacts.phone2 LIKE '%{$searchKey}%' OR tblContacts.firstname LIKE '%{$searchKey}%'  OR tblContacts.lastname LIKE '%{$searchKey}%')";

                                            if ($customerID){
                                                $s = $s . " AND tblContacts.customerID='{$customerID}' ";
                                            }
                                        }
                                        else if ($customerID){
                                            $s = " WHERE tblContacts.customerID='{$customerID}' ";
                                        }
                                    }

                                    ?>

                                    <span>
                                        <h2 style ="display : inline-block; margin-right: 30px">Contacts</h2>
                                        <a href='newCustomerAdd.php'  type="button" class="btn btn-group btn-sm btn-success btn-animated">Add New Contact <i class="fa fa-phone"></i></a>
                                    </span>
			
                                    <!-- section start -->
                                    <!-- ================ -->
                                    <section>
                                        <div class="container-fluid">

                                        <div class="row">
                                                <div class="col-md-12">
                                                <?php


                                                    //Fetch all contacts
                                                    $sql = "SELECT tblContacts.*, tblCustomers.customer, tblCustomerLocations.street, tblCustomerLocations.siteNumber, tblCustomerLocations.state, tblCustomerLocations.city FROM tblContacts LEFT JOIN tblCustomers ON tblContacts.customerID = tblCustomers.customerID LEFT JOIN tblCustomerLocations ON tblContacts.locationID = tblCustomerLocations.locationID" . $s;


                                                    mysql_select_db($db);
                                                    $retval = mysql_query( $sql, $conn );

                                                    if(! $retval )
                                                    {
                                                      die('Could not get data: ' . mysql_error());
                                                    }


                                                ?>


                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Customer</th>
                                                            <th>Location</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Email</th>
                                                            <th>Phone1</th>
                                                            <th>Phone2</th>
                                                            <th>Contact Type</th>
                                                            <th>Contact Note</th>
                                                            <th>Notify?</th>
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
                                                        <td nowrap><?php echo $numNo?></td>
                                                        <td nowrap><?php echo $row['customer'];?></td>
                                                        <td nowrap><?php echo $row['siteNumber'] ."-". $row['state'] . "-" . $row['city'] . "-" . $row['street'];?></td>
                                                        <td nowrap><?php echo $row['firstname'];?></td>
                                                        <td nowrap><?php echo $row['lastname'];?></td>
                                                        <td nowrap><?php echo $row['email'];?></td>
                                                        <td nowrap><?php echo $row['phone1'];?></td>
                                                        <td nowrap><?php echo $row['phone2'];?></td>
                                                        <td nowrap><?php echo $row['contactType'];?></td>
                                                        <td nowrap><?php echo $row['contactLabel'];?></td>
                                                        <td nowrap><?php echo ($row['notify'] == '1') ? 'YES' : 'NO';?></td>
                            <!--							<td nowrap>--><?php //echo (isset($row['cisCustomer'])) ? $row['cisCustomer'] : '';?><!--</td>-->

                                                        <td nowrap>
                                                            <div id="actions">
                                                                <form action="contactDetail.php" method=post style="margin: 0px 0;">
                                                                    <button class="btn btn-group btn-sm btn-success">Edit</button>
                                                                    <input type="hidden" name="action" value="editContact">
                                                                    <input type="hidden" name="contactID" value="<?php echo $row['id']; ?>">
                                                                </form>
                                                            </div>
                                                        </td>
                                                        <td nowrap>
                                                            <div id="actions">
                                                                <form action="customerManage.php" method=post style="margin: 0px 0;">
                                                                    <button class="btn btn-group btn-sm btn-danger">Delete</button>
                                                                    <input type="hidden" name="action" value="removeContact">
                                                                    <input type="hidden" name="contactID" value="<?php echo $row['id']; ?>">
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


                                <div class="tab-pane fade" id="htab2">
                                    <!-- section start -->
                                    <!-- ================ -->

                                    <?php

                                    $s = "";
                                    if ($_REQUEST['submit'] != 'reset') {
                                        if ($searchKey) {
                                            $s = " AND (tblCustomerLocations.streetNumber LIKE '%{$searchKey}%' OR tblCustomerLocations.street LIKE '%{$searchKey}%' OR tblCustomerLocations.suite LIKE '%{$searchKey}%' OR tblCustomerLocations.city LIKE '%{$searchKey}%' OR tblCustomerLocations.state LIKE '%{$searchKey}%' OR tblCustomerLocations.zip LIKE '%{$searchKey}%' OR tblCustomerLocations.siteNumber LIKE '%{$searchKey}%' OR tblCustomerLocations.name LIKE '%{$searchKey}%' OR tblCustomerLocations.email LIKE '%{$searchKey}%')";
                                        }

                                        if ($customerID){
                                            $s = $s . " AND tblCustomerLocations.customerID='{$customerID}'";
                                        }
                                    }


                                    ?>

                                    <!-- section start -->
                                    <!-- ================ -->
                                    <section>
                                        <div class="container-fluid">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php


                                                    //Fetch all contacts
                                                    $sqlForLocation = "SELECT tblCustomerLocations.*, tblCustomers.customer FROM tblCustomerLocations, tblCustomers WHERE tblCustomerLocations.customerID = tblCustomers.customerID" . $s;

                                                    mysql_select_db($db);
                                                    $retvalForLocation = mysql_query( $sqlForLocation, $conn );

                                                    if(! $retvalForLocation )
                                                    {
                                                        die('Could not get data: ' . mysql_error());
                                                    }


                                                    ?>
                                                    <h2>Locations</h2>

                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Street Number</th>
                                                            <th>Address</th>
                                                            <th>Zip</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php
                                                        $numLocationonNo = 0;
                                                        while($rowLocation = mysql_fetch_array($retvalForLocation, MYSQL_ASSOC))
                                                        {
                                                            $numLocationonNo ++;
                                                            ?>
                                                            <tr>
                                                                <td nowrap><?php echo $rowLocation['siteNumber'];?></td>
                                                                <td nowrap><?php echo $rowLocation['suite'] . "-" . $rowLocation['state'] . "-" . $rowLocation['city'] . "-" . $rowLocation['street'];?></td>
                                                                <td nowrap><?php echo $rowLocation['zip'];?></td>
                                                                <td nowrap><?php echo $rowLocation['name'];?></td>
                                                                <td nowrap><?php echo $rowLocation['email'];?></td>

                                                                <td nowrap>
                                                                    <div id="actions">
                                                                        <a class='btn btn-sm  btn-success btn-animated open-AddBookDialog' data-toggle='modal' data-target='#addressModal'
                                                                           data-location-id="<?php echo $rowLocation['locationID']; ?>"
                                                                           data-site-number="<?php echo $rowLocation['siteNumber']; ?>"
                                                                           data-street-number="<?php echo $rowLocation['streetNumber']; ?>"
                                                                           data-street-value="<?php echo $rowLocation['street']; ?>"
                                                                           data-suite-value="<?php echo $rowLocation['suite']; ?>"
                                                                           data-city-value="<?php echo $rowLocation['city']; ?>"
                                                                           data-state-value="<?php echo $rowLocation['state']; ?>"
                                                                           data-zip-value="<?php echo $rowLocation['zip']; ?>"
                                                                           data-email-value="<?php echo $rowLocation['email']; ?>">
                                                                            Edit Location <i class="fa fa-map-marker"></i></a>
<!--                                                                        <form action="locationEdit.php" method=post style="margin: 0px 0;">-->
<!--                                                                            <button class="btn btn-group btn-sm btn-success">Edit</button>-->
<!--                                                                            <input type="hidden" name="action" value="editLocation">-->
<!--                                                                            <input type="hidden" name="locationID" value="--><?php //echo $rowLocation['locationID']; ?><!--">-->
<!--                                                                        </form>-->
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



                                <div class="tab-pane fade" id="htab3">
                                    <!-- section start -->
                                    <!-- ================ -->

                                    <?php

                                    $s = "";
                                    $whereCustomers = "";
                                    if ($_REQUEST['submit'] != 'reset') {
                                        if ($searchKey) {
                                            $s = " AND apTemplates.templateName LIKE '%{$searchKey}%'";
                                        }

                                        if ($customerID){
                                            $s = $s . " AND apTemplates.accountId = tblCustomers.kazooAccountID AND tblCustomers.customerID='{$customerID}'";
                                            $whereCustomers = ", tblCustomers ";
                                        }
                                    }

                                    ?>

                                    <!-- section start -->
                                    <!-- ================ -->
                                    <section>
                                        <div class="container-fluid">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php


                                                    //Fetch all contacts
                                                    $sqlForConfig = "SELECT apTemplates.*, apPhoneModels.phoneModel FROM apTemplates, apPhoneModels " . $whereCustomers . " WHERE apPhoneModels.phoneModelID = apTemplates.phoneModelID AND apTemplates.type = 'CUSTOMER'" . $s;


                                                    mysql_select_db($db);
                                                    $retvalForConfig = mysql_query( $sqlForConfig, $conn );

                                                    if(! $retvalForConfig )
                                                    {
                                                        die('Could not get data: ' . mysql_error());
                                                    }


                                                    ?>

                                                    <span>
                                                        <h2 style ="display : inline-block; margin-right: 30px">Templates</h2>
                                                        <a href='newTemplateAdd.php'  type="button" class="btn btn-group btn-sm btn-success btn-animated">Add New Template <i class="fa fa-phone"></i></a>
                                                    </span>

                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Template ID</th>
                                                            <th>Template Name</th>
                                                            <th>Phone Model</th>
                                                            <th>Last Updated</th>
                                                            <th>Is Default?</th>
                                                            <th>Config</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php
                                                        $numConfigNo = 0;
                                                        while($rowConfig = mysql_fetch_array($retvalForConfig, MYSQL_ASSOC))
                                                        {
                                                            $numConfigNo ++;
                                                            ?>
                                                            <tr>
                                                                <td nowrap><?php echo $rowConfig['templateID'];?></td>
                                                                <td nowrap><?php echo $rowConfig['templateName'];?></td>
                                                                <td nowrap><?php echo $rowConfig['phoneModel'];?></td>
                                                                <td nowrap><?php echo $rowConfig['lastUpdated'];?></td>
                                                                <td nowrap><?php echo $rowConfig['isDefault'] == '1' ? 'YES' : 'NO' ?></td>
                                                                <td aria-multiline="true"><?php echo $rowConfig['config'];?></td>


                                                                <td nowrap>
                                                                    <div id="actions" style="display: inline-block;">
                                                                        <a class='btn btn-sm  btn-success btn-animated open-editTemplate' data-toggle='modal' data-target='#templateModal'
                                                                           data-template-id="<?php echo $rowConfig['templateID']; ?>"
                                                                           data-template-name="<?php echo $rowConfig['templateName']; ?>"
                                                                           data-config-value="<?php echo $rowConfig['config']; ?>"
                                                                           data-account-id="<?php echo $rowConfig['accountId']; ?>"
                                                                           data-isdefault-value="<?php echo $rowConfig['isDefault']; ?>">Edit
                                                                        </a>
                                                                    </div>

                                                                    <form action="customerManage.php" method=post style="margin: 0px 0; display: inline-block">
                                                                        <button class="btn btn-group btn-sm btn-danger">Delete</button>
                                                                        <input type="hidden" name="action" value="removeTemplate">
                                                                        <input type="hidden" name="templateID" value="<?php echo $rowConfig['templateID']; ?>">
                                                                    </form>

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

                            </div>
                        </div>
                    </div>
                </div>
            </section>
			
		</div>
		<!-- page-wrapper end -->


        <!-- Modal for location edit-->

        <!-- page-wrapper end -->
        <div class="modal fade" id="addressModal"  tabindex="-1" role="dialog" aria-labelledby="addressModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="addressModalLabel">Edit Location</h4>
                    </div>

                    <div class="modal-body" id="addressBody">

                        <form class="form-horizontal text-left">
                            <div class="form-group has-feedback">
                                <label for="siteNumber" class="col-sm-3 control-label">Site Number</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="siteNumber" name="siteNumber" required >

                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="streetnumber" class="col-sm-3 control-label">Street Number</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="streetnumber" name="streetnumber" required >

                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="street" class="col-sm-3 control-label">Street</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="street" name="street" required >

                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="suite" class="col-sm-3 control-label">Suite</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="suite" name="suite"  >

                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="city" class="col-sm-3 control-label">City</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="city" name="city" required >

                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="state" class="col-sm-3 control-label">State</label>
                                <div class="col-sm-8">

                                    <select name="state" id=state>


                                        <option value="AL">AL</option>
                                        <option value="AK">AK</option>
                                        <option value="AZ">AZ</option>
                                        <option value="AR">AR</option>
                                        <option value="CA">CA</option>
                                        <option value="CO">CO</option>
                                        <option value="CT">CT</option>
                                        <option value="DE">DE</option>
                                        <option value="DC">DC</option>
                                        <option value="FL">FL</option>
                                        <option value="GA">GA</option>
                                        <option value="HI">HI</option>
                                        <option value="ID">ID</option>
                                        <option value="IL">IL</option>
                                        <option value="IN">IN</option>
                                        <option value="IA">IA</option>
                                        <option value="KS">KS</option>
                                        <option value="KY">KY</option>
                                        <option value="LA">LA</option>
                                        <option value="ME">ME</option>
                                        <option value="MD">MD</option>
                                        <option value="MA">MA</option>
                                        <option value="MI">MI</option>
                                        <option value="MN">MN</option>
                                        <option value="MS">MS</option>
                                        <option value="MO">MO</option>
                                        <option value="MT">MT</option>
                                        <option value="NE">NE</option>
                                        <option value="NV">NV</option>
                                        <option value="NH">NH</option>
                                        <option value="NJ">NJ</option>
                                        <option value="NM">NM</option>
                                        <option value="NY">NY</option>
                                        <option value="NC">NC</option>
                                        <option value="ND">ND</option>
                                        <option value="OH">OH</option>
                                        <option value="OK">OK</option>
                                        <option value="OR">OR</option>
                                        <option value="PA">PA</option>
                                        <option value="RI">RI</option>
                                        <option value="SC">SC</option>
                                        <option value="SD">SD</option>
                                        <option value="TN">TN</option>
                                        <option value="TX">TX</option>
                                        <option value="UT">UT</option>
                                        <option value="VT">VT</option>
                                        <option value="VA">VA</option>
                                        <option value="WA">WA</option>
                                        <option value="WV">WV</option>
                                        <option value="WI">WI</option>
                                        <option value="WY">WY</option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="zip" class="col-sm-3 control-label">Zip</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="zip" name="zip" required >

                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="email" class="col-sm-3 control-label">Site Email</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="email" name="email" required >

                                </div>
                            </div>

                            <input type="hidden" id="locationID" name="locationID"/>
                        </form>

                    </div>

                    <div class="modal-footer">
                        <div id=addbutton>
                            <button type=button onclick='javascript:update_location()'  class="btn radius-50 btn-success btn-sm ">Save Location</button>
                        </div>

                        <button type=button class='btn radius-10 btn-danger btn-sm ' data-dismiss='modal' >Close</button>

                    </div>
                    </form>
                </div>
            </div>
        </div>




        <!-- Modal for template edit-->

        <!-- page-wrapper end -->
        <div class="modal fade" id="templateModal"  tabindex="-1" role="dialog" aria-labelledby="templateModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="templateModalLabel">Edit Template</h4>
                    </div>

                    <div class="modal-body" id="templateBody">

                        <form class="form-horizontal text-left">
                            <div class="form-group has-feedback">
                                <label for="templateName" class="col-sm-3 control-label">Template Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="templateName" name="templateName" required >

                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="configText" class="col-sm-3 control-label">Config</label>
                                <div class="col-sm-8">
                                    <textarea  class="form-control" id="configText" name="configText" rows=5 ></textarea>
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

                            <input type="hidden" id="templateID" name="templateID"/>
                            <input type="hidden" id="accountID" name="accountID"/>
                        </form>

                    </div>

                    <div class="modal-footer">
                        <div id=updateTemplateDiv>
                            <button type=button onclick='javascript:update_template()'  class="btn radius-50 btn-success btn-sm ">Save Template</button>
                        </div>

                        <button type=button class='btn radius-10 btn-danger btn-sm ' data-dismiss='modal' >Close</button>

                    </div>
                    </form>
                </div>
            </div>
        </div>




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

    <script>

        $(document).on("click", ".open-AddBookDialog", function () {

            //get data-id attribute of the clicked element
            var locationID = $(this).data('location-id');
            var siteNumber = $(this).data('site-number');
            var streetNumber = $(this).data('street-number');
            var streetValue = $(this).data('street-value');
            var suiteValue = $(this).data('suite-value');
            var cityValue = $(this).data('city-value');
            var stateValue = $(this).data('state-value');
            var zipValue = $(this).data('zip-value');
            var emailValue = $(this).data('email-value');


            //populate the textbox
            $(".modal-body #locationID").val( locationID );
            $(".modal-body #siteNumber").val( siteNumber );
            $(".modal-body #streetnumber").val( streetNumber );
            $(".modal-body #street").val( streetValue );
            $(".modal-body #suite").val( suiteValue );
            $(".modal-body #city").val( cityValue );
            $(".modal-body #state").val( stateValue );
            $(".modal-body #zip").val( zipValue );
            $(".modal-body #email").val( emailValue );
        });

        $(document).on("click", ".open-editTemplate", function () {

            //get data-id attribute of the clicked element
            var templateID = $(this).data('template-id');
            var templateName = $(this).data('template-name');
            var config = $(this).data('config-value');
            var isDefault = $(this).data('isdefault-value');
            var accountID = $(this).data('account-id');


            //populate the textbox
            $(".modal-body #templateID").val( templateID );
            $(".modal-body #templateName").val( templateName );
            $(".modal-body #configText").val( config );
            $(".modal-body #isDefaultOption").val( isDefault );
            $(".modal-body #accountID").val( accountID );
        });


        function update_location() {
            thediv = '#addbutton';
            locationID = document.getElementById('locationID').value;
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
                url: "ajax_functions.php?fn=update_location_info&locationID="+locationID+"&email="+email+"&siteNumber="+siteNumber+"&streetnumber="+streetnumber+"&street="+street+"&suite="+suite+"&city="+city+"&state="+state+"&zip="+zip,

                success: function(data){


//                    $(thediv).html(data);
                    window.location.reload()


                }
            });

        }


        function update_template() {
            thediv = '#updateTemplateDiv';
            templateID = document.getElementById('templateID').value;
            accountID = document.getElementById('accountID').value;
            templateName = document.getElementById('templateName').value;
            configText = document.getElementById('configText').value;
            isDefaultOption = document.getElementById('isDefaultOption').value;

            var params = {"templateID"      : templateID ,
                          "templateName"    : templateName,
                          "isDefaultOption" : isDefaultOption,
                          "accountID"       : accountID,
                          "configText"      : configText};

            $(thediv).html('Working... <i class="fa fa-refresh fa-spin" style="font-size:24px"></i>');


            $.ajax({
                type: "POST",
                url: "ajax_functions.php?fn=set-template",
                data: params,

                success: function(data){


//                    $(thediv).html(data);
                    window.location.reload()


                }
            });

        }



    </script>
</html>
