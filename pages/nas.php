<?php
include('utils.php');

global $wpdb;

$page = (int) (!isset($_GET["show_page"]) ? 1 : $_GET["show_page"]);

$per_page = 20;
$start_from = ($page-1) * $per_page;


$rows = $wpdb->get_results("SELECT id FROM ".NAS);
$total_records = count($rows);

$sql = "SELECT * FROM ".NAS." ORDER BY id LIMIT $start_from, $per_page";
$nases = $wpdb->get_results($sql);

?>

<div ng-app="nasApp" ng-controller="nasController">

<div id="overlayer">
	<div id="overlayer-content">
		<?php include_once('forms/nas.form.php'); ?>
	</div>
</div>

<div class="col-md-12">

<div class="options-div">
    <strong>Network Access Servers</strong> <small><span style="color:grey;"><em><?php echo $total_records; ?> Total</em></span></small> 
	<span style="margin-left:10px;border-left:thin solid #ccc;padding-left:10px;">
		<a href="#" ng-click="openNewNasForm()"><i class="fa fa-plus"></i> Add New</a>
	</span>
	<form action="" method="get" role="form">
		<div style="float:right;margin-top:-26px;">
			<input type="hidden" name="p" value="s" /> 
			<input type="hidden" name="page" value="<?php echo $_GET['p']; ?>" />
			<input type="text" name="key" placeholder="filter..." class="form-control" />
		</div>
	</form>
</div>
<hr/>

<div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th><th>IP/Host</th><th>Secret</th><th>Type</th><th>Description</th><th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($nases as $nas): ?>
                        <tr>
                            <td><?php echo $nas->shortname; ?></td>
                            <td><?php echo $nas->nasname; ?></td>
							<td><?php echo $nas->secret; ?></td>
							<td><?php echo $nas->type; ?></td>
                            <td><?php echo $nas->description; ?></td>
                            <td>
								<a href=""><i class="fa fa-edit"></i> Edit</a>
							</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
<div style="clear: both; margin:5px;padding-top:4px;">
<?php
      echo pagination($total_records, $per_page, $_GET['show_page'], get_bloginfo('url').'/?p='.$_GET['p'].'&');
?>
</div> 
</div> 
</div>        
</div>         
<script src="<?php echo TEMPL_PATH; ?>/pages/apps/nas.app.js"></script>