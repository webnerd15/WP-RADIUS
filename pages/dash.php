<?php
include('utils.php');

global $wpdb;

$day_sales = $wpdb->get_row("SELECT SUM(amount) AS total_sales FROM mobile_orders WHERE time_created >= CURRENT_DATE");
$week_sales = $wpdb->get_row("SELECT SUM(amount) AS total_sales FROM mobile_orders WHERE WEEK(time_created)= WEEK(CURRENT_DATE)");
$month_sales = $wpdb->get_row("SELECT SUM(amount) AS total_sales FROM mobile_orders WHERE MONTH(time_created) = MONTH(CURRENT_DATE)");
$year_sales = $wpdb->get_row("SELECT SUM(amount) AS total_sales FROM mobile_orders WHERE YEAR(time_created) = YEAR(CURRENT_DATE)");
$all_sales = $wpdb->get_row("SELECT SUM(amount) AS total_sales FROM mobile_orders");
	
#=================================================================#

$sql = "SELECT *, COUNT(".RADACCT.".nasipaddress) AS online_users FROM ".RADACCT." 
		LEFT JOIN ".NAS." ON ".RADACCT.".nasipaddress = ".NAS.".nasname 
		WHERE ".RADACCT.".acctstoptime IS NULL GROUP BY ".RADACCT.".nasipaddress";
$nastats = $wpdb->get_results($sql);
?>
<div class="container">
<div class="col-md-8">
	<div style="width:60%;float:left;">
		<?php
			$output = shell_exec('radiusd -v');
			echo "<pre>$output</pre>";
		?>
	</div>
</div>
<div class="col-md-4">
		<h4>NAS Online users</h4>
		<table class="table table-condensed table-striped">
			<?php foreach($nastats as $nastat): ?>
			<tr>
				<td>
					<?php echo $nastat->shortname; ?> <small style="color:grey;">(<?php echo $nastat->nasname; ?>)</small>
				</td>
				<td><?php echo $nastat->online_users; ?></td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
