<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$id 		=htmlspecialchars($_GET['id']);
$date 		=htmlspecialchars($_GET['date']);
$row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
					INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					INNER JOIN master_college as mcol ON mcol.college_code=mc.college_code
                	where curriculum_id='$id'"));
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
		<h3>Attendance Report</h3>
	</p>

		<table width="100%">
			<tr>
				<td>School Year / Semester</td>
				<td>: <?= $row['curriculum_school_year']; ?> / <?= $row['curriculum_semester']; ?></td>
				<td>Curriculum Types</td>
				<td>: <?= $row['curriculum_types']; ?></td>
			</tr>
			<tr>
				<td>College</td>
				<td>: <?= $row['college']; ?></td>
				<td>Class </td>
				<td>: <?= $row['class_room']; ?> / <?= $row['class']; ?></td>
			</tr>
			<tr>
				<td>Majors</td>
				<td>: 
					<?php 
					$data=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
							                      LEFT JOIN master_majors as mj ON mj.majors_code=mc.majors_code
							                      WHERE mc.curriculum_id='$id'");
					 while ($row2=mysqli_fetch_array($data)) {
					echo $row2['majors'].", ";
					} ?></td>

				<td> Day, Start, End / Face to Face</td>
				<td>: <?= $row['curriculum_day']; ?>, <?= $row['curriculum_start']; ?>, <?= $row['curriculum_end']; ?> / <?= $row['curriculum_face']; ?></td>
			</tr>
			<tr>
				<td> Courses</td>
				<td>: <?= $row['courses_code']; ?> | <?= $row['courses']; ?></td>
				<td>Attendance Date</td>
				<td>: <?= $date; ?></td>
			</tr>
			<tr>
				<td>Lecturer</td>
				<td>: <?= $row['lecturer_name']; ?></td>
				<td></td>
				<td>: </td>
			</tr>
		</table>
		<br>


		<table width="100%" rules="all" style="border:1px solid black;">
			<thead>
				<tr>
					<th width="5%">No</th>
					<th width="15%">NIM</th>
					<th>Name</th>
					<th  width="15%">Attendance Type</th>
				</tr>
			 </thead>
				<tbody>
				<?php
				$no2=1;
				$data2=mysqli_query($connect, "SELECT * FROM master_krs 
										    LEFT JOIN master_student ON master_student.student_nim=master_krs.student_nim
										    where curriculum_id='$id' order by master_krs.student_nim asc");
				while ($row2=mysqli_fetch_array($data2)) {
										                            	

				$cek=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_attendance as ma
								LEFT JOIN master_attendance_list as mal ON mal.attendance_id=ma.attendance_id
								WHERE attendance_date='$date'
								AND student_nim='$row2[student_nim]'
								AND curriculum_id='$id'"));
																		
				?>
										                            	
				<tr>
					<td align="center"><?= $no2; ?></td>
					<td align="center"><?= $row2['student_nim']; ?></td>
					<td> <?= $row2['student_name']; ?></td>
					<td align="center"><?= $cek['attendance_type']; ?></td>
				</tr>
				<?php $no2++; } ?>
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
$dompdf->stream('report_attendance.pdf',array('Attachment'=>0));
 
?>