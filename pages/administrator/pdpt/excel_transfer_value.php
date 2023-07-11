<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=PDPT_SCORE.xls");

include "../../../config/connection.php";
$sy                 =htmlspecialchars($_GET['sy']);
$sm                 =htmlspecialchars($_GET['sm']);
$college_code       =htmlspecialchars($_GET['college_code']);
$majors_code        =htmlspecialchars($_GET['majors_code']);
$curriculum_id        =htmlspecialchars($_GET['curriculum_id']);

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
                        <th>Original Course code</th>
                        <th>Original Course</th>
                        <th>SKS</th>
                        <th>Origin Letter Value</th>
                        <th>Courses Code</th>
                        <th>Courses</th>                       
                        <th>Letter Value</th>
                        <th>Quality Figures</th>
                        <th>Final Score</th>
                        <th>Prodi</th>
                      </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $no=1;
                        $data=mysqli_query($connect, "SELECT * FROM master_score, master_student 
                                          where 
                                          master_score.student_nim=master_student.student_nim AND
                                          master_student.majors_code='$majors_code' AND
                                          master_score.curriculum_id='$curriculum_id' AND
                                          master_score.score_school_year='$sy' AND
                                          master_score.score_semester='$sm'
                                          ORDER BY master_student.student_nim asc");
                        while ($row=mysqli_fetch_array($data)) {
                          $curriculum=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum as mc
                               INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
                               INNER JOIN master_majors as mmaj ON mmaj.majors_code=mc.majors_code
                               INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
                               where mc.curriculum_id='$row[curriculum_id]'"));
                        ?>
                        <tr>
                            <td><?= $row['student_nim'];?></td>
                            <td><?= $row['student_name'];?></td>
                            <td><?= $curriculum['courses_code']; ?></td>
                            <td><?= $curriculum['courses']; ?></td>
                            <td><?= $curriculum['courses_sks']; ?></td>
                            <td><?= $row['score_alphabet']; ?></td>
                            <td><?= $curriculum['courses_code']; ?></td>
                            <td><?= $curriculum['courses']; ?></td>
                            <td><?= $row['score_alphabet']; ?></td>
                            <td><?= $row['score_quality']; ?></td>
                            <td><?= $row['score_numbers']; ?></td>
                            <td><?= $curriculum['prodi_code'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                        
              </body>
              </html>
