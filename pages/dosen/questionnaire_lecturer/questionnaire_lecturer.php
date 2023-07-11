			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Questionnaire</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Questionnaire</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
            

                $page_list="page.php?p=questionnaire_lecturer&act=list";               
                $action="pages/dosen/questionnaire_lecturer/action.php";

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
					                    <h3 class="panel-title">Questionnaire Data</h3>
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
                $back="page.php?p=questionnaire_lecturer&act=list&id=".$id;
                $back2="page.php?p=questionnaire_lecturer";

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
					                <h3 class="panel-title">Details Questionnaire</h3>
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



