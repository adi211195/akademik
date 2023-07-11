			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Range IPK</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Range IPK</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_edit="page.php?p=range_ipk&act=edit";
                $back="page.php?p=range_ipk";
                $action="pages/administrator/range_ipk/action.php";

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
					                    <h3 class="panel-title">Range IPK Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                            	<a href="<?= $page_edit; ?>">
					                                <button class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button></a> 
              
					                            </div>
					                        </div>
					                    </div>
					                    <div class="table-responsive">
					                        <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                    <th colspan="2">Score</th>
					                                    <th rowspan="2">Alphabet</th>
					                                    <th rowspan="2">IPK</th>
					                                    <th rowspan="2">Status</th>
					                                </tr>
					                                <tr>
					                                	<th>Minimum</th>
					                                	<th>Maximum</th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            <?php
					                            $data=mysqli_query($connect,"SELECT * FROM settings_range_ipk order by range_ipk_min asc");
					                            while ($row=mysqli_fetch_array($data)) {
					                            ?>
					                            	<tr>
					                            		<td><?= $row['range_ipk_min']; ?></td>
					                            		<td><?= $row['range_ipk_max']; ?></td>
					                            		<td><?= $row['range_ipk_alphabet']; ?></td>
					                            		<td><?= $row['range_ipk_numbers']; ?></td>
					                            		<td><?= $row['range_ipk_status']; ?></td>
					                            	</tr>
					                            <?php } ?>	
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
                case 'edit':
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Range IPK</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<div class="panel-body">
					                <div class="table-responsive">
					                        <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                    <th colspan="2">Score</th>
					                                    <th rowspan="2">Alphabet</th>
					                                    <th rowspan="2">IPK</th>
					                                    <th rowspan="2">Status</th>
					                                </tr>
					                                <tr>
					                                	<th>Minimum</th>
					                                	<th>Maximum</th>
					                                </tr>
					                            </thead>
					                            
					                            <tbody>
					                            	<?php
								                      $no=1;
								                      $data=mysqli_query($connect, "SELECT * FROM settings_range_ipk order by range_ipk_min asc");
								                      while ($row=mysqli_fetch_array($data)) {
								                      ?>
								                        <td><input type="text" name="range_ipk_min[]" class="form-control" required="required" value="<?= $row['range_ipk_min']; ?>"></td>
								                        <td><input type="text" name="range_ipk_max<?= $no; ?>" class="form-control" required="required" value="<?= $row['range_ipk_max']; ?>"></td>
								                        <td><input type="text" name="range_ipk_alphabet<?= $no; ?>" class="form-control" required="required" value="<?= $row['range_ipk_alphabet']; ?>"></td>
								                        <td><input type="text" name="range_ipk_numbers<?= $no; ?>" class="form-control" required="required" value="<?= $row['range_ipk_numbers']; ?>"></td>
								                        <td><input type="text" name="range_ipk_status<?= $no; ?>" class="form-control" required="required" value="<?= $row['range_ipk_status']; ?>"></td>
								                      </tr>
								                      <tr>
								                       <?php $no++; } ?>
					                            </tbody>
					                        </table>
					                    </div>
					                    <div class="panel-footer text-right">
						                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
						                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Update</button>
						                </div>
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



