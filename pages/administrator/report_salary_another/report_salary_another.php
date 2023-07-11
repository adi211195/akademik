			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Another Salary Report</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Another Salary Report</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $month= array('01','02','03','04','05','06','07','08','09','10','11','12');
                if (empty(@$_GET['month'])) {
                	$month2=date('m');
                	$year=date('Y');
                	$lecturer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_lecturer order by lecturer_name asc"));
                } else {
                	$month2=$_GET['month'];
                	$year=$_GET['year'];
                	$lecturer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_lecturer where lecturer_code='$_GET[lc]'"));
                }

                $page_input="page.php?p=report_salary_another&act=input";
                $page_edit="page.php?p=report_salary_another&act=edit";
                $back="page.php?p=report_salary_another";
                $action="pages/administrator/report_salary_another/action.php";

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
					                <h3 class="h1 text-uppercase text-thin mar-no text-primary">Another Salary Report</h3>
					            </div>
					        </div>
					
						
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
					                            <th class="text-center text-uppercase">No</th>
												<th class="text-uppercase">Date</th>
												<th class="text-uppercase">Type of Payment</th>
												<th class="min-col text-center text-uppercase">amount</th>
					                            <th class="min-col text-center text-uppercase">salary</th>
					                            <th class="min-col text-center text-uppercase">Total</th>
					                            <th class="min-col text-center text-uppercase"></th>
					                        </tr>
					                    </thead>
					                    <tbody>
					                    	<?php
					                    	$no=1;
					                    	$date="";
					                    	$grand_total=0;					                    	
					                    	$data=mysqli_query($connect, "SELECT * FROM salary_another
					                    		WHERE lecturer_code='$lecturer[lecturer_code]'
					                    		AND date_format(salary_date,'%m')='$month2'
					                    		AND date_format(salary_date,'%Y')='$year'
					                    		order by salary_date asc");
					                    	while ($row=mysqli_fetch_array($data)) {
					                    		$total=$row['salary_amount']*$row['lecturer_salary'];
					                    		$grand_total=$grand_total+$total;
					                    		$date2=$row['salary_date'];


					                    	?>
					                        <tr>
					                            
					                        <?php if ($date2!=$date) { ?>
					                        	<td class="text-center"><?= $no; ?></td>
					                            <td><?= $row['salary_date']; ?></td>
					                        <?php } else { $no++; ?>
					                        	<td></td>
					                        	<td></td>
					                        <?php } ?>
					                            <td><?= $row['salary_type']; ?></td>
					                            <td class="text-center"><?= $row['salary_amount']; ?></td>
					                            <td class="text-center"><?= number_format($row['lecturer_salary']); ?></td>
					                            <td class="text-center"><?= number_format($total); ?></td>
					                            <td class="text-center">
					                            	<a href="" title="Print Kwitansi">
					                            		<button type="button" class="btn btn-dange"><i class="fa fa-print"></i></button>
					                            	</a>
					                            </td>
					                        </tr>
					                    <?php $date=$date2; } ?>

					                    </tbody>
					                </table>
					            </div>
					        </div>

					        <?php 
		                      if ($lecturer['lecturer_npwp']!=""){
		                          $tax="2,5%";
		                          $tot_tax=(($grand_total)*2.5)/100;
		                          $salary=($grand_total)-$tot_tax;
		                      } else {
		                          $tax="3%";
		                          $tot_tax=(($grand_total)*3)/100;
		                          $salary=($grand_total)-$tot_tax;
		                      } ?>
					
					        <div class="clearfix">
					            <table class="table invoice-total">
					                <tbody>
					                    <tr>
					                        <td><strong>Grand Total :</strong></td>
					                        <td class="text-bold"><?= number_format($grand_total); ?></td>
					                    </tr>
					                    <tr>
					                        <td><strong>Tax <?= $tax; ?>:</strong></td>
					                        <td  class="text-bold"><?= number_format($tot_tax); ?></td>
					                    </tr>
					                    <tr>
					                        <td><strong>Salary Earned :</strong></td>
					                        <td class="text-bold h4"><?= number_format($salary); ?></td>
					                    </tr>
					                </tbody>
					            </table>
					        </div>
					
					        <div class="text-right no-print">
					            <a href="javascript:window.print()" class="btn btn-danger"><i class="demo-pli-printer icon-lg"></i> Print</a>
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
				        <h4 class="modal-title">Another Salary Report</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action=""  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="report_salary_another">
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



