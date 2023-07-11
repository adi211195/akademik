			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Lecturer Questionnaire Reports</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Lecturer Questionnaire Reports</li>
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

                $page_list="page.php?p=report_lecturer_questionnaire&act=list&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $page_print="pages/administrator/report_lecturer_questionnaire/report_pdf.php";               
                $action="pages/administrator/report_lecturer_questionnaire/action.php";

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
					                    <h3 class="panel-title">Lecturer Questionnaire Reports</h3>
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
					                        <table class="table table-striped">
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
				      <input type="hidden" name="p" value="report_lecturer_questionnaire">
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
                $back="page.php?p=report_lecturer_questionnaire&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;

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
					                <h3 class="panel-title">Details Questionnaire</h3>
					            </div>
					            <div class="panel-body">


					            	<div class="row">
							            <div class="col-lg-3 table-responsive">
							            	<div class="text-center">
						                        <button class="btn btn-block btn-warning btn-lg" data-toggle="modal" data-target="#information">Information</button>
						                    </div>
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
							            	<div class="table-responsive">
							                	<table class="table table-bordered">
							                		<thead>
							                			<tr>
							                				<th colspan="7">Questionnaire</th>
							                			</tr>
							                			<tr>
							                				<th></th>
							                				<th>Questions</th>
							                				<th width="8%">1</th>
							                				<th width="8%">2</th>
							                				<th width="8%">3</th>
							                				<th width="8%">4</th>
							                				<th width="8%">5</th>
							                			</tr>
							                		</thead>
							                		<?php
							                		$data=mysqli_query($connect,"SELECT * FROM questionnaire_lecturer as ql
							                			INNER JOIN questionnaire_category as qc on qc.category_id=ql.category_id group by ql.category_id");
							                		while ($row=mysqli_fetch_array($data)) {
							                		?>
							                			<tr>
							                				<th colspan="7">Category : <?= $row['category']; ?></th>
							                			</tr>


							                			<?php
							                			$no=1;
								                		$data2=mysqli_query($connect,"SELECT * FROM questionnaire_lecturer 
								                			WHERE category_id='$row[category_id]'");
								                		while ($row2=mysqli_fetch_array($data2)) {
								                			$satu=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_lecturer where 
								                				q_lecturer_id='$row2[q_lecturer_id]' AND 
								                				curriculum_id='$id' AND 
								                				q_lecturer_answer='1'"));

								                			$dua=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_lecturer where 
								                				q_lecturer_id='$row2[q_lecturer_id]' AND 
								                				curriculum_id='$id' AND 
								                				q_lecturer_answer='2'"));

								                			$tiga=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_lecturer where 
								                				q_lecturer_id='$row2[q_lecturer_id]' AND 
								                				curriculum_id='$id' AND 
								                				q_lecturer_answer='3'"));

								                			$empat=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_lecturer where 
								                				q_lecturer_id='$row2[q_lecturer_id]' AND 
								                				curriculum_id='$id' AND 
								                				q_lecturer_answer='4'"));

								                			$lima=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_lecturer where 
								                				q_lecturer_id='$row2[q_lecturer_id]' AND 
								                				curriculum_id='$id' AND 
								                				q_lecturer_answer='5'"));

								                			
								                		?>

								                		<tr>
								                			<td><?= $no; ?></td>
								                			<td><?= $row2['q_lecturer_description']; ?></td>
								                			<td><?= $satu; ?></td>
								                			<td><?= $dua; ?></td>
								                			<td><?= $tiga; ?></td>
								                			<td><?= $empat; ?></td>
								                			<td><?= $lima; ?></td>
								                		</tr>

								                		<?php $no++; } ?>


							                		<?php } ?>							                		

							                		<thead>
							                			<tr>
							                				<th colspan="7">Suggestion and Feedback</th>
							                			</tr>
							                		</thead>
							                		<?php
							                			$no=1;
								                		$data2=mysqli_query($connect,"SELECT * FROM questionnaire_suggestions 
								                			WHERE qs_status='lecturer'");
								                		while ($row2=mysqli_fetch_array($data2)) { ?>

								                		<tr>
								                			<td><?= $no; ?></td>
								                			<td colspan="5"><?= $row2['qs_description']; ?></td>
								                			<td><button class="btn btn-warning" data-toggle="modal" data-target="#list<?= $no; ?>"><i class="fa fa-list"></i></button>

								                			<!-- Modal -->
																<div id="list<?= $no; ?>" class="modal fade" role="dialog">
																  <div class="modal-dialog modal-lg">

																    <!-- Modal content-->
																    <div class="modal-content">
																      <div class="modal-header">
																        <h4 class="modal-title"><?= $row2['qs_description']; ?></h4>
																      </div>
																      <div class="modal-body">				        				
																      	<table class="table">
																      		<?php
													                			$num=1;
														                		$data3=mysqli_query($connect,"SELECT * FROM questionnaire_report_suggestions 
														                			WHERE suggestions_id='$row2[suggestions_id]'
														                			AND qr_status='lecturer'");
														                		while ($row3=mysqli_fetch_array($data3)) { ?>
																      		<tr>
																      			<td><?= $num; ?></td>
																      			<td><?= $row3['qs_answer']; ?></td>
																      		</tr>
																      		<?php $num++; } ?>
																      	</table>               
																      </div>
																      <div class="modal-footer">
																        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																      </div>
																    </div>

																  </div>
																</div>

															</td>
								                		</tr>


								                		


								                	<?php $no++; } ?>
							                	</table>
							                </div>
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
			

				<!-- Modal -->
				<div id="information" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Information</h4>
				      </div>
				      <div class="modal-body">
				      	<b>Selection</b>
				        	<ol>
				        		<li>Sangat Tidak Baik/Sangat Rendah/Tidak Pernah/Tidak Lengkap</li>
				        		<li>Tidak Baik//Jarang/Kurang Lengkap</li>
				        		<li>Biasa/Cukup/Kadang-Kadang/Cukup Lengkap</li>
				        		<li>Baik/Tinggi/Sering/Lengkap</li>
				        		<li>Sangat Baik/Sangat Tinggi/Selalu/Sangat Lengkap</li>
				        	</ol>			

					                    					                    
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>

                <?php	break;
                } ?>

            </div>



