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


$questionnaire_status			=htmlspecialchars(@$_POST['questionnaire_status']);

$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		

		case 'edit':

				$remove=mysqli_query($connect, "DELETE FROM settings_range_ipk where range_ipk_id!='0'");

				$range_ipk_min=$_POST['range_ipk_min'];
				$no=1;
				foreach ($range_ipk_min as $row) {
					$nilai1="range_ipk_max".$no;
					$huruf="range_ipk_alphabet".$no;
					$mutu="range_ipk_numbers".$no;
					$gol="range_ipk_status".$no;

					$range_ipk_max=$_POST[$nilai1];
					$range_ipk_alphabet=$_POST[$huruf];
					$range_ipk_numbers=$_POST[$mutu];
					$range_ipk_status=$_POST[$gol];
					
					$update=mysqli_query($connect, "INSERT INTO settings_range_ipk (
								range_ipk_max, 
								range_ipk_min, 
								range_ipk_alphabet, 
								range_ipk_numbers, 
								range_ipk_status)
						VALUES ('$range_ipk_max',
								'$row',
								'$range_ipk_alphabet',
								'$range_ipk_numbers',
								'$range_ipk_status')");
				$no++; }

			if ($update) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}
			
			break;

		

}



?>