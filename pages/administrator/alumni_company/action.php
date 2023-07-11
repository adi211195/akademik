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


$alumni_company_name 		=htmlspecialchars(@$_POST['alumni_company_name']);
$alumni_company_field 		=htmlspecialchars(@$_POST['alumni_company_field']);
$alumni_company_website 	=htmlspecialchars(@$_POST['alumni_company_website']);
$alumni_company_location 	=htmlspecialchars(@$_POST['alumni_company_location']);
$alumni_company_address 	=htmlspecialchars(@$_POST['alumni_company_address']);
$alumni_company_poscode 	=htmlspecialchars(@$_POST['alumni_company_poscode']);
$alumni_company_phone 		=htmlspecialchars(@$_POST['alumni_company_phone']);
$alumni_company_fax 		=htmlspecialchars(@$_POST['alumni_company_fax']);
$alumni_company_email 		=htmlspecialchars(@$_POST['alumni_company_email']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

			$save=mysqli_query($connect, "INSERT INTO master_alumni_company (
						alumni_company_id,
						alumni_company_name,
						alumni_company_field,
						alumni_company_website,
						alumni_company_location,
						alumni_company_address,
						alumni_company_poscode,
						alumni_company_phone,
						alumni_company_fax,
						alumni_company_email,
						create_date)
				VALUES ('$genid',
						'$alumni_company_name',
						'$alumni_company_field',
						'$alumni_company_website',
						'$alumni_company_location',
						'$alumni_company_address',
						'$alumni_company_poscode',
						'$alumni_company_phone',
						'$alumni_company_fax',
						'$alumni_company_email',
						'$create_date')");
			if ($save) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'edit':

			$update=mysqli_query($connect, "UPDATE master_alumni_company SET	
						alumni_company_name='$alumni_company_name',
						alumni_company_field='$alumni_company_field',
						alumni_company_website='$alumni_company_website',
						alumni_company_location='$alumni_company_location',
						alumni_company_address='$alumni_company_address',
						alumni_company_poscode='$alumni_company_poscode',
						alumni_company_phone='$alumni_company_phone',
						alumni_company_fax='$alumni_company_fax',
						alumni_company_email='$alumni_company_email',
						create_date='$create_date' 
						where alumni_company_id='$id'");
			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_alumni_company  
						where alumni_company_id='$id'");
			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>