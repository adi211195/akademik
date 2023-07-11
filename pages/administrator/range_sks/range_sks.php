			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Range SKS</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Range SKS</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_edit="page.php?p=range_sks&act=edit";
                $back="page.php?p=range_sks";
                $action="pages/administrator/range_sks/action.php";

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
					                    <h3 class="panel-title">Range SKS Data</h3>
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
					                                    <th colspan="2">Indeks Prestasi Semester</th>
					                                    <th rowspan="2">SKS</th>
					                                </tr>
					                                <tr>
					                                	<th>Minimum IPS</th>
					                                	<th>Maximum IPS</th>
					                                </tr>
					                            </thead>
					                            <?php
					                            $row1=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row1'"));
					                            $row2=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row2'"));
					                            $row3=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row3'"));
					                            $row4=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row4'"));
					                            $row5=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row5'"));
					                            $row6=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row6'"));
					                            ?>
					                            <tbody>
					                            	<tr>
					                            		<td><?= $row1['range_sks_min']; ?></td>
					                            		<td><?= $row1['range_sks_max']; ?></td>
					                            		<td><?= $row1['range_sks']; ?></td>
					                            	</tr>
					                            	<tr>
					                            		<td><?= $row2['range_sks_min']; ?></td>
					                            		<td><?= $row2['range_sks_max']; ?></td>
					                            		<td><?= $row2['range_sks']; ?></td>
					                            	</tr>
					                            	<tr>
					                            		<td><?= $row3['range_sks_min']; ?></td>
					                            		<td><?= $row3['range_sks_max']; ?></td>
					                            		<td><?= $row3['range_sks']; ?></td>
					                            	</tr>
					                            	<tr>
					                            		<td><?= $row4['range_sks_min']; ?></td>
					                            		<td><?= $row4['range_sks_max']; ?></td>
					                            		<td><?= $row4['range_sks']; ?></td>
					                            	</tr>
					                            	<tr>
					                            		<td><?= $row5['range_sks_min']; ?></td>
					                            		<td><?= $row5['range_sks_max']; ?></td>
					                            		<td><?= $row5['range_sks']; ?></td>
					                            	</tr>
					                            	<tr>
					                            		<th colspan="2">SKS for new students</th>
					                            		<td><?= $row6['range_sks']; ?></td>
					                            	</tr>
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
					                <h3 class="panel-title">Edit Range SKS</h3>
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
					                                    <th colspan="2">Indeks Prestasi Semester</th>
					                                    <th rowspan="2">SKS</th>
					                                </tr>
					                                <tr>
					                                	<th>Minimum IPS</th>
					                                	<th>Maximum IPS</th>
					                                </tr>
					                            </thead>
					                            <?php
					                            $row1=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row1'"));
					                            $row2=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row2'"));
					                            $row3=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row3'"));
					                            $row4=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row4'"));
					                            $row5=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row5'"));
					                            $row6=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM settings_range_sks where range_sks_id='row6'"));
					                            ?>
					                            <tbody>
					                            	<tr>
					                            		<td><input type="text" name="row1_min" class="form-control" value="<?= $row1['range_sks_min']; ?>" required></td>
					                            		<td><input type="text" name="row1_max" class="form-control" value="<?= $row1['range_sks_max']; ?>" required></td>
					                            		<td><input type="text" name="row1_sks" class="form-control" value="<?= $row1['range_sks']; ?>" required></td>
					                            	</tr>
					                            	<tr>
					                            		<td><input type="text" name="row2_min" class="form-control" value="<?= $row2['range_sks_min']; ?>" required></td>
					                            		<td><input type="text" name="row2_max" class="form-control" value="<?= $row2['range_sks_max']; ?>" required></td>
					                            		<td><input type="text" name="row2_sks" class="form-control" value="<?= $row2['range_sks']; ?>" required></td>
					                            	</tr>
					                            	<tr>
					                            		<td><input type="text" name="row3_min" class="form-control" value="<?= $row3['range_sks_min']; ?>" required></td>
					                            		<td><input type="text" name="row3_max" class="form-control" value="<?= $row3['range_sks_max']; ?>" required></td>
					                            		<td><input type="text" name="row3_sks" class="form-control" value="<?= $row3['range_sks']; ?>" required></td>
					                            	</tr>
					                            	<tr>
					                            		<td><input type="text" name="row4_min" class="form-control" value="<?= $row4['range_sks_min']; ?>" required></td>
					                            		<td><input type="text" name="row4_max" class="form-control" value="<?= $row4['range_sks_max']; ?>" required></td>
					                            		<td><input type="text" name="row4_sks" class="form-control" value="<?= $row4['range_sks']; ?>" required></td>
					                            	</tr>
					                            	<tr>
					                            		<td><input type="text" name="row5_min" class="form-control" value="<?= $row5['range_sks_min']; ?>" required></td>
					                            		<td><input type="text" name="row5_max" class="form-control" value="<?= $row5['range_sks_max']; ?>" required></td>
					                            		<td><input type="text" name="row5_sks" class="form-control" value="<?= $row5['range_sks']; ?>" required></td>
					                            	</tr>
					                            	<tr>
					                            		<th colspan="2">SKS for new students</th>
					                            		<td><input type="text" name="row6_sks" class="form-control" value="<?= $row6['range_sks']; ?>" required></td>
					                            	</tr>
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



