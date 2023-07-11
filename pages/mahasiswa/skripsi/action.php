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


$skripsi_title			=htmlspecialchars(@$_POST['skripsi_title']);
$skripsi_abstract		=@$_POST['skripsi_abstract'];
$skripsi_file_status	=htmlspecialchars(@$_POST['skripsi_file_status']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {	
		
		case 'title':
			$cek=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_skripsi WHERE student_nim='$student_nim'"));
			if ($cek>0) {
			
					$save=mysqli_query($connect, "UPDATE master_skripsi SET
			    			skripsi_title='$skripsi_title',
			    			create_date='$create_date'
			    			where student_nim='$student_nim'");	
				

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
					

			} else {

					$save=mysqli_query($connect, "INSERT INTO master_skripsi (skripsi_id,
			    			student_nim,
			    			create_date)
			    			VALUES ('$genid',
			    					'$student_nim',
			    					'$create_date')");	

					$save=mysqli_query($connect, "UPDATE master_skripsi SET
			    			skripsi_title='$skripsi_title',
			    			create_date='$create_date'
			    			where student_nim='$student_nim'");	
				

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}

			}

			break;

		case 'abstract':
			$cek=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_skripsi WHERE student_nim='$student_nim'"));
			if ($cek>0) {
			
					$save=mysqli_query($connect, "UPDATE master_skripsi SET
			    			skripsi_abstract='$skripsi_abstract',
			    			create_date='$create_date'
			    			where student_nim='$student_nim'");	
				

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
					

			} else {

					$save=mysqli_query($connect, "INSERT INTO master_skripsi (skripsi_id,
			    			student_nim,
			    			create_date)
			    			VALUES ('$genid',
			    					'$student_nim',
			    					'$create_date')");	

					$save=mysqli_query($connect, "UPDATE master_skripsi SET
			    			skripsi_abstract='$skripsi_abstract',
			    			create_date='$create_date'
			    			where student_nim='$student_nim'");	
				

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}

			}

			break;


		case 'file':

			$folderUpload = "../../../assets/skripsi_file/".$account_id;

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}


					$ekstensi_diperbolehkan	= array('pdf');
					$skripsi_file = $_FILES['skripsi_file']['name'];
					$x = explode('.', $skripsi_file);
					$ekstensi = strtolower(end($x));
					$ukuran	= $_FILES['skripsi_file']['size'];
					$file_tmp = $_FILES['skripsi_file']['tmp_name'];	
					if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
					    if($ukuran < 1044070){		
					    $skripsi_file = $genid."".$skripsi_file_status.".pdf";	
						move_uploaded_file($file_tmp, $folderUpload.'/'.$skripsi_file);

						$remove=mysqli_query($connect,"DELETE FROM master_skripsi_file where 
							student_nim='$student_nim' AND 
							skripsi_file_status='$skripsi_file_status'");

						$save=mysqli_query($connect, "INSERT INTO master_skripsi_file
							(skripsi_file_id,
							skripsi_file,
							skripsi_file_status,
							student_nim,
							create_date)
							VALUES ('$genid',
								'$skripsi_file',
								'$skripsi_file_status',
								'$student_nim',
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


}



?>