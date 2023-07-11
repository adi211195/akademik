<?php
include "../../../config/connection.php";

$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
// Genrate ID
$genid=substr(str_shuffle($genrate_id), 0, 14);



if (empty(@$_GET['action'])) {
	$action 	=htmlspecialchars(@$_POST['action']);
} else {
	$action 	=htmlspecialchars(@$_GET['action']);
}


//row1
$row1_min 	=htmlspecialchars(@$_POST['row1_min']);
$row1_max 	=htmlspecialchars(@$_POST['row1_max']);
$row1_sks 	=htmlspecialchars(@$_POST['row1_sks']);

//row2
$row2_min 	=htmlspecialchars(@$_POST['row2_min']);
$row2_max 	=htmlspecialchars(@$_POST['row2_max']);
$row2_sks 	=htmlspecialchars(@$_POST['row2_sks']);

//row3
$row3_min 	=htmlspecialchars(@$_POST['row3_min']);
$row3_max 	=htmlspecialchars(@$_POST['row3_max']);
$row3_sks 	=htmlspecialchars(@$_POST['row3_sks']);

//row4
$row4_min 	=htmlspecialchars(@$_POST['row4_min']);
$row4_max 	=htmlspecialchars(@$_POST['row4_max']);
$row4_sks 	=htmlspecialchars(@$_POST['row4_sks']);

//row5
$row5_min 	=htmlspecialchars(@$_POST['row5_min']);
$row5_max 	=htmlspecialchars(@$_POST['row5_max']);
$row5_sks 	=htmlspecialchars(@$_POST['row5_sks']);

//row6
$row6_sks 	=htmlspecialchars(@$_POST['row6_sks']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {		
		

		case 'edit':

			$update=mysqli_query($connect, "UPDATE settings_range_sks SET	
						range_sks_min='$row1_min',
						range_sks_max='$row1_max',
						range_sks='$row1_sks',
						create_date='$create_date' 
						where range_sks_id='row1'");

			$update=mysqli_query($connect, "UPDATE settings_range_sks SET	
						range_sks_min='$row2_min',
						range_sks_max='$row2_max',
						range_sks='$row2_sks',
						create_date='$create_date' 
						where range_sks_id='row2'");

			$update=mysqli_query($connect, "UPDATE settings_range_sks SET	
						range_sks_min='$row3_min',
						range_sks_max='$row3_max',
						range_sks='$row3_sks',
						create_date='$create_date' 
						where range_sks_id='row3'");

			$update=mysqli_query($connect, "UPDATE settings_range_sks SET	
						range_sks_min='$row4_min',
						range_sks_max='$row4_max',
						range_sks='$row4_sks',
						create_date='$create_date' 
						where range_sks_id='row4'");

			$update=mysqli_query($connect, "UPDATE settings_range_sks SET	
						range_sks_min='$row5_min',
						range_sks_max='$row5_max',
						range_sks='$row5_sks',
						create_date='$create_date' 
						where range_sks_id='row5'");

			$update=mysqli_query($connect, "UPDATE settings_range_sks SET	
						range_sks='$row6_sks',
						create_date='$create_date' 
						where range_sks_id='row6'");

			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

}



?>