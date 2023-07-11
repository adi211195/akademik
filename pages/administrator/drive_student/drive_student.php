			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Drive Academic Student</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Drive Academic Student</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                if (empty(@$_GET['code'])) {
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code"));        

                	$majors_code=$code['majors_code'];
                	$thn2=date('Y')+1;
                	$gen=date('Y')."/".$thn2;
                } else {
                	$majors_code	=htmlspecialchars(@$_GET['code']);
                	$gen 			=htmlspecialchars(@$_GET['gen']);
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
					                            		WHERE majors_code='$majors_code'"));
                }

                $page_detail="page.php?p=drive_student&act=detail&code=".$code['majors_code']."&gen=".$gen;
                $back="page.php?p=drive_student&code=".$code['majors_code']."&gen=".$gen;
                $action="pages/administrator/drive_student/action.php";

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
					                    <h3 class="panel-title">Drive Academic Student Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">

					                                <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>
              
					                            </div>
					                        </div>
					                    </div>

					                    <div class="alert alert-info">
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>

					                    <div class="table-responsive">
					                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Photo</th>
					                                    <th>NIM</th>
					                                    <th>Name</th>
					                                    <th>Email</th>
					                                    <th>Free Data Usage</th>
					                                    <th>Data Usage</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM account
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		account_status='Mahasiswa'");
					                            	while ($row=mysqli_fetch_array($data)) {

					                            		$amount=mysqli_fetch_array(mysqli_query($connect,"SELECT sum(drive_size) as size FROM drive_academic
                            							 where account_id='$row[account_id]'"));
														$persentase=round($amount['size']/10000,0,2); 
														$free=100-$persentase;

					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><img src="assets/account_photo/<?= $row['account_photo']; ?>" alt="" style="width: 50px;"></td>
					                                    <td><?= $row['student_nim']; ?></td>
					                                    <td><?= $row['student_name']; ?></td>
					                                    <td><?= $row['account_email']; ?></td>
					                                    <td><?= $free; ?> MB</td>
					                                    <td><?= $persentase; ?> MB</td>
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


                <!-- Modal -->
				<div id="filter" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Filter Drive Student</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="drive_student">
				      <div class="modal-body">
				      					<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Generation <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="gen" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$start=date('Y')-2;
					                            	$end=date('Y')+1;
					                            	for ($i=$start; $i <= $end ; $i++) { 
					                            		$generation=$i."/".($i+1);
					                            		if ($generation==$gen) {
					                            	?>
					                            		<option value="<?= $generation; ?>" selected><?= $generation; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $generation; ?>"><?= $generation; ?></option>
					                            	 <?php } } ?>
					                            	
					                            </select>
					                        </div>
					                    </div>

				        				<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	College <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select id="college_code" onchange="select_majors(this.value);" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_college");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($code['college_code']==$opt['college_code']) {
					                            	?>
					                            		<option value="<?= $opt['college_code']; ?>" selected><?= $opt['college']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['college_code']; ?>"><?= $opt['college']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Majors <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="code" id="majors_code" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_majors");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($code['majors_code']==$opt['majors_code']) {
					                            	?>
					                            		<option value="<?= $opt['majors_code']; ?>" selected><?= $opt['majors']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['majors_code']; ?>"><?= $opt['majors']; ?></option>
					                            	<?php }} ?>
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


                <?php 
                break;
                case 'detail':
                $id 		=htmlspecialchars(@$_GET['id']);
                $folder 	=htmlspecialchars(@$_GET['folder']);
                $details=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_student ON master_student.account_id=account.account_id
                	where account.account_id='$id'"));
                $fdr=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM drive_folder 
                	where account_id='$id' AND folder_id='$folder'"));

                if (!empty($folder)){
                	$back="page.php?p=drive_student&act=detail&id=$id&folder=".$folder;
                } else {
                	$back="page.php?p=drive_student&act=detail&id=$id";
                }
                $back2="page.php?p=drive_student";

                ?>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">

					    	<div class="panel-body">
               					<div class="alert alert-info">
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?> <br> 
						                    NIM : <?= $details['student_nim']; ?> <br> 
					                        Name : <?= $details['student_name']; ?> <br> 
					                        Email : <?= $details['account_email']; ?>
						                </div>
						                <a href="<?= $back2; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
						               </div>

					        <div class="pad-all file-manager">
					            <div class="fixed-fluid">
					                <div class="fixed-sm-200 pull-sm-left file-sidebar">
					
					
					
					                    <p class="pad-hor mar-top text-main text-bold text-sm text-uppercase">Folders</p>
					                    <div class="list-group bg-trans pad-btm bord-btm">
					                        <a href="<?= $page_detail; ?>&id=<?= $id; ?>" class="list-group-item">
					                        <i class="demo-pli-folder icon-lg icon-fw"></i> ...
					                    </a>
					                        
					                    <?php 
					                    $data=mysqli_query($connect, "SELECT * FROM drive_folder where account_id='$id' order by folder_name asc");
					                    while ($row=mysqli_fetch_array($data)) {
					                    	if ($row['folder_id']==$folder) {
					                    ?>
					                        <a href="<?= $page_detail; ?>&id=<?= $id; ?>&folder=<?= $row['folder_id']; ?>" class="list-group-item">
					                        <i class="demo-pli-folder icon-lg icon-fw"></i><b> <?= $row['folder_name']; ?></b>
					                    </a>
					                    <?php } else { ?>
					                    	<a href="<?= $page_detail; ?>&id=<?= $id; ?>&folder=<?= $row['folder_id']; ?>" class="list-group-item">
					                        <i class="demo-pli-folder icon-lg icon-fw"></i> <?= $row['folder_name']; ?>
					                    </a>
					                    <?php }} ?>
					                    </div>
					
					                </div>
					                <div class="fluid file-panel">
					                    <div class="bord-btm pad-ver">
					                        <ol class="breadcrumb">
					                        	<?php if (!empty($folder)) { ?>
						                            <li><a href="#">Drive Academic Student</a></li>
						                            <li class="active"><?= $fdr['folder_name']; ?></li>
					                            <?php } else { ?>
					                            	<li class="active">Drive Academic Student</li>
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
						                       $data=mysqli_query($connect,"SELECT drive_folder.*,
						                       DATE_FORMAT(create_date, '%d %b %Y %H:%i %p') as jam
						                       FROM drive_folder where account_id='$id' order by folder_name asc");
						                       while ($row=mysqli_fetch_array($data)) {						              
						                       	$size=mysqli_fetch_array(mysqli_query($connect, "SELECT sum(drive_size) as size FROM 
						                       		drive_academic where account_id='$id' AND folder_id='$row[folder_id]'"));
						                       ?>
						
						                        <!--File list item-->
						                        <li>
						                            <div class="file-control">
						                                <input id="file-list-5" class="magic-checkbox" type="checkbox">
						                                <label for="file-list-5"></label>
						                            </div>
						                            
						                            <div class="file-attach-icon"></div>
						                            <a href="<?= $page_detail; ?>&id=<?= $id; ?>&folder=<?= $row['folder_id']; ?>" class="file-details">
						                                <div class="media-block">
						                                    <div class="media-left"><i class="demo-psi-folder"></i></div>
						                                    <div class="media-body">
						                                        <p class="file-name"><?= $row['folder_name']; ?></p>
						                                        <small><?= $row['jam']; ?> | <?= round($size['size']/1000,0,2); ?> MB</small>
						                                    </div>
						                                </div>
						                            </a>
						                        </li>

						                    <?php }} ?>


					                       <?php
					                       $data=mysqli_query($connect,"SELECT drive_academic.*,
					                       DATE_FORMAT(create_date, '%d %b %Y %H:%i %p') as jam
					                       FROM drive_academic 
					                       		where account_id='$id' 
					                       		AND folder_id='$folder' order by drive_file asc");
					                       while ($row=mysqli_fetch_array($data)) {
					                       	$type=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM drive_type where drive_type='$row[drive_type]'"));
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
							                                <li><a href="download_file.php?act=drive&file=<?= $id; ?>!<?= $row['drive_id']; ?>" target="_blank">
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
					                                        <small><?= $row['jam']; ?> | <?= round($row['drive_size']/1000,0,2); ?> MB</small>
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



                <?php	break;
                } ?>

            </div>



