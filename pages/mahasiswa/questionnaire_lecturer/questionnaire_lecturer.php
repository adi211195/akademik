			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Questionnaire Lecturer</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Questionnaire Lecturer</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php

               

                $page_input="page.php?p=questionnaire_lecturer&act=input";
                $page_detail="page.php?p=questionnaire_lecturer&act=detail";
                $back="page.php?p=questionnaire_lecturer";
                $action="pages/mahasiswa/questionnaire_lecturer/action.php";

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
					                    <h3 class="panel-title">Questionnaire Lecturer Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">					                    

					                    <div class="table-responsive">
					                       <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                	<th>No</th>
					                                    <th>Curriculum Types</th>
									                    <th>Class</th>
									                    <th>Courses</th>
									                    <th>Lecturer</th>
									                    <th>Schedule</th>
					                                    <th></th>
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
					                            		mk.student_nim='$student_nim' AND
					                            		mk.krs_approved='Approved'");
					                            	while ($row=mysqli_fetch_array($data)) {
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
					                                    <td>
					                                    	<a href="<?= $page_detail; ?>&id=<?= $row['curriculum_id']; ?>">
					                                    		<button class="btn btn-warning" type="button"><i class="fa fa-list"></i></button>
					                                    	</a>
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
                case 'detail':
                $id 		=htmlspecialchars($_GET['id']);
                $details=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
                	INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code 
					INNER JOIN account ON account.account_id=mlecturer.account_id
                	where mc.curriculum_id='$id'"));
                ?>

				<!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body text-center">
					                    <div class="cls-content">
										    <h1 class="error-code text-muted"><i class="demo-psi-support icon-2x"></i></h1>
										    <p class="h4 text-uppercase text-bold">Questionnaire Lecturer</p>
										    <?php
										    $qs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questionnaire_status where questionnaire='lecturer'"));

										    $answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_report_lecturer
					                    			where school_year='$open_sy'
					                    			AND curriculum_id='$id'
													AND semester='$open_sm'
													AND student_nim='$student_nim'
													AND qr_status='finish'"));

										    if (empty($answer['q_lecturer_id'])) { 
										    if ($qs['questionnaire_status']=="open") { ?>

										    <div class="pad-btm">
										    	<p>
										    		Please fill in your questionnaire by clicking the start button below. <br>
										    		School Year : <?= $open_sy; ?> Semester : <?= $open_sm; ?>
										    	</p>
										    	<div class="alert alert-primary">
									        		<table class="table">
									        			<tr>
									        				<td>Class : <?= $details['class_room']; ?>/<?= $details['class']; ?> <br>
									                            Courses : <?= $details['courses_code']; ?> | <?= $details['courses']; ?> 
									                                    	<span class="badge badge-success"><?= $details['courses_sks']; ?> SKS</span></td>
									        				<td> Lecturer : <?= $details['lecturer_name']; ?> <br>
									                            Schedule : <?= $details['curriculum_day']; ?>, <?= $details['curriculum_start']; ?> - <?= $details['curriculum_end']; ?></td>
									        			</tr>
									        		</table>
									        	</div>
										        
										        <a href="<?= $page_input; ?>&id=<?= $id; ?>">
										        <button class="btn btn-success btn-lg">S T A R T</button>
										        </a>
										    </div>

										    <?php } elseif ($qs['questionnaire_status']=="close") { ?>

										    <div class="pad-btm">
										    	<p>
										    		The questionnaire is still not open, please contact the admin for more info. <br>
										    		School Year : <?= $open_sy; ?> Semester : <?= $open_sm; ?>
										    	</p>
										        <div class="alert alert-primary">
									        		<table class="table">
									        			<tr>
									        				<td>Class : <?= $details['class_room']; ?>/<?= $details['class']; ?> <br>
									                            Courses : <?= $details['courses_code']; ?> | <?= $details['courses']; ?> 
									                                    	<span class="badge badge-success"><?= $details['courses_sks']; ?> SKS</span></td>
									        				<td> Lecturer : <?= $details['lecturer_name']; ?> <br>
									                            Schedule : <?= $details['curriculum_day']; ?>, <?= $details['curriculum_start']; ?> - <?= $details['curriculum_end']; ?></td>
									        			</tr>
									        		</table>
									        	</div>
										    </div>

										    <?php }} else { ?>

										    <div class="pad-btm">
										    	<p>
										    		Thank you for filling out the questionnaire. <br>
										    		School Year : <?= $open_sy; ?> Semester : <?= $open_sm; ?>
										    	</p>
										    	<div class="alert alert-primary">
									        		<table class="table">
									        			<tr>
									        				<td>Class : <?= $details['class_room']; ?>/<?= $details['class']; ?> <br>
									                            Courses : <?= $details['courses_code']; ?> | <?= $details['courses']; ?> 
									                                    	<span class="badge badge-success"><?= $details['courses_sks']; ?> SKS</span></td>
									        				<td> Lecturer : <?= $details['lecturer_name']; ?> <br>
									                            Schedule : <?= $details['curriculum_day']; ?>, <?= $details['curriculum_start']; ?> - <?= $details['curriculum_end']; ?></td>
									        			</tr>
									        		</table>
									        	</div>
										        
										    </div>

										    <?php } ?>
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
				$sts=htmlspecialchars(@$_GET['sts']);
				$page = isset($_GET['page'])?(int)$_GET['page'] : 1;
				$limit=$page-1;
				$number_back=$page-1;
				$number_next=$page+1;

				$id 		=htmlspecialchars($_GET['id']);
                $details=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_curriculum as mc
                	INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code 
					INNER JOIN account ON account.account_id=mlecturer.account_id
                	where mc.curriculum_id='$id'"));

				
				
				$qs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questionnaire_status where questionnaire='lecturer'"));
				if ($qs['questionnaire_status']=="close") {
					header("location:$back");
				}


				if ($sts=="questionnaire" OR empty($sts)) {
					$question=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questionnaire_lecturer as qg
						INNER JOIN questionnaire_category as qc ON qc.category_id=qg.category_id
						limit $limit,1"));

					$answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_report_lecturer
					                    			where q_lecturer_id='$question[q_lecturer_id]'
					                    			AND curriculum_id='$id'
													AND school_year='$open_sy'
													AND semester='$open_sm'
													AND student_nim='$student_nim'"));


					if (empty($question['q_lecturer_id'])) {
						header("location:$page_input&sts=suggestions&id=$id");
					} else {
						$next="$page_input&sts=questionnaire&page=$number_next&id=$id";
					}

					$failed="$page_input&sts=questionnaire&page=$page&id=$id";

					if ($answer['q_lecturer_answer']=="1") {
						$satu="btn-danger";
					} elseif ($answer['q_lecturer_answer']=="2") {
						$dua="btn-danger";
					} elseif ($answer['q_lecturer_answer']=="3") {
						$tiga="btn-danger";
					} elseif ($answer['q_lecturer_answer']=="4") {
						$empat="btn-danger";
					} elseif ($answer['q_lecturer_answer']=="5") {
						$lima="btn-danger";
					} else {
						$satu="";
						$dua="";
						$tiga="";
						$empat="";
						$lima="";
					}

				} elseif ($sts=="suggestions") {
					$question=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questionnaire_suggestions where qs_status='lecturer' limit $limit,1"));

					$answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_report_suggestions
					                    			where suggestions_id='$question[suggestions_id]'
					                    			AND curriculum_id='$id'
													AND school_year='$open_sy'
													AND semester='$open_sm'
													AND student_nim='$student_nim'
													AND qr_status='lecturer'"));

					if (empty($question['suggestions_id'])) {
						header("location:$page_input&sts=complete&id=$id");
						$back="page.php?p=questionnaire_lecturer";
					} else {
						$back="$page_input&sts=suggestions&page=$number_next&id=$id";
					}
				}

				?>

                
                <div id="page-content">
                        <div class="panel">
					        <div class="panel-body">
					            <div class="fixed-fluid">
					                <div class="fixed-md-200 pull-sm-left fixed-right-border">
					
					                    <div class="text-center">
					                        <button class="btn btn-block btn-warning btn-lg" data-toggle="modal" data-target="#information">Information</button>
					                    </div>
					                    <div class="table-responsive">
							                <table class="table table-bordered invoice-summary">
							                    <tbody>
							                        <tr>
							                            <td>
							                                <strong><?= $details['class_room']; ?>/<?= $details['class']; ?></strong>
							                                <small>Class</small>
							                            </td>					                            
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $details['courses_code']; ?> | <?= $details['courses']; ?> 
									                                    	<span class="badge badge-success"><?= $details['courses_sks']; ?> SKS</span></strong>
							                                <small>Courses</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                 <strong><?= $details['lecturer_name']; ?></strong>
							                                <small>Lecturer</small>
							                            </td>
							                        </tr>
							                        <tr>
							                            <td>
							                                <strong><?= $details['curriculum_day']; ?>, <?= $details['curriculum_start']; ?> - <?= $details['curriculum_end']; ?></strong>
							                                <small>Schedule</small>
							                            </td>
							                        </tr>
							                       
							                    </tbody>
							                </table>
							            </div>
					
					                    <p class="pad-ver text-main text-sm text-uppercase text-bold">Questionnaire</p>
					                    <ul class="list-inline">
					                    	<?php
					                    	$no=1;
					                    	$data=mysqli_query($connect , "SELECT * FROM questionnaire_lecturer order by category_id asc");
					                    	while ($row=mysqli_fetch_array($data)) {
					                    		$answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_report_lecturer
					                    			where q_lecturer_id='$row[q_lecturer_id]'
					                    			AND curriculum_id='$id'
													AND school_year='$open_sy'
													AND semester='$open_sm'
													AND student_nim='$student_nim'"));

					                    		$pages=$page_input."&sts=questionnaire&page=$no&id=$id";
					                    	?>
					                        <li class="tag tag-sm"><a href="<?= $pages; ?>"><?= $no; ?>. <span class="badge badge-danger"><?= $answer['q_lecturer_answer']; ?></span></a></li>
					                        <?php $no++; } ?>
					                    </ul>

					                    <hr>
					                    <p class="pad-ver text-main text-sm text-uppercase text-bold">Suggestions & Feedback</p>
					                    <ul class="list-inline">
					                        <?php
					                    	$no=1;
					                    	$data=mysqli_query($connect , "SELECT * FROM questionnaire_suggestions where qs_status='lecturer'");
					                    	while ($row=mysqli_fetch_array($data)) {
					                    		$answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_report_suggestions
					                    			where suggestions_id='$row[suggestions_id]'
					                    			AND curriculum_id='$id'
													AND school_year='$open_sy'
													AND semester='$open_sm'
													AND student_nim='$student_nim'
													AND qr_status='lecturer'"));

					                    		$pages=$page_input."&sts=suggestions&page=$no&id=$id";
					                    	?>
					                        <li class="tag tag-sm"><a href="<?= $pages; ?>"><?= $no; ?>. <span class="badge badge-danger"><?= substr($answer['qs_answer'],0,25); ?>...</span></a></li>
					                        <?php $no++; } ?>
					                    </ul>

					                    <hr>

					                    <div class="text-center">

					                    <?php 
					                    $jml_answer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_lecturer"));
										$tot_answer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_lecturer	
													where school_year='$open_sy'
													AND curriculum_id='$id'
													AND semester='$open_sm'
													AND student_nim='$student_nim'"));
										if ($jml_answer=$tot_answer) { 
											$back="page.php?p=questionnaire_lecturer"; ?>
						                    <form method="post" class="action">
						                    <input type="hidden" name="action" value="finish">
						                    <input type="hidden" name="curriculum_id" value="<?= $id; ?>">
						                        <button class="btn btn-block btn-success btn-lg" type="submit" onclick="return confirm('Are you sure?');">Finish</button>
						                    </form>
						                <?php } ?>
					                    </div>
					                    
					
					                </div>



					                <div class="fluid">
					                    <?php if ($sts=="questionnaire" OR empty($sts)) { ?>

					                    <div style="overflow: auto; height: 200px;">
						                    <p class="text-center">
						                    	<span class="badge badge-primary">Questionnaire Number  : <?= $page; ?></span> <br>
						                    	<span class="badge badge-danger">
						                    	<?= $question['category']; ?>
						                    	</span></p>
						                    <p><h2 class="text-center">
						                    	<?= $question['q_lecturer_description']; ?>
						                    </h2>					                    	
						                    </p>
						                </div>
						                <hr>
					                    
					                    <div class="text-center pad-to">
					                        <div class="btn-group" id="question">
					                            <button class="btn btn-lg <?= $satu; ?>" value="<?= $question['q_lecturer_id']; ?>" onclick="data_question_lecturer(this.value,'1',<?= $student_nim; ?>,'<?= $id; ?>');">
					                            	<i class="demo-pli-consulting icon-lg icon-fw"></i> 1</button>

					                            <button class="btn btn-lg <?= $dua; ?>" value="<?= $question['q_lecturer_id']; ?>" onclick="data_question_lecturer(this.value,'2',<?= $student_nim; ?>,'<?= $id; ?>');">
					                            	<i class="demo-pli-consulting icon-lg icon-fw"></i> 2</button>

					                            <button class="btn btn-lg <?= $tiga; ?>" value="<?= $question['q_lecturer_id']; ?>" onclick="data_question_lecturer(this.value,'3',<?= $student_nim; ?>,'<?= $id; ?>'');">
					                            	<i class="demo-pli-consulting icon-lg icon-fw"></i> 3</button>

					                            <button class="btn btn-lg <?= $empat; ?>" value="<?= $question['q_lecturer_id']; ?>" onclick="data_question_lecturer(this.value,'4',<?= $student_nim; ?>,'<?= $id; ?>');">
					                            	<i class="demo-pli-consulting icon-lg icon-fw"></i> 4</button>

					                            <button class="btn btn-lg <?= $lima; ?>" value="<?= $question['q_lecturer_id']; ?>" onclick="data_question_lecturer(this.value,'5',<?= $student_nim; ?>,'<?= $id; ?>');">
					                            	<i class="demo-pli-consulting icon-lg icon-fw"></i> 5</button>

					                        </div>
					                    </div>

					                <?php } elseif ($sts=="suggestions") { ?>

					                	<div style="overflow: auto; height: 200px;">
						                    <p class="text-center">
						                    	<span class="badge badge-primary">Suggestion & Feedback Number  : <?= $page; ?></span> <br>
						                    </p>
						                    <p><h2 class="text-center">
						                    	<?= $question['qs_description']; ?>
						                    </h2>					                    	
						                    </p>
						                </div>
						                <hr>
					                	<div class="pad-btm">
					                		<form method="post" class="action">
					                		<input type="hidden" name="action" value="suggestions">
					                		<input type="hidden" name="suggestions_id" value="<?= $question['suggestions_id']; ?>">
					                		<input type="hidden" name="curriculum_id" value="<?= $id; ?>">
					                        <textarea class="form-control" name="qs_answer" rows="4" placeholder="Answer..." required><?= $answer['qs_answer']; ?></textarea>
					                        <div class="mar-top clearfix">
					                            <button class="btn btn-sm btn-primary pull-right" type="submit"><i class="demo-psi-right-4 icon-fw"></i> Submit</button>
					                        </div>
					                        </form>
					                    </div>

					                <?php } elseif ($sts=="complete") { ?>

					                	<div class="cls-content text-center">
										    <h1 class="error-code text-muted"><i class="demo-psi-support icon-2x"></i></h1>
										    <p class="h4 text-uppercase text-bold">Questionnaire lecturer</p>
										    <div class="pad-btm">
										    	<p>
										    		please click the finish button to complete the questionnaire.
										    	</p>										        
										    </div>
										</div>

					                <?php } ?>

					                </div>
					            </div>
					        </div>
					    </div>
					    
                </div>


                <script>
				// Add active class to the current button (highlight it)
				var header = document.getElementById("question");
				var btns = header.getElementsByClassName("btn");
				for (var i = 0; i < btns.length; i++) {
				  btns[i].addEventListener("click", function() {
				  $('.btn').removeClass('btn-danger');
				  this.className += " btn-danger";
				  });
				}
				</script>



                <!-- Modal -->
				<div id="information" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Information</h4>
				      </div>
				      <div class="modal-body">
				      	<b>Selection</b>
				        	<ol>
				        		<li>Sangat Tidak Baik/Sangat Rendah/Tidak Pernah/Tidak Lengkap</li>
				        		<li>Tidak Baik//Jarang/Kurang Lengkap</li>
				        		<li>Biasa/Cukup/Kadang-Kadang/Cukup Lengkap</li>
				        		<li>Baik/Tinggi/Sering/Lengkap</li>
				        		<li>Sangat Baik/Sangat Tinggi/Selalu/Sangat Lengkap</li>
				        	</ol>			

					                    					                    
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

				  </div>
				</div>


                <?php 
                break;
                
                } ?>

            </div>



