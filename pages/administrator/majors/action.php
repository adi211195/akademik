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

$college_code	=htmlspecialchars(@$_POST['college_code']);
$majors_code	=htmlspecialchars(@$_POST['majors_code']);
$majors 		=htmlspecialchars(@$_POST['majors']);
$prodi_code		=htmlspecialchars(@$_POST['prodi_code']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO master_majors (
						majors_id,
						college_code,
						majors_code,
						majors,
						prodi_code,
						create_date)
				VALUES ('$genid',
						'$college_code',
						'$majors_code',
						'$majors',
						'$prodi_code',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_majors SET	
						college_code='$college_code',					
						majors_code='$majors_code',
						majors='$majors',
						prodi_code='$prodi_code',
						create_date='$create_date' 
						where majors_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_majors  
						where majors_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>