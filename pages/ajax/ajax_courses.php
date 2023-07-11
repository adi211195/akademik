<?php
include "../../config/connection.php";
$majors 	=htmlspecialchars(@$_POST['majors']);

echo '<option value="">-- Select --'.$majors.'</option>';

$query= mysqli_query($connect, "SELECT * from master_courses where majors_code='$majors' order by courses asc");
while($data=mysqli_fetch_array($query)){

	echo '<option value="'.$data['courses_code'].'">'.$data['courses'].'</option>';

}
?>