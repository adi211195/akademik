<?php
if ($account_status=="Mahasiswa") {

	include "menu/mahasiswa/menu.php"; 

} elseif ($account_status=="Dosen") {

	include "menu/dosen/menu.php"; 

} elseif ($account_status=="Administrator") {

	include "menu/administrator/menu.php"; 

}

?>

