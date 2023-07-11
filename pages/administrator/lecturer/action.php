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

$account_username	=htmlspecialchars(@$_POST['account_username']);
$account_password	=md5(@$_POST['account_password']);
$account_email		=htmlspecialchars(@$_POST['account_email']);
$account_block		=htmlspecialchars(@$_POST['account_block']);
$account_photo 		=htmlspecialchars(@$_POST['account_photo']);

$lecturer_code 			=htmlspecialchars(@$_POST['lecturer_code']);
$lecturer_name 			=htmlspecialchars(@$_POST['lecturer_name']);
$lecturer_phone			=htmlspecialchars(@$_POST['lecturer_phone']);
$lecturer_gender		=htmlspecialchars(@$_POST['lecturer_gender']);
$lecturer_place_birth	=htmlspecialchars(@$_POST['lecturer_place_birth']);
$lecturer_date_birth	=htmlspecialchars(@$_POST['lecturer_date_birth']);
$lecturer_address		=htmlspecialchars(@$_POST['lecturer_address']);
$lecturer_city			=htmlspecialchars(@$_POST['lecturer_city']);
$lecturer_poscode		=htmlspecialchars(@$_POST['lecturer_poscode']);

$lecturer_status		=htmlspecialchars(@$_POST['lecturer_status']);
$lecturer_certification	=htmlspecialchars(@$_POST['lecturer_certification']);
$lecturer_functional	=htmlspecialchars(@$_POST['lecturer_functional']);
$lecturer_nidk			=htmlspecialchars(@$_POST['lecturer_nidk']);
$lecturer_nidn			=htmlspecialchars(@$_POST['lecturer_nidn']);
$lecturer_nup			=htmlspecialchars(@$_POST['lecturer_nup']);
$lecturer_education		=htmlspecialchars(@$_POST['lecturer_education']);
$lecturer_position		=htmlspecialchars(@$_POST['lecturer_position']);
$lecturer_specialist	=htmlspecialchars(@$_POST['lecturer_specialist']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

		$folderUpload = "../../../assets/account_photo";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}


		$ekstensi_diperbolehkan	= array('png','jpg');
		$account_photo = $_FILES['account_photo']['name'];
		$x = explode('.', $account_photo);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['account_photo']['size'];
		$file_tmp = $_FILES['account_photo']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, $folderUpload.'/'.$account_photo);
					$save=mysqli_query($connect, "INSERT INTO account (
							account_id,
							account_block,
							account_photo,
							account_password,
							account_username,
							account_email,
							account_status,
							create_date)
					VALUES ('$genid',
							'$account_block',
							'$account_photo',
							'$account_password',
							'$account_username',
							'$account_email',
							'Dosen',
							'$create_date')");

					$lecturer=mysqli_query($connect, "INSERT INTO master_lecturer (
								account_id,
								lecturer_name,
								lecturer_code,
								lecturer_phone,
								lecturer_gender,
								lecturer_place_birth,
								lecturer_date_birth,
								lecturer_address,
								lecturer_city,
								lecturer_poscode,

								lecturer_status,
								lecturer_certification,
								lecturer_functional,
								lecturer_nidn,
								lecturer_nidk,
								lecturer_nup,
								lecturer_education,
								lecturer_position,
								lecturer_specialist,
								create_date)
						VALUES ('$genid',
								'$lecturer_name',
								'$lecturer_code',
								'$lecturer_phone',
								'$lecturer_gender',
								'$lecturer_place_birth',
								'$lecturer_date_birth',
								'$lecturer_address',
								'$lecturer_city',
								'$lecturer_poscode'

								'$lecturer_status',
								'$lecturer_certification',
								'$lecturer_functional',
								'$lecturer_nidn',
								'$lecturer_nidk',
								'$lecturer_nup',
								'$lecturer_education',
								'$lecturer_position',
								'$lecturer_specialist',
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

			$folderUpload = "../../../assets/account_photo";

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}

			if (!empty($account_password)) {
				$update=mysqli_query($connect, "UPDATE account SET	
						account_password='$account_password'
						where account_id='$id'");
			} 

			$ekstensi_diperbolehkan	= array('png','jpg');
			$account_photo = $_FILES['account_photo']['name'];
			$x = explode('.', $account_photo);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['account_photo']['size'];
			$file_tmp = $_FILES['account_photo']['tmp_name'];	

			if (!empty($account_photo)) {
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $folderUpload.'/'.$account_photo);
					$update=mysqli_query($connect, "UPDATE account SET	
						account_block='$account_block',					
						account_photo='$account_photo',
						account_username='$account_username',
						account_email='$account_email',						
						create_date='$create_date' 
						where account_id='$id'");

					$lecturer=mysqli_query($connect, "UPDATE master_lecturer SET
								lecturer_name='$lecturer_name',
								lecturer_code='$lecturer_code',
								lecturer_phone='$lecturer_phone',
								lecturer_gender='$lecturer_gender',
								lecturer_place_birth='$lecturer_place_birth',
								lecturer_date_birth='$lecturer_date_birth',
								lecturer_address='$lecturer_address',
								lecturer_city='$lecturer_city',
								lecturer_poscode='$lecturer_poscode',

								lecturer_status='$lecturer_status',
								lecturer_certification='$lecturer_certification',
								lecturer_functional='$lecturer_functional',
								lecturer_nidn='$lecturer_nidn',
								lecturer_nidk='$lecturer_nidk',
								lecturer_nup='$lecturer_nup',
								lecturer_education='$lecturer_education',
								lecturer_position='$lecturer_position',
								lecturer_specialist='$lecturer_specialist',

								create_date='$create_date' 
					where account_id='$id'");


					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}

			    }else{
					echo json_encode(array('status'=>'failed'));
			    }

		      } else {
				echo json_encode(array('status'=>'failed'));
		      }} else {
		      	 $update=mysqli_query($connect, "UPDATE account SET	
						account_block='$account_block',	
						account_username='$account_username',
						account_email='$account_email',						
						create_date='$create_date' 
						where account_id='$id'");

					$lecturer=mysqli_query($connect, "UPDATE master_lecturer SET
								lecturer_code='$lecturer_code',
								lecturer_name='$lecturer_name',
								lecturer_phone='$lecturer_phone',
								lecturer_gender='$lecturer_gender',
								lecturer_place_birth='$lecturer_place_birth',
								lecturer_date_birth='$lecturer_date_birth',
								lecturer_address='$lecturer_address',
								lecturer_city='$lecturer_city',
								lecturer_poscode='$lecturer_poscode',

								lecturer_status='$lecturer_status',
								lecturer_certification='$lecturer_certification',
								lecturer_functional='$lecturer_functional',
								lecturer_nidn='$lecturer_nidn',
								lecturer_nidk='$lecturer_nidk',
								lecturer_nup='$lecturer_nup',
								lecturer_education='$lecturer_education',
								lecturer_position='$lecturer_position',
								lecturer_specialist='$lecturer_specialist',
								
								create_date='$create_date' 
					where account_id='$id'");


					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
		      }




			
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM account 
						where account_id='$id'");

			$lecturer=mysqli_query($connect, "DELETE FROM master_lecturer
						where account_id='$id'");


			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>