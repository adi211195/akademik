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
$account_email		=htmlspecialchars(@$_POST['account_email']);
$account_photo 		=htmlspecialchars(@$_POST['account_photo']);

$user_name 			=htmlspecialchars(@$_POST['user_name']);
$user_phone			=htmlspecialchars(@$_POST['user_phone']);
$user_gender		=htmlspecialchars(@$_POST['user_gender']);
$user_place_birth	=htmlspecialchars(@$_POST['user_place_birth']);
$user_date_birth	=htmlspecialchars(@$_POST['user_date_birth']);
$user_address		=htmlspecialchars(@$_POST['user_address']);
$user_city			=htmlspecialchars(@$_POST['user_city']);
$user_poscode		=htmlspecialchars(@$_POST['user_poscode']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		

		case 'edit':

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

			if (!empty($account_photo)) {
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $folderUpload.'/'.$account_photo);
					$update=mysqli_query($connect, "UPDATE account SET	
									
						account_photo='$account_photo',
						account_email='$account_email',						
						create_date='$create_date' 
						where account_id='$id'");

					$user=mysqli_query($connect, "UPDATE master_user SET
								user_name='$user_name',
								user_phone='$user_phone',
								user_gender='$user_gender',
								user_place_birth='$user_place_birth',
								user_date_birth='$user_date_birth',
								user_address='$user_address',
								user_city='$user_city',
								user_poscode='$user_poscode',
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
		      	 		account_email='$account_email',						
						create_date='$create_date' 
						where account_id='$id'");

					$user=mysqli_query($connect, "UPDATE master_user SET
								user_name='$user_name',
								user_phone='$user_phone',
								user_gender='$user_gender',
								user_place_birth='$user_place_birth',
								user_date_birth='$user_date_birth',
								user_address='$user_address',
								user_city='$user_city',
								user_poscode='$user_poscode',
								create_date='$create_date' 
					where account_id='$id'");


					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
		      }




			
			
			break;

	

}



?>