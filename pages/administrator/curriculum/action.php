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

$curriculum_school_year	=htmlspecialchars(@$_POST['curriculum_school_year']);
$curriculum_semester	=htmlspecialchars(@$_POST['curriculum_semester']);
$curriculum_types_id	=htmlspecialchars(@$_POST['curriculum_types_id']);
$majors_code			=@$_POST['majors_code'];
$college_code 			=htmlspecialchars(@$_POST['college_code']);
$class_code 			=htmlspecialchars(@$_POST['class_code']);
$courses_code 			=htmlspecialchars(@$_POST['courses_code']);
$lecturer_code 			=htmlspecialchars(@$_POST['lecturer_code']);
$curriculum_day			=htmlspecialchars(@$_POST['curriculum_day']);
$curriculum_start		=htmlspecialchars(@$_POST['curriculum_start']);
$curriculum_end			=htmlspecialchars(@$_POST['curriculum_end']);
$curriculum_face		=htmlspecialchars(@$_POST['curriculum_face']);
$curriculum_status		=htmlspecialchars(@$_POST['curriculum_status']);


$uts_class_code		=htmlspecialchars(@$_POST['uts_class_code']);
$uts_start			=htmlspecialchars(@$_POST['uts_start']);
$uts_end			=htmlspecialchars(@$_POST['uts_end']);
$uts_face			=htmlspecialchars(@$_POST['uts_face']);
$uts_date			=htmlspecialchars(@$_POST['uts_date']);


$uas_class_code		=htmlspecialchars(@$_POST['uas_class_code']);
$uas_start			=htmlspecialchars(@$_POST['uas_start']);
$uas_end			=htmlspecialchars(@$_POST['uas_end']);
$uas_face			=htmlspecialchars(@$_POST['uas_face']);
$uas_date			=htmlspecialchars(@$_POST['uas_date']);


$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			foreach ($majors_code as $row) {
			$save=mysqli_query($connect, "INSERT INTO master_curriculum (
						curriculum_id,
						majors_code,
						college_code,
						curriculum_semester,
						curriculum_school_year,
						class_code,
						courses_code,
						lecturer_code,
						curriculum_types_id,
						curriculum_day,
						curriculum_start,
						curriculum_end,
						curriculum_face,
						curriculum_status,
						create_date)
				VALUES ('$genid',
						'$row',
						'$college_code',
						'$curriculum_semester',
						'$curriculum_school_year',
						'$class_code',
						'$courses_code',
						'$lecturer_code',
						'$curriculum_types_id',
						'$curriculum_day',
						'$curriculum_start',
						'$curriculum_end',
						'$curriculum_face',
						'$curriculum_status',
						'$create_date')");

			$uts=mysqli_query($connect, "INSERT INTO master_curriculum_uts (
						curriculum_id,
						uts_class_code,
						uts_date,
						uts_start,
						uts_end,
						uts_face,
						create_date)
				VALUES ('$genid',
						'$uts_class_code',
						'$uts_date',
						'$uts_start',
						'$uts_end',
						'$uts_face',
						'$create_date')");

			$uts=mysqli_query($connect, "INSERT INTO master_curriculum_uas (
						curriculum_id,
						uas_class_code,
						uas_date,
						uas_start,
						uas_end,
						uas_face,
						create_date)
				VALUES ('$genid',
						'$uas_class_code',
						'$uas_date',
						'$uas_start',
						'$uas_end',
						'$uas_face',
						'$create_date')");
			}

			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_curriculum SET
						
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

			$uts=mysqli_query($connect, "UPDATE master_curriculum_uts SET					
						uts_class_code='$uts_class_code',
						uts_date='$uts_date',
						uts_start='$uts_start',
						uts_end='$uts_end',
						uts_face='$uts_face',
						create_date='$create_date'
						where curriculum_id='$id'");

			$uts=mysqli_query($connect, "UPDATE master_curriculum_uas SET					
						uas_class_code='$uas_class_code',
						uas_date='$uas_date',
						uas_start='$uas_start',
						uas_end='$uas_end',
						uas_face='$uas_face',
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

			$uts=mysqli_query($connect, "DELETE FROM master_curriculum_uts 
						where curriculum_id='$id'");

			$uas=mysqli_query($connect, "DELETE FROM master_curriculum_uas 
						where curriculum_id='$id'");

			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>