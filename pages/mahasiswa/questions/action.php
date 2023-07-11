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


$questions_id			=htmlspecialchars(@$_POST['questions_id']);
$answer_file			=htmlspecialchars(@$_POST['answer_file']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {	

		case 'input':
			$folderUpload = "../../../assets/answer_file/".$account_id;

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}


			$ekstensi_diperbolehkan	= array('png','jpg','jpeg','pdf');
			$answer_file = $_FILES['answer_file']['name'];
			$x = explode('.', $answer_file);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['answer_file']['size'];
			$file_tmp = $_FILES['answer_file']['tmp_name'];	
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){	

				    $answer =mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questions_answer
						where student_nim='$student_nim' AND questions_id='$questions_id'"));

				    if (!empty($answer['answer_file'])) {
				    	unlink("../../../assets/answer_file/".$account_id."/".$answer['answer_file']);
				    	$remove=mysqli_query($connect,"DELETE FROM questions_answer where student_nim='$student_nim' AND questions_id='$questions_id'");
				    }
					

					

					move_uploaded_file($file_tmp, $folderUpload.'/'.$answer_file);

					$save=mysqli_query($connect, "INSERT INTO questions_answer (answer_id,
			    			questions_id,
			    			answer_file,
			    			student_nim,
			    			create_date)
			    			VALUES ('$genid',
			    					'$questions_id',
			    					'$answer_file',
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