<?php 
include_once('index.php');
include_once('utils.php');

$data = json_decode(file_get_contents("php://input"));

$shortname = $data->shortname;
$host = $data->host;
$secret = $data->secret;
$type = $data->type;
$description = $data->description;

global $wpdb;

$sql = "INSERT INTO ".NAS."(nasname,shortname,type,secret,description)
		VALUES('$host','$shortname','$type','$secret','$description')";

if($wpdb->query($sql)){
	echo '<div class="alert alert-success">
			<strong>Success!</strong> New NAS added!.
		</div>';
}else{
	echo '<div class="alert alert-danger">
			<strong>Error!</strong> New NAS not added!.
		</div>';
}