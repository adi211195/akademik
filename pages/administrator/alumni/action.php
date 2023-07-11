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

$alumni_username	=htmlspecialchars(@$_POST['alumni_username']);
$alumni_password	=md5(@$_POST['alumni_password']);
$alumni_email		=htmlspecialchars(@$_POST['alumni_email']);
$alumni_block		=htmlspecialchars(@$_POST['alumni_block']);
$alumni_photo 		=htmlspecialchars(@$_POST['alumni_photo']);

$alumni_npm 		=htmlspecialchars(@$_POST['alumni_npm']);
$alumni_name 		=htmlspecialchars(@$_POST['alumni_name']);
$alumni_phone		=htmlspecialchars(@$_POST['alumni_phone']);
$alumni_gender		=htmlspecialchars(@$_POST['alumni_gender']);

$alumni_place_birth	=htmlspecialchars(@$_POST['alumni_place_birth']);
$alumni_date_birth	=htmlspecialchars(@$_POST['alumni_date_birth']);


$alumni_address			=htmlspecialchars(@$_POST['alumni_address']);
$alumni_thesis			=htmlspecialchars(@$_POST['alumni_thesis']);
$alumni_company			=htmlspecialchars(@$_POST['alumni_company']);
$alumni_company_address	=htmlspecialchars(@$_POST['alumni_company_address']);
$alumni_majors			=htmlspecialchars(@$_POST['alumni_majors']);

$alumni_thesis_type		=htmlspecialchars(@$_POST['alumni_thesis_type']);
$alumni_sk_yudisium		=htmlspecialchars(@$_POST['alumni_sk_yudisium']);
$alumni_sk_yudisium_date=htmlspecialchars(@$_POST['alumni_sk_yudisium_date']);
$alumni_exit_type		=htmlspecialchars(@$_POST['alumni_exit_type']);
$alumni_exit_date		=htmlspecialchars(@$_POST['alumni_exit_date']);
$alumni_exit_semester	=htmlspecialchars(@$_POST['alumni_exit_semester']);
$alumni_ipk				=htmlspecialchars(@$_POST['alumni_ipk']);
$alumni_no_ijasah		=htmlspecialchars(@$_POST['alumni_no_ijasah']);
$alumni_mentor1 		=htmlspecialchars(@$_POST['alumni_mentor1']);
$alumni_mentor3 		=htmlspecialchars(@$_POST['alumni_mentor2']);
$alumni_mentor3 		=htmlspecialchars(@$_POST['alumni_mentor3']);
$alumni_examiner1		=htmlspecialchars(@$_POST['alumni_examiner1']);
$alumni_examiner2		=htmlspecialchars(@$_POST['alumni_examiner2']);
$alumni_examiner3		=htmlspecialchars(@$_POST['alumni_examiner3']);
$alumni_location		=htmlspecialchars(@$_POST['alumni_location']);
$alumni_sk_task_number	=htmlspecialchars(@$_POST['alumni_sk_task_number']);
$alumni_sk_task_number	=htmlspecialchars(@$_POST['alumni_sk_task_date']);



$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

		$folderUpload = "../../../assets/alumni_photo";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}


		$ekstensi_diperbolehkan	= array('png','jpg');
		$alumni_photo = $_FILES['alumni_photo']['name'];
		$x = explode('.', $alumni_photo);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['alumni_photo']['size'];
		$file_tmp = $_FILES['alumni_photo']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_photo);

					$save=mysqli_query($connect, "INSERT INTO master_alumni (
								alumni_id,
								alumni_block,
								alumni_photo,
								alumni_password,
								alumni_username,
								alumni_email,
								alumni_npm,
								alumni_name,
								alumni_phone,
								alumni_gender,
								alumni_place_birth,
								alumni_date_birth,
								alumni_address,
								alumni_thesis,
								alumni_sk_yudisium_date,

								alumni_thesis_type,
								alumni_sk_yudisium,
								alumni_exit_type,
								alumni_exit_date,
								alumni_exit_semester,
								alumni_ipk,
								alumni_no_ijasah,
								alumni_mentor1,
								alumni_mentor2,
								alumni_mentor3,
								alumni_examiner1,
								alumni_examiner2,
								alumni_examiner3,
								alumni_location,
								alumni_sk_task_number,
								alumni_sk_task_date,

								alumni_company,
								alumni_company_address,
								alumni_majors,
								create_date)
						VALUES ('$genid',
								'$alumni_block',
								'$alumni_photo',
								'$alumni_password',
								'$alumni_username',
								'$alumni_email',
								'$alumni_npm',
								'$alumni_name',
								'$alumni_phone',
								'$alumni_gender',
								'$alumni_place_birth',
								'$alumni_date_birth',
								'$alumni_address',
								'$alumni_thesis',
								'$alumni_sk_yudisium_date',

								'$alumni_thesis_type',
								'$alumni_sk_yudisium',
								'$alumni_exit_type',
								'$alumni_exit_date',
								'$alumni_exit_semester',
								'$alumni_ipk',
								'$alumni_no_ijasah',
								'$alumni_mentor1',
								'$alumni_mentor2',
								'$alumni_mentor3',
								'$alumni_examiner1',
								'$alumni_examiner2',
								'$alumni_examiner3',
								'$alumni_location',
								'$alumni_sk_task_number',
								'$alumni_sk_task_date',

								'$alumni_company',
								'$alumni_company_address',
								'$alumni_majors',
								'$create_date')");

					

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}


			    }else{
					echo json_encode(array('status'=>'failed'));
			    }

		      } else {

		      	$save=mysqli_query($connect, "INSERT INTO master_alumni (
								alumni_id,
								alumni_block,
								alumni_password,
								alumni_username,
								alumni_email,
								alumni_npm,
								alumni_name,
								alumni_phone,
								alumni_gender,
								alumni_place_birth,
								alumni_date_birth,
								alumni_address,
								alumni_thesis,
								alumni_sk_yudisium_date,

								alumni_thesis_type,
								alumni_sk_yudisium,
								alumni_exit_type,
								alumni_exit_date,
								alumni_exit_semester,
								alumni_ipk,
								alumni_no_ijasah,
								alumni_mentor1,
								alumni_mentor2,
								alumni_mentor3,
								alumni_examiner1,
								alumni_examiner2,
								alumni_examiner3,
								alumni_location,
								alumni_sk_task_number,
								alumni_sk_task_date,

								alumni_company,
								alumni_company_address,
								alumni_majors,
								create_date)
						VALUES ('$genid',
								'$alumni_block',
								'$alumni_password',
								'$alumni_username',
								'$alumni_email',
								'$alumni_npm',
								'$alumni_name',
								'$alumni_phone',
								'$alumni_gender',
								'$alumni_place_birth',
								'$alumni_date_birth',
								'$alumni_address',
								'$alumni_thesis',
								'$alumni_sk_yudisium_date',

								'$alumni_thesis_type',
								'$alumni_sk_yudisium',
								'$alumni_exit_type',
								'$alumni_exit_date',
								'$alumni_exit_semester',
								'$alumni_ipk',
								'$alumni_no_ijasah',
								'$alumni_mentor1',
								'$alumni_mentor2',
								'$alumni_mentor3',
								'$alumni_examiner1',
								'$alumni_examiner2',
								'$alumni_examiner3',
								'$alumni_location',
								'$alumni_sk_task_number',
								'$alumni_sk_task_date',

								'$alumni_company',
								'$alumni_company_address',
								'$alumni_majors',
								'$create_date')");

					if ($save) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
		      }


		$folderUpload = "../../../assets/alumni_file_ijasah";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}
		$ekstensi_diperbolehkan	= array('png','jpg','pdf');
		$alumni_file_ijasah = $_FILES['alumni_file_ijasah']['name'];
		$x = explode('.', $alumni_file_ijasah);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['alumni_file_ijasah']['size'];
		$file_tmp = $_FILES['alumni_file_ijasah']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){	
			    	move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_file_ijasah);
			    	$alumni=mysqli_query($connect, "UPDATE master_alumni SET
								alumni_file_ijasah='$alumni_file_ijasah'
					where alumni_id='$genid'");
			    }

			 }


	    $folderUpload = "../../../assets/alumni_file_transkrip";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}
		$ekstensi_diperbolehkan	= array('png','jpg','pdf');
		$alumni_file_transkrip = $_FILES['alumni_file_transkrip']['name'];
		$x = explode('.', $alumni_file_transkrip);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['alumni_file_transkrip']['size'];
		$file_tmp = $_FILES['alumni_file_transkrip']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){	
			    	move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_file_transkrip);
			    	$alumni=mysqli_query($connect, "UPDATE master_alumni SET
								alumni_file_transkrip='$alumni_file_transkrip'
					where alumni_id='$genid'");
			    }

			 }


		$folderUpload = "../../../assets/alumni_file_sck";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}
		$ekstensi_diperbolehkan	= array('png','jpg','pdf');
		$alumni_file_sck = $_FILES['alumni_file_sck']['name'];
		$x = explode('.', $alumni_file_sck);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['alumni_file_sck']['size'];
		$file_tmp = $_FILES['alumni_file_sck']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){	
			    	move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_file_sck);
			    	$alumni=mysqli_query($connect, "UPDATE master_alumni SET
								alumni_file_sck='$alumni_file_sck'
					where alumni_id='$genid'");
			    }

			 }
	    			
			
			break;

		case 'edit':

			$folderUpload = "../../../assets/alumni_photo";

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}

			if (!empty($alumni_password)) {
				$update=mysqli_query($connect, "UPDATE master_alumni SET	
						alumni_password='$alumni_password'
						where alumni_id='$id'");
			} 

			$ekstensi_diperbolehkan	= array('png','jpg');
			$alumni_photo = $_FILES['alumni_photo']['name'];
			$x = explode('.', $alumni_photo);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['alumni_photo']['size'];
			$file_tmp = $_FILES['alumni_photo']['tmp_name'];	

			if (!empty($alumni_photo)) {
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_photo);
					$update=mysqli_query($connect, "UPDATE master_alumni SET	
											
						alumni_photo='$alumni_photo',
						alumni_block='$alumni_block',
						alumni_username='$alumni_username',
						alumni_email='$alumni_email',
						alumni_npm='$alumni_npm',
						alumni_name='$alumni_name',
						alumni_phone='$alumni_phone',
						alumni_gender='$alumni_gender',
						alumni_place_birth='$alumni_place_birth',
						alumni_date_birth='$alumni_date_birth',
						alumni_address='$alumni_address',
						alumni_thesis='$alumni_thesis',
						alumni_sk_yudisium_date='$alumni_sk_yudisium_date',

						alumni_thesis_type='$alumni_thesis_type',
						alumni_sk_yudisium='$alumni_sk_yudisium',
						$alumni_exit_type='$alumni_exit_type',
						alumni_exit_date='$alumni_exit_date',
						alumni_exit_semester='$alumni_exit_semester',
						alumni_ipk='$alumni_ipk',
						alumni_no_ijasah='$alumni_no_ijasah',
						alumni_mentor1='$alumni_mentor1',
						alumni_mentor2='$alumni_mentor2',
						alumni_mentor3='$alumni_mentor3',
						alumni_examiner1='$alumni_examiner1',
						alumni_examiner2='$alumni_examiner2',
						alumni_examiner3='$alumni_examiner3',
						alumni_location='$alumni_location',
						alumni_sk_task_number='$alumni_sk_task_number',
						alumni_sk_task_date='$alumni_sk_task_date',

						alumni_company='$alumni_company',
						alumni_company_address='$alumni_company_address',	
						alumni_majors='$alumni_majors',				
						create_date='$create_date' 
						where alumni_id='$id'");


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
		      	 $update=mysqli_query($connect, "UPDATE master_alumni SET	
						alumni_block='$alumni_block',
						alumni_username='$alumni_username',
						alumni_email='$alumni_email',
						alumni_npm='$alumni_npm',
						alumni_name='$alumni_name',
						alumni_phone='$alumni_phone',
						alumni_gender='$alumni_gender',
						alumni_place_birth='$alumni_place_birth',
						alumni_date_birth='$alumni_date_birth',
						alumni_address='$alumni_address',
						alumni_thesis='$alumni_thesis',
						alumni_sk_yudisium_date='$alumni_sk_yudisium_date',
						alumni_company='$alumni_company',
						alumni_company_address='$alumni_company_address',	
						alumni_majors='$alumni_majors',						
						create_date='$create_date' 
						where alumni_id='$id'");

					


					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
		      }



		   $folderUpload = "../../../assets/alumni_file_ijasah";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}
		$ekstensi_diperbolehkan	= array('png','jpg','pdf');
		$alumni_file_ijasah = $_FILES['alumni_file_ijasah']['name'];
		$x = explode('.', $alumni_file_ijasah);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['alumni_file_ijasah']['size'];
		$file_tmp = $_FILES['alumni_file_ijasah']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){	
			    	move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_file_ijasah);
			    	$alumni=mysqli_query($connect, "UPDATE master_alumni SET
								alumni_file_ijasah='$alumni_file_ijasah'
					where alumni_id='$id'");
			    }

			 }


	    $folderUpload = "../../../assets/alumni_file_transkrip";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}
		$ekstensi_diperbolehkan	= array('png','jpg','pdf');
		$alumni_file_transkrip = $_FILES['alumni_file_transkrip']['name'];
		$x = explode('.', $alumni_file_transkrip);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['alumni_file_transkrip']['size'];
		$file_tmp = $_FILES['alumni_file_transkrip']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){	
			    	move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_file_transkrip);
			    	$alumni=mysqli_query($connect, "UPDATE master_alumni SET
								alumni_file_transkrip='$alumni_file_transkrip'
					where alumni_id='$id'");
			    }

			 }


		$folderUpload = "../../../assets/alumni_file_sck";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}
		$ekstensi_diperbolehkan	= array('png','jpg','pdf');
		$alumni_file_sck = $_FILES['alumni_file_sck']['name'];
		$x = explode('.', $alumni_file_sck);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['alumni_file_sck']['size'];
		$file_tmp = $_FILES['alumni_file_sck']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){	
			    	move_uploaded_file($file_tmp, $folderUpload.'/'.$alumni_file_sck);
			    	$alumni=mysqli_query($connect, "UPDATE master_alumni SET
								alumni_file_sck='$alumni_file_sck'
					where alumni_id='$id'");
			    }

			 }

			
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM alumni 
						where alumni_id='$id'");

			$alumni=mysqli_query($connect, "DELETE FROM master_alumni
						where alumni_id='$id'");


			if ($remove) {
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
			    $alumni_npm           	=$data->val($i,2);
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

			    $password=md5($alumni_npm);
			    $jml=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_alumni where alumni_npm='$alumni_npm'"));
			    if ($jml>0) {

			    	$update=mysqli_query($connect, "UPDATE master_alumni SET
						alumni_username='$alumni_npm',
						alumni_email='$alumni_email',
						alumni_npm='$alumni_npm',
						alumni_name='$alumni_name',
						alumni_phone='$alumni_phone',
						alumni_gender='$alumni_gender',
						alumni_place_birth='$alumni_place_birth',
						alumni_date_birth='$alumni_date_birth',
						alumni_address='$alumni_address',
						alumni_thesis='$alumni_thesis',
						alumni_sk_yudisium_date='$alumni_sk_yudisium_date',
						alumni_company='$alumni_company',
						alumni_company_address='$alumni_company_address',
						alumni_majors='$alumni_majors',						
						create_date='$create_date' 
						where alumni_npm='$alumni_npm'");

			    } else {

			    	$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					// Genrate ID
					$genid=substr(str_shuffle($genrate_id), 0, 14);
					$save=mysqli_query($connect, "INSERT INTO master_alumni (
								alumni_id,								
								alumni_password,
								alumni_username,
								alumni_email,
								alumni_npm,
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
								'$alumni_npm',
								'$alumni_email',
								'$alumni_npm',
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