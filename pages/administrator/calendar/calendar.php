			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Calendar Academic</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Calendar Academic</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_input="page.php?p=calendar&act=input";
                $page_edit="page.php?p=calendar&act=edit";
                $back="page.php?p=calendar";
                $action="pages/administrator/calendar/action.php";

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
					                    <h3 class="panel-title">Calendar Academic Data</h3>
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
					                                    <th>Title</th>
					                                    <th>Start Date</th>
					                                    <th>End Date</th>
					                                    <th>Color</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_calendar");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['calendar_title']; ?></td>
					                                    <td><?= $row['calendar_start']; ?></td>
					                                    <td><?= $row['calendar_end']; ?></td>
					                                    <td><?= $row['calendar_color']; ?></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['calendar_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['calendar_id']; ?>">
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
					                <h3 class="panel-title">Add Calendar Academic</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					                <div class="panel-body">
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Title <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="calendar_title" placeholder="calendar Code" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Start Date <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                             <div id="demo-dp-txtinput">
					                                <input type="text" name="calendar_start" autocomplete="off" class="form-control">
					                            </div>	
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        End Date <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                             <div id="demo-dp-txtinput">
					                                <input type="text" name="calendar_end" autocomplete="off" class="form-control">
					                            </div>	
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Color <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="calendar_color"  class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM calendar_color");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            	?>
					                            		<option value="<?= $opt['calendar_color']; ?>"><?= $opt['calendar_color']; ?></option>
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
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_calendar where calendar_id='$id'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Calendar Academic</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<input type="hidden" name="id" value="<?= $id; ?>">
					                <div class="panel-body">
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Title<span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="calendar_title" placeholder="calendar Code" class="form-control" value="<?= $row['calendar_title']; ?>" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Start Date <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                             <div id="demo-dp-txtinput">
					                                <input type="text" name="calendar_start" value="<?= $row['calendar_start']; ?>" autocomplete="off" class="form-control">
					                            </div>	
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        End Date <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                             <div id="demo-dp-txtinput">
					                                <input type="text" name="calendar_end" value="<?= $row['calendar_end']; ?>" autocomplete="off" class="form-control">
					                            </div>	
					                        </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Color <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="calendar_color"  class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM calendar_color");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($opt['calendar_color']==$row['calendar_color']) {
					                            	?>
					                            		<option value="<?= $opt['calendar_color']; ?>" selected><?= $opt['calendar_color']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['calendar_color']; ?>"><?= $opt['calendar_color']; ?></option>
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



