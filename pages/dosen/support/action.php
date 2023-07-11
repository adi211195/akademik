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


$support_email			=htmlspecialchars(@$_POST['support_email']);
$support_subject 		=htmlspecialchars(@$_POST['support_subject']);
$support_message 		=htmlspecialchars(@$_POST['support_message']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO master_support (
						support_id,
						support_email,
						support_subject,
						support_message,
						account_id,
						create_date)
				VALUES ('$genid',
						'$support_email',
						'$support_subject',
						'$support_message',
						'$account_id',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		

}



?>