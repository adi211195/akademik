<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=PDPT_CLASS.xls");

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
                        <th>Courses Code</th>
                        <th>Courses</th>
                        <th>Class</th>
                        <th>Discussion</th>
                        <th>Effective Start Date</th>
                        <th>Effective End Date</th>
                        <th>Prodi</th>
                      </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $no=1;
                        $data=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
                               INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
                               INNER JOIN master_majors as mmaj ON mmaj.majors_code=mc.majors_code
                               INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
                               INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
                               where mc.curriculum_school_year='$sy' AND
                                mc.curriculum_semester='$sm'
                                mc.majors_code='$majors[majors_code]'
                                order by mlecturer.lecturer_nidn asc");
                        while ($row=mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <td><?= $row['courses_code'];?></td>
                            <td><?= $row['courses'];?></td>
                            <td><?= $row['curriculum_id'];?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?= $row['prodi_code'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                        
              </body>
              </html>
