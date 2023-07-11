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


$podcast_title		=htmlspecialchars(@$_POST['podcast_title']);
$podcast_description 	=@$_POST['podcast_description'];
$podcast_client_id	=htmlspecialchars(@$_POST['podcast_client_id']);
$podcast_start_date	=htmlspecialchars(@$_POST['podcast_start_date']);
$podcast_end_date	=htmlspecialchars(@$_POST['podcast_end_date']);

$podcast_id			=htmlspecialchars(@$_POST['podcast_id']);
$podcast_client_id_id	=htmlspecialchars(@$_POST['podcast_client_id_id']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO podcast (
						podcast_id,
						account_id,
						podcast_title,
						podcast_description,
						podcast_client_id,
						podcast_start_date,
						podcast_end_date,
						create_date)
				VALUES ('$genid',
						'$account_id',
						'$podcast_title',
						'$podcast_description',
						'$podcast_client_id',
						'$podcast_start_date',
						'$podcast_end_date',
						'$create_date')");


			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE podcast SET	
						podcast_title='$podcast_title',
						podcast_description='$podcast_description',
						podcast_client_id='$podcast_client_id',
						podcast_start_date='$podcast_start_date',
						podcast_end_date='$podcast_end_date',
						create_date='$create_date' 
						where podcast_id='$id'");


			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			

			$remove=mysqli_query($connect, "DELETE FROM podcast  
						where podcast_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

		

}



?>