			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Access Student</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Access Student</li>
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

                $page_input="page.php?p=student_access&act=input&code=".$code['majors_code']."&gen=".$gen."&sy=".$sy."&sm=".$sm;
                $page_edit="page.php?p=student_access&act=edit&code=".$code['majors_code']."&gen=".$gen."&sy=".$sy."&sm=".$sm;
                $back="page.php?p=student_access&code=".$code['majors_code']."&gen=".$gen."&sy=".$sy."&sm=".$sm;
                $action="pages/administrator/student_access/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:

				@$tot_student=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		account.account_status='Mahasiswa'"));

				@$tot_entry=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN master_student_access ON master_student_access.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		account.account_status='Mahasiswa'"));

				@$tot_male=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN master_student_access ON master_student_access.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
														master_student.student_gender='Male' AND
					                            		account.account_status='Mahasiswa'"));

				@$tot_female=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		INNER JOIN master_student_access ON master_student_access.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
														master_student.student_gender='Female' AND
					                            		account.account_status='Mahasiswa'"));

				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Access Student Data </h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">

					                                <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>

					                                <button class="btn btn-primary" data-toggle="modal" data-target="#open_student"><i class="fa fa-plus"></i> Access Student </button>
					                              
              
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
								                    Majors : <?= $code['majors']; ?> <br>
								                    <span style="color: red;">0 : Open | 1 : Block *remove data to disable block access</span>
							                       </p>
							                        <ul class="list-unstyled text-center bord-top pad-top mar-no row">
							                            <li class="col-xs-4">
							                                <span class="text-lg text-semibold text-main"><?= number_format($tot_entry); ?></span>
							                                <p class="text-sm text-muted mar-no">Entry</p>
							                            </li>
							                            <li class="col-xs-4">
							                                <span class="text-lg text-semibold text-main"><?= number_format($tot_male); ?></span>
							                                <p class="text-sm text-muted mar-no">Male</p>
							                            </li>
							                            <li class="col-xs-4">
							                                <span class="text-lg text-semibold text-main"><?= number_format($tot_female); ?></span>
							                                <p class="text-sm text-muted mar-no">Female</p>
							                            </li>
							                        </ul>
							                    </div>
							                </div>
							                <br>

					                   

					                    <div class="table-responsive">
					                       <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th rowspan="2">No</th>
					                                    <th rowspan="2">Photo</th>
					                                    <th rowspan="2">NIM</th>
					                                    <th rowspan="2">Name</th>
					                                    <th rowspan="2">Gender</th>
					                                    <th colspan="3">Status</th>
					                                    <th rowspan="2"></th>
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
					                            	$data=mysqli_query($connect, "SELECT * FROM master_student_access
					                            		LEFT JOIN master_student ON master_student.student_nim=master_student_access.student_nim
					                            		LEFT JOIN account on account.account_id=master_student.account_id

					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		master_student_access.student_access_school_year='$sy' AND
					                            		master_student_access.student_access_semester='$sm'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><img src="assets/account_photo/<?= $row['account_photo']; ?>" alt="" style="width: 50px;"></td>
					                                    <td><?= $row['student_nim']; ?></td>
					                                    <td><?= $row['student_name']; ?></td>
					                                    <td><?= $row['student_gender']; ?></td>
					                                    <td><?= $row['student_access_uts']; ?></td>
					                                    <td><?= $row['student_access_quiz']; ?></td>
					                                    <td><?= $row['student_access_uas']; ?></td>
					                                    <td><button class="btn btn-danger" id="remove" value="<?= $row['student_access_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button></td>
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
				      <input type="hidden" name="p" value="student_access">
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
				        <h4 class="modal-title">Access Student</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="input">
				      <input type="hidden" name="student_access_school_year" value="<?= $sy; ?>">
				      <input type="hidden" name="student_access_semester" value="<?= $sm; ?>">
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
					                        	NIM | Status | Name Student <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Search by nim / name" autocomplete="off" required/>  
          										<div id="student_nameList"></div>

					                        </div>
					                    </div>

					                    <div class="form-group">
					                       <label class="col-lg-3 control-label"> Block </label>
					                       <div class="col-lg-9 pad-no">
					                       	<div class="checkbox">
								                <input id="demo-remember-me" name="student_access_uts" value="1" class="magic-checkbox" type="checkbox">
								                <label for="demo-remember-me">UTS</label>
								            </div>
								            <div class="checkbox">
								                <input id="demo-remember-me1" name="student_access_quiz" value="1" class="magic-checkbox" type="checkbox">
								                <label for="demo-remember-me1">QUIZ</label>
								            </div>
								            <div class="checkbox">
								                <input id="demo-remember-me2" name="student_access_uas" value="1" class="magic-checkbox" type="checkbox">
								                <label for="demo-remember-me2">UAS</label>
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


                <?php 
                break;
                
                } ?>

            </div>



