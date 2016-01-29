<?php 

include_once('index.php');
include_once('utils.php');

$data = json_decode(file_get_contents("php://input"));

$nas_id = $data->nas_id;

global $wpdb;
$row = $wpdb->get_row("SELECT * FROM ".NAS." WHERE id=$nas_id");

$nas_rr[] = array(
	'nas_id' => $row->id,
	'shortname' => $row->shortname,
	'host' => $row->nasname,
	'secret' => $row->secret,
	'type' => $row->type,
	'description' => $row->description
);

print_r( json_encode($nas_rr) );
