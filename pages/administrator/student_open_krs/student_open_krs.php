			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Open KRS Student</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Open KRS Student</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                if (empty(@$_GET['code'])) {
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code"));        

                	$majors_code=$code['majors_code'];
                	$thn2=date('Y')+1;
                	$gen=date('Y')."/".$thn2;

                	$mcurriculum=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum order by curriculum_school_year, curriculum_semester desc"));
                	$sy=$mcurriculum['curriculum_school_year'];
                	$sm=$mcurriculum['curriculum_semester'];

                } else {
                	$majors_code	=htmlspecialchars(@$_GET['code']);
                	$gen 			=htmlspecialchars(@$_GET['gen']);
                	$sy 			=htmlspecialchars(@$_GET['sy']);
                	$sm 		=htmlspecialchars(@$_GET['sm']);
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
					                            		WHERE majors_code='$majors_code'"));
                }

                $page_input="page.php?p=student_open_krs&act=input&code=".$code['majors_code']."&gen=".$gen."&sy=".$sy."&sm=".$sm;
                $page_edit="page.php?p=student_open_krs&act=edit&code=".$code['majors_code']."&gen=".$gen."&sy=".$sy."&sm=".$sm;
                $back="page.php?p=student_open_krs&code=".$code['majors_code']."&gen=".$gen."&sy=".$sy."&sm=".$sm;
                $action="pages/administrator/student_open_krs/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:

				$status=array('Active','Non Active','Leave','Exit','Graduated');

				@$tot_student=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		account.account_status='Mahasiswa'"));

				@$tot_entry=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN student_open_krs ON student_open_krs.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
														master_student.student_generation='$gen' AND
					                            		account.account_status='Mahasiswa'"));

			
				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Open KRS Student Data </h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">

					                                <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>

					                                <button class="btn btn-primary" data-toggle="modal" data-target="#open_student"><i class="fa fa-plus"></i> Open KRS Student </button>

					                                <button class="btn btn-primary" data-toggle="modal" data-target="#open_majors"><i class="fa fa-plus"></i> Open KRS Majors </button>

					                              
              
					                            </div>
					                        </div>
					                    </div>

					                    <div class="panel-body panel-bordered panel-info text-center clearfix">
							                    <div class="col-sm-4 pad-top">
							                        <div class="text-lg">
							                            <p class="text-5x text-thin text-main"><?= number_format($tot_student); ?></p>
							                        </div>
							                        <p class="text-sm text-bold text-uppercase">Student</p>
							                    </div>
							                    <div class="col-sm-8">
							                       <p class="text-bold">
							                       	School Year : <?= $sy; ?> - <?= $sm; ?> <br>
							                       	Generation : <?= $gen; ?> <br>
								                    College : <?= $code['college']; ?> <br> 
								                    Majors : <?= $code['majors']; ?>
							                       </p>
							                        <ul class="list-unstyled text-center bord-top pad-top mar-no row">
							                            <li class="col-xs-4 col-sm-2">
							                                <span class="text-lg text-semibold text-main"><?= number_format($tot_entry); ?></span>
							                                <p class="text-sm text-muted mar-no">Entry</p>
							                            </li>
							                            <?php
							                        	foreach ($status as $row) {
							                        	@$amount=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		LEFT JOIN master_student_history ON master_student_history.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
														master_student_history.student_history_status='$row' AND
														master_student_history.student_history_school_year='$sy' AND
														master_student_history.student_history_semester='$sm' AND
					                            		account.account_status='Mahasiswa'"));

					                            		?>
							                            <li class="col-xs-4 col-sm-2">
							                                <span class="text-lg text-semibold text-main"><?= number_format($amount); ?></span>
							                                <p class="text-sm text-muted mar-no"><?= $row; ?></p>
							                            </li>
							                            <?php } ?>
							                        </ul>
							                    </div>
							                </div>
							                <br>

					                   

					                    <div class="table-responsive">
					                       <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Photo</th>
					                                    <th>NIM</th>
					                                    <th>Name</th>
					                                    <th>Gender</th>
					                                    <th>Advisor</th>
					                                    <th>Status</th>
					                                    <th>Open KRS</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM student_open_krs
					                            		LEFT JOIN master_student ON master_student.student_nim=student_open_krs.student_nim
					                            		LEFT JOIN account on account.account_id=master_student.account_id

					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		student_open_krs.student_school_year='$sy' AND
					                            		student_open_krs.student_semester='$sm'");
					                            	while ($row=mysqli_fetch_array($data)) {

					                            		$status=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_history
					                            			WHERE student_nim='$row[student_nim]' AND
					                            			student_history_school_year='$sy' AND
					                            			student_history_semester='$sm'"));
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><img src="assets/account_photo/<?= $row['account_photo']; ?>" alt="" style="width: 50px;"></td>
					                                    <td><?= $row['student_nim']; ?></td>
					                                    <td><?= $row['student_name']; ?></td>
					                                    <td><?= $row['student_gender']; ?></td>
					                                    <td><?= $row['student_advisor']; ?></td>
					                                    <td><?= $status['student_history_status']; ?></td>
					                                    <td>Start : <?= $row['open_start_date']; ?><br>
					                                    	End : <?= $row['open_end_date']; ?></td>
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
				        <h4 class="modal-title">Filter Student</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="student_open_krs">
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
					                        	Generation <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="gen" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$start=date('Y')-2;
					                            	$end=date('Y')+1;
					                            	for ($i=$start; $i <= $end ; $i++) { 
					                            		$generation=$i."/".($i+1);
					                            		if ($generation==$gen) {
					                            	?>
					                            		<option value="<?= $generation; ?>" selected><?= $generation; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $generation; ?>"><?= $generation; ?></option>
					                            	 <?php } } ?>
					                            	
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


				<div id="open_student" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Open KRS Student</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="open_student">
				      <input type="hidden" name="student_school_year" value="<?= $sy; ?>">
				      <input type="hidden" name="student_semester" value="<?= $sm; ?>">
				      <input type="hidden" name="student_generation" value="<?= $gen; ?>">
				      <input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
				      <input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
				      <div class="modal-body">

				      					<div class="alert alert-info">
				      						School Year : <?= $sy; ?> <br>
					                    	Semester : <?= $sm; ?> <br>
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>

						                <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Student Status <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="student_status" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM student_status");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            	?>					                            		
					                            		<option value="<?= $opt['student_status']; ?>"><?= $opt['student_status']; ?></option>
					                            	<?php } ?>
					                            </select>
					                        </div>
					                    </div>

						                <div class="form-group">
					                       <label class="col-lg-3 control-label">Start Date, Time</label>
					                       <div class="col-lg-9 pad-no">
					                             <div class="clearfix">					                             
					                            <div class="col-lg-4">
					                                <div id="demo-dp-txtinput">
										                <input type="text" placeholder="Date" name="start_date" autocomplete="off" class="form-control" required>
										            </div>	
					                            </div>
					                            <div class="col-lg-4">
					                                    <input type="text" placeholder="hh:ii" name="start_time" class="form-control" required>
					                            </div>
					                           </div>
					                        </div>
					                     </div>


					                    <div class="form-group">
					                       <label class="col-lg-3 control-label">End Date, Time</label>
					                       <div class="col-lg-9 pad-no">
					                             <div class="clearfix">					                             
					                            <div class="col-lg-4">
					                                <div id="demo-dp-txtinput">
										                <input type="text" placeholder="Date" name="end_date" autocomplete="off" class="form-control" required>
										            </div>	
					                            </div>
					                            <div class="col-lg-4">
					                                    <input type="text" placeholder="hh:ii" name="end_time" class="form-control" required>
					                            </div>
					                           </div>
					                        </div>
					                     </div>

				      					
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	NIM | Status | Name Student <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Search by nim / name" autocomplete="off" required/>  
          										<div id="student_nameList"></div>

					                        </div>
					                    </div>

					                    <div class="form-group">
					                       <label class="col-lg-3 control-label"></label>
					                       <div class="col-lg-9 pad-no">
					                           <input type="checkbox" name="change" value="1">
										        change existing data    
					                        </div>
					                     </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Open</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>


				<div id="open_majors" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Open KRS Majors</h4>
				      </div>
				      <form id="action_majors" class="form-horizontal" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="open_majors">
				      <input type="hidden" name="student_school_year" value="<?= $sy; ?>">
				      <input type="hidden" name="student_semester" value="<?= $sm; ?>">
				      <input type="hidden" name="student_generation" value="<?= $gen; ?>">
				      <input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
				      <input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
				      <div class="modal-body">

				      					<div class="alert alert-info">
				      						School Year : <?= $sy; ?> <br>
					                    	Semester : <?= $sm; ?> <br>
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>


						                <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Student Status <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="student_status" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM student_status");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            	?>					                            		
					                            		<option value="<?= $opt['student_status']; ?>"><?= $opt['student_status']; ?></option>
					                            	<?php } ?>
					                            </select>
					                        </div>
					                    </div>
				      					
					                    <div class="form-group">
					                       <label class="col-lg-3 control-label">Start Date, Time</label>
					                       <div class="col-lg-9 pad-no">
					                             <div class="clearfix">					                             
					                            <div class="col-lg-4">
					                                <div id="demo-dp-txtinput">
										                <input type="text" placeholder="Date" name="start_date" autocomplete="off" class="form-control" required>
										            </div>	
					                            </div>
					                            <div class="col-lg-4">
					                                    <input type="text" placeholder="hh:ii" name="start_time" class="form-control" required>
					                            </div>
					                           </div>
					                        </div>
					                     </div>


					                    <div class="form-group">
					                       <label class="col-lg-3 control-label">End Date, Time</label>
					                       <div class="col-lg-9 pad-no">
					                             <div class="clearfix">					                             
					                            <div class="col-lg-4">
					                                <div id="demo-dp-txtinput">
										                <input type="text" placeholder="Date" name="end_date" autocomplete="off" class="form-control" required>
										            </div>	
					                            </div>
					                            <div class="col-lg-4">
					                                    <input type="text" placeholder="hh:ii" name="end_time" class="form-control" required>
					                            </div>
					                           </div>
					                        </div>
					                     </div>

					                     <div class="form-group">
					                       <label class="col-lg-3 control-label"></label>
					                       <div class="col-lg-9 pad-no">
					                           <input type="checkbox" name="change" value="1">
										        change existing data    
					                        </div>
					                     </div>

				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Open</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>


                <?php 
                break;
                
                } ?>

            </div>



