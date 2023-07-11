<?php
session_start();

include "../../../config/connection.php";
$account_id=$_SESSION['account_id'];
$dsn=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_lecturer where account_id='$account_id'"));
$lecturer_code=$dsn['lecturer_code'];

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

$logbook_response 	=htmlspecialchars(@$_POST['logbook_response']);


$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		
		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_logbook SET	
						logbook_response='$logbook_response' 
						where logbook_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		

}



?>