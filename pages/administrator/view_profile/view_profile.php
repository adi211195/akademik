			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">View Profile</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">View Profile</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_input="page.php?p=view_profile&act=input";
                $page_edit="page.php?p=view_profile&act=edit";
                $back="page.php?p=view_profile";
                $action="pages/administrator/view_profile/action.php";
                $account            =mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account where account_id='$account_id'"));
                $user            =mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_user where account_id='$account_id'"));

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
               	?>

               	<div id="page-content">
               		<div class="panel">
					    <div class="eq-height clearfix">
					        <div class="col-md-3 eq-box-md text-center box-vmiddle-wrap bord-hor">
					
					            <!-- Simple Promotion Widget -->
					            <!--===================================================-->
					            <div class="box-vmiddle pad-all">
					                <h3 class="text-main">View Profile</h3>
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
					                                    <label class="col-lg-2 control-label">Username : </label>
					                                    <div class="col-lg-9">
					                                        <?= $account['account_username']; ?>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Email address : </label>
					                                    <div class="col-lg-9">
					                                        <?= $account['account_email']; ?>
					                                    </div>
					                                </div>

					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Photo :</label>
					                                    <div class="col-lg-9">
					                                    	<img src="assets/account_photo/<?= $account['account_photo']; ?>" alt="" height="100px;">
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Second tab-->
					                            <div id="demo-bv-tab2" class="tab-pane">
					                                
					                            	

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Name : </label>
					                                    <div class="col-lg-9">
					                                        <?= $user['user_name']; ?>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Phone Number : </label>
					                                    <div class="col-lg-9">
					                                        <?= $user['user_phone']; ?>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Date of birth :</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                            	<?= $user['user_place_birth']; ?>
					                                            </div>
					                                            <div class="col-lg-4">
					                                            	<?= $user['user_date_birth']; ?>
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Gender :</label>
					                                    <div class="col-lg-9">
					                                    	<?= $user['user_gender']; ?>
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Third tab-->
					                            <div id="demo-bv-tab3" class="tab-pane">
					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Address :</label>
					                                    <div class="col-lg-9">
					                                    	<?= $user['user_address']; ?>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">City :</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                            	<?= $user['user_city']; ?>
					                                            </div>
					                                            <div class="col-lg-3 text-lg-right">
					                                            	<label class="control-label">Poscode :</label></div>
					                                            <div class="col-lg-4">
																	<?= $user['user_poscode']; ?>
																		
																</div>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					
					                        </div>
					                    </div>
					
					
					                    <!--Footer buttons-->
					                    <div class="pull-right pad-rgt mar-btm">
					                    	<a href="<?= $page_edit; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-user"></i> Edit</button></a>
					                        <button type="button" class="previous btn btn-success">Previous</button>
					                        <button type="button" class="next btn btn-success">Next</button>
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
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_user ON master_user.account_id=account.account_id
                	where account.account_id='$account_id'"));
                ?><div id="page-content">
               		<div class="panel">
					    <div class="eq-height clearfix">
					        <div class="col-md-3 eq-box-md text-center box-vmiddle-wrap bord-hor">
					
					            <!-- Simple Promotion Widget -->
					            <!--===================================================-->
					            <div class="box-vmiddle pad-all">
					                <h3 class="text-main">Edit Profile</h3>
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
					                                        <?= $row['account_username']; ?>
					                                    </div>
					                                </div>
					                                

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Email address</label>
					                                    <div class="col-lg-9">
					                                        <input type="email" class="form-control" name="account_email" placeholder="Email" value="<?= $row['account_email']; ?>"  required>
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
					                                    <label class="col-lg-2 control-label">Name</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Name" name="user_name" value="<?= $row['user_name']; ?>"  class="form-control" required>
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Phone Number</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Phone number" name="user_phone" value="<?= $row['user_phone']; ?>"class="form-control" required>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Date of birth</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-4">
					                                                <input type="text" placeholder="Place" name="user_place_birth" value="<?= $row['user_place_birth']; ?>" class="form-control" required>
					                                            </div>
					                                            <div class="col-lg-4">
					                                            	<div id="demo-dp-txtinput">
										                                <input type="text" placeholder="Date" name="user_date_birth" value="<?= $row['user_date_birth']; ?>" autocomplete="off" class="form-control" required>
										                            </div>	
					                                            </div>
					                                        </div>
					                                    </div>
					                                </div>

					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Gender</label>
					                                    <div class="col-lg-9">
					                                        <div class="radio">
					                                        	<?php if ($row['user_gender']=="Male") { ?>
						                                            <input id="demo-radio-1" class="magic-radio" type="radio" name="user_gender" value="Male" checked="checked" required>
						                                            <label for="demo-radio-1">Male</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="user_gender" value="Female" required>
						                                            <label for="demo-radio-2">Female</label>
					                                            <?php } else { ?>
					                                            	<input id="demo-radio-1" class="magic-radio" type="radio" name="user_gender" value="Male" required>
						                                            <label for="demo-radio-1">Male</label>
						
						                                            <input id="demo-radio-2" class="magic-radio" type="radio" name="user_gender" value="Female" checked="checked"  required>
						                                            <label for="demo-radio-2">Female</label>
					                                            <?php } ?>
					
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Third tab-->
					                            <div id="demo-bv-tab3" class="tab-pane">
					                                
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">Address</label>
					                                    <div class="col-lg-9">
					                                        <input type="text" placeholder="Address" name="user_address" value="<?= $row['user_address']; ?>" class="form-control">
					                                    </div>
					                                </div>
					                                <div class="form-group">
					                                    <label class="col-lg-2 control-label">City</label>
					                                    <div class="col-lg-9 pad-no">
					                                        <div class="clearfix">
					                                            <div class="col-lg-5">
					                                                <input type="text" placeholder="City" name="user_city" value="<?= $row['user_city']; ?>"class="form-control">
					                                            </div>
					                                            <div class="col-lg-3 text-lg-right"><label class="control-label">Poscode</label></div>
					                                            <div class="col-lg-4"><input type="text" placeholder="Poscode" name="user_poscode" value="<?= $row['user_poscode']; ?>" class="form-control"></div>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					
					                            <!--Fourth tab-->
					                            <div id="demo-bv-tab4" class="tab-pane">
					                                <h4>Thank you</h4>
					                                <p>Click the finish button to complete the edit profile. </p>
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



