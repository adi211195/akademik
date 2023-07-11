			


                <?php
                if (empty(@$_GET['code'])) {
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code"));        

                	$majors_code=$code['majors_code'];
                	$thn2=date('Y')+1;
                	$gen=date('Y')."/".$thn2;
                } else {
                	$majors_code	=htmlspecialchars(@$_GET['code']);
                	$gen 			=htmlspecialchars(@$_GET['gen']);
                	$code=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM master_majors
					                            		LEFT JOIN master_college ON master_college.college_code=master_majors.college_code
					                            		WHERE majors_code='$majors_code'"));
                }


                $page_detail="page.php?p=chat_personal_student&act=detail&code=".$code['majors_code']."&gen=".$gen;
                $back="page.php?p=chat_personal_student&code=".$code['majors_code']."&gen=".$gen;
                $action="pages/administrator/chat_personal_student/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				?>

				<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Chat Personal Student</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Chat Personal Student</li>
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
					                    <h3 class="panel-title">Chat Personal Data</h3>
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
					                    	Generation : <?= $gen; ?> <br>
						                    College : <?= $code['college']; ?> <br> 
						                    Majors : <?= $code['majors']; ?>
						                </div>

					                   
					                    <div class="table-responsive">
					                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Photo</th>
					                                    <th>Username</th>
														<th>NIM</th>
					                                    <th>Name</th>
					                                    <th>Gender</th>
					                                    <th>Status</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT *
					                            		FROM chat_personal
					                            		LEFT JOIN account ON account.account_id=chat_personal.account_id
					                            		LEFT JOIN master_student ON master_student.account_id=account.account_id
					                            		WHERE 
														master_student.majors_code='$majors_code' AND
														master_student.student_generation='$gen' AND
					                            		account_status='Mahasiswa'
					                            		group by chat_personaL.account_id ORDER BY chat_personal.create_date desc");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><img src="assets/account_photo/<?= $row['account_photo']; ?>" alt="" style="width: 50px;"></td>
					                                    <td><?= $row['account_username']; ?></td>
					                                    <td><?= $row['student_nim']; ?></td>
					                                    <td><?= $row['student_name']; ?></td>
					                                    <td><?= $row['student_gender']; ?></td>
					                                    <td><?= $row['student_status']; ?></td>
					                                    <td>
					                                    	
						                                    <a href="<?= $page_detail; ?>&id=<?= $row['account_id']; ?>">
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



            	</div>

            	<!-- Modal -->
				<div id="filter" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Filter Chat Personal Student</h4>
				      </div>
				      <form class="form-horizontal" method="GET" action="<?= $back; ?>"  enctype="multipart/form-data">
				      <input type="hidden" name="p" value="chat_personal_student">
				      <div class="modal-body">
				      					<div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Generation <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <select name="gen" class="form-control" required>
					                            	<option value=""> -- Select --</option>
					                            	<?php
					                            	$start=date('Y')-2;
					                            	$end=date('Y')+1;
					                            	for ($i=$start; $i <= $end ; $i++) { 
					                            		$generation=$i."/".($i+1);
					                            		if ($generation==$gen) {
					                            	?>
					                            		<option value="<?= $generation; ?>" selected><?= $generation; ?></option>
					                            	<?php } else { ?>
					                            		<option value="<?= $generation; ?>"><?= $generation; ?></option>
					                            	 <?php } } ?>
					                            	
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

                <?php 
                break;
                
                case 'detail':
                $id 		=htmlspecialchars($_GET['id']);
                $send 		=htmlspecialchars($_GET['send']);
                $details=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_student ON master_student.account_id=account.account_id
                	where account.account_id='$id'"));


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
			                                	$no=1;
			                                	$data=mysqli_query($connect, "SELECT chat_personal.*, 
			                                		account.account_photo, 
			                                		account.account_username,
			                                		DATE_FORMAT(chat_personal.create_date, '%H:%i %p') as jam

					                            		FROM chat_personal
					                            		LEFT JOIN account ON account.account_id=chat_personal.personal_send
					                            	where chat_personal.account_id='$id'
					                            	ORDER BY chat_personal.create_date desc");
			                                	while ($row=mysqli_fetch_array($data)) {	  		
			                                	$account_sent=$row['personal_send'];
			                                	?>

			                                	<script type="text/javascript">
			                                		// listen for incoming messages
				                            	var account_id   = "<?= $account_id; ?>";
												var account_sent =  "<?= $sent = isset($account_sent)?$account_sent : ''; ?>";
												var code = [account_id, account_sent];
												    code.sort();

												


												var ref = firebase.database().ref("personal"+code)
												    ref.orderByChild('view')
  													.equalTo('1')
  													ref.orderByChild('account_receiver')
  													.equalTo('<?= $account_id; ?>')
  													.limitToLast(1)
													.on("child_added", function(snapshot) {

													if (snapshot.val().view=="1") {
														$("#pesan<?= $no; ?>").html('<b>'+snapshot.val().message+'</b>');
													} else {
														$("#pesan<?= $no; ?>").html(snapshot.val().message);
													}
													  
													  $("#jam<?= $no; ?>").html(snapshot.val().time);

												});
			                                	</script>


			                                    <a href="<?= $page_detail; ?>&id=<?=$id; ?>&send=<?= $row['personal_send']; ?>" class="chat-unread">
			                                        <div class="media-left">
			                                            <img class="img-circle img-xs" src="assets/account_photo/<?= $row['account_photo']; ?>" alt="Profile Picture">
			                                            <i class="badge badge-success badge-stat badge-icon pull-left"></i>
			                                        </div>
			                                        <div class="media-body">
			                                            <span class="chat-info">
			                                                <span class="text-xs" id="jam<?= $no; ?>"></span>
			                                                <span class="badge badge-success"></span>
			                                            </span>
			                                            <div class="chat-text">
			                                                <p class="chat-username"><?= $row['account_username']; ?></p>
			                                                <p id="pesan<?= $no; ?>"></p>
			                                            </div>
			                                        </div>
			                                    </a>
			                                <?php $no++; } ?>

			                                </div>


			                            </div>
			                        </div>
			                    </div>
			                </div>



					    </div>


					    <div class="col-sm-9">
					        <div class="panel" style="margin-top: 40px;">
					        	<div class="alert alert-primary">
					        		<b>Chat Personal Student : </b> 
					        		<table class="table">

					        			<tr>
					        				<td>
					        					Generation : <?= $gen; ?> <br>
							                    College : <?= $code['college']; ?> <br> 
							                    Majors : <?= $code['majors']; ?> <br><br>

							                    <a href="<?= $back; ?>">
					        					<button type="button" class="btn btn-default">Back</button></a>
					        				</td>

					        				<td> 
					        					NIM : <?= $details['student_nim']; ?> <br>
					        					Name : <?= $details['student_name']; ?> <br>
					        					Gender : <?= $details['student_gender']; ?> <br>
					        					Username :  <?= $details['account_username']; ?>
					        				</td>
					        			</tr>
					        		</table>
					        		
					        	</div>

					        	<div class="chat">

					        	<?php if (empty($send)) { ?>
				                	<div class="cls-content text-center">
									    <h1 class="error-code text-muted"><i class="demo-pli-speech-bubble-7 icon-2x"></i></h1>
									    <p class="h4 text-uppercase text-bold">Chat not found</p>
									    <div class="pad-btm">
									        To see a list of conversations, <br> please click the chat list on the left.
									    </div>
									</div>

				                <?php } else { 

				                	$data=mysqli_query($connect, "SELECT chat_personal.*, 
							                                		account.account_photo, 
							                                		account.account_username
									                            	FROM chat_personal
									                            	LEFT JOIN account ON account.account_id=chat_personal.personal_send
									                            	where (chat_personal.account_id='$id' AND chat_personal.personal_send='$send') OR (chat_personal.account_id='$send' AND chat_personal.personal_send!='$id')
									                            	ORDER BY chat_personal.create_date desc");
				                	
				                	
				                	$account=mysqli_fetch_array($data);
				                	$account_sent=$account['personal_send'];

				                ?>

				                

						        <div class="media-block pad-all bord-btm">
						            <div class="pull-right">
						                <div class="btn-group dropdown">
						                     <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown" aria-expanded="false"><i class="pci-ver-dots"></i></a>
						                     
						                 </div>
						            </div>
						            <div class="media-left">
						                <img class="img-circle img-xs" src="assets/account_photo/<?= $account['account_photo']; ?>" alt="Profile Picture">
						            </div>
						            <div class="media-body">
						                <p class="mar-no text-main text-bold text-lg"><?= $account['account_username']; ?></p>
						                <small class="text-muteds" id="typingStatus"></small>
						            </div>
						        </div>

						
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

											


											<script>
				                            	// listen for incoming messages
				                            	var pengirim   = "<?= $id; ?>";
				                            	var account_id   = "<?= $id; ?>";
												var account_sent =  "<?= $sent = isset($account_sent)?$account_sent : ''; ?>";
												var code = [account_id, account_sent];
												    code.sort();


												var pageSize = 100;										


				                            	var ref = firebase.database().ref("personal"+code)
				                            		.on("child_added", function (snapshot) {
				                            		var html = "";
				                            		if (snapshot.val().account_id == pengirim) {
				                            			html += "<div class='chat-me' id='"+snapshot.key+"'>";
				                            			html += "<div class='media-left'>";
				                            			html += "<img src='assets/account_photo/"+snapshot.val().account_photo+"'";
				                            			html += "class='img-circle img-sm' alt='Profile Picture'>";
				                            			html += "</div>";
				                            			html += "<div class='media-body'>";
				                            			html += "<div><p>"+snapshot.val().message;
				                            			html += "<small>"+snapshot.val().account_username+" | "+snapshot.val().date+" "+snapshot.val().time+" <button data-id='" + snapshot.key + "' onclick='deleteprivate(this);' class='btn btn-default btn-xs'><i class='fa fa-trash'></i></button></small>";
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
				                            			html += "<small>"+snapshot.val().date+" "+snapshot.val().time+" <button data-id='" + snapshot.key + "' onclick='deleteprivate(this);' class='btn btn-default btn-xs'><i class='fa fa-trash'></i></button></small>";
				                            			html += "</p></div>";
				                            			html += "</div>";
				                            			html += "</div>";
				                            			

				                            		}


				                            		document.getElementById("chat").innerHTML += html;
				                            		
				                            	});




				                            </script>
				                            <div id="chat"></div>


						            		</div>						                    
						                </div>					                

						            </div>
						            
						        </div>

								

						    	<?php } ?>

						       </div>
					        </div>
					    </div>
               		</div>
               	</div>
               </div>


                <?php	break;
                } ?>



