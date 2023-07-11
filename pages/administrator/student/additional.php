<?php
$id 		=htmlspecialchars($_GET['id']);
$row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_student ON master_student.account_id=account.account_id
                	INNER JOIN master_student_father ON master_student_father.student_nim=master_student.student_nim
                	INNER JOIN master_student_mother ON master_student_mother.student_nim=master_student.student_nim
                	INNER JOIN master_student_school ON master_student_school.student_nim=master_student.student_nim
                	INNER JOIN master_student_guardian ON master_student_guardian.student_nim=master_student.student_nim
                	where account.account_id='$id'"));
$back2=$back;
$back=$page_additional."&id=".$row['account_id'];
?>

<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Addtional Student</h3>
					            </div>
					            <div class="panel-body">


					            	<div class="row">
							            <div class="col-lg-3 table-responsive">
							                <table class="table table-bordered invoice-summary">
							                    <tbody>
							                        
							                        <tr>
							                            <td>
							                                <strong><?= $code['college']; ?></strong>
							                                <small>College</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $code['majors']; ?></strong>
							                                <small>Majors</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['student_nim']; ?> </strong>
							                                <small>NIM</small>
							                            </td>					                            
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['student_name']; ?></strong>
							                                <small>Name</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['student_gender']; ?></strong>
							                                <small>Gender</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['student_place_birth']; ?>, <?= $row['student_date_birth']; ?></strong>
							                                <small>Place, Date Birth</small>
							                            </td>
							                        </tr>
							                        
							                    </tbody>
							                </table>
							            </div>


							            <div class="col-lg-9">
							            	<form  class="form-horizontal action" method="POST" enctype="multipart/form-data">
							            		<input type="hidden" name="action" value="addtional">
							            		<input type="hidden" name="id" value="<?= $row['student_nim']; ?>">

							            		<div class="panel panel-info">
									            <div class="panel-heading">
									                <h3 class="panel-title">School</h3>
									            </div>
									            <div class="panel-body">
									                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="school_name" value="<?= $row['school_name']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="school_address" value="<?= $row['school_address']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">District</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="District" name="school_district" value="<?= $row['school_district']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Majors</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Majors" name="school_majors" value="<?= $row['school_majors']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Study Program</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Study Program" name="school_study_program" value="<?= $row['school_study_program']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Graduation Year</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Graduation Year" name="school_graduation_year" value="<?= $row['school_graduation_year']; ?>"class="form-control" >
					                                    </div>
					                                </div>


									            </div>
									        </div>

							            	<div class="panel panel-info">
									            <div class="panel-heading">
									                <h3 class="panel-title">Father</h3>
									            </div>
									            <div class="panel-body">
									                <div class="form-group">
					                                    <label class="col-lg-3 control-label">NIK</label>
					                                    <div class="col-lg-9">
					                                        <input type="number" placeholder="NIK" name="father_nik" value="<?= $row['father_nik']; ?>" class="form-control">
					                                    </div>
					                                </div>
													<div class="form-group">
					                                    <label class="col-lg-3 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="father_name" value="<?= $row['father_name']; ?>"  class="form-control" >
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Phone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Phone number" name="father_phone" value="<?= $row['father_phone']; ?>"class="form-control" >
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Handphone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Handphone number" name="father_handphone" value="<?= $row['father_handphone']; ?>"class="form-control" >
					                                    </div>
					                                </div>

													<div class="form-group">
					                                    <label class="col-lg-3 control-label">Date of birth</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="father_date_birth" value="<?= $row['father_date_birth']; ?>" autocomplete="off" class="form-control" >
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="father_address" value="<?= $row['father_address']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Districts</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Districts" name="father_districts" value="<?= $row['father_districts']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Education</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Education" name="father_education" value="<?= $row['father_education']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Profession</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Profession" name="father_profession" value="<?= $row['father_profession']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Income</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Income" name="father_income" value="<?= $row['father_income']; ?>"class="form-control" >
					                                    </div>
					                                </div>


									            </div>
									        </div>


									        <div class="panel panel-info">
									            <div class="panel-heading">
									                <h3 class="panel-title">Mother</h3>
									            </div>
									            <div class="panel-body">
									                <div class="form-group">
					                                    <label class="col-lg-3 control-label">NIK</label>
					                                    <div class="col-lg-9">
					                                        <input type="number" placeholder="NIK" name="mother_nik" value="<?= $row['mother_nik']; ?>" class="form-control">
					                                    </div>
					                                </div>
													<div class="form-group">
					                                    <label class="col-lg-3 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="mother_name" value="<?= $row['mother_name']; ?>"  class="form-control" >
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Phone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Phone number" name="mother_phone" value="<?= $row['mother_phone']; ?>"class="form-control" >
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Handphone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Handphone number" name="mother_handphone" value="<?= $row['mother_handphone']; ?>"class="form-control" >
					                                    </div>
					                                </div>

													<div class="form-group">
					                                    <label class="col-lg-3 control-label">Date of birth</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="mother_date_birth" value="<?= $row['mother_date_birth']; ?>" autocomplete="off" class="form-control" >
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="mother_address" value="<?= $row['mother_address']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Districts</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Districts" name="mother_districts" value="<?= $row['mother_districts']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Education</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Education" name="mother_education" value="<?= $row['mother_education']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Profession</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Profession" name="mother_profession" value="<?= $row['mother_profession']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Income</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Income" name="mother_income" value="<?= $row['mother_income']; ?>"class="form-control" >
					                                    </div>
					                                </div>


									            </div>
									        </div>



											<div class="panel panel-info">
									            <div class="panel-heading">
									                <h3 class="panel-title">Guardian</h3>
									            </div>
									            <div class="panel-body">
													<div class="form-group">
					                                    <label class="col-lg-3 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="guardian_name" value="<?= $row['guardian_name']; ?>"  class="form-control" >
					                                    </div>
					                                </div>
													<div class="form-group">
					                                    <label class="col-lg-3 control-label">Date of birth</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="guardian_date_birth" value="<?= $row['guardian_date_birth']; ?>" autocomplete="off" class="form-control" >
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Education</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Education" name="guardian_education" value="<?= $row['guardian_education']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Profession</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Profession" name="guardian_profession" value="<?= $row['guardian_profession']; ?>"class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-3 control-label">Income</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Income" name="guardian_income" value="<?= $row['guardian_income']; ?>"class="form-control" >
					                                    </div>
					                                </div>


									            </div>
									        </div>


									        <div class="panel-footer text-right">
							                	<a href="<?= $back2; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
							                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
							                </div>

									    </form>
							            </div>


							        </div>

					            </div>

					
					        </div>
					    </div>
               		</div>
               	</div>