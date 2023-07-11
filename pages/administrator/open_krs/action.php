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


//row1
$open_school_year 	=htmlspecialchars(@$_POST['open_school_year']);
$open_semester 		=htmlspecialchars(@$_POST['open_semester']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {		
		

		case 'edit':

			
			$update=mysqli_query($connect, "UPDATE settings_open_krs SET	
						open_school_year='$open_school_year',
						open_semester='$open_semester' 
						where open_krs_id='$id'");

			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

}



?>