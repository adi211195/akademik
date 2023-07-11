			<div id="content-container">
                <div id="page-head">
                    
                    <div class="pad-all text-center">
                        <h3>Welcome back to the Dashboard Academic.</h3>
                        <p1>This Academic System is a system used for students and lecturers to choose KRS and add grades, etc.</p>
                    </div>
                    </div>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="row">
					        <div class="col-lg-6">
					
					            <!--Network Line Chart-->
					            <!--===================================================-->
					            					
					                    <div class="row">
					                    	<?php
					                    	$sks=mysqli_fetch_array(mysqli_query($connect,"SELECT SUM(courses_sks) as sks FROM master_curriculum as mcu
					                    				INNER JOIN master_courses as mc ON mc.courses_code=mcu.courses_code
					                    				where curriculum_school_year='$open_sy'
					                    				AND curriculum_semester='$open_sm'
					                    				AND lecturer_code='$dsn[lecturer_code]'"));
					                    	?>
					                        <div class="col-md-6">
							                    <div class="panel panel-warning panel-colorful media middle pad-all">
							                        <div class="media-left">
							                            <div class="pad-hor">
							                                <i class="demo-psi-star fa-2x"></i>
							                            </div>
							                        </div>
							                        <div class="media-body">
							                            <p class="text-2x mar-no text-semibold"><?= $sks['sks']; ?></p>
							                            <p class="mar-no">The number of credits for all courses</p>
							                        </div>
							                    </div>
							                </div>

							                <?php
					                    	$student=mysqli_fetch_array(mysqli_query($connect,"SELECT count(krs_id) as krs FROM master_krs as mk
					                    				INNER JOIN master_curriculum as mc ON mc.curriculum_id=mk.curriculum_id
					                    				where curriculum_school_year='$open_sy'
					                    				AND curriculum_semester='$open_sm'
					                    				AND lecturer_code='$dsn[lecturer_code]'
					                    				AND krs_approved='Approved'"));
					                    	?>

							                <div class="col-md-6">
							                    <div class="panel panel-info panel-colorful media middle pad-all">
							                        <div class="media-left">
							                            <div class="pad-hor">
							                                <i class="fa fa-group fa-2x"></i>
							                            </div>
							                        </div>
							                        <div class="media-body">
							                            <p class="text-2x mar-no text-semibold"><?= $student['krs']; ?></p>
							                            <p class="mar-no">The number of students in all subjects</p>
							                        </div>
							                    </div>
							                </div>

							                <?php
					                    	$score=mysqli_fetch_array(mysqli_query($connect,"SELECT count(score_id) as score FROM master_score as ms
					                    				INNER JOIN master_curriculum as mc ON mc.curriculum_id=ms.curriculum_id
					                    				where curriculum_school_year='$open_sy'
					                    				AND curriculum_semester='$open_sm'
					                    				AND lecturer_code='$dsn[lecturer_code]'"));

					                    	$failed=mysqli_fetch_array(mysqli_query($connect,"SELECT count(score_id) as score FROM master_score as ms
					                    				INNER JOIN master_curriculum as mc ON mc.curriculum_id=ms.curriculum_id
					                    				where curriculum_school_year='$open_sy'
					                    				AND curriculum_semester='$open_sm'
					                    				AND lecturer_code='$dsn[lecturer_code]'
					                    				AND score_alphabet>='E'"));

					                    	$success=mysqli_fetch_array(mysqli_query($connect,"SELECT count(score_id) as score FROM master_score as ms
					                    				INNER JOIN master_curriculum as mc ON mc.curriculum_id=ms.curriculum_id
					                    				where curriculum_school_year='$open_sy'
					                    				AND curriculum_semester='$open_sm'
					                    				AND lecturer_code='$dsn[lecturer_code]'
					                    				AND score_alphabet<='E'"));
					                    	?>
							                <div class="col-md-6">
							                    <div class="panel panel-mint panel-colorful media middle pad-all">
							                        <div class="media-left">
							                            <div class="pad-hor">
							                                <i class="fa fa-remove fa-2x"></i>
							                            </div>
							                        </div>
							                        <div class="media-body">
							                            <p class="text-2x mar-no text-semibold"><?= $failed['score']; ?> <small>out of</small> <?= $score['score']; ?></p>
							                            <p class="mar-no">The number of students failing</p>
							                        </div>
							                    </div>
							                </div>
							                <div class="col-md-6">
							                    <div class="panel panel-purple panel-colorful media middle pad-all">
							                        <div class="media-left">
							                            <div class="pad-hor">
							                                <i class="fa fa-check fa-2x"></i>
							                            </div>
							                        </div>
							                        <div class="media-body">
							                            <p class="text-2x mar-no text-semibold"><?= $success['score']; ?> <small>out of</small> <?= $score['score']; ?></p>
							                            <p class="mar-no">The number of students graduating</p>
							                        </div>
							                    </div>
							                </div>

							                <hr>


							        <div class="col-sm-6 col-lg-6">
										<?php
										 $amount=mysqli_fetch_array(mysqli_query($connect,"SELECT sum(drive_size) as size FROM drive_academic where account_id='$account_id'"));
										 $files=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM drive_academic where account_id='$account_id'"));
										 $persentase=round($amount['size']/10000,0,2); 
										?>

					                    <!--Sparkline Area Chart-->
					                    <div class="panel panel-success panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i> Drive Academic</p>
					                           
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?= $persentase; ?> MB </span> Used space
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?= number_format($files); ?></span> Files
					                            </p>
					                        </div>
					                        <div class="pad-top text-center">
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-area" class="sparklines-full-content"></div>
					                        </div>
					                    </div>
					                </div>
					                <div class="col-sm-6 col-lg-6">
					                	<?php
										 $lecturer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM elearning where account_id='$account_id' group by account_id"));
										 $files=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM elearning where account_id='$account_id'"));
										?>
					
					                    <!--Sparkline Line Chart-->
					                    <div class="panel panel-info panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-information icon-fw"></i>E-learning</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?= number_format($lecturer); ?></span> Lecturer
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?= number_format($files); ?></span> Files
					                            </p>
					                        </div>
					                        <div class="pad-top text-center">
					
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-line" class="sparklines-full-content"></div>
					
					                        </div>
					                    </div>
					                </div>


							        <div class="col-sm-6 col-lg-6">
										<?php
										 $mail=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM mail_account where account_id='$account_id'"));
										 $sent=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM mail_academic_accepted where 
										 	mail_status='Sent' AND mail_account='$mail[mail_account]'"));
										 $draft=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM mail_academic_accepted where 
										 	mail_status='Draft' AND mail_account='$mail[mail_account]'"));
										 $trash=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM mail_academic_accepted where 
										 	mail_status='Trash' AND mail_account='$mail[mail_account]'"));
										?>

					                    <!--Sparkline bar chart -->
					                    <div class="panel panel-purple panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-mail icon-fw"></i> Mail Academic</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?= number_format($sent); ?></span> Sent
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?= number_format($draft); ?></span> Draft
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?= number_format($trash); ?></span> Trash
					                            </p>
					                        </div>
					                        <div class="text-center">
					
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-bar" class="box-inline"></div>
					
					                        </div>
					                    </div>
					                </div>

					                <div class="col-sm-6 col-lg-6">
										
										<?php
										 $lecturer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_logbook where lecturer_code='$dsn[lecturer_code]' group by lecturer_code"));
										 $logbook=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_logbook where lecturer_code='$dsn[lecturer_code]'"));
										 
										?>

					                    <!--Sparkline pie chart -->
					                    <div class="panel panel-warning panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-receipt-4 icon-fw"></i> Logbook</p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?= $lecturer; ?></span> Lecturer
					                            </p>
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?= $logbook; ?></span> Data
					                            </p>
					                            <p class="mar-no">&nbsp;</p>
					                        </div>
					                        <div class="text-center">
					
					                            <!--Placeholder-->
					                            <div id="demo-sparkline-bar" class="box-inline"></div>
					
					                        </div>
					                    </div>
					                </div>



					
					
					            </div>
					            <!--===================================================-->
					            <!--End network line chart-->
					
					        </div>
					        <div class="col-lg-6">
					        	<div id="demo-panel-network" class="panel">				
					                
					
					
					                <!--Chart information-->
					                <div class="panel-body">

					                	<!-- Timeline -->
							                <!--===================================================-->
							                <div class="timeline">
							
							                    <!-- Timeline header -->
							                    <div class="timeline-header">
							                        <div class="timeline-header-title bg-info">Teaching Schedule</div>
							                    </div>
							
							                   
							                   <?php
							                   $data=mysqli_query($connect,"SELECT * FROM master_curriculum as mcu
					                    				INNER JOIN master_courses as mc ON mc.courses_code=mcu.courses_code
					                    				INNER JOIN master_class as mclass ON mclass.class_code=mcu.class_code
					                    				where curriculum_school_year='$open_sy'
					                    				AND curriculum_semester='$open_sm'
					                    				AND lecturer_code='$dsn[lecturer_code]' order by curriculum_day asc");
							                   while ($row=mysqli_fetch_array($data)) {
							                   ?>


							                    <div class="timeline-entry">
							                        <div class="timeline-stat">
							                            <div class="timeline-icon"></div>
							                            <div class="timeline-time"><?= $row['curriculum_day']; ?></div>
							                        </div>
							                        <div class="timeline-label">
							                        	<p class="text-bold"><a href="#" class="text-warning"><?= $row['courses']; ?></a></p>
							                            Time : <?= $row['curriculum_start']; ?> of <?= $row['curriculum_end']; ?> WIB <br>
							                            Room/Class : <?= $row['class_room']; ?> / <?= $row['class']; ?>

							                        </div>
							                    </div>

							                <?php } ?>
							                </div>
							                <!--===================================================-->
							                <!-- End Timeline -->
							    
					                </div>
					            </div>
									
					
					
					        </div>
					    </div>
					

						<div class="row">

							<div class="col-md-2 ">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-speech-bubble-5 icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Blog Academic</p>
					                    <p class="text-sm">A collection of the latest information about academic and campus activities.</p>
					                    <a href="?p=blog">
					                    <button class="btn btn-primary mar-ver">View <i class="fa fa-arrow-circle-right"></i></button></a>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-2 ">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-speech-bubble-7 icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Chat Academic</p>
					                    <p class="text-sm">Send personal or group messages between students and lecturers.</p>
					                    <a href="?p=chat_personal">
					                    <button class="btn btn-primary mar-ver">View <i class="fa fa-arrow-circle-right"></i></button></a>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-2 ">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-data-settings icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Drive Academic</p>
					                    <p class="text-sm">File storage of documents and images with a free capacity of 100MB.</p>
					                    <a href="?p=drive">
					                    <button class="btn btn-primary mar-ver">View <i class="fa fa-arrow-circle-right"></i></button></a>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-information icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">E-Learning</p>
					                    <p class="text-sm">Media to share course material from each lecturer.</p>
					                    <a href="?p=elearning">
					                    <button class="btn btn-primary mar-ver">View <i class="fa fa-arrow-circle-right"></i></button></a>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-mail icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Mail Academic</p>
					                    <p class="text-sm">A place to send messages between students and lecturers.</p>
					                    <a href="?p=mail">
					                    <button class="btn btn-primary mar-ver">View <i class="fa fa-arrow-circle-right"></i></button></a>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-2">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-calendar-4 icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Calendar</p>
					                    <p class="text-sm">Information about the schedule of academic or campus activities.</p>
					                    <a href="?p=calendar">
					                    <button class="btn btn-primary mar-ver">View <i class="fa fa-arrow-circle-right"></i></button></a>
					                </div>
					            </div>
					        </div>
					    </div>


					     <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Kartu Rencana Studi Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">					                   

					                    <div class="table-responsive">
					                       <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                	<th>No</th>
					                                    <th>NIM</th>
									                    <th>Name</th>
									                    <th>KRS</th>
									                    <th>Approved</th>
									                    <th>Not Approved</th>
									                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$page_list="page.php?p=krs&act=list";
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT mk.*, ms.*, count(mk.krs_id) as krs FROM master_krs as mk 
					                            		LEFT JOIN master_student as ms ON ms.student_nim=mk.student_nim
					                            		WHERE 
					                            		mk.krs_school_year='$open_sy' AND
					                            		mk.krs_semester='$open_sm' AND 
					                            		MK.krs_approved='Waiting' AND
					                            		mk.krs_advisor='$lecturer_code' group by mk.student_nim");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            		$approved=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs 
					                            			WHERE 
						                            		krs_school_year='$open_sy' AND
						                            		krs_semester='$open_sm' AND 
						                            		krs_advisor='$lecturer_code' AND 
						                            		student_nim='$row[student_nim]' AND 
						                            		krs_approved='Approved'"));

					                            		$notapproved=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs 
					                            			WHERE 
						                            		krs_school_year='$open_sy' AND
						                            		krs_semester='$open_sm' AND 
						                            		krs_advisor='$lecturer_code' AND 
						                            		student_nim='$row[student_nim]' AND 
						                            		krs_approved='Not Approved'"));
					                            	?>

					                                <tr>
					                                	<td><?= $no; ?></td>
					                                    <td><?= $row['student_nim']; ?></td>
									                    <td><?= $row['student_name']; ?></td>
									                    <td><?= $row['krs']; ?></td>
									                    <td><?= $approved; ?></td>
									                    <td><?= $notapproved; ?></td>
									                    <td>
									                    	<a href="<?= $page_list; ?>&nim=<?= $row['student_nim']; ?>">
						                               		 <button class="btn btn-warning" title="Approved"><i class="fa fa-list"></i></button></a> 
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

            </div>