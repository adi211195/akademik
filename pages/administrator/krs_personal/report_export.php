<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=EXPORT KRS PERSONAL.xls");

include "../../../config/connection.php";
$majors_code	=htmlspecialchars(@$_GET['code']);
$sy 			=htmlspecialchars(@$_GET['sy']);
$sm 		=htmlspecialchars(@$_GET['sm']);
$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
			LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
			WHERE majors_code='$majors_code'"));
?>

<h3 align="center">
	DAFTAR MAHASISWA <br> 
	<?php echo strtoupper($code['majors']); ?> <br> 
	TAHUN AJARAN <?php echo $sy; ?> 
	<?php echo strtoupper($sm); ?>
</h3>
<table border="1" width="100%" cellspacing="10" cellpadding="10">
    <thead>
        <tr>
            <th>NO</th>
            <th>NIM</th>
            <th>NAMA</th>
            <th>SEM </th>
            <th>SKS</th>
            <th colspan="2" width="30%">PARAF</th>
         </tr>
    </thead>
<tbody>
	<?php
	$no=1;
	$data=mysqli_query($connect, "SELECT * FROM master_krs, master_student
					where 
					    master_krs.student_nim=master_student.student_nim AND
					    master_student.majors_code='$majors_code' AND
					    master_krs.krs_package_id='' AND
					    master_krs.krs_school_year='$sy' AND
					    master_krs.krs_semester='$sm'
					    group by master_krs.student_nim, master_krs.krs_school_year, master_krs.krs_semester 
					    ORDER BY master_student.student_nim asc");
	while ($row=mysqli_fetch_array($data)) {

		$cek_sm=explode("/", $row['student_generation']);
        $cek_sy=explode("/", $sy);
                        
        $jml_sm=$cek_sy[0]-$cek_sm[0];
        if ($sm=="Ganjil"){
            $semester=($jml_sm*2)+1;
        } else {
            $semester=($jml_sm*2)+2;
        }

		$krs=mysqli_fetch_array(mysqli_query($connect, "SELECT 
					                            			sum(courses_sks) as sks,
					                            			count(krs_id) as schedule
					                            			FROM master_krs as ks,
					                            			      master_curriculum as mc 
										                	LEFT JOIN master_courses ON master_courses.courses_code=mc.courses_code 
										                    where 
										                	ks.curriculum_id=mc.curriculum_id 
										                	AND ks.student_nim='$row[student_nim]'
															AND ks.krs_school_year='$row[krs_school_year]'
															AND ks.krs_semester='$row[krs_semester]'
															AND ks.krs_approved='Approved'"));
		$modul=$no % 2;
	?>
	<tr>
		<td><?= $no; ?></td>
		<td><?= $row['student_nim']; ?></td>
		<td><?= $row['student_name']; ?></td>
		<td><?php echo $semester; ?></td>
        <td><?= $krs['sks']; ?></td>
        <td align="left" width="15%"><?php if ($modul=="1") { echo $no;  } ?></td>
        <td align="left" width="15%"><?php if ($modul=="0") { echo $no;  } ?></td>
    </tr>
    <?php $no++; } ?>
</tbody>
</table>