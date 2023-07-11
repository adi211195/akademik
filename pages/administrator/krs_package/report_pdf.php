<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$student_nim		=htmlspecialchars($_GET['nim']);
$sy		=htmlspecialchars($_GET['sy']);
$sm		=htmlspecialchars($_GET['sm']);
$data=mysqli_query($connect, "SELECT * FROM master_student
									LEFT JOIN master_college ON master_college.college_code=master_student.college_code
									LEFT JOIN master_majors ON master_majors.majors_code=master_student.majors_code
									where master_student.student_nim='$student_nim'");
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
	<p align="left"><img src="../../../assets/logo/STDI2.png" alt="" width="126" height="109"></p>
	<p align="center"><font size="18px"><b>KARTU RENCANA STUDI</b></font></p>
	<div style="background:url(../../../assets/logo/STDI.png); 
					background-repeat: no-repeat;
					background-position:center center;
                    background-size: auto; 
                    opacity: 0.2;">


		<table width="100%">
			<tr>
                <td width="20%">N I M</td>
                <td>: <?= $student['student_nim']; ?></td>
                <td width="20%">KONSENTRASI</td>
                <td>:  <?= $student['majors']; ?></td>
            </tr>
            <tr>
                <td>NAMA</td>
                <td>: <?= $student['student_name']; ?></td>
                <td>SEMESTER/PERIODE</td>
                <td>: <?= $sm; ?></td>
            </tr>
            <tr>
                <td width="20%">T.A</td>
                <td>: <?= $sy; ?></td>
            </tr>
		</table>
		<br>


		<table width="100%" rules="all" style="border:1px solid black;">
			<thead>
				<tr style="background: #F0F8FF;">
                    <th width="6%">NO</th>
                    <th width="10%"><p>KODE</p></th>
                    <th width="31%">MATA KULIAH</th>
                    <th width="7%">SKS</th>
                    <th width="13%">KELAS/RGN</th>
                    <th width="21%">HARI/JAM</th>
                    <th width="12%">KODE DOSEN</th>
                </tr>
			</thead>
			<tbody>
			<?php
			$no=1;
			$sks=0;
			$data=mysqli_query($connect, "SELECT * FROM master_krs
				where 
					master_krs.student_nim='$student_nim' AND
					master_krs.krs_school_year='$sy' AND
					master_krs.krs_semester='$sm' AND 
					master_krs.krs_approved='Approved'");
			while ($row=mysqli_fetch_array($data)) {

				$cm=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum as mc
					LEFT JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					LEFT JOIN master_class as mclass ON mclass.class_code=mc.class_code
					LEFT JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					LEFT JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					where curriculum_id='$row[curriculum_id]'"));

				$sks=$sks+$cm['courses_sks'];
			?>
				<tr>
					<td align="center"><?= $no; ?></td>
					<td><?= $cm['courses_code']; ?></td>
					<td><?= $cm['courses']; ?></td>
					<td><?= $cm['courses_sks']; ?></td>
					<td><?= $cm['class_room']; ?>/<?= $cm['class']; ?></td>
					<td><?= $cm['curriculum_day']; ?>, <?= substr($cm['curriculum_start'],0,5); ?> - <?= substr($cm['curriculum_end'],0,5); ?></td>
					<td><?= $cm['lecturer_code']; ?></td>
					
				</tr>
			<?php $no++; } ?>
			</tbody>
			<tfoot>
                <tr>
                    <td height="32" colspan="3" align="right">JUMLAH SKS YANG DIAMBIL &nbsp;</td>
                    <td align="center"><?php echo $sks; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tfoot>
		 </table>

		 <table width="100%">
				<tr>
                      <td width="70%" valign="top"></td>
                      <td valign="top">
                        Jakarta, <?= date('d M Y'); ?> <br>
                        Ketua <br><br><br><br><br><br> <?php echo $student['college_dean']; ?>
                      </td>
                    </tr>
		 </table>


		</div>
</body>
</html>


<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("A4", "potrait");
$dompdf->render();
$dompdf->stream('KRS.pdf',array('Attachment'=>0));
 
?>