<?php
session_start();

include "../../../config/connection.php";
$account_id=$_SESSION['account_id'];
$mhs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_student where account_id='$account_id'"));
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


$student_skpi_file_status		=htmlspecialchars(@$_POST['student_skpi_file_status']);
$student_skpi_file_title_ind 	=htmlspecialchars(@$_POST['student_skpi_file_title_ind']);
$student_skpi_file_title_ing 	=htmlspecialchars(@$_POST['student_skpi_file_title_ing']);
$student_skpi_file_institution	=htmlspecialchars(@$_POST['student_skpi_file_institution']);
$student_skpi_file_duration		=htmlspecialchars(@$_POST['student_skpi_file_duration']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {	

		case 'input':
        		
        $folderUpload = "../../../assets/student_skpi_file/".$account_id;

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}

		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $acak=substr(str_shuffle($permitted_chars), 0, 10);
		$ekstensi_diperbolehkan	= array('png','jpg','jpeg','pdf');
		$student_skpi_file = $acak.$_FILES['student_skpi_file']['name'];
		$x = explode('.', $student_skpi_file);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['student_skpi_file']['size'];
		$file_tmp = $_FILES['student_skpi_file']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){			
			    	$student_skpi_file = $acak.".pdf";
					move_uploaded_file($file_tmp, $folderUpload.'/'.$student_skpi_file);
        			$save=mysqli_query($connect,"INSERT INTO master_student_skpi_file
                      (student_skpi_file_id,
                      student_nim,
                      student_skpi_file,
                      student_skpi_file_status ,
                      student_skpi_file_title_ind,
                      student_skpi_file_title_ing,
                      student_skpi_file_institution,
                      student_skpi_file_duration,
                      create_date) VALUES 
                      ('$genid',
                      '$student_nim',
                      '$student_skpi_file',
                      '$student_skpi_file_status ',
                      '$student_skpi_file_title_ind',
                      '$student_skpi_file_title_ing',
                      '$student_skpi_file_institution',
                      '$student_skpi_file_duration',
                      '$create_date')");

        			 if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
				} else {
					echo json_encode(array('status'=>'failed'));
				}

        	} else {
        		echo json_encode(array('status'=>'failed'));
        	}
				

				break;	
		
		case 'edit':

				$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		        $acak=substr(str_shuffle($permitted_chars), 0, 10);
				$ekstensi_diperbolehkan	= array('png','jpg','jpeg','pdf');
				$student_skpi_file = $acak.$_FILES['student_skpi_file']['name'];
				$x = explode('.', $student_skpi_file);
				$ekstensi = strtolower(end($x));
				$ukuran	= $_FILES['student_skpi_file']['size'];
				$file_tmp = $_FILES['student_skpi_file']['tmp_name'];	
					if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					    if($ukuran < 1044070){			
					    	$student_skpi_file = $acak.".pdf";
							move_uploaded_file($file_tmp, $folderUpload.'/'.$student_skpi_file);
		        			$update=mysqli_query($connect,"UPDATE master_student_skpi_file	SET
		                      student_skpi_file='$student_skpi_file',
		                      student_skpi_file_status='$student_skpi_file_status ',
		                      student_skpi_file_title_ind='$student_skpi_file_title_ind',
		                      student_skpi_file_title_ing='$student_skpi_file_title_ing',
		                      student_skpi_file_institution='$student_skpi_file_institution',
		                      student_skpi_file_duration='$student_skpi_file_duration'
		                      where student_nim='$student_nim' AND 
		                      student_skpi_file_id='$id'");

		        			 if ($update) {
								echo json_encode(array('status'=>'success'));
							} else {			
								echo json_encode(array('status'=>'failed'));
							}
						} else {
							echo json_encode(array('status'=>'failed'));
						}

		        	} else {
		        			$update=mysqli_query($connect,"UPDATE master_student_skpi_file	SET
		                      student_skpi_file_status='$student_skpi_file_status ',
		                      student_skpi_file_title_ind='$student_skpi_file_title_ind',
		                      student_skpi_file_title_ing='$student_skpi_file_title_ing',
		                      student_skpi_file_institution='$student_skpi_file_institution',
		                      student_skpi_file_duration='$student_skpi_file_duration'
		                      where student_nim='$student_nim' AND 
		                      student_skpi_file_id='$id'");

		        			 if ($update) {
								echo json_encode(array('status'=>'success'));
							} else {			
								echo json_encode(array('status'=>'failed'));
							}
		        	}


			break;



		case 'remove':

			$remove=mysqli_query($connect, "DELETE FROM master_student_skpi_file 
						where student_skpi_file_id='$id' AND student_nim='$student_nim'");

			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>