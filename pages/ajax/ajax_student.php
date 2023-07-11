<?php
include "../../config/connection.php";
$open_krs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM settings_open_krs"));
$open_sy=$open_krs['open_school_year'];
$open_sm=$open_krs['open_semester'];

if(isset($_POST["query"])){
    $output = '';
    $key = "%".$_POST["query"]."%";
    $query = "SELECT * FROM master_student WHERE student_name LIKE ? OR student_nim LIKE ? LIMIT 10";
    $student = $connect->prepare($query);
    $student->bind_param('ss', $key, $key);
    $student->execute();
    $result = $student->get_result();
 
 	$cari_keyword = $connect->real_escape_string($_POST['query']);
 	$bold_cari_keyword = '<strong>'.$cari_keyword.'</strong>';
    $output = '<ul class="list-group">';
    if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {

        $status=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_history
                                            WHERE student_nim='$row[student_nim]' AND
                                            student_history_school_year='$open_sy' AND
                                            student_history_semester='$open_sm'"));
        if (empty($status['student_history_status'])) {
          $cekstatus="Empty";
        } else {
          $cekstatus=$status['student_history_status'];
        }

        $output .= '<li class="list-group-item">'.str_ireplace($cari_keyword,$bold_cari_keyword,$row["student_nim"].'|'.$cekstatus.'|'.$row["student_name"]).'</li>';  
      }
    } else {
       $output .= '<li class="list-group-item">No matching records.</li>';  
    }  
    $output .= '</ul>';
    echo $output;
  }

?>