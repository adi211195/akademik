<?php
session_start();

include "../../../config/connection.php";
$account_id=$_SESSION['account_id'];
$mhs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_student where account_id='$account_id'"));
$student_nim=$mhs['student_nim'];

$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
// Genrate ID
$genid=substr(str_shuffle($genrate_id), 0, 14);
$genid2=substr(str_shuffle($genrate_id), 0, 14);

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


$mail_account   =$student_nim."@stdi.mail";
$mail_sent		=htmlspecialchars(@$_POST['mail_sent']);
$mail_subject 	=htmlspecialchars(@$_POST['mail_subject']);
$mail_post	 	= @$_POST['mail_post'];
$draft	 		=htmlspecialchars(@$_POST['draft']);
$mail_file		=htmlspecialchars(@$_POST['mail_file']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {	

		case 'register':
				
				$save=mysqli_query($connect, "INSERT INTO mail_account (account_id,
							mail_account,
			    			mail_account_status,
			    			create_date)
			    			VALUES ('$account_id',
			    					'$mail_account',
			    					'Student',
			    					'$create_date')");

				if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}

				break;	
		
		case 'send':	

			$folderUpload = "../../../assets/mail_file/".$account_id;

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}

			if (empty($draft)) {
				$mail_status="Sent";
			} else {
				$mail_status="Draft";
			}


			$check=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM mail_account where mail_account='$mail_sent'"));
			if ($check>0) {
			if ($mail_account!=$mail_sent) {
			
			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$mail_file = $_FILES['mail_file']['name'];
			$x = explode('.', $mail_file);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['mail_file']['size'];
			$file_tmp = $_FILES['mail_file']['tmp_name'];	
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $folderUpload.'/'.$mail_file);

					$save=mysqli_query($connect, "INSERT INTO mail_file (mail_id,
							mail_account,
			    			mail_file_id,
			    			mail_file_name,
			    			mail_file_size,
			    			mail_file_type,
			    			create_date)
			    			VALUES ('$genid',
			    					'$mail_account',
			    					'$genid2',
			    					'$mail_file',
			    					'$ukuran',
			    					'$ekstensi',
			    					'$create_date')");

					$save=mysqli_query($connect, "INSERT INTO mail_academic_sent (mail_id,
			    			mail_account,
			    			mail_sent,
			    			mail_subject,
			    			mail_post,
			    			mail_view,
			    			mail_status,
			    			create_date)
			    			VALUES ('$genid',
			    					'$mail_account',
			    					'$mail_sent',
			    					'$mail_subject',
			    					'$mail_post',
			    					'1',
			    					'$mail_status',
			    					'$create_date')");

					$save=mysqli_query($connect, "INSERT INTO mail_academic_accepted (mail_id,
			    			mail_account,
			    			mail_sent,
			    			mail_subject,
			    			mail_post,
			    			mail_view,
			    			mail_status,
			    			create_date)
			    			VALUES ('$genid',
			    					'$mail_account',
			    					'$mail_sent',
			    					'$mail_subject',
			    					'$mail_post',
			    					'0',
			    					'$mail_status',
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
					$save=mysqli_query($connect, "INSERT INTO mail_academic_sent (mail_id,
			    			mail_account,
			    			mail_sent,
			    			mail_subject,
			    			mail_post,
			    			mail_view,
			    			mail_status,
			    			create_date)
			    			VALUES ('$genid',
			    					'$mail_account',
			    					'$mail_sent',
			    					'$mail_subject',
			    					'$mail_post',
			    					'1',
			    					'$mail_status',
			    					'$create_date')");

					$save=mysqli_query($connect, "INSERT INTO mail_academic_accepted (mail_id,
			    			mail_account,
			    			mail_sent,
			    			mail_subject,
			    			mail_post,
			    			mail_view,
			    			mail_status,
			    			create_date)
			    			VALUES ('$genid',
			    					'$mail_account',
			    					'$mail_sent',
			    					'$mail_subject',
			    					'$mail_post',
			    					'0',
			    					'$mail_status',
			    					'$create_date')");

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
		      }

		  } else {
			echo json_encode(array('status'=>'failed'));
		  }} else {
			echo json_encode(array('status'=>'failed'));
		  }



				
			
			break;

		

		case 'draft':	

			$folderUpload = "../../../assets/mail_file/".$account_id;

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}

			if (empty($draft)) {
				$mail_status="Sent";
			} else {
				$mail_status="Draft";
			}


			$check=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM mail_account where mail_account='$mail_sent'"));
			if ($check>0) {
			if ($mail_account!=$mail_sent) {
			
			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$mail_file = $_FILES['mail_file']['name'];
			$x = explode('.', $mail_file);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['mail_file']['size'];
			$file_tmp = $_FILES['mail_file']['tmp_name'];	
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $folderUpload.'/'.$mail_file);
					$remove=mysqli_query($connect, "DELETE FROM mail_file 
						where mail_id='$id'");
					$remove=mysqli_query($connect, "DELETE FROM mail_academic_sent 
						where mail_id='$id'");
					$remove=mysqli_query($connect, "DELETE FROM mail_academic_accepted 
						where mail_id='$id'");

					$save=mysqli_query($connect, "INSERT INTO mail_file (mail_id,
							mail_account,
			    			mail_file_id,
			    			mail_file_name,
			    			mail_file_size,
			    			mail_file_type,
			    			create_date)
			    			VALUES ('$id',
			    					'$mail_account',
			    					'$genid2',
			    					'$mail_file',
			    					'$ukuran',
			    					'$ekstensi',
			    					'$create_date')");

					$save=mysqli_query($connect, "INSERT INTO mail_academic_sent (mail_id,
			    			mail_account,
			    			mail_sent,
			    			mail_subject,
			    			mail_post,
			    			mail_view,
			    			mail_status,
			    			create_date)
			    			VALUES ('$id',
			    					'$mail_account',
			    					'$mail_sent',
			    					'$mail_subject',
			    					'$mail_post',
			    					'1',
			    					'$mail_status',
			    					'$create_date')");

					$save=mysqli_query($connect, "INSERT INTO mail_academic_accepted (mail_id,
			    			mail_account,
			    			mail_sent,
			    			mail_subject,
			    			mail_post,
			    			mail_view,
			    			mail_status,
			    			create_date)
			    			VALUES ('$id',
			    					'$mail_account',
			    					'$mail_sent',
			    					'$mail_subject',
			    					'$mail_post',
			    					'0',
			    					'$mail_status',
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
		      		$remove=mysqli_query($connect, "DELETE FROM mail_academic_sent 
						where mail_id='$id'");
					$remove=mysqli_query($connect, "DELETE FROM mail_academic_accepted 
						where mail_id='$id'");
					$save=mysqli_query($connect, "INSERT INTO mail_academic_sent (mail_id,
			    			mail_account,
			    			mail_sent,
			    			mail_subject,
			    			mail_post,
			    			mail_view,
			    			mail_status,
			    			create_date)
			    			VALUES ('$id',
			    					'$mail_account',
			    					'$mail_sent',
			    					'$mail_subject',
			    					'$mail_post',
			    					'1',
			    					'$mail_status',
			    					'$create_date')");

					$save=mysqli_query($connect, "INSERT INTO mail_academic_accepted (mail_id,
			    			mail_account,
			    			mail_sent,
			    			mail_subject,
			    			mail_post,
			    			mail_view,
			    			mail_status,
			    			create_date)
			    			VALUES ('$id',
			    					'$mail_account',
			    					'$mail_sent',
			    					'$mail_subject',
			    					'$mail_post',
			    					'0',
			    					'$mail_status',
			    					'$create_date')");

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
		      }

		  } else {
			echo json_encode(array('status'=>'failed'));
		  }} else {
			echo json_encode(array('status'=>'failed'));
		  }



				
			
			break;

		case 'reply':
			$save=mysqli_query($connect, "INSERT INTO mail_academic_sent (mail_id,
			    			mail_account,
			    			mail_sent,
			    			mail_subject,
			    			mail_post,
			    			mail_view,
			    			mail_reply,
			    			mail_status,
			    			create_date)
			    			VALUES ('$id',
			    					'$mail_account',
			    					'$mail_sent',
			    					'$mail_subject',
			    					'$mail_post',
			    					'1',
			    					'$id'
			    					'Sent',
			    					'$create_date')");

					$save=mysqli_query($connect, "INSERT INTO mail_academic_accepted (mail_id,
			    			mail_account,
			    			mail_sent,
			    			mail_subject,
			    			mail_post,
			    			mail_view,
			    			mail_status,
			    			create_date)
			    			VALUES ('$id',
			    					'$mail_account',
			    					'$mail_sent',
			    					'$mail_subject',
			    					'$mail_post',
			    					'0',
			    					'Sent',
			    					'$create_date')");

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
			break;

		case 'trash':			

			$trash=mysqli_query($connect, "UPDATE mail_academic_accepted SET
						mail_status='Trash'
						where mail_id='$id' AND mail_account='$mail_account'");
			
			if ($trash) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;


		case 'trash_send':			

			$trash=mysqli_query($connect, "UPDATE mail_academic_sent SET
						mail_status='Trash'
						where mail_id='$id' AND mail_sent='$mail_account'");
			
			if ($trash) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;



		case 'remove':
			

			$remove=mysqli_query($connect, "DELETE FROM mail_academic_accepted
						where mail_id='$id' AND mail_account='$mail_account'");
			
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>