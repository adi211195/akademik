<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$student_generation =htmlspecialchars(@$_POST['student_generation']);
$college_code       =htmlspecialchars(@$_POST['college_code']);
$majors_code        =htmlspecialchars(@$_POST['majors_code']);
$sy                 =htmlspecialchars(@$_POST['sy']);
$sm                 =htmlspecialchars(@$_POST['sm']);
$place              =htmlspecialchars(@$_POST['place']);

$majors=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_majors where majors_code='$majors_code'"));

ob_start(); 
?>
<html>
<style type="text/css">
    body {
        	font-size: 13px;
         }
</style>
<body>
	

                    <table  width="100%">
                        <thead>
                        <tr>
                            <td align="center" colspan="2"><b>KARTU MAHASISWA (STUDENT CARD)</b></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">SEKOLAH TINGGI DESAIN INTERSTUDI (STDI)</td></td>
                        </tr>
                        <tr>
                            <td width="30%">PROG STUDI/JURUSAN</td>
                            <td> : <?php echo strtoupper($majors['majors']); ?></td>
                        </tr>
                        <tr>
                            <td>ANGKATAN</td>
                            <td> : <?php echo strtoupper($student_generation); ?></td>
                        </tr>
                        <tr>
                            <td>TAHUN AKADEMIK</td>
                            <td> : <?php echo strtoupper($sy); ?></td>
                        </tr>
                        <tr>
                            <td>TEMPAT STUDI</td>
                            <td> : <?php echo strtoupper($place); ?></td>
                        </tr>
                        </thead>
                    </table>
                    <br>
                    <?php
                    $no=1;
                    $data=mysqli_query($connect, "SELECT * FROM account
                                    LEFT JOIN master_student ON master_student.account_id=account.account_id
                                    WHERE 
                                    master_student.majors_code='$majors_code' AND
                                    master_student.student_generation='$student_generation' AND
                                    account_status='Mahasiswa'");
                    while ($row=mysqli_fetch_array($data)) {
                    ?>
                    <div style="padding:5px; border:1px solid black; height:152px;">
                        <table width="100%">
                            <tr>
                                <td rowspan="6" width="20%" align="center"><div style="width:50px; height:70px; padding:20px; border:1px solid black;">2x3</div></td>
                                <td width="20%">Nama</td>
                                <td> : <b><?= $row['student_name']; ?></b></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td vlign="top"> : <?= $row['student_address']; ?></td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td> : <?= $row['student_nim']; ?></td>
                            </tr>
                            <tr>
                                <td>Program Studi</td>
                                <td> : <?= $majors['majors']; ?></td>
                            </tr>
                            <tr>
                                <td>Telp.</td>
                                <td> : <?= $row['student_phone']; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td align="right">Jakarta, <?= date('d M Y'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <p>&nbsp;</p>
                    <?php $jml=$no % 4;
                    if ($jml=="0") { ?>
                    <p style="page-break-after: always;">&nbsp;</p>
                    <?php } ?>
                    <?php $no++; } ?>
                     
</body>
</html>


<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("A4", "landscape");
$dompdf->render();
$dompdf->stream('Student Card.pdf',array('Attachment'=>0));
 
?>