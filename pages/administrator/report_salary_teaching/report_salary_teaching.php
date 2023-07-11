			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Teaching Salary Report</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Teaching Salary Report</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                if (isset($_POST['sks_discount'])) {
			        $update=mysqli_query($connect, "UPDATE salary_teaching SET					
						sks_discount='$_POST[sks_discount]'
						where teaching_id='$_POST[id]'");
			    }

                $month= array('01','02','03','04','05','06','07','08','09','10','11','12');
                if (empty(@$_GET['month'])) {
                	$month2=date('m');
                	$year=date('Y');
                	$lecturer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_lecturer order by lecturer_name asc"));
                	$salary=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM salary_teaching 
                		where lecturer_code='$lecturer[lecturer_code]'
                		AND salary_month='$month2' AND salary_year='$year'"));
                } else {
                	$month2=$_GET['month'];
                	$year=$_GET['year'];
                	$lecturer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_lecturer where lecturer_code='$_GET[lc]'"));
                	$salary=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM salary_teaching 
                		where lecturer_code='$lecturer[lecturer_code]'
                		AND salary_month='$month2' AND salary_year='$year'"));
                }

                $page_input="page.php?p=report_salary_teaching&act=input";
                $page_edit="page.php?p=report_salary_teaching&act=edit";
                $back="page.php?p=report_salary_teaching&month2=$month2&year=$year&lc=$lecturer[lecturer_code]";
                $action="pages/administrator/report_salary_teaching/action.php";
                $page_report="pages/administrator/report_salary_teaching/";

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
					                <h3 class="h1 text-uppercase text-thin mar-no text-primary">Teaching Salary Report</h3>
					            </div>
					        </div>
					
							<div id="pdf">
					        <div class="invoice-bill row">
					            <div class="col-sm-3">
					                <address>
					                    <strong class="text-main">Code</strong><br>
					                    <?= $lecturer['lecturer_code']; ?><br>
					                    <strong class="text-main">Name</strong><br>
					                     <?= $lecturer['lecturer_name']; ?>
					               </address>
					            </div>
					            <div class="col-sm-3">
					                <address>
					                    <strong class="text-main">Month - Year</strong><br>
					                     <?= $month2; ?> -  <?= $year; ?><br>
					                    <strong class="text-main">NPWP</strong><br>
					                     <?= $lecturer['lecturer_npwp']; ?>
					               </address>
					            </div>
					            <div class="col-sm-3">
					                <address>
					                	<strong class="text-main">Status</strong><br>
					                     <?= $salary['salary_status']; ?><br>
					                    <strong class="text-main">Date</strong><br>
					                    <?= date('d M Y'); ?>
					               </address>
					            </div>					            
					        </div>
					
					        <div class="row">
					        	
					        	<div class="col-lg-12 table-responsive">
					        		<H4>List of Courses</H4>
					                <table class="table table-bordered invoice-summary">
					                    <thead>
					                        <tr class="bg-trans-dark">
					                            <th class="min-col text-center text-uppercase">No</th>
												<th class="min-col text-center text-uppercase">Schedule Id</th>
					                            <th class="text-center text-uppercase">Courses</th>
					                            <th class="min-col text-center text-uppercase">Time</th>
					                            <th class="min-col text-center text-uppercase">SKS</th>
					                        </tr>
					                    </thead>
					                    <tbody>
					                    	<?php
					                    	$no=1;				                    	
					                    	$data=mysqli_query($connect, "SELECT * FROM master_attendance as ma
					                    		LEFT JOIN master_curriculum as mc ON mc.curriculum_id=ma.curriculum_id
					                    		LEFT JOIN master_courses as mcs ON mcs.courses_code =mc.courses_code 
					                    		WHERE mc.lecturer_code='$lecturer[lecturer_code]'
					                    		AND date_format(ma.attendance_date,'%m')='$month2'
					                    		AND date_format(ma.attendance_date,'%Y')='$year'
					                    		group by mc.curriculum_id
					                    		order by ma.attendance_date asc");
					                    	while ($row=mysqli_fetch_array($data)) {
					                    	?>
					                    	<tr>
					                    		<td class="text-center"><?= $no; ?></td>
					                    		 <td><?= $row['curriculum_id']; ?></td>
					                            <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?></td>
					                            <td class="text-center"><?= substr($row['curriculum_start'],0,5); ?> - <?= substr($row['curriculum_end'],0,5); ?></td>
					                            <td class="text-center"><?= number_format($row['courses_sks']); ?></td>
					                    	</tr>
					                    	<?php $no++; } ?>
					                    </tbody>
					                </table>
					            </div>

					            
					            <div class="col-lg-12 table-responsive">
					            	<h4>List of Teaching Attendance </h4>
					                <table class="table table-bordered invoice-summary">
					                    <thead>
					                        <tr class="bg-trans-dark">
					                            <th class="text-center text-uppercase">No</th>
												<th class="text-uppercase">Date</th>
												<th class="min-col text-center text-uppercase">Schedule Id</th>
												<th class="text-uppercase">Courses</th>
												<th class="min-col text-center text-uppercase">Time</th>
					                            <th class="min-col text-center text-uppercase">SKS</th>
					                            <th class="min-col text-center text-uppercase">Salary</th>
					                            <th class="min-col text-center text-uppercase">Total</th>
					                            <th class="min-col text-center text-uppercase"></th>
					                        </tr>
					                    </thead>
					                    <tbody>
					                    	<?php
					                    	$no=1;
					                    	$grand_total=0;			                    	
					                    	$data=mysqli_query($connect, "SELECT * FROM master_attendance as ma
					                    		LEFT JOIN master_curriculum as mc ON mc.curriculum_id=ma.curriculum_id
					                    		LEFT JOIN master_courses as mcs ON mcs.courses_code =mc.courses_code 
					                    		WHERE mc.lecturer_code='$lecturer[lecturer_code]'
					                    		AND date_format(ma.attendance_date,'%m')='$month2'
					                    		AND date_format(ma.attendance_date,'%Y')='$year'
					                    		order by ma.attendance_date asc");
					                    	while ($row=mysqli_fetch_array($data)) {
					                    		


					                    		$check=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM salary_teaching_blacklist WHERE
			                		            curriculum_id='$row[curriculum_id]' AND
			                			        attendance_date='$row[attendance_date]'"));


					                    		$start=substr($row['curriculum_start'], 0,5);
				                                if ($start<="18:00"){
				                                    if (empty($check)) {
				                                        $total=$row['courses_sks']*$salary['lecturer_salary'];
				                                    } else {
				                                        $total="0";
				                                    }
				                                } else {
				                                    $total="0";
				                                }
				                                
				                                $grand_total=$grand_total+$total;
				                                
				                               
					                    	?>
					                        <tr>					                            
					                        	<td class="text-center"><?= $no; ?></td>
					                            <td><?= $row['attendance_date']; ?></td>
					                            <td><?= $row['curriculum_id']; ?></td>
					                            <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?></td>
					                            <td class="text-center"><?= substr($row['curriculum_start'],0,5); ?> - <?= substr($row['curriculum_end'],0,5); ?></td>
					                            <td class="text-center"><?= number_format($row['courses_sks']); ?></td>
					                            <td class="text-center"><?= number_format($salary['lecturer_salary']); ?></td>
					                            <td class="text-center"><?= number_format($total); ?></td>
					                            <td class="text-center">

					                            <?php if ($start<="18:00"){                 			        
                			       				if (empty($check)) { ?>

					                            		<button type="button" class="btn btn-danger" value="<?= $row['curriculum_id']; ?>" onclick="data_blacklist(this.value,'<?= $row['attendance_date']; ?>');"><i class="fa fa-remove"></i></button>

					                            <?php } else { ?>

					                            		<button type="button" class="btn btn-success" value="<?= $row['curriculum_id']; ?>" onclick="data_whitelist(this.value,'<?= $row['attendance_date']; ?>');"><i class="fa fa-undo"></i></button>
					                            	

					                            <?php }} ?>
					                            </td>
					                        </tr>
					                    <?php $no++; } ?>

					                    </tbody>
					                </table>
					            </div>
					        </div>

					        <?php 
					        $tot_sks_discount=@($salary['sks_discount']*$salary['lecturer_salary']);
		                      if ($lecturer['lecturer_npwp']!=""){
		                          $tax="2,5%";
		                          $tot_tax=(($grand_total-$tot_sks_discount)*2.5)/100;		                          
		                          $tot_salary=($grand_total-$tot_sks_discount)-$tot_tax;
		                      } else {
		                          $tax="3%";
		                          $tot_tax=(($grand_total-$tot_sks_discount)*3)/100;
		                          $tot_salary=($grand_total-$tot_sks_discount)-$tot_tax;
		                      } ?>

		                      
					
					        <div class="clearfix">
					            <table class="table invoice-total">
					                <tbody>
					                    <tr>
					                        <td colspan="3"><strong>Grand Total  : </strong></td>
					                        <td class="text-bold"><?= number_format($grand_total); ?></td>
					                    </tr>
					                    <tr>
					                        <td><strong>SKS Discont </strong></td>
					                        <td>
					                        	<form method="post" action="">
			                                    <input type="hidden" name="id" value="<?= $salary['teaching_id']; ?>">
			                                    <select name="sks_discount" onchange="submit();">
			                                        <?php 
			                                        for ($i=0; $i < 101 ; $i++) { 
			                                            if ($i==$salary['sks_discount']) {
			                                            echo "<option value='$i' selected>$i</option>";
			                                            } else {
			                                                echo "<option value='$i'>$i</option>";
			                                            }
			                                        } ?>
			                                    </select>
			                                    </form>
					                        </td>
					                        <td>x <?= number_format($salary['lecturer_salary']); ?> : </td>
					                        <td  class="text-bold"><?= number_format($tot_sks_discount); ?></td>
					                    </tr>
					                    <tr>
					                        <td  colspan="3"><strong>Tax <?= $tax; ?>:</strong></td>
					                        <td  class="text-bold"><?= number_format($tot_tax); ?></td>
					                    </tr>
					                    <tr>
					                        <td  colspan="3"><strong>Salary Earned :</strong></td>
					                        <td class="text-bold h4"><?= number_format($tot_salary); ?></td>
					                    </tr>
					                </tbody>
					            </table>
					        </div>
					        </div>
					
					        <div class="text-right no-print">
					        	<a href="<?= $page_report; ?>report_pdf.php&month2=<?= $month2; ?>&year=<?= $year; ?>&lc=<?= $lecturer['lecturer_code']; ?>" target="_blank">
					            <button class="btn btn-danger" type="button"><i class="demo-pli-printer icon-lg"></i> Print</button>
					            </a>
					        </div>
					
					        
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
				        <h4 class="modal-title">Teaching Salary Report</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action=""  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="report_salary_teaching">
				      <div class="modal-body">
				        				

										<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        Month - Year <span class="required">*</span></label>
					                        <div class="col-sm-3">
					                            <select name="month" class="form-control">
					                            	<?php
					                            	foreach ($month as $row) {
					                            	if ($row==$month2) { ?>
					                            		<option value="<?= $row; ?>" selected><?= $row; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $row; ?>"><?= $row; ?></option>
					                            	<?php }} ?>
					                            </select>	
					                        </div>
					                        <div class="col-sm-3">
					                            <select name="year" class="form-control">
					                            	<?php
					                            	$yr=date('Y');
					                            	for ($i='2010'; $i <= $yr ; $i++) { 
					                            	if ($i==$year) { ?>
					                            		<option value="<?= $i; ?>" selected><?= $i; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $i; ?>"><?= $i; ?></option>
					                            	<?php }} ?>
					                            </select>	
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Lecturer <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="lc" class="form-control" required>
					                            	<?php
					                            	$data=mysqli_query($connect,"SELECT * FROM master_lecturer order by lecturer_code asc");
					                            	while ($row2=mysqli_fetch_array($data)) {
					                            		if ($lecturer['lecturer_code']==$row2['lecturer_code']) {
					                            	?>	
					                            		<option value="<?= $row2['lecturer_code']; ?>" selected> <?= $row2['lecturer_code']; ?> | <?= $row2['lecturer_name']; ?></option>
					                            	<?php } else { ?>}
					                            		<option value="<?= $row2['lecturer_code']; ?>"> <?= $row2['lecturer_code']; ?> | <?= $row2['lecturer_name']; ?></option>
					                            	<?php }} ?>
					                            </select>
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



