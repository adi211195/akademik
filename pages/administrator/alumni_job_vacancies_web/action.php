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


$alumni_job_vacancies_web_title 	=htmlspecialchars(@$_POST['alumni_job_vacancies_web_title']);
$alumni_job_vacancies_web_url 		=htmlspecialchars(@$_POST['alumni_job_vacancies_web_url']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

		$folderUpload = "../../../assets/alumni_job_vacancies_web_logo";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}

		$ekstensi_diperbolehkan	= array('png','jpg');
		$alumni_job_vacancies_web_logo = $_FILES['alumni_job_vacancies_web_logo']['name'];
		$x = explode('.', $alumni_job_vacancies_web_logo);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['alumni_job_vacancies_web_logo']['size'];
		$file_tmp = $_FILES['alumni_job_vacancies_web_logo']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_job_vacancies_web_logo);

					$save=mysqli_query($connect, "INSERT INTO master_alumni_job_vacancies_web (
						alumni_job_vacancies_web_id,
						alumni_job_vacancies_web_title,
						alumni_job_vacancies_web_url,
						alumni_job_vacancies_web_logo,
						create_date)
				VALUES ('$genid',
						'$alumni_job_vacancies_web_title',
						'$alumni_job_vacancies_web_url',
						'$alumni_job_vacancies_web_logo',
						'$create_date')");
				if ($save) {
					echo json_encode(array('status'=>'success'));
				} else {			
					echo json_encode(array('status'=>'failed'));
				}


			    }else{
					echo json_encode(array('status'=>'failed'));
			    }

		      } else {

		      			
					echo json_encode(array('status'=>'failed'));
					
		      }


			
			
			break;

		case 'edit':

			$ekstensi_diperbolehkan	= array('png','jpg');
			$alumni_job_vacancies_web_logo = $_FILES['alumni_job_vacancies_web_logo']['name'];
			$x = explode('.', $alumni_job_vacancies_web_logo);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['alumni_job_vacancies_web_logo']['size'];
			$file_tmp = $_FILES['alumni_job_vacancies_web_logo']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_job_vacancies_web_logo);

					$update=mysqli_query($connect, "UPDATE master_alumni_job_vacancies_web SET	
						alumni_job_vacancies_web_title='$alumni_job_vacancies_web_title',
						alumni_job_vacancies_web_url='$alumni_job_vacancies_web_url',
						alumni_job_vacancies_web_logo='$alumni_job_vacancies_web_logo',
						create_date='$create_date' 
						where alumni_job_vacancies_web_id='$id'");
					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}


			    }else{
					echo json_encode(array('status'=>'failed'));
			    }

		      } else {

		      		$update=mysqli_query($connect, "UPDATE master_alumni_job_vacancies_web SET	
						alumni_job_vacancies_web_title='$alumni_job_vacancies_web_title',
						alumni_job_vacancies_web_url='$alumni_job_vacancies_web_url',
						create_date='$create_date' 
						where alumni_job_vacancies_web_id='$id'");
					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
					
		      }


			
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_alumni_job_vacancies_web  
						where alumni_job_vacancies_web_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>