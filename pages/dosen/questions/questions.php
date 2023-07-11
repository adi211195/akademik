			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Questions and Answer</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Questions and Answer</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
            

                $page_list="page.php?p=questions&act=list";               
                $action="pages/dosen/questions/action.php";

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
					                    <h3 class="panel-title">Questions and Answer Data</h3>
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
                $back="page.php?p=questions&act=list&id=".$id;
                $back2="page.php?p=questions";

                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
					INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					INNER JOIN master_college as mcollege ON mcollege.college_code=mc.college_code
					INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
                	where curriculum_id='$id' AND mc.lecturer_code='$lecturer_code'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Details Questions and Answer</h3>
					            </div>
					            <div class="panel-body">

					        		<button class="btn btn-purple" data-toggle="modal" data-target="#page_input"><i class="demo-pli-add icon-fw"></i> Add Questions</button> <br><br>

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
										            	<?php
										            	$no=1;
										            	$data=mysqli_query($connect, "SELECT * FROM questions 
										            		where curriculum_id='$id'
										            		order by create_date desc");
										            	while ($row=mysqli_fetch_array($data)) {
										            	?>

										                <li>
										                    <a data-toggle="tab" href="#demo-stk-lft-tab-<?= $no; ?>"><?= $row['questions_type']; ?></a>
										                </li>
										                
										                <?php $no++; } ?>
										            </ul>
										
										            <!--Tabs Content-->
										            <div class="tab-content">
										            	<?php
										            	$no=1;
										            	$data=mysqli_query($connect, "SELECT * FROM questions 
										            		where curriculum_id='$id'
										            		order by create_date desc");
														while ($row=mysqli_fetch_array($data)) {
										            	?>
										                <div id="demo-stk-lft-tab-<?= $no; ?>" class="tab-pane fade">
										                    <p class="text-main text-semibold">Type | <?= $row['questions_type']; ?></p>
										                    <p>Information : <?= $row['questions_information']; ?></p>
										                    <a href="download_file.php?act=questions&file=<?= $account_id; ?>!<?= $row['questions_id']; ?>" target="_blank">
											                    <button type="button" class="btn btn-danger"><i class="fa fa-download"></i> Questions</button>
											                </a>

										                    <div class="table-responsive">
										                    	
										                        <table class="table table-striped">
										                            <thead>
										                                <tr>
										                                    <th>No</th>
										                                    <th>NIM</th>
										                                    <th>Name</th>
										                                    <th>Answer</th>
										                                </tr>
										                            </thead>
										                            <tbody>
										                            	<?php
										                            	$no2=1;
										                            	$data2=mysqli_query($connect, "SELECT * FROM master_krs 
										                            		LEFT JOIN master_student ON master_student.student_nim=master_krs.student_nim
										                            		 where curriculum_id='$id'");
										                            	while ($row2=mysqli_fetch_array($data2)) {

																		$cek=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questions_answer 
																			WHERE questions_id='$row[questions_id]'
																			AND student_nim='$row2[student_nim]'"));

																		
										                            	?>
										                            	
										                                <tr>
										                                    <td><?= $no2; ?></td>
										                                    <td><?= $row2['student_nim']; ?></td>
										                                    <td><?= $row2['student_name']; ?></td>
										                                    <td>

										                                    	<?php if (!empty($cek['student_nim'])) { ?>
										                                    		<a href="download_file.php?act=answer&file=<?= $row2['account_id']; ?>!<?= $row2['answer_id']; ?>" target="_blank">
																	                    <button type="button" class="btn btn-danger"><i class="fa fa-download"></i> Answer</button>
																	                </a>
										                                    	<?php } ?>

										                                    </td>
										                                </tr>
										                           		

										                            	<?php $no2++;} ?>
										                            	
										                            </tbody>
										                        </table>
										                    </div>

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
				        <h4 class="modal-title">Add Questions</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="curriculum_id" value="<?= $id; ?>">
				      <input type="hidden" name="action" value="input">
				      <div class="modal-body">	

				      					<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Type <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="questions_type" class="form-control">	
					                            	<option value="Quiz">Quiz</option>
					                            	<option value="UTS">UTS</option>
					                            	<option value="UAS">UAS</option>
					                            </select>			                           
					                        </div>
					                    </div>			        				

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	File <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="file" name="questions_file"  class="form-control">	
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Information <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <textarea name="questions_information" class="form-control"></textarea>	       
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



