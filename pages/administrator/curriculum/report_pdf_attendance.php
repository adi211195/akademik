<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$id=htmlspecialchars(@$_GET['id']);

$mc=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
	INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
	INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
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
	

                <img src="../../../assets/logo/STDI2.png" alt="" width="144" height="110" align="texttop">
                
                <p align="center"><font size="18px"><b>Daftar Hadir Kuliah Mahasiswa (DHKM) <br> Semester <?= $mc['curriculum_semester']; ?> / <?= $mc['curriculum_school_year']; ?></b></font></p>
                
        
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
                        <td>: <?= $mc['curriculum_day']; ?></td>
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
                        <td>: <?= substr($mc['curriculum_start'],0,5); ?> - <?= substr($mc['curriculum_end'],0,5); ?></td>
                    </tr>
                    	<?php 
                    	$mhs=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs 
                                        where curriculum_id='$id' AND
                                        krs_approved='Approved'"));                    	
                        ?>           

                    <tr>
                        <td>Dosen</td>
                        <td>: <?= $mc['lecturer_name']; ?></td>
                        <td width="20%">Jml MHS</td>
                        <td>: <?= $mhs; ?></td>
                    </tr>
                    </table>

                    <table width="100%" rules="all" style="border:1px solid black;">            
                    <thead>   
                            <tr>
                              <th width="5%" style="padding: 10px 5px 5px 5px;" rowspan="2">NO</th>
                              <th width="10%" style="padding: 10px 5px 5px 5px;" rowspan="2">NIM</th>
                              <th width="25%" style="padding: 10px 5px 5px 5px;" rowspan="2">NAMA</th>
                              <th style="padding: 10px 5px 5px 5px;" colspan="7">TANGGAL TATAP MUKA</th>
                              <th width="10%" style="padding: 10px 5px 5px 5px;" rowspan="2">KET</th>
                            </tr>
                            <tr>
                              <th style="padding: 10px 5px 5px 5px;">&nbsp;</th>
                              <th style="padding: 10px 5px 5px 5px;">&nbsp;</th>
                              <th style="padding: 10px 5px 5px 5px;">&nbsp;</th>
                              <th style="padding: 10px 5px 5px 5px;">&nbsp;</th>
                              <th style="padding: 10px 5px 5px 5px;">&nbsp;</th>
                              <th style="padding: 10px 5px 5px 5px;">&nbsp;</th>
                              <th style="padding: 10px 5px 5px 5px;">&nbsp;</th>
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
                       
                    ?>
                    <tr>
                        <td style="padding: 10px 5px 5px 5px;" align="center"><?= $no; ?></td>
                        <td style="padding: 10px 5px 5px 5px;"><?= $row['student_nim']; ?></td>
                        <td style="padding: 10px 5px 5px 5px;"><?= $row['student_name']; ?></td>
                        <td style="padding: 10px 5px 5px 5px;"></td>
                        <td style="padding: 10px 5px 5px 5px;"></td>                           
                        <td style="padding: 10px 5px 5px 5px;"></td>
                        <td style="padding: 10px 5px 5px 5px;"></td>
                        <td style="padding: 10px 5px 5px 5px;"></td>
                        <td style="padding: 10px 5px 5px 5px;"></td>
                        <td style="padding: 10px 5px 5px 5px;"></td>
                        <td style="padding: 10px 5px 5px 5px;"></td>
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
$dompdf->set_paper("A4", "landscape");
$dompdf->render();
$dompdf->stream('Attendance.pdf',array('Attachment'=>0));
 
?>