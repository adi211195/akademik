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


$personal_chat			=htmlspecialchars(@$_POST['personal_chat']);
$account_username		=htmlspecialchars(@$_POST['account_username']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {		
		
		case 'input':		

				$account=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM account where account_username='$account_username' OR account_id='$account_username'"));

				if (!empty($account['account_id'])) {

					$save=mysqli_query($connect, "INSERT INTO chat_personal (personal_id,
			    			account_id,
			    			personal_send,
			    			personal_chat,
			    			personal_status,
			    			create_date)
			    			VALUES ('$genid',
			    					'$account_id',
			    					'$account[account_id]',
			    					'$personal_chat',
			    					'1',
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

		


}



?>