<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");
ob_start(); 
?>



<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("A4", "potrait");
$dompdf->render();
$dompdf->stream('report_salary_teaching.pdf',array('Attachment'=>0));
 
?>