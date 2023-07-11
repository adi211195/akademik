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

$date			=htmlspecialchars(@$_GET['date']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'blacklist':

			$save=mysqli_query($connect, "INSERT INTO salary_teaching_blacklist (
						blacklist_id,
						curriculum_id,
						attendance_date,
						create_date)
				VALUES ('$genid',
						'$id',
						'$date',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'whitelist':
			$delete=mysqli_query($connect, "DELETE FROM salary_teaching_blacklist 
				where curriculum_id='$id' 
				AND attendance_date='$date'");

			if ($delete) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

}



?>