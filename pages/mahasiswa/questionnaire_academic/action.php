<?php
session_start();

include "../../../config/connection.php";
$account_id=$_SESSION['account_id'];
$mhs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_student where account_id='$account_id'"));
$open_krs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM settings_open_krs"));
$school_year=$open_krs['open_school_year'];
$semester=$open_krs['open_semester'];
$student_nim=$mhs['student_nim'];

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

$question_id		=htmlspecialchars(@$_POST['question_id']);
$question_answer 	=htmlspecialchars(@$_POST['question_answer']);


$suggestions_id 	=htmlspecialchars(@$_POST['suggestions_id']);
$qs_answer 		=htmlspecialchars(@$_POST['qs_answer']);

$suggested_id		=htmlspecialchars(@$_POST['suggested_id']);
$suggested_answer 	=htmlspecialchars(@$_POST['suggested_answer']);




$create_date	=date('Y-m-d H:i:s');

switch ($action) {	
	

		case 'question':

			$remove=mysqli_query($connect, "DELETE FROM questionnaire_report_academic  
						where q_academic_id='$question_id'
						AND school_year='$school_year'
						AND semester='$semester'
						AND student_nim='$student_nim'");

			$save=mysqli_query($connect, "INSERT INTO questionnaire_report_academic (
						qr_academic_id,
						q_academic_id,
						q_academic_answer,
						student_nim,
						school_year,
						semester,
						create_date)
				VALUES ('$genid',
						'$question_id',
						'$question_answer',
						'$student_nim',
						'$school_year',
						'$semester',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'suggestions':

			$remove=mysqli_query($connect, "DELETE FROM questionnaire_report_suggestions  
						where suggestions_id='$suggestions_id'
						AND school_year='$school_year'
						AND semester='$semester'
						AND student_nim='$student_nim'
						AND qr_status='academic'");

			$save=mysqli_query($connect, "INSERT INTO questionnaire_report_suggestions (
						qr_suggestions_id,
						suggestions_id,
						qs_answer,
						student_nim,
						school_year,
						semester,
						qr_status,
						create_date)
				VALUES ('$genid',
						'$suggestions_id',
						'$qs_answer',
						'$student_nim',
						'$school_year',
						'$semester',
						'academic',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;


		case 'finish':

			$update=mysqli_query($connect, "UPDATE questionnaire_report_academic SET 
						qr_status='finish' 
						where school_year='$school_year'
						AND semester='$semester'
						AND student_nim='$student_nim'");
			
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		

}



?>