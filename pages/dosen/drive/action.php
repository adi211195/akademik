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


$folder_name	=htmlspecialchars(@$_POST['folder_name']);
$folder_id		=htmlspecialchars(@$_POST['folder_id']);
$drive_id		=htmlspecialchars(@$_POST['drive_id']);
$drive_file		=htmlspecialchars(@$_POST['drive_file']);
$account_username		=htmlspecialchars(@$_POST['account_username']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {		
		
		case 'folder':		

				$save=mysqli_query($connect, "INSERT INTO drive_folder (folder_id,
			    			account_id,
			    			folder_name,
			    			create_date)
			    			VALUES ('$genid',
			    					'$account_id',
			    					'$folder_name',
			    					'$create_date')");				

				if ($save) {
					echo json_encode(array('status'=>'success'));
				} else {			
					echo json_encode(array('status'=>'failed'));
				}			
			
			break;

		case 'rename':		

				$save=mysqli_query($connect, "UPDATE drive_folder SET 
								folder_name='$folder_name'
							where folder_id='$folder_id' AND account_id='$account_id'");				

				if ($save) {
					echo json_encode(array('status'=>'success'));
				} else {			
					echo json_encode(array('status'=>'failed'));
				}			
			
			break;


		case 'shared':		

				$account =mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM account
						where account_id='$account_id'"));
				$send =mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM account
						where account_username='$account_username'"));

				if (!empty($send['account_id'])) {
					$save=mysqli_query($connect, "INSERT INTO drive_shared (shared_id,
							drive_id,
			    			account_id,
			    			account_send,
			    			shared_status,
			    			create_date)
			    			VALUES ('$genid',
			    					'$drive_id',
			    					'$account_id',
			    					'$send[account_id]',
			    					'$account[account_status]',
			    					'$create_date')");				

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
				} else {
					echo json_encode(array('status'=>'failed'));
				}
							
			
			break;

		case 'file':
			$folderUpload = "../../../assets/drive_file/".$account_id;

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}


			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$drive_file = $_FILES['drive_file']['name'];
			$x = explode('.', $drive_file);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['drive_file']['size'];
			$file_tmp = $_FILES['drive_file']['tmp_name'];	
				if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $folderUpload.'/'.$drive_file);

					$save=mysqli_query($connect, "INSERT INTO drive_academic (drive_id,
			    			account_id,
			    			folder_id,
			    			drive_file,
			    			drive_size,
			    			drive_type,
			    			create_date)
			    			VALUES ('$genid',
			    					'$account_id',
			    					'$folder_id',
			    					'$drive_file',
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


			case 'remove_folder':
			
			$data=mysqli_query($connect, "SELECT * FROM drive_academic
						where folder_id='$id' AND account_id='$account_id'");
			while ($drive=mysqli_fetch_array($data)) {
				unlink("../../../assets/drive_file/".$account_id."/".$drive['drive_file']);
				$remove=mysqli_query($connect, "DELETE FROM drive_academic
						where drive_id='$drive[drive_file]' AND account_id='$account_id'");

				$remove=mysqli_query($connect, "DELETE FROM drive_shared
						where drive_id='$drive[drive_file]' AND account_id='$account_id'");
			}			

			$remove=mysqli_query($connect, "DELETE FROM drive_folder
						where folder_id='$id' AND account_id='$account_id'");
			
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;


			case 'remove':
			
			$drive =mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM drive_academic
						where drive_id='$id' AND account_id='$account_id'"));

			unlink("../../../assets/drive_file/".$account_id."/".$drive['drive_file']);

			$remove=mysqli_query($connect, "DELETE FROM drive_shared
						where drive_id='$id' AND account_id='$account_id'");

			$remove=mysqli_query($connect, "DELETE FROM drive_academic
						where drive_id='$id' AND account_id='$account_id'");
			
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

		


}



?>