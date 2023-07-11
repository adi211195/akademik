			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Alumni</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Alumni</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_input="page.php?p=alumni&act=input";
                $page_edit="page.php?p=alumni&act=edit";
                $back="page.php?p=alumni";
                $action="pages/administrator/alumni/action.php";

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
					                    <h3 class="panel-title">Alumni Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                            	<a href="<?= $page_input; ?>">
					                                <button class="btn btn-purple"><i class="demo-pli-add icon-fw"></i>Add</button></a> 

					                                <div class="btn-group">
							                            <div class="dropdown">
							                                <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
							                                    Print <i class="dropdown-caret"></i>
							                                </button>
							                                <ul class="dropdown-menu dropdown-menu-right">
							                                    <li class="dropdown-header">List Print</li>
							                                    <li><a href="#" data-toggle="modal" data-target="#pdf">PDF</a></li>
							                                    <li><a href="#" data-toggle="modal" data-target="#excel">Excel</a></li>
							                                    <li class="divider"></li>
							                                    <li><a href="#" data-toggle="modal" data-target="#import">Import</a></li>
							                                </ul>
							                            </div>
							                        </div>
              
					                            </div>
					                        </div>
					                    </div>
					                    <div class="table-responsive">
					                        
					                        <table class="table table-striped table-bordered table-alumni" cellspacing="0" width="100%">
					                        	<thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>NPM</th>
					                                    <th>Name</th>
					                                    <th>Email</th>
					                                    <th>Block</th>
					                                    <th>Yudisium</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
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

                <div id="import" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Import Alumni</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="import">
				      <div class="modal-body">

				      					<div class="alert alert-info">
					                    	* Format File .xls
						                </div>
				      					
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	File <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="file" name="file" id="file" accept=".xls">
					                        </div>
					                    </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-import"></i> Import</button>
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
               		<div class="panel">
					    <div class="eq-height clearfix">
					        <div class="col-md-3 eq-box-md text-center box-vmiddle-wrap bord-hor">
					
					            <!-- Simple Promotion Widget -->
					            <!--===================================================-->
					            <div class="box-vmiddle pad-all">
					                <h3 class="text-main">Add Alumni</h3>
					                <div class="pad-ver">
					                    <i class="demo-pli-bag-coins icon-5x"></i>
					                </div>
					                <i class="demo-pli-male icon-2x"></i>
					            </div>
					            <!--===================================================-->
					
					        </div>

					        <div class="col-md-9 eq-box-md eq-no-panel">
					
					            <!-- Main Form Wizard -->
					            <!--===================================================-->
					            <div id="demo-bv-wz">
					                <div class="wz-heading pad-top">
					
					                    <!--Nav-->
					                    <ul class="row wz-step wz-icon-bw wz-nav-off mar-top">
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab1">
					                                <span class="text-danger"><i class="demo-pli-information icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Account</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab2">
					                                <span class="text-warning"><i class="demo-pli-male icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Profile</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab3">
					                                <span class="text-info"><i class="demo-pli-home icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Address</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab4">
					                                <span class="text-success"><i class="demo-pli-medal-2 icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Finish</p>
					                            </a>
					                        </li>
					                    </ul>
					                </div>
					
					                <!--progress bar-->
					                <div class="progress progress-xs">
					                    <div class="progress-bar progress-bar-primary"></div>
					                </div>
					
					
					                <!--Form-->
					                <div id="demo-bv-wz-form">
					                <form class="form-horizontal action"  method="POST" enctype="multipart/form-data">
					                    <input type="hidden" name="action" value="input">
					                    <div class="panel-body">
					                        <div class="tab-content">
					
					                            <!--First tab-->
					                           <div id="demo-bv-tab1" class="tab-pane">
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">username</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" class="form-control" name="alumni_username" placeholder="username" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Password</label>
					                                    <div class="col-lg-9">
					                                        <input type="password" class="form-control" name="alumni_password" placeholder="Password" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Email address</label>
					                                    <div class="col-lg-9">
					                                        <input type="email" class="form-control" name="alumni_email" placeholder="Email" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Block</label>
					                                    <div class="col-lg-2">
					                                        <select class="form-control" name="alumni_block">
					                                        	<option value="No">No</option>
					                                        	<option value="Yes">Yes</option>
					                                        </select>
					                                    </div>
					                                </div>

					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Photo</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="alumni_photo">
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Second tab-->
					                            <div id="demo-bv-tab2" class="tab-pane">
					                                
					                            	<div class="form-group">
					                                    <label class="col-lg-2 control-label">NPM</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="NPM" name="alumni_npm" class="form-control" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="alumni_name" class="form-control" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Phone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Phone number" name="alumni_phone" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Date of birth</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                                <input type="text" placeholder="Place" name="alumni_place_birth" class="form-control" required>
					                                            </div>
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="alumni_date_birth" autocomplete="off" class="form-control" required>
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Gender</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="alumni_gender" value="Male" required>
					                                            <label for="demo-radio-1">Male</label>
					
					                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="alumni_gender" value="Female" required>
					                                            <label for="demo-radio-2">Female</label>
					
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Exit Type</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Exit Type" name="alumni_exit_type" class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Exit Date</label>
					                                    <div class="col-lg-9">
					                                        <div id="demo-dp-txtinput">
										                        <input type="text" placeholder="Date" name="alumni_exit_date" autocomplete="off" class="form-control" >
										                    </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Exit Semester</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Exit Semester" name="alumni_exit_semester" class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">IPK</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="IPK" name="alumni_ipk" class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">No Ijasah</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="No Ijasah" name="alumni_no_ijasah" class="form-control" >
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">File Ijazah</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="alumni_file_ijasah">
					                                        * format file .jpg, .png dan .pdf! 
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">File Transkrip Nilai</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="alumni_file_transkrip">
					                                        * format file .jpg, .png dan .pdf! 
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">File SCK</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="alumni_file_sck">
					                                        * format file .jpg, .png dan .pdf! 
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Third tab-->
					                            <div id="demo-bv-tab3" class="tab-pane">
					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="alumni_address" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Thesis</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Thesis" name="alumni_thesis" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Thesis Type</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Thesis Type" name="alumni_thesis_type" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">SK Yudisium Date</label>
					                                    <div class="col-lg-9">
					                                        <div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="alumni_sk_yudisium_date" autocomplete="off" class="form-control" required>
										                            </div>	
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">SK Yudisium</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="SK Yudisium" name="alumni_sk_yudisium" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Mentor I</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="Mentor I" name="alumni_mentor1" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Examiner I</label></div>
					                                            <div class="col-lg-5"><input type="text" placeholder="Examiner I" name="alumni_examiner1" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Mentor II</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="Mentor II" name="alumni_mentor2" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Examiner II</label></div>
					                                            <div class="col-lg-5"><input type="text" placeholder="Examiner II" name="alumni_examiner2" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Mentor III</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="Mentor III" name="alumni_mentor3" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Examiner III</label></div>
					                                            <div class="col-lg-5"><input type="text" placeholder="Examiner III" name="alumni_examiner3" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Location</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Location" name="alumni_location" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">No SK Task</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="No SK Task" name="alumni_sk_task_number" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Task Date</label></div>
					                                            <div class="col-lg-5">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="alumni_sk_task_date" autocomplete="off" class="form-control" required>
										                            </div></div>
					                                        </div>
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Company</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="Company Name" name="alumni_company" class="form-control">
					                                            </div>
					                                            <div class="col-lg-7"><input type="text" placeholder="Company Address" name="alumni_company_address" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Fourth tab-->
					                            <div id="demo-bv-tab4" class="tab-pane">
					                                <h4>Thank you</h4>
					                                <p>Click the finish button to complete the registration. </p>
					                            </div>
					                        </div>
					                    </div>
					
					
					                    <!--Footer buttons-->
					                    <div class="pull-right pad-rgt mar-btm">
					                    	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                        <button type="button" class="previous btn btn-success">Previous</button>
					                        <button type="button" class="next btn btn-success">Next</button>
					                        <button type="submit" class="finish btn btn-primary" disabled>Finish</button>
					                    </div>
					
					                </form>
					            	</div>
					            </div>
					            <!--===================================================-->
					            <!-- End of Main Form Wizard -->
					
					        </div>
					    </div>
					</div>
               	</div>

                <?php	break;
                case 'edit':
                $id 		=htmlspecialchars($_GET['id']);
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_alumni 
                	where alumni_id='$id'"));
                ?><div id="page-content">
               		<div class="panel">
					    <div class="eq-height clearfix">
					        <div class="col-md-3 eq-box-md text-center box-vmiddle-wrap bord-hor">
					
					            <!-- Simple Promotion Widget -->
					            <!--===================================================-->
					            <div class="box-vmiddle pad-all">
					                <h3 class="text-main">Edit alumni</h3>
					                <div class="pad-ver">
					                    <i class="demo-pli-bag-coins icon-5x"></i>
					                </div>
					                <i class="demo-pli-male icon-2x"></i>
					            </div>
					            <!--===================================================-->
					
					        </div>

					        <div class="col-md-9 eq-box-md eq-no-panel">
					            <!-- Main Form Wizard -->
					            <!--===================================================-->
					            <div id="demo-bv-wz">
					                <div class="wz-heading pad-top">
					
					                    <!--Nav-->
					                    <ul class="row wz-step wz-icon-bw wz-nav-off mar-top">
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab1">
					                                <span class="text-danger"><i class="demo-pli-information icon-2x"></i></span>
					                                <p class="text-semibold mar-no">alumni</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab2">
					                                <span class="text-warning"><i class="demo-pli-male icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Profile</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab3">
					                                <span class="text-info"><i class="demo-pli-home icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Address</p>
					                            </a>
					                        </li>
					                        <li class="col-xs-3">
					                            <a data-toggle="tab" href="#demo-bv-tab4">
					                                <span class="text-success"><i class="demo-pli-medal-2 icon-2x"></i></span>
					                                <p class="text-semibold mar-no">Finish</p>
					                            </a>
					                        </li>
					                    </ul>
					                </div>
					
					                <!--progress bar-->
					                <div class="progress progress-xs">
					                    <div class="progress-bar progress-bar-primary"></div>
					                </div>
					
					
					                <!--Form-->
					                <div id="demo-bv-wz-form">
					                <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					                    <input type="hidden" name="action" value="edit">
					                    <input type="hidden" name="id" value="<?= $row['alumni_id']; ?>">
					                    <div class="panel-body">
					                        <div class="tab-content">
					
					                            <!--First tab-->
					                           <div id="demo-bv-tab1" class="tab-pane">
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">username</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" class="form-control" name="alumni_username" placeholder="username" value="<?= $row['alumni_username']; ?>" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Password</label>
					                                    <div class="col-lg-9">
					                                        <input type="password" class="form-control" name="alumni_password" placeholder="Password">
					                                        *filled if you want to be replaced
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Email address</label>
					                                    <div class="col-lg-9">
					                                        <input type="email" class="form-control" name="alumni_email" placeholder="Email" value="<?= $row['alumni_email']; ?>"  required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Block</label>
					                                    <div class="col-lg-2">
					                                        <select class="form-control" name="alumni_block">
					                                        <?php if ($row['alumni_block']=="No") { ?>
					                                        	<option value="No">No</option>
					                                        	<option value="Yes">Yes</option>
					                                        <?php } else { ?>
					                                        	<option value="Yes">Yes</option>
					                                        	<option value="No">No</option>
					                                        <?php } ?>
					                                        </select>
					                                    </div>
					                                </div>

					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Photo</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="alumni_photo">
					                                        *filled if you want to be replaced
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Second tab-->
					                            <div id="demo-bv-tab2" class="tab-pane">
					                                

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NPM</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="NPM" name="alumni_npm" value="<?= $row['alumni_npm']; ?>" class="form-control" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="alumni_name" value="<?= $row['alumni_name']; ?>" class="form-control" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Phone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Phone number" name="alumni_phone" value="<?= $row['alumni_phone']; ?>" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Date of birth</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                                <input type="text" placeholder="Place" name="alumni_place_birth" value="<?= $row['alumni_place_birth']; ?>" class="form-control"  required>
					                                            </div>
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="alumni_date_birth" value="<?= $row['alumni_date_birth']; ?>" autocomplete="off" class="form-control" required>
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Gender</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                        	<?php if ($row['alumni_gender']=="Male") { ?>
						                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="alumni_gender" value="Male" checked="checked" required>
						                                            <label for="demo-radio-1">Male</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="alumni_gender" value="Female" required>
						                                            <label for="demo-radio-2">Female</label>
					                                            <?php } else { ?>
					                                            	<input id="demo-radio-1" class="magic-radio" type="radio" name="alumni_gender" value="Male" required>
						                                            <label for="demo-radio-1">Male</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="alumni_gender" value="Female" checked="checked"  required>
						                                            <label for="demo-radio-2">Female</label>
					                                            <?php } ?>
					
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Exit Type</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Exit Type" name="alumni_exit_type" value="<?= $row['alumni_exit_type']; ?>" class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Exit Date</label>
					                                    <div class="col-lg-9">
					                                        <div id="demo-dp-txtinput">
										                        <input type="text" placeholder="Date" name="alumni_exit_date" value="<?= $row['alumni_exit_date']; ?>" autocomplete="off" class="form-control" >
										                    </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Exit Semester</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Exit Semester" name="alumni_exit_semester" value="<?= $row['alumni_exit_semester']; ?>" class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">IPK</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="IPK" name="alumni_ipk" value="<?= $row['alumni_ipk']; ?>" class="form-control" >
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">No Ijasah</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="No Ijasah" name="alumni_no_ijasah" value="<?= $row['alumni_no_ijasah']; ?>" class="form-control" >
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">File Ijazah</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="alumni_file_ijasah">
					                                        * filled if you want to be replaced and format file .jpg, .png dan .pdf! 
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">File Transkrip Nilai</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="alumni_file_transkrip">
					                                        * filled if you want to be replaced and format file .jpg, .png dan .pdf! 
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">File SCK</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="alumni_file_sck">
					                                        * filled if you want to be replaced and format file .jpg, .png dan .pdf! 
					                                    </div>
					                                </div>

					                                
					                            </div>
					
					                            <!--Third tab-->
					                            <div id="demo-bv-tab3" class="tab-pane">
					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="alumni_address" value="<?= $row['alumni_address']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Thesis</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Thesis" name="alumni_thesis" value="<?= $row['alumni_thesis']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Thesis Type</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Thesis Type" name="alumni_thesis_type"  value="<?= $row['alumni_thesis_type']; ?>" class="form-control">
					                                    </div>
					                                </div>

													

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">SK Yudisium Date</label>
					                                    <div class="col-lg-9">
					                                    	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="alumni_sk_yudisium_date" value="<?= $row['alumni_sk_yudisium_date']; ?>" autocomplete="off" class="form-control" required>
										                            </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">SK Yudisium</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="SK Yudisium" name="alumni_sk_yudisium"  value="<?= $row['alumni_sk_yudisium']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                 <div class="form-group">
					                                    <label class="col-lg-2 control-label">Mentor I</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="Mentor I" name="alumni_mentor1" value="<?= $row['alumni_mentor1']; ?>" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Examiner I</label></div>
					                                            <div class="col-lg-5"><input type="text" placeholder="Examiner I" name="alumni_examiner1" value="<?= $row['alumni_examiner1']; ?>" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Mentor II</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="Mentor II" name="alumni_mentor2" value="<?= $row['alumni_mentor2']; ?>" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Examiner II</label></div>
					                                            <div class="col-lg-5"><input type="text" placeholder="Examiner II" name="alumni_examiner2" value="<?= $row['alumni_examiner2']; ?>" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Mentor III</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="Mentor III" name="alumni_mentor3" value="<?= $row['alumni_mentor3']; ?>" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Examiner III</label></div>
					                                            <div class="col-lg-5"><input type="text" placeholder="Examiner III" name="alumni_examiner3" value="<?= $row['alumni_examiner3']; ?>" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Location</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Location" name="alumni_location" value="<?= $row['alumni_location']; ?>" class="form-control">
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">No SK Task</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="No SK Task" name="alumni_sk_task_number" value="<?= $row['alumni_sk_task_number']; ?>" class="form-control">
					                                            </div>
					                                            <div class="col-lg-2 text-lg-right"><label class="control-label">Task Date</label></div>
					                                            <div class="col-lg-5">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="alumni_sk_task_date"  value="<?= $row['alumni_sk_task_date']; ?>"autocomplete="off" class="form-control" required>
										                            </div></div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Company</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="Company Name" name="alumni_company" value="<?= $row['alumni_company']; ?>" class="form-control">
					                                            </div>
					                                            <div class="col-lg-7"><input type="text" placeholder="Company Address" name="alumni_company_address" value="<?= $row['alumni_company_address']; ?>" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Fourth tab-->
					                            <div id="demo-bv-tab4" class="tab-pane">
					                                <h4>Thank you</h4>
					                                <p>Click the finish button to complete the registration. </p>
					                            </div>
					                        </div>
					                    </div>
					
					
					                    <!--Footer buttons-->
					                    <div class="pull-right pad-rgt mar-btm">
					                    	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                        <button type="button" class="previous btn btn-success">Previous</button>
					                        <button type="button" class="next btn btn-success">Next</button>
					                        <button type="submit" class="finish btn btn-primary" disabled>Finish</button>
					                    </div>
					
					                </form>
					            	</div>
					            </div>
					            <!--===================================================-->
					            <!-- End of Main Form Wizard -->
					
					        </div>
					    </div>
					</div>
               	</div>


                <?php	break;
                } ?>

            </div>



