<?php
include "../../../config/connection.php";
include "../../../config/function_date.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$id		=htmlspecialchars($_GET['id']);
$data=mysqli_query($connect, "SELECT * FROM master_ijasah
									LEFT JOIN master_student ON master_student.student_nim=master_ijasah.student_nim
									LEFT JOIN master_college ON master_college.college_code=master_student.college_code
									LEFT JOIN master_majors ON master_majors.majors_code=master_student.majors_code
									LEFT JOIN account ON account.account_id=master_student.account_id
									where master_ijasah.ijasah_id='$id'");
$student=mysqli_fetch_array($data);

ob_start(); 
?>
<html>
<style type="text/css">
	 b {
		font-size:14px;
	}
				        
	i {
		font-size:13px;
	}
				        
	p b.name {
        font-family: "Monotype Corsiva";
        font-style: italic;
        font-size:24px;
    }
                        
     p i.name {
        font-family: "Monotype Corsiva";
        font-style: italic;
        font-size:13px;
    }
                        
    html { margin: 0px}
		
</style>
<body>
	<div  style="position:absolute;">
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Nomor Ijazah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $student['ijasah_number']; ?></b> <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i>Number of Certificate</i>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <br>
                <p align="center"><b>Memberikan Ijazah kepada</b> <br>
                                <i>Awards this certification to :</i><br>
                                <b  class="name"><?= ucwords(strtolower($student['student_name'])); ?></b><br>
                                <b>NIM : <?= $student['student_nim']; ?></b> <br>
                                <i>Student Registration Number</i></p>
                                
                <p align="center">
                    
                                <?php if ($student['college_code']!="06") { ?>
                                <b>Lahir Di <?= ucwords(strtolower($student['student_place_birth'])); ?> tanggal <?= tgl_indo($student['student_date_birth']); ?> telah menyelesaikan dengan baik 
                                dan memenuhi segala persyaratan pendidikan pada <br>
                                
                                Program Studi <?= $student['majors']; ?> Fakultas <?= $student['college']; ?></b><br>
                                
                                <i>Born in <?= ucwords(strtolower($student['student_place_birth'])); ?> <?= tgl_ing($student['student_date_birth']); ?>, who has successfully completed the Bachelor Program <br>
                                in <?= $student['majors']; ?> at The Faculty of <?= $student['college']; ?></i><br>
                                
                                <?php } else { ?>
                                
                                <b>Lahir Di <?= ucwords($tmt1); ?> tanggal <?= tgl_indo($student['student_date_birth']); ?> telah menyelesaikan dengan baik 
                                dan memenuhi segala persyaratan pendidikan <br>
                                pada Program Studi Hukum Program Magister </b><br>
                                
                                <i>Born in <?= ucwords(strtolower($student['student_place_birth'])); ?> <?= tgl_ing($student['student_date_birth']); ?>, who has successfully completed the Master in Law Program</i>
                                <?php } ?>
                                
                                
                                
                                <b>dan telah dinyatakan lulus pada tanggal <?= tgl_indo($student['ijasah_date']); ?></b><br>
                                <i>and graduated on <?= tgl_ing($student['ijasah_date']); ?></i><br>
                                
                                <b>status terakreditasi sesuai Keputusan Badan Akreditasi Nasional Perguruan Tinggi <br>
                                Kementrian Riset dan Teknologi Republik Indonesia Nomor. 462/SK/BAN-PT/Akred/S/XII/2014 tanggal 08 Desember 2014</b><br>
                                <i>Status: Accredited, by virtue of the decree of the National Accreditation Board for Higher Eeducation of the <br>
                                Ministry of Research Technology and Higher Education of the Republic ofIndonesia, Number: 462/SK/BAN-PT/Akred/S/XII/2014, dated 08<sup>th</sup> December 2014</i><br>
                                
                                <b>dan oleh karena itu kepadanya diberikan gelar</b><br>
                                <i>and therefore confers on her/him the degree of</i><br>
                                
                                <b class="name"><?= $student['gelar_indo']; ?></b><br>
                                <i class="name"><?= $student['gelar_ing']; ?></i><br>
                                
                                <b>beserta segala hak dan kewajiban yang melekat pada gelar tersebut.</b><br>
                                 <i>and all the rights and obligations there to pertaining</i></p>
                
                
                <table width="100%">
                    <tr>
                        <td align="center"><b>Dekan,</b><br>
                                            <i>Dean,</i><br><br><br><br><br><br><br>
                                            <b><?= $student['college_dean']; ?></b></td>
                        <td align="right" width="40%"><img src="../../../assets/account_photo/<?= $student['account_photo']; ?>" width="125px" height="160px;"></td>
                        <td align="center"><b>Rektor,</b><br>
                                            <i>Rector,</i><br><br><br><br><br><br><br>
                                            <b>Drs. Soenarto Sardiatmadja, M.B.A., M.M.</b></td>
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
$dompdf->set_paper("A4", "landscape");
$dompdf->render();
$dompdf->stream('IPS.pdf',array('Attachment'=>0));
 
?>