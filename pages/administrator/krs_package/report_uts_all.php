<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$majors_code		=htmlspecialchars($_POST['majors_code']);
$sy		=htmlspecialchars($_POST['sy']);
$sm		=htmlspecialchars($_POST['sm']);
$row	=htmlspecialchars($_POST['row']);


ob_start(); 
?>
<html>
<style type="text/css">
    body {
        	font-size: 13px;
         }
</style>
<body>

	<?php 
	$data_krs=mysqli_query($connect, "SELECT * FROM master_krs, master_student
					                            		where 
					                            		master_krs.student_nim=master_student.student_nim AND
					                            		master_student.majors_code='$majors_code' AND
					                            		master_krs.krs_package_id!='' AND
					                            		master_krs.krs_school_year='$sy' AND
					                            		master_krs.krs_semester='$sm'
					                            		group by master_krs.student_nim, master_krs.krs_school_year, master_krs.krs_semester 
					                            		ORDER BY master_student.student_nim asc LIMIT $row,10");
	while ($krs=mysqli_fetch_array($data_krs)) {

	$data=mysqli_query($connect, "SELECT * FROM master_student
									LEFT JOIN master_college ON master_college.college_code=master_student.college_code
									LEFT JOIN master_majors ON master_majors.majors_code=master_student.majors_code
									LEFT JOIN master_lecturer ON master_lecturer.lecturer_code=master_student.student_advisor
									LEFT JOIN account ON account.account_id=master_student.account_id
									where master_student.student_nim='$krs[student_nim]'");
	$student=mysqli_fetch_array($data);
	?>

	<p align="left"><img src="../../../assets/logo/STDI2.png" alt="" width="126" height="109"></p>
	
	<table width="100%">
		<tr>
            <td width="15%">Semester/TA.</td>
            <td width="30%">: <?= $sm; ?>/<?= $sy; ?></td>
            <td rowspan="5">
                
                <img src="../../assets/account_photo/<?= $student['account_photo']; ?>" style="width:100px" onerror="this.onerror=null;this.src='../../assets/account_photo/image.jpg';">
            </td>
            <td align="right" width="50%" rowspan="5"><font size="20px">Kartu Peserta <br> 
                      <b>UJIAN TENGAH SEMESTER</b></font></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <?= $student['majors']; ?></td>
        </tr>
        <tr>
            <td>N I M</td>
            <td>: <?= $student['student_nim']; ?></td>
        </tr>
        <tr>
            <td>N a m a</td>
            <td>: <?= $student['student_name']; ?></td>
        </tr>
        <tr>
            <td>Dosen Wali</td>
            <td>: <?= $student['lecturer_name']; ?></td>
        </tr>
	</table>

	<div style="background:url(../../../assets/logo/STDI.png); 
					background-repeat: no-repeat;
					background-position:center center;
                    background-size: auto; 
                    opacity: 0.2;">


		
		<br>


		<table width="100%" rules="all" style="border:1px solid black;">
			<thead>
				<tr>
                    <th width="4%" rowspan="2">NO</th>
                    <th width="11%" rowspan="2">KODE</th>
                    <th width="30%" rowspan="2">MATA KULIAH</th>
                    <th width="5%" rowspan="2">SKS</th>
                    <th width="13%" rowspan="2">KLS/RUANG</th>
                    <th width="18%" rowspan="2">TANGGAL</th>
                    <th colspan="2">PARAF</th>
                </tr>
                <tr>
                    <th width="9%">PWS1</th>
                    <th width="10%">PWS2</th>
                 </tr>
			</thead>
			<tbody>
			<?php
			$no=1;
			$data=mysqli_query($connect, "SELECT * FROM master_krs
				where 
					master_krs.student_nim='$student[student_nim]' AND
					master_krs.krs_school_year='$sy' AND
					master_krs.krs_semester='$sm' AND 
					master_krs.krs_approved='Approved'");
			while ($row=mysqli_fetch_array($data)) {

				$cm=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum as mc
					LEFT JOIN master_curriculum_uts as mct ON mct.curriculum_id=mc.curriculum_id
					LEFT JOIN master_class as mclass ON mclass.class_code=mct.uts_class_code
					LEFT JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					LEFT JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					where curriculum_id='$row[curriculum_id]'"));

			?>
				<tr>
					<td align="center"><?= $no; ?></td>
					<td><?= $cm['courses_code']; ?></td>
					<td><?= $cm['courses']; ?></td>
					<td><?= $cm['courses_sks']; ?></td>
					<td><?= $cm['class_room']; ?>/<?= $cm['class']; ?></td>
					<td><?= $cm['uts_date']; ?>, <?= substr($cm['uts_start'],0,5); ?> - <?= substr($cm['uts_end'],0,5); ?></td>
					<td></td> 
                    <td></td>
					
				</tr>
			<?php $no++; } ?>
			</tbody>
		 </table>

		 <table width="100%">
				<tr>
                      <td width="70%" valign="top">
                        <p>CATATAN : <br>
                        - Pada saat memasuki ruangan Ujian Peserta wajib menyerahkan <br> 
                        KPU ini ke Dosen atau Pengawas Ujian.</p></td>
                      <td valign="top">
                        Jakarta, <?= date('d M Y'); ?> <br>
                        Ketua <br><br><br><br><br><br> <?= $student['college_dean']; ?>
                      </td>
                    </tr>
		 </table>


		</div>

		<p style="page-break-after: always;"></p>
		<?php } ?>
</body>
</html>


<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("A4", "potrait");
$dompdf->render();
$dompdf->stream('KPU UTS ALL.pdf',array('Attachment'=>0));
 
?>