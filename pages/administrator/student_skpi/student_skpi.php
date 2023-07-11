			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">SKPI Student</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">SKPI Student</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                if (empty(@$_GET['code'])) {
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code"));        

                	$majors_code=$code['majors_code'];
                	$thn2=date('Y')+1;
                	$gen=date('Y')."/".$thn2;

                } else {
                	$majors_code	=htmlspecialchars(@$_GET['code']);
                	$gen 			=htmlspecialchars(@$_GET['gen']);
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
					                            		WHERE majors_code='$majors_code'"));
                }

                $page_input="page.php?p=student_skpi&act=input&code=".$code['majors_code']."&gen=".$gen;
                $page_edit="page.php?p=student_skpi&act=edit&code=".$code['majors_code']."&gen=".$gen;
                $back="page.php?p=student_skpi&code=".$code['majors_code']."&gen=".$gen;
                $page_print="pages/administrator/student_skpi/report_pdf.php";
                $action="pages/administrator/student_skpi/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:

				@$tot_student=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		account.account_status='Mahasiswa'"));

				@$tot_entry=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN master_student_skpi_file ON master_student_skpi_file.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		account.account_status='Mahasiswa'"));

				@$tot_male=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN master_student_skpi_file ON master_student_skpi_file.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
														master_student.student_gender='Male' AND
					                            		account.account_status='Mahasiswa'"));

				@$tot_female=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN master_student_skpi_file ON master_student_skpi_file.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
														master_student.student_gender='Female' AND
					                            		account.account_status='Mahasiswa'"));
				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">SKPI Student Data </h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">

					                                <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>

					                            </div>
					                        </div>
					                    </div>

							                <div class="panel-body panel-bordered panel-info text-center clearfix">
							                    <div class="col-sm-4 pad-top">
							                        <div class="text-lg">
							                            <p class="text-5x text-thin text-main"><?= number_format($tot_student); ?></p>
							                        </div>
							                        <p class="text-sm text-bold text-uppercase">Student</p>
							                    </div>
							                    <div class="col-sm-8">
							                       <p class="text-bold">
							                       	Generation : <?= $gen; ?> <br>
								                    College : <?= $code['college']; ?> <br> 
								                    Majors : <?= $code['majors']; ?>
							                       </p>
							                        <ul class="list-unstyled text-center bord-top pad-top mar-no row">
							                            <li class="col-xs-4">
							                                <span class="text-lg text-semibold text-main"><?= number_format($tot_entry); ?></span>
							                                <p class="text-sm text-muted mar-no">Entry</p>
							                            </li>
							                            <li class="col-xs-4">
							                                <span class="text-lg text-semibold text-main"><?= number_format($tot_male); ?></span>
							                                <p class="text-sm text-muted mar-no">Male</p>
							                            </li>
							                            <li class="col-xs-4">
							                                <span class="text-lg text-semibold text-main"><?= number_format($tot_female); ?></span>
							                                <p class="text-sm text-muted mar-no">Female</p>
							                            </li>
							                        </ul>
							                    </div>
							                </div>
							                <br>

					                    <div class="table-responsive">
					                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Photo</th>
					                                    <th>NIM</th>
					                                    <th>Name</th>
					                                    <th>Gender</th>
					                                    <th>No SKPI</th>
					                                    <th>Create Date</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_student_skpi_file
					                            		LEFT JOIN master_student ON master_student.student_nim=master_student_skpi_file.student_nim
					                            		LEFT JOIN account on account.account_id=master_student.account_id
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen'
														group by master_student_skpi_file.student_nim 
														order by master_student_skpi_file.create_date desc");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            		$skpi=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_skpi
					                            					WHERE student_nim='$row[student_nim]'"));
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><img src="assets/account_photo/<?= $row['account_photo']; ?>" alt="" style="width: 50px;"></td>
					                                    <td><?= $row['student_nim']; ?></td>
					                                    <td><?= $row['student_name']; ?></td>
					                                    <td><?= $row['student_gender']; ?></td>
					                                    <td><?= $skpi['student_skpi_no']; ?></td>
					                                    <td><?= $row['create_date']; ?></td>
					                                    <td>
					                                    	<?php if (!empty($skpi['student_skpi_no'])) { ?>
					                                    		<a href="<?= $page_input; ?>&nim=<?= $row['student_nim']; ?>">
						                               		 	<button class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button></a> 

						                               		 	<a href="<?= $page_print; ?>?nim=<?= $row['student_nim']; ?>" target="_blank">
						                               		 	<button class="btn btn-default" title="Print"><i class="fa fa-print"></i></button></a> 

					                                    	<?php } else { ?>
					                                    		<a href="<?= $page_input; ?>&nim=<?= $row['student_nim']; ?>">
						                               		 	<button class="btn btn-primary" title="Input"><i class="fa fa-plus"></i></button></a>
					                                    	<?php } ?>
					                                    </td>
					                                </tr>
					                            	<?php $no++; } ?>
					                            </tbody>
					                        </table>
					                    </div>
					                </div>
					                <!--===================================================-->
					                <!--End Data Table-->
					
					            </div>
					        </div>
					    </div>
					
                </div>
                <!--===================================================-->
                <!--End page content-->


                <!-- Modal -->
				<div id="filter" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Filter Student</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="student_skpi">
				      <div class="modal-body">
				      					
				      					
				      					<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Generation <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="gen" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$start=date('Y')-2;
					                            	$end=date('Y')+1;
					                            	for ($i=$start; $i <= $end ; $i++) { 
					                            		$generation=$i."/".($i+1);
					                            		if ($generation==$gen) {
					                            	?>
					                            		<option value="<?= $generation; ?>" selected><?= $generation; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $generation; ?>"><?= $generation; ?></option>
					                            	 <?php } } ?>
					                            	
					                            </select>
					                        </div>
					                    </div>

				        				<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	College <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select id="college_code" onchange="select_majors(this.value);" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_college");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($code['college_code']==$opt['college_code']) {
					                            	?>
					                            		<option value="<?= $opt['college_code']; ?>" selected><?= $opt['college']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['college_code']; ?>"><?= $opt['college']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Majors <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="code" id="majors_code" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_majors");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($code['majors_code']==$opt['majors_code']) {
					                            	?>
					                            		<option value="<?= $opt['majors_code']; ?>" selected><?= $opt['majors']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['majors_code']; ?>"><?= $opt['majors']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>


                <?php 
                break;
                case 'input':
                $student_nim=htmlspecialchars(@$_GET['nim']);
                $student=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student where student_nim='$student_nim'"));
                $skpi=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_skpi where student_nim='$student_nim'"));
                $weight=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_skpi_weight where student_nim='$student_nim'"));
                $skpi_weight=$weight['bobot_prestasi_penghargaan']+
				            $weight['bobot_penghargaan_pemenang']+
				            $weight['bobot_seminar']+
				            $weight['bobot_organisasi']+
				            $weight['bobot_tugas_akhir']+
				            $weight['bobot_bahasa_internasional']+
				            $weight['bobot_magang']+
				            $weight['bobot_pendidikan_karakter'];
               	?>

               	<div id="page-content">
               		<div class="panel">
               			<div class="panel-body">
               			<div class="alert alert-info">
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>
						               </div>
					<div class="panel-body">
					 <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					    <input type="hidden" name="action" value="input">
					    <input type="hidden" name="student_nim" value="<?= $student_nim; ?>">

						<table class="table" style="color:black;">
		                    <tr>
		                        <td width="50%"><b>SURAT KETERANGAN PENDAMPING IJAZAH <br> <i>Diploma Supplement</i></b></td>
		                        <td><input type="text" class="form-control" name="student_skpi_no" value="<?= $skpi['student_skpi_no']; ?>" placeholder="NOMOR"></td>
		                    </tr>
		                    <tr>
		                        <td colspan="2">Surat Keterangan Pendamping Ijazah menerangkan Capaian Pembelajaran dan Prestasi 
		                            dari Pemegang Ijazah selama masa studi di Sekolah Tinggi Desain Interstudi
		                            <i>The Diploma Supplement Certifies the Study Accomplishment of Its Bearer During 
		                            the Period of Study at Interstudi College of Design</i>
		                            </td>
		                    </tr>
		                    <tr style="background:#DCDCDC; border:1px solid black;">
		                        <td colspan="2"><b>
		                            01.  IDENTITAS TENTANG IDENTITAS DIRI PEMEGANG SKPI <br>
		                            <i>01.  Information Identifying The Helder of Diploma Supplement</i></b>
		                        </td>
		                    </tr>
		                    <tr>
		                      <td><b>Nama Lengkap</b><br>
		                         <i>Full Name</i>
		                        </td>
		                      <td> <?= $student['student_name']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Tempat & Tanggal Lahir </b><br>
		                            <i>Place and Date of Birth</i>
		                      </td>
		                      <td> <?= $student['student_place_birth']; ?> , <?= $student['student_date_birth']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Nomor Induk Mahasiswa </b><br>
		                        <i>Student Identification Number</i>
		                        </td>
		                      <td> <?= $student['student_nim']; ?></td>
		                    </tr>
		                    <tr>
		                      <td><b>Tahun Masuk </b><br>
		                            <i>Admission Year</i>
		                            </td>
		                      <td><input type="text" class="form-control" name="student_skpi_entry_year" value="<?= $skpi['student_skpi_entry_year']; ?>" placeholder="Tahun Masuk"></td>
		                    </tr>
		                    <tr>
		                      <td><b>Tanggal Kelulusan </b><br>
		                        <i>Date of Graduation</i>
		                        </td>
		                      <td>
		                      	<div id="demo-dp-txtinput">
		                      		<input type="text"name="student_skpi_graduation_date" value="<?= $skpi['student_skpi_graduation_date']; ?>" required="required" placeholder="Tanggal Kelulusan" class="form-control col-md-7 col-xs-12">
		                      	</div></td>
		                    </tr>
		                    <tr>
		                      <td><b>Nomor Ijazah </b><br>
		                        <i>Number of Certificate</i>
		                        </td>
		                      <td><input type="text" class="form-control" name="student_skpi_diploma_number" value="<?= $skpi['student_skpi_diploma_number']; ?>" placeholder="Nomor Ijazah"></td>
		                    </tr>
		                    <tr>
		                      <td><b>Gelar</b><br>
		                        <i>Title</i>
		                        </td>
		                      <td><input type="text" class="form-control" name="student_skpi_degree" value="<?= $skpi['student_skpi_degree']; ?>" placeholder="Gelar"></td>
		                    </tr>
		                    <tr>
		                      <td><b>Lama Studi</b><br>
		                        <i>Regular Length of Study</i>
		                        </td>
		                      <td><input type="text" class="form-control" name="student_skpi_length_study" value="<?= $skpi['student_skpi_length_study']; ?>" placeholder="Lama Studi"></td>
		                    </tr>
		                    <tr>
		                      <td><b>Sistem Kredit Semester</b><br>
		                        <i>Credits</i>
		                        </td>
		                      <td><input type="text" class="form-control" name="student_skpi_sks" value="<?= $skpi['student_skpi_sks']; ?>" placeholder="Sistem Kredit Semester"></td>
		                    </tr>
		                    <tr>
		                      <td><b>Indeks Prestasi Kumulatif</b><br>
		                        <i> Grade Point Average</i>
		                        </td>
		                      <td><input type="text" class="form-control" name="student_skpi_ipk" value="<?= $skpi['student_skpi_ipk']; ?>" placeholder="Indeks Prestasi Kumulatif"></td>
		                    </tr>
		                    
		                    
		                    
		                    
		                    <tr style="background:#DCDCDC; border:1px solid black;">
		                        <td colspan="2"><b>02.  INFORMASI TENTANG IDENTITAS PENYELENGGARA PROGRAM <br>
		                            <i>02.  Information Identifying The Holder  of Diploma Supplement</i></b>
		                            </td>
		                    </tr>
		                    <tr>
		                        <td><b>SURAT KEPUTUSAN  PENDIRIAN PERGURUAN TINGGI
		                        MENTERI PENDIDIKAN DAN KEBUDAYAAN REPUBLIK INDONESIA</b>
		                        </td>
		                        <td><i>Awarding Institution’s License
		                        Minister Of Education And Culture Of The Republic Of Indonesia</i>
		                        </td>
		                    </tr>
		                    <tr>
		                        <td><b>Nomor  : 101/D/0/1999</b></td>
		                        <td><i>Number : 101/D/0/1999</i></td>
		                    </tr>
		                    <tr>
		                        <td><b>NAMA PERGURUAN TINGGI</b></td>
		                        <td><i>Awarding Institution</i></td>
		                    </tr>
		                    <tr>
		                        <td><b>SEKOLAH TINGGI DESAIN INTERSTUDI</b></td>
		                        <td><i>Interstudi College of Design</i></td>
		                    </tr>
		                    <tr>
		                        <td><b>Program Studi </b><br>
		                        <i>Study Program</i>
		                        </td>
		                        <td><input type="text" name="student_skpi_study_program" value="<?= $skpi['student_skpi_study_program']; ?>" placeholder="Program Studi" value="<?= $code['majors']; ?>" class="form-control"></td>
		                    </tr>
		                    <tr>
		                        <td><b>Jenis/Jenjang Pendidikan</b><br>
		                        <i>Education Degree</i>
		                        </td>
		                        <td><input type="text" name="student_skpi_educational_level" value="<?= $skpi['student_skpi_educational_level']; ?>" placeholder="Jenis/Jenjang Pendidikan" class="form-control"></td>
		                    </tr>
		                    <tr>
		                        <td><b>Jenjang Kualifikasi KKNI</b><br>
		                        <i>Scheme Level in the Indonesian Qualification Framework</i>
		                        </td>
		                        <td><input type="text" name="student_skpi_our_level" value="<?= $skpi['student_skpi_our_level']; ?>" placeholder="Jenjang Kualifikasi KKNI" class="form-control"></td>
		                    </tr>
		                    <tr>
		                        <td><b>Persyaratan Penerimaan</b><br>
		                        <i>Admission Requirements</i>
		                        </td>
		                        <td><input type="text" name="student_skpi_admission_requirements" value="<?= $skpi['student_skpi_admission_requirements']; ?>" placeholder="Persyaratan Penerimaan" class="form-control"></td>
		                    </tr>
		                    <tr>
		                        <td><b>Bahasa Pengantar Kuliah</b><br>
		                        <i>Lingua Franca/Spoken Language</i>
		                        </td>
		                        <td><input type="text" name="student_skpi_language_instruction" value="<?= $skpi['student_skpi_language_instruction']; ?>" placeholder="Bahasa Pengantar Kuliah" class="form-control"></td>
		                    </tr>
		                    <tr>
		                        <td><b>Sistem Penilaian</b><br>
		                        <i>Grading System</i>
		                        </td>
		                        <td><input type="text" name="student_skpi_scoring_system" value="<?= $skpi['student_skpi_scoring_system']; ?>" placeholder="Sistem Penilaian" class="form-control"></td>
		                    </tr>
		                    <tr>
		                        <td><b>Pendidikan Lanjut</b><br>
		                        <i>Further Study</i>
		                        </td>
		                        <td><input type="text" name="student_skpi_further_education" value="<?= $skpi['student_skpi_further_education']; ?>" placeholder="Pendidikan Lanjut" class="form-control"></td>
		                    </tr>
		                    <tr>
		                        <td><b>Status Profesi (Bila Ada)</b><br>
		                        <i>Professional Status (If Applicable)</i>
		                        </td>
		                        <td><input type="text" name="student_skpi_professional_status" value="<?= $skpi['student_skpi_professional_status']; ?>" placeholder="Status Profesi" class="form-control"></td>
		                    </tr>
		                    <tr style="background:#DCDCDC; border:1px solid black;">
		                        <td colspan="2"><b>03.   INFORMASI TENTANG KUALIFIKASI DAN HASIL YANG DICAPAI <br>
		                            <i>03.   Information Identifying the Qualification and Outcomes Obtained</i></b>
		                            </td>
		                    </tr>
		                    <tr>
		                        <td><b>A.  CAPAIAN PEMBELAJARAN</b>
		                        <textarea name="capaian_pembelajaran_ind" class="form-control demo-summernote2"  placeholder="Bahasa Indonesia"><?= $skpi['capaian_pembelajaran_ind']; ?></textarea></td>
		                        <td><b><i>A.  LEARNING OUTCOMES</i></b>
		                        <textarea name="capaian_pembelajaran_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['capaian_pembelajaran_ing']; ?></textarea></td>
		                    </tr>
		                    <tr>
		                        <td><b>KEMAMPUAN DI BIDANG KERJA</b>
		                        <textarea name="kemampuan_dibidang_kerja_ind" class="form-control demo-summernote2" placeholder="Bahasa Indonesia"><?= $skpi['kemampuan_dibidang_kerja_ind']; ?></textarea></td>
		                        <td><b><i>ABILITY IN THE FIELD OF WORK</i></b>
		                        <textarea name="kemampuan_dibidang_kerja_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['kemampuan_dibidang_kerja_ing']; ?></textarea></td>
		                    </tr>
		                    <tr>
		                        <td><b>PENGETAHUAN YANG DIKUASAI</b>
		                        <textarea name="pengetahuan_dikuasai_ind" class="form-control demo-summernote2" placeholder="Bahasa Indonesia"><?= $skpi['pengetahuan_dikuasai_ind']; ?></textarea></td>
		                        <td><b><i>ABILITY OF KNOWLEDGE </i></b>
		                        <textarea name="pengetahuan_dikuasai_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['pengetahuan_dikuasai_ing']; ?></textarea></td>
		                    </tr>
		                    <tr>
		                        <td><b>SIKAP KHUSUS</b>
		                        <textarea name="sikap_khusus_ind" class="form-control demo-summernote2" placeholder="Bahasa Indonesia"><?= $skpi['sikap_khusus_ind']; ?></textarea></td>
		                        <td><b><i>AUTHORITY & RESPONSIBILITY </i></b>
		                        <textarea name="sikap_khusus_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['sikap_khusus_ing']; ?></textarea></td>
		                    </tr>
		                    <tr>
		                        <td>1.	Bertanggung jawab terhadap metode dan hasil realisasinya atas kebijakan yang diambil berdasarkan analisis ………. <br>
		                            2.	Bertanggung jawab atas pekerjaannya
		                            </td>
		                        <td><i>1. Responsible for methods and its realization results of the selected policy based on the …………… <br>
		                        2. Responsible for the job</i>
		                        </td>
		                    </tr>
		                    <tr>
		                        <td><b>B.  PRESTASI DAN PENGHARGAAN</b></td>
		                        <td><b><i>B.  ACHIEVEMENTS AND AWARDS</i></b></td>
		                    </tr>
		                    <tr>
		                        <td>Pemegang Surat Keterangan Pendamping Ijazah ini memiliki sertifikat profesional:
		                        <textarea name="prestasi_penghargaan_ind" class="form-control demo-summernote2" placeholder="Bahasa Indonesia"><?= $skpi['prestasi_penghargaan_ind']; ?></textarea>
		                        <div class="col-md-3 pull-right" style="margin:5px;">
		                            <input type="number" name="bobot_prestasi_penghargaan" value="<?= $weight['bobot_prestasi_penghargaan']; ?>" id="bobot_prestasi_penghargaan" onkeyup="sum();" value="0" class="form-control"  placeholder="Bobot">
		                        </div>
		                        
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='prestasi'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td> <a href="download_file.php?act=skpi&file=<?= $student['account_id']; ?>!<?= $a['student_skpi_file_id']; ?>" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file"></i></button></a>
		                                 <?= $a['student_skpi_file_title_ind']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Jam</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table>
		                        </td>
		                        
		                        <td><i>The bearer of this Diploma Supplement obtained the following professional certifications:</i>
		                        <textarea name="prestasi_penghargaan_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['prestasi_penghargaan_ing']; ?></textarea>
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='prestasi'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td><?= $a['student_skpi_file_title_ing']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Hour</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                    </tr>
		                    <tr>
		                        <td><b>C.  INFORMASI TAMBAHAN</b></td>
		                        <td><b><i>C.  ADDITIONAL INFORMATION</i></b></td>
		                    </tr>
		                    <tr>
		                        <td><b>3.C1. Penghargaan dan Pemenang Kejuaraan</b>
		                        <textarea name="penghargaan_pemenang_ind" class="form-control demo-summernote2" placeholder="Bahasa Indonesia"><?= $skpi['penghargaan_pemenang_ind']; ?></textarea>
		                        <div class="col-md-3 pull-right" style="margin:5px;">
		                            <input type="number" name="bobot_penghargaan_pemenang" value="<?= $weight['bobot_penghargaan_pemenang']; ?>" id="bobot_penghargaan_pemenang" onkeyup="sum();" value="0" class="form-control"  placeholder="Bobot">
		                        </div>
		                        
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='penghargaan'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td> <a href="download_file.php?act=skpi&file=<?= $student['account_id']; ?>!<?= $a['student_skpi_file_id']; ?>" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file"></i></button></a>
		                                 <?= $a['student_skpi_file_title_ind']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Jam</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                        <td><b>3. C1. Honor and Awards</b>
		                        <textarea name="penghargaan_pemenang_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['penghargaan_pemenang_ing']; ?></textarea>
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='penghargaan'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td><?= $a['student_skpi_file_title_ing']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Hour</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                    </tr>
		                    <tr>
		                        <td><b>3. C2. Seminar</b>
		                        <textarea name="seminar_ind" class="form-control demo-summernote2"  placeholder="Bahasa Indonesia"><?= $skpi['seminar_ind']; ?></textarea>
		                        <div class="col-md-3 pull-right" style="margin:5px;">
		                            <input type="number" name="bobot_seminar" value="<?= $weight['bobot_seminar']; ?>" id="bobot_seminar" onkeyup="sum();" value="0" class="form-control"  placeholder="Bobot">
		                        </div>
		                        
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='seminar'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                 <td> <a href="download_file.php?act=skpi&file=<?= $student['account_id']; ?>!<?= $a['student_skpi_file_id']; ?>" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file"></i></button></a>
		                                 <?= $a['student_skpi_file_title_ind']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Jam</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                        <td><b>3.C2. Seminar</b>
		                        <textarea name="seminar_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['seminar_ing']; ?></textarea>
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='seminar'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                 <td><?= $a['student_skpi_file_title_ing']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Hour</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                    </tr>
		                    <tr>
		                        <td><b>3.C3. Pengalaman Organisasi</b>
		                        <textarea name="organisasi_ind" class="form-control demo-summernote2" placeholder="Bahasa Indonesia"><?= $skpi['organisasi_ind']; ?></textarea>
		                        <div class="col-md-3 pull-right" style="margin:5px;">
		                            <input type="number" name="bobot_organisasi" value="<?= $weight['bobot_organisasi']; ?>" id="bobot_organisasi" onkeyup="sum();" value="0" class="form-control"  placeholder="Bobot">
		                        </div>
		                        
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='pengalaman'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td> <a href="download_file.php?act=skpi&file=<?= $student['account_id']; ?>!<?= $a['student_skpi_file_id']; ?>" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file"></i></button></a>
		                                 <?= $a['student_skpi_file_title_ind']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Jam</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                        <td><b>3. C3. Organizational Experiences</b>
		                        <textarea name="organisasi_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['organisasi_ing']; ?></textarea>
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='pengalaman'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td><?= $a['student_skpi_file_title_ing']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Hour</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                    </tr>
		                    <tr>
		                        <td><b>3.C4. Spesifikasi Tugas Akhir/Judul Skripsi</b>
		                        <textarea name="tugas_akhir_ind" class="form-control demo-summernote2" placeholder="Bahasa Indonesia"><?= $skpi['tugas_akhir_ind']; ?></textarea>
		                        <div class="col-md-3 pull-right" style="margin:5px;">
		                            <input type="number" name="bobot_tugas_akhir" value="<?= $weight['bobot_tugas_akhir']; ?>" id="bobot_tugas_akhir" onkeyup="sum();" value="0" class="form-control"  placeholder="Bobot">
		                        </div>
		                        
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='tugas_akhir'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td> <a href="download_file.php?act=skpi&file=<?= $student['account_id']; ?>!<?= $a['student_skpi_file_id']; ?>" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file"></i></button></a>
		                                 <?= $a['student_skpi_file_title_ind']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Jam</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                        <td><b>3. C4. Specification of The Final Project</b>
		                        <textarea name="tugas_akhir_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['tugas_akhir_ing']; ?></textarea>
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='tugas_akhir'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td><?= $a['student_skpi_file_title_ing']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Hour</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                    </tr>
		                    <tr>
		                        <td><b>3. C5. Bahasa Internasional</b>
		                        <textarea name="bahasa_internasional_ind" class="form-control demo-summernote2" placeholder="Bahasa Indonesia"><?= $skpi['bahasa_internasional_ind']; ?></textarea>
		                        <div class="col-md-3 pull-right" style="margin:5px;">
		                            <input type="number" name="bobot_bahasa_internasional" value="<?= $weight['bobot_bahasa_internasional']; ?>" id="bobot_bahasa_internasional" onkeyup="sum();" value="0" class="form-control"  placeholder="Bobot">
		                        </div>
		                        
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='bahasa'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td> <a href="download_file.php?act=skpi&file=<?= $student['account_id']; ?>!<?= $a['student_skpi_file_id']; ?>" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file"></i></button></a>
		                                 <?= $a['student_skpi_file_title_ind']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Jam</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                        <td><b>3. C5. International Language</b>
		                        <textarea name="bahasa_internasional_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['bahasa_internasional_ing']; ?></textarea>
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='bahasa'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td><?= $a['student_skpi_file_title_ing']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Hour</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                    </tr>
		                    <tr>
		                        <td><b>3. C6. Magang</b>
		                        <textarea name="magang_ind" class="form-control demo-summernote2" placeholder="Bahasa Indonesia"><?= $skpi['magang_ind']; ?></textarea>
		                        <div class="col-md-3 pull-right" style="margin:5px;">
		                            <input type="number" name="bobot_magang" value="<?= $weight['bobot_magang']; ?>" id="bobot_magang" onkeyup="sum();" value="0" class="form-control"  placeholder="Bobot">
		                        </div>
		                        
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='magang'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td> <a href="download_file.php?act=skpi&file=<?= $student['account_id']; ?>!<?= $a['student_skpi_file_id']; ?>" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file"></i></button></a>
		                                 <?= $a['student_skpi_file_title_ind']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Jam</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                        <td><b>3. C6. Internship</b>
		                        <textarea name="magang_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['magang_ing']; ?></textarea>
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='magang'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td><?= $a['student_skpi_file_title_ing']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Hour</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                    </tr>
		                    <tr>
		                        <td><b>3. C7. Pendidikan Karakter</b>
		                        <textarea name="pendidikan_karakter_ind" class="form-control demo-summernote2" placeholder="Bahasa Indonesia"><?= $skpi['pendidikan_karakter_ind']; ?></textarea>
		                        <div class="col-md-3 pull-right" style="margin:5px;">
		                            <input type="number" id="total" value="<?= $skpi_weight; ?>" class="form-control"  placeholder="Total" readonly>
		                        </div>
		                        <div class="col-md-3 pull-right" style="margin:5px;">
		                            <input type="number" name="bobot_pendidikan_karakter" value="<?= $weight['bobot_pendidikan_karakter']; ?>" id="bobot_pendidikan_karakter" onkeyup="sum();" value="0" class="form-control"  placeholder="Bobot">
		                        </div>
		                        
		                        
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='pendidikan'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td> <a href="download_file.php?act=skpi&file=<?= $student['account_id']; ?>!<?= $a['student_skpi_file_id']; ?>" target="_blank"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-file"></i></button></a>
		                                 <?= $a['student_skpi_file_title_ind']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Jam</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                        <td><b>3. C7. Soft Skill Training </b>
		                        <textarea name="pendidikan_karakter_ing" class="form-control demo-summernote2" placeholder="Bahasa Inggris"><?= $skpi['pendidikan_karakter_ing']; ?></textarea>
		                        <table class="table table-bordered">
		                        <?php
		                        $data=mysqli_query($connect,"SELECT * FROM master_student_skpi_file where student_nim='$student[student_nim]' AND student_skpi_file_status='pendidikan'");
		                        while ($a=mysqli_fetch_array($data)) {
		                        ?>
		                            <tr>
		                                <td><?= $a['student_skpi_file_title_ing']; ?> </td>
		                                <td><?= $a['student_skpi_file_institution']; ?></td>
		                                <td><?= $a['student_skpi_file_duration']; ?> Hour</td>
		                            </tr>
		                        
		                        <?php } ?>
		                        </table></td>
		                    </tr>
		                    <tr style="background:#DCDCDC; border:1px solid black;">
		                        <td colspan="2"><b>04.   SKEMA TENTANG SISTEM PENDIDIKAN TINGGI DI INDONESIA<br>
		                            <i>04.   Scheme Of The Indonesian Higher Education System </i></b>
		                            </td>
		                    </tr>
		                    <tr>
		                        <td colspan="2" align="center"><img src="assets/logo/skema_pendidikan.png" width="350px"></td>
		                    </tr>
		                    <tr>
		                        <td><ul style="list-style-type:disc;">
		                            <li>Kerangka Kualifikasi Nasional Indonesia, yang selanjutnya disingkat KKNI adalah kerangka penjenjangan kualifikasi kompetensi yang dapat menyandingkan, menyetarakan, dan mengintegrasikan antara bidang pendidikan dan bidang pelatihan kerja serta pengalaman kerja dalam rangka pemberian pengakuan kompetensi kerja sesuai dengan struktur pekerjaan di berbagai bidang.</li>
		                        </ul></td>
		                        <td><ul style="list-style-type:disc;">
		                            <li><i>KKNI as known as Indonesian Qualification Framework is a competence grading system which integrates the aspects of education, training, and working experience in purpose of acknowledging the capacity based on work qualification in various sectors.</i></li>
		                        </ul></td>
		                    </tr>
		                    <tr>
		                        <td><ul style="list-style-type:disc;">
		                            <li>KKNI merupakan perwujudan mutu dan jati diri bangsa Indonesia terkait dengan sistem pendidikan dan pelatihan nasional yang dimiliki Indonesia.</li>
		                        </ul></td>
		                        <td><ul style="list-style-type:disc;">
		                            <li><i>KKNI is the resemblance of Indonesian quality and identify concerning its national training and education system.</i></li>
		                        </ul></td>
		                    </tr>
		                    <tr>
		                        <td><ul style="list-style-type:disc;">
		                            <li>Jenjang kualifikasi adalah tingkat capaian pembelajaran yang disepakati secara nasional, disusun berdasarkan ukuran hasil pendidikan dan/atau pelatihan yang diperoleh melalui pendidikan formal, nonformal atau pengalaman kerja.</li>
		                        </ul></td>
		                        <td><ul style="list-style-type:disc;">
		                            <li><i>Qualification level, a nationally legalized learning outcomes, is composed by the results of education and training activities (formal, nonformal) or working experiences.</i></li>
		                        </ul></td>
		                    </tr>
		                    <tr>
		                        <td colspan="2"> Jakarta, <?= date('d M Y'); ?> <br> 
		                            FAKULTAS <?= strtoupper($code['college']); ?> 
		                            <br> Dekan <br> 
		                            <small>Dekan,</small> 
		                            <br><br><br><br><br> 
		                            <u><b><?= strtoupper($code['college_dean']); ?></b></u> <br> NIK ..............................................</td>
		                    </tr>
		                  </table>

		                  			<div class="panel-footer text-right">
					                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
					                </div>
		              </form>
		             </div>

					</div>
               	</div>

                <?php	break;
                
                } ?>

            </div>

        <script>
        function sum() {
              var bobot_prestasi_penghargaan = document.getElementById('bobot_prestasi_penghargaan').value;
              var bobot_penghargaan_pemenang = document.getElementById('bobot_penghargaan_pemenang').value;
              var bobot_seminar = document.getElementById('bobot_seminar').value;
              var bobot_organisasi = document.getElementById('bobot_organisasi').value;
              var bobot_tugas_akhir = document.getElementById('bobot_tugas_akhir').value;
              var bobot_bahasa_internasional = document.getElementById('bobot_bahasa_internasional').value;
              var bobot_magang = document.getElementById('bobot_magang').value;
              var bobot_pendidikan_karakter = document.getElementById('bobot_pendidikan_karakter').value;
              
              var result = (parseInt(bobot_prestasi_penghargaan) + 
                            parseInt(bobot_penghargaan_pemenang) + 
                            parseInt(bobot_seminar) + 
                            parseInt(bobot_organisasi) + 
                            parseInt(bobot_tugas_akhir) + 
                            parseInt(bobot_bahasa_internasional) + 
                            parseInt(bobot_magang) + 
                            parseInt(bobot_pendidikan_karakter));
              if (!isNaN(result)) {
                 document.getElementById('total').value = result;
              }
        }
        </script>


