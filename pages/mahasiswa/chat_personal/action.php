<?php
session_start();

include "../../../config/connection.php";
$account_id=$_SESSION['account_id'];


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


$personal_chat			=htmlspecialchars(@$_POST['personal_chat']);
$account_username		=htmlspecialchars(@$_POST['account_username']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {		
		
		case 'input':		

				$act=explode("|", $account_username);
				$account_username=$act[0];
				$account=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM account where account_username='$account_username' AND account_id!='$account_id'"));

				if (!empty($account['account_id'])) {
					$remove=mysqli_query($connect,"DELETE FROM chat_personal 
						where account_id='$account_id' AND personal_send='$account[account_id]'");

					$remove=mysqli_query($connect,"DELETE FROM chat_personal 
						where personal_send='$account_id' AND account_id='$account[account_id]'");

					$save=mysqli_query($connect, "INSERT INTO chat_personal (personal_id,
			    			account_id,
			    			personal_send,
			    			personal_status,
			    			create_date)
			    			VALUES ('$genid',
			    					'$account_id',
			    					'$account[account_id]',
			    					'0',
			    					'$create_date')");

			    	$save=mysqli_query($connect, "INSERT INTO chat_personal (personal_id,			    			
			    			personal_send,
			    			account_id,
			    			personal_status,
			    			create_date)
			    			VALUES ('$genid2',
			    					'$account_id',
			    					'$account[account_id]',
			    					'0',
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


		case 'typing':
				$update=mysqli_query($connect,"UPDATE chat_personal SET personal_status='1'
						WHERE account_id='$account_id' AND personal_send='$id'");

			break;

		case 'notyping':
				$update=mysqli_query($connect,"UPDATE chat_personal SET personal_status='0'
						WHERE account_id='$account_id' AND personal_send='$id'");

			break;

		


}



?>