<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$id					=htmlspecialchars($_GET['id']);
$student_nim		=htmlspecialchars($_GET['nim']);
$data=mysqli_query($connect, "SELECT * FROM master_score
									LEFT JOIN master_student ON master_student.student_nim=master_score.student_nim
									LEFT JOIN master_college ON master_college.college_code=master_student.college_code
									LEFT JOIN master_majors ON master_majors.majors_code=master_student.majors_code
									where master_score.student_nim='$student_nim'");
$student=mysqli_fetch_array($data);
$row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_lecturer ON master_lecturer.account_id=account.account_id
                	where account.account_id='$id'")); 

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
		<h3>Logbook</h3>
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
			<tr>
				<td>Advisor</td>
				<td>: <?= $row['lecturer_code']; ?> | <?= $row['lecturer_name']; ?></td>
			</tr>
		</table>
		<br>


		<table width="100%" rules="all" style="border:1px solid black;">
			<thead>
				<th>No</th>
				<th>Date</th>
				<th>Note</th>
				<th>Information</th>
				<th>Response</th>
			</thead>
			<tbody>
			<?php
			$nomor=1;
			$log=mysqli_query($connect, "SELECT * FROM master_logbook where 
										lecturer_code='$row[lecturer_code]' AND
										student_nim='$student_nim'
										ORDER BY logbook_date asc");
			while ($row3=mysqli_fetch_array($log)) {
			?>

				<tr>
					<td align="center"><?= $nomor; ?></td>
					<td> <?= $row3['logbook_date']; ?></td>
					<td> <?= $row3['logbook_note']; ?></td>
					<td> <?= $row3['logbook_information']; ?></td>
					<td> <?= $row3['logbook_response']; ?></td>
				</tr>
			<?php $nomor++; } ?>
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
$dompdf->stream('Logbook.pdf',array('Attachment'=>0));
 
?>