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


$alumni_home_campus 	=htmlspecialchars(@$_POST['alumni_home_campus']);
$alumni_home_address 	=htmlspecialchars(@$_POST['alumni_home_address']);
$alumni_home_phone 		=htmlspecialchars(@$_POST['alumni_home_phone']);
$alumni_home_handphone  =htmlspecialchars(@$_POST['alumni_home_handphone']);
$alumni_home_email 		=htmlspecialchars(@$_POST['alumni_home_email']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {

		case 'edit':
			$folderUpload = "../../../assets/alumni_home_logo";

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}

			$ekstensi_diperbolehkan	= array('png','jpg');
			$alumni_home_logo = $_FILES['alumni_home_logo']['name'];
			$x = explode('.', $alumni_home_logo);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['alumni_home_logo']['size'];
			$file_tmp = $_FILES['alumni_home_logo']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_home_logo);

					$update=mysqli_query($connect, "UPDATE master_alumni_home SET	
						alumni_home_campus='$alumni_home_campus',
						alumni_home_address='$alumni_home_address',
						alumni_home_phone='$alumni_home_phone',
						alumni_home_handphone='$alumni_home_handphone',
						alumni_home_email='$alumni_home_email',
						alumni_home_logo='$alumni_home_logo',
						create_date='$create_date' 
						where alumni_home_id='$id'");
					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}


			    }else{
					echo json_encode(array('status'=>'failed'));
			    }

		      } else {

		      		$update=mysqli_query($connect, "UPDATE master_alumni_home SET	
						alumni_home_campus='$alumni_home_campus',
						alumni_home_address='$alumni_home_address',
						alumni_home_phone='$alumni_home_phone',
						alumni_home_handphone='$alumni_home_handphone',
						alumni_home_email='$alumni_home_email',
						create_date='$create_date' 
						where alumni_home_id='$id'");
					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
					
		      }


			
			
			break;


}



?>