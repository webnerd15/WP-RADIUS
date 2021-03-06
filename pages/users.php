<?php

global $wpdb;

$page = (int) (!isset($_GET["show_page"]) ? 1 : $_GET["show_page"]);

$per_page = 20;
$start_from = ($page-1) * $per_page;


$rows = $wpdb->get_results("SELECT id FROM userinfo WHERE TRIM(firstname) <> ''");
$total_records = count($rows);

$sql = "SELECT * FROM userinfo 
        LEFT JOIN ".RADCHECK." ON userinfo.username=".RADCHECK.".username 
        WHERE ".RADCHECK.".attribute='Cleartext-Password' AND TRIM(userinfo.firstname) <> ''
        ORDER BY userinfo.id
		LIMIT $start_from, $per_page";
$users = $wpdb->get_results($sql);

?>
<div class="col-md-12">
<div class="options-div">
    <strong>USERS</strong> <small><span style="color:grey;"><em><?php echo $total_records; ?> Total</em></span></small> 
	<span style="margin-left:10px;border-left:thin solid #ccc;padding-left:10px;">
		<a href="#" ng-click="openNewUserForm()"><i class="fa fa-plus"></i> Add New</a>
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
<div>
<div class="col-md-9">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="row-title">Name</th><th>Username</th><th>Password</th><th>E-Mail</th><th>Mobile</th><th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user->firstname.' '.$user->lastname; ?></td>
                            <td><?php echo $user->username; ?></td>
							<td><?php echo $user->value; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->mobilephone; ?></td>
							<td>
								<a href="#"><i class="fa fa-edit"></i> Edit</a> &nbsp;
								<!--a href="#"><i class="fa fa-close"></i> Disable</a-->
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
	<p>These are actual customers, they can connect and access internet through any of NASes we have configured.
	</p>
	<p>They can be grouped based on plans they have chosen. You can change any user's particular by clicking edit button.</p>
</div>

</div>
</div>
         