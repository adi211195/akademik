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
  INNER JOIN master_college as mcollege ON mcollege.college_code=mc.college_code
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
                  <tr>
                  <td width="15%" rowspan="3">
                    <span style="padding: 10px 5px 5px 5px;"><img src="../../../assets/logo/STDI2.png" alt="" width="144" height="110" align="texttop">
                    </span>
                  </td>
                  <td  height="21"><h3 align="center">BERITA ACARA <BR> UJIAN TENGAH SEMESTER (UTS)</h3></td>                
                </tr>
                <tr>
                  <td height="21"><h3 align="center">SEMESTER <?= strtoupper($mc['curriculum_semester']); ?> - <?= $mc['curriculum_school_year']; ?></h3></td>
                </tr>
                <tr>
                  <td height="21"><h3 align="center">SEKOLAH TINGGI DESAIN INTERSTUDI</h3></td>
                </tr>
                                        
              </table>


              <table width="100%">
                <tr>
                  <td width="20%">Fakultas</td>
                  <td>: <?= $mc['college']; ?></td>
                  <td width="20%">Kelas</td>
                  <td>: <?= $mc['class']; ?></td>
                </tr>

                <tr>
                    <td>Program Studi</td>
                    <td>: <?= $mc['majors']; ?></td>
                    <td>Hari</td>
                    <td>: <?= $mc['uts_date']; ?></td>
                </tr>

                <tr>
                    <td>Semeser</td>
                    <td>: <?= strtoupper($mc['curriculum_semester']); ?> - <?= $mc['curriculum_school_year']; ?></td>
                    <td>Tanggal</td>
                    <td>: <?= $mc['uts_date']; ?></td>
                </tr>

                <tr>
                    <td>Matakuliah</td>
                    <td>: <?= $mc['courses']; ?></td>
                    <td width="20%">Ruang</td>
                    <td>: UTS Online</td>
                </tr>
                <tr>
                    <td>Dosen</td>
                    <td>: <?= $mc['lecturer_name']; ?></td>
                    <td width="20%">Waktu</td>
                    <td>: <?= substr($mc['uts_start'],0,5); ?> - <?= substr($mc['uts_end'],0,5); ?></td>
                </tr>
            </table>


                          <table width="100%" rules="all" style="border:1px solid black;">
                          <thead>
                            <tr>
                              <th colspan="5" height="36">CATATAN PENGAWAS</th>
                            </tr>
                            <tr>
                              <th width="5%" height="36">NO</th>
                              <th width="10%">N I M</th>
                              <th width="35%">N A M A</th>
                              <th width="25%">KEJADIAN</th>
                              <th width="25%">KETERANGAN</th>
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
                              <td height="20" style="padding: 10px 5px 5px 5px;" align="center"><?php echo $no; ?></td>
                              <td style="padding: 10px 5px 5px 5px;" align="center"><?= $row['student_nim']; ?></td>
                              <td style="padding: 10px 5px 5px 5px;"><?= strtoupper($row['student_name']); ?></td>
                              <td style="padding: 10px 5px 5px 5px;"></td>
                              <td style="padding: 10px 5px 5px 5px;"></td>
                            </tr>
                            <?php $no++; }} ?>
                          </tbody>
                      </table>
                      <p>&nbsp;</p>

                          <?php
                          $no2=0;
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
                                    $no2++; }} ?>


                      <table width="100%" rules="all" style="border:1px solid black;">
                        <thead>
                          <tr>
                            <th height="36">MAHASISWA</th>
                            <th>DOSEN PENGAWAS</th>
                            <th>TANDA TANGAN</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td height="20" style="padding: 10px 5px 5px 5px;">JUMLAH  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $no2; ?> ORANG</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td height="20" style="padding: 10px 5px 5px 5px;">HADIR  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ........ ORANG</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td height="20" style="padding: 10px 5px 5px 5px;">TIDAK HADIR  &nbsp;&nbsp;: ........ ORANG</td>
                            <td></td>
                            <td></td>
                          </tr>
                        </tbody>
                      </table>
                      <p>&nbsp;</p>

                      <table width="100%">
                        <tr>
                          <td width="70%" valign="top"></td>
                          <td width="30%" valign="top"> Jakarta, <?= $mc['uts_date']; ?>
                            
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <?= $mc['lecturer_name']; ?></td>
                        </tr>
                      </table>
                        
              </body>
              </html>

<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("legal", "lanscape");
$dompdf->render();
$dompdf->stream('BAP UTS.pdf',array('Attachment'=>0));
 
?>