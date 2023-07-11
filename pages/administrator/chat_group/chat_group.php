			


                
                <?php
                if (empty(@$_GET['code'])) {
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code"));
                	$mcurriculum=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_curriculum order by curriculum_school_year, curriculum_semester desc"));

                	$majors_code=$code['majors_code'];
                	$sy=$mcurriculum['curriculum_school_year'];
                	$sm=$mcurriculum['curriculum_semester'];
                } else {
                	$majors_code	=htmlspecialchars(@$_GET['code']);
                	$sy 			=htmlspecialchars(@$_GET['sy']);
                	$sm 		=htmlspecialchars(@$_GET['sm']);
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
					                            		WHERE majors_code='$majors_code'"));
                }

                $page_detail="page.php?p=chat_group&act=detail&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $back="page.php?p=chat_group&code=".$code['majors_code']."&sy=".$sy."&sm=".$sm;
                $action="pages/administrator/chat_group/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				?>

                <div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Chat Group</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Chat Group</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Chat Group Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left"> 

					                                 <button class="btn btn-default" data-toggle="modal" data-target="#filter"><i class="fa fa-filter"></i> Filter </button>
              
					                            </div>
					                        </div>
					                    </div>

					                    <div class="alert alert-info">
					                    	School Year : <?= $sy; ?> <br>
					                    	Semester : <?= $sm; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>

					                    <div class="table-responsive">
					                        <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Types</th>
					                                    <th>Status</th>
					                                    <th>Class</th>
					                                    <th>Courses</th>
					                                    <th>Dosen</th>
					                                    <th>Schedule</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM master_curriculum as mc
					                            		INNER JOIN master_curriculum_types as mct ON mct.curriculum_types_id=mc.curriculum_types_id
					                            		INNER JOIN master_class as mclass ON mclass.class_code=mc.class_code
					                            		INNER JOIN master_courses as mcourses ON mcourses.courses_code=mc.courses_code
					                            		INNER JOIN master_lecturer as mlecturer ON mlecturer.lecturer_code=mc.lecturer_code
					                            		where mc.majors_code='$majors_code' AND 
					                            		mc.curriculum_school_year='$sy' AND
					                            		mc.curriculum_semester='$sm'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><?= $row['curriculum_types']; ?></td>
					                                    <td><?= $row['curriculum_status']; ?></td>
					                                    <td><?= $row['class_room']; ?>/<?= $row['class']; ?></td>
					                                    <td><?= $row['courses_code']; ?> | <?= $row['courses']; ?>
					                                    	<span class="badge badge-success"><?= $row['courses_sks']; ?> SKS</span>
					                                    </td>
					                                    <td><?= $row['lecturer_name']; ?></td>
					                                    <td><?= $row['curriculum_day']; ?>, <?= $row['curriculum_start']; ?> - <?= $row['curriculum_end']; ?></td>
					                                    <td>

						                               		 <a href="<?= $page_detail; ?>&id=<?= $row['curriculum_id']; ?>">
						                               		 <button class="btn btn-warning" title="Detail"><i class="fa fa-wechat"></i></button></a> 

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


                <!-- Modal -->
				<div id="filter" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Filter Chat Group</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="chat_group">
				      <div class="modal-body">
				      					<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	School Year <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="sy" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$start=date('Y')-2;
					                            	$end=date('Y')+1;
					                            	for ($i=$start; $i <= $end ; $i++) { 
					                            		$school_year=$i."/".($i+1);
					                            		if ($school_year==$sy) {
					                            	?>
					                            		<option value="<?= $school_year; ?>" selected><?= $school_year; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $school_year; ?>"><?= $school_year; ?></option>
					                            	 <?php } } ?>
					                            	
					                            </select>
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	semester <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="sm" class="form-control" required>
					                             <?php if ($sm=="Ganjil") { ?>
					                            	<option value="Ganjil">Ganjil</option>
					                            	<option value="Genap">Genap</option>
					                            <?php }  else { ?>
					                            	<option value="Genap">Genap</option>
					                            	<option value="Ganjil">Ganjil</option>
					                            <?php } ?>
					                            </select>
					                        </div>
					                    </div>

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



            	</div>

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
                 <div id="content-container">
                 	<div id="page-head"> </div>

                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-3">


					        <div class="page-fixedbar-container" style="margin: 0;">
			                    <div class="page-fixedbar-content">
			                        <div class="nano">
			                            <div class="nano-content">

			                                <div class="chat-user-list">

			                                	<?php
			                                	$data=mysqli_query($connect, "SELECT account.*		 
			                                		FROM master_krs 
			                                		LEFT JOIN master_student ON master_student.student_nim=master_krs.student_nim
			                                		LEFT JOIN account ON account.account_id=master_student.account_id
			                                		WHERE master_krs.curriculum_id='$id'");
			                                	while ($row=mysqli_fetch_array($data)) {	   		
			                                	$cg=mysqli_fetch_array(mysqli_query($connect, "SELECT group_chat, DATE_FORMAT(create_date, '%H:%i %p') as jam
			                                		FROM chat_group
			                                		where account_id='$row[account_id]' order by create_date desc"));
			                                	?>
			                                    <a href="#" class="chat-unread">
			                                        <div class="media-left">
			                                            <img class="img-circle img-xs" src="assets/account_photo/<?= $row['account_photo']; ?>" alt="Profile Picture">
			                                            <i class="badge badge-success badge-stat badge-icon pull-left"></i>
			                                        </div>
			                                        <div class="media-body">
			                                            <span class="chat-info">
			                                                <span class="text-xs"><?= $cg['jam']; ?></span>
			                                            </span>
			                                            <div class="chat-text">
			                                                <p class="chat-username"><?= $row['account_username']; ?></p>
			                                                <p><?= $cg['group_chat']; ?></p>
			                                            </div>
			                                        </div>
			                                    </a>
			                                	<?php } ?>

			                                </div>


			                            </div>
			                        </div>
			                    </div>
			                </div>



					    </div>


					    <div class="col-sm-9">
					        <div class="panel" style="margin-top: 40px;">	
					        	<div class="alert alert-primary">
					        		<b>Chat Academic group : </b> 
					        		<table class="table">

					        			<tr>
					        				<td>
					        					School Year : <?= $sy; ?> <br>
								                Semester : <?= $sm; ?> <br>
									            College : <?= $code['college']; ?> <br> 
									            Majors : <?= $code['majors']; ?>
					        				</td>

					        				<td> 
					        					Class : <?= $details['class_room']; ?>/<?= $details['class']; ?> <br>
					                            Courses : <?= $details['courses_code']; ?> | <?= $details['courses']; ?> 
					                                    	<span class="badge badge-success"><?= $details['courses_sks']; ?> SKS</span> <br>
					        					Dosen : <?= $details['lecturer_name']; ?> <br>
					                            Schedule : <?= $details['curriculum_day']; ?>, <?= $details['curriculum_start']; ?> - <?= $details['curriculum_end']; ?></td>
					        			</tr>
					        		</table>
					        	</div>
					        	<div class="chat">
						        <div class="nano" style="height: 60vh">
						            <div class="nano-content">
						                <div class="panel-body chat-body media-block">
						                	<div style="
											  height: 350px;
											  overflow: auto;
											  overflow-x: hidden;
											  display: flex;
											  flex-direction: column-reverse;
											  padding: 10px;
											">

											<?php $account_sent=$details['curriculum_id']; ?>
						                    
						                    <script>
				                            	// listen for incoming messages
				                            	var pengirim   = "<?= $details['account_id']; ?>";
				                            	var account_id   = "<?= $details['account_id']; ?>";
												var account_sent =  "<?= $sent = isset($account_sent)?$account_sent : ''; ?>";
												var code = [account_id, account_sent];
												    code.sort();


												var pageSize = 100;										


				                            	var ref = firebase.database().ref("group"+code)
				                            		.on("child_added", function (snapshot) {
				                            		var html = "";
				                            		if (snapshot.val().account_id == pengirim) {
				                            			html += "<div class='chat-me' id='"+snapshot.key+"'>";
				                            			html += "<div class='media-body'>";
				                            			html += "<div><p>"+snapshot.val().message;
				                            			html += "<small>"+snapshot.val().date+" "+snapshot.val().time+" <button data-id='" + snapshot.key + "' onclick='deletegroup(this);' class='btn btn-default btn-xs'><i class='fa fa-trash'></i></button></small>";
				                            			html += "</p></div>";
				                            			html += "</div>";
				                            			html += "</div>";
				                            		} else if (snapshot.val().account_id != pengirim) {
				                            			html += "<div class='chat-user' id='"+snapshot.key+"'>";
				                            			html += "<div class='media-left'>";
				                            			html += "<img src='assets/account_photo/"+snapshot.val().account_photo+"'";
				                            			html += "class='img-circle img-sm' alt='Profile Picture'>";
				                            			html += "</div>";
				                            			html += "<div class='media-body'>";
				                            			html += "<div><p>"+snapshot.val().message;
				                            			html += "<small>"+snapshot.val().account_username+" | "+snapshot.val().date+" "+snapshot.val().time+"<button data-id='" + snapshot.key + "' onclick='deletegroup(this);' class='btn btn-default btn-xs'><i class='fa fa-trash'></i></button></small>";
				                            			html += "</p></div>";
				                            			html += "</div>";
				                            			html += "</div>";
				                            			

				                            		}

				                            		if (snapshot.val().account_id != pengirim) {
				                            				firebase.database().ref("group"+code+"/"+snapshot.key).update({
														    "view": "0"
														  });
				                            			}

				                            		document.getElementById("chat").innerHTML += html;
				                            		
				                            	});


				                            </script>
				                            <div id="chat"></div>
						                    
						            		</div>

						                    
						                </div>
						            </div>
						        </div>


						       </div>
					        </div>
					    </div>

					    
               		</div>
               	</div>
               </div>


                <?php	break;
                } ?>



