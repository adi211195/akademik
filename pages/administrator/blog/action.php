<?php
session_start();
$account_id=$_SESSION['account_id'];

if (empty($account_id)) {
  echo json_encode(array('status'=>'failed'));
}

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

$blog_title			=htmlspecialchars(@$_POST['blog_title']);
$blog_post			= @$_POST['blog_post'];
$blog_status		=htmlspecialchars(@$_POST['blog_status']);
$blog_comment		=htmlspecialchars(@$_POST['blog_comment']);
$blog_image 		=htmlspecialchars(@$_POST['blog_image']);


$blog_id		=@$_POST['blog_id'];
$comment		=@$_POST['comment'];




$create_date	=date('Y-m-d H:i:s');

switch ($action) {			
		case 'input':

		$folderUpload = "../../../assets/blog_image";

		# periksa apakah folder sudah ada
		if (!is_dir($folderUpload)) {
		    # jika tidak maka folder harus dibuat terlebih dahulu
		    mkdir($folderUpload, 0777, $rekursif = true);
		}


		$ekstensi_diperbolehkan	= array('png','jpg');
		$blog_image = $_FILES['blog_image']['name'];
		$x = explode('.', $blog_image);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['blog_image']['size'];
		$file_tmp = $_FILES['blog_image']['tmp_name'];	
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			    if($ukuran < 1044070){			
				move_uploaded_file($file_tmp, $folderUpload.'/'.$blog_image);
					$save=mysqli_query($connect, "INSERT INTO master_blog (
							blog_id,
							blog_comment,
							blog_image,
							blog_post,
							blog_title,
							blog_status,
							blog_by,
							create_date)
					VALUES ('$genid',
							'$blog_comment',
							'$blog_image',
							'$blog_post',
							'$blog_title',
							'$blog_status',
							'$account_id',
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
				echo json_encode(array('status'=>'failed'));
		      }
	    			
			
			break;

		case 'edit':

			$folderUpload = "../../../assets/blog_image";

			# periksa apakah folder sudah ada
			if (!is_dir($folderUpload)) {
			    # jika tidak maka folder harus dibuat terlebih dahulu
			    mkdir($folderUpload, 0777, $rekursif = true);
			}

			

			$ekstensi_diperbolehkan	= array('png','jpg');
			$blog_image = $_FILES['blog_image']['name'];
			$x = explode('.', $blog_image);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['blog_image']['size'];
			$file_tmp = $_FILES['blog_image']['tmp_name'];	

			if (!empty($blog_image)) {
			if (in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				    if($ukuran < 1044070){			
					move_uploaded_file($file_tmp, $folderUpload.'/'.$blog_image);
					$update=mysqli_query($connect, "UPDATE master_blog SET
						blog_post='$blog_post',	
						blog_comment='$blog_comment',					
						blog_image='$blog_image',
						blog_title='$blog_title',
						blog_status='$blog_status',						
						create_date='$create_date' 
						where blog_id='$id'");



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
		      	 $update=mysqli_query($connect, "UPDATE master_blog SET	
		      	 		blog_post='$blog_post',	
						blog_comment='$blog_comment',	
						blog_title='$blog_title',
						blog_status='$blog_status',						
						create_date='$create_date' 
						where blog_id='$id'");



					if ($update) {
						echo json_encode(array('status'=>'success'));
					} else {			
						echo json_encode(array('status'=>'failed'));
					}
		      }




			
			
			break;

		case 'remove':
			
			$remove=mysqli_query($connect, "DELETE FROM master_blog 
						where blog_id='$id'");



			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;


	  case 'comment':	
				$save=mysqli_query($connect, "INSERT INTO master_blog_comment (blog_comment_id,
			    			account_id,
			    			blog_id,
			    			comment,
			    			create_date)
			    			VALUES ('$genid',
			    					'$account_id',
			    					'$blog_id',
			    					'$comment',
			    					'$create_date')");

				if ($save) {
					echo json_encode(array('status'=>'success'));
				} else {			
					echo json_encode(array('status'=>'failed'));
				}
			
			break;


	case 'remove_comment':
			
			$remove=mysqli_query($connect, "DELETE FROM master_blog_comment 
						where blog_comment_id='$id'");

			if ($remove) {
				echo json_encode(array('status'=>'success'));
			} else {			
				echo json_encode(array('status'=>'failed'));
			}

			break;

}



?>