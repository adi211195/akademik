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

$start_date	=htmlspecialchars(@$_POST['start_date']);
$start_time		=htmlspecialchars(@$_POST['start_time']);
$end_date		=htmlspecialchars(@$_POST['end_date']);
$end_time 		=htmlspecialchars(@$_POST['end_time']);

$student_school_year 	=htmlspecialchars(@$_POST['student_school_year']);
$student_semester 		=htmlspecialchars(@$_POST['student_semester']);

$change 			=htmlspecialchars(@$_POST['change']);
$student_name 		=htmlspecialchars(@$_POST['student_name']);
$student_generation =htmlspecialchars(@$_POST['student_generation']);
$college_code		=htmlspecialchars(@$_POST['college_code']);
$majors_code 		=htmlspecialchars(@$_POST['majors_code']);
$student_status 	=htmlspecialchars(@$_POST['student_status']);

$open_start_date=$start_date." ".$start_time;
$open_end_date=$end_date." ".$end_time;

$create_date	=date('Y-m-d H:i:s');

switch ($action) {	

		case 'open_student':

			$student=explode("|", $student_name);
            $student_nim=$student[0];

            if ($open_start_date<=$open_end_date) {

            $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM student_open_krs where 
            	student_nim='$student_nim' AND 
            	student_school_year='$student_school_year' AND 
            	student_semester='$student_semester'"));
            
            if ($check>0) {

            	if ($change==1) {

            		$update=mysqli_query($connect, "UPDATE student_open_krs SET
								open_start_date='$open_start_date',
								open_end_date='$open_end_date'
					where student_nim='$student_nim' AND
						  student_school_year='$student_school_year' AND
						  student_semester='$student_semester'");


            		$update2=mysqli_query($connect, "UPDATE master_student_history SET
								student_history_status='$student_status'
					where student_nim='$student_nim' AND
						  student_history_school_year='$student_school_year' AND
						  student_history_semester='$student_semester'");


            		if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}

            	} 
            } else {
            	
            	$save=mysqli_query($connect, "INSERT INTO student_open_krs (
							open_krs_id,
							student_nim,
							student_school_year,
							student_semester,
							open_start_date,
							open_end_date,
							create_date)
				VALUES ('$genid',
							'$student_nim',
							'$student_school_year',
							'$student_semester',
							'$open_start_date',
							'$open_end_date',
							'$create_date')");


            	$save2=mysqli_query($connect, "INSERT INTO master_student_history (
							student_history_id,
							student_nim,
							student_history_school_year,
							student_history_semester,
							student_history_status,
							create_date)
				VALUES ('$genid',
							'$student_nim',
							'$student_school_year',
							'$student_semester',
							'$student_status',
							'$create_date')");

            	if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
            }} else {
            	echo json_encode(array('status'=>'failed'));
            }		

			
			break;


		case 'open_majors':

			if ($open_start_date<=$open_end_date) {
            	
            $jumlah=0;
            $success=0;
            $failed=0;
            $data=mysqli_query($connect, "SELECT * FROM master_student where 
            		student_generation='$student_generation' AND 
            		college_code='$college_code' AND 
            		majors_code='$majors_code'");
            while ($row=mysqli_fetch_array($data)) {
            
            $student_nim=$row['student_nim'];


            $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM student_open_krs where 
            	student_nim='$student_nim' AND 
            	student_school_year='$student_school_year' AND 
            	student_semester='$student_semester'"));            
            
            if ($check>0) {
            	if ($change==1) {
            		$update=mysqli_query($connect, "UPDATE student_open_krs SET
								open_start_date='$open_start_date',
								open_end_date='$open_end_date'
					where student_nim='$student_nim' AND
						  student_school_year='$student_school_year' AND
						  student_semester='$student_semester'");

            		$update2=mysqli_query($connect, "UPDATE master_student_history SET
								student_history_status='$student_status'
					where student_nim='$student_nim' AND
						  student_history_school_year='$student_school_year' AND
						  student_history_semester='$student_semester'");


            		$failed++;
            		
            	} 
            } else {
            	
            	$save=mysqli_query($connect, "INSERT INTO student_open_krs (
							open_krs_id,
							student_nim,
							student_school_year,
							student_semester,
							open_start_date,
							open_end_date,
							create_date)
				VALUES ('$genid',
							'$student_nim',
							'$student_school_year',
							'$student_semester',
							'$open_start_date',
							'$open_end_date',
							'$create_date')");

            	$save2=mysqli_query($connect, "INSERT INTO master_student_history (
							student_history_id,
							student_nim,
							student_history_school_year,
							student_history_semester,
							student_history_status,
							create_date)
				VALUES ('$genid',
							'$student_nim',
							'$student_school_year',
							'$student_semester',
							'$student_status',
							'$create_date')");
            	
            	$success++;
            	
            } $jumlah++; }
            	echo json_encode(array('status'=>'success',
            						   'jumlah'=>$jumlah,
            						   'success'=>$success,
            						   'failed'=>$failed));

        	} else {
            	echo json_encode(array('status'=>'failed'));
            }

			break;
}



?>