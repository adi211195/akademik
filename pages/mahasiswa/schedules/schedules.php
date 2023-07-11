			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Schedules</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Schedules</li>
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

                $page_print="pages/print/schedules.php?sy=".$sy."&sm=".$sm;
                $page_input="page.php?p=schedules&act=input";
                $page_edit="page.php?p=schedules&act=edit";
                $back="page.php?p=schedules";
                $action="pages/administrator/schedules/action.php";

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
					                    <h3 class="panel-title">Schedules Data</h3>
					                </div>

					               
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                	 <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">

					                            	<a href="<?= $page_print; ?>">
					                                <button class="btn btn-danger"><i class="fa fa-print"></i> Print</button></a>

					                                 <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>
              
					                            </div>
					                        </div>
					                    </div>

					                    <div class="table-responsive">
					                        <table class="table table-striped">
					                            <?php
					                            $data=mysqli_query($connect, "SELECT * FROM master_day");
					                            while ($day=mysqli_fetch_array($data)) {
					                            ?>

					                            <thead>
					                                <tr>
					                                    <th colspan="6"><?= $day['day']; ?></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data2=mysqli_query($connect, "SELECT * FROM master_krs as mk, 
					                            		master_curriculum as mc
									                    LEFT JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
									                    LEFT JOIN master_class as mclass ON mclass.class_code=mc.class_code
									                    LEFT JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
									                    LEFT JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					                            		WHERE 
					                            		mk.curriculum_id=mc.curriculum_id AND
					                            		mc.curriculum_day='$day[day]' AND
					                            		mk.krs_school_year='$sy' AND
					                            		mk.krs_semester='$sm' AND 
					                            		mk.student_nim='$student_nim' AND 
					                            		mk.krs_approved='Approved'");					                            	
					                            	while ($row=mysqli_fetch_array($data2)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['curriculum_types']; ?></td>
									                    <td><?= $row['class_room']; ?>/<?= $row['class']; ?></td>
									                    <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?>
									                            <span class="badge badge-success"><?= $row['courses_sks']; ?> SKS</span>
									                    </td>
									                    <td><?= $row['lecturer_name']; ?></td>
									                    <td><?= $row['curriculum_day']; ?>, <?= substr($row['curriculum_start'],0,5); ?> - <?= substr($row['curriculum_end'],0,5); ?></td>
					                                </tr>
					                            	<?php $no++; } ?>
					                            </tbody>
					                        	<?php } ?>
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
				        <h4 class="modal-title">Filter KRS </h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="krs">
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


                <?php 
                break;
                
                } ?>

            </div>



