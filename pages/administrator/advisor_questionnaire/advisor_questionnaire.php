			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Advisor Questionnaire</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Advisor Questionnaire</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_input="page.php?p=advisor_questionnaire&act=input";
                $page_edit="page.php?p=advisor_questionnaire&act=edit";
                $back="page.php?p=advisor_questionnaire";
                $action="pages/administrator/advisor_questionnaire/action.php";

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
					                    <h3 class="panel-title">advisor Questionnaire Data</h3>
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
					                                    <th>Category</th>
					                                    <th>Description</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM questionnaire_advisor
					                            		LEFT JOIN questionnaire_category ON questionnaire_category.category_id=questionnaire_advisor.category_id");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['category']; ?></td>
					                                    <td><?= $row['q_advisor_description']; ?></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['q_advisor_id']; ?>" onclick="data_remove(this.value);" title="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['q_advisor_id']; ?>">
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
					                <h3 class="panel-title">Add Advisor Questionnaire</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal" method="POST" action="" id="action"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					                <div class="panel-body">
					                	<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Category <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="category_id"  class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM questionnaire_category");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            	?>
					                            		<option value="<?= $opt['category_id']; ?>"><?= $opt['category']; ?></option>
					                            	<?php } ?>
					                            </select>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Description <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="q_advisor_description" placeholder="Description" class="form-control" required>
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
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_advisor 
                	LEFT JOIN questionnaire_category ON questionnaire_category.category_id=questionnaire_advisor.category_id
                	where q_advisor_id='$id'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Advisor Questionnaire</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal" method="POST" action="" id="action"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<input type="hidden" name="id" value="<?= $id; ?>">
					                <div class="panel-body">
					                	<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Category <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="category_id"  class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM questionnaire_category");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($opt['category_id']==$row['category_id']) {
					                            	?>
					                            		<option value="<?= $opt['category_id']; ?>" selected><?= $opt['category']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['category_id']; ?>"><?= $opt['category']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Description <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="q_advisor_description" placeholder="Description" class="form-control" value="<?= $row['q_advisor_description']; ?>" required>
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



