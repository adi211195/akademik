			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Skripsi</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Skripsi</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php

               

                $page_input="page.php?p=skripsi&act=input";
                $page_detail="page.php?p=skripsi&act=detail";
                $back="page.php?p=skripsi";
                $action="pages/mahasiswa/skripsi/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				$row=mysqli_fetch_array(mysqli_query($connect,"SELECT master_skripsi.*, account.account_photo, 
                	master_student.student_name, account.account_status, account.account_id FROM master_skripsi 
					            	LEFT JOIN master_student ON master_student.student_nim=master_skripsi.student_nim
					            	LEFT JOIN account ON account.account_id=master_student.account_id
					            	WHERE master_skripsi.student_nim='$student_nim'"));
				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Skripsi Data </h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="table-responsive">
						                    <table class="table table-striped">
												<tbody>
													<tr>
														<th width="10%">Title</th>
														<td width="85%"><?= $row['skripsi_title']; ?></td>
														<td width="5%"><button class="btn btn-primary" title="Title" data-toggle="modal" data-target="#title"><i class="fa fa-edit"></i></button></td>

													</tr>
													<tr>
														<th>Abstract</th>
														<td><?= $row['skripsi_abstract']; ?></td>
														<td><button class="btn btn-primary" title="Title" data-toggle="modal" data-target="#abstract"><i class="fa fa-edit"></i></button></td>
													</tr>

													<?php 
					                            	$row2=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_skripsi_file WHERE student_nim='$student_nim' AND  skripsi_file_status='Daftar Isi'"));
					                             	?>
													<tr>
														<th>Daftar Isi</th>
														<td><a href="download_file.php?act=skripsi&file=<?= $account_id; ?>!<?= $row2['skripsi_file_id']; ?>" target="_blank">
															<?= $row2['skripsi_file_status']; ?></a></td>
														<td>
															<?php if (!empty($row['skripsi_title'])) { ?>
															<button class="btn btn-primary" title="Daftar Isi" data-toggle="modal" data-target="#daftar_isi"><i class="fa fa-edit"></i></button>
															<?php } ?>
														</td>
													</tr>

													<?php 
					                            	$row2=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_skripsi_file WHERE student_nim='$student_nim' AND  skripsi_file_status='Bab1'"));
					                             	?>
													<tr>
														<th>File BAB I</th>
														<td><a href="download_file.php?act=skripsi&file=<?= $account_id; ?>!<?= $row2['skripsi_file_id']; ?>" target="_blank">
															<?= $row2['skripsi_file_status']; ?></a></td>
														<td>
															<?php if (!empty($row['skripsi_title'])) { ?>
															<button class="btn btn-primary" title="File BAB I" data-toggle="modal" data-target="#bab1"><i class="fa fa-edit"></i></button>
															<?php } ?>
														</td>
													</tr>

													<?php 
					                            	$row2=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_skripsi_file WHERE student_nim='$student_nim' AND  skripsi_file_status='Bab2'"));
					                             	?>
													<tr>
														<th>File BAB II</th>
														<td><a href="download_file.php?act=skripsi&file=<?= $account_id; ?>!<?= $row2['skripsi_file_id']; ?>" target="_blank">
															<?= $row2['skripsi_file_status']; ?></a></td>
														<td>
															<?php if (!empty($row['skripsi_title'])) { ?>
															<button class="btn btn-primary" title="File BAB II" data-toggle="modal" data-target="#bab2"><i class="fa fa-edit"></i></button>
															<?php } ?>
														</td>
													</tr>

													<?php 
					                            	$row2=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_skripsi_file WHERE student_nim='$student_nim' AND  skripsi_file_status='Bab3'"));
					                             	?>
													<tr>
														<th>File BAB III</th>
														<td><a href="download_file.php?act=skripsi&file=<?= $account_id; ?>!<?= $row2['skripsi_file_id']; ?>" target="_blank">
															<?= $row2['skripsi_file_status']; ?></a></td>
														<td>
															<?php if (!empty($row['skripsi_title'])) { ?>
															<button class="btn btn-primary" title="File BAB III" data-toggle="modal" data-target="#bab3"><i class="fa fa-edit"></i></button>
															<?php } ?>
														</td>
													</tr>

													<?php 
					                            	$row2=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_skripsi_file WHERE student_nim='$student_nim' AND  skripsi_file_status='Bab4'"));
					                             	?>
													<tr>
														<th>File BAB IV</th>
														<td><a href="download_file.php?act=skripsi&file=<?= $account_id; ?>!<?= $row2['skripsi_file_id']; ?>" target="_blank">
															<?= $row2['skripsi_file_status']; ?></a></td>
														<td>
															<?php if (!empty($row['skripsi_title'])) { ?>
															<button class="btn btn-primary" title="File BAB IV" data-toggle="modal" data-target="#bab4"><i class="fa fa-edit"></i></button>
															<?php } ?>
														</td>
													</tr>

													<?php 
					                            	$row2=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_skripsi_file WHERE student_nim='$student_nim' AND  skripsi_file_status='Bab5'"));
					                             	?>
													<tr>
														<th>File BAB V</th>
														<td><a href="download_file.php?act=skripsi&file=<?= $account_id; ?>!<?= $row2['skripsi_file_id']; ?>" target="_blank">
															<?= $row2['skripsi_file_status']; ?></a></td>
														<td>
															<?php if (!empty($row['skripsi_title'])) { ?>
															<button class="btn btn-primary" title="File BAB V" data-toggle="modal" data-target="#bab5"><i class="fa fa-edit"></i></button>
															<?php } ?>
														</td>
													</tr>

													<?php 
					                            	$row2=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_skripsi_file WHERE student_nim='$student_nim' AND  skripsi_file_status='Penutup'"));
					                             	?>
													<tr>
														<th>Penutup</th>
														<td><a href="download_file.php?act=skripsi&file=<?= $account_id; ?>!<?= $row2['skripsi_file_id']; ?>" target="_blank">
															<?= $row2['skripsi_file_status']; ?></a></td>
														<td>
															<?php if (!empty($row['skripsi_title'])) { ?>
															<button class="btn btn-primary" title="Penutup" data-toggle="modal" data-target="#penutup"><i class="fa fa-edit"></i></button>
															<?php } ?>
														</td>
													</tr>													
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
				<div id="title" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Title</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      <input type="hidden" name="action" value="title">
				      <div class="modal-body">

				        				<div class="form-group">
					                        <textarea class="form-control" name="skripsi_title" placeholder="Title" required><?= $row['skripsi_title']; ?></textarea>
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



				 <!-- Modal -->
				<div id="abstract" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Abstract</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      <input type="hidden" name="action" value="abstract">
				      <div class="modal-body">

				        				<div class="form-group">
					                        <textarea class="form-control demo-summernote2" name="skripsi_abstract" placeholder="Abstract" required><?= $row['skripsi_abstract']; ?></textarea>
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


				<!-- Modal -->
				<div id="daftar_isi" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Daftar Isi</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      <input type="hidden" name="action" value="file">
				      <input type="hidden" name="skripsi_file_status" value="Daftar Isi">
				      <div class="modal-body">

				        				<div class="form-group">
					                            <input type="file" name="skripsi_file" required>
					                            * Fill in if you want to replace (Format file .pdf, max size 10mb)
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


				 <!-- Modal -->
				<div id="bab1" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">File BAB I</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      <input type="hidden" name="action" value="file">
				      <input type="hidden" name="skripsi_file_status" value="Bab1">
				      <div class="modal-body">

				        				<div class="form-group">
					                            <input type="file" name="skripsi_file" required>
					                            * Fill in if you want to replace (Format file .pdf, max size 10mb)
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


				 <!-- Modal -->
				<div id="bab2" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">File BAB II</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      <input type="hidden" name="action" value="file">
				      <input type="hidden" name="skripsi_file_status" value="Bab2">
				      <div class="modal-body">

				        				<div class="form-group">
					                            <input type="file" name="skripsi_file" required>
					                            * Fill in if you want to replace (Format file .pdf, max size 10mb)
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



				 <!-- Modal -->
				<div id="bab3" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">File BAB III</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      <input type="hidden" name="action" value="file">
				      <input type="hidden" name="skripsi_file_status" value="Bab3">
				      <div class="modal-body">

				        				<div class="form-group">
					                            <input type="file" name="skripsi_file" required>
					                            * Fill in if you want to replace (Format file .pdf, max size 10mb)
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


				 <!-- Modal -->
				<div id="bab4" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">File BAB IV</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      <input type="hidden" name="action" value="file">
				      <input type="hidden" name="skripsi_file_status" value="Bab4">
				      <div class="modal-body">

				        				<div class="form-group">
					                            <input type="file" name="skripsi_file" required>
					                            * Fill in if you want to replace (Format file .pdf, max size 10mb)
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


				 <!-- Modal -->
				<div id="bab5" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">File BAB V</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      <input type="hidden" name="action" value="file">
				      <input type="hidden" name="skripsi_file_status" value="Bab5">
				      <div class="modal-body">

				        				<div class="form-group">
					                            <input type="file" name="skripsi_file" required>
					                            * Fill in if you want to replace (Format file .pdf, max size 10mb)
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


				 <!-- Modal -->
				<div id="penutup" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Penutup</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      <input type="hidden" name="action" value="file">
				      <input type="hidden" name="skripsi_file_status" value="Penutup">
				      <div class="modal-body">

				        				<div class="form-group">
					                            <input type="file" name="skripsi_file" required>
					                            * Fill in if you want to replace (Format file .pdf, max size 10mb)
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



