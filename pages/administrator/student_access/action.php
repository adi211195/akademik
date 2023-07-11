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

$student_access_uts		=htmlspecialchars(@$_POST['student_access_uts']);
$student_access_quiz	=htmlspecialchars(@$_POST['student_access_quiz']);
$student_access_uas		=htmlspecialchars(@$_POST['student_access_uas']);


$student_access_school_year 	=htmlspecialchars(@$_POST['student_access_school_year']);
$student_access_semester 		=htmlspecialchars(@$_POST['student_access_semester']);

$student_name 		=htmlspecialchars(@$_POST['student_name']);
$student_generation =htmlspecialchars(@$_POST['student_generation']);
$college_code		=htmlspecialchars(@$_POST['college_code']);
$majors_code 		=htmlspecialchars(@$_POST['majors_code']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {	

		case 'input':

			$student=explode("|", $student_name);
            $student_nim=$student[0];


            $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_student_access where 
            	student_nim='$student_nim' AND 
            	student_access_school_year='$student_access_school_year' AND 
            	student_access_semester='$student_access_semester'"));
            
            if ($check>0) {


            		$update=mysqli_query($connect, "UPDATE master_student_access SET
								student_access_uts='$student_access_uts',
								student_access_quiz='$student_access_quiz',
								student_access_uas='$student_access_uas'
					where student_nim='$student_nim' AND
						  student_access_school_year='$student_access_school_year' AND
						  student_access_semester='$student_access_semester'");



            		if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}

            	
            } else {
            	
            	$save=mysqli_query($connect, "INSERT INTO master_student_access (
							student_access_id,
							student_nim,
							student_access_school_year,
							student_access_semester,
							student_access_uts,
							student_access_quiz,
							student_access_uas,
							create_date)
				VALUES ('$genid',
							'$student_nim',
							'$student_access_school_year',
							'$student_access_semester',
							'$student_access_uts',
							'$student_access_quiz',
							'$student_access_uas',
							'$create_date')");

            	
            	if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
            }	

			
			break;

			case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_student_access  
						where student_access_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>