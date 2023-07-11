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

               

                $page_input="page.php?p=logbook&act=input";
                $page_detail="page.php?p=logbook&act=detail";
                $back="page.php?p=logbook";
                $action="pages/mahasiswa/logbook/action.php";

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
					                    <h3 class="panel-title">Logbook Data </h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
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
															      				student_nim='$student_nim'
															      				ORDER BY logbook_date asc");
													while ($row3=mysqli_fetch_array($log)) {
													?>

													<tr>
														<td><?= $nomor; ?></td>
														<td><?= $row3['logbook_date']; ?></td>
														<td><?= $row3['logbook_note']; ?></td>
														<td><?= $row3['logbook_information']; ?></td>
														<td><?= $row3['logbook_response']; ?></td>
														<td>
															<button class="btn btn-primary" title="Edit" data-toggle="modal" data-target="#page_edit<?= $nomor; ?>"><i class="fa fa-edit"></i></button>


							                               		 <!-- Modal -->
																<div id="page_edit<?= $nomor; ?>" class="modal fade" role="dialog">
																  <div class="modal-dialog">

																    <!-- Modal content-->
																    <div class="modal-content">
																      <div class="modal-header">
																        <h4 class="modal-title">Input Response</h4>
																      </div>
																      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
																      <input type="hidden" name="id" value="<?= $row3['logbook_id']; ?>">
																      <input type="hidden" name="action" value="edit">
																      <div class="modal-body">				        				

																	     <div class="form-group">
																	        <label class="col-sm-3 control-label" >
																	             Date </label>
																	        <div class="col-sm-9">
																	             <?= $row3['logbook_date']; ?>				                           
																	        </div>
																	    </div>

																	    <div class="form-group">
																	        <label class="col-sm-3 control-label" >
																	            Note </label>
																	        <div class="col-sm-9">
																	            <?= $row3['logbook_note']; ?>  
																	        </div>
																	     </div>


																	    <div class="form-group">
																	        <label class="col-sm-3 control-label" >
																	            Information </label>
																	        <div class="col-sm-9">
																	            <?= $row3['logbook_information']; ?>			                           
																	        </div>
																	    </div>


																	    <div class="form-group">
																	        <label class="col-sm-3 control-label" >
																	            Response <span class="required">*</span></label>
																	        <div class="col-sm-9">
																	        	<textarea name="logbook_response" class="form-control" required><?= $row3['logbook_response']; ?></textarea>
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
                
                } ?>

            </div>



