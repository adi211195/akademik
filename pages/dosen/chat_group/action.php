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


$group_chat			=htmlspecialchars(@$_POST['group_chat']);
$curriculum_id		=htmlspecialchars(@$_POST['curriculum_id']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {		
		
		case 'input':		

				$krs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_krs as mk, 
					                            		master_curriculum as mc
														WHERE 
					                            		mk.curriculum_id=mc.curriculum_id AND 
					                            		mc.curriculum_id='$curriculum_id' AND 
					                            		mc.lecturer_code='$lecturer_code'"));

				if (!empty($krs['krs_id'])) {

					$save=mysqli_query($connect, "INSERT INTO chat_group (group_id,
			    			account_id,
			    			curriculum_id,
			    			group_chat,
			    			group_status,
			    			create_date)
			    			VALUES ('$genid',
			    					'$account_id',
			    					'$curriculum_id',
			    					'$group_chat',
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