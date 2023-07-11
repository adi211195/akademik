<?php
include "../../../config/connection.php";

$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
// Genrate ID
$genid=substr(str_shuffle($genrate_id), 0, 14);

if (empty(@$_GET['id'])) {
	$id 	=htmlspecialchars(@$_POST['id']);
} else {
	$id 	=htmlspecialchars(@$_GET['id']);
}


if (empty(@$_GET['action'])) {
	$action 	=htmlspecialchars(@$_POST['action']);
} else {
	$action 	=htmlspecialchars(@$_GET['action']);
}

$student_nim					=htmlspecialchars(@$_POST['student_nim']);
$student_skpi_entry_year		=htmlspecialchars(@$_POST['student_skpi_entry_year']);
$student_skpi_graduation_date	=htmlspecialchars(@$_POST['student_skpi_graduation_date']);
$student_skpi_diploma_number 	=htmlspecialchars(@$_POST['student_skpi_diploma_number']);

$student_skpi_degree 			=htmlspecialchars(@$_POST['student_skpi_degree']);
$student_skpi_length_study 		=htmlspecialchars(@$_POST['student_skpi_length_study']);

$student_skpi_sks 				=htmlspecialchars(@$_POST['student_skpi_sks']);
$student_skpi_ipk 				=htmlspecialchars(@$_POST['student_skpi_ipk']);
$student_skpi_no 				=htmlspecialchars(@$_POST['student_skpi_no']);
$student_skpi_study_program		=htmlspecialchars(@$_POST['student_skpi_study_program']);
$student_skpi_educational_level =htmlspecialchars(@$_POST['student_skpi_educational_level']);


$student_skpi_our_level 				=htmlspecialchars(@$_POST['student_skpi_our_level']);
$student_skpi_admission_requirements 	=htmlspecialchars(@$_POST['student_skpi_admission_requirements']);
$student_skpi_language_instruction 	=htmlspecialchars(@$_POST['student_skpi_language_instruction']);
$student_skpi_scoring_system 		=htmlspecialchars(@$_POST['student_skpi_scoring_system']);
$student_skpi_further_education 	=htmlspecialchars(@$_POST['student_skpi_further_education']);
$student_skpi_professional_status 	=htmlspecialchars(@$_POST['student_skpi_professional_status']);
$capaian_pembelajaran_ind 		=@$_POST['capaian_pembelajaran_ind'];
$capaian_pembelajaran_ing 		=@$_POST['capaian_pembelajaran_ing'];
$kemampuan_dibidang_kerja_ind 	=@$_POST['kemampuan_dibidang_kerja_ind'];
$kemampuan_dibidang_kerja_ing 	=@$_POST['kemampuan_dibidang_kerja_ing'];
$pengetahuan_dikuasai_ind 		=@$_POST['pengetahuan_dikuasai_ind'];
$pengetahuan_dikuasai_ing 		=@$_POST['pengetahuan_dikuasai_ing'];
$sikap_khusus_ind 				=@$_POST['sikap_khusus_ind'];
$sikap_khusus_ing 				=@$_POST['sikap_khusus_ind'];
$prestasi_penghargaan_ind 		=@$_POST['prestasi_penghargaan_ind'];
$prestasi_penghargaan_ing 		=@$_POST['prestasi_penghargaan_ing'];
$penghargaan_pemenang_ind 		=@$_POST['penghargaan_pemenang_ind'];
$penghargaan_pemenang_ing 		=@$_POST['penghargaan_pemenang_ing'];
$seminar_ind 					=@$_POST['seminar_ind'];
$seminar_ing 					=@$_POST['seminar_ing'];
$organisasi_ind 				=@$_POST['organisasi_ind'];
$organisasi_ing 				=@$_POST['organisasi_ing'];
$tugas_akhir_ind 				=@$_POST['tugas_akhir_ind'];
$tugas_akhir_ing 				=@$_POST['tugas_akhir_ing'];
$bahasa_internasional_ind 		=@$_POST['bahasa_internasional_ind'];
$bahasa_internasional_ing 		=@$_POST['bahasa_internasional_ing'];
$magang_ind 					=@$_POST['magang_ind'];
$magang_ing 					=@$_POST['magang_ing'];
$pendidikan_karakter_ind 		=@$_POST['pendidikan_karakter_ind'];
$pendidikan_karakter_ing 		=@$_POST['pendidikan_karakter_ing'];
$student_skpi_dean_name 		=htmlspecialchars(@$_POST['student_skpi_dean_name']);
$student_skpi_dean_nik 			=htmlspecialchars(@$_POST['student_skpi_dean_nik']);


$bobot_prestasi_penghargaan 	=htmlspecialchars(@$_POST['bobot_prestasi_penghargaan']);
$bobot_penghargaan_pemenang 	=htmlspecialchars(@$_POST['bobot_penghargaan_pemenang']);
$bobot_seminar 					=htmlspecialchars(@$_POST['bobot_seminar']);
$bobot_organisasi 				=htmlspecialchars(@$_POST['bobot_organisasi']);
$bobot_tugas_akhir 				=htmlspecialchars(@$_POST['bobot_tugas_akhir']);
$bobot_bahasa_internasional 	=htmlspecialchars(@$_POST['bobot_bahasa_internasional']);
$bobot_magang 					=htmlspecialchars(@$_POST['bobot_magang']);
$bobot_pendidikan_karakter 		=htmlspecialchars(@$_POST['bobot_pendidikan_karakter']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {	

		case 'input':

            $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_student_skpi where 
            	student_nim='$student_nim'"));
            
            if ($check>0) {

		          $delete=mysqli_query($connect,"DELETE FROM master_student_skpi where student_nim='$student_nim'");
		          $delete2=mysqli_query($connect,"DELETE FROM master_student_skpi_weight where student_nim='$student_nim'");  

            } 

            $save=mysqli_query($connect,"INSERT INTO master_student_skpi
		              (student_skpi_entry_year,
		              student_skpi_graduation_date,
		              student_skpi_diploma_number, 
		              student_skpi_degree,
		              student_skpi_length_study,
		              student_skpi_sks,
		              student_skpi_ipk,
		              student_skpi_no,
		              student_skpi_study_program,
		              student_skpi_educational_level,
		              student_skpi_our_level,
		              student_skpi_admission_requirements,
		              student_skpi_language_instruction,
		              student_skpi_scoring_system,
		              student_skpi_further_education,
		              student_skpi_professional_status,
		              capaian_pembelajaran_ind,
		              capaian_pembelajaran_ing,
		              kemampuan_dibidang_kerja_ind,
		              kemampuan_dibidang_kerja_ing,
		              pengetahuan_dikuasai_ind,
		              pengetahuan_dikuasai_ing,
		              sikap_khusus_ind,
		              sikap_khusus_ing,
		              prestasi_penghargaan_ind,
		              prestasi_penghargaan_ing,
		              penghargaan_pemenang_ind,
		              penghargaan_pemenang_ing,
		              seminar_ind,
		              seminar_ing,
		              organisasi_ind,
		              organisasi_ing,
		              tugas_akhir_ind,
		              tugas_akhir_ing,
		              bahasa_internasional_ind,
		              bahasa_internasional_ing,
		              magang_ind,
		              magang_ing,
		              pendidikan_karakter_ind,
		              pendidikan_karakter_ing,
		              student_skpi_dean_name,
		              student_skpi_dean_nik,
		              student_nim,
		              create_date,
		              student_skpi_id)
		              
		              VALUES (
		              '$student_skpi_entry_year',
		              '$student_skpi_graduation_date',
		              '$student_skpi_diploma_number', 
		              '$student_skpi_degree',
		              '$student_skpi_length_study',
		              '$student_skpi_sks',
		              '$student_skpi_ipk',
		              '$student_skpi_no',
		              '$student_skpi_study_program',
		              '$student_skpi_educational_level',
		              '$student_skpi_our_level',
		              '$student_skpi_admission_requirements',
		              '$student_skpi_language_instruction',
		              '$student_skpi_scoring_system',
		              '$student_skpi_further_education',
		              '$student_skpi_professional_status ',
		              '$capaian_pembelajaran_ind',
		              '$capaian_pembelajaran_ing',
		              '$kemampuan_dibidang_kerja_ind',
		              '$kemampuan_dibidang_kerja_ing',
		              '$pengetahuan_dikuasai_ind',
		              '$pengetahuan_dikuasai_ing',
		              '$sikap_khusus_ind',
		              '$sikap_khusus_ing',
		              '$prestasi_penghargaan_ind',
		              '$prestasi_penghargaan_ing',
		              '$penghargaan_pemenang_ind',
		              '$penghargaan_pemenang_ing',
		              '$seminar_ind',
		              '$seminar_ing',
		              '$organisasi_ind',
		              '$organisasi_ing',
		              '$tugas_akhir_ind',
		              '$tugas_akhir_ing',
		              '$bahasa_internasional_ind',
		              '$bahasa_internasional_ing',
		              '$magang_ind',
		              '$magang_ing',
		              '$pendidikan_karakter_ind',
		              '$pendidikan_karakter_ing',
		              '$student_skpi_dean_name',
		              '$student_skpi_dean_nik',
		              '$student_nim',
		              '$create_date',
		          	  '$genid')");
		              
		              mysqli_query($connect,"INSERT INTO master_student_skpi_weight
		              (student_nim,
		              bobot_prestasi_penghargaan,
		              bobot_penghargaan_pemenang,
		              bobot_seminar,
		              bobot_organisasi,
		              bobot_tugas_akhir,
		              bobot_bahasa_internasional,
		              bobot_magang,
		              bobot_pendidikan_karakter,
		              create_date,
		              student_skpi_weight_id) 
		              VALUES 
		              ('$student_nim',
		              '$bobot_prestasi_penghargaan',
		              '$bobot_penghargaan_pemenang',
		              '$bobot_seminar',
		              '$bobot_organisasi',
		              '$bobot_tugas_akhir',
		              '$bobot_bahasa_internasional',
		              '$bobot_magang',
		              '$bobot_pendidikan_karakter',
		          	  '$create_date',
		          	  '$genid')");

            		if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
			
			break;
}



?>