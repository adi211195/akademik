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

$lecturer_code		=htmlspecialchars(@$_POST['lecturer_code']);
$lecturer_salary	=htmlspecialchars(@$_POST['lecturer_salary']);
$salary_date 		=htmlspecialchars(@$_POST['salary_date']);
$salary_type		=htmlspecialchars(@$_POST['salary_type']);
$salary_amount		=htmlspecialchars(@$_POST['salary_amount']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO salary_another (
						another_id,
						lecturer_code,
						lecturer_salary,
						salary_date,
						salary_type,
						salary_amount,
						create_date)
				VALUES ('$genid',
						'$lecturer_code',
						'$lecturer_salary',
						'$salary_date',
						'$salary_type',
						'$salary_amount',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE salary_another SET	
						lecturer_code='$lecturer_code',					
						lecturer_salary='$lecturer_salary',
						salary_date='$salary_date',
						salary_type='$salary_type',
						salary_amount='$salary_amount',
						create_date='$create_date' 
						where another_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM salary_another  
						where another_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>