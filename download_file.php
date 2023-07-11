<?php
session_start();
include "config/connection.php";
$name=@$_GET['file'];
switch (@$_GET['act']) {
  case 'skripsi':
          $filename=explode("!", $name);
          $folder_file="assets/skripsi_file/".$filename[0]."/";
          $skripsi=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_skripsi_file where skripsi_file_id='$filename[1]'"));
          $file = $folder_file.$skripsi['skripsi_file'];
         
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: private');
                header('Pragma: private');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                
                exit;
            } else {
              echo "Oops! file not found!";
            }
    break;


    case 'skpi':
          $filename=explode("!", $name);
          $folder_file="assets/student_skpi_file/".$filename[0]."/";
          $skpi=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_skpi_file_id='$filename[1]'"));
          $file = $folder_file.$skpi['student_skpi_file'];
         
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: private');
                header('Pragma: private');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                
                exit;
            } else {
              echo "Oops! file not found!";
            }
    break;

    case 'elearning':
          $filename=explode("!", $name);
          $folder_file="assets/elearning_file/".$filename[0]."/";
          $elearning=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM elearning where elearning_id='$filename[1]'"));
          $file = $folder_file.$elearning['elearning_file'];
         
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: private');
                header('Pragma: private');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                
                exit;
            } else {
              echo "Oops! file not found!";
            }
    break;


    case 'drive':
          $filename=explode("!", $name);
          $folder_file="assets/drive_file/".$filename[0]."/";
          $drive=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM drive_academic where drive_id='$filename[1]'"));
          $file = $folder_file.$drive['drive_file'];
         
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: private');
                header('Pragma: private');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                
                exit;
            } else {
              echo "Oops! file not found!";
            }
    break;

    case 'mail':
          $filename=explode("!", $name);
          $folder_file="assets/mail_file/".$filename[0]."/";
          $mail=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM mail_file where mail_file_id='$filename[1]'"));
          $file = $folder_file.$mail['mail_file_name'];
         
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: private');
                header('Pragma: private');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                
                exit;
            } else {
              echo "Oops! file not found!";
            }
    break;

    case 'questions':
          $filename=explode("!", $name);
          $folder_file="assets/questions_file/".$filename[0]."/";
          $questions=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questions where questions_id='$filename[1]'"));
          $file = $folder_file.$questions['questions_file'];
         
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: private');
                header('Pragma: private');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                
                exit;
            } else {
              echo "Oops! file not found!";
            }
    break;


    case 'answer':
          $filename=explode("!", $name);
          $folder_file="assets/answer_file/".$filename[0]."/";
          $answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questions_answer where answer_id='$filename[1]'"));
          $file = $folder_file.$answer['answer_file'];
         
            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='.basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: private');
                header('Pragma: private');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                readfile($file);
                
                exit;
            } else {
              echo "Oops! file not found!";
            }
    break;
  
  default:
    echo "Oops! file not found!";
    break;
}
?>