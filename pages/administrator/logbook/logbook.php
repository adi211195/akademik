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

                if (empty(@$_GET['sy'])) {
                	$mcurriculum=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum order by curriculum_school_year, curriculum_semester desc"));                
                	$sy=$mcurriculum['curriculum_school_year'];
                } else {
                	$sy 			=htmlspecialchars(@$_GET['sy']);
                }

                $page_input="page.php?p=logbook&act=input";
                $page_detail="page.php?p=logbook&act=detail";
                $back="page.php?p=logbook";
                $action="pages/administrator/logbook/action.php";
                $page_print="pages/administrator/logbook/report_pdf.php";

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
					                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Photo</th>
					                                    <th>username</th>
					                                    <th>Code</th>
					                                    <th>Name</th>
					                                    <th>Email</th>
					                                    <th>Block</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM account
					                            		LEFT JOIN master_lecturer ON master_lecturer.account_id=account.account_id
					                            		WHERE account_status='Dosen'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><img src="assets/account_photo/<?= $row['account_photo']; ?>" alt="" style="width: 50px;"></td>
					                                    <td><?= $row['account_username']; ?></td>
					                                    <td><?= $row['lecturer_code']; ?></td>
					                                    <td><?= $row['lecturer_name']; ?></td>
					                                    <td><?= $row['account_email']; ?></td>
					                                    <td><?= $row['account_block']; ?></td>
					                                    <td>
						                                    <a href="<?= $page_detail; ?>&id=<?= $row['account_id']; ?>">
						                               		 <button class="btn btn-primary" title="detail"><i class="fa fa-desktop"></i></button></a> 
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
                case 'detail':
                $id 		=htmlspecialchars($_GET['id']);
                $page 		=htmlspecialchars($_GET['page']);
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_lecturer ON master_lecturer.account_id=account.account_id
                	where account.account_id='$id'")); 
                $lecturer_code=$row['lecturer_code'];   

                          

                ?>

                <div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Detail Logbook</h3>
					            </div>

					            <div class="panel-body">
					            <div class="alert alert-info">
					            	School Year : <?= $sy; ?> <br>
					                Lecturer Code : <?= $row['lecturer_code']; ?> <br>
					                Lecturer Name : <?= $row['lecturer_name']; ?>
						        </div>
						        <a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>

						        <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>


						        


						        <div class="table-responsive">
					                        <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Majors</th>
					                                    <th>NIM</th>
					                                    <th>Name</th>
					                                    <th>Gender</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
												   <?php
						                  
								                  //PAGGING
								                  
								                      $batas = 5;
								        			  $page = isset($_GET['page'])?(int)$_GET['page'] : 1;
								        		      $page_awal = ($page>1) ? ($page * $batas) - $batas : 0;	
								         
								        			  $previous = $page - 1;
								        			  $next = $page + 1;

								        			  $filter="page.php?p=logbook&act=detail&id=".$id."sy=".$sy;  
												
								                      $data=mysqli_query($connect, "SELECT * FROM master_krs where
								                      krs_school_year='$sy' AND
								                      krs_advisor='$lecturer_code' group by student_nim order by student_nim asc");
								                      
								                      $jumlah_data = mysqli_num_rows($data);
												      $total_page = ceil($jumlah_data / $batas);
												      $nomor = $page_awal+1;
												      
												   //PAGGING   
												      
												      $no=$page;
												      $data2=mysqli_query($connect, "SELECT * FROM master_krs as mk
												      	LEFT JOIN master_student as ms ON ms.student_nim=mk.student_nim
												      	LEFT JOIN master_majors as mm ON mm.majors_code=ms.majors_code
												      where
								                      krs_school_year='$sy' AND
								                      krs_advisor='$lecturer_code' group by mk.student_nim order by mk.student_nim asc limit $page_awal, $batas");
												
								                      while ($row2=mysqli_fetch_array($data2)) {                       
								                      ?>
								                   <tr>
								                   	<td><?= $no; ?></td>
								                   	<td><?= $row2['majors']; ?></td>
								                   	<td><?= $row2['student_nim']; ?></td>
								                   	<td><?= $row2['student_name']; ?></td>
								                   	<td><?= $row2['student_gender']; ?></td>
								                   	<td>
								                   		<a href="<?= $page_print; ?>?id=<?= $id; ?>&nim=<?= $row2['student_nim']; ?>" target="_blank"><button type="button" class="btn btn-danger"><i class="fa fa-print"></i></button></a>

											            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#detail<?= $no; ?>"><i class="fa fa-angle-right"></i></button> 


											            <!-- Modal -->
														<div id="detail<?= $no; ?>" class="modal fade" role="dialog">
														  <div class="modal-dialog modal-lg">

														    <!-- Modal content-->
														    <div class="modal-content">
														      <div class="modal-header">
														        <h4 class="modal-title">Detail Logbook</h4>
														      </div>
														      <div class="modal-body">
														      	<div class="alert alert-info">
														      		Majors :<?= $row2['majors']; ?><br>
													                NIM : <?= $row2['student_nim']; ?><br>
													                Name : <?= $row2['student_name']; ?><br>
													                Gender : <?= $row2['student_gender']; ?>
														      	</div>

														      	<div class="table-responsive">
						                        					<table class="table table-striped">
															      		<thead>
															      			<th>No</th>
															      			<th>Date</th>
															      			<th>Note</th>
															      			<th>Information</th>
															      			<th>Response</th>
															      		</thead>
															      		<tbody>
															      			<?php
															      			$nomor=1;
															      			$log=mysqli_query($connect, "SELECT * FROM master_logbook where 
															      				lecturer_code='$lecturer_code' AND
															      				student_nim='$row2[student_nim]'
															      				ORDER BY logbook_date asc");
															      			while ($row3=mysqli_fetch_array($log)) {
															      			?>

															      			<tr>
															      				<td><?= $nomor; ?></td>
															      				<td><?= $row3['logbook_date']; ?></td>
															      				<td><?= $row3['logbook_note']; ?></td>
															      				<td><?= $row3['logbook_information']; ?></td>
															      				<td><?= $row3['logbook_response']; ?></td>
															      			</tr>
															      			<?php $nomor++; } ?>
															      		</tbody>
															      	</table>
															    </div>


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
											     </tbody>
											    </table>
											</div>
					                  
					                  Total Data : <span class="badge badge-danger"><?= number_format($jumlah_data); ?></span>
					                  
					                   <nav>
					            			<ul class="pagination justify-content-center">
					            				<li class="page-item">
					            					<a class="page-link" href="<?php if($page > 1){ echo ''.$filter.'&page'.$previous.''; } ?>">Previous</a>
					            				</li>
					            				<?php for($x=1;$x<=$total_page; $x++){ 
					            				$bawah=$page-5;
					            				$atas=$page+5;
					            				
					            				if ($x>$bawah AND $x<$atas) {
					            				?> 
					            					<li class="page-item  <?php if ($x==$page) { echo 'active'; } ?>"><a class="page-link" href="<?= $filter; ?>&page=<?php echo $x ?>"><?php echo $x; ?></a></li>
					            				<?php }} ?>				
					            				<li class="page-item">
					            					<a  class="page-link" href="<?php if($page < $total_page) { echo ''.$filter.'&page'.$next.''; } ?>">Next</a>
					            				</li>
					            			</ul>
					            		</nav>


						    	</div>
					
					       
					
					        </div>
					    </div>
               		</div>
               	</div>



               	<!-- Modal -->
				<div id="filter" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Filter</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="logbook">
				      <input type="hidden" name="act" value="detail">
				      <input type="hidden" name="id" value="<?= $id; ?>">
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

				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>


                <?php	break;
                } ?>

            </div>



