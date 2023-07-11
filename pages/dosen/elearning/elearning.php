			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">E-learning</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">E-learning</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                

                if (empty(@$_GET['sy'])) {

                	$sy=$open_sy;
                	$sm=$open_sm;
                } else {
                	$sy 			=htmlspecialchars(@$_GET['sy']);
                	$sm 		=htmlspecialchars(@$_GET['sm']);
                	
                }
                $page_detail="page.php?p=elearning&sy=".$sy."&sm=".$sm;
               
                $action="pages/dosen/elearning/action.php";
                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:

                $folder 	=htmlspecialchars(@$_GET['folder']);
                
                $fdr=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
                	INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
                	LEFT JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
                	where curriculum_id='$folder'"));

                if (!empty($folder)){
                	 $back="page.php?p=elearning&sy=".$sy."&sm=".$sm."&folder=".$folder;
                } else {
                	 $back="page.php?p=elearning&sy=".$sy."&sm=".$sm;
                }

                ?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">

					    	<div class="panel-body">
               					<div class="alert alert-info">
               								School Year : <?= $sy; ?> <br>
					                    	Semester : <?= $sm; ?> 
						                </div>


						                <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>
						               </div>



					        <div class="pad-all file-manager">
					            <div class="fixed-fluid">
					                <div class="fluid file-panel">
					                    <div class="bord-btm pad-ver">
					                        <ol class="breadcrumb">
					                        	<?php if (!empty($folder)) { ?>
						                            <li><a href="#">E-learning</a></li>
						                            <li class="active"><?= $fdr['courses_code']; ?> | <?= $fdr['courses']; ?></li>
					                            <?php } else { ?>
					                            	<li class="active">E-learning</li>
					                            <?php } ?>
					                        </ol>
					                    </div>
					                    <div class="file-toolbar bord-btm">
					                        <div class="btn-file-toolbar">
					                            <a class="btn btn-icon add-tooltip" href="<?= $page_detail; ?>" data-original-title="Home" data-toggle="tooltip"><i class="icon-2x demo-pli-home"></i></a>
					                            <a class="btn btn-icon add-tooltip" href="<?= $back; ?>" data-original-title="Refresh" data-toggle="tooltip"><i class="icon-2x demo-pli-reload-3"></i></a>
					                        </div>
					                        <div class="btn-file-toolbar">
					                        	
					                        	<?php if (!empty($folder)) { ?>
					                            <a class="btn btn-icon add-tooltip" href="#" data-toggle="modal" data-target="#file"><i class="icon-2x demo-pli-file-add"></i></a>
					                            <?php } ?>
					                        </div>
					                    </div>
					                    <ul id="demo-mail-list" class="file-list">
											
										  <?php
										  if (empty($folder)) {
						                       $data=mysqli_query($connect, "SELECT mc.*, mct.*, mclass.*, mcourses.*, mlecturer.*, mlecturer.account_id as act FROM  
					                            		master_curriculum as mc
									                    LEFT JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
									                    LEFT JOIN master_class as mclass ON mclass.class_code=mc.class_code
									                    LEFT JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
									                    LEFT JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					                            		WHERE 
					                            		mc.curriculum_school_year='$sy' AND
					                            		mc.curriculum_semester='$sm' AND 
					                            		mc.lecturer_code='$lecturer_code'");

						                       while ($row=mysqli_fetch_array($data)) {						              
						                       	$size=mysqli_fetch_array(mysqli_query($connect, "SELECT sum(elearning_size) as size FROM 
						                       		elearning where account_id='$row[act]' AND curriculum_id='$row[curriculum_id]'"));
						                       ?>
						
						                        <!--File list item-->
						                        <li>
						                            <div class="file-control">
						                                <input id="file-list-5" class="magic-checkbox" type="checkbox">
						                                <label for="file-list-5"></label>
						                            </div>
						                            <div class="file-settings"><a href="#"><i class="pci-ver-dots"></i></a></div>
						                            <div class="file-attach-icon"></div>
						                            <a href="<?= $page_detail; ?>&folder=<?= $row['curriculum_id']; ?>" class="file-details">
						                                <div class="media-block">
						                                    <div class="media-left"><i class="demo-psi-folder"></i></div>
						                                    <div class="media-body">
						                                        <p class="file-name"><?= $row['courses_code']; ?> | <?= $row['courses']; ?></p>
						                                        <small>
						                                        	<?= $row['class_room']; ?>/<?= $row['class']; ?> |
						                                        	<?= $row['curriculum_day']; ?>, <?= $row['curriculum_start']; ?> - <?= $row['curriculum_end']; ?> | 
						                                        	<?= round($size['size']/1000,0,2); ?> MB</small>
						                                    </div>
						                                </div>
						                            </a>
						                        </li>

						                    <?php }} ?>


					                       <?php
					                       if (!empty($folder)) {
					                       $data=mysqli_query($connect,"SELECT elearning.*,
					                       DATE_FORMAT(create_date, '%d %b %Y %H:%i %p') as jam
					                       FROM elearning 
					                       		where account_id='$fdr[account_id]' 
					                       		AND curriculum_id='$folder' order by elearning_file asc");
					                       while ($row=mysqli_fetch_array($data)) {
					                       	$type=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM elearning_type where elearning_type='$row[elearning_type]'"));
					                       ?>
					
					                        <!--File list item-->
					                        <li>
					                            <div class="file-control">
					                                <input id="file-list-5" class="magic-checkbox" type="checkbox">
					                                <label for="file-list-5"></label>
					                            </div>
					                            <div class="file-settings">
					                            	<div class="btn-group dropdown">
							                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
							                            <ul class="dropdown-menu dropdown-menu-right" style="">
							                                
							                                <li><a href="download_file.php?act=elearning&file=<?= $row['account_id']; ?>!<?= $row['elearning_id']; ?>" target="_blank">
								                                	<i class="icon-lg icon-fw demo-pli-download-from-cloud"></i> Download
								                                </a>
							                                </li>
							                                
							                                <li><a href="#" onclick="data_remove('<?= $row['elearning_id']; ?>');">
							                                	<i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a>
							                                </li>
							                        </div>
					                            </div>

					                            <div class="file-attach-icon"></div>
					                            <a href="#" class="file-details">
					                                <div class="media-block">
					                                    <div class="media-left"><i class="<?= $type['elearning_icon']; ?>"></i></div>
					                                    <div class="media-body">
					                                        <p class="file-name"><?= $row['elearning_file']; ?></p>
					                                        <small><?= $row['jam']; ?> | <?= round($row['elearning_size']/1000,0,2); ?> MB</small>
					                                    </div>
					                                </div>
					                            </a>
					                        </li>

					                    <?php }} ?>

					                    <p>&nbsp;</p>
					                    <p>&nbsp;</p>
					                    <p>&nbsp;</p>
					
					

					                    </ul>
					                </div>
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
				        <h4 class="modal-title">Filter E-learning</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $page_detail; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="elearning">
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
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
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
				      	<input type="hidden" name="curriculum_id" value="<?= $folder; ?>">
				      <div class="modal-body">
				        				


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	File <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="file" name="elearning_file" class="form-control" required>
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
                } ?>

            </div>



