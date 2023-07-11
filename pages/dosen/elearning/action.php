<?php
session_start();

include "../../../config/connection.php";
$account_id=$_SESSION['account_id'];


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


$curriculum_id				=htmlspecialchars(@$_POST['curriculum_id']);
$elearning_id			=htmlspecialchars(@$_POST['elearning_id']);
$elearning_file			=htmlspecialchars(@$_POST['elearning_file']);
$account_username		=htmlspecialchars(@$_POST['account_username']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {	

		case 'file':
			$folderUpload = "../../../assets/elearning_file/".$account_id;

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}


			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$elearning_file = $_FILES['elearning_file']['name'];
			$x = explode('.', $elearning_file);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['elearning_file']['size'];
			$file_tmp = $_FILES['elearning_file']['tmp_name'];	
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $folderUpload.'/'.$elearning_file);

					$save=mysqli_query($connect, "INSERT INTO elearning (elearning_id,
			    			account_id,
			    			curriculum_id,
			    			elearning_file,
			    			elearning_size,
			    			elearning_type,
			    			create_date)
			    			VALUES ('$genid',
			    					'$account_id',
			    					'$curriculum_id',
			    					'$elearning_file',
			    					'$ukuran',
			    					'$ekstensi',
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


			

			case 'remove':
			
			$elearning =mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM elearning
						where elearning_id='$id' AND account_id='$account_id'"));

			unlink("../../../assets/elearning_file/".$account_id."/".$elearning['elearning_file']);

			$remove=mysqli_query($connect, "DELETE FROM elearning_shared
						where elearning_id='$id' AND account_id='$account_id'");

			$remove=mysqli_query($connect, "DELETE FROM elearning
						where elearning_id='$id' AND account_id='$account_id'");
			
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

		


}



?>