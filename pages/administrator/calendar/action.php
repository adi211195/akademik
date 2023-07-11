<?php
include "../../../config/connection.php";

$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
// Genrate ID
$genid=substr(str_shuffle($genrate_id), 0, 14);

if (empty(@$_GET['id'])) {
	$id 	=htmlspecialchars(@$_POST['id']);
} else {
	$id 	=htmlspecialchars(@$_GET['id']);
}


if (empty(@$_GET['action'])) {
	$action 	=htmlspecialchars(@$_POST['action']);
} else {
	$action 	=htmlspecialchars(@$_GET['action']);
}

$calendar_title	=htmlspecialchars(@$_POST['calendar_title']);
$calendar_start	=htmlspecialchars(@$_POST['calendar_start']);
$calendar_end 	=htmlspecialchars(@$_POST['calendar_end']);
$calendar_color	=htmlspecialchars(@$_POST['calendar_color']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			if ($calendar_start<=$calendar_end) {
			$save=mysqli_query($connect, "INSERT INTO master_calendar (
						calendar_id,
						calendar_title,
						calendar_start,
						calendar_end,
						calendar_color,
						create_date)
				VALUES ('$genid',
						'$calendar_title',
						'$calendar_start',
						'$calendar_end',
						'$calendar_color',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}} else {
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			if ($calendar_start<=$calendar_end) {
			$update=mysqli_query($connect, "UPDATE master_calendar SET	
						calendar_title='$calendar_title',					
						calendar_start='$calendar_start',
						calendar_end='$calendar_end',
						calendar_color='$calendar_color',
						create_date='$create_date' 
						where calendar_end_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}} else {
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_calendar 
						where calendar_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>