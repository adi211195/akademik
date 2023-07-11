<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=ATTENDANCE LECTURER.xls");

include "../../../config/connection.php";
$majors_code        =htmlspecialchars(@$_GET['code']);
$sy                 =htmlspecialchars(@$_GET['sy']);
$sm                 =htmlspecialchars(@$_GET['sm']);

$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
			LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
			WHERE majors_code='$majors_code'"));
?>

<html>
                <style type="text/css">
                    body {
                        font-size: 13px;
                    }
                </style>
                <body>
                  <p align="center"><b>
                    PRESENTASE KEHADIRAN DOSEN TETAP DAN DOSEN LUAR BIASA <br>
                    SEMESTER <?= strtoupper($sm); ?> TA. <?= $sy; ?> <br>
                    JURUSAN <?= strtoupper($code['majors']); ?> <br>
                    SEKOLAH TINGGI DESAIN INTERSTUDI
                  </b></p>
                    
                  <table border="1">
                    <thead>
                      <tr class="headings">
                        <th rowspan="3">NO</th>
                        <th rowspan="3">MTK</th>
                        <th rowspan="3">SKS</th>
                        <th rowspan="3">KELAS</th>
                        <th rowspan="3">SMT</th>
                        <th rowspan="3">NAMA DOSEN</th>
                        <th colspan="28">TATAP MUKA</th>
                        <th rowspan="3">JML TATAP MUKA</th>
                        <th rowspan="3">%</th>
                      </tr>
                      <tr>
                          <th colspan="2">I</th>
                          <th colspan="2">II</th>
                          <th colspan="2">III</th>
                          <th colspan="2">IV</th>
                          <th colspan="2">V</th>
                          <th colspan="2">VI</th>
                          <th colspan="2">VII</th>
                          <th colspan="2">VIII</th>
                          <th colspan="2">IX</th>
                          <th colspan="2">X</th>
                          <th colspan="2">XI</th>
                          <th colspan="2">XII</th>
                          <th colspan="2">XIII</th>
                          <th colspan="2">XIV</th>
                      </tr>
                      <tr>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                          <th>HARI</th>
                          <th>JAM</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $no = 1;
                      $jum = 1;
                      $data=mysqli_query($connect, "SELECT mc.*,
                      						mclass.*,
                      						mcourses.*,
                      						mlecturer.*,
                      						(SELECT COUNT(lecturer_code) FROM master_curriculum WHERE 
                      						majors_code=mc.majors_code AND
                      						curriculum_school_year=mc.curriculum_school_year AND
                      						curriculum_semester=mc.curriculum_semester AND
                      						lecturer_code=mc.lecturer_code) AS jumlah

                      						FROM master_curriculum as mc
					                        INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					                        INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					                        INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					                        where mc.majors_code='$majors_code' AND 
					                        mc.curriculum_school_year='$sy' AND
					                        mc.curriculum_semester='$sm'");


                      while ($row=mysqli_fetch_array($data)) {
                      ?>
                      <tr class="even pointer">

                        <?php if($jum <= 1) { ?>

                        <td rowspan="<?= $row['jumlah']; ?>"><?= $no; ?></td>

                        <?php 
                            $no++;   
                            $jum = $row['jumlah'];                  
                        } else {
                            $jum = $jum - 1;
                        } ?>

                        <td><?= $row['courses']; ?></td>
                        <td><?= $row['courses_sks']; ?></td>
                        <td><?= $row['class']; ?>/<?= $row['class_room']; ?></td>
                        <td><?= $row['courses_smt']; ?></td>
                        <td><?= $row['lecturer_name']; ?></td>
                                               
                        <?php 
                        $jml_absensi=0;
                        for ($i=0; $i < 14 ; $i++) {
                        $absensi=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_attendance 
                        	WHERE curriculum_id='$row[curriculum_id]'  LIMIT $i,1"));

                        if ($absensi>0) {
                            $jml_absensi++;
                        ?>
                            <td><?= $row['curriculum_day']; ?></td>
                            <td><?= substr($row['curriculum_start'], 0,5); ?> - <?= substr($row['curriculum_end'], 0,5); ?></td>
                        <?php } else { ?>
                            <td></td>
                            <td></td>
                        <?php }} 
                        $persentase=($jml_absensi/$row['curriculum_face'])*100; ?>

                            <td><?= $row['curriculum_face']; ?></td>   
                            <td><?= round($persentase); ?></td>                     

                          </tr>

                      <?php } ?>
                    </tbody>
                  </table>
                        
              </body>
              </html>
