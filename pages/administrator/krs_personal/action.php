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
$student_nim			=htmlspecialchars(@$_POST['student_nim']);

$krs_school_year		=htmlspecialchars(@$_POST['krs_school_year']);
$krs_semester			=htmlspecialchars(@$_POST['krs_semester']);
$majors_code			=htmlspecialchars(@$_POST['majors_code']);
$college_code 			=htmlspecialchars(@$_POST['college_code']);


$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input_krs':

			///CEK JADWAL
				$mc=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum where curriculum_id='$choose'"));
				$cek_mc_schedule=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_curriculum as mc, master_krs as mk where 
							mc.curriculum_id=mk.curriculum_id AND
							mc.curriculum_day='$mc[curriculum_day]' AND 
							mk.student_nim='$student_nim' AND 
							mk.krs_school_year='$krs_school_year' AND 
							mk.krs_semester='$krs_semester' AND 
							((mc.curriculum_start BETWEEN '$mc[curriculum_start]' AND '$mc[curriculum_end]') OR
							(mc.curriculum_end BETWEEN '$mc[curriculum_start]' AND '$mc[curriculum_end]'))"));


				$cek_mc_courses=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_curriculum as mc, master_krs as mk where 
							mc.curriculum_id=mk.curriculum_id AND
							mc.curriculum_day='$mc[curriculum_day]' AND 
							mc.courses_code='$mc[courses_code]' AND 
							mk.student_nim='$student_nim' AND 
							mk.krs_school_year='$krs_school_year' AND 
							mk.krs_semester='$krs_semester' AND 
							((mc.curriculum_start BETWEEN '$mc[curriculum_start]' AND '$mc[curriculum_end]') OR
							(mc.curriculum_end BETWEEN '$mc[curriculum_start]' AND '$mc[curriculum_end]'))"));

				


				if ($cek_mc_schedule>0) {
					echo json_encode(array('status'=>'schedule failed'));
				} elseif ($cek_mc_courses>0) {
					echo json_encode(array('status'=>'courses failed'));
				} else {

		    		mysqli_query($connect, "INSERT INTO master_krs (krs_id,
		    			curriculum_id,
		    			student_nim,
		    			krs_school_year,
		    			krs_semester,
		    			krs_approved,
		    			create_date)
		    			VALUES ('$genid',
		    					'$choose',
		    					'$student_nim',
		    					'$krs_school_year',
		    					'$krs_semester',
		    					'Approved',
		    					'$create_date')");
		    					
					echo json_encode(array('status'=>'success'));
				}


			
			break;

		case 'remove_krs':

			$remove=mysqli_query($connect, "DELETE FROM master_krs  
						where curriculum_id='$choose' 
						AND student_nim='$student_nim'
						AND krs_school_year='$krs_school_year'
						AND krs_semester='$krs_semester'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'input':		

				echo json_encode(array('status'=>'success'));
			
			break;

		case 'edit':

				echo json_encode(array('status'=>'success'));
			
			break;

		case 'remove':
			
			$data=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_krs 
                	where krs_id='$id'"));
			$remove=mysqli_query($connect, "DELETE FROM master_krs 
						where student_nim='$data[student_nim]'
						AND krs_school_year='$data[krs_school_year]'
						AND krs_semester='$data[krs_semester]'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>