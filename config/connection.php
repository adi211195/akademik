<?php
// panggil fungsi validasi xss dan injection
date_default_timezone_set("Asia/Jakarta");


$connect = mysqli_connect("localhost","root","","akademik");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Connection database failed : " . mysqli_connect_error();
}

?>

