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


$cooperation_partner 		=htmlspecialchars(@$_POST['cooperation_partner']);
$cooperation_status 		=htmlspecialchars(@$_POST['cooperation_status']);
$cooperation_internasional 	=htmlspecialchars(@$_POST['cooperation_internasional']);
$cooperation_nasional 		=htmlspecialchars(@$_POST['cooperation_nasional']);
$cooperation_lokal 			=htmlspecialchars(@$_POST['cooperation_lokal']);
$cooperation_title 			=htmlspecialchars(@$_POST['cooperation_title']);
$cooperation_benefits 		=htmlspecialchars(@$_POST['cooperation_benefits']);
$cooperation_time 			=htmlspecialchars(@$_POST['cooperation_time']);
$cooperation_over 			=htmlspecialchars(@$_POST['cooperation_over']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

		$folderUpload = "../../../assets/cooperation_proof";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}

		$ekstensi_diperbolehkan	= array('png','jpg','pdf');
		$cooperation_proof = $_FILES['cooperation_proof']['name'];
		$x = explode('.', $cooperation_proof);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['cooperation_proof']['size'];
		$file_tmp = $_FILES['cooperation_proof']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, $folderUpload.'/'.$cooperation_proof);

					$save=mysqli_query($connect, "INSERT INTO master_cooperation (
						cooperation_id,
						cooperation_partner,
						cooperation_status,
						cooperation_internasional,
						cooperation_nasional,
						cooperation_lokal,
						cooperation_title,
						cooperation_benefits,
						cooperation_time,
						cooperation_over,
						cooperation_proof,
						create_date)
				VALUES ('$genid',
						'$cooperation_partner',
						'$cooperation_status',
						'$cooperation_internasional',
						'$cooperation_nasional',
						'$cooperation_lokal',
						'$cooperation_title',
						'$cooperation_benefits',
						'$cooperation_time',
						'$cooperation_over',
						'$cooperation_proof',
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

			$ekstensi_diperbolehkan	= array('png','jpg','pdf');
			$cooperation_proof = $_FILES['cooperation_proof']['name'];
			$x = explode('.', $cooperation_proof);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['cooperation_proof']['size'];
			$file_tmp = $_FILES['cooperation_proof']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, $folderUpload.'/'.$cooperation_proof);

					$update=mysqli_query($connect, "UPDATE master_cooperation SET	
						cooperation_partner='$cooperation_partner',
						cooperation_internasional='$cooperation_internasional',
						cooperation_nasional='$cooperation_nasional',
						cooperation_lokal='$cooperation_lokal',
						cooperation_title='$cooperation_title',
						cooperation_benefits='$cooperation_benefits',
						cooperation_time='$cooperation_time',
						cooperation_over='$cooperation_over',
						cooperation_proof='$cooperation_proof',
						create_date='$create_date' 
						where cooperation_id='$id'");
					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}


			    }else{
					echo json_encode(array('status'=>'failed'));
			    }

		      } else {

		      		$update=mysqli_query($connect, "UPDATE master_cooperation SET	
						cooperation_partner='$cooperation_partner',
						cooperation_internasional='$cooperation_internasional',
						cooperation_nasional='$cooperation_nasional',
						cooperation_lokal='$cooperation_lokal',
						cooperation_title='$cooperation_title',
						cooperation_benefits='$cooperation_benefits',
						cooperation_time='$cooperation_time',
						cooperation_over='$cooperation_over',
						create_date='$create_date' 
						where cooperation_id='$id'");
					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
					
		      }


			
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_cooperation  
						where cooperation_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>