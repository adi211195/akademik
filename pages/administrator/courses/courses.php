			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Courses</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Courses</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                if (empty(@$_GET['code'])) {
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code"));
                	$majors_code=$code['majors_code'];
                } else {
                	$majors_code=htmlspecialchars(@$_GET['code']);
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
					                            		WHERE majors_code='$majors_code'"));
                }

                $page_input="page.php?p=courses&act=input&code=".$code['majors_code'];
                $page_edit="page.php?p=courses&act=edit&code=".$code['majors_code'];
                $back="page.php?p=courses&code=".$code['majors_code'];
                $action="pages/administrator/courses/action.php";
                

                

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
					                    <h3 class="panel-title">Courses Data</h3>
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
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>


					                    <div class="table-responsive">
					                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Courses Code</th>
					                                    <th>Courses</th>
					                                    <th>SKS</th>
					                                    <th>SMT Distribution</th>
					                                    <th>Lowest Value</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_courses
					                            		where majors_code='$majors_code'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['courses_code']; ?></td>
					                                    <td><?= $row['courses']; ?></td>
					                                    <td><?= $row['courses_sks']; ?></td>
					                                    <td><?= $row['courses_smt']; ?></td>
					                                    <td><?= $row['courses_low_value']; ?></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['courses_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['courses_id']; ?>">
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
				        <h4 class="modal-title">Filter Courses</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <div class="modal-body">
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
                case 'input':
                $low_value= array('A','B','C','D','E');
               	?>

               	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Add Courses</h3>
					            </div>

					            <div class="panel-body">
					            	<div class="alert alert-info">
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						        	</div>
					            </div>
					            
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					            	<input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
					                <div class="panel-body">
					                	
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Courses Code <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="courses_code" placeholder="courses Code" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Courses <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="courses" placeholder="courses" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        SKS <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="number" name="courses_sks" placeholder="SKS" class="form-control"  required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        SMT Distribution <span class="required">*</span></label>
					                        <div class="col-sm-2">
					                            <input type="number" name="courses_smt" placeholder="SMT Distribution" class="form-control"  required>
					                        </div>
					                    </div>	

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Lowest Value <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="courses_low_value" class="form-control"  required>
					                            	<option value="">-- Select --</option>
					                            	<?php foreach ($low_value as $lw) { ?>
					                            		<option value="<?= $lw; ?>"><?= $lw; ?></option>					                            		
					                            	<?php } ?>
					                            </select>
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
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_courses 
                	where courses_id='$id'"));
                $low_value= array('A','B','C','D','E');
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Courses</h3>
					            </div>

					            <div class="panel-body">
					            	<div class="alert alert-info">
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						        	</div>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<input type="hidden" name="id" value="<?= $id; ?>">
					            	<input type="hidden" name="majors_code" value="<?= $code['majors_code']; ?>">
					                <div class="panel-body">					                	

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Courses Code <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="courses_code" placeholder="courses Code" class="form-control" value="<?= $row['courses_code']; ?>" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Courses <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="courses" placeholder="courses" class="form-control" value="<?= $row['courses']; ?>" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        SKS <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="number" name="courses_sks" placeholder="SKS" class="form-control" value="<?= $row['courses_sks']; ?>" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        SMT Distribution <span class="required">*</span></label>
					                        <div class="col-sm-2">
					                            <input type="number" name="courses_smt" placeholder="SMT Distribution" class="form-control" value="<?= $row['courses_smt']; ?>" required>
					                        </div>
					                    </div>					                    
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Lowest Value <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="courses_low_value" class="form-control"  required>
					                            	<option value="">-- Select --</option>
					                            	<?php foreach ($low_value as $lw) { 
					                            		if ($row['courses_low_value']==$lw) { ?>
					                            			<option value="<?= $lw; ?>" selected><?= $lw; ?></option>	
					                            		<?php } else { ?>
					                            			<option value="<?= $lw; ?>"><?= $lw; ?></option>	
					                            	<?php }} ?>
					                            </select>
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



