			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Attendance</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Attendance</li>
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

                $page_list="page.php?p=attendance&act=list&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $page_print="pages/administrator/attendance/report_pdf.php";               
                $action="pages/administrator/attendance/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Attendance Data</h3>
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

					                    <div class="alert alert-info">
					                    	School Year : <?= $sy; ?> <br>
					                    	Semester : <?= $sm; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>

					                    <div class="table-responsive">
					                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Types</th>
					                                    <th>Status</th>
					                                    <th>Class</th>
					                                    <th>Courses</th>
					                                    <th>Dosen</th>
					                                    <th>Schedule</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
					                            		INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					                            		INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					                            		INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					                            		INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					                            		where mc.majors_code='$majors_code' AND 
					                            		mc.curriculum_school_year='$sy' AND
					                            		mc.curriculum_semester='$sm'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['curriculum_types']; ?></td>
					                                    <td><?= $row['curriculum_status']; ?></td>
					                                    <td><?= $row['class_room']; ?>/<?= $row['class']; ?></td>
					                                    <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?>
					                                    	<span class="badge badge-success"><?= $row['courses_sks']; ?> SKS</span>
					                                    </td>
					                                    <td><?= $row['lecturer_name']; ?></td>
					                                    <td><?= $row['curriculum_day']; ?>, <?= $row['curriculum_start']; ?> - <?= $row['curriculum_end']; ?></td>
					                                    <td>
					                                    	

						                               		 <a href="<?= $page_list; ?>&id=<?= $row['curriculum_id']; ?>">
						                               		 <button class="btn btn-warning" title="Edit"><i class="fa fa-list"></i></button></a> 
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
				        <h4 class="modal-title">Filter Curriculum</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="attendance">
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

                <?php 
                break;
                case 'list':
                $id 		=htmlspecialchars($_GET['id']);
                $back="page.php?p=attendance&act=list&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm."&id=".$id;
                $back2="page.php?p=attendance&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;

                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
					INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
                	where curriculum_id='$id'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Details Attendance</h3>
					            </div>
					            <div class="panel-body">


					            	<div class="row">
							            <div class="col-lg-3 table-responsive">
							                <table class="table table-bordered invoice-summary">
							                    <tbody>
							                        <tr>
							                            <td>
							                                <strong><?= $sy; ?> / <?= $sm; ?></strong>
							                                <small>School Year / Semester</small>
							                            </td>					                            
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $code['college']; ?></strong>
							                                <small>College</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong>
							                                	<?php 
							                                $data=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
							                                	LEFT JOIN master_majors as mj ON mj.majors_code=mc.majors_code
							                                	WHERE mc.curriculum_id='$id'");
							                                while ($row2=mysqli_fetch_array($data)) {
							                                echo $row2['majors'].", ";
							                                	
							                                } ?>
							                                </strong>
							                                <small>Majors</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['courses_code']; ?> | <?= $row['courses']; ?></strong>
							                                <small>Courses</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['lecturer_name']; ?></strong>
							                                <small>Lecturer</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['curriculum_types']; ?></strong>
							                                <small>Curriculum Types</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['class_room']; ?> / <?= $row['class']; ?></strong>
							                                <small>Class </small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['curriculum_day']; ?>, <?= $row['curriculum_start']; ?>, <?= $row['curriculum_end']; ?> / <?= $row['curriculum_face']; ?></strong>
							                                <small>Day, Start, End / Face to Face</small>
							                            </td>
							                        </tr>
							                    </tbody>
							                </table>
							            </div>


							            <div class="col-lg-9">
							            	<!--Stacked Tabs Left-->
										        <!--===================================================-->
										        <div class="tab-base tab-stacked-left">
										
										            <!--Nav tabs-->
										            <ul class="nav nav-tabs">
										            	<?php
										            	$no=1;
										            	$data=mysqli_query($connect, "SELECT * FROM master_attendance 
										            		where curriculum_id='$id' order by attendance_date desc");
										            	while ($row=mysqli_fetch_array($data)) {
										            	?>

										                <li>
										                    <a data-toggle="tab" href="#demo-stk-lft-tab-<?= $no; ?>"><?= $row['attendance_date']; ?></a>
										                </li>
										                
										                <?php $no++; } ?>
										            </ul>
										
										            <!--Tabs Content-->
										            <div class="tab-content">
										            	<?php
										            	$no=1;
										            	$data=mysqli_query($connect, "SELECT * FROM master_attendance 
										            		where curriculum_id='$id'
										            		order by attendance_date desc");
														while ($row=mysqli_fetch_array($data)) {
										            	?>
										                <div id="demo-stk-lft-tab-<?= $no; ?>" class="tab-pane fade">
										                    <p class="text-main text-semibold">List Student | <?= $row['attendance_date']; ?></p>
										                    <p>Please select the type of attendance you don't want.</p>
										                    <p><b>A : Alfa | H : Present | I : Permission | S : Sick </b></p>

										                    <div class="table-responsive">
										                    	
										                        <table class="table table-striped">
										                            <thead>
										                                <tr>
										                                    <th>No</th>
										                                    <th>NIM</th>
										                                    <th>Name</th>
										                                    <th>Attendance Type</th>
										                                </tr>
										                            </thead>
										                            <tbody>
										                            	<?php
										                            	$no2=1;
										                            	$data2=mysqli_query($connect, "SELECT * FROM master_krs 
										                            		LEFT JOIN master_student ON master_student.student_nim=master_krs.student_nim
										                            		 where curriculum_id='$id'");
										                            	while ($row2=mysqli_fetch_array($data2)) {
										                            	$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
																		// Genrate ID
																		$genid=substr(str_shuffle($genrate_id), 0, 14);

																		$cek=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_attendance_list 
																			WHERE attendance_id='$row[attendance_id]'
																			AND student_nim='$row2[student_nim]'"));

																		if ($cek['attendance_type']=="A") {
																			$alfa="btn-danger";
																		} else {
																			$alfa="";
																		}

																		if ($cek['attendance_type']=="H") {
																			$hadir="btn-danger";
																		} else {
																			$hadir="";
																		}

																		if ($cek['attendance_type']=="I") {
																			$ijin="btn-danger";
																		} else {
																			$ijin="";
																		}

																		if ($cek['attendance_type']=="S") {
																			$sakit="btn-danger";
																		} else {
																			$sakit="";
																		}

										                            	?>
										                            	
										                                <tr>
										                                    <td><?= $no2; ?></td>
										                                    <td><?= $row2['student_nim']; ?></td>
										                                    <td><?= $row2['student_name']; ?></td>
										                                    <td>
										                                    	<button type="button" class="btn<?= $genid; ?> btn <?= $alfa; ?>" title="Alfa">A</button>

										                                    	<button type="button" class="btn<?= $genid; ?> btn <?= $hadir; ?>" title="Present">H</button>

										                                    	<button type="button" class="btn<?= $genid; ?> btn <?= $ijin; ?>" title="Permission">I</button>

										                                    	<button type="button" class="btn<?= $genid; ?> btn <?= $sakit; ?>" title="Sick">S</button>
			
										                                    </td>
										                                </tr>
										                           		

										                            	<?php $no2++;} ?>
										                            	
										                            </tbody>
										                        </table>
										                    </div>

										                    <a href="<?= $page_print; ?>?date=<?= $row['attendance_date']; ?>&id=<?= $id; ?>" target="_blank">
										                    	<button class="btn btn-danger" type="button"><i class="fa fa-print"> </i> Export PDF</button>
										                    </a>

										                </div>
										                <?php $no++; } ?>
										            </div>
										        </div>
										        <!--===================================================-->
										        <!--End Stacked Tabs Left-->
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



               	<!-- Modal -->
				<div id="page_input" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Add Attendance</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      <input type="hidden" name="curriculum_id" value="<?= $id; ?>">
				      <input type="hidden" name="action" value="input">
				      <div class="modal-body">				        				

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Date <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <div id="demo-dp-txtinput">
					                                <input type="text" name="attendance_date" autocomplete="off" class="form-control">
					                            </div>					                           
					                        </div>
					                    </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>
			

                <?php	break;
                } ?>

            </div>



