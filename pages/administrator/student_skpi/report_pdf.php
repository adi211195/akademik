<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$student_nim		=htmlspecialchars($_GET['nim']);
$data=mysqli_query($connect, "SELECT * FROM master_student_skpi
									LEFT JOIN master_student ON master_student.student_nim=master_student_skpi.student_nim
									LEFT JOIN master_college ON master_college.college_code=master_student.college_code
									LEFT JOIN master_majors ON master_majors.majors_code=master_student.majors_code
									where master_student_skpi.student_nim='$student_nim'");
$student=mysqli_fetch_array($data);
$skpi=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_skpi where student_nim='$student_nim'"));

ob_start(); 
?>
<html>
<style type="text/css">
    body {
			font-size: 12px;

        }

    table tr td {
			padding:5px;
		}

    table tr td p {
			padding: 0px;
			margin:0px;
		}
</style>
<body>
	<img src="../../../assets/logo/STDI.jpg" height="65px">
	<br>
	<table class="table" style="color:black;">
		                    <tr>
		                        <td width="50%"><b>SURAT KETERANGAN PENDAMPING IJAZAH <br> <i>Diploma Supplement</i></b></td>
		                        <td><?= $skpi['student_skpi_no']; ?></td>
		                    </tr>
		                    <tr>
		                        <td colspan="2">Surat Keterangan Pendamping Ijazah menerangkan Capaian Pembelajaran dan Prestasi 
		                            dari Pemegang Ijazah selama masa studi di Sekolah Tinggi Desain Interstudi
		                            <i>The Diploma Supplement Certifies the Study Accomplishment of Its Bearer During 
		                            the Period of Study at Interstudi College of Design</i>
		                            </td>
		                    </tr>
		                    <tr style="background:#DCDCDC; border:1px solid black;">
		                        <td colspan="2"><b>
		                            01.  IDENTITAS TENTANG IDENTITAS DIRI PEMEGANG SKPI <br>
		                            <i>01.  Information Identifying The Helder of Diploma Supplement</i></b>
		                        </td>
		                    </tr>
		                    <tr>
		                      <td><b>Nama Lengkap</b><br>
		                         <i>Full Name</i>
		                        </td>
		                      <td> <?= $student['student_name']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Tempat & Tanggal Lahir </b><br>
		                            <i>Place and Date of Birth</i>
		                      </td>
		                      <td> <?= $student['student_place_birth']; ?> , <?= $student['student_date_birth']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Nomor Induk Mahasiswa </b><br>
		                        <i>Student Identification Number</i>
		                        </td>
		                      <td> <?= $student['student_nim']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Tahun Masuk </b><br>
		                            <i>Admission Year</i>
		                            </td>
		                      <td><?= $skpi['student_skpi_entry_year']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Tanggal Kelulusan </b><br>
		                        <i>Date of Graduation</i>
		                        </td>
		                      <td><?= $skpi['student_skpi_graduation_date']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Nomor Ijazah </b><br>
		                        <i>Number of Certificate</i>
		                        </td>
		                      <td><?= $skpi['student_skpi_diploma_number']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Gelar</b><br>
		                        <i>Title</i>
		                        </td>
		                      <td><?= $skpi['student_skpi_degree']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Lama Studi</b><br>
		                        <i>Regular Length of Study</i>
		                        </td>
		                      <td><?= $skpi['student_skpi_length_study']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Sistem Kredit Semester</b><br>
		                        <i>Credits</i>
		                        </td>
		                      <td><?= $skpi['student_skpi_sks']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Indeks Prestasi Kumulatif</b><br>
		                        <i> Grade Point Average</i>
		                        </td>
		                      <td><?= $skpi['student_skpi_ipk']; ?></td>
		                    </tr>
		                    
		                    
		                    
		                    
		                    <tr style="background:#DCDCDC; border:1px solid black;">
		                        <td colspan="2"><b>02.  INFORMASI TENTANG IDENTITAS PENYELENGGARA PROGRAM <br>
		                            <i>02.  Information Identifying The Holder  of Diploma Supplement</i></b>
		                            </td>
		                    </tr>
		                    <tr>
		                        <td><b>SURAT KEPUTUSAN  PENDIRIAN PERGURUAN TINGGI
		                        MENTERI PENDIDIKAN DAN KEBUDAYAAN REPUBLIK INDONESIA</b>
		                        </td>
		                        <td><i>Awarding Institution’s License
		                        Minister Of Education And Culture Of The Republic Of Indonesia</i>
		                        </td>
		                    </tr>
		                    <tr>
		                        <td><b>Nomor  : 101/D/0/1999</b></td>
		                        <td><i>Number : 101/D/0/1999</i></td>
		                    </tr>
		                    <tr>
		                        <td><b>NAMA PERGURUAN TINGGI</b></td>
		                        <td><i>Awarding Institution</i></td>
		                    </tr>
		                    <tr>
		                        <td><b>SEKOLAH TINGGI DESAIN INTERSTUDI</b></td>
		                        <td><i>Interstudi College of Design</i></td>
		                    </tr>
		                    <tr>
		                        <td><b>Program Studi </b><br>
		                        <i>Study Program</i>
		                        </td>
		                        <td><?= $student['majors']; ?></td>
		                    </tr>
		                    <tr>
		                        <td><b>Jenis/Jenjang Pendidikan</b><br>
		                        <i>Education Degree</i>
		                        </td>
		                        <td><?= $skpi['student_skpi_educational_level']; ?></td>
		                    </tr>
		                    <tr>
		                        <td><b>Jenjang Kualifikasi KKNI</b><br>
		                        <i>Scheme Level in the Indonesian Qualification Framework</i>
		                        </td>
		                        <td><?= $skpi['student_skpi_our_level']; ?></td>
		                    </tr>
		                    <tr>
		                        <td><b>Persyaratan Penerimaan</b><br>
		                        <i>Admission Requirements</i>
		                        </td>
		                        <td><?= $skpi['student_skpi_admission_requirements']; ?></td>
		                    </tr>
		                    <tr>
		                        <td><b>Bahasa Pengantar Kuliah</b><br>
		                        <i>Lingua Franca/Spoken Language</i>
		                        </td>
		                        <td><?= $skpi['student_skpi_language_instruction']; ?></td>
		                    </tr>
		                    <tr>
		                        <td><b>Sistem Penilaian</b><br>
		                        <i>Grading System</i>
		                        </td>
		                        <td><?= $skpi['student_skpi_scoring_system']; ?></td>
		                    </tr>
		                    <tr>
		                        <td><b>Pendidikan Lanjut</b><br>
		                        <i>Further Study</i>
		                        </td>
		                        <td><?= $skpi['student_skpi_further_education']; ?></td>
		                    </tr>
		                    <tr>
		                        <td><b>Status Profesi (Bila Ada)</b><br>
		                        <i>Professional Status (If Applicable)</i>
		                        </td>
		                        <td><?= $skpi['student_skpi_professional_status']; ?></td>
		                    </tr>
		                    <tr style="background:#DCDCDC; ">

	                        <td colspan="2"><b>03.   INFORMASI TENTANG KUALIFIKASI DAN HASIL YANG DICAPAI <br>

		                            <i>03.   Information Identifying the Qualification and Outcomes Obtained</i></b>

		                            </td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b>A.  CAPAIAN PEMBELAJARAN </b></div>

		                        <?= $skpi['capaian_pembelajaran_ind']; ?></td>

		                        <td valign="top"><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b><i>A.  LEARNING OUTCOMES</i></b></div>

		                        <?= $skpi['capaian_pembelajaran_ing']; ?></td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b>KEMAMPUAN DI BIDANG KERJA</b></div>

		                        <?= $skpi['kemampuan_dibidang_kerja_ind']; ?></td>

		                        <td valign="top"><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b><i>ABILITY IN THE FIELD OF WORK</i></b></div>

		                        <?= $skpi['kemampuan_dibidang_kerja_ing']; ?></td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b>PENGETAHUAN YANG DIKUASAI</b></div>

		                        <?= $skpi['pengetahuan_dikuasai_ind']; ?></td>

		                        <td valign="top"><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b><i>ABILITY OF KNOWLEDGE </i></b></div>

		                        <?= $skpi['pengetahuan_dikuasai_ing']; ?></td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b>SIKAP KHUSUS</b></div>

		                        <?= $skpi['sikap_khusus_ind']; ?></td>

		                        <td valign="top"><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b><i>AUTHORITY & RESPONSIBILITY </i></b></div>

		                        <?= $skpi['sikap_khusus_ing']; ?></td>

		                    </tr>

		                    <tr>

		                        <td>1.	Bertanggung jawab terhadap metode dan hasil realisasinya atas kebijakan yang diambil berdasarkan analisis ....... <br>

		                            2.	Bertanggung jawab atas pekerjaannya

		                            </td>

		                        <td><i>1. Responsible for methods and its realization results of the selected policy based on the ....... <br>

		                        2. Responsible for the job</i>

		                        </td>

		                    </tr>

		                    

		                         

		                    <tr>

		                        <td><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b>B.  PRESTASI DAN PENGHARGAAN</b></div></td>

		                        <td><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b><i>B.  ACHIEVEMENTS AND AWARDS</i></b></div></td>

		                    </tr>

		                    <tr>

		                        <td valign="top">Pemegang Surat Keterangan Pendamping Ijazah ini memiliki sertifikat profesional:

		                        <?= $skpi['prestasi_penghargaan_ind']; ?>

		                        </td>

		                        <td valign="top"><i>The bearer of this Diploma Supplement obtained the following professional certifications:</i>

		                        <?= $skpi['prestasi_penghargaan_ing']; ?>

		                        </td>

		                    </tr>

		                    


		                        

		                    <tr>

		                        <td><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b>C.  INFORMASI TAMBAHAN</b></div></td>

		                        <td><div style="background:#DCDCDC;  margin:-5px; padding:5px;"><b><i>C.  ADDITIONAL INFORMATION</i></b></div></td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><b>3.C1. Penghargaan dan Pemenang Kejuaraan</b>

		                        <?= $skpi['penghargaan_pemenang_ind']; ?>

		                        </td>

		                        <td valign="top"><b><i>3. C1. Honor and Awards</i></b>

		                        <?= $skpi['penghargaan_pemenang_ing']; ?>

		                        </td>

		                    </tr>

		                    

		                    <tr>

		                        <td valign="top"><b>3. C2. Seminar</b>

		                        <?= $skpi['seminar_ind']; ?></td>

		                        <td valign="top"><b><i>3.C2. Seminar</i></b>

		                        <?= $skpi['seminar_ing']; ?></td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><b>3.C3. Pengalaman Organisasi</b>

		                        <?= $skpi['organisasi_ind']; ?></td>

		                        <td valign="top"><b><i>3. C3. Organizational Experiences</i></b>

		                        <?= $skpi['organisasi_ing']; ?></td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><b>3.C4. Spesifikasi Tugas Akhir/Judul Skripsi</b>

		                        <?= $skpi['tugas_akhir_ind']; ?></td>

		                        <td valign="top"><b><i>3. C4. Specification of The Final Project</i></b>

		                        <?= $skpi['tugas_akhir_ing']; ?></td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><b>3. C5. Bahasa Internasional</b>

		                        <?= $skpi['bahasa_internasional_ind']; ?></td>

		                        <td valign="top"><b><i>3. C5. International Language</i></b>

		                        <?= $skpi['bahasa_internasional_ing']; ?></td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><b>3. C6. Magang</b>

		                        <?= $skpi['magang_ind']; ?></td>

		                        <td valign="top"><b><i>3. C6. Internship</i></b>

		                        <?= $skpi['magang_ing']; ?></td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><b>3. C7. Pendidikan Karakter</b>

		                        <?= $skpi['pendidikan_karakter_ind']; ?></td>

		                        <td valign="top"><b><i>3. C7. Soft Skill Training </i></b>

		                        <?= $skpi['pendidikan_karakter_ing']; ?></td>

		                    </tr>
		                    <tr style="background:#DCDCDC; border:1px solid black;">
		                        <td colspan="2"><b>04.   SKEMA TENTANG SISTEM PENDIDIKAN TINGGI DI INDONESIA<br>
		                            <i>04.   Scheme Of The Indonesian Higher Education System </i></b>
		                            </td>
		                    </tr>
		                    <tr>
		                        <td colspan="2" align="center"><img src="../../../assets/logo/skema_pendidikan.png" width="350px"></td>
		                    </tr>
		                    <tr>
		                        <td valign="top">
			                        <ul style="list-style-type:disc;">
			                            <li>Kerangka Kualifikasi Nasional Indonesia, yang selanjutnya disingkat KKNI adalah kerangka penjenjangan kualifikasi kompetensi yang dapat menyandingkan, menyetarakan, dan mengintegrasikan antara bidang pendidikan dan bidang pelatihan kerja serta pengalaman kerja dalam rangka pemberian pengakuan kompetensi kerja sesuai dengan struktur pekerjaan di berbagai bidang.</li>

			                        </ul>
		                    	</td>

		                        <td valign="top">
		                        	<ul style="list-style-type:disc;">
		                            	<li><i>KKNI as known as Indonesian Qualification Framework is a competence grading system which integrates the aspects of education, training, and working experience in purpose of acknowledging the capacity based on work qualification in various sectors.</i></li>
		                        	</ul>
		                        </td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><ul style="list-style-type:disc;">

		                            <li>KKNI merupakan perwujudan mutu dan jati diri bangsa Indonesia terkait dengan sistem pendidikan dan pelatihan nasional yang dimiliki Indonesia.</li>

		                        </ul></td>

		                        <td valign="top"><ul style="list-style-type:disc;">

		                            <li><i>KKNI is the resemblance of Indonesian quality and identify concerning its national training and education system.</i></li>

		                        </ul></td>

		                    </tr>

		                    <tr>

		                        <td valign="top"><ul style="list-style-type:disc;">

		                            <li>Jenjang kualifikasi adalah tingkat capaian pembelajaran yang disepakati secara nasional, disusun berdasarkan ukuran hasil pendidikan dan/atau pelatihan yang diperoleh melalui pendidikan formal, nonformal atau pengalaman kerja.</li>

		                        </ul></td>

		                        <td valign="top"><ul style="list-style-type:disc;">

		                            <li><i>Qualification level, a nationally legalized learning outcomes, is composed by the results of education and training activities (formal, nonformal) or working experiences.</i></li>

		                        </ul></td>

		                    </tr>
		                    <tr>
		                        <td colspan="2"> Jakarta, <?= date('d M Y'); ?> <br> 
		                            FAKULTAS <?= strtoupper($student['college']); ?> 
		                            <br> Dekan <br> 
		                            <small>Dekan,</small> 
		                            <br><br><br><br><br> 
		                            <u><b><?= strtoupper($student['college_dean']); ?></b></u> <br> NIK ..............................................</td>
		                    </tr>
		                  </table>

</body>
</html>


<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("A4", "potrait");
$dompdf->render();
$dompdf->stream('SKPI.pdf',array('Attachment'=>0));
 
?>