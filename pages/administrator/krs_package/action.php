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

if (empty(@$_GET['student_nim'])) {
	$student_nim			=htmlspecialchars(@$_POST['student_nim']);
} else {
	$student_nim			=htmlspecialchars(@$_GET['student_nim']);
}

if (empty(@$_GET['krs_package_id'])) {
	$krs_package_id			=htmlspecialchars(@$_POST['krs_package_id']);
} else {
	$krs_package_id			=htmlspecialchars(@$_GET['krs_package_id']);
}


$create_date	=date('Y-m-d H:i:s');

switch ($action) {		
		
		case 'choose':		

				$data=mysqli_query($connect, "SELECT * FROM schedule_package 
					LEFT JOIN master_curriculum ON master_curriculum.curriculum_id=schedule_package.curriculum_id
					 where schedule_id='$id'");
				while ($row=mysqli_fetch_array($data)) {
					$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					// Genrate ID
					$genid2=substr(str_shuffle($genrate_id), 0, 14);


					$save2=mysqli_query($connect, "INSERT INTO master_krs (krs_id,
			    			curriculum_id,
			    			student_nim,
			    			krs_school_year,
			    			krs_semester,
			    			krs_approved,
			    			krs_package_id,
			    			create_date)
			    			VALUES ('$genid2',
			    					'$row[curriculum_id]',
			    					'$student_nim',
			    					'$row[curriculum_school_year]',
			    					'$row[curriculum_semester]',
			    					'Approved',
			    					'$genid',
			    					'$create_date')");

					
				}

				
				$remove=mysqli_query($connect, "DELETE FROM master_krs 
						where krs_package_id='$krs_package_id'");
				$remove=mysqli_query($connect, "DELETE FROM master_krs_package
						where krs_package_id='$krs_package_id'");

				$save=mysqli_query($connect, "INSERT INTO master_krs_package (krs_package_id,
			    			schedule_id,
			    			student_nim,
			    			create_date)
			    			VALUES ('$genid',
			    					'$id',
			    					'$student_nim',
			    					'$create_date')");

				if ($save) {
					echo json_encode(array('status'=>'success'));
				} else {			
					echo json_encode(array('status'=>'failed'));
				}
			
			break;

		

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_krs 
						where krs_package_id='$id'");
			$remove=mysqli_query($connect, "DELETE FROM master_krs_package
						where krs_package_id='$id'");
			
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>