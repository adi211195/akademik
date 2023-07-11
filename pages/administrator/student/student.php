			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Student</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Student</li>
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
                } else {
                	$majors_code	=htmlspecialchars(@$_GET['code']);
                	$gen 			=htmlspecialchars(@$_GET['gen']);
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
					                            		WHERE majors_code='$majors_code'"));
                }

                $page_input="page.php?p=student&act=input&code=".$code['majors_code']."&gen=".$gen;
                $page_edit="page.php?p=student&act=edit&code=".$code['majors_code']."&gen=".$gen;
                $page_detail="page.php?p=student&act=detail&code=".$code['majors_code']."&gen=".$gen;
                $page_additional="page.php?p=student&act=additional&code=".$code['majors_code']."&gen=".$gen;

                $back="page.php?p=student&code=".$code['majors_code']."&gen=".$gen;
                $action="pages/administrator/student/action.php";
                $pages="pages/administrator/student/";
                $status=array('Active','Non Active','Leave','Exit','Graduated');


                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
				default:
				@$tot_student=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		account.account_status='Mahasiswa'"));

				@$tot_block=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
														account.account_block='Yes' AND
					                            		account.account_status='Mahasiswa'"));

				$mcurriculum=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum order by curriculum_school_year, curriculum_semester desc"));
				$sy=$mcurriculum['curriculum_school_year'];
				
				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Student Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                            	<a href="<?= $page_input; ?>">
					                                <button class="btn btn-purple"><i class="demo-pli-add icon-fw"></i>Add</button></a> 

					                                <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>

					                                <div class="btn-group">
							                            <div class="dropdown">
							                                <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" type="button">
							                                    Setting <i class="dropdown-caret"></i>
							                                </button>
							                                <ul class="dropdown-menu dropdown-menu-right">
							                                    <li class="dropdown-header">List Setting</li>							                                   
							                                    <li><a href="#" data-toggle="modal" data-target="#sks">Change SKS Majors</a></li>
							                                    <li><a href="#" data-toggle="modal" data-target="#import">Import Student</a></li>
							                                </ul>
							                            </div>
							                        </div>

							                        <div class="btn-group">
							                            <div class="dropdown">
							                                <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
							                                    Print <i class="dropdown-caret"></i>
							                                </button>
							                                <ul class="dropdown-menu dropdown-menu-right">
							                                    <li class="dropdown-header">List Print</li>
							                                    <li><a href="#" data-toggle="modal" data-target="#student_card">Student Card</a></li>                              
							                                    <li class="divider"></li>
							                                    <li class="dropdown-header">List Student</li>
							                                    <li><a href="#" data-toggle="modal" data-target="#student_pdf">PDF</a></li>
							                                    <li><a href="#" data-toggle="modal" data-target="#student_excel">Excel</a></li>
							                                </ul>
							                            </div>
							                        </div>


              
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
							                       	Generation : <?= $gen; ?> <br>
								                    College : <?= $code['college']; ?> <br> 
								                    Majors : <?= $code['majors']; ?>
							                       </p>
							                        <ul class="list-unstyled text-center bord-top pad-top mar-no row">
							                        	<?php
							                        	foreach ($status as $row) {
							                        	@$amount=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		LEFT JOIN master_student_history ON master_student_history.student_nim=master_student.student_nim
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
														master_student_history.student_history_status='$row' AND
														master_student_history.student_history_school_year='$open_sy' AND
														master_student_history.student_history_semester='$open_sm' AND
					                            		account.account_status='Mahasiswa'"));

					                            		?>
							                            <li class="col-xs-4 col-sm-2">
							                                <span class="text-lg text-semibold text-main"><?= number_format($amount); ?></span>
							                                <p class="text-sm text-muted mar-no"><?= $row; ?></p>
							                            </li>
							                            <?php } ?>

							                            <li class="col-xs-4 col-sm-2">
							                                <span class="text-lg text-semibold text-main"><?= number_format($tot_block); ?></span>
							                                <p class="text-sm text-muted mar-no">Block</p>
							                            </li>

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
					                                    <th>username </th>
					                                    <th>NIM</th>
					                                    <th>Name</th>
					                                    <th>Gender</th>
					                                    <th>Status</th>
					                                    <th>Block</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$create_date	=date('Y-m-d H:i:s');
					                            	$data=mysqli_query($connect, "SELECT * FROM master_student WHERE account_id=''");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            		$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
														// Genrate ID
														$genid=substr(str_shuffle($genrate_id), 0, 14);
														$password=MD5($row['student_nim']);
														$save=mysqli_query($connect, "INSERT INTO account (
																account_id,
																account_block,
																account_photo,
																account_password,
																account_username,
																account_email,
																account_status,
																create_date)
														VALUES ('$genid',
																'No',
																'',
																'$password',
																'$row[student_nim]',
																'',
																'Mahasiswa',
																'$create_date')");

														$update=mysqli_query($connect,"UPDATE master_student SET 
															account_id='$genid'
															WHERE student_nim='$row[student_nim]'");

					                            	}

					                            	$data=mysqli_query($connect, "SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		account_status='Mahasiswa'");
					                            	while ($row=mysqli_fetch_array($data)) {

					                            		$status=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_history
					                            			WHERE student_nim='$row[student_nim]' AND
					                            			student_history_school_year='$open_sy' AND
					                            			student_history_semester='$open_sm'"));
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><img src="assets/account_photo/<?= $row['account_photo']; ?>" alt="" style="width: 50px;"></td>
					                                    <td><?= $row['account_username']; ?></td>
					                                    <td><?= $row['student_nim']; ?></td>
					                                    <td><?= $row['student_name']; ?></td>
					                                    <td><?= $row['student_gender']; ?></td>
					                                    <td><?= $status['student_history_status']; ?></td>
					                                    <td><?= $row['account_block']; ?></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['account_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['account_id']; ?>">
						                               		 <button class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button></a> 

						                               		 <a href="<?= $page_detail; ?>&id=<?= $row['account_id']; ?>">
						                               		 <button class="btn btn-success" title="Detail"><i class="fa fa-list"></i></button></a> 

						                               		<a href="<?= $page_additional; ?>&id=<?= $row['account_id']; ?>">
						                               		 <button class="btn btn-default" title="Additional"><i class="fa fa-plus"></i></button></a> 
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
				        <h4 class="modal-title">Filter Student</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="student">
				      <div class="modal-body">
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


				<div id="sks" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Change Student SKS</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="sks">
				      <input type="hidden" name="student_generation" value="<?= $gen; ?>">
				      <input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
				      <input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
				      <div class="modal-body">

				      					<div class="alert alert-info">
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>
				      					
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Max SKS <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="number" name="student_sks" class="form-control" value="0" required>
					                        </div>
					                    </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Change</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>


				<div id="import" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Import Student</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="import">
				      <input type="hidden" name="student_generation" value="<?= $gen; ?>">
				      <input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
				      <input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
				      <div class="modal-body">

				      					<div class="alert alert-info">
					                    	* Format File .xls
						                </div>
				      					
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	File <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="file" name="file" id="file" accept=".xls">
					                        </div>
					                    </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-import"></i> Import</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>


				<div id="student_card" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Print Student Card</h4>
				      </div>
				      <form class="form-horizontal" method="POST" action="<?= $pages; ?>report_pdf_card.php" target="_blank" enctype="multipart/form-data">
				      <input type="hidden" name="student_generation" value="<?= $gen; ?>">
				      <input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
				      <input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
				      <div class="modal-body">

				      					<div class="alert alert-info">
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>
				      					
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
					                        	Place of Study <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="place" class="form-control" required>
					                        </div>
					                    </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>


				<div id="student_pdf" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Print Student PDF</h4>
				      </div>
				      <form class="form-horizontal" method="POST" action="<?= $pages; ?>report_pdf.php" target="_blank" enctype="multipart/form-data">
				      <input type="hidden" name="student_generation" value="<?= $gen; ?>">
				      <input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
				      <input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
				      <div class="modal-body">

				      					<div class="alert alert-info">
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>
				      					
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
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>



				<div id="student_excel" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Print Student Excel</h4>
				      </div>
				      <form class="form-horizontal" method="POST" action="<?= $pages; ?>report_excel.php" target="_blank" enctype="multipart/form-data">
				      <input type="hidden" name="student_generation" value="<?= $gen; ?>">
				      <input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
				      <input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
				      <div class="modal-body">

				      					<div class="alert alert-info">
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>
				      					
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
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>


                <?php 
                break;
                case 'input':
               	?>

               	<div id="page-content">
               		<div class="panel">
               			<div class="panel-body">
               			<div class="alert alert-info">
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>
						               </div>

					    <div class="eq-height clearfix">
					        <div class="col-md-3 eq-box-md text-center box-vmiddle-wrap bord-hor">
					
					            <!-- Simple Promotion Widget -->
					            <!--===================================================-->
					            <div class="box-vmiddle pad-all">
					                <h3 class="text-main">Add Student</h3>
					                <div class="pad-ver">
					                    <i class="demo-pli-bag-coins icon-5x"></i>
					                </div>
					                <i class="demo-pli-male icon-2x"></i>
					            </div>
					            <!--===================================================-->
					
					        </div>

					        <div class="col-md-9 eq-box-md eq-no-panel">
					
					            <!-- Main Form Wizard -->
					            <!--===================================================-->
					            <div id="demo-bv-wz">
					                <div class="wz-heading pad-top">
					
					                    <!--Nav-->
					                    <ul class="row wz-step wz-icon-bw wz-nav-off mar-top">
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab1">
					                                <span class="text-danger"><i class="demo-pli-information icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Account</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab2">
					                                <span class="text-warning"><i class="demo-pli-male icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Profile</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab3">
					                                <span class="text-info"><i class="demo-pli-home icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Address</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab4">
					                                <span class="text-success"><i class="demo-pli-medal-2 icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Finish</p>
					                            </a>
					                        </li>
					                    </ul>
					                </div>
					
					                <!--progress bar-->
					                <div class="progress progress-xs">
					                    <div class="progress-bar progress-bar-primary"></div>
					                </div>
					
					
					                <!--Form-->
					                <div id="demo-bv-wz-form">
					                <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					                    <input type="hidden" name="action" value="input">
					                    <input type="hidden" name="student_generation" value="<?= $gen; ?>">
					                    <input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
					                    <input type="hidden" name="college_code" value="<?= $code['college_code']; ?>">
					                    <div class="panel-body">
					                        <div class="tab-content">
					
					                            <!--First tab-->
					                           <div id="demo-bv-tab1" class="tab-pane">	

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">username</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" class="form-control" name="account_username" placeholder="username" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Password</label>
					                                    <div class="col-lg-9">
					                                        <input type="password" class="form-control" name="account_password" placeholder="Password" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Email address</label>
					                                    <div class="col-lg-9">
					                                        <input type="email" class="form-control" name="account_email" placeholder="Email" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Block</label>
					                                    <div class="col-lg-2">
					                                        <select class="form-control" name="account_block">
					                                        	<option value="No">No</option>
					                                        	<option value="Yes">Yes</option>
					                                        </select>
					                                    </div>
					                                </div>


					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Photo</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="account_photo"  required>
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Second tab-->
					                            <div id="demo-bv-tab2" class="tab-pane">
					                                
					                            	<div class="form-group">
					                                    <label class="col-lg-2 control-label">NIM</label>
					                                    <div class="col-lg-9">
					                                        <input type="number" placeholder="NIM" name="student_nim" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NIK</label>
					                                    <div class="col-lg-9">
					                                        <input type="number" placeholder="NIK" name="student_nik" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NISN</label>
					                                    <div class="col-lg-9">
					                                        <input type="number" placeholder="NISN" name="student_nisn" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NPWP</label>
					                                    <div class="col-lg-9">
					                                        <input type="number" placeholder="NPWP" name="student_npwp" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="student_name" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Phone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Phone number" name="student_phone" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Handphone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Handphone number" name="student_handphone" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Date of birth</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                                <input type="text" placeholder="Place" name="student_place_birth" class="form-control" required>
					                                            </div>
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="student_date_birth" autocomplete="off" class="form-control" required>
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Gender</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="student_gender" value="Male" required>
					                                            <label for="demo-radio-1">Male</label>
					
					                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="student_gender" value="Female" required>
					                                            <label for="demo-radio-2">Female</label>
					
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Status</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                            <input id="demo-radio-3" class="magic-radio" type="radio" name="student_status" value="Single" required>
					                                            <label for="demo-radio-3">Single</label>
					
					                                            <input id="demo-radio-4" class="magic-radio" type="radio" name="student_status" value="Married" required>
					                                            <label for="demo-radio-4">Married</label>
					
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Religion</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Religion" name="student_religion" class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">KPS</label>
					                                    <div class="col-lg-2">
					                                        <select class="form-control" name="student_kps">
					                                        	<option value="No">No</option>
					                                        	<option value="Yes">Yes</option>
					                                        </select>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Number KPS</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Number KPS" name="student_no_kps" class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">College Entry Date</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="student_college_entry_date" autocomplete="off" class="form-control" required>
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Start Semester</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Start Semester" name="student_start_semester" class="form-control" >
					                                    </div>
					                                </div>	
					                            </div>
					
					                            <!--Third tab-->
					                            <div id="demo-bv-tab3" class="tab-pane">
					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Type of Stay</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Type of Stay" name="student_type_stay" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Type of financing</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Type of financing" name="student_type_of_financing" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Means of transportation</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Means of transportation" name="student_transportation" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Register Path</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Register Path" name="student_registration_path" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Citizenship</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Citizenship" name="student_citizenship" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Registration Type</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Register Type" name="student_registration_type" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="student_address" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">RT - Rw </label>
					                                    <div class="col-lg-2">
					                                        <input type="number" placeholder="RT" name="student_address_rt" class="form-control">
					                                    </div>
					                                    <div class="col-lg-2">
					                                    	<input type="number" placeholder="RW" name="student_address_rw" class="form-control">
					                                    </div>
					                                        
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Village</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="Village" name="student_address_village" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Ward</label></div>
					                                            <div class="col-lg-5"><input type="text" placeholder="Ward" name="student_address_ward" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">District</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="District" name="student_address_district" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">City</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="City" name="student_city" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Poscode</label></div>
					                                            <div class="col-lg-5"><input type="text" placeholder="Poscode" name="student_poscode" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Fourth tab-->
					                            <div id="demo-bv-tab4" class="tab-pane">
					                                <h4>Thank you</h4>
					                                <p>Click the finish button to complete the registration. </p>
					                            </div>
					                        </div>
					                    </div>
					
					
					                    <!--Footer buttons-->
					                    <div class="pull-right pad-rgt mar-btm">
					                    	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                        <button type="button" class="previous btn btn-success">Previous</button>
					                        <button type="button" class="next btn btn-success">Next</button>
					                        <button type="submit" class="finish btn btn-primary" disabled>Finish</button>
					                    </div>
					
					                </form>
					            	</div>
					            </div>
					            <!--===================================================-->
					            <!-- End of Main Form Wizard -->
					
					        </div>
					    </div>
					</div>
               	</div>

                <?php	break;
                case 'edit':
                $id 		=htmlspecialchars($_GET['id']);
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_student ON master_student.account_id=account.account_id
                	where account.account_id='$id'"));
                ?><div id="page-content">
               		<div class="panel">

               			<div class="panel-body">
               			<div class="alert alert-info">
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>
						               </div>

					    <div class="eq-height clearfix">
					        <div class="col-md-3 eq-box-md text-center box-vmiddle-wrap bord-hor">
					
					            <!-- Simple Promotion Widget -->
					            <!--===================================================-->
					            <div class="box-vmiddle pad-all">
					                <h3 class="text-main">Edit Student</h3>
					                <div class="pad-ver">
					                    <i class="demo-pli-bag-coins icon-5x"></i>
					                </div>
					                <i class="demo-pli-male icon-2x"></i>
					            </div>
					            <!--===================================================-->
					
					        </div>

					        <div class="col-md-9 eq-box-md eq-no-panel">
					
					            <!-- Main Form Wizard -->
					            <!--===================================================-->
					            <div id="demo-bv-wz">
					                <div class="wz-heading pad-top">
					
					                    <!--Nav-->
					                    <ul class="row wz-step wz-icon-bw wz-nav-off mar-top">
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab1">
					                                <span class="text-danger"><i class="demo-pli-information icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Account</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab2">
					                                <span class="text-warning"><i class="demo-pli-male icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Profile</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab3">
					                                <span class="text-info"><i class="demo-pli-home icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Address</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab4">
					                                <span class="text-success"><i class="demo-pli-medal-2 icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Finish</p>
					                            </a>
					                        </li>
					                    </ul>
					                </div>
					
					                <!--progress bar-->
					                <div class="progress progress-xs">
					                    <div class="progress-bar progress-bar-primary"></div>
					                </div>
					
					
					                <!--Form-->
					                <div id="demo-bv-wz-form">
					                <form  class="form-horizontal action" method="POST" enctype="multipart/form-data">
					                    <input type="hidden" name="action" value="edit">
					                    <input type="hidden" name="id" value="<?= $row['account_id']; ?>">
					                    <div class="panel-body">
					                        <div class="tab-content">
					
					                            <!--First tab-->
					                           <div id="demo-bv-tab1" class="tab-pane">
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">username</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" class="form-control" name="account_username" placeholder="username" value="<?= $row['account_username']; ?>" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Password</label>
					                                    <div class="col-lg-9">
					                                        <input type="password" class="form-control" name="account_password" placeholder="Password">
					                                        *filled if you want to be replaced
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Email address</label>
					                                    <div class="col-lg-9">
					                                        <input type="email" class="form-control" name="account_email" placeholder="Email" value="<?= $row['account_email']; ?>"  required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Block</label>
					                                    <div class="col-lg-2">
					                                        <select class="form-control" name="account_block">
					                                        <?php if ($row['account_block']=="No") { ?>
					                                        	<option value="No">No</option>
					                                        	<option value="Yes">Yes</option>
					                                        <?php } else { ?>
					                                        	<option value="Yes">Yes</option>
					                                        	<option value="No">No</option>
					                                        <?php } ?>
					                                        </select>
					                                    </div>
					                                </div>

					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Photo</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="account_photo">
					                                        *filled if you want to be replaced
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Second tab-->
					                            <div id="demo-bv-tab2" class="tab-pane">
					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NIM</label>
					                                    <div class="col-lg-9">
					                                        <input type="number" placeholder="NIM" name="student_nim" value="<?= $row['student_nim']; ?>" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NIK</label>
					                                    <div class="col-lg-9">
					                                        <input type="number" placeholder="NIK" name="student_nik" value="<?= $row['student_nik']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NISN</label>
					                                    <div class="col-lg-9">
					                                        <input type="number" placeholder="NISN" name="student_nisn" value="<?= $row['student_nisn']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NPWP</label>
					                                    <div class="col-lg-9">
					                                        <input type="number" placeholder="NPWP" name="student_npwp" value="<?= $row['student_npwp']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="student_name" value="<?= $row['student_name']; ?>"  class="form-control" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Phone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Phone number" name="student_phone" value="<?= $row['student_phone']; ?>"class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Handphone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Handphone number" name="student_handphone" value="<?= $row['student_handphone']; ?>" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Date of birth</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                                <input type="text" placeholder="Place" name="student_place_birth" value="<?= $row['student_place_birth']; ?>" class="form-control" required>
					                                            </div>
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="student_date_birth" value="<?= $row['student_date_birth']; ?>" autocomplete="off" class="form-control" required>
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Gender</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                        	<?php if ($row['student_gender']=="Male") { ?>
						                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="student_gender" value="Male" checked="checked" required>
						                                            <label for="demo-radio-1">Male</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="student_gender" value="Female" required>
						                                            <label for="demo-radio-2">Female</label>
					                                            <?php } else { ?>
					                                            	<input id="demo-radio-1" class="magic-radio" type="radio" name="student_gender" value="Male" required>
						                                            <label for="demo-radio-1">Male</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="student_gender" value="Female" checked="checked"  required>
						                                            <label for="demo-radio-2">Female</label>
					                                            <?php } ?>
					
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Status</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                        	<?php if ($row['student_status']=="Single") { ?>
					                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="student_status" value="Single" checked="checked" required>
					                                            <label for="demo-radio-1">Single</label>
					
					                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="student_status" value="Married" required>
					                                            <label for="demo-radio-2">Married</label>

					                                           <?php } else { ?>
					                                           	<input id="demo-radio-1" class="magic-radio" type="radio" name="student_status" value="Single" required>
					                                            <label for="demo-radio-1">Single</label>
					
					                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="student_status" value="Married" checked="checked" required>
					                                            <label for="demo-radio-2">Married</label>

					                                           <?php } ?>
					
					                                        </div>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">KPS</label>
					                                    <div class="col-lg-2">
					                                        <select class="form-control" name="student_kps">
					                                        	<?php if ($row['student_kps']=="No") { ?>
						                                        	<option value="No">No</option>
						                                        	<option value="Yes">Yes</option>
						                                        <?php } else { ?>
						                                        	<option value="Yes">Yes</option>
						                                        	<option value="No">No</option>
						                                        <?php } ?>
					                                        </select>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Number KPS</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Number KPS" name="student_no_kps" value="<?= $row['student_no_kps']; ?>" class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">College Entry Date</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="student_college_entry_date" value="<?= $row['student_college_entry_date']; ?>" autocomplete="off" class="form-control" required>
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Start Semester</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Start Semester" name="student_start_semester" value="<?= $row['student_start_semester']; ?>" class="form-control" >
					                                    </div>
					                                </div>

					                            </div>
					
					                            <!--Third tab-->
					                            <div id="demo-bv-tab3" class="tab-pane">
					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Type of Stay</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Type of Stay" name="student_type_stay" value="<?= $row['student_type_stay']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Type of Financing</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Type of financing" name="student_type_of_financing" value="<?= $row['student_type_of_financing']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Means of transportation</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Means of transportation" name="student_transportation" value="<?= $row['student_transportation']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Register Path</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Register Path" name="student_registration_path" value="<?= $row['student_registration_path']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Citizenship</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Citizenship" name="student_citizenship" value="<?= $row['student_citizenship']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Registration Type</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Register Type" name="student_registration_type" value="<?= $row['']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="student_address" value="<?= $row['student_registration_type']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">RT - Rw </label>
					                                    <div class="col-lg-2">
					                                        <input type="number" placeholder="RT" name="student_address_rt" value="<?= $row['student_address_rt']; ?>" class="form-control">
					                                    </div>
					                                    <div class="col-lg-2">
					                                    	<input type="number" placeholder="RW" name="student_address_rw" value="<?= $row['student_address_rw']; ?>" class="form-control">
					                                    </div>
					                                        
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Village</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="Village" name="student_address_village" value="<?= $row['student_address_village']; ?>" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Ward</label></div>
					                                            <div class="col-lg-5"><input type="text" placeholder="Ward" name="student_address_ward" value="<?= $row['student_address_ward']; ?>" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">District</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="District" name="student_address_district" value="<?= $row['student_address_district']; ?>" class="form-control">
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">City</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="City" name="student_city" value="<?= $row['student_city']; ?>"class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Poscode</label></div>
					                                            <div class="col-lg-4"><input type="text" placeholder="Poscode" name="student_poscode" value="<?= $row['student_poscode']; ?>" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Fourth tab-->
					                            <div id="demo-bv-tab4" class="tab-pane">
					                                <h4>Thank you</h4>
					                                <p>Click the finish button to complete the registration. </p>
					                            </div>
					                        </div>
					                    </div>
					
					
					                    <!--Footer buttons-->
					                    <div class="pull-right pad-rgt mar-btm">
					                    	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                        <button type="button" class="previous btn btn-success">Previous</button>
					                        <button type="button" class="next btn btn-success">Next</button>
					                        <button type="submit" class="finish btn btn-primary" disabled>Finish</button>
					                    </div>
					
					                </form>
					            	</div>
					            </div>
					            <!--===================================================-->
					            <!-- End of Main Form Wizard -->
					
					        </div>
					    </div>
					</div>
               	</div>


                <?php	break;
                case 'additional':
                	include "pages/administrator/student/additional.php";
                	break;
                
				case 'detail':
					include "pages/administrator/student/detail.php";
					break;
                } ?>

            </div>



