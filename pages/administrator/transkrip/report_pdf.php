<?php
include "../../../config/connection.php";
require_once("../../../dompdf/dompdf_config.inc.php");

$student_nim		=htmlspecialchars($_GET['nim']);
$data=mysqli_query($connect, "SELECT * FROM master_score
									LEFT JOIN master_student ON master_student.student_nim=master_score.student_nim
									LEFT JOIN master_college ON master_college.college_code=master_student.college_code
									LEFT JOIN master_majors ON master_majors.majors_code=master_student.majors_code
									where master_score.student_nim='$student_nim'");
$student=mysqli_fetch_array($data);

ob_start(); 
?>
<html>
<style type="text/css">
   table.mk thead tr th {
		border:1px solid black;
	}
				        
	table.mk tbody tr td {
		border-left:1px solid black;
		border-right:1px solid black;
	}
				        
	table.mk tfoot tr td {
		border-left:1px solid black;
		border-right:1px solid black;
	}
</style>
<body>
	<p align="center">
		<h3>Indeks Prestasi Komulatif</h3>
	</p>

		<table width="100%">
			<tr>
				<td  width="30%">College</td>
				<td>: <?= $student['college']; ?></td>
			</tr>
			<tr>
				<td>Majors</td>
				<td>:  <?= $student['majors']; ?></td>				
			</tr>
			<tr>
				<td>NIM</td>
				<td>:  <?= $student['student_nim']; ?></td>
			</tr>
			<tr>
				<td>Name</td>
				<td>: <?= $student['student_name']; ?></td>
			</tr>
		</table>
		<br>


		<table width="100%" style="border:1px solid black" class="mk">
                          <thead>
                            <tr>
                              <th width="5%">NO</th>
                              <th width="15%">KODE MK</th>
                              <th width="55%">MATAKULIAH</th>
                              <th width="8%">NIL <BR> (N)</th>
                              <th width="8%">BBT <BR> SKS <br> (K)</th>
                              <th width="8%">NxK</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $no=1;
                            $tot_sks=0;
                            $nilai=0;
                            $angka_mutu=0;
                            $data=mysql_query(" 
                              SELECT max(id_nilai) as id_nilai FROM nilai 
                              where nim_mahasiswa='$mah[nim_mahasiswa]'
				            GROUP BY kode_matakuliah");
                            while ($b=mysql_fetch_array($data)) {
            			    $a=mysql_fetch_array(mysql_query("SELECT * FROM nilai where id_nilai='$b[id_nilai]'"));


                            $nilai=$nilai+($a['sks_matakuliah']*$a['angka_mutu']);
                            $tot_sks=$tot_sks+$a['sks_matakuliah'];
                            $angka_mutu=$angka_mutu+$a['angka_mutu'];
                            $mk=strtolower($a['nama_matakuliah']);
                            
                            ?>
                            <tr>
                              <td align="center"><?php echo $no; ?></td>
                              <td>&nbsp;&nbsp; <?php echo $a['kode_matakuliah']; ?></td>
                              <td>&nbsp;&nbsp; <?php echo ucwords($mk); ?></td>
                              <td align="center"><?php echo $a['nilai_huruf']; ?></td>
                              <td align="center"><?php echo $a['sks_matakuliah']; ?></td>
                              <td align="center"><?php echo $a['sks_matakuliah']*$a['angka_mutu']; ?></td>
                            </tr>
                            <?php $no++; } ?>
                          </tbody>
                          <tfoot>
                              <tr>
                                  <td colspan="3" align="right">JUMLAH &nbsp;&nbsp; </td>
                                  <td></td>
                                  <td align="center"><?= $tot_sks; ?></td>
                                  <td align="center"><?= $nilai; ?></td>
                              </tr>
                          </tfoot>
                        </table>
                        
                        
                        <?php
                          $grand_akhir=$nilai/$tot_sks;
                              if ($grand_akhir<="0") {
                                $angka_mutu2="0.00";
                              } else {
                                $angka_mutu2=$grand_akhir;
                              }
    
                              $ba=mysql_fetch_array(mysql_query("SELECT * FROM bobot_angka where 
                                      angka_mutu<='$angka_mutu2'"));
                                      
                        ?>
                        
                        <br>
                        <div style="padding:2px; border:1px solid black; width:100%;">
                            <b><u>Judul Skripsi </u> : </b>
                        </div>
                        <br>
                        <table width="100%">
                            <tbody>
                              <tr>
                                <td style="width:50%">Total satuan kredit semester (SKS)</td>
                                <td>: <b><?php echo $tot_sks; ?></b></td>
                              </tr>
                              <tr>
                                <td>Index Prestasi Komulatif (IPK)</td>
                                <td>: <b><?php echo ROUND ($nilai/$tot_sks,2); ?></b></td>
                              </tr>
                              <tr>
                                <td>P r e d i k a t</td>
                                <td>: <b><?php echo $ba['golongan']; ?></b></td>
                              </tr>
                            </tbody>
                         </table>
</body>
</html>


<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("A4", "potrait");
$dompdf->render();
$dompdf->stream('IPK.pdf',array('Attachment'=>0));
 
?>