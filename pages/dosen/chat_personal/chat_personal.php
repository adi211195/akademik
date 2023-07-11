			


                <?php
                $page_detail="page.php?p=chat_personal";
                
                $action="pages/dosen/chat_personal/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:

				if (empty($_GET['send'])) {
					$kirim=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM chat_personal where 
						account_id='$account_id' order by create_date desc"));
					$send=@$kirim['personal_send'];
				} else {
					$send 		=htmlspecialchars($_GET['send']);
				}
                

                $details=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account where account_id='$send'"));
                $back="page.php?p=chat_personal&send=".$send;

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
			                                <div class="pad-all bord-btm">
			                                    <button class="btn btn-purple btn-block" data-toggle="modal" data-target="#page_input"><i class="fa fa-search icon-fw"></i> Chat </button>
			                                </div>

			                                <div class="chat-user-list">

			                                	<?php
			                                	$data=mysqli_query($connect, "SELECT chat_personal.*, 
			                                		account.account_photo, 
			                                		account.account_username,
			                                		DATE_FORMAT(chat_personal.create_date, '%H:%i %p') as jam

					                            		FROM chat_personal
					                            		LEFT JOIN account ON account.account_id=chat_personal.personal_send
					                            	where chat_personal.account_id='$account_id'
					                            	group by chat_personaL.account_id 
					                            	ORDER BY chat_personal.create_date desc");
			                                	while ($row=mysqli_fetch_array($data)) {	   		
			                                	$not_view=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM chat_personal 
			                                		where account_id='$row[personal_send]'
			                                		AND personal_send='$account_id'"));
			                                	?>
			                                    <a href="<?= $page_detail; ?>&send=<?= $row['personal_send']; ?>" class="chat-unread">
			                                        <div class="media-left">
			                                            <img class="img-circle img-xs" src="assets/account_photo/<?= $row['account_photo']; ?>" alt="Profile Picture">
			                                            <i class="badge badge-success badge-stat badge-icon pull-left"></i>
			                                        </div>
			                                        <div class="media-body">
			                                            <span class="chat-info">
			                                                <span class="text-xs"><?= $row['jam']; ?></span>
			                                                <span class="badge badge-success"><?= $not_view; ?></span>
			                                            </span>
			                                            <div class="chat-text">
			                                                <p class="chat-username"><?= $row['account_username']; ?></p>
			                                                <p><?= $row['personal_chat']; ?></p>
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
									                            	where (chat_personal.account_id='$account_id' AND chat_personal.personal_send='$send') OR (chat_personal.account_id='$send' AND chat_personal.personal_send!='$account_id')
									                            	ORDER BY chat_personal.create_date desc");
				                	
				                	$data2=mysqli_query($connect, "SELECT chat_personal.*, 
							                                		account.account_photo, 
							                                		account.account_username,
							                                		DATE_FORMAT(chat_personal.create_date, '%d %b %y %H:%i %p') as jam
									                            	FROM chat_personal
									                            	LEFT JOIN account ON account.account_id=chat_personal.personal_send
									                            	where (chat_personal.account_id='$account_id' AND chat_personal.personal_send='$send') OR (chat_personal.account_id='$send' AND chat_personal.personal_send='$account_id')
									                            	ORDER BY chat_personal.create_date desc");
				                	$account=mysqli_fetch_array($data);

				                ?>

						        <div class="media-block pad-all bord-btm">
						            <div class="pull-right">
						                <div class="btn-group dropdown">
						                     <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown" aria-expanded="false"><i class="pci-ver-dots"></i></a>
						                     <ul class="dropdown-menu dropdown-menu-right" style="">
						                         <li><a href="#"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a></li>
						                        
						                     </ul>
						                 </div>
						            </div>
						            <div class="media-left">
						                <img class="img-circle img-xs" src="assets/account_photo/<?= $account['account_photo']; ?>" alt="Profile Picture">
						            </div>
						            <div class="media-body">
						                <p class="mar-no text-main text-bold text-lg"><?= $account['account_username']; ?></p>
						                <small class="text-muteds">Typing....</small>
						            </div>
						        </div>
						
						        <div class="nano" style="height: 60vh">
						            <div class="nano-content">
						                <div class="panel-body chat-body media-block">
						                    
						                    <?php
						                    while($row=mysqli_fetch_array($data2)) { 
						                    if ($row['account_id']==$account_id) { ?>
						                    <div class="chat-me">
						                        
						                        <div class="media-body">
						                            <div>
						                                <p><?= $row['personal_chat']; ?> <small><?= $row['jam']; ?></small></p>
						                            </div>
						                        </div>
						                    </div>

						                <?php } else { ?>

						                    <div class="chat-user">
						                        <div class="media-left">
						                            <img src="assets/account_photo/<?= $account['account_photo']; ?>" class="img-circle img-sm" alt="Profile Picture">
						                        </div>
						                        <div class="media-body">
						                            <div>
						                                <p><?= $row['personal_chat']; ?> <small><?= $row['jam']; ?></small></p>
						                            </div>
						                        </div>
						                    </div>

						                <?php }} ?>


						                    
						                </div>					                

						            </div>
						            
						        </div>
						        <div class="pad-all">
						                	<form class="action" method="POST">
								            <div class="input-group">
								            
								            	<input type="hidden" name="action" value="input">
								            	<input type="hidden" name="account_username" value="<?= $send; ?>">
								                 <input type="text" name="personal_chat" placeholder="Type your message" class="form-control form-control-trans">
								                 <span class="input-group-btn">
								                     <button type="submit" class="btn btn-icon add-tooltip" data-original-title="Send" type="button"><i class="demo-pli-paper-plane icon-lg"></i></button>
								                 </span>
								             
								             </div>
								             </form>
								        </div>

						    	<?php } ?>

						       </div>
					        </div>
					    </div>
               		</div>
               	</div>
               </div>



               <!-- Modal -->
				<div id="page_input" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Chat</h4>
				      </div>
				      <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
				      	<input type="hidden" name="action" value="input">
				      <div class="modal-body">
				        				


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Username <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="account_username" class="form-control" required>
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Message <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="personal_chat" class="form-control" required>
					                        </div>
					                    </div>

					                    
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>



                <?php	break;
                } ?>



