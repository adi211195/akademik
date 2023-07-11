			


                <?php
                if (empty(@$_GET['code'])) {
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code"));        

                	$majors_code=$code['majors_code'];
                } else {
                	$majors_code	=htmlspecialchars(@$_GET['code']);
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
					                            		WHERE majors_code='$majors_code'"));
                }

                $action="pages/administrator/skripsi/action.php";
                $page_detail="page.php?p=skripsi&act=detail&code=".$code['majors_code'];
                $page_list="page.php?p=skripsi&act=list&code=".$code['majors_code'];                
                $back="page.php?p=skripsi&code=".$code['majors_code'];

               	?>

               	<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Skripsi</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li><a href="">Skripsi</a></li>
					<li class="active"><?= $code['majors']; ?></li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                    <hr class="bord-no">
				    

                </div>

               	<?php

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				?>

				
                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">
					        <div class="panel-body">

					        	<div class="row pad-ver">
							        <form action="" method="GET" class="col-xs-12 col-sm-10 col-sm-offset-1 pad-hor">
							        	<input type="hidden" name="p" value="skripsi">
							        	<input type="hidden" name="code" value="<?= $code['majors_code']; ?>">
							            <div class="input-group mar-btm">
							            	<span class="input-group-btn">
							                     <button class="btn btn-default btn-lg" data-toggle="modal" data-target="#filter" type="button"><i class="fa fa-filter"></i></button>
							                 </span>
							                 <input type="text" name="search" placeholder="search" class="form-control input-lg">
							                 <span class="input-group-btn">
							                     <button class="btn btn-warning btn-lg" type="submit"><i class="fa fa-search"></i></button>
							                 </span>
							            </div>
							        </form>
							    </div>

					        	<?php
					        	//PAGGING
								                  
								$batas = 10;
								$page = isset($_GET['page'])?(int)$_GET['page'] : 1;
								$page_awal = ($page>1) ? ($page * $batas) - $batas : 0;	
								         
								$previous = $page - 1;
								$next = $page + 1;								  
																			
												      
								//PAGGING 



					        	if (!empty($_GET['search'])) {
					        	$search=htmlspecialchars($_GET['search']);
					        	$filter="&search=$search";
					        	$where="WHERE skripsi_title like '%$search%' AND majors_code='$code[majors_code]'";

					        	$data=mysqli_query($connect, "SELECT * FROM master_skripsi 
					        		LEFT JOIN master_student ON master_student.student_nim=master_skripsi.student_nim
					        		$where
					            	order by master_skripsi.create_date desc");
								                      
								$jumlah_data = mysqli_num_rows($data);
								$total_page = ceil($jumlah_data / $batas);

					        	?>
					            <div class="pad-hor mar-top">
					                <h2 class="text-thin mar-no"><?= $jumlah_data; ?> results found for: <i class="text-info text-normal">"<?= $search; ?>"</i></h2>
					            </div>
					
					            <hr>

					        	<?php } else {
					        		$filter="";
					        		$where="";
					        		$data=mysqli_query($connect, "SELECT * FROM master_skripsi
					        			LEFT JOIN master_student ON master_student.student_nim=master_skripsi.student_nim
					        			$where
					            	order by master_skripsi.create_date desc");
								                      
									$jumlah_data = mysqli_num_rows($data);
									$total_page = ceil($jumlah_data / $batas);

					        	} ?>
					
					            <ul class="list-group bord-no">
					            <?php
					            
					            
					            $nomor = $page_awal+1;

					            $data=mysqli_query($connect, "SELECT master_skripsi.*, master_student.*, date_format(master_skripsi.create_date, '%d %b %Y %H:%i %p') as jam FROM master_skripsi 
					            	LEFT JOIN master_student ON master_student.student_nim=master_skripsi.student_nim
					            	 $where
					            	order by master_skripsi.create_date desc limit $page_awal, $batas");
					            while ($row=mysqli_fetch_array($data)) {

					            ?>  

					                <li class="list-group-item list-item-lg">
					                    <div class="media-heading">
					                        <a class="btn-link text-lg text-semibold" href="<?= $page_detail; ?>&id=<?= $row['skripsi_id']; ?>"><?= $row['skripsi_title']; ?></a>
					                    </div>
					                    <p><a class="btn-link text-success" href="<?= $page_detail; ?>&id=<?= $row['skripsi_id']; ?>"><?= $page_detail; ?>&id=<?= $row['skripsi_id']; ?></a></p>

					                    <p class="text-sm"><?= substr($row['skripsi_abstract'],0,500); ?>...</p>
					
					                    <div class="pad-btm">
					                        <small><?= $row['jam']; ?>, Author :</small> 
					                        <a class="label label-mint" href="#"><?= $row['student_nim']; ?> - <?= $row['student_name']; ?></a>
					                    </div>
					                </li>
					            <?php } ?>
					                

					            </ul>
					            <hr class="hr-wide">
								
								Showing <?= $page; ?> to <?= $page*10; ?> of <?= $jumlah_data; ?> entries

					            <!--Pagination-->
					            <div class="text-center">
					                <ul class="pagination mar-no">
					                	<li class="page-item">
					            			<a class="page-link" href="<?php if($page > 1){ echo '$back'.''.$filter.'&page'.$previous.''; } ?>">Previous</a>
					            		</li>
					            		<?php for($x=1;$x<=$total_page; $x++){ 
					            		$bawah=$page-5;
					            		$atas=$page+5;
					            				
					            		if ($x>$bawah AND $x<$atas) {
					            		?> 
					            		<li class="page-item  <?php if ($x==$page) { echo 'active'; } ?>"><a class="page-link" href="<?= $back; ?><?= $filter; ?>&page=<?php echo $x ?>"><?php echo $x; ?></a></li>
					            		<?php }} ?>				
					            		<li class="page-item">
					            			<a  class="page-link" href="<?php if($page < $total_page) { echo '$back'.''.$filter.'&page'.$next.''; } ?>">Next</a>
					            		</li>
					                </ul>
					            </div>
					        </div>
					    </div>
					
					
					    
                </div>
                <!--===================================================-->
                <!--End page content-->
             



                <!-- Modal -->
				<div id="filter" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Filter Skripsi</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="skripsi">
				      <div class="modal-body">

				        				<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	College <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select id="college_code" onchange="select_majors(this.value);" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_college");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($code['college_code']==$opt['college_code']) {
					                            	?>
					                            		<option value="<?= $opt['college_code']; ?>" selected><?= $opt['college']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['college_code']; ?>"><?= $opt['college']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Majors <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="code" id="majors_code" class="form-control" required>
					                            	<?php
					                            	$data = mysqli_query($connect,"SELECT * FROM master_majors");
					                            	while ($opt=mysqli_fetch_array($data)) {
					                            		if ($code['majors_code']==$opt['majors_code']) {
					                            	?>
					                            		<option value="<?= $opt['majors_code']; ?>" selected><?= $opt['majors']; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $opt['majors_code']; ?>"><?= $opt['majors']; ?></option>
					                            	<?php }} ?>
					                            </select>
					                        </div>
					                    </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>
				<?php break;                
                case 'detail':
                
                $id=htmlspecialchars(@$_GET['id']);
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT master_skripsi.*, account.account_photo, 
                	master_student.student_name, account.account_status, account.account_id FROM master_skripsi 
					            	LEFT JOIN master_student ON master_student.student_nim=master_skripsi.student_nim
					            	LEFT JOIN account ON account.account_id=master_student.account_id
					            	WHERE skripsi_id='$id' AND majors_code='$code[majors_code]'"));
				if (empty($row['skripsi_id'])){
					header("location:$back");
				}

				$back2=$back;
                $back=$page_detail."&id=".$id;
				
				?>
				
                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">
					        <div class="panel-body">
					        	
					        	<!-- VIEW MESSAGE -->
					                    <!--===================================================-->
						
					                    <div class="mar-btm pad-btm bord-btm">
					                        <h1 class="page-header text-overflow">
					                            <?= $row['skripsi_title']; ?>
					                        </h1>
					                    </div>

					                    <a href="<?= $back2; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                    <br><br>
					
					                    <div class="row">
					                        <div class="col-sm-7 toolbar-left">
					
					                            <!--Sender Information-->
					                            <div class="media">
					                                <span class="media-left">
					                                <img src="assets/account_photo/<?= $row['account_photo']; ?>" class="img-circle img-sm" alt="Profile Picture">
					                            </span>
					                                <div class="media-body text-left">
					                                    <div class="text-bold">
					                                    	<?= $row['student_nim']; ?> | <?= $row['student_name']; ?>
					                                    </div>
					                                    <small class="text-muted"><?= $row['create_date']; ?></small>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
					                    	<div class="col-lg-12">
					                    		<?= $row['skripsi_abstract']; ?>
					                    	</div>

					                    	<div class="pad-ver">
					                        <p class="text-main text-bold box-inline"><i class="demo-psi-paperclip icon-fw"></i> Attachments </p>
					
					                        <ul class="mail-attach-list list-ov">
					                            
					                            <?php 
					                            	$data=mysqli_query($connect,"SELECT * FROM master_skripsi_file WHERE student_nim='$row[student_nim]'");
					                            	while($row2=mysqli_fetch_array($data)) {
					                             ?>
					                            <li>
					                                <a href="download_file.php?act=skripsi&file=<?= $row['account_id']; ?>!<?= $row2['skripsi_file_id']; ?>" target="_blank" class="thumbnail">
					                                    <div class="mail-file-icon">
					                                        <i class="demo-pli-file-word"></i>
					                                    </div>
					                                    <div class="caption">
					                                        <p class="text-main mar-no"><?= $row2['skripsi_file_status']; ?></p>
					                                        <small class="text-muted">Added: <?= $row2['create_date']; ?></small>
					                                    </div>
					                                </a>
					                            </li>
					                        	<?php } ?>

					                        </ul>
					                    </div>

					                    	
					                    </div>

					                    
					                    

					        </div>
					    </div>
					
					
					    
                </div>
                <!--===================================================-->
                <!--End page content-->
              

                <?php	break;
                } ?>

            </div>

            


