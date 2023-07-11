			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page url-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Job Vacancies Web</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page url-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Job Vacancies Web</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_input="page.php?p=alumni_job_vacancies_web&act=input";
                $page_edit="page.php?p=alumni_job_vacancies_web&act=edit";
                $back="page.php?p=alumni_job_vacancies_web";
                $action="pages/administrator/alumni_job_vacancies_web/action.php";

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
					                    <h3 class="panel-title">Job Vacancies Web Data</h3>
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
					                                    <th>Logo</th>
					                                    <th>Title</th>
					                                    <th>Url</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_alumni_job_vacancies_web");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><img src="assets/alumni_job_vacancies_web_logo/<?= $row['alumni_job_vacancies_web_logo']; ?>" height="60px"></td>					                                   
					                                    <td><?= $row['alumni_job_vacancies_web_title']; ?></td>
					                                     <td><?= $row['alumni_job_vacancies_web_url']; ?></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['alumni_job_vacancies_web_id']; ?>" onclick="data_remove(this.value);" url="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['alumni_job_vacancies_web_id']; ?>">
						                               		 <button class="btn btn-primary" url="Edit"><i class="fa fa-edit"></i></button></a> 
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
					                <h3 class="panel-title">Add Job Vacancies Web</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					                <div class="panel-body">
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                       Logo <span class="required">*</span></label>
					                        <div class="col-sm-9">
						                        <input type="file" name="alumni_job_vacancies_web_logo" placeholder="Logo" class="form-control" required>
						                        * format file png or jpg
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Title <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_job_vacancies_web_title" placeholder="title" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        url <span class="required">*</span></label>
					                        <div class="col-sm-9">
						                        <input type="text" name="alumni_job_vacancies_web_url" placeholder="url" class="form-control" required>
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
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_alumni_job_vacancies_web where alumni_job_vacancies_web_id='$id'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Job Vacancies Web</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<input type="hidden" name="id" value="<?= $id; ?>">
					                <div class="panel-body">
					                    
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                       Logo <span class="required">*</span></label>
					                        <div class="col-sm-9">
						                        <input type="file" name="alumni_job_vacancies_web_logo" placeholder="Logo" class="form-control" >
						                        * filled if you want to be replaced and format file png or jpg
					                        </div>
					                    </div>

					                    
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Title <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="alumni_job_vacancies_web_title" placeholder="title"  value="<?= $row['alumni_job_vacancies_web_title']; ?>" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        url  <span class="required">*</span></label>
					                        <div class="col-sm-9">
						                        <input type="text" name="alumni_job_vacancies_web_url" value="<?= $row['alumni_job_vacancies_web_url']; ?>" placeholder="url"  class="form-control" required>						                        
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



