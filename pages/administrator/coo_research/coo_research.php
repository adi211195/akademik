			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page url-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Research Cooperation</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page url-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Research Cooperation</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_input="page.php?p=coo_research&act=input";
                $page_edit="page.php?p=coo_research&act=edit";
                $back="page.php?p=coo_research";
                $action="pages/administrator/coo_research/action.php";

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
					                    <h3 class="panel-title">Research Cooperation Data</h3>
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
					                                    <th rowspan="2">No</th>
					                                    <th rowspan="2">Partner Institutions</th>
					                                    <th colspan="3">Level</th>
					                                    <th rowspan="2">Title of Cooperation Activities</th>
					                                    <th rowspan="2">Benefits for Accredited Study Programs</th>
					                                    <th rowspan="2">Time and Duration</th>
					                                    <th rowspan="2">Proof of Cooperation</th>
					                                    <th rowspan="2"></th>
					                                </tr>
					                                <tr>
					                                	<th>Internasional</th>
					                                	<th>Nasional</th>
					                                	<th>Wilayah/Lokal</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_cooperation WHERE cooperation_status='Research'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>					                                   
					                                    <td><?= $row['cooperation_partner']; ?></td>
					                                    <td><?php if ($row['cooperation_internasional']=="1"){ ?> &#8730; <?php } ?></td>
								                        <td><?php if ($row['cooperation_nasional']=="1"){ ?> &#8730; <?php } ?></td>
								                        <td><?php if ($row['cooperation_lokal']=="1"){ ?> &#8730; <?php } ?></td>
					                                    <td><?= $row['cooperation_title']; ?></td>
					                                    <td><?= $row['cooperation_benefits']; ?></td>
					                                    <td><?= $row['cooperation_time']; ?></td>
					                                    <td><a href="assets/cooperation_proof/<?= $row['cooperation_proof']; ?>" target="_blank">
					                                    	<button type="button" class="btn btn-info"><i class="fa fa-download"></i></button></a></td>
					                                    <td>
					                                    	<button class="btn btn-danger" id="remove" value="<?= $row['cooperation_id']; ?>" onclick="data_remove(this.value);" url="Remove">
					                                    	<i class="fa fa-trash"></i>
					                                    	</button>

						                                    <a href="<?= $page_edit; ?>&id=<?= $row['cooperation_id']; ?>">
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
					                <h3 class="panel-title">Add Research Cooperation</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					            	<input type="hidden" name="cooperation_status" value="Research">
					                <div class="panel-body">
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Partner Institutions <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="cooperation_partner" placeholder="Partner Institutions" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Level </label>
					                        <div class="col-sm-9">
					                            <input type="checkbox" name="cooperation_internasional" value="1" > Internasional
                        						<input type="checkbox" name="cooperation_nasional" value="1" > Nasional
                        						<input type="checkbox" name="cooperation_lokal" value="1" > Wilayah/Lokal
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Title of Cooperation Activities <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="cooperation_title" placeholder="Title of Cooperation Activities" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Benefits for Accredited Study Programs <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="cooperation_benefits" placeholder="Benefits for Accredited Study Programs" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Time and Duration <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="cooperation_time" placeholder="Time and Duration" class="form-control" required>
					                        </div>
					                    </div>

					                    
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                       Proof of Cooperation <span class="required">*</span></label>
					                        <div class="col-sm-9">
						                        <input type="file" name="cooperation_proof" placeholder="Proof of Cooperation" class="form-control" required>
						                        * format file png, pdf or jpg
					                        </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Year is Over <span class="required">*</span></label>
					                        <div class="col-sm-2">
						                        <select name="cooperation_over" required="required" class="form-control col-md-7 col-xs-12">
						                          <?php
						                          $thn=date('Y')+5;
						                          $thn2=date('Y');
						                            for ($i=2018; $i <= $thn ; $i++) { 
						                                if ($i==$thn2){
						                                    echo "<option value='$i' selected>$i</option>";
						                                } else {
						                                    echo "<option value='$i'>$i</option>";
						                                }
						                            	
						                            }
						                          ?>
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
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_cooperation where cooperation_id='$id'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Research Cooperation</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<input type="hidden" name="id" value="<?= $id; ?>">
					                <div class="panel-body">
					                    
					                   					                    
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Partner Institutions <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="cooperation_partner" value="<?= $row['cooperation_partner']; ?>" placeholder="Partner Institutions" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Level </label>
					                        <div class="col-sm-9">
					                        	<?php if ($row['cooperation_internasional']=="1"){ ?>
						                            <input type="checkbox" name="cooperation_internasional" value="1" checked="checked"> Internasional
						                        <?php } else { ?>
						                            <input type="checkbox" name="cooperation_internasional" value="1" > Internasional
						                        <?php } ?>
						                        
						                        <?php if ($row['cooperation_nasional']=="1"){ ?>
						                            <input type="checkbox" name="cooperation_nasional" value="1" checked="checked"> Nasional
						                        <?php } else { ?>
						                            <input type="checkbox" name="cooperation_nasional" value="1" > Nasional
						                        <?php } ?>
						                        
						                        <?php if ($row['cooperation_lokal']=="1"){ ?>
						                            <input type="checkbox" name="cooperation_lokal" value="1" checked="checked"> Wilayah/Lokal
						                        <?php } else { ?>
						                            <input type="checkbox" name="cooperation_lokal" value="1" > Wilayah/Lokal
						                        <?php } ?>

					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Title of Cooperation Activities <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="cooperation_title" value="<?= $row['cooperation_title']; ?>" placeholder="Title of Cooperation Activities" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Benefits for Accredited Study Programs <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="cooperation_benefits" value="<?= $row['cooperation_benefits']; ?>" placeholder="Benefits for Accredited Study Programs" class="form-control" required>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Time and Duration <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="cooperation_time" value="<?= $row['cooperation_time']; ?>" placeholder="Time and Duration" class="form-control" required>
					                        </div>
					                    </div>

					                    
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                       Proof of Cooperation</label>
					                        <div class="col-sm-9">
						                        <input type="file" name="cooperation_proof" placeholder="Proof of Cooperation" class="form-control" >
						                        * filled if you want to be replaced and  format file png, pdf or jpg
					                        </div>
					                    </div>
					                    
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Year is Over <span class="required">*</span></label>
					                        <div class="col-sm-2">
						                        <select name="cooperation_over" required="required" class="form-control col-md-7 col-xs-12">
						                          <?php
						                           $thn=date('Y')+5;
							                            for ($i=2018; $i <= $thn ; $i++) { 
							                                if ($i==$row['cooperation_over']){
							                                    echo "<option value='$i' selected>$i</option>";
							                                } else {
							                                    echo "<option value='$i'>$i</option>";
							                                }
							                            	
							                            }
						                          ?>
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



