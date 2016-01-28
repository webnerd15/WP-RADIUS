<?php

function sendSMS($phone, $username, $password){
		
		$message = 'Hongera!, ombi lako limekubaliwa na RUKSA INTERNET SERVICES, utatumia username: '.$username.' na password: '.$password.' Tafadhali lipia uanze kufurahia huduma yetu!';

		$api_key = '1RAGX9468652DPJQ';
        $remote_uri = 'http://smsjanja.com/?k=api';
        // for the better api functionality the message id should also be sent
        $data = array("to_number" => $phone, "message" => $message, "api_key" => $api_key);                                                                    
        $data_string = json_encode($data);                                                                                   
        
        $ch = curl_init($remote_uri);                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
            'Content-Type: application/json',                                                                                
            'Content-Length: ' . strlen($data_string))                                                                       
        );                                                                                                                   
        
        curl_exec($ch);
}

function sendEmail($email, $username, $plan){
	$subject = 'Congratulations '.$username;
	$message = '<p>You have been registered with username: <b>'.$username.'</b> with the password that you have entered!</p>
                <p>The plan you chose is '.$plan.' PLAN. You need to pay before you can use your account to surf the internet!</p>
                <p> Prices are:<br/><strong>DAILY PLAN : TShs 500.00<br/>WEEKLY PLAN : TShs 3,000.00<br/>MONTHLY PLAN : TShs 9,000.00</strong></p>       
                <p>Please send your cash to: Tigopesa - 0672 076766.</p>';
				
	add_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );
	$headers = 'From: RUKSA INTERNET SERVICES <ruksa@powerandnetwork.co.tz>' . "\r\n";
	wp_mail( $email, $subject, $message,$headers );
	remove_filter( 'wp_mail_content_type', 'wpdocs_set_html_mail_content_type' );
}

function register($fname, $lname, $email, $pass, $phone, $plan)
{
		//header('Location: '.get_bloginfo('url').'/?p=r&status=good&f='.$fname.'&u='.$username.'&e='.$email.'$p='.$phone.'&pl='.$plan);        
		
		global $wpdb;
    	$username = strtolower(substr($fname, 0,1).$lname);
        # start by checking if the user already exists
        $row = $wpdb->get_row("SELECT * FROM userinfo WHERE username ='$username' OR email = '$email'");
        if(!empty($row->username)) # user exists
        {
            header('Location: '.get_bloginfo('url').'/?p=r&status=bad');    
        }
        else 
		{
            $sql = "INSERT INTO userinfo(username,firstname,lastname,email,mobilephone) 
            		VALUES('$username','$fname', '$lname', '$email', '$phone')";
			
			$sql1 = "INSERT INTO radcheck(username,attribute,op,value)
					 VALUES('$username','Cleartext-Password',':=','$pass')";
			
			$date = date('d M Y', strtotime(date('d M Y').' +2 day'));
			
			$sql2 = "INSERT INTO radcheck(username,attribute,op,value)
					 VALUES('$username','Expiration',':=','$date')";
					 
			$sql3 = "INSERT INTO radusergroup(username,groupname)
					VALUES('$username','$plan')";
            
			$wpdb->query($sql); 
			$wpdb->query($sql1);
			$wpdb->query($sql2);
			$wpdb->query($sql3); 
			
			sendSMS($phone,$username,$pass);
			sendEmail($email,$username,$plan);
			
			header('Location: '.get_bloginfo('url').'/?p=r&status=good&f='.$fname.'&u='.$username.'&e='.$email.'$p='.$phone.'&pl='.$plan.'&ps='.$pass);        
        }
		
}

