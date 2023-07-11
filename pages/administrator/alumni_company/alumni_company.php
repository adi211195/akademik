			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Company</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Company</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_input="page.php?p=alumni_company&act=input";
                $page_edit="page.php?p=alumni_company&act=edit";
                $back="page.php?p=alumni_company";
                $action="pages/administrator/alumni_company/action.php";

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
					                    <h3 class="panel-title">Company Data</h3>
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
					                                    <th>Name</th>
					                                    <th>Field</th>
					                                    <th>Website</th>
					                                    <th>Location</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_alumni_company");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['alumni_company_name']; ?></td>
					                                    <td><?= $row['alumni_company_field']; ?></td>
					                                    <td><?= $row['alumni_company_website']; ?></td>
					                                    <td><?= $row['alumni_company_location']; ?></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['alumni_company_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['alumni_company_id']; ?>">
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
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Add Company</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					                <div class="panel-body">
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Name <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_company_name" placeholder="Name" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Field <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_company_field" placeholder="Field" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Website <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_company_website" placeholder="Website" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Location <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_company_location" placeholder="Location" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Address <span class="required">*</span></label>
					                        <div class="col-sm-7">
					                            <input type="text" name="alumni_company_address" placeholder="Address" class="form-control" required>
					                        </div>
					                        <div class="col-sm-2">
					                            <input type="text" name="alumni_company_poscode" placeholder="Poscode" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Phone <span class="required">*</span></label>
					                        <div class="col-sm-4">
					                            <input type="text" name="alumni_company_phone" placeholder="Phone" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Fax <span class="required">*</span></label>
					                        <div class="col-sm-4">
					                            <input type="text" name="alumni_company_fax" placeholder="Fax" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Email <span class="required">*</span></label>
					                        <div class="col-sm-4">
					                            <input type="email" name="alumni_company_email" placeholder="Email" class="form-control" required>
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
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_alumni_company where alumni_company_id='$id'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Company</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<input type="hidden" name="id" value="<?= $id; ?>">
					                <div class="panel-body">
					                    
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Name <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_company_name" placeholder="Name" value="<?= $row['alumni_company_name']; ?>" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Field <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_company_field" placeholder="Field"  value="<?= $row['alumni_company_field']; ?>"class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Website <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_company_website" value="<?= $row['alumni_company_website']; ?>" placeholder="Website" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Location <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_company_location" value="<?= $row['alumni_company_location']; ?>" placeholder="Location" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Address <span class="required">*</span></label>
					                        <div class="col-sm-7">
					                            <input type="text" name="alumni_company_address" value="<?= $row['alumni_company_address']; ?>" placeholder="Address" class="form-control" required>
					                        </div>
					                        <div class="col-sm-2">
					                            <input type="text" name="alumni_company_poscode" value="<?= $row['alumni_company_poscode']; ?>" placeholder="Poscode" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Phone <span class="required">*</span></label>
					                        <div class="col-sm-4">
					                            <input type="text" name="alumni_company_phone" value="<?= $row['alumni_company_phone']; ?>" placeholder="Phone" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Fax <span class="required">*</span></label>
					                        <div class="col-sm-4">
					                            <input type="text" name="alumni_company_fax" value="<?= $row['alumni_company_fax']; ?>" placeholder="Fax" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Email <span class="required">*</span></label>
					                        <div class="col-sm-4">
					                            <input type="email" name="alumni_company_email" value="<?= $row['alumni_company_email']; ?>" placeholder="Email" class="form-control" required>
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



