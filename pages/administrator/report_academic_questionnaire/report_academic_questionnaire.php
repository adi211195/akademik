			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Academic Questionnaire Reports</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Academic Questionnaire Reports</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                if (empty(@$_POST['school_year'])) {
                	$school_year	="";
                	$semester 		="";
                } else {
                	$school_year	=htmlspecialchars(@$_POST['school_year']);
                	$semester 		=htmlspecialchars(@$_POST['semester']);

                }

                $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM questionnaire_report_academic
											where school_year='$school_year'
											AND semester='$semester'
											AND qr_status='finish'"));

                $page_input="page.php?p=report_academic_questionnaire&act=input";
                $page_edit="page.php?p=report_academic_questionnaire&act=edit";
                $back="page.php?p=report_academic_questionnaire";
                $page_print="pages/administrator/report_academic_questionnaire/report_pdf.php";
                $action="pages/administrator/report_academic_questionnaire/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					   <div class="panel">
					    <div class="panel-body">
					        <div class="row">
							        	<div class="col-lg-12">
							        		<button class="btn btn-purple pull-left" data-toggle="modal" data-target="#page_input"><i class="fa fa-search icon-fw"></i> Search</button>
							        		<br><br>
							        	</div>
							</div>
					
							<?php if (!empty($school_year) AND $check>0) { 

								?>
					        
					        <div class="row">

							            <div class="col-lg-3 table-responsive">
							            	<div class="text-center">
						                        <button class="btn btn-block btn-warning btn-lg" data-toggle="modal" data-target="#information">Information</button>
						                    </div>


							                <table class="table table-bordered invoice-summary">
							                    <tbody>
							                        <tr>
							                            <td>
							                                <strong><?= $school_year; ?> </strong>
							                                <small>School Year </small>
							                            </td>
							                            <td>
							                                <strong><?= $semester; ?></strong>
							                                <small> Semester</small>
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
							                		$data=mysqli_query($connect,"SELECT * FROM questionnaire_academic as ql
							                			INNER JOIN questionnaire_category as qc on qc.category_id=ql.category_id group by ql.category_id");
							                		while ($row=mysqli_fetch_array($data)) {
							                		?>
							                			<tr>
							                				<th colspan="7">Category : <?= $row['category']; ?></th>
							                			</tr>


							                			<?php
							                			$no=1;
								                		$data2=mysqli_query($connect,"SELECT * FROM questionnaire_academic 
								                			WHERE category_id='$row[category_id]'");
								                		while ($row2=mysqli_fetch_array($data2)) {
								                			$satu=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_academic where 
								                				q_academic_id='$row2[q_academic_id]' AND 
								                				q_academic_answer='1'"));

								                			$dua=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_academic where 
								                				q_academic_id='$row2[q_academic_id]' AND 
								                				q_academic_answer='2'"));

								                			$tiga=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_academic where 
								                				q_academic_id='$row2[q_academic_id]' AND 
								                				q_academic_answer='3'"));

								                			$empat=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_academic where 
								                				q_academic_id='$row2[q_academic_id]' AND 
								                				q_academic_answer='4'"));

								                			$lima=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_academic where 
								                				q_academic_id='$row2[q_academic_id]' AND 
								                				q_academic_answer='5'"));

								                			
								                		?>

								                		<tr>
								                			<td><?= $no; ?></td>
								                			<td><?= $row2['q_academic_description']; ?></td>
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
								                			WHERE qs_status='academic'");
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
														                			AND qr_status='academic'");
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


					        <?php } else { ?>
					        	<div class="alert alert-warning">
					        		<b> Questionnaire empty! </b>
					        	</div>
					        <?php } ?>
					
					        
					    </div>
					</div>
					
                </div>
                <!--===================================================-->
                <!--End page content-->


                 <!-- Modal -->
				<div id="page_input" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Search Questionnaire</h4>
				      </div>
				      <form class="form-horizontal" method="POST" action=""  enctype="multipart/form-data">
				      <div class="modal-body">
				        				

										<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	School Year <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="school_year" class="form-control" required>
					                            	<?php
					                            	$start=date('Y')-2;
					                            	$end=date('Y')+1;
					                            	for ($i=$start; $i <= $end ; $i++) { 
					                            		$sy=$i."/".($i+1);
					                            		if ($sy==$school_year) {
					                            	?>
					                            		<option value="<?= $sy; ?>" selected><?= $sy; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $sy; ?>"><?= $sy; ?></option>
					                            	 <?php } } ?>
					                            	
					                            </select>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	semester <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="semester" class="form-control" required>
					                             <?php if ($semester=="Ganjil") { ?>
					                            	<option value="Ganjil">Ganjil</option>
					                            	<option value="Genap">Genap</option>
					                            <?php }  else { ?>
					                            	<option value="Genap">Genap</option>
					                            	<option value="Ganjil">Ganjil</option>
					                            <?php } ?>
					                            </select>
					                        </div>
					                    </div>

					                    

					                    
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
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


                <?php 
                break;
                
                } ?>

            </div>



