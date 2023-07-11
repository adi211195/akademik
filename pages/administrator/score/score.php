			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Score</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Score</li>
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

                $page_list="page.php?p=score&act=list&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;               
                $page_print="pages/administrator/score/report_pdf.php";
 				$action="pages/administrator/score/action.php";

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
					                    <h3 class="panel-title">Score Data</h3>
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
                case 'list':
                $id 		=htmlspecialchars($_GET['id']);
                $back="page.php?p=score&act=list&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm."&id=".$id;
                $back2="page.php?p=score&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;

                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
					INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
                	where curriculum_id='$id'"));

                $weight=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_score_weight where curriculum_id='$id'"));
                $mc=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum
							where curriculum_id='$id'"));

                
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Details Score </h3>
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
							                                <strong><?php 
															$data=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
																	                      LEFT JOIN master_majors as mj ON mj.majors_code=mc.majors_code
																	                      WHERE mc.curriculum_id='$id'");
															 while ($row2=mysqli_fetch_array($data)) {
															echo $row2['majors'].", ";
															} ?></strong>
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

							            			<a href="<?= $page_print; ?>?id=<?= $id; ?>" target="_blank">
										                  <button class="btn btn-danger" type="button"><i class="fa fa-print"> </i> Export PDF</button>
										            </a>
										            <br><br>

										        <!--===================================================-->
										        <div class="tab-base tab-stacked-left">
										
										            <!--Nav tabs-->
										            <ul class="nav nav-tabs">

										                <li>
										                    <a data-toggle="tab" href="#demo-stk-lft-tab-1">Weight</a>
										                </li>
										                <li>
										                    <a data-toggle="tab" href="#demo-stk-lft-tab-2">Score</a>
										                </li>
										                <li>
										                    <a data-toggle="tab" href="#demo-stk-lft-tab-3">Details</a>
										                </li>
										                <li>
										                    <a data-toggle="tab" href="#demo-stk-lft-tab-5">File</a>
										                </li>
										            </ul>
										
										            <!--Tabs Content-->
										            <div class="tab-content">

										            	<div id="demo-stk-lft-tab-1" class="tab-pane fade">						<p><b>Note: The total number of values ​​must not be less or more than 100</b></p>				                  
										                    <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
										                    <input type="hidden" name="action" value="weight">
										                    <input type="hidden" name="curriculum_id" value="<?= $id; ?>">
										                    <div class="panel-body">
															<div class="form-group">
										                        <label class="col-sm-4 control-label" >
										                        	Weighted Attendance Value <span class="required">*</span></label>
										                        <div class="col-sm-2">
										                                <input type="number" name="weight_attendance" value="<?= $weight['weight_attendance']; ?>" class="form-control" required>					                           
										                        </div>
										                    </div>
										                    <div class="form-group">
										                        <label class="col-sm-4 control-label" >
										                        	UTS Score Weighted <span class="required">*</span></label>
										                        <div class="col-sm-2">
										                                <input type="number" name="weight_uts" value="<?= $weight['weight_uts']; ?>" class="form-control" required>				                           
										                        </div>
										                    </div>
										                    <div class="form-group">
										                        <label class="col-sm-4 control-label" >
										                        	UAS Score Weighted <span class="required">*</span></label>
										                        <div class="col-sm-2">
										                                <input type="number" name="weight_uas" value="<?= $weight['weight_uas']; ?>" class="form-control" required>				                           
										                        </div>
										                    </div>
										                    <div class="form-group">
										                        <label class="col-sm-4 control-label" >
										                        	Quiz Score Weighted <span class="required">*</span></label>
										                        <div class="col-sm-2">
										                                <input type="number" name="weight_quiz" value="<?= $weight['weight_quiz']; ?>" class="form-control" required>					                           
										                        </div>
										                    </div>
															</div>
															</form>
															

										                </div>

										                <div id="demo-stk-lft-tab-2" class="tab-pane fade">

										                	<form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
										                	<input type="hidden" name="action" value="score">
										                	<input type="hidden" name="curriculum_id" value="<?= $id; ?>">
										                    <div class="table-responsive">									                    	
										                        <table class="table table-striped">
										                            <thead>
										                                <tr>
										                                    <th rowspan="2">No</th>
										                                    <th rowspan="2">NIM</th>
										                                    <th rowspan="2">Name</th>
										                                    <th colspan="3">Score</th>
										                                </tr>
										                                <tr>
										                                	<th>UTS</th>
										                                	<th>QUIZ</th>
										                                	<th>UAS</th>
										                                </tr>
										                            </thead>
										                            <tbody>
										                            	<?php
										                            	$no=1;
										                            	$data=mysqli_query($connect, "SELECT * FROM master_krs 
										                            		LEFT JOIN master_student ON master_student.student_nim=master_krs.student_nim
										                            		 where curriculum_id='$id'");
										                            	while ($row=mysqli_fetch_array($data)) {
										                            		$score=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_score 
										                            			where curriculum_id='$id' 
										                            			AND student_nim='$row[student_nim]'"));
										                            	?>
										                            	
										                                <tr>
										                                    <td><?= $no; ?></td>
										                                    <td><?= $row['student_nim']; ?></td>
										                                    <td><?= $row['student_name']; ?></td>
										                                    <td><input type="number" name="uts<?= $row['student_nim']; ?>" value="<?= $score['score_uts']; ?>" maxlength="3" class="form-control" required></td>
                         													<td><input type="number" name="quiz<?= $row['student_nim']; ?>" value="<?= $score['score_quiz']; ?>" maxlength="3" class="form-control" required></td>
                         													<td><input type="number" name="uas<?= $row['student_nim']; ?>" value="<?= $score['score_uas']; ?>" maxlength="3" class="form-control" required></td>
										                                </tr>	                  		

										                            	<?php $no++;} ?>
										                            	
										                            </tbody>
										                        </table>
										                    </div>
															</form>

										                </div>


										                <div id="demo-stk-lft-tab-3" class="tab-pane fade">

										                	<div class="table-responsive">									                    	
										                        <table class="table table-striped">
										                            <thead>
										                                <tr>
										                                    <th rowspan="2">No</th>
										                                    <th rowspan="2">NIM</th>
										                                    <th rowspan="2">Name</th>
										                                    <th colspan="7">Score</th>
										                                </tr>
										                                <tr>
										                                	<th>Attendance 
										                                		<span class="badge badge-purple"><?= $weight['weight_attendance']; ?>%</span></th>
										                                	<th>UTS <span class="badge badge-purple"><?= $weight['weight_uts']; ?>%</span></th>
										                                	<th>QUIZ <span class="badge badge-purple"><?= $weight['weight_quiz']; ?>%</span></th>
										                                	<th>UAS <span class="badge badge-purple"><?= $weight['weight_uas']; ?>%</span></th>
										                                	<th>Numbers</th>
										                                	<th>Alphabet</th>
										                                	<th>Quality</th>
										                                </tr>
										                            </thead>
										                            <tbody>
										                            	<?php
										                            	$no=1;
										                            	$data=mysqli_query($connect, "SELECT * FROM master_krs 
										                            		LEFT JOIN master_student ON master_student.student_nim=master_krs.student_nim
										                            		 where curriculum_id='$id'");
										                            	while ($row=mysqli_fetch_array($data)) {
										                            		$score=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_score 
										                            			where curriculum_id='$id' 
										                            			AND student_nim='$row[student_nim]'"));

										                

										                $weight_attendance=$weight['weight_attendance']/100;


														if ($score['score_attendance']>=$mc['curriculum_face']) {
															$attendance_amount=$mc['curriculum_face'];
														} else {
															$attendance_amount=$score['score_attendance'];
														}
				
												        @$tot_attendance=(($attendance_amount/$mc['curriculum_face'])*100)*$weight_attendance;



												        $grand_attendance=round($tot_attendance,2);
												        $grand_uts=($score['score_uts']*$weight['weight_uts'])/100;
												        $grand_quiz=($score['score_quiz']*$weight['weight_quiz'])/100;
												        $grand_uas=($score['score_uas']*$weight['weight_uas'])/100;


										                            	?>
										                            	
										                                <tr>
										                                    <td><?= $no; ?></td>
										                                    <td><?= $row['student_nim']; ?></td>
										                                    <td><?= $row['student_name']; ?></td>
										                                    <td><?= $grand_attendance; ?></td>
                         													<td><?= $grand_uts; ?></td>
                         													<td><?= $grand_quiz; ?></td>
                         													<td><?= $grand_uas; ?></td>
                         													<td><?= $score['score_numbers']; ?></td>
                         													<td><?= $score['score_alphabet']; ?></td>
                         													<td><?= $score['score_quality']; ?></td>
										                                </tr>	                  		

										                            	<?php $no++;} ?>
										                            	
										                            </tbody>
										                        </table>
										                    </div>

										                </div>

										                <div id="demo-stk-lft-tab-5" class="tab-pane fade">

										                    <div class="table-responsive">									                    	
										                        <table class="table table-striped table-bordered">
										                            <thead>
										                                <tr>
										                                	<th>UTS</th>
										                                	<th>UAS</th>
										                                </tr>
										                            </thead>
										                            <tbody>
										                            	<?php
										                            	$file_uts=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_score_file 
										                            			where curriculum_id='$id' AND score_file_type='UTS'"));
										                            	$file_uas=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_score_file 
										                            			where curriculum_id='$id' AND score_file_type='UAS'"));
										                            	?>
										                            	
										                                <tr>
										                                    <td>
										                                    	<?php
										                                    	if (empty($file_uts['score_file'])) {
										                                    		echo "The file is still empty";
										                                    	} else {
										                                    	?>
										                                    	<a href="assets/score_file/<?= $file_uts['score_file']; ?>" target="_blank"><button type="button" class="btn btn-primary">View</button></a>
										                                    	<?php } ?>

										                                    </td>
                         													<td>
                         														<?php
										                                    	if (empty($file_uas['score_file'])) {
										                                    		echo "The file is still empty";
										                                    	} else {
										                                    	?>
										                                    	<a href="assets/score_file/<?= $file_uas['score_file']; ?>" target="_blank"><button type="button" class="btn btn-primary">View</button></a>
										                                    	<?php } ?>
                         													</td>
										                                </tr>	                  		

										                            	
										                            </tbody>
										                        </table>
										                    </div>

										                </div>


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



                <?php	break;
                } ?>

            </div>



