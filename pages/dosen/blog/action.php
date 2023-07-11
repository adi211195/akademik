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


$blog_id		=@$_POST['blog_id'];
$comment		=@$_POST['comment'];



$create_date	=date('Y-m-d H:i:s');

switch ($action) {		
		
		case 'comment':	

			

				$save=mysqli_query($connect, "INSERT INTO master_blog_comment (blog_comment_id,
			    			account_id,
			    			blog_id,
			    			comment,
			    			create_date)
			    			VALUES ('$genid',
			    					'$account_id',
			    					'$blog_id',
			    					'$comment',
			    					'$create_date')");

				if ($save) {
					echo json_encode(array('status'=>'success'));
				} else {			
					echo json_encode(array('status'=>'failed'));
				}
			
			break;

		

}

?>