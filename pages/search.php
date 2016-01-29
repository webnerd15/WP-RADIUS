<div class="col-md-12">
<?php
/*
 * BACK END SEARCHING
 */

if(isset($_GET['key'])):
    $keyword = $_GET['key'];
    if(isset($_GET['page']) && $_GET['page'] == 'm'):
        global $wpdb;

        $query = "SELECT i.id, i.from_number, i.message, i.time_received, o.to_number, o.message AS reply_sms, o.time_replied 
                      FROM mobile_messages i 
                      LEFT JOIN mobile_replies o 
                      ON i.id = o.message_id
                      WHERE i.from_number LIKE '%$keyword%' OR i.time_received LIKE '%$keyword%'
                      ORDER BY i.id DESC
                      ";
        $messages = $wpdb->get_results($query);
        if(empty($messages)){
            echo 'Nothing found for: <strong>'.$keyword.'</strong>';
            exit();
        }
        echo 'Search results for: <strong>'.$keyword.'</strong>';
?>

<table class="table table-hover">
        <thead>
                <tr>
                        <th class="row-title">#</th>
                        <th>From</th>
						<th>Date_&_Time_Received</th>
                        <th>Message</th>
                        <th>Reply</th>
                </tr>
        </thead>
        <tbody>
                <?php foreach($messages as $message): ?>
                <tr>
                        <td class="row-title"><?php echo $message->id; ?></td>
                        <td>
                            <label for="tablecell"><?php echo $message->from_number; ?></label>
                        </td>
						<td><?php echo date('Y-m-d H:i:s', strtotime("+7 hours", strtotime($message->time_received))); ?></td>
                        <td><?php echo $message->message; ?></td>
                        <td><?php echo $message->reply_sms; ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>
<?php 
	elseif(isset($_GET['page']) && $_GET['page'] == 'u'):
		global $wpdb;
		$sql = "SELECT * FROM userinfo 
				LEFT JOIN ".RADCHECK." ON userinfo.username=".RADCHECK.".username 
				WHERE ".RADCHECK.".attribute='Cleartext-Password' AND ( TRIM(userinfo.firstname) LIKE '%$keyword%'
				OR TRIM(userinfo.lastname) LIKE '%$keyword%' OR userinfo.username LIKE '%$keyword%' OR userinfo.email LIKE '%$keyword%' OR userinfo.mobilephone LIKE '%$keyword%' ) 
				ORDER BY userinfo.id";
		$users = $wpdb->get_results($sql);
		if(empty($users)){
            echo 'Nothing found for: <strong>'.$keyword.'</strong>';
            exit();
        }
        echo 'Search results for: <strong>'.$keyword.'</strong>';
?>
				<table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="row-title">Name</th><th>Username</th><th>Password</th><th>E-Mail</th><th>Mobile</th>
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
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
<?php
    elseif(isset($_GET['page']) && $_GET['page'] == 'o'):
        global $wpdb;
        
	$query = "SELECT * FROM mobile_orders 
                  WHERE from_number LIKE '%$keyword%' OR network LIKE '%$keyword%' OR transaction_code LIKE '$keyword' OR time_created LIKE '%$keyword%'
                  ORDER BY id DESC";
	$orders = $wpdb->get_results($query);
        if(empty($orders)){
            echo 'Nothing found for: <strong>'.$keyword.'</strong>';
            exit();
        }
        echo 'Search results for: <strong>'.$keyword.'</strong>';
?>
                <table class="table table-hover">
					<thead>
						<tr>
                                                        <th>ID</th>
							<th class="row-title">From Number</th>
							<th>Network used</th>
							<th>Transaction code</th>
							<th>Amount paid</th>
                                                        <th>Date Ordered</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($orders as $order): ?>
						<tr>
                                                        <td><?php echo $order->id; ?></td>
							<td class="row-title"><label for="tablecell"><?php echo $order->from_number; ?></label></td>
							<td><?php echo $order->network; ?></td>
							<td><?php echo $order->transaction_code; ?></td>
							<td>TShs. <?php echo $order->amount; ?></td>
                                                        <td><?php echo date('Y-m-d H:i:s', strtotime("+7 hours", strtotime($order->time_created))); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
<?php
    endif;
endif;
?>
</div>