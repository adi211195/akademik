			


                
                <?php               

                $page_detail="page.php?p=chat_group&act=detail";
                $page_video_jitsi="pages/mahasiswa/chat_group/video_jitsi.php";
                $page_video_zoom="pages/mahasiswa/chat_group/video_zoom.php";
                $back="page.php?p=chat_group";
                $action="pages/mahasiswa/chat_group/action.php";

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


					                    <div class="table-responsive">

					                    	<table class="table table-striped">
					                            <thead>
					                                <tr>
					                                	<th>No</th>
					                                    <th>Curriculum Types</th>
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
														mk.krs_approved='Approved' AND 
					                            		mk.student_nim='$student_nim'");
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
					                                    <td >
					                                    	<a href="<?= $page_detail; ?>&id=<?= $row['curriculum_id']; ?>">
						                               		 <button class="btn btn-warning" title="Detail"><i class="fa fa-wechat"></i></button></a> 
						                               		<a href="<?= $page_video_jitsi; ?>?ci=<?= $row['curriculum_id']; ?>" target="_blank">
						                               		 <button class="btn btn-primary" title="Jitsi"><i class="fa fa-video-camera"></i></button></a> 

						                               		<a href="<?= $page_video_zoom; ?>?ci=<?= $row['curriculum_id']; ?>" target="_blank">
						                               		 <button class="btn btn-info" title="Zoom"><i class="fa fa-video-camera"></i></button></a> 
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
                $back="page.php?p=chat_group&act=detail&id=".$id;

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
			                                		WHERE master_krs.curriculum_id='$id' AND 
			                                		master_krs.student_nim!='$student_nim'");
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
					        				<td>Class : <?= $details['class_room']; ?>/<?= $details['class']; ?> <br>
					                            Courses : <?= $details['courses_code']; ?> | <?= $details['courses']; ?> 
					                                    	<span class="badge badge-success"><?= $details['courses_sks']; ?> SKS</span></td>
					        				<td> Dosen : <?= $details['lecturer_name']; ?> <br>
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
				                            	var pengirim   = "<?= $account_id; ?>";
				                            	var account_id   = "<?= $details['account_id']; ?>";
												var account_sent =  "<?= $sent = isset($account_sent)?$account_sent : ''; ?>";
												var code = [account_id, account_sent];
												    code.sort();


												var pageSize = 100;										


				                            	var ref = firebase.database().ref("group"+code)
				                            		.limitToLast(200)
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
				                            			html += "<small>"+snapshot.val().date+" "+snapshot.val().time+"</small>";
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

						        <div class="pad-all">
						                	<form method="post" class="sentgroup">
								            <div class="input-group">
								            
								            	<input type="hidden" name="action" value="input">
								            	<input type="hidden" name="account_username" value="<?= $send; ?>">
								                 <input type="text" name="personal_chat" id="message" placeholder="Type your message" class="form-control form-control-trans">
								                 <span class="input-group-btn">
								                     <button type="submit" class="btn btn-icon add-tooltip" data-original-title="Send" type="button"><i class="demo-pli-paper-plane icon-lg"></i></button>
								                 </span>
								             
								             </div>
								             </form>
								  </div>


						       </div>
					        </div>
					    </div>
               		</div>
               	</div>
               </div>


                <?php	break;
                } ?>



