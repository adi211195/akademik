<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=PDPT_LECTURER.xls");

include "../../../config/connection.php";
$sy                 =htmlspecialchars($_GET['sy']);
$sm                 =htmlspecialchars($_GET['sm']);


?>
        <html>
                <style type="text/css">
                    body {
                        font-size: 13px;
                    }
                </style>
                <body>
                <p><b>School Year <?= $sy; ?> Semester <?= $sm; ?> </b></p>

                  <table border="1">
                    <thead>
                      <tr class="headings">
                        <th>NIDN</th>
                        <th>Name</th>
                        <th>Courses Code</th>
                        <th>Class</th>
                        <th>Face To Face</th>
                        <th>Face to Face Realization</th>
                        <th>Prodi</th>
                        <th>SKS</th>
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
                                order by mlecturer.lecturer_nidn asc");
                        while ($row=mysqli_fetch_array($data)) {
                            $attendance=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_attendance 
                                where curriculum_id='$row[curriculum_id]'"));
                        ?>
                        <tr>
                            <td><?= $row['lecturer_nidn'];?></td>
                            <td><?= $row['lecturer_name'];?></td>
                            <td><?= $row['courses_code'];?></td>
                            <td><?= $row['class_room']; ?> / <?= $row['class']; ?></td>
                            <td><?= $row['curriculum_face'];?></td>
                            <td><?= $attendance; ?></td>
                            <td><?= $row['prodi_code'];?></td>
                            <td><?= $row['courses_sks'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                        
              </body>
              </html>
