<?php
include "../../config/connection.php";
if(isset($_POST["query"])){
    $output = '';
    $key = "%".$_POST["query"]."%";
    $query = "SELECT * FROM account WHERE account_username LIKE ? LIMIT 10";
    $account = $connect->prepare($query);
    $account->bind_param('s', $key);
    $account->execute();
    $result = $account->get_result();
 
 	$cari_keyword = $connect->real_escape_string($_POST['query']);
 	$bold_cari_keyword = '<strong>'.$cari_keyword.'</strong>';
    $output = '<ul class="list-group">';
    if($result->num_rows > 0){
      while ($row = $result->fetch_assoc()) {
        $output .= '<li class="list-group-item">'.str_ireplace($cari_keyword,$bold_cari_keyword,$row["account_username"].'|'.$row["account_status"]).'</li>';  
      }
    } else {
       $output .= '<li class="list-group-item">No matching records.</li>';  
    }  
    $output .= '</ul>';
    echo $output;
  }

?>