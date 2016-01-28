<?php
/*
 * Template Name: User Accounting
 */
include('utils.php');

global $wpdb;

$thedate = (!isset($_GET["date"]) ? 'CURRENT_DATE' : $_GET["date"]);

$sql = "SELECT * FROM userinfo 
        LEFT JOIN ".RADACCT." ON userinfo.username=".RADACCT.".username 
        WHERE ".RADACCT.".acctstarttime>=$thedate 
        ORDER BY ".RADACCT.".radacctid DESC";
$users = $wpdb->get_results($sql);

$sql_online = $wpdb->get_results("SELECT * FROM ".RADACCT." WHERE acctstoptime IS NULL");
$online_users = count($sql_online);

?>
<div class="col=md-12">
<div class="options-div">
    <strong>ACCOUNTING</strong> <small><span style="color:grey;"><em><?php echo $online_users; ?> Online</em></span></small> 
</div>
<hr/>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="row-title">Username</th>
                            <th>IP Address</th>
                            <th>Start Time</th>
                            <th>Stop Time</th>
                            <th>Session Time</th>
                            <th>Uploads</th>
                            <th>Downloads</th>
                            <th>Status</th>
                            <th>NAS IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user->username; ?></td>
                            <td><?php echo $user->framedipaddress; ?></td>
                            <td><?php echo $user->acctstarttime; ?></td>
                            <td><?php echo $user->acctstoptime; ?></td>
                            <td><?php echo s2h($user->acctsessiontime); ?></td>
                            <td><?php echo b2h($user->acctinputoctets); ?></td>
                            <td><?php echo b2h($user->acctoutputoctets); ?></td>
                            <td><?php echo $user->acctterminatecause; ?></td>
                            <td><?php echo $user->nasipaddress; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
</div>          