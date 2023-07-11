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
$college_dean	=htmlspecialchars(@$_POST['college_dean']);
$college 		=htmlspecialchars(@$_POST['college']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO master_college (
						college_id,
						college_code,
						college_dean,
						college,
						create_date)
				VALUES ('$genid',
						'$college_code',
						'$college_dean',
						'$college',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_college SET						
						college_code='$college_code',
						college_dean='$college_dean',
						college='$college',
						create_date='$create_date' 
						where college_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_college  
						where college_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>