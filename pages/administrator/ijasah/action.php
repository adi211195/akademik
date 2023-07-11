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

$ijasah_date			=htmlspecialchars(@$_POST['ijasah_date']);
$ijasah_concentration	=htmlspecialchars(@$_POST['ijasah_concentration']);
$ijasah_number			=htmlspecialchars(@$_POST['ijasah_number']);

$student_name 		=htmlspecialchars(@$_POST['student_name']);
$student_generation =htmlspecialchars(@$_POST['student_generation']);
$college_code		=htmlspecialchars(@$_POST['college_code']);
$majors_code 		=htmlspecialchars(@$_POST['majors_code']);


$create_date	=date('Y-m-d H:i:s');

switch ($action) {	

		case 'input':

			$student=explode("|", $student_name);
            $student_nim=$student[0];

            $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_ijasah where 
            	student_nim='$student_nim'"));
            
            if ($check==0) {


            		$save=mysqli_query($connect, "INSERT INTO master_ijasah 
            			(ijasah_id,
            			student_nim,
            			ijasah_number,
            			ijasah_date,
            			ijasah_concentration,
            			create_date)
            			VALUES ('$genid',
            			'$student_nim',
            			'$ijasah_number',
            			'$ijasah_date',
            			'$ijasah_concentration',
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


		case 'edit':

			$student=explode("|", $student_name);
            $student_nim=$student[0];

					$update=mysqli_query($connect, "UPDATE master_ijasah SET 
            			ijasah_number='$ijasah_number',
            			ijasah_date='$ijasah_date',
            			ijasah_concentration='$ijasah_concentration',
            			create_date='$create_date' where student_nim='$student_nim'");

            		if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}

			break;


		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_ijasah
						where ijasah_id='$id'");


			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;
}



?>