<?php
session_start();

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

if (empty(@$_GET['student_nim'])) {
	$student_nim			=htmlspecialchars(@$_POST['student_nim']);
} else {
	$student_nim			=htmlspecialchars(@$_GET['student_nim']);
}


if (empty(@$_GET['approved'])) {
	$approved			=htmlspecialchars(@$_POST['approved']);
} else {
	$approved			=htmlspecialchars(@$_GET['approved']);
}


$create_date	=date('Y-m-d H:i:s');

switch ($action) {		
		
		case 'krs':	
				

				$update=mysqli_query($connect, "UPDATE master_krs SET
			    			krs_approved='$approved'
			    			WHERE 
			    			student_nim='$student_nim' AND
			    			krs_id='$id'");

				if ($update) {
					echo json_encode(array('status'=>'success'));
				} else {			
					echo json_encode(array('status'=>'failed'));
				}
			
			break;


}



?>