<?php
include "../../config/connection.php";

$account_id=$_GET['account_id'];
$account_sent=$_GET['account_sent'];

$account=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account where account_id='$account_sent'"));
$cek=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM chat_personal where account_id='$account_sent' AND personal_send='$account_id' AND personal_status='1'"));

if ($cek>0) {
  echo "Typing...";
} else {
  echo $account['account_status'];
}



?>