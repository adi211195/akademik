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


$alumni_agenda_title 			=htmlspecialchars(@$_POST['alumni_agenda_title']);
$alumni_agenda_expired 		=htmlspecialchars(@$_POST['alumni_agenda_expired']);
$alumni_agenda_description 	=@$_POST['alumni_agenda_description'];

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO master_alumni_agenda (
						alumni_agenda_id,
						alumni_agenda_title,
						alumni_agenda_expired,
						alumni_agenda_description,
						create_date)
				VALUES ('$genid',
						'$alumni_agenda_title',
						'$alumni_agenda_expired',
						'$alumni_agenda_description',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_alumni_agenda SET	
						alumni_agenda_title='$alumni_agenda_title',
						alumni_agenda_expired='$alumni_agenda_expired',
						alumni_agenda_description='$alumni_agenda_description',
						create_date='$create_date' 
						where alumni_agenda_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_alumni_agenda  
						where alumni_agenda_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>