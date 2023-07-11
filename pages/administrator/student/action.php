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

$account_username	=htmlspecialchars(@$_POST['account_username']);
$account_password	=md5(@$_POST['account_password']);
$account_email		=htmlspecialchars(@$_POST['account_email']);
$account_block		=htmlspecialchars(@$_POST['account_block']);
$account_photo 		=htmlspecialchars(@$_POST['account_photo']);

$student_nim 			=htmlspecialchars(@$_POST['student_nim']);
$student_nik 			=htmlspecialchars(@$_POST['student_nik']);
$student_nisn 			=htmlspecialchars(@$_POST['student_nisn']);
$student_npwp 			=htmlspecialchars(@$_POST['student_npwp']);


$student_name 			=htmlspecialchars(@$_POST['student_name']);
$college_code 			=htmlspecialchars(@$_POST['college_code']);
$majors_code			=htmlspecialchars(@$_POST['majors_code']);
$student_generation		=htmlspecialchars(@$_POST['student_generation']);
$student_phone			=htmlspecialchars(@$_POST['student_phone']);
$student_handphone		=htmlspecialchars(@$_POST['student_handphone']);
$student_gender			=htmlspecialchars(@$_POST['student_gender']);
$student_status			=htmlspecialchars(@$_POST['student_status']);
$student_religion		=htmlspecialchars(@$_POST['student_religion']);
$student_kps			=htmlspecialchars(@$_POST['student_kps']);
$student_no_kps			=htmlspecialchars(@$_POST['student_no_kps']);
$student_college_entry_date	=htmlspecialchars(@$_POST['student_college_entry_date']);
$student_start_semester	=htmlspecialchars(@$_POST['student_start_semester']);

$student_place_birth	=htmlspecialchars(@$_POST['student_place_birth']);
$student_date_birth		=htmlspecialchars(@$_POST['student_date_birth']);
$student_address		=htmlspecialchars(@$_POST['student_address']);
$student_address_rt		=htmlspecialchars(@$_POST['student_address_rt']);
$student_address_rw		=htmlspecialchars(@$_POST['student_address_rw']);
$student_address_village		=htmlspecialchars(@$_POST['student_address_village']);
$student_address_ward			=htmlspecialchars(@$_POST['student_address_ward']);
$student_address_district		=htmlspecialchars(@$_POST['student_address_district']);
$student_city			=htmlspecialchars(@$_POST['student_city']);
$student_poscode		=htmlspecialchars(@$_POST['student_poscode']);

$student_type_stay			=htmlspecialchars(@$_POST['student_type_stay']);
$student_type_of_financing	=htmlspecialchars(@$_POST['student_type_of_financing']);
$student_transportation		=htmlspecialchars(@$_POST['student_transportation']);
$student_registration_path	=htmlspecialchars(@$_POST['student_registration_path']);
$student_citizenship		=htmlspecialchars(@$_POST['student_citizenship']);
$student_registration_type	=htmlspecialchars(@$_POST['student_registration_type']);




$student_sks		=htmlspecialchars(@$_POST['student_sks']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

		$folderUpload = "../../../assets/account_photo";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}

		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $acak=substr(str_shuffle($permitted_chars), 0, 10);

		$ekstensi_diperbolehkan	= array('png','jpg');
		$account_photo = $acak.$_FILES['account_photo']['name'];
		$x = explode('.', $account_photo);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['account_photo']['size'];
		$file_tmp = $_FILES['account_photo']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, $folderUpload.'/'.$account_photo);
					$save=mysqli_query($connect, "INSERT INTO account (
							account_id,
							account_block,
							account_photo,
							account_password,
							account_username,
							account_email,
							account_status,
							create_date)
					VALUES ('$genid',
							'$account_block',
							'$account_photo',
							'$account_password',
							'$account_username',
							'$account_email',
							'Mahasiswa',
							'$create_date')");

					$student=mysqli_query($connect, "INSERT INTO master_student (
								account_id,
								student_generation,
								college_code,
								majors_code,
								student_nim,
								student_nik,
								student_nisn,
								student_npwp,

								student_name,
								student_phone,
								student_handphone,
								student_gender,
								student_status,
								student_religion,
								student_kps,
								student_no_kps,
								student_start_semester,
								student_college_entry_date,

								student_place_birth,
								student_date_birth,
								student_type_stay,
								student_type_of_financing,
								student_transportation,
								student_registration_path,
								student_citizenship,
								student_registration_type,

								student_address,
								student_address_rt,
								student_address_rw,
								student_address_village,
								student_address_ward,
								student_address_district,
								student_city,
								student_poscode,
								create_date)
						VALUES ('$genid',
								'$student_generation',
								'$college_code',
								'$majors_code',
								'$student_nim',
								'$student_nik',
								'$student_nisn',
								'$student_npwp',

								'$student_name',
								'$student_phone',
								'$student_handphone',
								'$student_gender',
								'$student_status',
								'$student_religion',
								'$student_kps',
								'$student_no_kps',
								'$student_start_semester',
								'$student_college_entry_date',

								'$student_place_birth',
								'$student_date_birth',
								'$student_type_stay',
								'$student_type_of_financing',
								'$student_transportation',
								'$student_registration_path',
								'$student_citizenship',
								'$student_registration_type',

								'$student_address',
								'$student_address_rt',
								'$student_address_rw',
								'$student_address_village',
								'$student_address_ward',
								'$student_address_district',

								'$student_city',
								'$student_poscode',
								'$create_date')");

						$addtional=mysqli_query($connect, "INSERT INTO master_student_father (student_nim,create_date) 
							VALUES ('$student_nim','$create_date')");
						$addtional=mysqli_query($connect, "INSERT INTO master_student_mother (student_nim,create_date) 
							VALUES ('$student_nim','$create_date')");
						$addtional=mysqli_query($connect, "INSERT INTO master_student_guardian (student_nim,create_date) 
							VALUES ('$student_nim','$create_date')");
						$addtional=mysqli_query($connect, "INSERT INTO master_student_school (student_nim,create_date) 
							VALUES ('$student_nim','$create_date')");


					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}


			    }else{
					echo json_encode(array('status'=>'failed'));
			    }

		      } else {
				echo json_encode(array('status'=>'failed'));
		      }
	    			
			
			break;

		case 'edit':

			$folderUpload = "../../../assets/account_photo";

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}

			if (!empty($account_password)) {
				$update=mysqli_query($connect, "UPDATE account SET	
						account_password='$account_password'
						where account_id='$id'");
			} 

			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        	$acak=substr(str_shuffle($permitted_chars), 0, 10);

			$ekstensi_diperbolehkan	= array('png','jpg');
			$account_photo = $acak.$_FILES['account_photo']['name'];
			$x = explode('.', $account_photo);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['account_photo']['size'];
			$file_tmp = $_FILES['account_photo']['tmp_name'];	

			if (!empty($account_photo)) {
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $folderUpload.'/'.$account_photo);
					$update=mysqli_query($connect, "UPDATE account SET	
						account_block='$account_block',					
						account_photo='$account_photo',
						account_username='$account_username',
						account_email='$account_email',						
						create_date='$create_date' 
						where account_id='$id'");

					$student=mysqli_query($connect, "UPDATE master_student SET
								student_nim='$student_nim',
								student_nik='$student_nik',
								student_nisn='$student_nisn',
								student_npwp='$student_npwp',

								student_name='$student_name',
								student_phone='$student_phone',
								student_handphone='$student_handphone',
								student_gender='$student_gender',
								student_status='$student_status',
								student_religion='$student_religion',
								student_kps='$student_kps',
								student_no_kps='$student_no_kps',
								student_start_semester='$student_start_semester',
								$student_college_entry_date='$student_college_entry_date',

								student_place_birth='$student_place_birth',
								student_date_birth='$student_date_birth',
								student_type_stay='$student_type_stay',
								student_type_of_financing='$student_type_of_financing',
								student_transportation='$student_transportation',
								student_registration_path='$student_registration_path',
								student_citizenship='$student_citizenship',
								student_registration_type='$student_registration_type',

								student_address='$student_address',
								student_address_rt='$student_address_rt',
								student_address_rw='$student_address_rw',
								student_address_village='$student_address_village',
								student_address_ward='$student_address_ward',
								student_address_district='$student_address_district',
								student_city='$student_city',
								student_poscode='$student_poscode',
								create_date='$create_date' 
					where account_id='$id'");


					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}

			    }else{
					echo json_encode(array('status'=>'failed'));
			    }

		      } else {
				echo json_encode(array('status'=>'failed'));
		      }} else {
		      	 $update=mysqli_query($connect, "UPDATE account SET	
						account_block='$account_block',	
						account_username='$account_username',
						account_email='$account_email',						
						create_date='$create_date' 
						where account_id='$id'");

					$student=mysqli_query($connect, "UPDATE master_student SET
								student_nim='$student_nim',
								student_nik='$student_nik',
								student_nisn='$student_nisn',
								student_npwp='$student_npwp',

								student_name='$student_name',
								student_phone='$student_phone',
								student_handphone='$student_handphone',
								student_gender='$student_gender',
								student_status='$student_status',
								student_kps='$student_kps',
								student_no_kps='$student_no_kps',
								student_start_semester='$student_start_semester',
								$student_college_entry_date='$student_college_entry_date',

								student_place_birth='$student_place_birth',
								student_date_birth='$student_date_birth',
								student_type_stay='$student_type_stay',
								student_type_of_financing='$student_type_of_financing',
								student_transportation='$student_transportation',
								student_registration_path='$student_registration_path',
								student_citizenship='$student_citizenship',
								student_registration_type='$student_registration_type',

								student_address='$student_address',
								student_address_rt='$student_address_rt',
								student_address_rw='$student_address_rw',
								student_address_village='$student_address_village',
								student_address_ward='$student_address_ward',
								student_address_district='$student_address_district',
								student_city='$student_city',
								student_poscode='$student_poscode',
								create_date='$create_date' 
					where account_id='$id'");


					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
		      }




			
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM account 
						where account_id='$id'");

			$student=mysqli_query($connect, "DELETE FROM master_student
						where account_id='$id'");


			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;


		case 'status':
			$change=mysqli_query($connect, "UPDATE master_student SET
								student_status='$student_status'
					where student_generation='$student_generation' AND
						  college_code='$college_code' AND
						  majors_code='$majors_code'");

			if ($change) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			break;


		case 'sks':
			$change=mysqli_query($connect, "UPDATE master_student SET
								student_sks='$student_sks'
					where student_generation='$student_generation' AND
						  college_code='$college_code' AND
						  majors_code='$majors_code'");

			if ($change) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			break;


		case 'addtional':
						$school_name=htmlspecialchars(@$_POST['school_name']);	
						$school_address=htmlspecialchars(@$_POST['school_address']);
						$school_district=htmlspecialchars(@$_POST['school_district']);
						$school_majors=htmlspecialchars(@$_POST['school_majors']);
						$school_study_program=htmlspecialchars(@$_POST['school_study_program']);
						$school_graduation_year=htmlspecialchars(@$_POST['school_graduation_year']);

						$father_nik=htmlspecialchars(@$_POST['father_nik']);	
						$father_name=htmlspecialchars(@$_POST['father_name']);
						$father_date_birth=htmlspecialchars(@$_POST['father_date_birth']);
						$father_phone=htmlspecialchars(@$_POST['father_phone']);
						$father_handphone=htmlspecialchars(@$_POST['father_handphone']);
						$father_address=htmlspecialchars(@$_POST['father_address']);	
						$father_districts=htmlspecialchars(@$_POST['father_districts']);
						$father_education=htmlspecialchars(@$_POST['father_education']);
						$father_profession=htmlspecialchars(@$_POST['father_profession']);
						$father_income=htmlspecialchars(@$_POST['father_income']);

						$mother_nik=htmlspecialchars(@$_POST['mother_nik']);	
						$mother_name=htmlspecialchars(@$_POST['mother_name']);
						$mother_date_birth=htmlspecialchars(@$_POST['mother_date_birth']);
						$mother_phone=htmlspecialchars(@$_POST['mother_phone']);
						$mother_handphone=htmlspecialchars(@$_POST['mother_handphone']);
						$mother_address=htmlspecialchars(@$_POST['mother_address']);	
						$mother_districts=htmlspecialchars(@$_POST['mother_districts']);
						$mother_education=htmlspecialchars(@$_POST['mother_education']);
						$mother_profession=htmlspecialchars(@$_POST['mother_profession']);
						$mother_income=htmlspecialchars(@$_POST['mother_income']);		

						$guardian_name=htmlspecialchars(@$_POST['guardian_name']);
						$guardian_education=htmlspecialchars(@$_POST['guardian_education']);
						$guardian_profession=htmlspecialchars(@$_POST['guardian_profession']);
						$guardian_income=htmlspecialchars(@$_POST['guardian_income']);			

			$update1=mysqli_query($connect, "UPDATE master_student_school SET	
						school_name='$school_name',	
						school_address='$school_address',
						school_district='$school_district',
						school_majors='$school_majors',
						school_study_program='$school_study_program',
						school_graduation_year='$school_graduation_year',						
						create_date='$create_date' 
						where student_nim='$id'");

			$update2=mysqli_query($connect, "UPDATE master_student_father SET	
						father_nik='$father_nik',	
						father_name='$father_name',
						father_date_birth='$father_date_birth',
						father_phone='$father_phone',
						father_handphone='$father_handphone',
						father_address='$father_address',	
						father_districts='$father_districts',
						father_education='$father_education',
						father_profession='$father_profession',
						father_income='$father_income',					
						create_date='$create_date' 
						where student_nim='$id'");

			$update3=mysqli_query($connect, "UPDATE master_student_mother SET	
						mother_nik='$mother_nik',	
						mother_name='$mother_name',
						mother_date_birth='$mother_date_birth',
						mother_phone='$mother_phone',
						mother_handphone='$mother_handphone',
						mother_address='$mother_address',	
						mother_districts='$mother_districts',
						mother_education='$mother_education',
						mother_profession='$mother_profession',
						mother_income='$mother_income',					
						create_date='$create_date' 
						where student_nim='$id'");


			$update4=mysqli_query($connect, "UPDATE master_student_guardian SET	
						guardian_name='$guardian_name',
						guardian_education='$guardian_education',
						guardian_profession='$guardian_profession',
						guardian_income='$guardian_income',					
						create_date='$create_date' 
						where student_nim='$id'");


			if ($update1) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			break;




			case 'import':
			   include "../../../pages/ajax/import_excel.php";
			   $data = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name']);
			   $baris = $data->rowcount($sheet_index=0);

			   $no=0;
			   for($i=2; $i<=$baris; $i++){
			   	$alumni_name            =$data->val($i,1);
			    $student_nim           	=$data->val($i,2);
			    $alumni_gender          =$data->val($i,3);
			    $alumni_place_birth     =$data->val($i,4);
			    $alumni_date_birth      =$data->val($i,5);
			    $alumni_address         =$data->val($i,6);
			    $alumni_thesis         	=$data->val($i,7);
			    $alumni_company    		=$data->val($i,8);
			    $alumni_company_address =$data->val($i,9);
			    $alumni_sk_yudisium_date        =$data->val($i,10);
			    $alumni_email         	=$data->val($i,11);
			    $alumni_majors         	=$data->val($i,12);

			    $password=md5($student_nim);
			    $jml=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_student where student_nim='$student_nim'"));
			    if ($jml<1) {

			    	$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					// Genrate ID
					$genid=substr(str_shuffle($genrate_id), 0, 14);
					$save=mysqli_query($connect, "INSERT INTO master_alumni (
								alumni_id,								
								alumni_password,
								alumni_username,
								alumni_email,
								student_nim,
								alumni_name,
								alumni_phone,
								alumni_gender,
								alumni_place_birth,
								alumni_date_birth,
								alumni_address,
								alumni_thesis,
								alumni_sk_yudisium_date,
								alumni_company,
								alumni_company_address,
								alumni_majors,
								create_date)
						VALUES ('$genid',
								'$password',
								'$student_nim',
								'$alumni_email',
								'$student_nim',
								'$alumni_name',
								'$alumni_phone',
								'$alumni_gender',
								'$alumni_place_birth',
								'$alumni_date_birth',
								'$alumni_address',
								'$alumni_thesis',
								'$alumni_sk_yudisium_date',
								'$alumni_company',
								'$alumni_company_address',
								'$alumni_majors',
								'$create_date')");
			     }
			   $no++; }


			break;
}



?>