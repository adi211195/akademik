<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$id 		=htmlspecialchars($_GET['id']);
$row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
					INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					INNER JOIN master_college as mcol ON mcol.college_code=mc.college_code
                	where curriculum_id='$id'"));

 $weight=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_score_weight where curriculum_id='$id'"));
 $mc=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum
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
		<h3>Score Report</h3>
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
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Lecturer</td>
				<td>: <?= $row['lecturer_name']; ?></td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<br>


		<table width="100%" rules="all" style="border:1px solid black;">
			<thead>
				<tr>
					<th rowspan="3">No</th>
					<th rowspan="3">NIM</th>
					<th rowspan="3">Name</th>
					<th colspan="11">Score</th>
				</tr>
				<tr>
					<th colspan="2">Attendance</th>
					<th colspan="2">UTS </th>
					<th colspan="2">QUIZ </th>
					<th colspan="2">UAS </th>
					<th rowspan="2">Numbers</th>
					<th rowspan="2">Alphabet</th>
					<th rowspan="2">Quality</th>
				</tr>
				<tr>
					<th>Amount</th>
					<th><?= $weight['weight_attendance']; ?>%</th>
					<th>Amount</th>
					<th><?= $weight['weight_uts']; ?>%</th>
					<th>Amount</th>
					<th><?= $weight['weight_quiz']; ?>%</th>
					<th>Amount</th>
					<th><?= $weight['weight_uas']; ?>%</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no=1;
			$data=mysqli_query($connect, "SELECT * FROM master_krs 
							LEFT JOIN master_student ON master_student.student_nim=master_krs.student_nim
							where curriculum_id='$id' order by master_krs.student_nim asc");
			while ($row=mysqli_fetch_array($data)) {
				$score=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_score 
										where curriculum_id='$id' 
										AND student_nim='$row[student_nim]'"));

										                

				$weight_attendance=$weight['weight_attendance']/100;


				if ($score['score_attendance']>=$mc['curriculum_face']) {
					$attendance_amount=$mc['curriculum_face'];
				} else {
					$attendance_amount=$score['score_attendance'];
				}
				
				@$tot_attendance=(($attendance_amount/$mc['curriculum_face'])*100)*$weight_attendance;

				$grand_attendance=round($tot_attendance,2);
				$grand_uts=($score['score_uts']*$weight['weight_uts'])/100;
				$grand_quiz=($score['score_quiz']*$weight['weight_quiz'])/100;
				$grand_uas=($score['score_uas']*$weight['weight_uas'])/100;


			?>
										                            	
			<tr>
				<td align="center"><?= $no; ?></td>
				<td align="center"><?= $row['student_nim']; ?></td>
				<td> <?= $row['student_name']; ?></td>
				<td align="center"><?= $score['score_attendance']; ?></td>
				<td align="center"><?= $grand_attendance; ?></td>
				<td align="center"><?= $score['score_uts']; ?></td>
                <td align="center"><?= $grand_uts; ?></td>
                <td align="center"><?= $score['score_quiz']; ?></td>
                <td align="center"><?= $grand_quiz; ?></td>
                <td align="center"><?= $score['score_uas']; ?></td>
                <td align="center"><?= $grand_uas; ?></td>
                <td align="center"><?= $score['score_numbers']; ?></td>
                <td align="center"><?= $score['score_alphabet']; ?></td>
                <td align="center"><?= $score['score_quality']; ?></td>
			</tr>	                  		

			<?php $no++;} ?>
			</tbody>
		 </table>
</body>
</html>


<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("A4", "landscape");
$dompdf->render();
$dompdf->stream('report_score.pdf',array('Attachment'=>0));
 
?>