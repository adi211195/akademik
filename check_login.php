<?php
include "config/connection.php";

function anti_injection($data){
  include "config/connection.php";
  $filter = $connect -> real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['account_username']);
$password = anti_injection(md5($_POST['account_password']));

// pastikan username dan password adalah berupa huruf atau angka.


		$data_account = mysqli_query($connect, "SELECT * FROM account WHERE 
			account_username='$username' AND 
			account_password='$password' AND 
			account_block='No'");

		$login=mysqli_num_rows($data_account);
		$account=mysqli_fetch_array($data_account);
     
	// Apabila username dan password ditemukan
		if ($login> 0) {
		session_start();

		if ($account['account_status']=="Administrator") {
			$dtl=mysqli_fetch_array(mysqli_query($connect,"SELECT master_user.user_name as name FROM master_user where account_id='$account[account_id]'"));
		} elseif ($account['account_status']=="Dosen") {
			$dtl=mysqli_fetch_array(mysqli_query($connect,"SELECT master_lecturer.lecturer_name as name FROM master_lecturer where account_id='$account[account_id]'"));
		} else {
			$dtl=mysqli_fetch_array(mysqli_query($connect,"SELECT master_student.student_name as name FROM master_student where account_id='$account[account_id]'"));
		}

		$_SESSION['account_id']     	= $account['account_id'];
		$_SESSION['account_status'] 	= $account['account_status'];
		$_SESSION['account_username']	= $account['account_username'];
		$_SESSION['account_photo'] 		= $account['account_photo'];
		$_SESSION['account_name'] 		= $dtl['name'];	

			echo json_encode(array('status'=>'success'));

		} else {			

			echo json_encode(array('status'=>'failed'));

		}

?>