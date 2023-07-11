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


$alumni_job_vacancy_title 			=htmlspecialchars(@$_POST['alumni_job_vacancy_title']);
$alumni_job_vacancy_expired 		=htmlspecialchars(@$_POST['alumni_job_vacancy_expired']);
$alumni_job_vacancy_description 	=@$_POST['alumni_job_vacancy_description'];

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO master_alumni_job_vacancy (
						alumni_job_vacancy_id,
						alumni_job_vacancy_title,
						alumni_job_vacancy_expired,
						alumni_job_vacancy_description,
						create_date)
				VALUES ('$genid',
						'$alumni_job_vacancy_title',
						'$alumni_job_vacancy_expired',
						'$alumni_job_vacancy_description',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_alumni_job_vacancy SET	
						alumni_job_vacancy_title='$alumni_job_vacancy_title',
						alumni_job_vacancy_expired='$alumni_job_vacancy_expired',
						alumni_job_vacancy_description='$alumni_job_vacancy_description',
						create_date='$create_date' 
						where alumni_job_vacancy_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_alumni_job_vacancy  
						where alumni_job_vacancy_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>