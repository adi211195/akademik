<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$majors_code		=htmlspecialchars($_GET['code']);
$sy		=htmlspecialchars($_GET['sy']);
$sm		=htmlspecialchars($_GET['sm']);

$code=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_majors where majors_code='$majors_code'"));
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
	<p align="center"><font size="18px"><b>Jadwal Ujian Akhir Semester (UAS)<br>
						<?= $code['majors']; ?> <br>
						<?= $sy; ?> - <?= $sm; ?></b></font></p>
	<div style="background:url(../../../assets/logo/STDI.png); 
					background-repeat: no-repeat;
					background-position:center center;
                    background-size: auto; 
                    opacity: 0.2;">

    <div style="opacity: 1;">
    <?php
    $data2=mysqli_query($connect,"SELECT * FROM master_day");
    while ($day=mysqli_fetch_array($data2)) {
    ?>
    <table width="100%" rules="all" style="border:1px solid black;">
	<thead>
		<tr>
			<th colspan="8" align="left" style="background-color: #5ADC9D;">Day : <?= $day['day']; ?></th>
		</tr>
		 <tr>
			<th width="5%">No</th>
			<th>Types</th>			
			<th>Courses Code</th>
			<th>Courses</th>
			<th>SKS</th>
			<th>Room / Class</th>
			<th>Dosen | Schedule</th>
			<th>Time</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no=1;
		$data=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
				INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
				INNER JOIN master_curriculum_uas as mcuas ON mcuas.curriculum_id=mc.curriculum_id
				INNER JOIN master_class as mclass ON mclass.class_code=mcuas.uas_class_code
				INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
				INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
				where mc.majors_code='$majors_code' AND 
				mc.curriculum_school_year='$sy' AND
				mc.curriculum_semester='$sm' AND
				DAYNAME(mcuas.uas_date)='$day[day]'");
		while ($row=mysqli_fetch_array($data)) {
		?>
		<tr>
			<td><?= $no; ?></td>
			<td><?= $row['curriculum_types']; ?></td>
			<td><?= $row['courses_code']; ?> </td>
			<td><?= $row['courses']; ?> </td>
			<td><?= $row['courses_sks']; ?></td>
			<td><?= $row['class_room']; ?> / <?= $row['class']; ?></td>
			<td><?= $row['lecturer_name']; ?></td>
			<td><?= $row['uas_date']; ?>, <?= substr($row['uas_start'],0,5); ?> - <?= substr($row['uas_end'],0,5); ?></td>
		</tr>
		<?php $no++; } ?>
	</tbody>
	</table>
	<?php } ?>
	</div>
	</div>
</body>
</html>


<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("A4", "landscape");
$dompdf->render();
$dompdf->stream('Majors uas.pdf',array('Attachment'=>0));
 
?>