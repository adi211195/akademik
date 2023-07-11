			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Questionnaire Academic</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Questionnaire Academic</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php

               

                $page_input="page.php?p=questionnaire_academic&act=input";
                $page_detail="page.php?p=questionnaire_academic&act=detail";
                $back="page.php?p=questionnaire_academic";
                $action="pages/mahasiswa/questionnaire_academic/action.php";

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
					                
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body text-center">
					                    <div class="cls-content">
										    <h1 class="error-code text-muted"><i class="demo-psi-support icon-2x"></i></h1>
										    <p class="h4 text-uppercase text-bold">Questionnaire academic</p>
										    <?php
										    $qs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questionnaire_status where questionnaire='academic'"));

										    $answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_report_academic
					                    			where school_year='$open_sy'
													AND semester='$open_sm'
													AND student_nim='$student_nim'
													AND qr_status='finish'"));

										    if (empty($answer['q_academic_id'])) { 
										    if ($qs['questionnaire_status']=="open") { ?>

										    <div class="pad-btm">
										    	<p>
										    		Please fill in your questionnaire by clicking the start button below. <br>
										    		School Year : <?= $open_sy; ?> Semester : <?= $open_sm; ?>
										    	</p>
										        
										        <a href="<?= $page_input; ?>">
										        <button class="btn btn-success btn-lg">S T A R T</button>
										        </a>
										    </div>

										    <?php } elseif ($qs['questionnaire_status']=="close") { ?>

										    <div class="pad-btm">
										    	<p>
										    		The questionnaire is still not open, please contact the admin for more info. <br>
										    		School Year : <?= $open_sy; ?> Semester : <?= $open_sm; ?>
										    	</p>
										        
										    </div>

										    <?php }} else { ?>

										    <div class="pad-btm">
										    	<p>
										    		Thank you for filling out the questionnaire. <br>
										    		School Year : <?= $open_sy; ?> Semester : <?= $open_sm; ?>
										    	</p>
										        
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

				$jml_answer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_academic"));
				$tot_answer=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM questionnaire_report_academic	
													where school_year='$open_sy'
													AND semester='$open_sm'
													AND student_nim='$student_nim'"));
				
				$qs=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questionnaire_status where questionnaire='academic'"));
				if ($qs['questionnaire_status']=="close") {
					header("location:$back");
				}


				if ($sts=="questionnaire" OR empty($sts)) {
					$question=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questionnaire_academic as qg
						INNER JOIN questionnaire_category as qc ON qc.category_id=qg.category_id
						limit $limit,1"));

					$answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_report_academic
					                    			where q_academic_id='$question[q_academic_id]'
													AND school_year='$open_sy'
													AND semester='$open_sm'
													AND student_nim='$student_nim'"));


					if (empty($question['q_academic_id'])) {
						header("location:$page_input&sts=suggestions");
					} else {
						$next="$page_input&sts=questionnaire&page=$number_next";
					}

					$failed="$page_input&sts=questionnaire&page=$page";

					if ($answer['q_academic_answer']=="1") {
						$satu="btn-danger";
					} elseif ($answer['q_academic_answer']=="2") {
						$dua="btn-danger";
					} elseif ($answer['q_academic_answer']=="3") {
						$tiga="btn-danger";
					} elseif ($answer['q_academic_answer']=="4") {
						$empat="btn-danger";
					} elseif ($answer['q_academic_answer']=="5") {
						$lima="btn-danger";
					} else {
						$satu="";
						$dua="";
						$tiga="";
						$empat="";
						$lima="";
					}

				} elseif ($sts=="suggestions") {
					$question=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM questionnaire_suggestions where qs_status='academic' limit $limit,1"));

					$answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_report_suggestions
					                    			where suggestions_id='$question[suggestions_id]'
													AND school_year='$open_sy'
													AND semester='$open_sm'
													AND student_nim='$student_nim'
													AND qr_status='academic'"));

					if (empty($question['suggestions_id'])) {
						header("location:$page_input&sts=complete");
						$back="page.php?p=questionnaire_academic";
					} else {
						$back="$page_input&sts=suggestions&page=$number_next";
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
					                    <hr>
					
					                    <p class="pad-ver text-main text-sm text-uppercase text-bold">Questionnaire</p>
					                    <ul class="list-inline">
					                    	<?php
					                    	$no=1;
					                    	$data=mysqli_query($connect , "SELECT * FROM questionnaire_academic order by category_id asc");
					                    	while ($row=mysqli_fetch_array($data)) {
					                    		$answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_report_academic
					                    			where q_academic_id='$row[q_academic_id]'
													AND school_year='$open_sy'
													AND semester='$open_sm'
													AND student_nim='$student_nim'"));

					                    		$pages=$page_input."&sts=questionnaire&page=$no";
					                    	?>
					                        <li class="tag tag-sm"><a href="<?= $pages; ?>"><?= $no; ?>. <span class="badge badge-danger"><?= $answer['q_academic_answer']; ?></span></a></li>
					                        <?php $no++; } ?>
					                    </ul>

					                    <hr>
					                    <p class="pad-ver text-main text-sm text-uppercase text-bold">Suggestions & Feedback</p>
					                    <ul class="list-inline">
					                        <?php
					                    	$no=1;
					                    	$data=mysqli_query($connect , "SELECT * FROM questionnaire_suggestions where qs_status='academic'");
					                    	while ($row=mysqli_fetch_array($data)) {
					                    		$answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM questionnaire_report_suggestions
					                    			where suggestions_id='$row[suggestions_id]'
													AND school_year='$open_sy'
													AND semester='$open_sm'
													AND student_nim='$student_nim'
													AND qr_status='academic'"));

					                    		$pages=$page_input."&sts=suggestions&page=$no";
					                    	?>
					                        <li class="tag tag-sm"><a href="<?= $pages; ?>"><?= $no; ?>. <span class="badge badge-danger"><?= substr($answer['qs_answer'],0,25); ?>...</span></a></li>
					                        <?php $no++; } ?>
					                    </ul>

					                    <hr>

					                    <div class="text-center">
					                    <?php if ($jml_answer=$tot_answer) { ?>
						                    <form method="post" class="action">
						                    <input type="hidden" name="action" value="finish">
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
						                    	<?= $question['q_academic_description']; ?>
						                    </h2>					                    	
						                    </p>
						                </div>
						                <hr>
					                    
					                    <div class="text-center pad-to">
					                        <div class="btn-group" id="question">
					                            <button class="btn btn-lg <?= $satu; ?>" value="<?= $question['q_academic_id']; ?>" onclick="data_question(this.value,'1',<?= $student_nim; ?>);">
					                            	<i class="demo-pli-consulting icon-lg icon-fw"></i> 1</button>

					                            <button class="btn btn-lg <?= $dua; ?>" value="<?= $question['q_academic_id']; ?>" onclick="data_question(this.value,'2',<?= $student_nim; ?>);">
					                            	<i class="demo-pli-consulting icon-lg icon-fw"></i> 2</button>

					                            <button class="btn btn-lg <?= $tiga; ?>" value="<?= $question['q_academic_id']; ?>" onclick="data_question(this.value,'3',<?= $student_nim; ?>);">
					                            	<i class="demo-pli-consulting icon-lg icon-fw"></i> 3</button>

					                            <button class="btn btn-lg <?= $empat; ?>" value="<?= $question['q_academic_id']; ?>" onclick="data_question(this.value,'4',<?= $student_nim; ?>);">
					                            	<i class="demo-pli-consulting icon-lg icon-fw"></i> 4</button>

					                            <button class="btn btn-lg <?= $lima; ?>" value="<?= $question['q_academic_id']; ?>" onclick="data_question(this.value,'5',<?= $student_nim; ?>);">
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
					                        <textarea class="form-control" name="qs_answer" rows="4" placeholder="Answer..." required><?= $answer['qs_answer']; ?></textarea>
					                        <div class="mar-top clearfix">
					                            <button class="btn btn-sm btn-primary pull-right" type="submit"><i class="demo-psi-right-4 icon-fw"></i> Submit</button>
					                        </div>
					                        </form>
					                    </div>

					                <?php } elseif ($sts=="complete") { ?>

					                	<div class="cls-content text-center">
										    <h1 class="error-code text-muted"><i class="demo-psi-support icon-2x"></i></h1>
										    <p class="h4 text-uppercase text-bold">Questionnaire academic</p>
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



