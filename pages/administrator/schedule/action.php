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

$choose					=htmlspecialchars(@$_POST['choose']);
$schedule_id			=htmlspecialchars(@$_POST['schedule_id']);

$schedule_school_year	=htmlspecialchars(@$_POST['schedule_school_year']);
$schedule_semester		=htmlspecialchars(@$_POST['schedule_semester']);
$schedule_generation	=htmlspecialchars(@$_POST['schedule_generation']);
$schedule				=htmlspecialchars(@$_POST['schedule']);
$schedule_limit			=htmlspecialchars(@$_POST['schedule_limit']);
$majors_code			=htmlspecialchars(@$_POST['majors_code']);
$college_code 			=htmlspecialchars(@$_POST['college_code']);


$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input_schedule':

			///CEK JADWAL
				$mc=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum where curriculum_id='$choose'"));
				$cek_mc_schedule=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_curriculum as mc, schedule_package as sp where 
							mc.curriculum_id=sp.curriculum_id AND
							mc.curriculum_day='$mc[curriculum_day]' AND 
							sp.schedule_id='$schedule_id' AND 
							((mc.curriculum_start BETWEEN '$mc[curriculum_start]' AND '$mc[curriculum_end]') OR
							(mc.curriculum_end BETWEEN '$mc[curriculum_start]' AND '$mc[curriculum_end]'))"));


				$cek_mc_courses=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_curriculum as mc, schedule_package as sp where 
							mc.curriculum_id=sp.curriculum_id AND
							mc.curriculum_day='$mc[curriculum_day]' AND 
							mc.courses_code='$mc[courses_code]' AND 
							sp.schedule_id='$schedule_id' AND 
							((mc.curriculum_start BETWEEN '$mc[curriculum_start]' AND '$mc[curriculum_end]') OR
							(mc.curriculum_end BETWEEN '$mc[curriculum_start]' AND '$mc[curriculum_end]'))"));

				


				if ($cek_mc_schedule>0) {
					echo json_encode(array('status'=>'schedule failed'));
				} elseif ($cek_mc_courses>0) {
					echo json_encode(array('status'=>'courses failed'));
				} else {

		    		mysqli_query($connect, "INSERT INTO schedule_package (schedule_package_id,
		    			curriculum_id,
		    			schedule_id)
		    			VALUES ('$genid',
		    					'$choose',
		    					'$schedule_id')");
		    					
					echo json_encode(array('status'=>'success'));
				}


			
			break;

		case 'remove_schedule':

			$remove=mysqli_query($connect, "DELETE FROM schedule_package  
						where curriculum_id='$choose' AND schedule_id='$schedule_id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'input':

			$save=mysqli_query($connect, "INSERT INTO master_schedule (
						schedule_id,
						majors_code,
						college_code,
						schedule_semester,
						schedule_school_year,
						schedule_generation,
						schedule,
						schedule_limit,
						create_date)
				VALUES ('$genid',
						'$majors_code',
						'$college_code',
						'$schedule_semester',
						'$schedule_school_year',
						'$schedule_generation',
						'$schedule',
						'$schedule_limit',
						'$create_date')");
			if ($save) {
				$update=mysqli_query($connect, "UPDATE schedule_package SET	
						schedule_id='$genid'
						where schedule_id=''");

				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_schedule SET	
						schedule_generation='$schedule_generation',
						schedule='$schedule',
						schedule_limit='$schedule_limit',
						create_date='$create_date' 
						where schedule_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_schedule  
						where schedule_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>