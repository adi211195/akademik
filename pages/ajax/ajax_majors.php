<?php
include "../../config/connection.php";
$college 	=htmlspecialchars(@$_POST['college']);

echo '<option value="">-- Select --</option>';

$query= mysqli_query($connect, "SELECT * from master_majors where college_code='$college' order by majors asc");
while($data=mysqli_fetch_array($query)){

	echo '<option value="'.$data['majors_code'].'">'.$data['majors'].'</option>';

}
?>