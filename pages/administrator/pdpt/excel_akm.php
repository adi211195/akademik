<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=PDPT_AKM.xls");

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
                <body>
                <p><b>School Year <?= $sy; ?> Semester <?= $sm; ?> <br>
                <?= $college['college']; ?> Majors <?= $majors['majors']; ?></b></p>

                  <table border="1">
                    <thead>
                      <tr class="headings">
                        <th>NIM</th>
                        <th>Name</th>
                        <th>Semester</th>
                        <th>SKS</th>
                        <th>IP Semester</th>
                        <th>SKS Komulatif</th>
                        <th>IP Komulatif</th>
                        <th>Status</th>
                        <th>Prodi</th>
                      </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $data=mysqli_query($connect,"SELECT * FROM master_krs as mk
                            INNER JOIN master_student as ms ON ms.student_nim=mk.student_nim
                        WHERE mk.krs_school_year='$sy'
                        AND mk.krs_semester='$sm'
                        AND ms.majors_code='$majors[majors_code]'
                        GROUP by mk.student_nim order by mk.student_nim asc");
                        while ($row=mysqli_fetch_array($data)){
                            
                            
                            $tot_sks_semester=0;
                            $nilai_semester=0;
                            $angka_mutu_semester=0;
                            $data_ips=mysqli_query($connect, "SELECT * FROM master_score as ms
                            INNER JOIN master_courses as mc ON mc.courses_code=ms.courses_code
                                where 
                            ms.score_school_year='$sy' AND 
                            ms.score_semester='$sm' AND
                            ms.score_alphabet!='' AND 
                            ms.student_nim='$row[student_nim]'
                            group by ms.courses_code order by ms.create_date desc");
                            while ($row2=mysqli_fetch_array($data_ips)) {
                                
                                $nilai_semester=$nilai_semester+($row2['courses_sks']*$row2['score_quality']);
                                $tot_sks_semester=$tot_sks_semester+$row2['courses_sks'];
                            
                            }
                            
                            
                            
                            $nilai_ipk=0;
                            $angka_mutu_ipk=0;
                            $tot_sks_ipk=0;
                            $data_ipk=mysqli_query($connect, "SELECT * FROM master_score as ms
                            INNER JOIN master_courses as mc ON mc.courses_code=ms.courses_code
                                where 
                            ms.score_alphabet!='' AND 
                            ms.student_nim='$row[student_nim]'
                            group by ms.courses_code order by ms.create_date desc");
                            while ($row3=mysqli_fetch_array($data_ipk)) {


                            $nilai_ipk=$nilai_ipk+($row3['courses_sks']*$row3['score_quality']);
                            $tot_sks_ipk=$tot_sks_ipk+$row3['courses_sks'];
                            $angka_mutu_ipk=$angka_mutu_ipk+$row3['score_quality'];
                            
                            }
                            
                            
                            $grand_akhir= ROUND($nilai_ipk/$tot_sks_ipk,2);
                              if ($grand_akhir<="0") {
                                $angka_mutu2="0.00";
                              } else {
                                $angka_mutu2=round($grand_akhir,2);
                              }
    
    			            $quality=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM settings_range_ipk where 
                                  range_ipk_max<='$angka_mutu2' AND 
                                  range_ipk_min>='$angka_mutu2'"));
                            
                        ?>
                        <tr>
                            <td><?= $row['student_nim'];?></td>
                            <td><?= $row['student_name'];?></td>
                            <td><?= $sy; ?>/<?= $sm; ?></td>
                            <td><?= $tot_sks_semester; ?></td>
                            <td><?= ROUND($nilai_semester/$tot_sks_semester,2); ?></td>
                            <td><?= $tot_sks_ipk; ?></td>
                            <td><?= ROUND($nilai_ipk/$tot_sks_ipk,2); ?></td>
                            <td><?= $quality['range_ipk_alphabet']; ?></td>
                            <td><?= $majors['prodi_code'];?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                        
              </body>
              </html>
