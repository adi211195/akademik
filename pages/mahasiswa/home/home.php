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
					        <div class="col-lg-7">
					
					            <!--Network Line Chart-->
					            <!--===================================================-->
					            <div id="demo-panel-network" class="panel">
					                <div class="panel-heading">
					                    <div class="panel-control">
					                        <div class="dropdown">
					                            <button class="dropdown-toggle btn btn-default btn-active-primary" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical"></i></button>
					                            <ul class="dropdown-menu dropdown-menu-right">
					                                <li><a href="#">Blog Academic</a></li>
					                                <li><a href="#">Mail Academic</a></li>
					                                <li><a href="#">Chat Academic</a></li>
					                                <li><a href="#">Drive Academic</a></li>
					                            </ul>
					                        </div>
					                    </div>
					                </div>
					
					
					                
					
					
					                <!--Chart information-->
					                <div class="panel-body">
										<?php
										if ($open_sm=="Genap") {
											$open_sy2=$open_sy;
											$open_sm2="Ganjil";
										} else {
											$open=explode("/", $open_sy);
											$open_sy2=($open[0]-1)."/".$open[0];
											$open_sm2="Genap";
										}

										$sks=mysqli_fetch_array(mysqli_query($connect,"SELECT sum(courses_sks) as sks, 
											count(mk.curriculum_id) as courses  FROM master_curriculum as mc 
										 						INNER JOIN master_krs as mk ON mk.curriculum_id=mc.curriculum_id
										 						INNER JOIN master_courses as mco ON mco.courses_code=mc.courses_code
										 						where curriculum_school_year='$open_sy'
								                    			AND curriculum_semester='$open_sm'
								                    			AND student_nim='$mhs[student_nim]'
								                    			AND krs_approved='Approved'"));

										$sks2=mysqli_fetch_array(mysqli_query($connect,"SELECT sum(courses_sks) as sks, 
											count(mk.curriculum_id) as courses  FROM master_curriculum as mc 
										 						INNER JOIN master_krs as mk ON mk.curriculum_id=mc.curriculum_id
										 						INNER JOIN master_courses as mco ON mco.courses_code=mc.courses_code
										 						where curriculum_school_year='$open_sy2'
								                    			AND curriculum_semester='$open_sm2'
								                    			AND student_nim='$mhs[student_nim]'
								                    			AND krs_approved='Approved'"));
										?>
					                    <div class="row">
					                        <div class="col-lg-6">
					                            <p class="text-semibold text-uppercase text-main">Kartu Rencana Studi (KRS) </p>
					                            <div class="row">
					                                <div class="col-xs-6">
					                                    <div class="media">
					                                        <div class="media-left">
					                                            <span class="text-3x text-thin text-main"><?= $sks['sks']; ?></span>
					                                        </div>
					                                        <div class="media-body">
					                                            <p class="mar-no"></p>
					                                        </div>
					                                    </div>
					                                </div>
					                                <div class="col-xs-6">
					                                    <div class="media">
					                                        <div class="media-left">
					                                            <span class="text-3x text-thin text-main"><?= $sks['courses']; ?></span>
					                                        </div>
					                                        <div class="media-body">
					                                            <p class="mar-no">Courses</p>
					                                        </div>
					                                    </div>
					                                </div>
					                                <div class="col-xs-12 text-sm">
					                                    <p>
					                                        <span><?= $open_sy; ?> | <?= $open_sm; ?></span>
					                                        <span class="pad-lft text-semibold">
					                                        <span class="text-lg"><?= $sks['sks']; ?> </span><sup>SKS</sup>

					                                    <?php if ($sks['sks']>=$sks2['sks']) { ?>

					                                        <span class="labellabel-success mar-lft">
					                                            <i class="pci-caret-up text-success"></i>
					                                            <smal>+ <?= $sks['sks']-$sks2['sks']; ?></smal>
					                                        </span>

					                                    <?php } else { ?>

					                                        <span class="labellabel-danger mar-lft">
					                                            <i class="pci-caret-down text-danger"></i>
					                                            <smal>- <?= $sks2['sks']-$sks['sks']; ?></smal>
					                                        </span>

					                                    <?php } ?>


					                                        </span>
					                                    </p>
					                                    <p>
					                                        <span><?= $open_sy2; ?> | <?= $open_sm2; ?></span>
					                                        <span class="pad-lft text-semibold">
					                                        <span class="text-lg"><?= $sks2['sks']; ?> </span><sup>SKS</sup>					                                        
					                                        </span>
					                                    </p>
					                                </div>
					                            </div>
					
					
					                        </div>



					                        <?php
					                    	$grand_total=0;
					                    	$sks=0;
					                    	$quality=0;
					                    	$data=mysqli_query($connect, "SELECT * FROM master_score
											INNER JOIN master_courses ON master_courses.courses_code=master_score.courses_code
											where master_score.student_nim='$student_nim'
											ORDER BY master_score.courses_code ASC");
					                    	while ($row=mysqli_fetch_array($data)) {
					                    		$sks=$sks+$row['courses_sks'];
					                    		$quality=$quality+($row['courses_sks']*$row['score_quality']);
					                    		$grand_total=$grand_total+$row['score_numbers'];
					                    	}
					                    	@$ipk=round($quality/$sks,2);
					                    	@$status=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_ipk WHERE 
					                    		range_ipk_numbers>='$ipk'"));

					                    	@$ipk_percentage=@round(($ipk*100)/4,2);
					                    	
					                    	@$nilai=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_score where 
					                    		student_nim='$mhs[student_nim]'"));
					                    	@$nilai1=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_score where 
					                    		student_nim='$mhs[student_nim]' AND score_numbers BETWEEN '1' AND '25'"));
					                    	@$nilai2=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_score where 
					                    		student_nim='$mhs[student_nim]' AND score_numbers BETWEEN '26' AND '50'"));
					                    	@$nilai3=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_score where 
					                    		student_nim='$mhs[student_nim]' AND score_numbers BETWEEN '51' AND '75'"));
					                    	@$nilai4=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_score where 
					                    		student_nim='$mhs[student_nim]' AND score_numbers BETWEEN '76' AND '100'"));

					                    	@$nil1=@round(($nilai1*100)/$nilai,2);
					                    	@$nil2=@round(($nilai2*100)/$nilai,2);
					                    	@$nil3=@round(($nilai3*100)/$nilai,2);
					                    	@$nil4=@round(($nilai4*100)/$nilai,2);
					                    	?>
					
					                        <div class="col-lg-6">
					                            <p class="text-uppercase text-semibold text-main">Index Prestasi Komulatif (IPK)</p>
					                            <ul class="list-unstyled">
					                                <li>
					                                    <div class="media pad-btm">
					                                        <div class="media-left">
					                                            <span class="text-2x text-thin text-main"><?= @$ipk; ?></span>
					                                        </div>
					                                        <div class="media-body">
					                                            <p class="mar-no"><?= $status['range_ipk_status']; ?></p>
					                                        </div>
					                                    </div>
					                                </li>
					                                <li class="pad-btm">
					                                    <div class="clearfix">
					                                        <p class="pull-left mar-no">IPK percentage</p>
					                                        <p class="pull-right mar-no"><?= @$ipk_percentage; ?>%</p>
					                                    </div>
					                                    <div class="progress progress-sm">
					                                        <div class="progress-bar progress-bar-info" style="width: <?= @$ipk_percentage; ?>%;">
					                                            <span class="sr-only"><?= @$ipk_percentage; ?>% Complete</span>
					                                        </div>
					                                    </div>
					                                </li>
					                                <li>
					                                    <div class="clearfix">
					                                        <p class="pull-left mar-no">Percentage of values ​​from 1 to 25</p>
					                                        <p class="pull-right mar-no"><?= @$nil1; ?>%</p>
					                                    </div>
					                                    <div class="progress progress-sm">
					                                        <div class="progress-bar progress-bar-danger" style="width: <?= $nil1; ?>%;">
					                                            <span class="sr-only"><?= @$nil1; ?>% Complete</span>
					                                        </div>
					                                    </div>
					                                </li>
					                                <li>
					                                    <div class="clearfix">
					                                        <p class="pull-left mar-no">Percentage of values ​​from 26 to 50</p>
					                                        <p class="pull-right mar-no"><?= @$nil2; ?>%</p>
					                                    </div>
					                                    <div class="progress progress-sm">
					                                        <div class="progress-bar progress-bar-warning" style="width: <?= $nil2; ?>%;">
					                                            <span class="sr-only"><?= @$nil2; ?>% Complete</span>
					                                        </div>
					                                    </div>
					                                </li>
					                                <li>
					                                    <div class="clearfix">
					                                        <p class="pull-left mar-no">Percentage of values ​​from 51 to 75</p>
					                                        <p class="pull-right mar-no"><?= @$nil3; ?>%</p>
					                                    </div>
					                                    <div class="progress progress-sm">
					                                        <div class="progress-bar progress-bar-primary" style="width: <?= $nil3; ?>%;">
					                                            <span class="sr-only"><?= @$nil3; ?>% Complete</span>
					                                        </div>
					                                    </div>
					                                </li>
					                                <li>
					                                    <div class="clearfix">
					                                        <p class="pull-left mar-no">Percentage of values ​​from 76 to 100</p>
					                                        <p class="pull-right mar-no"><?= @$nil4; ?>%</p>
					                                    </div>
					                                    <div class="progress progress-sm">
					                                        <div class="progress-bar progress-bar-success" style="width: <?= @$nil4; ?>%;">
					                                            <span class="sr-only"><?= @$nil4; ?>% Complete</span>
					                                        </div>
					                                    </div>
					                                </li>
					                               
					                            </ul>
					                        </div>
					                    </div>
					                </div>
					
					
					            </div>
					            <!--===================================================-->
					            <!--End network line chart-->
					
					        </div>
					        <div class="col-lg-5">
					            <div class="row">
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
										 $lecturer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM elearning 
										 						INNER JOIN master_krs as mk ON mk.curriculum_id=elearning.curriculum_id
										 						INNER JOIN master_curriculum as mc On mc.curriculum_id=elearning.curriculum_id
										 						where student_nim='$mhs[student_nim]'
										 						AND krs_approved='Approved' group by lecturer_code"));
										 $files=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM elearning 
										 						INNER JOIN master_krs as mk ON mk.curriculum_id=elearning.curriculum_id
										 						INNER JOIN master_curriculum as mc On mc.curriculum_id=elearning.curriculum_id
										 						where student_nim='$mhs[student_nim]'
										 						AND krs_approved='Approved'"));
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
					            </div>


					            <div class="row">
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
										 $lecturer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_logbook where 
										 	student_nim='$mhs[student_nim]' group by lecturer_code"));
										 $logbook=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_logbook where student_nim='$mhs[student_nim]'"));
										 
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
					                    <h3 class="panel-title">Status Kartu Rencana Studi</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                                <a href="?p=krs&act=input">
					                                <button class="btn btn-purple"><i class="demo-pli-add icon-fw"></i>Add</button></a>
				                                
					                            </div>
					                        </div>
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
					                            		mk.krs_school_year='$open_sy' AND
					                            		mk.krs_semester='$open_sm' AND 
					                            		MK.student_nim='$student_nim'");
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

            </div>