			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">KRS Package</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">KRS Package</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                if (empty(@$_GET['code'])) {
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code"));
                	$mcurriculum=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum order by curriculum_school_year, curriculum_semester desc"));

                	$majors_code=$code['majors_code'];
                	$sy=$mcurriculum['curriculum_school_year'];
                	$sm=$mcurriculum['curriculum_semester'];
                } else {
                	$majors_code	=htmlspecialchars(@$_GET['code']);
                	$sy 			=htmlspecialchars(@$_GET['sy']);
                	$sm 		=htmlspecialchars(@$_GET['sm']);
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
					                            		WHERE majors_code='$majors_code'"));
                }

                $page_input="page.php?p=krs_package&act=input&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $page_edit="page.php?p=krs_package&act=edit&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $back="page.php?p=krs_package&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $action="pages/administrator/krs_package/action.php";
                $pages="pages/administrator/krs_package/";
                $page_uts="pages/administrator/krs_package/report_uts_all.php";
                $page_uas="pages/administrator/krs_package/report_uas_all.php";
                $page_export="pages/administrator/krs_package/report_export.php?code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $page_list="page.php?p=krs_package&act=list";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:

				@$tot_student=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN student_open_krs ON student_open_krs.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														student_open_krs.student_school_year='$sy' AND
					                            		student_open_krs.student_semester='$sm' AND
					                            		account.account_status='Mahasiswa'"));

				@$tot_entry=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN student_open_krs ON student_open_krs.student_nim=master_student.student_nim
					                            		INNER JOIN master_krs ON master_krs.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_krs.krs_school_year='$sy' AND
					                            		master_krs.krs_semester='$sm' AND
														master_krs.krs_package_id!='' AND
					                            		account.account_status='Mahasiswa'
					                            		group by master_krs.student_nim"));

				@$tot_male=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN student_open_krs ON student_open_krs.student_nim=master_student.student_nim
					                            		INNER JOIN master_krs ON master_krs.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_krs.krs_school_year='$sy' AND
					                            		master_krs.krs_semester='$sm' AND
														master_krs.krs_package_id!='' AND
														master_student.student_gender='Male' AND
					                            		account.account_status='Mahasiswa'
					                            		group by master_krs.student_nim"));

				@$tot_female=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN student_open_krs ON student_open_krs.student_nim=master_student.student_nim
					                            		INNER JOIN master_krs ON master_krs.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_krs.krs_school_year='$sy' AND
					                            		master_krs.krs_semester='$sm' AND
														master_krs.krs_package_id!='' AND
														master_student.student_gender='Female' AND
					                            		account.account_status='Mahasiswa'
					                            		group by master_krs.student_nim"));
				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">KRS Package Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                                <button class="btn btn-purple" data-toggle="modal" data-target="#page_input"><i class="demo-pli-add icon-fw"></i> Add</button>

					                                 <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>

					                                 <div class="btn-group">
							                            <div class="dropdown">
							                                <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
							                                    Print <i class="dropdown-caret"></i>
							                                </button>
							                                <ul class="dropdown-menu dropdown-menu-right">
							                                    <li class="dropdown-header">List Print</li>
							                                    <li><a href="#" data-toggle="modal" data-target="#uts">Print KPU UTS</a></li>
							                                    <li><a href="#" data-toggle="modal" data-target="#uas">Print KPU UAS</a></li>
							                                    <li> <a href="<?= $page_export; ?>" target="_blank">Export KRS</a></li>
							                                </ul>
							                            </div>
							                        </div>
              
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
							                       	School Year : <?= $sy; ?> - <?= $sm; ?> <br>							                       	
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
					                                    <th>NIM</th>
					                                    <th>Name</th>
					                                    <th>Package</th>
					                                    <th>Schedule</th>
					                                    <th>SKS</th>
					                                    <th>Print</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_krs, master_student
					                            		where 
					                            		master_krs.student_nim=master_student.student_nim AND
					                            		master_student.majors_code='$majors_code' AND
					                            		master_krs.krs_package_id!='' AND
					                            		master_krs.krs_school_year='$sy' AND
					                            		master_krs.krs_semester='$sm'
					                            		group by master_krs.student_nim, master_krs.krs_school_year, master_krs.krs_semester 
					                            		ORDER BY master_student.student_nim asc");
					                            	while ($row=mysqli_fetch_array($data)) {

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
															AND ks.krs_semester='$row[krs_semester]'"));

					                            		$package=mysqli_fetch_array(mysqli_query($connect, "SELECT 
					                            			* FROM master_schedule, master_krs_package
					                            			WHERE master_schedule.schedule_id=master_krs_package.schedule_id
					                            			AND master_krs_package.krs_package_id='$row[krs_package_id]'"));
					                            		
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['student_nim']; ?></td>
					                                    <td><?= $row['student_name']; ?></td>
					                                    <td><?= $package['schedule']; ?></td>
					                                    <td><?= $krs['schedule']; ?></td>
					                                    <td><?= $krs['sks']; ?></td>
					                                    <td>
					                                    	<a href="<?= $pages; ?>report_pdf.php?nim=<?= $row['student_nim']; ?>&sy=<?= $sy; ?>&sm=<?= $sm; ?>" title="Print KRS" target="_blank"><button class="btn btn-default"><i class="fa fa-print"></i></button></a>

									                       <a href="<?= $pages; ?>report_uts.php?nim=<?= $row['student_nim']; ?>&sy=<?= $sy; ?>&sm=<?= $sm; ?>" title="Print KPU UTS" target="_blank"><button class="btn btn-success"><i class="fa fa-print"></i></button></a>

									                       <a href="<?= $pages; ?>report_uas.php?nim=<?= $row['student_nim']; ?>&sy=<?= $sy; ?>&sm=<?= $sm; ?>" title="Print KPU UAS" target="_blank"><button class="btn btn-danger"><i class="fa fa-print"></i></button></a>

					                                    </td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['krs_package_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['krs_id']; ?>">
						                               		 <button class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button></a> 

						                               		<a href="<?= $page_list; ?>&nim=<?= $row['student_nim']; ?>">
						                               		 <button class="btn btn-warning" title="Approved"><i class="fa fa-list"></i></button></a> 

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
				        <h4 class="modal-title">Filter KRS Package</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="krs_package">
				      <div class="modal-body">
				      					<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	School Year <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="sy" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$start=date('Y')-2;
					                            	$end=date('Y')+1;
					                            	for ($i=$start; $i <= $end ; $i++) { 
					                            		$school_year=$i."/".($i+1);
					                            		if ($school_year==$sy) {
					                            	?>
					                            		<option value="<?= $school_year; ?>" selected><?= $school_year; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $school_year; ?>"><?= $school_year; ?></option>
					                            	 <?php } } ?>
					                            	
					                            </select>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	semester <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="sm" class="form-control" required>
					                             <?php if ($sm=="Ganjil") { ?>
					                            	<option value="Ganjil">Ganjil</option>
					                            	<option value="Genap">Genap</option>
					                            <?php }  else { ?>
					                            	<option value="Genap">Genap</option>
					                            	<option value="Ganjil">Ganjil</option>
					                            <?php } ?>
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



				<!-- Modal -->
				<div id="page_input" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Add KRS Package</h4>
				      </div>
				      <form class="form-horizontal" method="POST" action="<?= $page_input; ?>"  enctype="multipart/form-data">
				      <div class="modal-body">
				        				


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	NIM | Status | Name Student <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Search by nim / name" autocomplete="off" required/>  
          										<div id="student_nameList"></div>

					                        </div>
					                    </div>

					                    
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-forward"></i> Next</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>



				<!-- Modal -->
				<div id="uts" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Print KPU UTS</h4>
				      </div>
				      <form class="form-horizontal" method="POST" action="<?= $page_uts; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
				      <input type="hidden" name="sy" value="<?= $sy ?>">
				      <input type="hidden" name="sm" value="<?= $sm; ?>">
				      <div class="modal-body">
				        				
				      					<div class="alert alert-warning">
				      						each file has a maximum of 10 lines
				      					</div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Show data starting from the row <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="number" name="row"  class="form-control" value="0" required/>  
					                            * start of line starts at 0
					                        </div>
					                    </div>


					                    
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>


				<!-- Modal -->
				<div id="uas" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Print KPU UAS</h4>
				      </div>
				      <form class="form-horizontal" method="POST" action="<?= $page_uas; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
				      <input type="hidden" name="sy" value="<?= $sy ?>">
				      <input type="hidden" name="sm" value="<?= $sm; ?>">
				      <div class="modal-body">
				        				
				      					<div class="alert alert-warning">
				      						each file has a maximum of 10 lines
				      					</div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Show data starting from the row <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="number" name="row"  class="form-control" value="0" required/>  
					                            * start of line starts at 0
					                        </div>
					                    </div>


					                    
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>

                <?php 
                break;
                case 'input':
                $student_name			=@$_POST['student_name'];
                $student=explode("|", $student_name);
                $student_nim=$student[0];
                $krs_school_year		=$sy;
                $krs_semester			=$sm;
                $krs_package_id			="";

                $std=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_student where 
                	student_nim='$student_nim'"));


               	?>

               	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Add KRS Package</h3>
					            </div>

					            <div class="panel-body">
					            	<div class="alert alert-info">
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?> 
						        	</div>
						        	<table class="table">
						        		<tr>
						        			<td width="30%">School Year</td>
						        			<td>: <?= $krs_school_year; ?></td>
						        		</tr>
						        		<tr>
						        			<td>semester</td>
						        			<td>: <?= $krs_semester; ?></td>
						        		</tr>
						        		<tr>
						        			<td>NIM</td>
						        			<td>: <?= $std['student_nim']; ?></td>
						        		</tr>
						        		<tr>
						        			<td>Name</td>
						        			<td>: <?= $std['student_name']; ?></td>
						        		</tr>
						        	</table>
					                  
						        	<p style="color: red;"><b>Please select the desired schedule package</b></p>
						        	<!--Bordered Accordion-->
							        <!--===================================================-->
							        <div class="panel-group accordion" id="demo-acc-info-outline">

							        	<?php
					                     $no=1;
					                     $data=mysqli_query($connect, "SELECT * FROM master_schedule 
					                            		where majors_code='$majors_code'
					                            		AND schedule_generation='$std[student_generation]'");
					                     while ($row=mysqli_fetch_array($data)) {

					                     		$schedule=mysqli_fetch_array(mysqli_query($connect, "SELECT 
					                            			sum(courses_sks) as sks,
					                            			count(schedule_id) as schedule
					                            			FROM schedule_package as sp,
					                            			      master_curriculum as mc 
										                	LEFT JOIN master_courses ON master_courses.courses_code=mc.courses_code 
										                    where 
										                	sp.curriculum_id=mc.curriculum_id AND
										                	sp.schedule_id='$row[schedule_id]'"));
					                     ?>

							            <div class="panel panel-bordered panel-info">
							
							                <!--Accordion title-->
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-parent="#demo-acc-info-outline" data-toggle="collapse" href="#demo-acd-info-outline-<?= $no; ?>">
							                        	<b><?= $row['schedule']; ?></b> <span class="badge badge-purple"><?= $schedule['sks']; ?> SKS</span></a>
							                    </h4>
							                </div>
							
							                <!--Accordion content-->
							                <div class="panel-collapse collapse" id="demo-acd-info-outline-<?= $no; ?>">
							                    <div class="panel-body">
							                        
							                        <div class="table-responsive">
									                        <table class="table table-striped">
									                            <thead>
									                                <tr>
									                                    <th>Curriculum Types</th>
									                                    <th>Class</th>
									                                    <th>Courses</th>
									                                    <th>Dosen</th>
									                                    <th>Schedule</th>
									                                </tr>
									                            </thead>
									                            <tbody>
									                            	<?php
									                            	$data2=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
									                            		LEFT JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
									                            		LEFT JOIN master_class as mclass ON mclass.class_code=mc.class_code
									                            		LEFT JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
									                            		LEFT JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
									                            		LEFT JOIN schedule_package as sp ON sp.curriculum_id=mc.curriculum_id
									                            		where sp.schedule_id='$row[schedule_id]'");

									                            	while ($row2=mysqli_fetch_array($data2)) {

									                            	?>
									                                <tr>
									                                    <td><?= $row2['curriculum_types']; ?></td>
									                                    <td><?= $row2['class_room']; ?>/<?= $row2['class']; ?></td>
									                                    <td><?= $row2['courses_code']; ?> | <?= $row2['courses']; ?>
									                                    	<span class="badge badge-success"><?= $row2['courses_sks']; ?> SKS</span>
									                                    </td>
									                                    <td><?= $row2['lecturer_name']; ?></td>
									                                    <td><?= $row2['curriculum_day']; ?>, <?= substr($row2['curriculum_start'],0,5); ?> - <?= substr($row2['curriculum_end'],0,5); ?></td>
									                                   
									                                </tr>
									                            	<?php } ?>
									                            </tbody>
									                        </table>

									                        <button class="btn btn-primary" id="choose" value="<?= $row['schedule_id']; ?>" onclick="data_choose(this.value);" title="Choose">
					                                    	<i class="fa fa-save"></i> Choose
					                                    	</button>
									                </div>



							                    </div>
							                </div>
							            </div>

							            <?php $no++; } ?>
							        </div>
							        <!--===================================================-->
							        <!--End Bordered Accordion-->
							                  

					            </div>


					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					                <div class="panel-footer text-right">
					                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>					                    
					                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
               		</div>
               	</div>

                <?php	break;
                case 'edit':
                $id 		=htmlspecialchars($_GET['id']);
                $edit=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_krs
                	LEFT JOIN master_krs_package ON master_krs_package.krs_package_id=master_krs.krs_package_id
                	LEFT JOIN master_schedule ON master_schedule.schedule_id=master_krs_package.schedule_id
                	where krs_id='$id'"));

                $student_nim=$edit['student_nim'];
                $krs_school_year		=$edit['krs_school_year'];
                $krs_semester			=$edit['krs_semester'];
                $krs_package_id			=$edit['krs_package_id'];

                $std=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_student where 
                	student_nim='$student_nim'"));

               	?>

               	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit KRS Package</h3>
					            </div>

					            <div class="panel-body">
					            	<div class="alert alert-info">
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?> 
						        	</div>
						        	<table class="table">
						        		<tr>
						        			<td width="30%">School Year</td>
						        			<td>: <?= $krs_school_year; ?></td>
						        		</tr>
						        		<tr>
						        			<td>semester</td>
						        			<td>: <?= $krs_semester; ?></td>
						        		</tr>
						        		<tr>
						        			<td>NIM</td>
						        			<td>: <?= $std['student_nim']; ?></td>
						        		</tr>
						        		<tr>
						        			<td>Name</td>
						        			<td>: <?= $std['student_name']; ?></td>
						        		</tr>
						        	</table>
					                  
						        	<p style="color: red;"><b>Please schedule the desired course</b></p>
						        	<!--Bordered Accordion-->
							        <!--===================================================-->
							        <div class="panel-group accordion" id="demo-acc-info-outline">

							        	<?php
					                     $no=1;
					                     $data=mysqli_query($connect, "SELECT * FROM master_schedule 
					                            		where majors_code='$majors_code'
					                            		AND schedule_generation='$std[student_generation]'");
					                     while ($row=mysqli_fetch_array($data)) {

					                     		$schedule=mysqli_fetch_array(mysqli_query($connect, "SELECT 
					                            			sum(courses_sks) as sks,
					                            			count(schedule_id) as schedule
					                            			FROM schedule_package as sp,
					                            			      master_curriculum as mc 
										                	LEFT JOIN master_courses ON master_courses.courses_code=mc.courses_code 
										                    where 
										                	sp.curriculum_id=mc.curriculum_id AND
										                	sp.schedule_id='$row[schedule_id]'"));

					                     		if ($row['schedule_id']==$edit['schedule_id']) {
					                     			$ket='<span class="badge badge-purple"> already selected </span>';
					                     		} else {
					                     			$ket='';
					                     		}
					                     ?>

							            <div class="panel panel-bordered panel-info">
							
							                <!--Accordion title-->
							                <div class="panel-heading">
							                    <h4 class="panel-title">
							                        <a data-parent="#demo-acc-info-outline" data-toggle="collapse" href="#demo-acd-info-outline-<?= $no; ?>">
							                        	<b><?= $row['schedule']; ?></b> <span class="badge badge-purple"><?= $schedule['sks']; ?> SKS</span> <?= $ket; ?></a>
							                    </h4>
							                </div>
							
							                <!--Accordion content-->
							                <div class="panel-collapse collapse" id="demo-acd-info-outline-<?= $no; ?>">
							                    <div class="panel-body">
							                        
							                        <div class="table-responsive">
									                        <table class="table table-striped">
									                            <thead>
									                                <tr>
									                                    <th>Curriculum Types</th>
									                                    <th>Class</th>
									                                    <th>Courses</th>
									                                    <th>Dosen</th>
									                                    <th>Schedule</th>
									                                </tr>
									                            </thead>
									                            <tbody>
									                            	<?php
									                            	$data2=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
									                            		LEFT JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
									                            		LEFT JOIN master_class as mclass ON mclass.class_code=mc.class_code
									                            		LEFT JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
									                            		LEFT JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
									                            		LEFT JOIN schedule_package as sp ON sp.curriculum_id=mc.curriculum_id
									                            		where sp.schedule_id='$row[schedule_id]'");

									                            	while ($row2=mysqli_fetch_array($data2)) {

									                            	?>
									                                <tr>
									                                    <td><?= $row2['curriculum_types']; ?></td>
									                                    <td><?= $row2['class_room']; ?>/<?= $row2['class']; ?></td>
									                                    <td><?= $row2['courses_code']; ?> | <?= $row2['courses']; ?>
									                                    	<span class="badge badge-success"><?= $row2['courses_sks']; ?> SKS</span>
									                                    </td>
									                                    <td><?= $row2['lecturer_name']; ?></td>
									                                    <td><?= $row2['curriculum_day']; ?>, <?= substr($row2['curriculum_start'],0,5); ?> - <?= substr($row2['curriculum_end'],0,5); ?></td>
									                                   
									                                </tr>
									                            	<?php } ?>
									                            </tbody>
									                        </table>

									                        <?php if ($row['schedule_id']!=$edit['schedule_id']) { ?>
									                        <button class="btn btn-primary" id="choose" value="<?= $row['schedule_id']; ?>" onclick="data_choose(this.value);" title="Choose">
					                                    	<i class="fa fa-save"></i> Choose
					                                    	</button>
					                                    <?php } ?>
									                </div>



							                    </div>
							                </div>
							            </div>

							            <?php $no++; } ?>
							        </div>
							        <!--===================================================-->
							        <!--End Bordered Accordion-->
					            </div>


					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					                <div class="panel-footer text-right">
					                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
               		</div>
               	</div>


                <?php	break;
                case 'list':
                $nim 		=htmlspecialchars($_GET['nim']);
                $action="pages/dosen/krs/action.php";
                $back="page.php?p=krs_package&act=list&nim=".$nim;
                $back2="page.php?p=krs_package";

                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student as ms
					INNER JOIN master_college as mcollege ON mcollege.college_code=ms.college_code
					INNER JOIN master_majors as mmajors ON mmajors.majors_code=ms.majors_code				
                	where student_nim='$nim'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Details Kartu Rencana Studi</h3>
					            </div>
					            <div class="panel-body">
					            	<div class="row">
							            <div class="col-lg-3 table-responsive">
							                <table class="table table-bordered invoice-summary">
							                    <tbody>
							                        <tr>
							                            <td>
							                                <strong><?= $open_sy; ?> / <?= $open_sm; ?></strong>
							                                <small>School Year / Semester</small>
							                            </td>					                            
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['college']; ?></strong>
							                                <small>College</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                 <strong><?= $row['majors']; ?></strong>
							                                <small>Majors</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['student_nim']; ?></strong>
							                                <small>NIM</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['student_name']; ?></strong>
							                                <small>Name</small>
							                            </td>
							                        </tr>
							                       
							                    </tbody>
							                </table>
							            </div>


							            <div class="col-lg-9">
							            	<div class="table-responsive">
						                       <table class="table table-striped">
						                            <thead>
						                                <tr>
						                                	<th>No</th>
						                                    <th>Types</th>
										                    <th>Class</th>
										                    <th>Courses</th>
										                    <th>Dosen</th>
										                    <th>Schedule</th>
						                                    <th>Approved</th>
						                                </tr>
						                            </thead>
						                            <tbody>
						                            	<?php
						                            	$no=1;
						                            	$data=mysqli_query($connect, "SELECT * FROM master_krs as mk, 
						                            		master_curriculum as mc
										                    LEFT JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
										                    LEFT JOIN master_class as mclass ON mclass.class_code=mc.class_code
										                    LEFT JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
										                    LEFT JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
						                            		WHERE 
						                            		mk.curriculum_id=mc.curriculum_id AND
						                            		mk.krs_school_year='$open_sy' AND
						                            		mk.krs_semester='$open_sm' AND 
						                            		mk.student_nim='$nim'");
						                            	while ($row=mysqli_fetch_array($data)) {
						                            		$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
															// Genrate ID
															$genid=substr(str_shuffle($genrate_id), 0, 14);
						                            	?>

						                                <tr>
						                                	<td><?= $no; ?></td>
						                                    <td><?= $row['curriculum_types']; ?></td>
										                    <td><?= $row['class_room']; ?>/<?= $row['class']; ?></td>
										                    <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?>
										                            <span class="badge badge-success"><?= $row['courses_sks']; ?> SKS</span>
										                    </td>
										                    <td><?= $row['lecturer_name']; ?></td>
										                    <td><?= $row['curriculum_day']; ?>, <?= substr($row['curriculum_start'],0,5); ?> - <?= substr($row['curriculum_end'],0,5); ?></td>
						                                    <td class="text-center">

						                                    	<?php
						                                    	if ($row['krs_approved']=="Approved") {
																	$approved="btn-danger";
																} else {
																	$approved="";
																}

																if ($row['krs_approved']=="Not Approved") {
																	$notapproved="btn-danger";
																} else {
																	$notapproved="";
																}

																?>
						                                    	
						                                    	<div id="student<?= $genid; ?>">
										                            <button type="button" class="btn<?= $genid; ?> btn <?= $approved; ?>" title="Approved" value="<?= $row['krs_id']; ?>" onclick="data_krs(this.value,'Approved',<?= $row['student_nim']; ?>);">Y</button>

										                            <button type="button" class="btn<?= $genid; ?> btn <?= $notapproved; ?>" title="Not Approved" value="<?= $row['krs_id']; ?>" onclick="data_krs(this.value,'Not Approved',<?= $row['student_nim']; ?>);">N</button>
																</div>
				<script>
				// Add active class to the current button (highlight it)
				var header<?= $genid; ?> = document.getElementById("student<?= $genid; ?>");
				var btns<?= $genid; ?> = header<?= $genid; ?>.getElementsByClassName("btn");
				for (var i = 0; i < btns<?= $genid; ?>.length; i++) {
				  btns<?= $genid; ?>[i].addEventListener("click", function() {
				  $('.btn<?= $genid; ?>').removeClass('btn-danger');
				  this.className += " btn-danger";
				  });
				}
				</script>

						                                    </td>
						                                </tr>
						                                <?php $no++; } ?>
						                            </tbody>
						                        </table>
						                    </div>

							            </div>
							        </div>

					            </div>


					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal" method="POST" action="">					            	
					                <div class="panel-footer text-right">
					                	<a href="<?= $back2; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
               		</div>
               	</div>



               

                <?php	break;
                } ?>

            </div>







