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

$curriculum_id		=htmlspecialchars(@$_POST['curriculum_id']);
$attendance_date	=htmlspecialchars(@$_POST['attendance_date']);
$student_nim 	=htmlspecialchars(@$_POST['student_nim']);
$attendance_type 	=htmlspecialchars(@$_POST['attendance_type']);


$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO master_attendance (
						attendance_id,
						curriculum_id,
						attendance_date,
						create_date)
				VALUES ('$genid',
						'$curriculum_id',
						'$attendance_date',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;


		case 'absen':

			$remove=mysqli_query($connect, "DELETE FROM master_attendance_list  
						where attendance_id='$id'
						AND student_nim='$student_nim'");

			$save=mysqli_query($connect, "INSERT INTO master_attendance_list (
						attendance_list_id,
						attendance_id,
						attendance_type,
						student_nim,
						create_date)
				VALUES ('$genid',
						'$id',
						'$attendance_type',
						'$student_nim',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_curriculum SET	
						majors_code='$majors_code',					
						college_code='$college_code',
						curriculum_semester='$curriculum_semester',
						curriculum_school_year='$curriculum_school_year',
						class_code='$class_code',
						courses_code='$courses_code',
						lecturer_code='$lecturer_code',
						curriculum_types_id='$curriculum_types_id',
						curriculum_day='$curriculum_day',
						curriculum_start='$curriculum_start',
						curriculum_end='$curriculum_end',
						curriculum_face='$curriculum_face',
						curriculum_status='$curriculum_status',
						create_date='$create_date' 
						where curriculum_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_curriculum  
						where curriculum_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>