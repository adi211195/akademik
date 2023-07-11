<?php
session_start();
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");


$account_id=$_SESSION['account_id'];
$mhs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_student where account_id='$account_id'"));
$student_nim=$mhs['student_nim'];

$data=mysqli_query($connect, "SELECT * FROM master_score
									LEFT JOIN master_student ON master_student.student_nim=master_score.student_nim
									LEFT JOIN master_college ON master_college.college_code=master_student.college_code
									LEFT JOIN master_majors ON master_majors.majors_code=master_student.majors_code
									where master_score.student_nim='$student_nim'");
$student=mysqli_fetch_array($data);

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
		<h3>Indeks Prestasi Komulatif</h3>
	</p>

		<table width="100%">
			<tr>
				<td  width="30%">College</td>
				<td>: <?= $student['college']; ?></td>
			</tr>
			<tr>
				<td>Majors</td>
				<td>:  <?= $student['majors']; ?></td>				
			</tr>
			<tr>
				<td>NIM</td>
				<td>:  <?= $student['student_nim']; ?></td>
			</tr>
			<tr>
				<td>Name</td>
				<td>: <?= $student['student_name']; ?></td>
			</tr>
		</table>
		<br>


		<table width="100%" rules="all" style="border:1px solid black;">
			<thead>
				<tr>
					<th>No</th>
					<th>Courses Code</th>
					<th>Courses</th>
					<th>SMT Distribution</th>
					<th>lowest value</th>
					<th>final score</th>
					<th>letter value</th>
					<th>quality figures</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no=1;
			$grand_total=0;
			$sks=0;
			$quality=0;
			$data=mysqli_query($connect, "SELECT * FROM master_score
										INNER JOIN master_courses ON master_courses.courses_code=master_score.courses_code
										where master_score.student_nim='$student_nim'
										ORDER BY master_score.courses_code ASC");
			while ($row=mysqli_fetch_array($data)) {
			$sks=$sks+$row['courses_sks'];
			$quality=$quality+($row['courses_sks']*$row['score_quality']);
			$grand_total=$grand_total+$row['score_numbers'];
			?>
				<tr>
					<td align="center"><?= $no; ?></td>
					<td> <?= $row['courses_code']; ?></td>
					<td> <?= $row['courses']; ?></td>
					<td align="center"><?= $row['courses_smt']; ?></td>
					<td align="center"><?= $row['courses_low_value']; ?></td>
					<td align="center"><?= $row['score_numbers']; ?></td>
					<td align="center"><?= $row['score_alphabet']; ?></td>
					<td align="center"><?= $row['score_quality']; ?></td>
				</tr>
			<?php $no++; } ?>
			</tbody>
		 </table>

		 <table width="100%">
				<tr>
					<td width="30%">Number of credits</td>
					<td>: <?= $sks; ?></td>
				</tr>
				<tr>
					<td>Quality Value </td>
					<td>: <?= $quality; ?></td>
				</tr>
				<tr>
					<td>IPK </td>
					<td>: <b><?= round($quality/$sks,2); ?></b></td>
				</tr>
		 </table>


		 <p>Jakarta, <?= date('d M Y'); ?> <br> Chairman 

		 <br>
		 <br>
		 <br>
		 <br>
		...............................................</p>
</body>
</html>


<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("A4", "potrait");
$dompdf->render();
$dompdf->stream('IPK.pdf',array('Attachment'=>0));
 
?>