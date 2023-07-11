			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Questions and Answers</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Questions and Answers</li>
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


                $page_list="page.php?p=questions&act=list";
                $back="page.php?p=questions&sy=".$sy."&sm=".$sm;
                $action="pages/mahasiswa/questions/action.php";

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
					                    <h3 class="panel-title">Questions and Answers Data</h3>
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
					                                    <th>Types</th>
									                    <th>Class</th>
									                    <th>Courses</th>
									                    <th>Dosen</th>
									                    <th>Schedule</th>
					                                    <th>Questions</th>
					                                    <th>Answer</th>
					                                    <th></th>
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
					                            		mk.student_nim='$student_nim' AND 
					                            		mk.krs_approved='Approved'");
					                            	while ($row=mysqli_fetch_array($data)) {

					                            		$questions=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questions where curriculum_id='$row[curriculum_id]'"));

					                            		$answer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questions_answer 
					                            			LEFT JOIN questions ON questions.questions_id=questions_answer.questions_id
					                            			 where curriculum_id='$row[curriculum_id]' AND student_nim='$student_nim'"));


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
					                                    <td><?= $questions; ?></td>
					                                    <td><?= $answer; ?></td>
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
				        <h4 class="modal-title">Filter KRS </h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="questions">
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
                case 'list':
                $id 		=htmlspecialchars($_GET['id']);
                $back="page.php?p=questions&act=list&id=".$id;
                $back2="page.php?p=questions&sy=".$sy."&sm=".$sm;

                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
					INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					INNER JOIN master_college as mcollege ON mcollege.college_code=mc.college_code
					INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
                	where curriculum_id='$id'"));

                $access=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_access
                	WHERE student_nim='$student_nim' AND 
                	student_access_school_year='$row[curriculum_school_year]' AND
                	student_access_semester='$row[curriculum_semester]'"));


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
					                <h3 class="panel-title">Details Questions and Answer</h3>
					            </div>
					            <div class="panel-body">

					            	<div class="row">
							            <div class="col-lg-3 table-responsive">
							                <table class="table table-bordered invoice-summary">
							                    <tbody>
							                        <tr>
							                            <td>
							                                <strong><?= $row['curriculum_school_year']; ?> / <?= $row['curriculum_semester']; ?></strong>
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
							            	<div class="table-responsive">
								                <table class="table table-bordered">
								                	<thead>
								                		<tr>
								                			<th>No</th>
								                			<th>Type</th>
								                			<th>Questions</th>
								                			<th>Information</th>
								                			<th colspan="2">Answer</th>
								                		</tr>
								                	</thead>
								                	<tbody>
								                		<?php
								                		$no=1;
										            	$data2=mysqli_query($connect, "SELECT * FROM questions 
										            		where curriculum_id='$id'
										            		order by create_date desc");
														while ($row2=mysqli_fetch_array($data2)) {
															$answer =mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questions_answer
															where student_nim='$student_nim' AND questions_id='$row2[questions_id]'"));
														?>

														<tr>
															<td><?= $no; ?></td>
															<td><?= $row2['questions_type']; ?></td>

															<?php if ($row2['questions_type']=="UTS" AND $access['student_access_uts']=="1") {
																echo "<td colspan='3'>Access Denied, Please contact administrator.</td>";
															} else if ($row2['questions_type']=="Quiz" AND $access['student_access_quiz']=="1") {
																echo "<td colspan='3'>Access Denied, Please contact administrator.</td>";
															} else if ($row2['questions_type']=="UAS" AND $access['student_access_uas']=="1") {
																echo "<td colspan='3'>Access Denied, Please contact administrator.</td>";
															} else {
															?>

															<td>
																<a href="download_file.php?act=questions&file=<?= $row['account_id']; ?>!<?= $row2['questions_id']; ?>" target="_blank">
											                    <button type="button" class="btn btn-danger"><i class="fa fa-download"></i></button>
											                </a>
															</td>
															<td><?= $row2['questions_information']; ?></td>
															<td>
																<?php if (empty($answer['answer_file'])) {
																	echo "No Answer";
																} else { ?>

																<a href="download_file.php?act=answer&file=<?= $account_id; ?>!<?= $answer['answer_id']; ?>" target="_blank">
											                    <button type="button" class="btn btn-danger"><i class="fa fa-download"></i></button>	

																<?php } ?>
															</td>
															<td>
																<button class="btn btn-success" data-toggle="modal" data-target="#page_input<?= $no; ?>" title="upload"><i class="fa fa-upload"></i></button>


																<!-- Modal -->
																<div id="page_input<?= $no; ?>" class="modal fade" role="dialog">
																  <div class="modal-dialog">

																    <!-- Modal content-->
																    <div class="modal-content">
																      <div class="modal-header">
																        <h4 class="modal-title">Upload Answer</h4>
																      </div>
																      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
																      <input type="hidden" name="questions_id" value="<?= $row2['questions_id']; ?>">
																      <input type="hidden" name="action" value="input">
																      <div class="modal-body">	

																      					
																	                    <div class="form-group">
																	                        <label class="col-sm-3 control-label" >
																	                        	File <span class="required">*</span></label>
																	                        <div class="col-sm-9">
																	                            <input type="file" name="answer_file"  class="form-control">	
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


															</td>

														<?php } ?>
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







