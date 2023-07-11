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

$student_nim			=htmlspecialchars(@$_POST['student_nim']);
$logbook_date			=htmlspecialchars(@$_POST['logbook_date']);
$logbook_note 			=htmlspecialchars(@$_POST['logbook_note']);
$logbook_information 	=htmlspecialchars(@$_POST['logbook_information']);


$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO master_logbook (
						logbook_id,
						student_nim,
						lecturer_code,
						logbook_date,
						logbook_note,
						logbook_information,
						create_date)
				VALUES ('$genid',
						'$student_nim',
						'$lecturer_code',
						'$logbook_date',
						'$logbook_note',
						'$logbook_information',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_logbook SET	
						logbook_date='$logbook_date',
						logbook_note='$logbook_note',
						logbook_information='$logbook_information',
						create_date='$create_date' 
						where logbook_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_logbook  
						where logbook_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>