<?php

global $wpdb;

$page = (int) (!isset($_GET["show_page"]) ? 1 : $_GET["show_page"]);

$per_page = 20;
$start_from = ($page-1) * $per_page;


$rows = $wpdb->get_results("SELECT id FROM ".RADGROUPCHECK);
$total_records = count($rows);

$sql = "SELECT * FROM ".RADGROUPCHECK;
$groups = $wpdb->get_results($sql);

?>
<div>
<div class="col-md-12">
<div class="options-div">
    <strong>GROUPS/PLANS</strong> <small><span style="color:grey;"><em><?php echo $total_records; ?> Total</em></span></small> 
	<span style="margin-left:10px;border-left:thin solid #ccc;padding-left:10px;">
		<a href="#" ng-click="openNewGroupForm()"><i class="fa fa-plus"></i> Add New</a>
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
</div>

<div class="col-md-9">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="row-title">Group Name</th><th>Attribute</th><th>Operator</th><th>Value</th><th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($groups as $group): ?>
                        <tr>
                            <td><?php echo $group->groupname; ?></td>
                            <td><?php echo $group->attribute; ?></td>
							<td><center><?php echo $group->op; ?></center></td>
                            <td><?php echo $group->value; ?></td>
							<td>
								<a href="#"><i class="fa fa-edit"></i> Edit</a> &nbsp;
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

<div class="col-md-3">
	<h4><i class="fa fa-info"></i> Quick info!</h4>
	<hr/>
	<p>In RADIUS perspective, Groups are considered as plans, the attributes attached to these plans will affect all customers grouped into that plan. 
	</p>
	<p>You may create the same plan name with multiple attributes to reflect either bandwidth, session time, speed and much more.
	</p>
</div>


</div>
         