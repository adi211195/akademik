<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=LIST STUDENT.xls");

include "../../../config/connection.php";
$student_generation =htmlspecialchars(@$_POST['student_generation']);
$college_code       =htmlspecialchars(@$_POST['college_code']);
$majors_code        =htmlspecialchars(@$_POST['majors_code']);
$sy                 =htmlspecialchars(@$_POST['sy']);
$sm                 =htmlspecialchars(@$_POST['sm']);
$student_status     =htmlspecialchars(@$_POST['student_status']);

$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
			LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
			WHERE majors_code='$majors_code'"));
?>

<h3 align="center">
	LIST OF STUDENT STATUS <?= strtoupper($student_status); ?> <br> 
	<?= strtoupper($code['majors']); ?> <br> 
	Generation <?= $student_generation; ?>, School Year <?= $sy; ?> 
	<?= strtoupper($sm); ?>
</h3>
<table border="1" width="100%" cellspacing="10" cellpadding="10">
    <thead>
        <tr>
            <th width="5%">NO</th>
            <th width="20%">NIM</th>
            <th>NAME</th>
         </tr>
    </thead>
<tbody>
	<?php
	$no=1;
	$data=mysqli_query($connect, "SELECT * FROM master_student_history as msh
		LEFT JOIN master_student AS ms ON ms.student_nim=msh.student_nim
					where 
					    ms.majors_code='$majors_code' AND
					    msh.student_history_school_year='$sy' AND
					    msh.student_history_semester='$sm'
					    ORDER BY ms.student_nim asc");
	while ($row=mysqli_fetch_array($data)) {
	?>
	<tr>
		<td><?= $no; ?></td>
		<td><?= $row['student_nim']; ?></td>
		<td><?= $row['student_name']; ?></td>
    </tr>
    <?php $no++; } ?>
</tbody>
</table>