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
					
								<?php
								$lecturer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account where account_status='Dosen'"));
								$user=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account where account_status='Administrator'"));
								$student=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account where account_status='Mahasiswa'"));
								$input_krs=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs where 
									krs_school_year='$open_sy' and
									krs_semester='$open_sm' 
									GROUP BY student_nim"));
								?>
					                
					
					
					                <!--Chart information-->
					                <div class="panel-body">
					
					                    <div class="row">
					                        <div class="col-lg-6">
					                            <p class="text-semibold text-uppercase text-main">Student</p>
					                            <div class="row">
					                                <div class="col-xs-12">
					                                    <div class="media">
					                                        <div class="media-left">
					                                            <span class="text-3x text-thin text-main"><?= $student; ?></span>
					                                        </div>
					                                    </div>
					                                </div>
					                                <div class="col-xs-12 text-sm">
					                                <?php
					                                $data=mysqli_query($connect,"SELECT * FROM student_status");
					                                while ($row=mysqli_fetch_array($data)) {
					                                	@$amount=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		LEFT JOIN master_student_history ON master_student_history.student_nim=master_student.student_nim
					                            		WHERE 
														master_student_history.student_history_status='$row[student_status]' AND
														master_student_history.student_history_school_year='$open_sy' AND
														master_student_history.student_history_semester='$open_sm' AND
					                            		account.account_status='Mahasiswa'"));
					                                ?>
					                                    <p>
					                                        
					                                        <span class="pad-lft text-semibold">
					                                        <span class="text-lg"><?= $amount; ?> </span>
					                                        	<span><?= $row['student_status']; ?></span>
					                                    	</span>
					                                    </p>

					                                <?php } ?>

					                                </div>
					                            </div>
					
					
					                        </div>
					
					                        <div class="col-lg-6">
					                            <p class="text-uppercase text-semibold text-main">Amount</p>
					                            <ul class="list-unstyled">
					                                <li>
					                                    <div class="media pad-btm">
					                                        <div class="media-left">
					                                            <span class="text-2x text-thin text-main"><?= $lecturer; ?></span>
					                                        </div>
					                                        <div class="media-body">
					                                            <p class="mar-no">Lecturer</p>
					                                        </div>
					                                    </div>
					                                </li>	
					                                <li>
					                                    <div class="media pad-btm">
					                                        <div class="media-left">
					                                            <span class="text-2x text-thin text-main"><?= $user; ?></span>
					                                        </div>
					                                        <div class="media-body">
					                                            <p class="mar-no">User</p>
					                                        </div>
					                                    </div>
					                                </li>
					                                <li>
					                                    <div class="media pad-btm">
					                                        <div class="media-left">
					                                            <span class="text-2x text-thin text-main"><?= $input_krs; ?></span>
					                                        </div>
					                                        <div class="media-body">
					                                            <p class="mar-no">Input KRS</p>
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
										 $amount=mysqli_fetch_array(mysqli_query($connect,"SELECT sum(drive_size) as size FROM drive_academic"));
										 $files=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM drive_academic"));
										 $persentase=round($amount['size']/10000,0,2); 
										?>

					                    <!--Sparkline Area Chart-->
					                    <div class="panel panel-success panel-colorful">
					                        <div class="pad-all">
					                            <p class="text-lg text-semibold"><i class="demo-pli-data-storage icon-fw"></i> Drive Academic</p>
					                           
					                            <p class="mar-no">
					                                <span class="pull-right text-bold"><?= $persentase; ?> MB</span> Used space
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
										 $lecturer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM elearning group by account_id"));
										 $files=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM elearning"));
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
										 $sent=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM mail_academic_accepted where mail_status='Sent'"));
										 $draft=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM mail_academic_accepted where mail_status='Draft'"));
										 $trash=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM mail_academic_accepted where mail_status='Trash'"));
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
										 $lecturer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_logbook group by lecturer_code"));
										 $logbook=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_logbook"));
										 
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
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Kartu Rencana Studi Data | <?= $open_sy; ?> - <?= $open_sm; ?></h3>
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
					                            	
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT mk.*, ms.*, count(mk.krs_id) as krs FROM master_krs as mk 
					                            		LEFT JOIN master_student as ms ON ms.student_nim=mk.student_nim
					                            		WHERE 
					                            		mk.krs_school_year='$open_sy' AND
					                            		mk.krs_semester='$open_sm' AND 
					                            		MK.krs_approved='Waiting' group by mk.student_nim");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            		$approved=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs 
					                            			WHERE 
						                            		krs_school_year='$open_sy' AND
						                            		krs_semester='$open_sm' AND 
						                            		student_nim='$row[student_nim]' AND 
						                            		krs_approved='Approved'"));

					                            		$notapproved=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs 
					                            			WHERE 
						                            		krs_school_year='$open_sy' AND
						                            		krs_semester='$open_sm' AND 
						                            		student_nim='$row[student_nim]' AND 
						                            		krs_approved='Not Approved'"));

					                            		if (empty($row['krs_package_id'])) {
					                            			$page_list="page.php?p=krs_personal&act=list";
					                            		} else {
					                            			$page_list="page.php?p=krs_package&act=list";
					                            		}
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