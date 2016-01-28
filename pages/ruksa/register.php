<?php
ini_set('error_reporting', E_ALL);

if(isset($_POST) && $_POST['fname']):
	// get the data submitted...
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$pass = $_POST['password'];
	$phone = $_POST['phone'];
	$plan = $_POST['plan'];
	$email = $_POST['email'];
	
	include_once('processor.php');

	register($fname, $lname, $email, $pass, $phone, $plan);
	
	//echo 'halaaaaa';
endif;

?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>ruksa hotspot registration</title>
        <meta name="viewport" content="width=device-width">
        <link href="<?php echo get_stylesheet_directory_uri(); ?>/pages/ruksa/login.css" rel="stylesheet" />
        <link href="<?php echo get_stylesheet_directory_uri(); ?>/kendo/styles/kendo.common.min.css" rel="stylesheet">
        <link href="<?php echo get_stylesheet_directory_uri(); ?>/kendo/styles/kendo.blueopal.min.css" rel="stylesheet">
    
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/kendo/js/jquery.min.js"></script>
        <script src="<?php echo get_stylesheet_directory_uri(); ?>/kendo/js/kendo.web.min.js"></script>
    </head>
    <body>
    	<center><img src="<?php echo get_stylesheet_directory_uri(); ?>/pages/ruksa/logo.png" /><br/><span style="color:#aaa;"> - INTERNET SERVICES - </span></center>
        
		<?php if($_GET['status']=='good'){ ?>
		
		<div id="container">
            <div id="registrar">
                <center>
                	<img src="<?php echo get_stylesheet_directory_uri(); ?>/pages/ruksa/success.png" style="width: 48px;height: auto;" />
                	<h3>CONGRATULATIONS <?php echo $_GET['f']; ?>!</h3>
                               
                	<p>You have been registered with username: <b><?php echo $_GET['u']; ?></b> and password: <b><?php echo $_GET['ps']; ?></b></p>
                	<p>The plan you chose is <?php echo $_GET['pl']; ?> PLAN. You need to pay before you can use your account to surf the internet!</p>
                        <p> Prices are:<br/><strong>DAILY PLAN : TShs 500.00<br/>WEEKLY PLAN : TShs 3,000.00<br/>MONTHLY PLAN : TShs 9,000.00</strong></p>
                	<p>Please send your cash to: Tigopesa - 0672 076766.</p>
                	<p>After sending the money, you will immediately receive notification from us!</p>
                	<p><a href="http://www.google.com">Click here to Continue.</a></p>
            	</center> 	
            </div>
        </div>
		
		<?php }elseif($_GET['status']=='bad'){ ?>
		
		<div id="container">
            <div id="registrar">
                <center>
                	<img src="<?php echo get_stylesheet_directory_uri(); ?>/pages/ruksa/wrong.png" style="width: 48px;height: auto;" />
                	<h3>SORRY!</h3>
                               
                	<p>We could not have you registered because such details seems already exists into our system</p>
                	<p>Please <a href="?p=r">try again</a> with differnt particulars, or contact us for further assistance!.</p>
            	</center> 	
            </div>
        </div>
		
		<?php }else{ ?>
		
		<div id="container">
            <div id="registrar">
                <h3>Hotspot Registration form.</h3>
                <hr/>
                <form method="post" action="" >
					<small>Firstname:</small>
                    <input type="text" placeholder="Firstname" required class="k-textbox" name="fname"/>
					<small>Lastname:</small>
                    <input type="text" placeholder="Lastname" required class="k-textbox" name="lname" />
					<small>Email:</small>
                    <input type="email" placeholder="Email" required class="k-textbox" name="email"/>
					<small>Mobile phone:</small>
                    <input type="text" placeholder="Mobile phone" required class="k-textbox" name="phone" />
					<small>Password</small>
                    <input type="password" placeholder="password" required class="k-textbox" name="password" />
                    <hr/>
                    <center>
	                    <select name="plan" id="dropable">
	                    	<option value="WEEKLY">WEEKLY PLAN</option>
	                    	<option value="MONTHLY">MONHTLY PLAN</option>
	                    	<option value="QORTERLY">QORTERLY PLAN</option>
	                    </select>
                    </center>
                    <hr/>
                    <center><input type="submit" value="REGISTER" class="k-button" /> | <input type="reset" value="CANCEL" class="k-button"/></center>
                    
                </form>
            </div>
        </div>
		
		<?php } ?>
        <script>
                $(document).ready(function() {
                    $("#dropable").kendoDropDownList();
                });
        </script>
    </body>
</html>
