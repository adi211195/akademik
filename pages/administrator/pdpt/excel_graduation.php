<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=PDPT_GRADUATION.xls");

include "../../../config/connection.php";
$semester         =htmlspecialchars($_GET['semester']);
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
                <body><p><b>Semester <?= $semester; ?> <br>
                <?= $college['college']; ?> Majors <?= $majors['majors']; ?></b></p>

                  <table border="1">
                    <thead>
                      <tr class="headings">
                        <th>NIM</th>
                        <th>Nama </th>
                        <th>Jenis Keluar</th>
                        <th>Tanggal Keluar</th>
                        <th>Semester Keluar</th>
                        <th>SK Yudisium</th>
                        <th>Tanggal SK Yudisium</th>
                        <th>IPK</th>
                        <th>No. Seri Ijasah</th>
                        <th>Jenis Tugas Akhir</th>
                        <th>Judul Tugas Akhir/Tesis/Disertasi</th>
                        <th>Pembimbing I</th>
                        <th>Pembimbing II</th>
                        <th>Pembimbing III</th>
                        <th>Penguji I</th>
                        <th>Penguji II</th>
                        <th>Penguji III</th>
                        <th>Lokasi</th>
                        <th>No SK Tugas</th>
                        <th>Tanggal SK Tugas</th>
                        <th>Kode Prodi</th>
                      </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $no=1;
                        $data=mysqli_query($connect, "SELECT * FROM  master_alumni
                                          where 
                                          master_alumni.majors='$majors[majors]'
                                          ORDER BY master_alumni.alumni_npm asc");
                        while ($row=mysqli_fetch_array($data)) {
                          
                        ?>
                        <tr>
                            <td><?= $row['alumni_npm'];?></td>
                            <td><?= $row['alumni_name'];?></td>
                            <th><?= $row['alumni_exit_type']; ?></th>
                            <td><?= $row['alumni_exit_date']; ?></td>
                            <td><?= $row['alumni_exit_semester']; ?></td>
                            <td><?= $row['alumni_sk_yudisium']; ?></td>
                            <td><?= $row['alumni_sk_yudisium_date']; ?></td>
                            <td><?= $row['alumni_ipk']; ?></td>
                            <td><?= $row['alumni_no_ijasah']; ?></td>
                            <td><?= $row['alumni_thesis_type']; ?></td>
                            <td><?= $row['alumni_thesis']; ?></td>
                            <td><?= $row['alumni_mentor1']; ?></td>
                            <td><?= $row['alumni_mentor2']; ?></td>
                            <td><?= $row['alumni_mentor3']; ?></td>
                            <td><?= $row['alumni_examiner1']; ?></td>
                            <td><?= $row['alumni_examiner2']; ?></td>
                            <td><?= $row['alumni_examiner3']; ?></td>
                            <td><?= $row['alumni_location']; ?></td>
                            <td><?= $row['alumni_sk_task_number']; ?></td>
                            <td><?= $row['alumni_sk_task_date']; ?></td>
                            <td><?= $majors['prodi_code']; ?></td>

                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                        
              </body>
              </html>
