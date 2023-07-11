<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$id=htmlspecialchars(@$_GET['id']);

$mc=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
	INNER JOIN master_curriculum_uts as mcuts ON mcuts.curriculum_id=mc.curriculum_id
	INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
	INNER JOIN master_class as mclass ON mclass.class_code=mcuts.uts_class_code
	INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
	INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
	INNER JOIN master_majors as mmajors ON mmajors.majors_code=mc.majors_code
	where mc.curriculum_id='$id'"));

ob_start(); 
?>
<html>
<style type="text/css">
    body {
        	font-size: 13px;
         }
</style>
<body>
	<table width="100%" rules="all" style="border:1px solid black;">
		<thead>
           	<tr>
                <td colspan="7" style="border-left: 1px solid white; border-right: 1px solid white; border-top: 1px solid white;">
                <table width="100%" rules="all" style="border:1px solid black;">
                    <tr>
                        <td width="21%" rowspan="3"><span style="padding: 10px 5px 5px 5px;"><img src="../../../assets/logo/STDI2.png" alt="" width="144" height="110" align="texttop"></span></td>
                        <td width="52%" height="21"><h2 align="center">PENJAMINAN MUTU</h2></td>
                        <td width="27%" rowspan="3"><div align="center"><h3>No. Dok : SNP/F/SPMI/6A</h3></div></td>
                    </tr>
                    <tr>
                        <td height="21"><h2 align="center">Sekolah Tinggi Desain InterStudi</h2></td>
                    </tr>
                    <tr>
                        <td height="27"><h3 align="center">Formulir Daftar Hadir Ujian Tengah Semester</h3></td>
                    </tr>                       
                </table>


                <div align="center">
                <font size="16px"><b>Semester <?= $mc['curriculum_semester']; ?> - <?= $mc['curriculum_school_year']; ?></b></font></div>
                <table width="100%">
                    <tr>
                        <td width="20%">Program Studi</td>
                        <td>: <?= $mc['majors']; ?></td>
                        <td width="20%">Kelas</td>
                        <td>: <?= $mc['class']; ?></td>
                    </tr>
                	<tr>
                        <td>Kode MK</td>
                        <td>: <?= $mc['courses_code']; ?></td>
                        <td width="20%">Hari</td>
                        <td>: <?= $mc['uts_date']; ?></td>
                    </tr>
                    <tr>
                        <td>Matakuliah</td>
                        <td>: <?= $mc['courses']; ?></td>
                        <td width="20%">Ruang</td>
                        <td>: <?= $mc['class_room']; ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah SKS</td>
                        <td>: <?= $mc['courses_sks']; ?></td>
                        <td width="20%">Waktu</td>
                        <td>: <?= substr($mc['uts_start'],0,5); ?> - <?= substr($mc['uts_end'],0,5); ?></td>
                    </tr>
                    	<?php 
                    	$mhs=0;
                    	$data=mysqli_query($connect,"SELECT * FROM master_krs 
                    					where curriculum_id='$id' AND
                    					krs_approved='Approved'");
                    	while($row=mysqli_fetch_array($data)) {
                    		$ammount=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_attendance as ma
                    			INNER JOIN master_attendance_list as mal ON mal.attendance_id=ma.attendance_id
                    		WHERE curriculum_id='$id' AND
                    		student_nim='$row[student_nim]'"));

                    		if ($ammount>=$mc['uts_face']) {
                    			$mhs++;
                    		}
                    	}
                        ?>           

                    <tr>
                        <td>Dosen</td>
                        <td>: <?= $mc['lecturer_name']; ?></td>
                        <td width="20%">Jml MHS</td>
                        <td>: <?= $mhs; ?></td>
                    </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <th width="5%" height="36">NO</th>
                <th width="11%">N I M</th>
                <th width="41%">N A M A</th>
                <th width="7%">J M L</th>
                <th width="18%">TANDA TANGAN</th>
                <th width="9%">NILAI</th>
                <th width="9%">TUGAS</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no=1;
        $data=mysqli_query($connect,"SELECT * FROM master_krs 
        				LEFT JOIN master_student as ms ON ms.student_nim=master_krs.student_nim
                    	where curriculum_id='$id' AND
                    	krs_approved='Approved'");
        while($row=mysqli_fetch_array($data)) {
            $ammount=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_attendance as ma
                    			INNER JOIN master_attendance_list as mal ON mal.attendance_id=ma.attendance_id
                    		WHERE curriculum_id='$id' AND
                    		student_nim='$row[student_nim]' AND 
                            attendance_type='H'"));

            if ($ammount>=$mc['uts_face']) {
        ?>
        <tr>
            <td height="20" style="padding: 10px 5px 5px 5px;" align="center"><?= $no; ?></td>
            <td style="padding: 10px 5px 5px 5px;" align="center"><?= $row['student_nim']; ?></td>
            <td style="padding: 10px 5px 5px 5px;"><?= $row['student_name']; ?></td>
            <td style="padding: 10px 5px 5px 5px;" align="center"><?= $ammount; ?></td>
            <td style="padding: 10px 5px 5px 5px;"></td>
            <td style="padding: 10px 5px 5px 5px;"></td>
            <td style="padding: 10px 5px 5px 5px;"></td>
        </tr>
        <?php $no++; }} ?>
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
$dompdf->stream('Attendance UTS.pdf',array('Attachment'=>0));
 
?>