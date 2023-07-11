			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Lecturer</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Lecturer</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_input="page.php?p=lecturer&act=input";
                $page_edit="page.php?p=lecturer&act=edit";
                $back="page.php?p=lecturer";
                $action="pages/administrator/lecturer/action.php";

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
					                    <h3 class="panel-title">Lecturer Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                            	<a href="<?= $page_input; ?>">
					                                <button class="btn btn-purple"><i class="demo-pli-add icon-fw"></i>Add</button></a> 
              
					                            </div>
					                        </div>
					                    </div>
					                    <div class="table-responsive">
					                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Photo</th>
					                                    <th>username</th>
					                                    <th>Code</th>
					                                    <th>Name</th>
					                                    <th>Email</th>
					                                    <th>Block</th>
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
					                                    <td><?= $row['account_username']; ?></td>
					                                    <td><?= $row['lecturer_code']; ?></td>
					                                    <td><?= $row['lecturer_name']; ?></td>
					                                    <td><?= $row['account_email']; ?></td>
					                                    <td><?= $row['account_block']; ?></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['account_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['account_id']; ?>">
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
					                <h3 class="text-main">Add Lecturer</h3>
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
					                <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					                    <input type="hidden" name="action" value="input">
					                    <div class="panel-body">
					                        <div class="tab-content">
					
					                            <!--First tab-->
					                           <div id="demo-bv-tab1" class="tab-pane">
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">username</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" class="form-control" name="account_username" placeholder="username" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Password</label>
					                                    <div class="col-lg-9">
					                                        <input type="password" class="form-control" name="account_password" placeholder="Password" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Email address</label>
					                                    <div class="col-lg-9">
					                                        <input type="email" class="form-control" name="account_email" placeholder="Email" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Block</label>
					                                    <div class="col-lg-2">
					                                        <select class="form-control" name="account_block">
					                                        	<option value="No">No</option>
					                                        	<option value="Yes">Yes</option>
					                                        </select>
					                                    </div>
					                                </div>

					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Photo</label>
					                                    <div class="col-lg-9">
					                                        <input type="file" class="form-control" name="account_photo"  required>
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Second tab-->
					                            <div id="demo-bv-tab2" class="tab-pane">
					                                
					                            	<div class="form-group">
					                                    <label class="col-lg-2 control-label">Code</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Code" name="lecturer_code" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="lecturer_name" class="form-control" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Phone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Phone number" name="lecturer_phone" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Date of birth</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                                <input type="text" placeholder="Place" name="lecturer_place_birth" class="form-control" required>
					                                            </div>
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="lecturer_date_birth" autocomplete="off" class="form-control" required>
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Gender</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="lecturer_gender" value="Male" required>
					                                            <label for="demo-radio-1">Male</label>
					
					                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="lecturer_gender" value="Female" required>
					                                            <label for="demo-radio-2">Female</label>
					
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Status</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                        	
						                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="lecturer_status" value="Fixed" required>
						                                            <label for="demo-radio-1">Fixed</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="lecturer_status" value="Not Fixed" required>
						                                            <label for="demo-radio-2">Not Fixed</label>
					                                            
					
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Certification</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Certification" name="lecturer_certification" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Functional</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Functional" name="lecturer_functional" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NIDN</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="NIDN" name="lecturer_nidn" class="form-control" required>
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NIDK</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="NIDK" name="lecturer_nidk" class="form-control" required>
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NUP</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="NUP" name="lecturer_nup" class="form-control" required>
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Education</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Education" name="lecturer_education" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Position</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Position" name="lecturer_position" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Specialist of Teaching</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Specialist of Teaching" name="lecturer_specialist" class="form-control" required>
					                                    </div>
					                                </div>


					                            </div>
					
					                            <!--Third tab-->
					                            <div id="demo-bv-tab3" class="tab-pane">
					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="lecturer_address" class="form-control">
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">City</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="City" name="lecturer_city" class="form-control">
					                                            </div>
					                                            <div class="col-lg-3 text-lg-right"><label class="control-label">Poscode</label></div>
					                                            <div class="col-lg-4"><input type="text" placeholder="Poscode" name="lecturer_poscode" class="form-control"></div>
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
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_lecturer ON master_lecturer.account_id=account.account_id
                	where account.account_id='$id'"));
                ?><div id="page-content">
               		<div class="panel">
					    <div class="eq-height clearfix">
					        <div class="col-md-3 eq-box-md text-center box-vmiddle-wrap bord-hor">
					
					            <!-- Simple Promotion Widget -->
					            <!--===================================================-->
					            <div class="box-vmiddle pad-all">
					                <h3 class="text-main">Edit Lecturer</h3>
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
					                <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					                    <input type="hidden" name="action" value="edit">
					                    <input type="hidden" name="id" value="<?= $row['account_id']; ?>">
					                    <div class="panel-body">
					                        <div class="tab-content">
					
					                            <!--First tab-->
					                           <div id="demo-bv-tab1" class="tab-pane">
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">username</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" class="form-control" name="account_username" placeholder="username" value="<?= $row['account_username']; ?>" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Password</label>
					                                    <div class="col-lg-9">
					                                        <input type="password" class="form-control" name="account_password" placeholder="Password">
					                                        *filled if you want to be replaced
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Email address</label>
					                                    <div class="col-lg-9">
					                                        <input type="email" class="form-control" name="account_email" placeholder="Email" value="<?= $row['account_email']; ?>"  required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Block</label>
					                                    <div class="col-lg-2">
					                                        <select class="form-control" name="account_block">
					                                        <?php if ($row['account_block']=="No") { ?>
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
					                                        <input type="file" class="form-control" name="account_photo">
					                                        *filled if you want to be replaced
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Second tab-->
					                            <div id="demo-bv-tab2" class="tab-pane">
					                                
					                            	<div class="form-group">
					                                    <label class="col-lg-2 control-label">Code</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Code" name="lecturer_code" value="<?= $row['lecturer_code']; ?>" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="lecturer_name" value="<?= $row['lecturer_name']; ?>"  class="form-control" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Phone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Phone number" name="lecturer_phone" value="<?= $row['lecturer_phone']; ?>"class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Date of birth</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                                <input type="text" placeholder="Place" name="lecturer_place_birth" value="<?= $row['lecturer_place_birth']; ?>" class="form-control" required>
					                                            </div>
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="lecturer_date_birth" value="<?= $row['lecturer_date_birth']; ?>" autocomplete="off" class="form-control" required>
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Gender</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                        	<?php if ($row['lecturer_gender']=="Male") { ?>
						                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="lecturer_gender" value="Male" checked="checked" required>
						                                            <label for="demo-radio-1">Male</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="lecturer_gender" value="Female" required>
						                                            <label for="demo-radio-2">Female</label>
					                                            <?php } else { ?>
					                                            	<input id="demo-radio-1" class="magic-radio" type="radio" name="lecturer_gender" value="Male" required>
						                                            <label for="demo-radio-1">Male</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="lecturer_gender" value="Female" checked="checked"  required>
						                                            <label for="demo-radio-2">Female</label>
					                                            <?php } ?>
					
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Status</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                        	<?php if ($row['lecturer_status']=="Fixed") { ?>
						                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="lecturer_status" value="Fixed" checked="checked" required>
						                                            <label for="demo-radio-1">Fixed</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="lecturer_status" value="Not Fixed" required>
						                                            <label for="demo-radio-2">Not Fixed</label>
					                                            <?php } else { ?>
					                                            	<input id="demo-radio-1" class="magic-radio" type="radio" name="lecturer_status" value="Fixed" required>
						                                            <label for="demo-radio-1">Fixed</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="lecturer_status" value="Not Fixed" checked="checked"  required>
						                                            <label for="demo-radio-2">Not Fixed</label>
					                                            <?php } ?>
					
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Certification</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Certification" name="lecturer_certification" value="<?= $row['lecturer_certification']; ?>" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Functional</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Functional" name="lecturer_functional" value="<?= $row['lecturer_functional']; ?>" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NIDN</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="NIDN" name="lecturer_nidn" value="<?= $row['lecturer_nidn']; ?>" class="form-control" required>
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NIDK</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="NIDK" name="lecturer_nidk" value="<?= $row['lecturer_nidk']; ?>" class="form-control" required>
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">NUP</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="NUP" name="lecturer_nup" value="<?= $row['lecturer_nup']; ?>" class="form-control" required>
					                                    </div>
					                                </div>


					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Education</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Education" name="lecturer_education" value="<?= $row['lecturer_education']; ?>" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Position</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Position" name="lecturer_position" value="<?= $row['lecturer_position']; ?>" class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Specialist of Teaching</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Specialist of Teaching" name="lecturer_specialist" class="form-control" value="<?= $row['lecturer_specialist']; ?>" required>
					                                    </div>
					                                </div>


					                            </div>
					
					                            <!--Third tab-->
					                            <div id="demo-bv-tab3" class="tab-pane">
					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="lecturer_address" value="<?= $row['lecturer_address']; ?>" class="form-control">
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">City</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="City" name="lecturer_city" value="<?= $row['lecturer_city']; ?>"class="form-control">
					                                            </div>
					                                            <div class="col-lg-3 text-lg-right"><label class="control-label">Poscode</label></div>
					                                            <div class="col-lg-4"><input type="text" placeholder="Poscode" name="lecturer_poscode" value="<?= $row['lecturer_poscode']; ?>" class="form-control"></div>
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



