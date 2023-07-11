			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Kartu Rencana Studi</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Kartu Rencana Studi</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
              
                $page_list="page.php?p=krs&act=list";
                $back="page.php?p=krs";
                $action="pages/dosen/krs/action.php";

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
					                    <h3 class="panel-title">Kartu Rencana Studi Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">					                   

					                    <div class="table-responsive">
					                       <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                	<th>No</th>
					                                    <th>NIM</th>
									                    <th>Name</th>
									                    <th>KRS</th>
									                    <th>Approved</th>
									                    <th>Not Approved</th>
									                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT mk.*, ms.*, count(mk.krs_id) as krs FROM master_krs as mk 
					                            		LEFT JOIN master_student as ms ON ms.student_nim=mk.student_nim
					                            		WHERE 
					                            		mk.krs_school_year='$open_sy' AND
					                            		mk.krs_semester='$open_sm' AND 
					                            		mk.krs_advisor='$lecturer_code' group by mk.student_nim");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            		$approved=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs 
					                            			WHERE 
						                            		krs_school_year='$open_sy' AND
						                            		krs_semester='$open_sm' AND 
						                            		krs_advisor='$lecturer_code' AND 
						                            		student_nim='$row[student_nim]' AND 
						                            		krs_approved='Approved'"));

					                            		$notapproved=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_krs 
					                            			WHERE 
						                            		krs_school_year='$open_sy' AND
						                            		krs_semester='$open_sm' AND 
						                            		krs_advisor='$lecturer_code' AND 
						                            		student_nim='$row[student_nim]' AND 
						                            		krs_approved='Not Approved'"));
					                            	?>

					                                <tr>
					                                	<td><?= $no; ?></td>
					                                    <td><?= $row['student_nim']; ?></td>
									                    <td><?= $row['student_name']; ?></td>
									                    <td><?= $row['krs']; ?></td>
									                    <td><?= $approved; ?></td>
									                    <td><?= $notapproved; ?></td>
									                    <td>
									                    	<a href="<?= $page_list; ?>&nim=<?= $row['student_nim']; ?>">
						                               		 <button class="btn btn-warning" title="Approved"><i class="fa fa-list"></i></button></a> 
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
                case 'list':
                $nim 		=htmlspecialchars($_GET['nim']);
                $back="page.php?p=krs&act=list&nim=".$nim;
                $back2="page.php?p=krs";

                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_student as ms
					INNER JOIN master_college as mcollege ON mcollege.college_code=ms.college_code
					INNER JOIN master_majors as mmajors ON mmajors.majors_code=ms.majors_code				
                	where student_nim='$nim'"));
                ?>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Details Kartu Rencana Studi</h3>
					            </div>
					            <div class="panel-body">
					            	<div class="row">
							            <div class="col-lg-3 table-responsive">
							                <table class="table table-bordered invoice-summary">
							                    <tbody>
							                        <tr>
							                            <td>
							                                <strong><?= $open_sy; ?> / <?= $open_sm; ?></strong>
							                                <small>School Year / Semester</small>
							                            </td>					                            
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['college']; ?></strong>
							                                <small>College</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                 <strong><?= $row['majors']; ?></strong>
							                                <small>Majors</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['student_nim']; ?></strong>
							                                <small>NIM</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $row['student_name']; ?></strong>
							                                <small>Name</small>
							                            </td>
							                        </tr>
							                       
							                    </tbody>
							                </table>
							            </div>


							            <div class="col-lg-9">
							            	<div class="table-responsive">
						                       <table class="table table-striped">
						                            <thead>
						                                <tr>
						                                	<th>No</th>
						                                    <th>Types</th>
										                    <th>Class</th>
										                    <th>Courses</th>
										                    <th>Dosen</th>
										                    <th>Schedule</th>
						                                    <th>Approved</th>
						                                </tr>
						                            </thead>
						                            <tbody>
						                            	<?php
						                            	$no=1;
						                            	$data=mysqli_query($connect, "SELECT * FROM master_krs as mk, 
						                            		master_curriculum as mc
										                    LEFT JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
										                    LEFT JOIN master_class as mclass ON mclass.class_code=mc.class_code
										                    LEFT JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
										                    LEFT JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
						                            		WHERE 
						                            		mk.curriculum_id=mc.curriculum_id AND
						                            		mk.krs_school_year='$open_sy' AND
						                            		mk.krs_semester='$open_sm' AND 
						                            		mk.student_nim='$nim' AND
						                            		mk.krs_advisor='$lecturer_code'");
						                            	while ($row=mysqli_fetch_array($data)) {
						                            		$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
															// Genrate ID
															$genid=substr(str_shuffle($genrate_id), 0, 14);
						                            	?>

						                                <tr>
						                                	<td><?= $no; ?></td>
						                                    <td><?= $row['curriculum_types']; ?></td>
										                    <td><?= $row['class_room']; ?>/<?= $row['class']; ?></td>
										                    <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?>
										                            <span class="badge badge-success"><?= $row['courses_sks']; ?> SKS</span>
										                    </td>
										                    <td><?= $row['lecturer_name']; ?></td>
										                    <td><?= $row['curriculum_day']; ?>, <?= substr($row['curriculum_start'],0,5); ?> - <?= substr($row['curriculum_end'],0,5); ?></td>
						                                    <td class="text-center">

						                                    	<?php
						                                    	if ($row['krs_approved']=="Approved") {
																	$approved="btn-danger";
																} else {
																	$approved="";
																}

																if ($row['krs_approved']=="Not Approved") {
																	$notapproved="btn-danger";
																} else {
																	$notapproved="";
																}

																?>
						                                    	
						                                    	<div id="student<?= $genid; ?>">
										                            <button type="button" class="btn<?= $genid; ?> btn <?= $approved; ?>" title="Approved" value="<?= $row['krs_id']; ?>" onclick="data_krs(this.value,'Approved',<?= $row['student_nim']; ?>);">Y</button>

										                            <button type="button" class="btn<?= $genid; ?> btn <?= $notapproved; ?>" title="Not Approved" value="<?= $row['krs_id']; ?>" onclick="data_krs(this.value,'Not Approved',<?= $row['student_nim']; ?>);">N</button>
																</div>
				<script>
				// Add active class to the current button (highlight it)
				var header<?= $genid; ?> = document.getElementById("student<?= $genid; ?>");
				var btns<?= $genid; ?> = header<?= $genid; ?>.getElementsByClassName("btn");
				for (var i = 0; i < btns<?= $genid; ?>.length; i++) {
				  btns<?= $genid; ?>[i].addEventListener("click", function() {
				  $('.btn<?= $genid; ?>').removeClass('btn-danger');
				  this.className += " btn-danger";
				  });
				}
				</script>

						                                    </td>
						                                </tr>
						                                <?php $no++; } ?>
						                            </tbody>
						                        </table>
						                    </div>

							            </div>
							        </div>

					            </div>


					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal" method="POST" action="">					            	
					                <div class="panel-footer text-right">
					                	<a href="<?= $back2; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
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







