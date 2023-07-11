			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Drive Academic</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Drive Academic</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php

                $page_detail="page.php?p=drive";
                
                $action="pages/mahasiswa/drive/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				
                $folder 	=htmlspecialchars(@$_GET['folder']);
                $details=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_student ON master_student.account_id=account.account_id
                	where account.account_id='$account_id'"));
                $fdr=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM drive_folder 
                	where account_id='$account_id' AND folder_id='$folder'"));
                
                if (!empty($folder)){
                	$back="page.php?p=drive&folder=".$folder;
                } else {
                	$back="page.php?p=drive";
                }
                ?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">

					        <div class="pad-all file-manager">
					            <div class="fixed-fluid">
					                <div class="fixed-sm-200 pull-sm-left file-sidebar">
					
					                    <p class="pad-hor mar-top text-main text-bold text-sm text-uppercase">Shared</p>
					                    <div class="list-group bg-trans pad-ver bord-btm">
					                        <a href="page.php?p=drive&act=folder&id=dosen" class="list-group-item"><i class="demo-pli-folder icon-lg icon-fw"></i> Lecturer</a>
					                        <a href="page.php?p=drive&act=folder&id=mahasiswa" class="list-group-item"><i class="demo-pli-folder icon-lg icon-fw"></i> Student</a>
					                    </div>
					
					
					                    <p class="pad-hor mar-top text-main text-bold text-sm text-uppercase">Folders</p>
					                    <div class="list-group bg-trans pad-btm bord-btm">
					                        <a href="<?= $page_detail; ?>" class="list-group-item">
					                        <i class="demo-pli-folder icon-lg icon-fw"></i> ...
					                    </a>
					                        
					                    <?php 
					                    $data=mysqli_query($connect, "SELECT * FROM drive_folder where account_id='$account_id' order by folder_name asc");
					                    while ($row=mysqli_fetch_array($data)) {
					                    	if ($row['folder_id']==$folder) {
					                    ?>
					                        <a href="<?= $page_detail; ?>&folder=<?= $row['folder_id']; ?>" class="list-group-item">
					                        <i class="demo-pli-folder icon-lg icon-fw"></i><b> <?= $row['folder_name']; ?></b>
					                    </a>
					                    <?php } else { ?>
					                    	<a href="<?= $page_detail; ?>&folder=<?= $row['folder_id']; ?>" class="list-group-item">
					                        <i class="demo-pli-folder icon-lg icon-fw"></i> <?= $row['folder_name']; ?>
					                    </a>
					                    <?php }} ?>
					                    </div>
					
					                </div>
					                <div class="fluid file-panel">
					                    <div class="bord-btm pad-ver">
					                        <ol class="breadcrumb">
					                        	<?php if (!empty($folder)) { ?>
						                            <li><a href="#">Drive Academic </a></li>
						                            <li class="active"><?= $fdr['folder_name']; ?></li>
					                            <?php } else { ?>
					                            	<li class="active">Drive Academic </li>
					                            <?php } ?>
					                        </ol>
					                    </div>
					                    <div class="file-toolbar bord-btm">
					                        <div class="btn-file-toolbar">
					                            <a class="btn btn-icon add-tooltip" href="<?= $page_detail; ?>" data-original-title="Home" data-toggle="tooltip"><i class="icon-2x demo-pli-home"></i></a>
					                            <a class="btn btn-icon add-tooltip" href="<?= $back; ?>" data-original-title="Refresh" data-toggle="tooltip"><i class="icon-2x demo-pli-reload-3"></i></a>
					                        </div>
					                        <div class="btn-file-toolbar">
					                        	<?php if (empty($folder)) { ?>
					                            <a class="btn btn-icon add-tooltip" href="#" data-toggle="modal" data-target="#folder"><i class="icon-2x demo-pli-folder"></i></a>
					                        	<?php } ?>

					                            <a class="btn btn-icon add-tooltip" href="#" data-toggle="modal" data-target="#file"><i class="icon-2x demo-pli-file-add"></i></a>
					                        </div>
					                    </div>
					                    <ul id="demo-mail-list" class="file-list">

											
										  <?php
										  if (empty($folder)) {
						                       $data=mysqli_query($connect,"SELECT drive_folder.*,
						                       DATE_FORMAT(create_date, '%d %b %Y %H:%i %p') as jam
						                       FROM drive_folder where account_id='$account_id' order by folder_name asc");
						                       while ($row=mysqli_fetch_array($data)) {						              
						                       	$size=mysqli_fetch_array(mysqli_query($connect, "SELECT sum(drive_size) as size FROM 
						                       		drive_academic where account_id='$account_id' AND folder_id='$row[folder_id]'"));
						                       ?>
						
						                        <!--File list item-->
						                        <li>
						                            <div class="file-control">
						                                <input id="file-list-1" class="magic-checkbox" type="checkbox">
						                                <label for="file-list-1"></label>
						                            </div>
						                            <div class="file-settings">
						                            	<div class="btn-group dropdown">
							                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
							                            <ul class="dropdown-menu dropdown-menu-right" style="">
							                                <li><a href="#" onclick="data_folder('<?= $row['folder_id']; ?>');">
							                                	<i class="icon-lg icon-fw demo-pli-recycling"></i> 
									                                Remove
									                            </a>
									                        </li>
									                        <li><a href="#" data-toggle="modal" data-target="#rename<?= $row['folder_id']; ?>">
							                                	<i class="icon-lg icon-fw demo-pli-pen-5"></i> 
									                                Rename
									                            </a>
									                        </li>
							                        </div>
						                            </div>
						                            <div class="file-attach-icon"></div>
						                            <a href="<?= $page_detail; ?>&folder=<?= $row['folder_id']; ?>" class="file-details">
						                                <div class="media-block">
						                                    <div class="media-left"><i class="demo-psi-folder"></i></div>
						                                    <div class="media-body">
						                                        <p class="file-name"><?= $row['folder_name']; ?></p>
						                                        <small><?= $row['jam']; ?> | <?= round(($size['size']/10000),0,2); ?> MB</small>
						                                    </div>
						                                </div>
						                            </a>

						                             <!-- Modal -->
														<div id="rename<?= $row['folder_id']; ?>" class="modal fade" role="dialog">
														  <div class="modal-dialog">

														    <!-- Modal content-->
														    <div class="modal-content">
														      <div class="modal-header">
														        <h4 class="modal-title">Rename File</h4>
														      </div>
														      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
														      	<input type="hidden" name="action" value="rename">
														      	<input type="hidden" name="folder_id" value="<?= $row['folder_id']; ?>">
														      <div class="modal-body">
														        				


															                    <div class="form-group">
															                        <label class="col-sm-3 control-label" >
															                        	Folder <span class="required">*</span></label>
															                        <div class="col-sm-9">
															                            <input type="text" name="folder_name" value="<?= $row['folder_name']; ?>" class="form-control" required>
															                        </div>
															                    </div>

															                    
														      </div>
														      <div class="modal-footer">
														        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														        <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Rename</button>
														      </div>
														  	</form>
														    </div>

														  </div>
														</div>

						                        </li>


						                        


						                    <?php }} ?>


					                       <?php
					                       $data=mysqli_query($connect,"SELECT drive_academic.*,
					                       DATE_FORMAT(create_date, '%d %b %Y %H:%i %p') as jam
					                       FROM drive_academic 
					                       		where account_id='$account_id' 
					                       		AND folder_id='$folder' order by drive_file asc");
					                       while ($row=mysqli_fetch_array($data)) {
					                       	$type=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM drive_type where drive_type='$row[drive_type]'"));
					                       ?>
					
					                        <!--File list item-->
					                        <li>
					                            <div class="file-control">
					                                <input id="file-list-1" class="magic-checkbox" type="checkbox">
					                                <label for="file-list-1"></label>
					                            </div>
					                            <div class="file-settings">
					                            	
							                        <div class="btn-group dropdown">
							                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
							                            <ul class="dropdown-menu dropdown-menu-right" style="">
							                                <li><a href="download_file.php?act=drive&file=<?= $account_id; ?>!<?= $row['drive_id']; ?>" target="_blank">
								                                	<i class="icon-lg icon-fw demo-pli-download-from-cloud"></i> Download
								                                </a>
							                                </li>
							                                <li><a href="#" onclick="data_remove('<?= $row['drive_id']; ?>');">
							                                	<i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a>
							                                </li>
							                                <li><a href="#" data-toggle="modal" data-target="#shared<?= $row['drive_id']; ?>">
							                                	<i class="icon-lg icon-fw demo-pli-paper-plane"></i> 
								                                	Shared
								                                </a>
								                            </li>
							                        </div>


					                            </div>
					                            <div class="file-attach-icon"></div>
					                            <a href="#" class="file-details">
					                                <div class="media-block">
					                                    <div class="media-left"><i class="<?= $type['drive_icon']; ?>"></i></div>
					                                    <div class="media-body">
					                                        <p class="file-name"><?= $row['drive_file']; ?></p>
					                                        <small><?= $row['jam']; ?> | <?= round($row['drive_size']/10000,0,2); ?> MB</small>
					                                    </div>
					                                </div>
					                            </a>

					                             <!-- Modal -->
												<div id="shared<?= $row['drive_id']; ?>" class="modal fade" role="dialog">
												  <div class="modal-dialog">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												        <h4 class="modal-title">Shared File</h4>
												      </div>
												      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
												      	<input type="hidden" name="action" value="shared">
												      	<input type="hidden" name="drive_id" value="<?= $row['drive_id']; ?>">
												      <div class="modal-body">
												        				


													                    <div class="form-group">
													                        <label class="col-sm-3 control-label" >
													                        	Username <span class="required">*</span></label>
													                        <div class="col-sm-9">
													                            <input type="text" name="account_username" class="form-control" required>
													                        </div>
													                    </div>

													                    
												      </div>
												      <div class="modal-footer">
												        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Shared</button>
												      </div>
												  	</form>
												    </div>

												  </div>
												</div>
											
					                        </li>


					                        


					                    <?php } ?>
					

					                    </ul>
					                    <p>&nbsp;</p>
					                    <p>&nbsp;</p>
					                    <p>&nbsp;</p>
					                </div>
					            </div>
					        </div>
					    </div>
					
					    
                </div>
                <!--===================================================-->
                <!--End page content-->



                 <!-- Modal -->
				<div id="folder" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Create Folder</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      	<input type="hidden" name="action" value="folder">
				      <div class="modal-body">
				        				


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Folder <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="folder_name" class="form-control" required>
					                        </div>
					                    </div>

					                    
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Create</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>


				 <!-- Modal -->
				<div id="file" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Upload File</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      	<input type="hidden" name="action" value="file">
				      	<input type="hidden" name="folder_id" value="<?= $folder; ?>">
				      <div class="modal-body">
				        				


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	File <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="file" name="drive_file" class="form-control" required>
					                        </div>
					                    </div>

					                    
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Upload</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>

                <?php	break;
                case 'folder':

                $id 	=htmlspecialchars(@$_GET['id']);
                if ($id=="dosen") {
                	$status="Lecturer";
                } else {
                	$status="Student";
                }

                $update=mysqli_query($connect,"UPDATE drive_shared 
                	INNER JOIN account ON account.account_id=drive_shared.account_id
                	SET view_shared='0' where account_send='$account_id' AND account_status='$id'");
                
                $back="page.php?p=drive";
                
                ?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">

					        <div class="pad-all file-manager">
					            <div class="fixed-fluid">
					                <div class="fixed-sm-200 pull-sm-left file-sidebar">
					
					                    <p class="pad-hor mar-top text-main text-bold text-sm text-uppercase">Shared</p>
					                    <div class="list-group bg-trans pad-ver bord-btm">
					                        <a href="page.php?p=drive&act=folder&id=dosen" class="list-group-item"><i class="demo-pli-folder icon-lg icon-fw"></i> Lecturer</a>
					                        <a href="page.php?p=drive&act=folder&id=mahasiswa" class="list-group-item"><i class="demo-pli-folder icon-lg icon-fw"></i> Student</a>
					                    </div>
					
					
					                    <p class="pad-hor mar-top text-main text-bold text-sm text-uppercase">Folders</p>
					                    <div class="list-group bg-trans pad-btm bord-btm">
					                        <a href="<?= $page_detail; ?>" class="list-group-item">
					                        <i class="demo-pli-folder icon-lg icon-fw"></i> ...
					                    </a>
					                        
					                    <?php 
					                    $data=mysqli_query($connect, "SELECT * FROM drive_folder where account_id='$account_id' order by folder_name asc");
					                    while ($row=mysqli_fetch_array($data)) {
					                    ?>
					                        <a href="<?= $page_detail; ?>&folder=<?= $row['folder_id']; ?>" class="list-group-item">
						                        <i class="demo-pli-folder icon-lg icon-fw"></i><b> <?= $row['folder_name']; ?></b>
						                    </a>
					                    <?php } ?>
					                    </div>
					
					                </div>
					                <div class="fluid file-panel">
					                    <div class="bord-btm pad-ver">
					                        <ol class="breadcrumb">					                        	
						                        <li><a href="#">Drive Academic </a></li>
						                        <li class="active"><?= $status; ?></li>
					                          
					                        </ol>
					                    </div>
					                    <div class="file-toolbar bord-btm">
					                        <div class="btn-file-toolbar">
					                            <a class="btn btn-icon add-tooltip" href="<?= $page_detail; ?>" data-original-title="Home" data-toggle="tooltip"><i class="icon-2x demo-pli-home"></i></a>
					                            <a class="btn btn-icon add-tooltip" href="<?= $back; ?>" data-original-title="Refresh" data-toggle="tooltip"><i class="icon-2x demo-pli-reload-3"></i></a>
					                        </div>
					                    </div>
					                    <ul id="demo-mail-list" class="file-list">
											
											
					                        
											<?php
					                       $data=mysqli_query($connect,"SELECT drive_academic.*, account.*,
					                       DATE_FORMAT(drive_shared.create_date, '%d %b %Y %H:%i %p') as jam
					                       FROM drive_shared 
					                       INNER JOIN account ON account.account_id=drive_shared.account_id
					                       INNER JOIN drive_academic ON drive_academic.drive_id=drive_shared.drive_id
					                       		where account_send='$account_id' 
					                       		AND account_status='$id' order by drive_file asc");
					                       while ($row=mysqli_fetch_array($data)) {
					                       	$type=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM drive_type where drive_type='$row[drive_type]'"));
					                       ?>
					
					                        <!--File list item-->
					                        <li>
					                            <div class="file-control">
					                                <input id="file-list-1" class="magic-checkbox" type="checkbox">
					                                <label for="file-list-1"></label>
					                            </div>
					                            <div class="file-settings">
					                            	
							                        <div class="btn-group dropdown">
							                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
							                            <ul class="dropdown-menu dropdown-menu-right" style="">
							                                <li><a href="assets/drive_file/<?= $account_id; ?>/<?= $row['drive_file']; ?>" target="_blank">
								                                	<i class="icon-lg icon-fw demo-pli-download-from-cloud"></i> Download
								                                </a>
							                                </li>
							                        </div>


					                            </div>
					                            <div class="file-attach-icon"></div>
					                            <a href="#" class="file-details">
					                                <div class="media-block">
					                                    <div class="media-left"><i class="<?= $type['drive_icon']; ?>"></i></div>
					                                    <div class="media-body">
					                                        <p class="file-name"><?= $row['drive_file']; ?></p>
					                                        <small><?= $row['account_username']; ?> | <?= $row['jam']; ?> | <?= round($row['drive_size']/10000,0,2); ?> MB</small>
					                                    </div>
					                                </div>
					                            </a>
					                        </li>



					                    <?php } ?>
					

					                    </ul>
					                    <p>&nbsp;</p>
					                    <p>&nbsp;</p>
					                    <p>&nbsp;</p>
					                </div>
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



