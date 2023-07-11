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


$polling_title	=htmlspecialchars(@$_POST['polling_title']);
$polling_description 	=@$_POST['polling_description'];
$polling_choice	=htmlspecialchars(@$_POST['polling_choice']);
$polling_start_date	=htmlspecialchars(@$_POST['polling_start_date']);
$polling_end_date	=htmlspecialchars(@$_POST['polling_end_date']);

$polling_id			=htmlspecialchars(@$_POST['polling_id']);
$polling_choice_id	=htmlspecialchars(@$_POST['polling_choice_id']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO polling_general (
						polling_id,
						account_id,
						polling_title,
						polling_description,
						polling_choice,
						polling_start_date,
						polling_end_date,
						create_date)
				VALUES ('$genid',
						'$account_id',
						'$polling_title',
						'$polling_description',
						'$polling_choice',
						'$polling_start_date',
						'$polling_end_date',
						'$create_date')");

			$choice=explode(",", $polling_choice);
			foreach ($choice as $row) {
				$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				// Genrate ID
				$genid2=substr(str_shuffle($genrate_id), 0, 14);
				$save2=mysqli_query($connect, "INSERT INTO polling_choice (
						polling_id,
						polling_choice_id,
						polling_choice,
						create_date)
				VALUES ('$genid',
						'$genid2',
						'$row',
						'$create_date')");
			}

			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE polling_general SET	
						polling_title='$polling_title',
						polling_description='$polling_description',
						polling_choice='$polling_choice',
						polling_start_date='$polling_start_date',
						polling_end_date='$polling_end_date',
						create_date='$create_date' 
						where polling_id='$id'");

			$remove=mysqli_query($connect, "DELETE FROM polling_choice  
						where polling_id='$id'");

			$choice=explode(",", $polling_choice);
			foreach ($choice as $row) {
				$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				// Genrate ID
				$genid2=substr(str_shuffle($genrate_id), 0, 14);
				$save2=mysqli_query($connect, "INSERT INTO polling_choice (
						polling_id,
						polling_choice_id,
						polling_choice,
						create_date)
				VALUES ('$id',
						'$genid2',
						'$row',
						'$create_date')");
			}

			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM polling_choice  
						where polling_id='$id'");

			$remove=mysqli_query($connect, "DELETE FROM polling_answer 
						where polling_id='$id'");

			$remove=mysqli_query($connect, "DELETE FROM polling_general  
						where polling_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;


		case 'choice':

			$remove=mysqli_query($connect, "DELETE FROM polling_answer  
						where account_id='$account_id' AND 
						polling_id='$polling_id'");

			$save=mysqli_query($connect, "INSERT INTO polling_answer (
						polling_answer_id,
						polling_choice_id,
						account_id,
						polling_id,
						create_date)
				VALUES ('$genid',
						'$polling_choice_id',
						'$account_id',
						'$polling_id',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;
		

}



?>