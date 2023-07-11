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


$majors_code	=htmlspecialchars(@$_POST['majors_code']);
$forum_title	=htmlspecialchars(@$_POST['forum_title']);
$forum_description 	=@$_POST['forum_description'];
$forum_comment	=htmlspecialchars(@$_POST['forum_comment']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO forum_general (
						forum_id,
						account_id,
						forum_title,
						forum_description,
						create_date)
				VALUES ('$genid',
						'$account_id',
						'$forum_title',
						'$forum_description',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE forum_general SET	
						forum_title='$forum_title',
						forum_description='$forum_description',
						create_date='$create_date' 
						where forum_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM forum_comment  
						where forum_id='$id'");

			$remove=mysqli_query($connect, "DELETE FROM forum_general  
						where forum_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;


		case 'comment':

			$save=mysqli_query($connect, "INSERT INTO forum_comment (
						forum_comment_id,
						forum_id,
						account_id,
						forum_comment,
						create_date)
				VALUES ('$genid',
						'$id',
						'$account_id',
						'$forum_comment',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove_comment':
			
			$remove=mysqli_query($connect, "DELETE FROM forum_comment  
						where forum_comment_id='$id'");

			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>