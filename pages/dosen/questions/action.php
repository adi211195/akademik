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


$curriculum_id			=htmlspecialchars(@$_POST['curriculum_id']);
$questions_information	=htmlspecialchars(@$_POST['questions_information']);
$questions_file			=htmlspecialchars(@$_POST['questions_file']);
$questions_type			=htmlspecialchars(@$_POST['questions_type']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {	

		case 'input':
			$folderUpload = "../../../assets/questions_file/".$account_id;

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}


			$ekstensi_diperbolehkan	= array('png','jpg','jpeg','pdf');
			$questions_file = $_FILES['questions_file']['name'];
			$x = explode('.', $questions_file);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['questions_file']['size'];
			$file_tmp = $_FILES['questions_file']['tmp_name'];	
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $folderUpload.'/'.$questions_file);

					$save=mysqli_query($connect, "INSERT INTO questions (questions_id,
			    			curriculum_id,
			    			questions_file,
			    			questions_information,
			    			questions_type,
			    			create_date)
			    			VALUES ('$genid',
			    					'$curriculum_id',
			    					'$questions_file',
			    					'$questions_information',
			    					'$questions_type',
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
			
			$questions =mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questions
						where questions_id='$id'"));

			unlink("../../../assets/questions_file/".$account_id."/".$questions['questions_file']);


			$remove=mysqli_query($connect, "DELETE FROM questions
						where questions_id='$id'");
			
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

		


}



?>