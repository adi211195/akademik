			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Ijasah Student</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Ijasah Student</li>
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
                	$majors_code	=htmlspecialchars(@$_GET['code']);
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
					                            		WHERE majors_code='$majors_code'"));
                }

                $page_input="page.php?p=ijasah&act=input&code=".$code['majors_code'];
                $page_edit="page.php?p=ijasah&act=edit&code=".$code['majors_code'];
                $back="page.php?p=ijasah&code=".$code['majors_code'];
                $action="pages/administrator/ijasah/action.php";
                $page_print="pages/administrator/ijasah/report_pdf.php";

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
					                    <h3 class="panel-title">Ijasah Student Data </h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">

					                                <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>

					                                <button class="btn btn-primary" data-toggle="modal" data-target="#open_student"><i class="fa fa-plus"></i> Ijasah Student </button>

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
					                                    <th>NIM</th>
					                                    <th>Name</th>
					                                    <th>Gender</th>
					                                    <th>Ijasah</th>
					                                    <th>Graduate date</th>
					                                    <th>Study Concentration</th>	
					                                    <td></td>				                                    
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_ijasah
					                            		LEFT JOIN master_student ON master_student.student_nim=master_ijasah.student_nim

					                            		WHERE 
														master_student.majors_code='$majors_code'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['student_nim']; ?></td>
					                                    <td><?= $row['student_name']; ?></td>
					                                    <td><?= $row['student_gender']; ?></td>
					                                    <td><?= $row['ijasah_number']; ?></td>
					                                    <td><?= $row['ijasah_date']; ?></td>
					                                    <td><?= $row['ijasah_concentration']; ?></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['ijasah_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['ijasah_id']; ?>">
						                               		 <button class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button></a>

						                               		 <a href="<?= $page_print; ?>?id=<?= $row['ijasah_id']; ?>" target="_blank">
						                               		 <button class="btn btn-default" title="Print"><i class="fa fa-print"></i></button></a> 
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
				        <h4 class="modal-title">Filter Student</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="ijasah">
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


				<div id="open_student" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Ijasah Student</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="input">
				      <div class="modal-body">

				      					<div class="alert alert-info">
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>

					                   				      					
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	NIM | Status | Name Student <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Search by nim / name" autocomplete="off" required/>  
          										<div id="student_nameList"></div>

					                        </div>
					                    </div>

					                    <div class="form-group">
					                       <label class="col-lg-3 control-label">Graduated Date</label>
					                       <div class="col-lg-9 pad-no">
					                             <div class="clearfix">					                             
					                            <div class="col-lg-4">
					                                <div id="demo-dp-txtinput">
										                <input type="text" placeholder="Date" name="ijasah_date" autocomplete="off" class="form-control" required>
										            </div>	
					                            </div>
					                           </div>
					                        </div>
					                     </div>

					                     <div class="form-group">
					                       <label class="col-lg-3 control-label">Ijasah Number</label>
					                       <div class="col-lg-9">
										          <input type="text" name="ijasah_number"class="form-control" required>
					                        </div>
					                     </div>


					                     <div class="form-group">
					                       <label class="col-lg-3 control-label">Study Concentration</label>
					                       <div class="col-lg-9">
										          <input type="text" name="ijasah_concentration"class="form-control" required>
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


                <?php 
                break;
                case 'edit':
                $id 		=htmlspecialchars($_GET['id']);
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_ijasah 
                	LEFT JOIN master_student ON master_student.student_nim=master_ijasah.student_nim
                	where ijasah_id='$id'"));

                $status=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student_history
                                            WHERE student_nim='$row[student_nim]' AND
                                            student_history_school_year='$open_sy' AND
                                            student_history_semester='$open_sm'"));
			    if (empty($status['student_history_status'])) {
			          $cekstatus="Empty";
			    } else {
			          $cekstatus=$status['student_history_status'];
			    }

                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Ijasah</h3>
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
					                        	NIM | Status | Name Student <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="student_name" class="form-control" value="<?= $row['student_nim'].'|'.$cekstatus.'|'.$row['student_name']; ?>" readonly>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                       <label class="col-lg-3 control-label">Graduated Date</label>
					                       <div class="col-lg-9 pad-no">
					                             <div class="clearfix">					                             
					                            <div class="col-lg-4">
					                                <div id="demo-dp-txtinput">
										                <input type="text" placeholder="Date" name="ijasah_date" value="<?= $row['ijasah_date']; ?>" class="form-control" required>
										            </div>	
					                            </div>
					                           </div>
					                        </div>
					                     </div>

					                     <div class="form-group">
					                       <label class="col-lg-3 control-label">Ijasah Number</label>
					                       <div class="col-lg-9">
										          <input type="text" name="ijasah_number" value="<?= $row['ijasah_number']; ?>" class="form-control" required>
					                        </div>
					                     </div>


					                     <div class="form-group">
					                       <label class="col-lg-3 control-label">Study Concentration</label>
					                       <div class="col-lg-9">
										          <input type="text" name="ijasah_concentration" value="<?= $row['ijasah_concentration']; ?>" class="form-control" required>
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



