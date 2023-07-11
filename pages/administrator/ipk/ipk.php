			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Indeks Prestasi Komulatif</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Indeks Prestasi Komulatif</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                if (empty(@$_POST['student_name'])) {
                	$student_nim 	="";
                } else {
                	$student_name	=@$_POST['student_name'];
	                $student 		=explode("|", $student_name);
	                $student_nim 	=$student[0];
                }

                 $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM master_score
											INNER JOIN master_courses ON master_courses.courses_code=master_score.courses_code
											where master_score.student_nim='$student_nim'
											ORDER BY master_score.courses_code ASC"));

                $page_input="page.php?p=ipk&act=input";
                $page_edit="page.php?p=ipk&act=edit";
                $back="page.php?p=ipk";
                $page_print="pages/administrator/ipk/report_pdf.php";
                $action="pages/administrator/ipk/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					   <div class="panel">
					    <div class="panel-body">
					        <div class="invoice-masthead">
					        	<button class="btn btn-purple pull-left" data-toggle="modal" data-target="#page_input"><i class="fa fa-search icon-fw"></i> Search</button>

					            <div class="invoice-text">		
					                <h3 class="h1 text-uppercase text-thin mar-no text-primary">INDEKS PRESTASI KOMULATIF</h3>
					            </div>
					        </div>
					
					       <?php if (!empty($student_nim) AND $check>0) { 
								$data=mysqli_query($connect, "SELECT * FROM master_score
									LEFT JOIN master_student ON master_student.student_nim=master_score.student_nim
									LEFT JOIN master_college ON master_college.college_code=master_student.college_code
									LEFT JOIN master_majors ON master_majors.majors_code=master_student.majors_code
									where master_score.student_nim='$student_nim'");
								$student=mysqli_fetch_array($data);

								?>
					        <div class="invoice-bill row">
					            <div class="col-sm-3">
					                <address>
					                    <strong class="text-main">NIM</strong><br>
					                    <?= $student['student_nim']; ?><br>
					                    <strong class="text-main">Name</strong><br>
					                     <?= $student['student_name']; ?>
					               </address>
					            </div>
					            <div class="col-sm-3">
					                <address>
					                    <strong class="text-main">Collage</strong><br>
					                     <?= $student['college']; ?><br>
					                    <strong class="text-main">Majors</strong><br>
					                     <?= $student['majors']; ?>
					               </address>
					            </div>
					            <div class="col-sm-3">
					                <address>
					                    <strong class="text-main">Date</strong><br>
					                    <?= date('d M Y'); ?>
					               </address>
					            </div>					            
					        </div>
					
					        <div class="row">
					            <div class="col-lg-12 table-responsive">
					                <table class="table table-bordered invoice-summary">
					                    <thead>
					                        <tr class="bg-trans-dark">
					                            <th class="text-uppercase">No</th>
												<th class="text-uppercase">Courses Code</th>
												<th class="text-uppercase">Courses</th>
												<th class="text-uppercase">SMT Distribution</th>
					                            <th class="min-col text-center text-uppercase">lowest value</th>
					                            <th class="min-col text-center text-uppercase">final score</th>
					                            <th class="min-col text-center text-uppercase">letter value</th>
					                            <th class="min-col text-center text-uppercase">quality figures</th>
					                        </tr>
					                    </thead>
					                    <tbody>
					                    	<?php
					                    	$no=1;
					                    	$grand_total=0;
					                    	$sks=0;
					                    	$quality=0;
					                    	$data=mysqli_query($connect, "SELECT * FROM master_score
											INNER JOIN master_courses ON master_courses.courses_code=master_score.courses_code
											where master_score.student_nim='$student_nim'
											ORDER BY master_score.courses_code ASC");
					                    	while ($row=mysqli_fetch_array($data)) {
					                    		$sks=$sks+$row['courses_sks'];
					                    		$quality=$quality+($row['courses_sks']*$row['score_quality']);
					                    		$grand_total=$grand_total+$row['score_numbers'];
					                    	?>
					                        <tr>
					                            <td><?= $no; ?></td>
					                            <td><?= $row['courses_code']; ?></td>
					                            <td><?= $row['courses']; ?></td>
					                            <td><?= $row['courses_smt']; ?></td>
					                            <td class="text-center"><?= $row['courses_low_value']; ?></td>
					                            <td class="text-center"><?= $row['score_numbers']; ?></td>
					                            <td class="text-center"><?= $row['score_alphabet']; ?></td>
					                            <td class="text-center"><?= $row['score_quality']; ?></td>
					                        </tr>
					                    <?php $no++; } ?>

					                    </tbody>
					                </table>
					            </div>
					        </div>

					        
					
					        <div class="clearfix">
					            <table class="table invoice-total">
					                <tbody>
					                    <tr>
					                        <td><strong>Number of credits :</strong></td>
					                        <td><?= $sks; ?></td>
					                    </tr>
					                    <tr>
					                        <td><strong>Quality Value :</strong></td>
					                        <td><?= $quality; ?></td>
					                    </tr>
					                    <tr>
					                        <td><strong>IPK :</strong></td>
					                        <td class="text-bold h4"><?= round($quality/$sks,2); ?></td>
					                    </tr>
					                </tbody>
					            </table>
					        </div>
					
					        <div class="text-right no-print">
					            <a href="<?= $page_print; ?>?nim=<?= $student_nim; ?>" class="btn btn-danger" target="_blank"><i class="fa fa-print"></i> Export PDF</a>
					        </div>

					        <?php } else { ?>
					        	<div class="alert alert-warning">
					        		<b> Score empty! </b>
					        	</div>
					        <?php } ?>
					
					        
					    </div>
					</div>
					
                </div>
                <!--===================================================-->
                <!--End page content-->


                <!-- Modal -->
				<div id="page_input" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Search IPK</h4>
				      </div>
				      <form class="form-horizontal" method="POST" action=""  enctype="multipart/form-data">
				      <div class="modal-body">
				        				


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	NIM | Status | Name Student <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="student_name" id="student_name" class="form-control" placeholder="Search by nim / name" autocomplete="off" required/>  
          										<div id="student_nameList"></div>

					                        </div>
					                    </div>

					                    
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>

                <?php 
                break;
                
                } ?>

            </div>



