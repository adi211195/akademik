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
                if (empty(@$_GET['sy'])) {

                	$sy=$open_sy;
                	$sm=$open_sm;
                } else {
                	$sy 			=htmlspecialchars(@$_GET['sy']);
                	$sm 		=htmlspecialchars(@$_GET['sm']);                	
                }


                $page_detail="page.php?p=score&act=detail&sy=".$sy."&sm=".$sm;
                $back="page.php?p=score&sy=".$sy."&sm=".$sm;
                $action="pages/mahasiswa/score/action.php";

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
					                                    <tH></th>
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
					                            		mk.krs_approved='Approved' AND
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
					                                    <td>
					                                    	<a href="<?= $page_detail; ?>&id=<?= $row['curriculum_id']; ?>">
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
                case 'detail':
                $id 		=htmlspecialchars($_GET['id']);

                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
					INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					INNER JOIN master_majors as mmajors ON mmajors.majors_code=mc.majors_code
					INNER JOIN master_college as mcollege ON mcollege.college_code=mc.college_code
                	where curriculum_id='$id'"));

                $weight=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_score_weight where curriculum_id='$id'"));
                $mc=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum
							where curriculum_id='$id'"));


                $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_krs WHERE
                	curriculum_id='$id' AND
                	student_nim='$student_nim'"));
				if (empty($check)) {
	               ?>
	               <script type="text/javascript">
                                    sweetAlert({
                                        title:'Warning!',
                                        text: 'Access Denied!',
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

										        <!--===================================================-->
										        <div class="tab-base tab-stacked-left">
										
										            <!--Nav tabs-->
										            <ul class="nav nav-tabs">

										                <li>
										                    <a data-toggle="tab" href="#demo-stk-lft-tab-1">Weight</a>
										                </li>
										                <li>
										                    <a data-toggle="tab" href="#demo-stk-lft-tab-4">Attendance</a>
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

										            	<div id="demo-stk-lft-tab-1" class="tab-pane fade">	
										            	<div class="table-responsive">
										            		<table class="table table-striped table-bordered">
										            			<thead>
										            				<tr>
										            					<th>Weighted Attendance Value </th>
										            					<th>UTS Score Weighted</th>
										            					<th>UAS Score Weighted </th>
										            					<th>Quiz Score Weighted</th>
										            				</tr>
										            			</thead>
										            			<tbody>
										            				<tr>
										            					<td><?= $weight['weight_attendance']; ?> %</td>
										            					<td><?= $weight['weight_uts']; ?> %</td>
										            					<td><?= $weight['weight_uas']; ?> %</td>
										            					<td><?= $weight['weight_quiz']; ?> %</td>
										            				</tr>
										            			</tbody>
										            		</table>	
										            	</div>	
										                </div>


										                <div id="demo-stk-lft-tab-4" class="tab-pane fade">	
										                	<p><b>A : Alfa | H : Present | I : Permission | S : Sick </b></p>
										            	<div class="table-responsive">
										            		<table class="table table-striped table-bordered">
										            			<thead>
										            				<tr>
										            					<th>Date </th>
										            					<th>Attendance</th>
										            				</tr>
										            			</thead>
										            			<tbody>
										            			<?php
										            			$data=mysqli_query($connect, "SELECT * FROM master_attendance
																LEFT JOIN master_attendance_list ON master_attendance_list.attendance_id=master_attendance.attendance_id 
																where curriculum_id='$id' AND 
																student_nim='$student_nim'");
																while ($row=mysqli_fetch_array($data)) {
																?>
										            				<tr>
										            					<td><?= $row['attendance_date']; ?> </td>
										            					<td><?= $row['attendance_type']; ?> </td>
										            				</tr>

										            			<?php } ?>
										            			</tbody>
										            		</table>	
										            	</div>	
										                </div>

										                <div id="demo-stk-lft-tab-2" class="tab-pane fade">

										                    <div class="table-responsive">									                    	
										                        <table class="table table-striped table-bordered">
										                            <thead>
										                                <tr>
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
										                            	$score=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_score 
										                            			where curriculum_id='$id' 
										                            			AND student_nim='$student_nim'"));
										                            	?>
										                            	
										                                <tr>
										                                    <td><?= $score['score_uts']; ?></td>
                         													<td><?= $score['score_quiz']; ?></td>
                         													<td><?= $score['score_uas']; ?></td>
										                                </tr>	                  		

										                            	
										                            </tbody>
										                        </table>
										                    </div>

										                </div>


										                <div id="demo-stk-lft-tab-3" class="tab-pane fade">

										                	<div class="table-responsive">									                    	
										                        <table class="table table-striped table-bordered">
										                            <thead>
										                                <tr>
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
										                            		$score=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_score 
										                            			where curriculum_id='$id' 
										                            			AND student_nim='$student_nim'"));


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
										                                    <td><?= $grand_attendance; ?></td>
                         													<td><?= $grand_uts; ?></td>
                         													<td><?= $grand_quiz; ?></td>
                         													<td><?= $grand_uas; ?></td>
                         													<td><?= $score['score_numbers']; ?></td>
                         													<td><?= $score['score_alphabet']; ?></td>
                         													<td><?= $score['score_quality']; ?></td>
										                                </tr>	                  		

										                            	
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
					                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
               		</div>
               	</div>





               	

                
                <?php
                	break;
               
                } ?>

            </div>







