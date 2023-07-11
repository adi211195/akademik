<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$id 		=htmlspecialchars($_GET['id']);
$row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_schedule as mc
					
					INNER JOIN master_majors as mmaj ON mmaj.majors_code=mc.majors_code
					INNER JOIN master_college as mcol ON mcol.college_code=mc.college_code
                	where schedule_id='$id'"));

$schedule=mysqli_fetch_array(mysqli_query($connect, "SELECT 
					sum(courses_sks) as sks,
					count(schedule_id) as schedule
					FROM schedule_package as sp,
					    master_curriculum as mc 
					LEFT JOIN master_courses ON master_courses.courses_code=mc.courses_code 
					where 
						sp.curriculum_id=mc.curriculum_id AND
						sp.schedule_id='$row[schedule_id]'"));

$student=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs_package where schedule_id='$row[schedule_id]'"));


ob_start(); 
?>
<html>
<style type="text/css">
    body {
        	font-size: 13px;
         }
</style>
<body>
	<p align="center">
		<h3>Schedule Package Report</h3>
	</p>

		<table width="100%">
			<tr>
				<td>School Year / Semester</td>
				<td>: <?= $row['schedule_school_year']; ?> / <?= $row['schedule_semester']; ?></td>
				<td>Generation</td>
				<td>: <?= $row['schedule_generation']; ?></td>
			</tr>
			<tr>
				<td>College</td>
				<td>: <?= $row['college']; ?></td>
				<td>Package Name </td>
				<td>: <?= $row['schedule']; ?> </td>
			</tr>
			<tr>
				<td>Majors</td>
				<td>: <?= $row['majors']; ?> </td>
				<td>Limit</td>
				<td>: <?= $row['schedule_limit']; ?></td>
			</tr>
			<tr>
				<td>Amount Schedule</td>
				<td>: <?= $schedule['schedule']; ?></td>
				<td>Amount Selected</td>
				<td>: <?= $student; ?></td>
			</tr>
			
		</table>
		<br>


		<p><b>List Schedule</b></p>
		<table width="100%" rules="all" style="border:1px solid black;">
			<thead>
				<tr>
					<th>No</th>
					<th>Types</th>
					<th>Room / Class / Capacity</th>
					<th>Code | Courses</th>
					<th>Dosen | Schedule</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no=1;
			$data=mysqli_query($connect, "SELECT * FROM schedule_package as sp
					    INNER JOIN master_curriculum as mc ON mc.curriculum_id=sp.curriculum_id
					    INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					    INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					    INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					    INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					    where 
					    sp.schedule_id='$id'");
			while ($row=mysqli_fetch_array($data)) {
			?>
				<tr>
					<td align="center"><?= $no; ?></td>
					<td><?= $row['curriculum_types']; ?></td>
					<td><?= $row['class_room']; ?> / <?= $row['class']; ?> / <?= $row['class_capacity']; ?></td>
					<td><?= $row['courses_code']; ?> | <?= $row['courses']; ?>   <?= $row['courses_sks']; ?> SKS</td>
					<td><?= $row['lecturer_name']; ?> <br>
						<?= $row['curriculum_day']; ?>, <?= $row['curriculum_start']; ?> - <?= $row['curriculum_end']; ?></td>
				</tr>
			<?php $no++; } ?>
			</tbody>
		 </table>

		 <p><b>List Student</b></p>

		 <table width="100%" rules="all" style="border:1px solid black;">
			<thead>
				<tr>
					<th>No</th>
					<th>NIM</th>
					<th>Name</th>
					<th>Majors</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no=1;
			$data=mysqli_query($connect, "SELECT * FROM master_krs_package as mkp
						INNER JOIN master_student as ms ON ms.student_nim=mkp.student_nim
						INNER JOIN master_majors as mmaj ON mmaj.majors_code=ms.majors_code
					    where 
					    mkp.schedule_id='$id'");
			while ($row=mysqli_fetch_array($data)) {
			?>
				<tr>
					<td align="center"><?= $no; ?></td>
					<td align="center"><?= $row['student_nim']; ?></td>
					<td><?= $row['student_name']; ?></td>
					<td><?= $row['majors']; ?></td>
				</tr>
			<?php $no++; } ?>
			</tbody>
		 </table>

</body>
</html>


<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("A4", "potrait");
$dompdf->render();
$dompdf->stream('report_schedule_package.pdf',array('Attachment'=>0));
 
?>