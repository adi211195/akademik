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
                        font-size: 12px;
                    }
                </style>
                <body>
    <img src="../../../assets/logo/STDI2.png"  style="position:absolute;" width="100%" height="100%">
    <div  style="position:absolute;">

                <table width="100%">
                  <tr>
                  <td width="15%" rowspan="2">
                  <img src="../../../assets/logo/STDI2.png" alt="" width="75" height="60" align="texttop">
                  </td>
                  <td align="center" style="font-size: 20px;"><b>SEKOLAH TINGGI DESAIN INTERSTUDI <br> BERITA ACARA PERKULIAHAN ( BAP )</b></td>                
                </tr>                                        
              </table>

              <table width="100%">
                <tr>
                  <th>NAMA DOSEN : <?= $mc['lecturer_name']; ?></th>
                  <th>HARI : <?= $mc['curriculum_day']; ?></th>
                  <th>KELAS : <?= $mc['class']; ?></th>
                  <th>RUANG : <?= $mc['class_room']; ?></th>
                  <th>MATAKULIAH : <?= $mc['courses']; ?></th>
                </tr>
            </table>

            <table width="100%" rules="all" style="border: 1px solid black;">
              <thead>
                <tr>
                  <th>HARI & TGL  PERTEMUAN </th>
                  <th>PARAF DOSEN</th>
                  <th>TATAP MUKA</th>
                  <th>POKOK PEMBAHASAN</th>
                  <th width="20%">MATERI</th>
                  <th>KETERANGAN</th>
                  <th>WAKTU PERKULIAHAN</th>
                  <th>PARAF <br> LAYANAN  BAA <br> ( STAFF BAA )</th>
                  <th>PARAF <br> PROGRAM STUDI <br> ( KAPRODI ) </th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i=1; $i < 9; $i++) { 

                  if ($i==8) {
                    $sts="(UTS)";
                  } elseif ($i==16) {
                    $sts="(UAS)";
                  } else {
                    $sts="";
                  }

                    ?>
                  
                <tr>
                  <td rowspan="2" height="20"></td>
                  <td rowspan="2"></td>
                  <td rowspan="2" align="center"><b><?= $i; ?> <br> <?= $sts; ?></b></td>
                  <td rowspan="2"></td>
                  <td rowspan="2"></td>
                  <td rowspan="2"></td>
                  <td height="20">MASUK : <br><br> </td>
                  <td rowspan="2"></td>
                  <td rowspan="2"></td>
                </tr>
                <tr>
                  <td height="20">KELUAR :  <br><br></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>


    </div>

    <p style="page-break-after: always;">&nbsp;</p>
    <img src="../../../assets/logo/STDI2.png"  style="position:absolute;" width="100%" height="100%">
    <div  style="position:absolute;">
    <table width="100%" rules="all" style="border: 1px solid black;">
              <thead>
                <tr>
                  <th>HARI & TGL  PERTEMUAN </th>
                  <th>PARAF DOSEN</th>
                  <th>TATAP MUKA</th>
                  <th>POKOK PEMBAHASAN</th>
                  <th width="20%">MATERI</th>
                  <th>KETERANGAN</th>
                  <th>WAKTU PERKULIAHAN</th>
                  <th>PARAF <br> LAYANAN  BAA <br> ( STAFF BAA )</th>
                  <th>PARAF <br> PROGRAM STUDI <br> ( KAPRODI ) </th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i=9; $i < 17; $i++) { 

                  if ($i==8) {
                    $sts="(UTS)";
                  } elseif ($i==16) {
                    $sts="(UAS)";
                  } else {
                    $sts="";
                  }

                    ?>
                  
                <tr>
                  <td rowspan="2" height="20"></td>
                  <td rowspan="2"></td>
                  <td rowspan="2" align="center"><b><?= $i; ?> <br> <?= $sts; ?></b></td>
                  <td rowspan="2"></td>
                  <td rowspan="2"></td>
                  <td rowspan="2"></td>
                  <td height="20">MASUK : <br><br> </td>
                  <td rowspan="2"></td>
                  <td rowspan="2"></td>
                </tr>
                <tr>
                  <td height="20">KELUAR :  <br><br></td>
                </tr>
              <?php } ?>
              </tbody>
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
$dompdf->stream('BAP PERKULIAHAN.pdf',array('Attachment'=>0));
 
?>