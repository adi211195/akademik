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
            

                $page_list="page.php?p=score&act=list";               
                $action="pages/dosen/score/action.php";

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

					                    <div class="table-responsive">
					                        <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Types</th>
					                                    <th>Status</th>
					                                    <th>Class</th>
					                                    <th>Courses</th>
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
					                            		where 
					                            		mc.lecturer_code='$lecturer_code' AND
					                            		mc.curriculum_school_year='$open_sy' AND
					                            		mc.curriculum_semester='$open_sm'");
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

                <?php 
                break;
                case 'list':
                $id 		=htmlspecialchars($_GET['id']);
                $back="page.php?p=score&act=list&id=".$id;
                $back2="page.php?p=score";

                 $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
					INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					INNER JOIN master_college as mcollege ON mcollege.college_code=mc.college_code
					INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
                	where curriculum_id='$id' AND mc.lecturer_code='$lecturer_code'"));

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
							                                <strong><?php 
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
															<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
															</div>
															</form>
															

										                </div>

										                <div id="demo-stk-lft-tab-2" class="tab-pane fade">

										                	<form class="form-horizontal action" method="POST" enctype="multipart/form-data">
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
										                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
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
												        @$tot_attendance=(($score['score_attendance']/$mc['curriculum_face'])*100)*$weight_attendance;

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
										                                	<th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uts"><i class="fa fa-upload"></i></button> UTS </th>
										                                	
										                                	<th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uas"><i class="fa fa-upload"></i></button> UAS</th>
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
										                                    	<a href="assets/score_file/<?= $file_uts['score_file']; ?>" target="_blank"><button type="button" class="btn btn-info">View</button></a>
										                                    	<?php } ?>

										                                    </td>
                         													<td>
                         														<?php
										                                    	if (empty($file_uas['score_file'])) {
										                                    		echo "The file is still empty";
										                                    	} else {
										                                    	?>
										                                    	<a href="assets/score_file/<?= $file_uas['score_file']; ?>" target="_blank"><button type="button" class="btn btn-info">View</button></a>
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


               	<!-- Modal -->
				<div id="uts" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Upload Score File UTS </h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="score_file">
				      <input type="hidden" name="score_file_type" value="UTS">
				      <input type="hidden" name="curriculum_id" value="<?= $id; ?>">
				      <input type="hidden" name="file" value="<?= $file_uts['score_file']; ?>">
				      <div class="modal-body">

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	File <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="file" name="score_file" required="">
					                        </div>
					                    </div>

				        				
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
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
				        <h4 class="modal-title">Upload Score File UAS </h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="score_file">
				      <input type="hidden" name="score_file_type" value="UAS">
				      <input type="hidden" name="curriculum_id" value="<?= $id; ?>">
				      <input type="hidden" name="file" value="<?= $file_uas['score_file']; ?>">
				      <div class="modal-body">

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	File <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="file" name="score_file" required="">
					                        </div>
					                    </div>

				        				
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>




                <?php	break;
                } ?>

            </div>



