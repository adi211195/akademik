			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Teaching Salary</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Teaching Salary</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $month= array('01','02','03','04','05','06','07','08','09','10','11','12');
                if (empty(@$_GET['month'])) {
                	$month2=date('m');
                	$year=date('Y');
                } else {
                	$month2=$_GET['month'];
                	$year=$_GET['year'];
                }

                $page_input="page.php?p=salary_teaching&act=input";
                $page_edit="page.php?p=salary_teaching&act=edit";
                $back="page.php?p=salary_teaching";
                $action="pages/administrator/salary_teaching/action.php";
                

                

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
					                    <h3 class="panel-title">Teaching Salary Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                            	<a href="<?= $page_input; ?>">
					                                <button class="btn btn-purple"><i class="demo-pli-add icon-fw"></i>Add</button></a> 
					                                <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>
              
					                            </div>
					                        </div>
					                    </div>

					                    <div class="alert alert-info">
						                    Month - Year : <?= $month2; ?> - <?= $year; ?>
						                </div>


					                    <div class="table-responsive">
					                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Lecturer Code</th>
					                                    <th>Lecturer Name</th>
					                                    <th>Month - Year</th>
					                                    <th>Salary</th>
					                                    <th>Status</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM salary_teaching
					                            		LEFT JOIN master_lecturer as ml ON ml.lecturer_code=salary_teaching.lecturer_code
					                            		WHERE salary_month='$month2' AND salary_year='$year'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['lecturer_code']; ?></td>
					                                    <td><?= $row['lecturer_name']; ?></td>
					                                    <td><?= $row['salary_month']; ?> - <?= $row['salary_year']; ?></td>
					                                    <td><?= number_format($row['lecturer_salary']); ?></td>
					                                    <td><?= $row['salary_status']; ?></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['teaching_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['teaching_id']; ?>">
						                               		 <button class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button></a> 
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
				        <h4 class="modal-title">Filter Teaching Salary</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="salary_teaching">
				      <div class="modal-body">
				      				<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Month - Year <span class="required">*</span></label>
					                        <div class="col-sm-3">
					                            <select name="month" class="form-control">
					                            	<?php
					                            	foreach ($month as $row) {
					                            	if ($row==$month2) { ?>
					                            		<option value="<?= $row; ?>" selected><?= $row; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $row; ?>"><?= $row; ?></option>
					                            	<?php }} ?>
					                            </select>	
					                        </div>
					                        <div class="col-sm-3">
					                            <select name="year" class="form-control">
					                            	<?php
					                            	$yr=date('Y');
					                            	for ($i='2010'; $i <= $yr ; $i++) { 
					                            	if ($i==$year) { ?>
					                            		<option value="<?= $i; ?>" selected><?= $i; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $i; ?>"><?= $i; ?></option>
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
                case 'input':
                
               	?>

               	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Add Teaching Salary</h3>
					            </div>
					            
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					                <div class="panel-body">
					                	
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Lecturer <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="lecturer_code" class="form-control" data-placeholder="Choose lecturer..." id="demo-chosen-select" required>
					                            	<?php
					                            	$data=mysqli_query($connect,"SELECT * FROM master_lecturer order by lecturer_code asc");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>	
					                            	<option value="<?= $row['lecturer_code']; ?>"> <?= $row['lecturer_code']; ?> | <?= $row['lecturer_name']; ?></option>

					                            	<?php } ?>
					                            </select>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Month - Year <span class="required">*</span></label>
					                        <div class="col-sm-2">
					                            <select name="salary_month" class="form-control">
					                            	<?php
					                            	foreach ($month as $row) {
					                            	if ($row==$month2) { ?>
					                            		<option value="<?= $row; ?>" selected><?= $row; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $row; ?>"><?= $row; ?></option>
					                            	<?php }} ?>
					                            </select>	
					                        </div>
					                        <div class="col-sm-2">
					                            <select name="salary_year" class="form-control">
					                            	<?php
					                            	$yr=date('Y');
					                            	for ($i='2010'; $i <= $yr ; $i++) { 
					                            	if ($i==$year) { ?>
					                            		<option value="<?= $i; ?>" selected><?= $i; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $i; ?>"><?= $i; ?></option>
					                            	<?php }} ?>
					                            </select>	
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Lecturer Status <span class="required">*</span></label>
					                        <div class="col-sm-3">
					                            <select name="salary_status" class="form-control"  required>
					                            	<option value="Fixed">Fixed</option>
					                            	<option value="Not Fixed">Not Fixed</option>
					                            </select>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Salary <span class="required">*</span></label>
					                        <div class="col-sm-4">
					                            <input type="number" name="lecturer_salary" placeholder="salary" class="form-control"  required>
					                        </div>
					                    </div>					                    
					                    
					                </div>
					                <div class="panel-footer text-right">
					                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
					                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
               		</div>
               	</div>

                <?php	break;
                case 'edit':
                $id 		=htmlspecialchars($_GET['id']);
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM salary_teaching 
                	where teaching_id='$id'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Teaching Salary</h3>
					            </div>

					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<input type="hidden" name="id" value="<?= $id; ?>">
					                <div class="panel-body">					                	

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Lecturer <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="lecturer_code" class="form-control" data-placeholder="Choose lecturer..." id="demo-chosen-select" required>
					                            	<?php
					                            	$data=mysqli_query($connect,"SELECT * FROM master_lecturer order by lecturer_code asc");
					                            	while ($row2=mysqli_fetch_array($data)) {
					                            		if ($row['lecturer_code']==$row2['lecturer_code']) {
					                            	?>	
					                            		<option value="<?= $row2['lecturer_code']; ?>" selected> <?= $row2['lecturer_code']; ?> | <?= $row2['lecturer_name']; ?></option>
					                            	<?php } else { ?>}
					                            		<option value="<?= $row2['lecturer_code']; ?>"> <?= $row2['lecturer_code']; ?> | <?= $row2['lecturer_name']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Month - Year <span class="required">*</span></label>
					                        <div class="col-sm-2">
					                            <select name="salary_month" class="form-control">
					                            	<?php
					                            	foreach ($month as $row) {
					                            	if ($row==$row['salary_month']) { ?>
					                            		<option value="<?= $row; ?>" selected><?= $row; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $row; ?>"><?= $row; ?></option>
					                            	<?php }} ?>
					                            </select>	
					                        </div>
					                        <div class="col-sm-2">
					                            <select name="salary_year" class="form-control">
					                            	<?php
					                            	$yr=date('Y');
					                            	for ($i='2010'; $i <= $yr ; $i++) { 
					                            	if ($i==$row['salary_year']) { ?>
					                            		<option value="<?= $i; ?>" selected><?= $i; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $i; ?>"><?= $i; ?></option>
					                            	<?php }} ?>
					                            </select>	
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Lecturer Status <span class="required">*</span></label>
					                        <div class="col-sm-3">
					                            <select name="salary_status" class="form-control"  required>
					                            	<?php if ($row['salary_status']=="Fixed") { ?>
						                            	<option value="Fixed">Fixed</option>
						                            	<option value="Not Fixed">Not Fixed</option>
					                            	<?php } else { ?>
					                            		<option value="Not Fixed">Not Fixed</option>
					                            		<option value="Fixed">Fixed</option>
					                            	<?php } ?>
					                            </select>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Salary <span class="required">*</span></label>
					                        <div class="col-sm-4">
					                            <input type="number" name="lecturer_salary" value="<?= $row['lecturer_code']; ?>" placeholder="salary" class="form-control"  required>
					                        </div>
					                    </div>				

					                </div>
					                <div class="panel-footer text-right">
					                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
					                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
               		</div>
               	</div>


                <?php	break;
                } ?>

            </div>



