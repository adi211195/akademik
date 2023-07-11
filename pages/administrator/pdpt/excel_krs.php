<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=PDPT_KRS.xls");

include "../../../config/connection.php";
$sy                 =htmlspecialchars($_GET['sy']);
$sm                 =htmlspecialchars($_GET['sm']);
$college_code       =htmlspecialchars($_GET['college_code']);
$majors_code        =htmlspecialchars($_GET['majors_code']);

$college=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_college where college_code='$college_code'"));
$majors=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_majors where majors_code='$majors_code'"));

?>
        <html>
                <style type="text/css">
                    body {
                        font-size: 13px;
                    }
                </style>
                <body><p><b>School Year <?= $sy; ?> Semester <?= $sm; ?> <br>
                <?= $college['college']; ?> Majors <?= $majors['majors']; ?></b></p>

                  <table border="1">
                    <thead>
                      <tr class="headings">
                        <th>NIM</th>
                        <th>Name</th>
                        <th>Semester</th>
                        <th>Courses Code</th>
                        <th>Courses</th>
                        <th>Schedule ID</th>
                        <th>Prodi</th>
                      </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $no=1;
                        $data=mysqli_query($connect, "SELECT * FROM master_krs, master_student 
                                          where 
                                          master_krs.student_nim=master_student.student_nim AND
                                          master_student.majors_code='$majors_code' AND
                                          master_krs.krs_school_year='$sy' AND
                                          master_krs.krs_semester='$sm'
                                          ORDER BY master_student.student_nim asc");
                        while ($row=mysqli_fetch_array($data)) {
                          $curriculum=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum as mc
                               INNER JOIN master_majors as mmaj ON mmaj.majors_code=mc.majors_code
                               INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
                               where mc.curriculum_id='$row[curriculum_id]'"));
                        ?>
                        <tr>
                            <td><?= $row['student_nim'];?></td>
                            <td><?= $row['student_name'];?></td>
                            <td><?= $sy; ?> / <?= $sm; ?></td>
                            <td><?= $curriculum['courses_code']; ?></td>
                            <td><?= $curriculum['courses']; ?></td>
                            <td><?= $curriculum['curriculum_id']; ?></td>
                            <td><?= $curriculum['prodi_code'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                        
              </body>
              </html>
