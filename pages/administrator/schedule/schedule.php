			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Schedule Package</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Schedule Package</li>
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

                $page_input="page.php?p=schedule&act=input&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $page_edit="page.php?p=schedule&act=edit&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $back="page.php?p=schedule&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $page_print="pages/administrator/schedule/report_pdf.php";
                $action="pages/administrator/schedule/action.php";

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
					                    <h3 class="panel-title">Schedule Package Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                                <button class="btn btn-purple" data-toggle="modal" data-target="#page_input"><i class="demo-pli-add icon-fw"></i> Add</button>

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
					                                    <th>Generation</th>
					                                    <th>Package Name</th>
					                                    <th>Limit Student</th>
					                                    <th>Schedule</th>
					                                    <th>SKS</th>
					                                    <th>Selected</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_schedule 
					                            		where majors_code='$majors_code' AND
					                            		schedule_school_year='$sy' AND
					                            		schedule_semester='$sm'");
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

					                            		$student=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs_package where schedule_id='$row[schedule_id]'"));
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['schedule_generation']; ?></td>
					                                    <td><?= $row['schedule']; ?></td>
					                                    <td><?= $row['schedule_limit']; ?></td>
					                                    <td><?= $schedule['schedule']; ?></td>
					                                    <td><?= $schedule['sks']; ?></td>
					                                    <td><?= $student; ?></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['schedule_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['schedule_id']; ?>">
						                               		 <button class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button></a> 

						                               		 <a href="<?= $page_print; ?>?id=<?= $row['schedule_id']; ?>" target="_blank">
						                               		 <button class="btn btn-default" title="print"><i class="fa fa-print"></i></button></a> 
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
				        <h4 class="modal-title">Filter Schedule Package</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="schedule">
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
				        <h4 class="modal-title">Add Schedule Package</h4>
				      </div>
				      <form class="form-horizontal" method="POST" action="<?= $page_input; ?>"  enctype="multipart/form-data">
				      <div class="modal-body">		

				      					<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Generation <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="schedule_generation" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$start=date('Y')-8;
					                            	$end=date('Y')+1;
					                            	for ($i=$start; $i <= $end ; $i++) { 
					                            		$generation=$i."/".($i+1);
					                            		if ($generation==$sy) {
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
					                        	Package Name <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="schedule" placeholder="Package Name" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Limit Student <span class="required">*</span></label>
					                        <div class="col-sm-2">
					                            <input type="number" name="schedule_limit" value="0" class="form-control" required>
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

                <?php 
                break;
                case 'input':
                $schedule_school_year		=$sy;
                $schedule_semester			=$sm;
                $schedule					=htmlspecialchars(@$_POST['schedule']);
                $schedule_limit				=htmlspecialchars(@$_POST['schedule_limit']);
                $schedule_generation		=htmlspecialchars(@$_POST['schedule_generation']);
                $schedule_id				="";

                $tot_sks=mysqli_fetch_array(mysqli_query($connect, "SELECT sum(courses_sks) as sks FROM schedule_package as sp, master_curriculum as mc 
                	LEFT JOIN master_courses ON master_courses.courses_code=mc.courses_code 
                    where 
                	sp.curriculum_id=mc.curriculum_id AND
                	sp.schedule_id=''"));

               	?>

               	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Add Schedule Package</h3>
					            </div>


					            <div class="panel-body">
					            	<div class="alert alert-info">
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						        	</div>
						        	<table class="table">
						        		<tr>
						        			<td width="30%">School Year</td>
						        			<td>: <?= $schedule_school_year; ?></td>
						        		</tr>
						        		<tr>
						        			<td>semester</td>
						        			<td>: <?= $schedule_semester; ?></td>
						        		</tr>
						        		<tr>
						        			<td>Generation</td>
						        			<td>: <?= $schedule_generation; ?></td>
						        		</tr>
						        		<tr>
						        			<td>Package Name</td>
						        			<td>: <?= $schedule; ?></td>
						        		</tr>
						        		<tr>
						        			<td>Limit Student</td>
						        			<td>: <?= $schedule_limit; ?></td>
						        		</tr>
						        	</table>
					                  
						        	<p style="color: red;"><b>Please schedule the desired course</b></p>
						        	<div id="sks" class="badge badge-success"><?= $tot_sks['sks']; ?> SKS</div>
					                  

						        	<div class="table-responsive">
						        		<div id="curriculum"> 
					                        <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                    <th></th>
					                                    <th>Curriculum Types</th>
					                                    <th>Class</th>
					                                    <th>Courses</th>
					                                    <th>Dosen</th>
					                                    <th>Schedule</th>
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
					                            		mc.curriculum_school_year='$schedule_school_year' AND
					                            		mc.curriculum_semester='$schedule_semester'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            		$check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM schedule_package where curriculum_id='$row[curriculum_id]' AND schedule_id=''"));
					                            		if ($check>0) {
					                            			$checked="checked='checked'";
					                            		} else {
					                            			$checked="";
					                            		}
					                            	?>
					                                <tr>
					                                    <td>
					                                    	<div class="switch">
															    <input id="switch-<?= $no; ?>" type="checkbox" class="switch-input" value="<?= $row['curriculum_id']; ?>"  
                          										data-exval="<?= $row['courses_sks']; ?>" <?= $checked; ?>/>
															    <label for="switch-<?= $no; ?>" class="switch-label">Choice</label>
															 </div>

															 

														</td>
					                                    <td><?= $row['curriculum_types']; ?></td>
					                                    <td><?= $row['class_room']; ?>/<?= $row['class']; ?></td>
					                                    <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?>
					                                    	<span class="badge badge-success"><?= $row['courses_sks']; ?> SKS</span>
					                                    </td>
					                                    <td><?= $row['lecturer_name']; ?></td>
					                                    <td><?= $row['curriculum_day']; ?>, <?= substr($row['curriculum_start'],0,5); ?> - <?= substr($row['curriculum_end'],0,5); ?></td>
					                                   
					                                </tr>
					                            	<?php $no++; } ?>
					                            </tbody>
					                        </table>
					                      </div>
					                </div>
					                <!--===================================================-->
					                <!--End Data Table-->
					            </div>


					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					            	<input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
					            	<input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
					            	<input type="hidden" name="schedule_school_year" value="<?= $schedule_school_year; ?>">
					            	<input type="hidden" name="schedule_semester" value="<?= $schedule_semester; ?>">
					            	<input type="hidden" name="schedule_generation" value="<?= $schedule_generation; ?>">
					            	<input type="hidden" name="schedule" value="<?= $schedule; ?>">
					            	<input type="hidden" name="schedule_limit" value="<?= $schedule_limit; ?>">
					                <div class="panel-footer text-right">
					                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
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
                $edit=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_schedule 
                	where schedule_id='$id'"));

                $schedule_school_year		=$edit['schedule_school_year'];
                $schedule_semester			=$edit['schedule_semester'];
                $schedule_generation		=$edit['schedule_generation'];
                $schedule					=$edit['schedule'];
                $schedule_limit				=$edit['schedule_limit'];
                $schedule_id				=$edit['schedule_id'];

                $tot_sks=mysqli_fetch_array(mysqli_query($connect, "SELECT sum(courses_sks) as sks FROM schedule_package as sp, master_curriculum as mc 
                	LEFT JOIN master_courses ON master_courses.courses_code=mc.courses_code 
                    where 
                	sp.curriculum_id=mc.curriculum_id AND
                	sp.schedule_id='$schedule_id'"));

               	?>

               	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Schedule Package</h3>
					            </div>

					            <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
					            	<input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
					            	<input type="hidden" name="schedule_school_year" value="<?= $schedule_school_year; ?>">
					            	<input type="hidden" name="schedule_semester" value="<?= $schedule_semester; ?>">
					            	<input type="hidden" name="id" value="<?= $id; ?>">

					            <div class="panel-body">
					            	<div class="alert alert-info">
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						        	</div>
						        	<table class="table">
						        		<tr>
						        			<td width="30%">School Year</td>
						        			<td>: <?= $schedule_school_year; ?></td>
						        		</tr>
						        		<tr>
						        			<td>semester</td>
						        			<td>: <?= $schedule_semester; ?></td>
						        		</tr>
						        		<tr>
						        			<td>Generation</td>
						        			<td>
					                            <select name="schedule_generation" class="form-control" required>
					                            	<?php
					                            	$start=date('Y')-8;
					                            	$end=date('Y')+1;
					                            	for ($i=$start; $i <= $end ; $i++) { 
					                            		$generation=$i."/".($i+1);
					                            		if ($generation==$schedule_generation) {
					                            	?>
					                            		<option value="<?= $generation; ?>" selected><?= $generation; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $generation; ?>"><?= $generation; ?></option>
					                            	 <?php } } ?>
					                            	
					                            </select>
					                        </td>
						        		</tr>
						        		<tr>
						        			<td>Package Name</td>
						        			<td><input type="text" name="schedule" value="<?= $schedule; ?>" placeholder="Package Name" class="form-control" required></td>
						        		</tr>
						        		<tr>
						        			<td>Limit Student</td>
						        			<td><input style="width: 20%;" type="number" name="schedule_limit" value="<?= $schedule_limit; ?>" class="form-control" required></td>
						        		</tr>
						        	</table>
					                  
						        	<p style="color: red;"><b>Please schedule the desired course</b></p>
						        	<div id="sks" class="badge badge-success"><?= $tot_sks['sks']; ?> SKS</div>
					                  

						        	<div class="table-responsive">
						        		<div id="curriculum"> 
					                        <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                    <th></th>
					                                    <th>Curriculum Types</th>
					                                    <th>Class</th>
					                                    <th>Courses</th>
					                                    <th>Dosen</th>
					                                    <th>Schedule</th>
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
					                            		mc.curriculum_school_year='$schedule_school_year' AND
					                            		mc.curriculum_semester='$schedule_semester'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            		$check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM schedule_package where curriculum_id='$row[curriculum_id]' AND schedule_id='$schedule_id'"));
					                            		if ($check>0) {
					                            			$checked="checked='checked'";
					                            		} else {
					                            			$checked="";
					                            		}
					                            	?>
					                                <tr>
					                                    <td>
					                                    	<div class="switch">
															    <input id="switch-<?= $no; ?>" type="checkbox" class="switch-input" value="<?= $row['curriculum_id']; ?>"  
                          										data-exval="<?= $row['courses_sks']; ?>" <?= $checked; ?>/>
															    <label for="switch-<?= $no; ?>" class="switch-label">Choice</label>
															 </div>

															 

														</td>
					                                    <td><?= $row['curriculum_types']; ?></td>
					                                    <td><?= $row['class_room']; ?>/<?= $row['class']; ?></td>
					                                    <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?>
					                                    	<span class="badge badge-success"><?= $row['courses_sks']; ?> SKS</span>
					                                    </td>
					                                    <td><?= $row['lecturer_name']; ?></td>
					                                    <td><?= $row['curriculum_day']; ?>, <?= substr($row['curriculum_start'],0,5); ?> - <?= substr($row['curriculum_end'],0,5); ?></td>
					                                   
					                                </tr>
					                            	<?php $no++; } ?>
					                            </tbody>
					                        </table>
					                      </div>
					                </div>
					                <!--===================================================-->
					                <!--End Data Table-->
					            </div>


					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            
					                <div class="panel-footer text-right">
					                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
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






