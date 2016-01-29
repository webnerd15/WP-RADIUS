<?php 
include_once('index.php');
include_once('utils.php');

$data = json_decode(file_get_contents("php://input"));

$nas_id = $data->nas_id;
$shortname = $data->shortname;
$host = $data->host;
$secret = $data->secret;
$type = $data->type;
$description = $data->description;

global $wpdb;

$sql = "UPDATE ".NAS." SET nasname='$host',shortname='$shortname',type='$type',secret='$secret',description='$description'
		WHERE id=$nas_id";

if($wpdb->query($sql)){
	echo '<div class="alert alert-success">
			<strong>Success!</strong> New NAS updated!.
		</div>';
}else{
	echo '<div class="alert alert-danger">
			<strong>Error!</strong> New NAS not updated!.
		</div>';
}