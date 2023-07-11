			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Open Questionnaire</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Open Questionnaire</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_input="page.php?p=open_questionnaire&act=input";
                $page_edit="page.php?p=open_questionnaire&act=edit";
                $back="page.php?p=open_questionnaire";
                $action="pages/administrator/open_questionnaire/action.php";

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
					                    <h3 class="panel-title">Open Questionnaire Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="table-responsive">
					                        <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Questionnaire</th>
					                                    <th>Status</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM questionnaire_status");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['questionnaire']; ?></td>
					                                    <td><?= $row['questionnaire_status']; ?></td>
					                                    <td>
						                                     <button class="btn btn-primary" data-toggle="modal" data-target="#page_edit<?= $no; ?>"><i class="fa fa-edit"></i> </button>

					                                    		<!-- Modal -->
																<div id="page_edit<?= $no; ?>" class="modal fade" role="dialog">
																  <div class="modal-dialog">

																    <!-- Modal content-->
																    <div class="modal-content">
																      <div class="modal-header">
																        <h4 class="modal-title">Edit Open Questionnaire</h4>
																      </div>
																      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
																      <input type="hidden" name="id" value="<?= $row['status_id']; ?>">
																      <input type="hidden" name="action" value="edit">
																      <div class="modal-body">				        				

																	                    <div class="form-group">
																	                        <label class="col-sm-3 control-label" >
																	                        	Questionnaire </label>
																	                        <div class="col-sm-9">
																	                            <?= $row['questionnaire']; ?>  
																	                        </div>
																	                    </div>
																	                    <div class="form-group">
																	                        <label class="col-sm-3 control-label" >
																	                        	Status <span class="required">*</span></label>
																	                        <div class="col-sm-9">
																	                            <select class="form-control" name="questionnaire_status">
																	                            <?php if ($row['questionnaire_status']=="open") { ?>
																	                            	<option value="open">open</option>
																	                            	<option value="close">close</option>
																	                            <?php } else { ?>
																	                            	<option value="close">close</option>
																	                            	<option value="open">open</option>
																	                            <?php } ?>
																	                            </select>				                           
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
                } ?>

            </div>



