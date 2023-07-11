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

$majors_code	=htmlspecialchars(@$_POST['majors_code']);
$courses_code	=htmlspecialchars(@$_POST['courses_code']);
$courses 		=htmlspecialchars(@$_POST['courses']);
$courses_sks	=htmlspecialchars(@$_POST['courses_sks']);
$courses_smt	=htmlspecialchars(@$_POST['courses_smt']);
$courses_low_value	=htmlspecialchars(@$_POST['courses_low_value']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO master_courses (
						courses_id,
						majors_code,
						courses_code,
						courses,
						courses_sks,
						courses_smt,
						courses_low_value,
						courses_discussion,
						create_date)
				VALUES ('$genid',
						'$majors_code',
						'$courses_code',
						'$courses',
						'$courses_sks',
						'$courses_smt',
						'$courses_low_value',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_courses SET	
						majors_code='$majors_code',					
						courses_code='$courses_code',
						courses='$courses',
						courses_sks='$courses_sks',
						courses_smt='$courses_smt',
						courses_low_value='$courses_low_value',
						create_date='$create_date' 
						where courses_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_courses  
						where courses_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>