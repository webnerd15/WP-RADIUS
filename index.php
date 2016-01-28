<?php
	if(isset($_GET['p']) && $_GET['p'] == 'r'){
		include_once('pages/ruksa/register.php');
		exit;
	}else{
?>
        <?php get_header(); ?>
        <div class="content">
            <?php 
                switch($_GET['p']):
                    case 'n':
                        include_once('pages/nas.php');
                        break;
					case 'u':
						include_once('pages/users.php');
						break;
					case 'a':
						include_once('pages/accounting.php');
						break;
					case 's':
						include_once('pages/search.php');
						break;
                    default:
                        include_once('pages/dash.php');
                endswitch;
            ?>
        </div>
        <?php get_footer(); ?>
	<?php }	?>