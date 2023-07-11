			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">KRS</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">KRS</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                if (empty(@$_GET['sy'])) {

                	$sy=$open_sy;
                	$sm=$open_sm;
                } else {
                	$sy 			=htmlspecialchars(@$_GET['sy']);
                	$sm 		=htmlspecialchars(@$_GET['sm']);                	
                }


                $page_input="page.php?p=krs&act=input&sy=".$sy."&sm=".$sm;
                $page_edit="page.php?p=krs&act=edit&sy=".$sy."&sm=".$sm;
                $back="page.php?p=krs&sy=".$sy."&sm=".$sm;
                $action="pages/mahasiswa/krs/action.php";

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
					                    <h3 class="panel-title">KRS Data</h3>
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
              
					                            </div>
					                        </div>
					                    </div>

					                    <div class="alert alert-info">
					                    	School Year : <?= $sy; ?> <br>
					                    	Semester : <?= $sm; ?> 
						                </div>

					                    <div class="table-responsive">
					                       <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                	<th>No</th>
					                                    <th>Curriculum Types</th>
									                    <th>Class</th>
									                    <th>Courses</th>
									                    <th>Dosen</th>
									                    <th>Schedule</th>
					                                    <th class="text-center">Status</th>
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
					                            		mk.krs_school_year='$sy' AND
					                            		mk.krs_semester='$sm' AND 
					                            		mk.student_nim='$student_nim'");
					                            	while ($row=mysqli_fetch_array($data)) {
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
					                                    	<?php if ($row['krs_approved']=="Approved") { ?>
						                                        <div class="label label-table label-success">Approved</div>
						                                    <?php } elseif ($row['krs_approved']=="Not Approved") { ?>
						                                    	<div class="label label-table label-danger">Not Approved</div>
						                                    <?php } else { ?>
						                                    	<div class="label label-table label-warning">Waiting</div>
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
				        <h4 class="modal-title">Filter KRS </h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="krs">
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
                $krs_school_year		=$sy;
                $krs_semester			=$sm;
                $krs_package_id			="";
                $majors_code			=$mhs['majors_code'];
                $date=date('Y-m-d H:i:s');

                $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_krs WHERE
                	krs_school_year='$krs_school_year' AND
                	krs_semester='$krs_semester' AND
                	student_nim='$student_nim'"));

                $check2=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM student_open_krs WHERE
                	student_school_year='$krs_school_year' AND
                	student_semester='$krs_semester' AND
                	student_nim='$student_nim' AND 
                	open_start_date<='$date' AND 
                	open_end_date>='$date'"));
                
                $sp=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_schedule WHERE 
                	schedule_school_year='$krs_school_year' AND
                	schedule_semester='$krs_semester' AND
                	majors_code='$majors_code' AND
                	schedule_generation='$mhs[student_generation]'"));

                if ($check>0) {
	                header("location:".$page_edit);
	            }

	            if (empty($check2) OR $check2=="0") {
	               ?>
	               <script type="text/javascript">

                         sweetAlert({
                                        title:'Warning!',
                                        text: 'KRS input has been closed!',
                                        type:'warning',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
	               </script>
	               <?php
	            }


               	?>

               	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Add KRS</h3>
					            </div>

					            <div class="panel-body">
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
						        			<td>: <?= $mhs['student_nim']; ?></td>
						        		</tr>
						        		<tr>
						        			<td>Name</td>
						        			<td>: <?= $mhs['student_name']; ?></td>
						        		</tr>
						        	</table>
					                  

					                <?php if (!empty($sp['schedule_id'])) { ?>
						        	<p style="color: red;"><b>Please select the desired schedule package</b></p>
						        	<!--Bordered Accordion-->
							        <!--===================================================-->
							        <div class="panel-group accordion" id="demo-acc-info-outline">

							        	<?php
					                     $no=1;
					                     $data=mysqli_query($connect, "SELECT * FROM master_schedule 
					                            		where majors_code='$majors_code'
					                            		AND schedule_generation='$mhs[student_generation]'");
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

									                        <button class="btn btn-primary" id="choose" value="<?= $row['schedule_id']; ?>" onclick="data_choose(this.value);" title="Remove">
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

							        <?php } else { 
							        	$tot_sks=mysqli_fetch_array(mysqli_query($connect, "SELECT sum(courses_sks) as sks FROM master_krs as mk, master_curriculum as mc 
					                	LEFT JOIN master_courses ON master_courses.courses_code=mc.courses_code 
					                    where 
					                	mk.curriculum_id=mc.curriculum_id AND
					                	mk.student_nim='$student_nim' AND
					                	mk.krs_school_year='$krs_school_year' AND
					                	mk.krs_semester='$krs_semester'"));
					                	?>

					                <p style="color: red;"><b>Please schedule the desired course</b></p>
						        	<div id="sks" class="badge badge-success"><?= $tot_sks['sks']; ?> SKS</div>
					                  

						        	<div class="table-responsive">
						        		<div id="krs_personal"> 
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
					                            		mc.curriculum_school_year='$krs_school_year' AND
					                            		mc.curriculum_semester='$krs_semester'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            		$check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_krs where curriculum_id='$row[curriculum_id]' AND student_nim='$student_nim' AND
										                	krs_school_year='$krs_school_year' AND
										                	krs_semester='$krs_semester'"));
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


							        <?php } ?>
							                  

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
                $krs_school_year		=$sy;
                $krs_semester			=$sm;
                $edit=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_krs
                	LEFT JOIN master_krs_package ON master_krs_package.krs_package_id=master_krs.krs_package_id
                	LEFT JOIN master_schedule ON master_schedule.schedule_id=master_krs_package.schedule_id
                	where 
                	master_krs.krs_school_year='$krs_school_year' AND
                	master_krs.krs_semester='$krs_semester' AND
                	master_krs.student_nim='$student_nim'"));

                
                $krs_package_id			=$edit['krs_package_id'];
                $majors_code			=$mhs['majors_code'];
                $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_krs WHERE
                	krs_school_year='$krs_school_year' AND
                	krs_semester='$krs_semester' AND
                	student_nim='$student_nim'"));
                $sp=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_schedule WHERE 
                	schedule_school_year='$krs_school_year' AND
                	schedule_semester='$krs_semester' AND
                	majors_code='$majors_code' AND
                	schedule_generation='$mhs[student_generation]'"));

                
                $check2=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM student_open_krs WHERE
                	student_school_year='$krs_school_year' AND
                	student_semester='$krs_semester' AND
                	student_nim='$student_nim' AND 
                	open_start_date<='$date' AND 
                	open_end_date>='$date'"));
                
				if (empty($check2) OR $check2=="0") {
	               ?>
	               <script type="text/javascript">
                                    sweetAlert({
                                        title:'Warning!',
                                        text: 'KRS input has been closed!',
                                        type:'warning',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
	               </script>
	               <?php
	            }
               

               	?>

               	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit KRS </h3>
					            </div>

					            <div class="panel-body">
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
						        			<td>: <?= $mhs['student_nim']; ?></td>
						        		</tr>
						        		<tr>
						        			<td>Name</td>
						        			<td>: <?= $mhs['student_name']; ?></td>
						        		</tr>
						        	</table>
					                  
					                <?php if (!empty($sp['schedule_id'])) { ?>
						        	<p style="color: red;"><b>Please schedule the desired course</b></p>
						        	<!--Bordered Accordion-->
							        <!--===================================================-->
							        <div class="panel-group accordion" id="demo-acc-info-outline">

							        	<?php
					                     $no=1;
					                     $data=mysqli_query($connect, "SELECT * FROM master_schedule 
					                            		where majors_code='$majors_code'
					                            		AND schedule_generation='$mhs[student_generation]'");
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
									                        <button class="btn btn-primary" id="choose" value="<?= $row['schedule_id']; ?>" onclick="data_choose(this.value);" title="Remove">
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
							        <?php } else { 
							        	$tot_sks=mysqli_fetch_array(mysqli_query($connect, "SELECT sum(courses_sks) as sks FROM master_krs as mk, master_curriculum as mc 
					                	LEFT JOIN master_courses ON master_courses.courses_code=mc.courses_code 
					                    where 
					                	mk.curriculum_id=mc.curriculum_id AND
					                	mk.student_nim='$student_nim' AND
					                	mk.krs_school_year='$krs_school_year' AND
					                	mk.krs_semester='$krs_semester'"));
					                	?>

							        <p style="color: red;"><b>Please schedule the desired course</b></p>
						        	<div id="sks" class="badge badge-success"><?= $tot_sks['sks']; ?> SKS</div>
					                  

						        	<div class="table-responsive">
						        		<div id="krs_personal"> 
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
					                            		mc.curriculum_school_year='$krs_school_year' AND
					                            		mc.curriculum_semester='$krs_semester'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            		$check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_krs where curriculum_id='$row[curriculum_id]' AND student_nim='$student_nim' AND
										                	krs_school_year='$krs_school_year' AND
										                	krs_semester='$krs_semester'"));
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
							        <?php } ?>


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
                } ?>

            </div>







