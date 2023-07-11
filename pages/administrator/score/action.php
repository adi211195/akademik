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
$weight_attendance	=htmlspecialchars(@$_POST['weight_attendance']);
$weight_uts			=htmlspecialchars(@$_POST['weight_uts']);
$weight_uas			=htmlspecialchars(@$_POST['weight_uas']);
$weight_quiz		=htmlspecialchars(@$_POST['weight_quiz']);


$create_date	=date('Y-m-d H:i:s');

switch ($action) {		
		
		case 'weight':		

				$total=$weight_attendance+$weight_uts+$weight_uas+$weight_quiz;

				if ($total==100) {
					$remove=mysqli_query($connect, "DELETE FROM master_score_weight
							where curriculum_id='$curriculum_id'");

					$save=mysqli_query($connect, "INSERT INTO master_score_weight (curriculum_id,
				    			weight_attendance,
				    			weight_uts,
				    			weight_uas,
				    			weight_quiz,
				    			create_date)
				    			VALUES ('$curriculum_id',
				    					'$weight_attendance',
				    					'$weight_uts',
				    					'$weight_uas',
				    					'$weight_quiz',
				    					'$create_date')");

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
				} else {
					echo json_encode(array('status'=>'failed'));
				}
			
			break;

		

		case 'score':
			$remove=mysqli_query($connect, "DELETE FROM master_score
							where curriculum_id='$curriculum_id'");

			$weight=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_score_weight 
							where curriculum_id='$curriculum_id'"));
			$mc=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum
							where curriculum_id='$curriculum_id'"));

			$data=mysqli_query($connect, "SELECT * FROM master_krs 
							LEFT JOIN master_student ON master_student.student_nim=master_krs.student_nim
							where curriculum_id='$curriculum_id'");
			while ($row=mysqli_fetch_array($data)) {

				$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				// Genrate ID
				$genid=substr(str_shuffle($genrate_id), 0, 14);
				
				$uts="uts".$row['student_nim']."";
				$uas="uas".$row['student_nim']."";
				$quiz="quiz".$row['student_nim']."";

				$score_uts		=htmlspecialchars(@$_POST[$uts]);
				$score_uas		=htmlspecialchars(@$_POST[$uas]);
				$score_quiz		=htmlspecialchars(@$_POST[$quiz]);

				$attendance=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_attendance
							LEFT JOIN master_attendance_list ON master_attendance_list.attendance_id=master_attendance.attendance_id 
							where curriculum_id='$curriculum_id' AND 
							student_nim='$row[student_nim]' AND
							attendance_type='H'"));

				
				$weight_attendance=$weight['weight_attendance']/100;

				if ($attendance>=$mc['curriculum_face']) {
					$attendance_amount=$mc['curriculum_face'];
				} else {
					$attendance_amount=$attendance;
				}

		        $tot_attendance=(($attendance_amount/$mc['curriculum_face'])*100)*$weight_attendance;

		        $grand_attendance=round($tot_attendance,2);

		        $grand_uts=($score_uts*$weight['weight_uts'])/100;
		        $grand_quiz=($score_quiz*$weight['weight_quiz'])/100;
		        $grand_uas=($score_uas*$weight['weight_uas'])/100;
		        $grand_total=($grand_attendance+$grand_uts+$grand_quiz+$grand_uas);

		        $quality=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM settings_range_ipk where 
		                          range_ipk_max<='$grand_total' AND 
		                          range_ipk_min>='$grand_total'"));


		        $save=mysqli_query($connect, "INSERT INTO master_score (
		        				score_id,
		        				curriculum_id,
		        				student_nim,
		        				score_school_year,
		        				score_semester,
				    			score_attendance,
				    			score_uts,
				    			score_uas,
				    			score_quiz,
				    			score_numbers,
				    			score_alphabet,
				    			score_quality,
				    			courses_code,
				    			create_date)
				    			VALUES ('$genid',
				    					'$curriculum_id',
				    					'$row[student_nim]',
				    					'$mc[curriculum_school_year]',
				    					'$mc[curriculum_semester]',
				    					'$attendance',
				    					'$score_uts',
				    					'$score_uas',
				    					'$score_quiz',
				    					'$grand_total',
				    					'$quality[range_ipk_alphabet]',
				    					'$quality[range_ipk_numbers]',
				    					'$mc[courses_code]',
				    					'$create_date')");

			}

			
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>