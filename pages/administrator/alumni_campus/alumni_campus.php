			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Campus Info</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Campus Info</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_edit="page.php?p=alumni_campus&act=edit";
                $back="page.php?p=alumni_campus";
                $action="pages/administrator/alumni_campus/action.php";

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
					                    <h3 class="panel-title">Campus Info Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                            	<button class="btn btn-primary" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</button>
              
					                            </div>
					                        </div>
					                    </div>
					                    <?php
					                         $alumni_campus=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_alumni_home"));
					                    ?>

					                    <div class="panel panel-default">
				                            <div class="panel-body">				                                    
				                                    <div class="col-md-3 col-xs-12">
				                                        <img src="assets/alumni_home_logo/<?= $alumni_campus['alumni_home_logo']; ?>" style="width: 150px;">
				                                    </div>
				                                    <div class="col-md-9 col-xs-12">
				                                        <span>Details</span><br>
				                                        <span>Campus : </span><b><?= $alumni_campus['alumni_home_campus']; ?></b><br>
				                                        <span>Address : </span><b><?= $alumni_campus['alumni_home_address']; ?></b><br>
				                                        <span>Phone : </span><b><?= $alumni_campus['alumni_home_phone']; ?></b><br>
				                                        <span>Handphone : </span><b><?= $alumni_campus['alumni_home_handphone']; ?></b><br>
				                                        <span>Email : </span><b><?= $alumni_campus['alumni_home_email']; ?></b><br>
				                                    </div>
				                                    
				                                </div>
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
				<div id="edit" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Edit Campus Info</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="edit">
					  <input type="hidden" name="id" value="<?= $alumni_campus['alumni_home_id']; ?>">
				      <div class="modal-body">

				      					<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Logo <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="file" name="alumni_home_logo" class="form-control">
					                            *filled if you want to be replaced and format file png or jpg
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Campus <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_home_campus" value="<?= $alumni_campus['alumni_home_campus']; ?>" class="form-control">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Address <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_home_address" value="<?= $alumni_campus['alumni_home_address']; ?>" class="form-control">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Phone <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_home_phone" value="<?= $alumni_campus['alumni_home_phone']; ?>" class="form-control">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Handphone <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_home_handphone" value="<?= $alumni_campus['alumni_home_handphone']; ?>" class="form-control">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Email <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="email" name="alumni_home_email" value="<?= $alumni_campus['alumni_home_email']; ?>" class="form-control">
					                        </div>
					                    </div>
					                   

				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>

                <?php 
                break;
                
                } ?>

            </div>



