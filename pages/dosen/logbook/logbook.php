			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Logbook</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Logbook</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
              
                $page_list="page.php?p=logbook&act=list";
                $back="page.php?p=logbook";
                $action="pages/dosen/logbook/action.php";

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
					                    <h3 class="panel-title">Logbook Data</h3>
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
									                    <th>College</th>
									                    <th>Majors</th>
									                    <th>Logbook</th>
									                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT mcollege.*, mmajors.*, mk.*, ms.*, count(mk.krs_id) as krs FROM master_krs as mk 
					                            		LEFT JOIN master_student as ms ON ms.student_nim=mk.student_nim
					                            		LEFT JOIN master_college as mcollege ON mcollege.college_code=ms.college_code
														LEFT JOIN master_majors as mmajors ON mmajors.majors_code=ms.majors_code
					                            		WHERE 
					                            		mk.krs_school_year='$open_sy' AND
					                            		mk.krs_semester='$open_sm' AND 
					                            		mk.krs_advisor='$lecturer_code' 
					                            		group by mk.student_nim");
					                            	while ($row=mysqli_fetch_array($data)) {					                            		
					                            		$logbook=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_logbook
					                            			WHERE 
						                            		student_nim='$row[student_nim]' AND
						                            		lecturer_code='$lecturer_code'"));
					                            	?>

					                                <tr>
					                                	<td><?= $no; ?></td>
					                                    <td><?= $row['student_nim']; ?></td>
									                    <td><?= $row['student_name']; ?></td>
									                    <td><?= $row['college']; ?></td>
									                    <td><?= $row['majors']; ?></td>
									                    <td><?= $logbook; ?></td>
									                    <td>
									                    	<a href="<?= $page_list; ?>&nim=<?= $row['student_nim']; ?>">
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
                $nim 		=htmlspecialchars($_GET['nim']);
                $back="page.php?p=logbook&act=list&nim=".$nim;
                $back2="page.php?p=logbook";

                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student as ms
					INNER JOIN master_college as mcollege ON mcollege.college_code=ms.college_code
					INNER JOIN master_majors as mmajors ON mmajors.majors_code=ms.majors_code				
                	where student_nim='$nim'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Details Logbook</h3>
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
							                                 <strong><?= $row['majors']; ?></strong>
							                                <small>Majors</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['student_nim']; ?></strong>
							                                <small>NIM</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['student_name']; ?></strong>
							                                <small>Name</small>
							                            </td>
							                        </tr>
							                       
							                    </tbody>
							                </table>
							            </div>


							            <div class="col-lg-9">
							            	<button class="btn btn-purple" data-toggle="modal" data-target="#page_input"><i class="demo-pli-add icon-fw"></i> Add</button> 

							            	<div class="table-responsive">
							                    <table class="table table-striped">
													<thead>
														<th>No</th>
														<th>Date</th>
														<th>Note</th>
														<th>Information</th>
														<th>Response</th>
														<th></th>
													</thead>
													<tbody>
														<?php
														$nomor=1;
														$log=mysqli_query($connect, "SELECT * FROM master_logbook where 
																      				student_nim='$nim'
																      				ORDER BY logbook_date desc");
														while ($row3=mysqli_fetch_array($log)) {
														?>

														<tr>
															<td><?= $nomor; ?></td>
															<td><?= $row3['logbook_date']; ?></td>
															<td><?= $row3['logbook_note']; ?></td>
															<td><?= $row3['logbook_information']; ?></td>
															<td><?= $row3['logbook_response']; ?></td>
															<td>
																<button class="btn btn-danger" id="remove" value="<?= $row3['logbook_id']; ?>" onclick="data_remove(this.value);" title="Remove">
						                                    	<i class="fa fa-trash"></i>
						                                    	</button>

							                               		 <button class="btn btn-primary" title="Edit" data-toggle="modal" data-target="#page_edit<?= $nomor; ?>"><i class="fa fa-edit"></i></button>


							                               		 <!-- Modal -->
																<div id="page_edit<?= $nomor; ?>" class="modal fade" role="dialog">
																  <div class="modal-dialog">

																    <!-- Modal content-->
																    <div class="modal-content">
																      <div class="modal-header">
																        <h4 class="modal-title">Edit Logbook</h4>
																      </div>
																      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
																      <input type="hidden" name="id" value="<?= $row3['logbook_id']; ?>">
																      <input type="hidden" name="action" value="edit">
																      <div class="modal-body">				        				

																	     <div class="form-group">
																	        <label class="col-sm-3 control-label" >
																	             Date <span class="required">*</span></label>
																	        <div class="col-sm-9">
																	             <div id="demo-dp-txtinput">
																	                 <input type="text" name="logbook_date" autocomplete="off" value="<?= $row3['logbook_date']; ?>" class="form-control">
																	             </div>					                           
																	        </div>
																	    </div>

																	    <div class="form-group">
																	        <label class="col-sm-3 control-label" >
																	            Note <span class="required">*</span></label>
																	        <div class="col-sm-9">
																	            <div id="demo-dp-txtinput">
																	                <textarea name="logbook_note" class="form-control" required><?= $row3['logbook_note']; ?></textarea>  
																	            </div>					                           
																	        </div>
																	     </div>


																	    <div class="form-group">
																	        <label class="col-sm-3 control-label" >
																	            Information <span class="required">*</span></label>
																	        <div class="col-sm-9">
																	            <div id="demo-dp-txtinput">
																	               <textarea name="logbook_information" class="form-control" required><?= $row3['logbook_information']; ?></textarea>
																	             </div>					                           
																	        </div>
																	    </div>


																	    <div class="form-group">
																	        <label class="col-sm-3 control-label" >
																	            Response <span class="required">*</span></label>
																	        <div class="col-sm-9">
																	           <?= $row3['logbook_response']; ?>
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




															</td>
														</tr>
														<?php $nomor++; } ?>
													</tbody>
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



               	<!-- Modal -->
				<div id="page_input" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Add Logbook</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="student_nim" value="<?= $nim; ?>">
				      <input type="hidden" name="action" value="input">
				      <div class="modal-body">				        				

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Date <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <div id="demo-dp-txtinput">
					                                <input type="text" name="logbook_date" autocomplete="off" class="form-control">
					                            </div>					                           
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Note <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <div id="demo-dp-txtinput">
					                                <textarea name="logbook_note" class="form-control" required></textarea>  
					                            </div>					                           
					                        </div>
					                    </div>


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Information <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <div id="demo-dp-txtinput">
					                               <textarea name="logbook_information" class="form-control" required></textarea>
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


               

                <?php	break;
                } ?>

            </div>







