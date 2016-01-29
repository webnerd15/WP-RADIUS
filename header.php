<?php $cur_user_id = get_current_user_id(); if($cur_user_id == 0){ wp_redirect(get_bloginfo('url').'/wp-login.php'); } ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <title><?php echo get_bloginfo('name'); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link href="<?php echo get_stylesheet_directory_uri(); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/angular.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/kendo/js/kendo.web.min.js"></script>
	<?php wp_head(); ?>
</head>

<body>
       	
            <div class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="col-md-12">
						<div class="navbar-header">
						  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						  </button>
						   <h3><?php echo get_bloginfo('name'); ?></h3>
						</div>
						
						<div class="navbar-right">
							<ul  class="nav navbar-nav">
								<li><a href="<?php echo get_bloginfo('url'); ?>/?p=d"><i class="fa fa-dashboard"></i> Dashboard</a></li>
								<li><a href="<?php echo get_bloginfo('url'); ?>/?p=a"><i class="fa fa-database"></i> Accounting</a></li>
								<li><a href="<?php echo get_bloginfo('url'); ?>/?p=n"><i class="fa fa-wifi"></i> NAS</a></li>
								<li><a href="<?php echo get_bloginfo('url'); ?>/?p=u"><i class="fa fa-users"></i> Users</a></li>
								<li><a href="<?php echo get_bloginfo('url'); ?>/?p=g"><i class="fa fa-users"></i> Groups</a></li>
								<li><a href="<?php echo get_bloginfo('url'); ?>/?p=c"><i class="fa fa-gear"></i> Settings</a></li>
								<?php $current_user = get_userdata($cur_user_id); ?>
								<li><a style="border-left:solid thin grey;" href="<?php echo wp_logout_url(get_bloginfo('url')); ?>"><i class="fa fa-user"></i> logout &raquo;</a>
								 </li>
							</ul>
						</div>
					</div>
				</div>
            </div> 
			<<div style="clear:both;padding-top:60px;"></div>
			
			<div class="container">
			
