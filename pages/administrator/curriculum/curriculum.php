			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Curriculum & Schedule</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Curriculum & Schedule</li>
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

                $page_input="page.php?p=curriculum&act=input&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $page_edit="page.php?p=curriculum&act=edit&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $back="page.php?p=curriculum&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $action="pages/administrator/curriculum/action.php";
                $pages="pages/administrator/curriculum/";

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
					                    <h3 class="panel-title">Curriculum & Schedule Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                            	<a href="<?= $page_input; ?>">
					                                <button class="btn btn-purple"><i class="demo-pli-add icon-fw"></i> Add</button></a> 

					                                 <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>

					                                 <div class="btn-group">
							                            <div class="dropdown">
							                                <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
							                                    Print <i class="dropdown-caret"></i>
							                                </button>
							                                <ul class="dropdown-menu dropdown-menu-right">
							                                    <li><a href="<?= $pages; ?>report_pdf_majors_uts.php?code=<?= $code['majors_code']; ?>&sy=<?= $sy; ?>&sm=<?= $sm; ?>" target="_blank">Schedule UTS</a></li>

							                                    <li><a href="<?= $pages; ?>report_pdf_majors_uas.php?code=<?= $code['majors_code']; ?>&sy=<?= $sy; ?>&sm=<?= $sm; ?>" target="_blank">Schedule UAS</a></li>

							                                    <li><a href="<?= $pages; ?>report_excel_lecturer.php?code=<?= $code['majors_code']; ?>&sy=<?= $sy; ?>&sm=<?= $sm; ?>" target="_blank">Attendance Lecturer</a></li>
							                                    
							                                </ul>
							                            </div>
							                        </div>
              
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
					                                    <th>Room / Class / Capacity</th>
					                                    <th>Code | Courses</th>
					                                    <th>Student</th>
					                                    <th>Dosen | Schedule</th>
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
					                            		$student=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs where curriculum_id='$row[curriculum_id]'"));
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['curriculum_types']; ?></td>
					                                    <td><?= $row['curriculum_status']; ?></td>
					                                    <td><?= $row['class_room']; ?> / <?= $row['class']; ?> / <?= $row['class_capacity']; ?></td>
					                                    <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?>
					                                    	<span class="badge badge-success"><?= $row['courses_sks']; ?> SKS</span>
					                                    </td>
					                                    <td><?= $student; ?></td>
					                                    <td><?= $row['lecturer_name']; ?> <br>
					                                    	<?= $row['curriculum_day']; ?>, <?= $row['curriculum_start']; ?> - <?= $row['curriculum_end']; ?></td>
					                                    <td>
						                               		 <div class="btn-group dropdown">
									                            <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
									                            <ul class="dropdown-menu dropdown-menu-right" style="">
									                                <li><a href="<?= $page_edit; ?>&id=<?= $row['curriculum_id']; ?>"><i class="icon-lg icon-fw demo-psi-pen-5"></i> Edit</a></li>

									                                <li><a href="#" onclick="data_remove('<?= $row['curriculum_id']; ?>');"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a></li>

									                                <li class="divider"></li>
									                                <li><a href="<?= $pages; ?>report_pdf_attendance.php?id=<?= $row['curriculum_id']; ?>" target="_blank"><i class="icon-lg icon-fw demo-pli-printer"></i> Attendance</a></li>

									                                <li><a href="<?= $pages; ?>report_pdf_attendance_uts.php?id=<?= $row['curriculum_id']; ?>" target="_blank"><i class="icon-lg icon-fw demo-pli-printer"></i> UTS</a></li>

									                                <li><a href="<?= $pages; ?>report_pdf_attendance_uas.php?id=<?= $row['curriculum_id']; ?>" target="_blank"><i class="icon-lg icon-fw demo-pli-printer"></i> UAS</a></li>

									                                <li class="divider"></li>
									                                <li><a href="<?= $pages; ?>report_pdf_bap.php?id=<?= $row['curriculum_id']; ?>" target="_blank"><i class="icon-lg icon-fw demo-pli-printer"></i> BAP</a></li>

									                                <li><a href="<?= $pages; ?>report_pdf_baputs.php?id=<?= $row['curriculum_id']; ?>" target="_blank"><i class="icon-lg icon-fw demo-pli-printer"></i> BAP UTS</a></li>

									                                <li><a href="<?= $pages; ?>report_pdf_bapuas.php?id=<?= $row['curriculum_id']; ?>" target="_blank"><i class="icon-lg icon-fw demo-pli-printer"></i> BAP UAS</a></li>


									                            </ul>
									                        </div>

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
				      <input type="hidden" name="p" value="curriculum">
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
                case 'input':
               	?>

               	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Add Curriculum & Schedule</h3>
					            </div>


					            <div class="panel-body">
					            	<div class="alert alert-info">
					            			School Year : <?= $sy; ?> <br>
					                    	Semester : <?= $sm; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						        	</div>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					            	<input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
					            	<input type="hidden" name="curriculum_school_year" value="<?= $sy; ?>">
					            	<input type="hidden" name="curriculum_semester" value="<?= $sm; ?>">
					                <div class="panel-body">


					                	<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Majors <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select id="demo-cs-multiselect" name="majors_code[]" data-placeholder="Choose a majors" multiple required>
					                            	<?php
					                            	$data=mysqli_query($connect,"SELECT * FROM master_majors 
					                            		where college_code='$code[college_code]' order by majors asc");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	if ($row['majors_code']==$code['majors_code']){
					                            	?>
					                            		<option value="<?= $row['majors_code']; ?>" selected><?= $row['majors']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $row['majors_code']; ?>"><?= $row['majors']; ?></option>

					                            <?php }} ?>
					                            </select>
					                        </div>
					                    </div>


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Status <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="curriculum_status" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<option value="Active">Active</option>
					                            	<option value="Not Active">Not Active</option>
					                            </select>
					                        </div>
					                    </div>



					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Courses <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="courses_code" id="courses_code" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_courses");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            	?>
					                            		<option value="<?= $opt['courses_code']; ?>"><?= $opt['courses']; ?></option>
					                            	<?php } ?>
					                            </select>
					                        </div>
					                    </div>


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Lecturer <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="lecturer_code" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_lecturer");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            	?>
					                            		<option value="<?= $opt['lecturer_code']; ?>"><?= $opt['lecturer_name']; ?></option>
					                            	<?php } ?>
					                            </select>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Curriculum Types <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="curriculum_types_id" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_curriculum_types");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            	?>
					                            		<option value="<?= $opt['curriculum_types_id']; ?>"><?= $opt['curriculum_types']; ?></option>
					                            	<?php } ?>
					                            </select>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Class <span class="required">*</span></label>
					                        <div class="col-sm-3">
					                            <select name="class_code" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_class");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            	?>
					                            		<option value="<?= $opt['class_code']; ?>"><?= $opt['class_room']; ?>/<?= $opt['class']; ?></option>
					                            	<?php } ?>
					                            </select>
					                        </div>
					                    </div>



					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Day, Start , End <span class="required">*</span></label>
					                        <div class="col-sm-4">
					                            <select name="curriculum_day" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_day");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            	?>
					                            		<option value="<?= $opt['day']; ?>"><?= $opt['day']; ?></option>
					                            	<?php } ?>
					                            </select>
					                        </div>
					                        <div class="col-sm-2">
					                            <input type="text" name="curriculum_start" placeholder="hh:ii" class="form-control" required>
					                        </div>
					                        <div class="col-sm-2">
					                            <input type="text" name="curriculum_end" placeholder="hh:ii" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Face to Face <span class="required">*</span></label>
					                        <div class="col-sm-2">
					                            <input type="number" name="curriculum_face" value="0" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="tab-base">
										
										            <!--Nav Tabs-->
										            <ul class="nav nav-tabs">
										                <li class="active">
										                    <a data-toggle="tab" href="#demo-lft-tab-1">UTS schedule</a>
										                </li>
										                <li>
										                    <a data-toggle="tab" href="#demo-lft-tab-2">UAS schedule</a>
										                </li>
										            </ul>
										
										            <!--Tabs Content-->
										            <div class="tab-content">
										                <div id="demo-lft-tab-1" class="tab-pane fade active in">
										                    <p class="text-main text-semibold">UTS Schedule</p>

										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        	Class UTS</label>
										                        <div class="col-sm-3">
										                            <select name="uts_class_code" class="form-control">
										                            	<option value=""> -- Select --</option>
										                            	<?php
										                            	$data = mysqli_query($connect,"SELECT * FROM master_class");
										                            	while ($opt=mysqli_fetch_array($data)) {
										                            	?>
										                            		<option value="<?= $opt['class_code']; ?>"><?= $opt['class_room']; ?>/<?= $opt['class']; ?></option>
										                            	<?php } ?>
										                            </select>
										                        </div>
										                    </div>



										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        Date, Start , End UTS</label>
										                        <div class="col-sm-4">
										                            <div id="demo-dp-txtinput">
										                                <input type="text" name="uts_date" autocomplete="off" class="form-control">
										                            </div>
										                        </div>
										                        <div class="col-sm-2">
										                            <input type="text" name="uts_start" placeholder="hh:ii" class="form-control" >
										                        </div>
										                        <div class="col-sm-2">
										                            <input type="text" name="uts_end" placeholder="hh:ii" class="form-control" >
										                        </div>
										                    </div>

										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        Minimal Face to Face UTS</label>
										                        <div class="col-sm-2">
										                            <input type="number" name="uts_face" value="0" class="form-control" >
										                        </div>
										                    </div>


										                </div>
										                <div id="demo-lft-tab-2" class="tab-pane fade">
										                    <p class="text-main text-semibold">UAS Schedule</p>
										                    
										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        	Class UAS</label>
										                        <div class="col-sm-3">
										                            <select name="uas_class_code" class="form-control">
										                            	<option value=""> -- Select --</option>
										                            	<?php
										                            	$data = mysqli_query($connect,"SELECT * FROM master_class");
										                            	while ($opt=mysqli_fetch_array($data)) {
										                            	?>
										                            		<option value="<?= $opt['class_code']; ?>"><?= $opt['class_room']; ?>/<?= $opt['class']; ?></option>
										                            	<?php } ?>
										                            </select>
										                        </div>
										                    </div>



										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        Date, Start , End UAS</label>
										                        <div class="col-sm-4">
										                            <div id="demo-dp-txtinput">
										                                <input type="text" name="uas_date" autocomplete="off" class="form-control">
										                            </div>
										                        </div>
										                        <div class="col-sm-2">
										                            <input type="text" name="uas_start" placeholder="hh:ii" class="form-control" >
										                        </div>
										                        <div class="col-sm-2">
										                            <input type="text" name="uas_end" placeholder="hh:ii" class="form-control" >
										                        </div>
										                    </div>

										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        Minimal Face to Face UAS</label>
										                        <div class="col-sm-2">
										                            <input type="number" name="uas_face" value="0" class="form-control" >
										                        </div>
										                    </div>


										                </div>
										            </div>
										        </div>
					                   
					                 


					                </div>
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
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum 
                	LEFT JOIN master_curriculum_uts as mcuts ON mcuts.curriculum_id=master_curriculum.curriculum_id
                	LEFT JOIN master_curriculum_uas as mcuas ON mcuas.curriculum_id=master_curriculum.curriculum_id 
                	where master_curriculum.curriculum_id='$id'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Curriculum & Schedule  </h3>
					            </div>

					            <div class="panel-body">
					            	<div class="alert alert-info">
					            			School Year : <?= $sy; ?> <br>
					                    	Semester : <?= $sm; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						        	</div>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<input type="hidden" name="id" value="<?= $id; ?>">
					            	<input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
					            	<input type="hidden" name="curriculum_school_year" value="<?= $sy; ?>">
					            	<input type="hidden" name="curriculum_semester" value="<?= $sm; ?>">
					                <div class="panel-body">

					                	<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Majors <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select id="demo-cs-multiselect" name="majors_code[]" data-placeholder="Choose a majors" multiple required disabled>
					                            	<?php
					                            	$data=mysqli_query($connect,"SELECT * FROM master_majors 
					                            		where college_code='$code[college_code]' order by majors asc");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            	$cek=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum
					                            		where curriculum_id='$id' AND majors_code='$opt[majors_code]'"));

					                            	if (!empty($cek['majors_code'])){
					                            	?>
					                            		<option value="<?= $opt['majors_code']; ?>" selected><?= $opt['majors']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['majors_code']; ?>"><?= $opt['majors']; ?></option>

					                            <?php }} ?>
					                            </select>
					                        </div>
					                    </div>


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Status <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="curriculum_status" class="form-control" required>
					                            	<?php if ($row['curriculum_status']=="Active") { ?>
						                            	<option value="Active">Active</option>
						                            	<option value="Not Active">Not Active</option>
					                            	<?php } else { ?>
					                            		<option value="Not Active">Not Active</option>
					                            		<option value="Active">Active</option>
					                            	<?php } ?>
					                            </select>
					                        </div>
					                    </div>



					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Courses<span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="courses_code" id="courses_code" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_courses");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($opt['courses_code']==$row['courses_code']) {
					                            	?>
					                            		<option value="<?= $opt['courses_code']; ?>" selected><?= $opt['courses']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['courses_code']; ?>"><?= $opt['courses']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Lecturer <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="lecturer_code" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_lecturer");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($opt['lecturer_code']==$row['lecturer_code']) {
					                            	?>
					                            		<option value="<?= $opt['lecturer_code']; ?>" selected><?= $opt['lecturer_name']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['lecturer_code']; ?>"><?= $opt['lecturer_name']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Curriculum Types <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="curriculum_types_id" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_curriculum_types");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($opt['curriculum_types_id']==$row['curriculum_types_id']) {
					                            	?>
					                            		<option value="<?= $opt['curriculum_types_id']; ?>" selected><?= $opt['curriculum_types']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['curriculum_types_id']; ?>"><?= $opt['curriculum_types']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Class <span class="required">*</span></label>
					                        <div class="col-sm-3">
					                            <select name="class_code" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_class");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($opt['class_code']==$row['class_code']) {
					                            	?>
					                            		<option value="<?= $opt['class_code']; ?>" selected><?= $opt['class_room']; ?>/<?= $opt['class']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['class_code']; ?>"><?= $opt['class_room']; ?>/<?= $opt['class']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>



					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Day, Start , End <span class="required">*</span></label>
					                        <div class="col-sm-4">
					                            <select name="curriculum_day" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_day");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($opt['day']==$row['curriculum_day']) {
					                            	?>
					                            		<option value="<?= $opt['day']; ?>" selected><?= $opt['day']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['day']; ?>"><?= $opt['day']; ?>/<?= $opt['day']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                        <div class="col-sm-2">
					                            <input type="text" name="curriculum_start" value="<?= $row['curriculum_start']; ?>" placeholder="hh:ii" class="form-control" required>
					                        </div>
					                        <div class="col-sm-2">
					                            <input type="text" name="curriculum_end" value="<?= $row['curriculum_end']; ?>" placeholder="hh:ii" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Face to Face <span class="required">*</span></label>
					                        <div class="col-sm-2">
					                            <input type="number" name="curriculum_face" value="<?= $row['curriculum_face']; ?>" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="tab-base">
										
										            <!--Nav Tabs-->
										            <ul class="nav nav-tabs">
										                <li class="active">
										                    <a data-toggle="tab" href="#demo-lft-tab-1">UTS schedule</a>
										                </li>
										                <li>
										                    <a data-toggle="tab" href="#demo-lft-tab-2">UAS schedule</a>
										                </li>
										            </ul>
										
										            <!--Tabs Content-->
										            <div class="tab-content">
										                <div id="demo-lft-tab-1" class="tab-pane fade active in">
										                    <p class="text-main text-semibold">UTS Schedule</p>

										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        	Class UTS</label>
										                        <div class="col-sm-3">
										                            <select name="uts_class_code" class="form-control">
										                            	<?php
										                            	$data = mysqli_query($connect,"SELECT * FROM master_class");
										                            	while ($opt=mysqli_fetch_array($data)) {
										                            		if ($opt['class_code']==$row['uts_class_code']) {
											                            	?>
											                            		<option value="<?= $opt['class_code']; ?>" selected><?= $opt['class_room']; ?>/<?= $opt['class']; ?></option>
											                            	<?php } else { ?>
											                            		<option value="<?= $opt['class_code']; ?>"><?= $opt['class_room']; ?>/<?= $opt['class']; ?></option>
											                            	<?php }} ?>
										                            </select>
										                        </div>
										                    </div>



										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        Date, Start , End UTS</label>
										                        <div class="col-sm-4">
										                            <div id="demo-dp-txtinput">
										                                <input type="text" name="uts_date" value="<?= $row['uts_date']; ?>" autocomplete="off" class="form-control">
										                            </div>
										                        </div>
										                        <div class="col-sm-2">
										                            <input type="text" name="uts_start" value="<?= $row['uts_start']; ?>" placeholder="hh:ii" class="form-control" >
										                        </div>
										                        <div class="col-sm-2">
										                            <input type="text" name="uts_end" value="<?= $row['uts_end']; ?>" placeholder="hh:ii" class="form-control" >
										                        </div>
										                    </div>

										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        Minimal Face to Face UTS</label>
										                        <div class="col-sm-2">
										                            <input type="number" name="uts_face" value="<?= $row['uts_face']; ?>" class="form-control" >
										                        </div>
										                    </div>


										                </div>
										                <div id="demo-lft-tab-2" class="tab-pane fade">
										                    <p class="text-main text-semibold">UAS Schedule</p>
										                    
										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        	Class UAS</label>
										                        <div class="col-sm-3">
										                            <select name="uas_class_code" class="form-control">
										                            	<?php
										                            	$data = mysqli_query($connect,"SELECT * FROM master_class");
										                            	while ($opt=mysqli_fetch_array($data)) {
										                            		if ($opt['class_code']==$row['uas_class_code']) {
											                            	?>
											                            		<option value="<?= $opt['class_code']; ?>" selected><?= $opt['class_room']; ?>/<?= $opt['class']; ?></option>
											                            	<?php } else { ?>
											                            		<option value="<?= $opt['class_code']; ?>"><?= $opt['class_room']; ?>/<?= $opt['class']; ?></option>
											                            	<?php }} ?>
										                            </select>
										                        </div>
										                    </div>



										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        Date, Start , End UAS</label>
										                        <div class="col-sm-4">
										                            <div id="demo-dp-txtinput">
										                                <input type="text" name="uas_date" value="<?= $row['uas_date']; ?>" autocomplete="off" class="form-control">
										                            </div>
										                        </div>
										                        <div class="col-sm-2">
										                            <input type="text" name="uas_start" value="<?= $row['uas_start']; ?>" placeholder="hh:ii" class="form-control" >
										                        </div>
										                        <div class="col-sm-2">
										                            <input type="text" name="uas_end" value="<?= $row['uas_end']; ?>" placeholder="hh:ii" class="form-control" >
										                        </div>
										                    </div>

										                    <div class="form-group">
										                        <label class="col-sm-3 control-label" >
										                        Minimal Face to Face UAS</label>
										                        <div class="col-sm-2">
										                            <input type="number" name="uas_face" value="<?= $row['uas_face']; ?>" class="form-control" >
										                        </div>
										                    </div>


										                </div>
										            </div>
										        </div>


					                </div>
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



