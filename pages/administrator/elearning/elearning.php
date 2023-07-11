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
                	$mcurriculum=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum order by curriculum_school_year, curriculum_semester desc"));

                	$sy=$mcurriculum['curriculum_school_year'];
                	$sm=$mcurriculum['curriculum_semester'];
                } else {
                	$sy 			=htmlspecialchars(@$_GET['sy']);
                	$sm 		=htmlspecialchars(@$_GET['sm']);
                	
                }
                $page_detail="page.php?p=elearning&act=detail&sy=".$sy."&sm=".$sm;
                $back="page.php?p=elearning&sy=".$sy."&sm=".$sm;
                $action="pages/administrator/elearning/action.php";
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
					                    <h3 class="panel-title">E-learning Data</h3>
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
					                                    <th>Code</th>
					                                    <th>Name</th>
					                                    <th>Email</th>
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
					                                    <td><?= $row['lecturer_code']; ?></td>
					                                    <td><?= $row['lecturer_name']; ?></td>
					                                    <td><?= $row['account_email']; ?></td>
					                                    <td>
					                                    	<a href="<?= $page_detail; ?>&id=<?= $row['account_id']; ?>">
						                               		 <button class="btn btn-warning" title="Detail"><i class="demo-pli-data-settings"></i></button></a> 
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
                $id 		=htmlspecialchars(@$_GET['id']);
                $folder 	=htmlspecialchars(@$_GET['folder']);
                $details=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_lecturer ON master_lecturer.account_id=account.account_id
                	where account.account_id='$id'"));
                $fdr=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
                	INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
                	where curriculum_id='$folder' AND 
                	lecturer_code='$details[lecturer_code]'"));


                $page_detail="page.php?p=elearning&act=detail&id=$id&sy=".$sy."&sm=".$sm;
                if (!empty($folder)){
                	 $back="page.php?p=elearning&id=$id&sy=".$sy."&sm=".$sm."&folder=".$folder;
                } else {
                	 $back="page.php?p=elearning&id=$id&sy=".$sy."&sm=".$sm;
                }
                ?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">

					    	<div class="panel-body">
               					<div class="alert alert-info">
               								School Year : <?= $sy; ?> <br>
					                    	Semester : <?= $sm; ?> <br>
						                    Code : <?= $details['lecturer_code']; ?> <br> 
					                        Name : <?= $details['lecturer_name']; ?> <br> 
					                        Email : <?= $details['account_email']; ?>
						                </div>

						                <a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>

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
					                    </div>
					                    <ul id="demo-mail-list" class="file-list">
											
										  <?php
										  if (empty($folder)) {
						                       $data=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
					                            		INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					                            		INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					                            		INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					                            		where 
					                            		mc.lecturer_code='$details[lecturer_code]' AND
					                            		mc.curriculum_school_year='$sy' AND
					                            		mc.curriculum_semester='$sm'");

						                       while ($row=mysqli_fetch_array($data)) {						              
						                       	$size=mysqli_fetch_array(mysqli_query($connect, "SELECT sum(elearning_size) as size FROM 
						                       		elearning where account_id='$id' AND curriculum_id='$row[curriculum_id]'"));
						                       ?>
						
						                        <!--File list item-->
						                        <li>
						                            <div class="file-control">
						                                <input id="file-list-5" class="magic-checkbox" type="checkbox">
						                                <label for="file-list-5"></label>
						                            </div>
						                            <div class="file-settings"><a href="#"><i class="pci-ver-dots"></i></a></div>
						                            <div class="file-attach-icon"></div>
						                            <a href="<?= $page_detail; ?>&id=<?= $id; ?>&folder=<?= $row['curriculum_id']; ?>" class="file-details">
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
					                       		where account_id='$id' 
					                       		AND curriculum_id='$folder' order by elearning_file asc");
					                       while ($row=mysqli_fetch_array($data)) {
					                       	$type=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM elearning_type where elearning_type='$row[elearning_type]'"));
					                       ?>
					
					                        <!--File list item-->
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
				<div id="filter" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Filter E-learning</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="elearning">
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


                <?php	break;
                } ?>

            </div>



