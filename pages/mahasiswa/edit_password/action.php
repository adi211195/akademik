<?php
session_start();
$account_id         =$_SESSION['account_id'];

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


$old_password			=md5(htmlspecialchars(@$_POST['old_password']));
$new_password 			=md5(htmlspecialchars(@$_POST['new_password']));

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		
		case 'edit':
		    $account            =mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account where account_id='$account_id' 
		    	AND account_password='$old_password'"));
		    if (!empty($account['account_id'])) {
		    	$update=mysqli_query($connect, "UPDATE account SET						
						account_password='$new_password'
						where account_id='$account_id'");
				if ($update) {
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