<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=PDPT_STUDENT.xls");

include "../../../config/connection.php";
$gen         =htmlspecialchars($_GET['gen']);
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
                <body><p><b>Generation <?= $gen; ?> <br>
                <?= $college['college']; ?> Majors <?= $majors['majors']; ?></b></p>

                  <table border="1">
                    <thead>
                      <tr class="headings">
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>NIK</th>                        
                        <th>Agama</th>
                        <th>NISN</th>
                        <th>Jalur Pendaftaran</th>
                        <th>NPWP</th>
                        <th>Kewarganegaraan</th>
                        <th>Jenis Pendaftaran</th>
                        <th>Tanggal Masuk Kuliah</th>
                        <th>Mulai Semester</th>
                        <th>Jalan</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Nama Dusun</th>
                        <th>Kelurahan</th>
                        <th>Kecamatan</th>
                        <th>Kode Pos</th>
                        <th>Jenis Tinggal</th>
                        <th>Alat Transportasi</th>
                        <th>Telp Rumah</th>
                        <th>No Hp</th>
                        <th>Email</th>
                        <th>Terima KPS</th>
                        <th>No KPS</th>
                        <th>NIK Ayah</th>
                        <th>Nama Ayah</th>
                        <th>Tanggal Lahir Ayah</th>
                        <th>Pendidikan Ayah</th>
                        <th>Pekerjaan Ayah</th>
                        <th>Penghasilan Ayah</th>
                        <th>NIK Ibu</th>
                        <th>Nama Ibu</th>
                        <th>Tanggal Lahir Ibu</th>
                        <th>Pendidikan Ibu</th>
                        <th>Pekerjaan Ibu</th>
                        <th>Penghasilan Ibu</th>
                        <th>Nama Wali</th>
                        <th>Tanggal Lahir Wali</th>
                        <th>Pendidikan Wali</th>
                        <th>Pekerjaan Wali</th>
                        <th>Penghasilan Wali</th>
                        <th>Kode Prodi</th>
                        <th>Jenis Pembiayaan</th>
                      </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $no=1;
                        $data=mysqli_query($connect, "SELECT * FROM  master_student 
                                          LEFT JOIN account on account.account_id=master_student.account_id
                                          where 
                                          master_student.majors_code='$majors_code' AND
                                          master_student.student_generation='$gen'
                                          ORDER BY master_student.student_nim asc");
                        while ($row=mysqli_fetch_array($data)) {
                          $father=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_father WHERE student_nim='$row[student_nim]'"));
                          $mother=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_mother WHERE student_nim='$row[student_nim]'"));
                          $guardian=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_guardian WHERE student_nim='$row[student_nim]'"));
                          
                        ?>
                        <tr>
                            <td><?= $row['student_nim'];?></td>
                            <td><?= $row['student_name'];?></td>
                            <td><?= $row['student_place_birth']; ?></td>
                            <td><?= $row['student_date_birth']; ?></td>
                            <td><?= $row['student_gender']; ?></td>
                            <td><?= $row['student_nik']; ?></td>
                            <td><?= $row['student_religion']; ?></td>
                            <td><?= $row['student_nisn']; ?></td>
                            <td><?= $row['student_registration_path']; ?></td>
                            <td><?= $row['student_npwp']; ?></td>
                            <td><?= $row['student_citizenship']; ?></td>
                            <td><?= $row['student_registration_type']; ?></td>
                            <td><?= $row['student_college_entry_date']; ?></td>
                            <td><?= $row['student_start_semester']; ?></td>
                            <td><?= $row['student_address']; ?></td>
                            <td><?= $row['student_address_rt']; ?></td>
                            <td><?= $row['student_address_rw']; ?></td>
                            <td><?= $row['student_address_village']; ?></td>
                            <td><?= $row['student_address_ward']; ?></td>
                            <td><?= $row['student_address_districts']; ?></td>
                            <td><?= $row['student_poscode']; ?></td>
                            <td><?= $row['student_type_stay']; ?></td>
                            <td><?= $row['student_transportation']; ?></td>
                            <td><?= $row['student_phone']; ?></td>
                            <td><?= $row['student_handphone']; ?></td>
                            <td><?= $row['account_email']; ?></td>
                            <td><?= $row['student_kps']; ?></td>
                            <td><?= $row['student_no_kps']; ?></td>
                            <td><?= $father['father_nik']; ?></td>
                            <td><?= $father['father_name']; ?></td>
                            <td><?= $father['father_date_birth']; ?></td>
                            <td><?= $father['father_education']; ?></td>
                            <td><?= $father['father_profession']; ?></td>
                            <td><?= $father['father_income']; ?></td>
                            <td><?= $mother['mother_nik']; ?></td>
                            <td><?= $mother['mother_name']; ?></td>
                            <td><?= $mother['mother_date_birth']; ?></td>
                            <td><?= $mother['mother_education']; ?></td>
                            <td><?= $mother['mother_profession']; ?></td>
                            <td><?= $mother['mother_income']; ?></td>
                            <td><?= $guardian['guardian_name']; ?></td>
                            <td><?= $guardian['guardian_date_birth']; ?></td>
                            <td><?= $guardian['guardian_education']; ?></td>
                            <td><?= $guardian['guardian_profession']; ?></td>
                            <td><?= $guardian['guardian_income']; ?></td>
                            <td><?= $majors['prodi_code']; ?></td>
                            <td><?= $row['student_type_of_financing']; ?></td>

                        </tr>
                        <?php } ?>
                    </tbody>
                  </table>
                        
              </body>
              </html>
