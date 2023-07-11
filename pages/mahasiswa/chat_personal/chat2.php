			
<style>
    
    
    #chat {
        transform:rotate(180deg);
    }

    #chat2 {
    	transform:rotate(180deg);
    }
    
   
</style>


                <?php
                $page_detail="page.php?p=chat_personal";
                
                $action="pages/mahasiswa/chat_personal/action.php";

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
			                                	$no=1;
			                                	$data=mysqli_query($connect, "SELECT chat_personal.*, 
			                                		account.account_photo, 
			                                		account.account_username,
			                                		DATE_FORMAT(chat_personal.create_date, '%H:%i %p') as jam

					                            		FROM chat_personal
					                            		LEFT JOIN account ON account.account_id=chat_personal.personal_send
					                            	where chat_personal.account_id='$account_id'
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


			                                    <a href="<?= $page_detail; ?>&send=<?= $row['personal_send']; ?>" class="chat-unread">
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
						                    

						                    	<div id="chat2" style="overflow-x: hidden; overflow-y: auto; position: relative; height: 350px; margin-bottom: 5px; ">
						                            <!-- create a list -->
						                            <ul id="chat" class="list-unstyled" style="transform:rotate(360deg);">
						                                
						                            </ul>
						                        </div>


											<script>
				                            	// listen for incoming messages
				                            	var pengirim   = "<?= $account_id; ?>";
												var account_sent =  "<?= $sent = isset($account_sent)?$account_sent : ''; ?>";
												var code = [account_id, account_sent];
												    code.sort();

												

												
				                            	var ref = firebase.database().ref("personal"+code)
				                            		.on("child_added", function (snapshot) {
				                            		var html = "";
				                            		html += "<li style='transform:rotate(180deg);'>";
				                            		if (snapshot.val().account_id == pengirim) {
				                            			
				                            			html += "<div><p>"+snapshot.val().message;
				                            			html += "</div>";
				                            		} else if (snapshot.val().account_id != pengirim) {
				                            			
				                            			html += "<div><p>"+snapshot.val().message;
				                            			html += "</div>";

				                            			firebase.database().ref("personal"+code+"/"+snapshot.key).update({
														    "view": "0"
														  });

				                            		}
				                            		html += "</li>";




				                            			firebase.database().ref("personal"+code+"/"+snapshot.key).update({
														    "view": "0"
														  });
				                            
				                            		document.getElementById("chat").innerHTML += html;
				                            	});

				                            	document.getElementById("chat").scrollTop = document.getElementById("chat").scrollHeight;
				                            </script>
					                            						                    
						                </div>					                

						            </div>
						            
						        </div>
						        <div class="pad-all">
						                	<form method="post" class="sentprivate">
								            <div class="input-group">
								            
								            	<input type="hidden" name="action" value="input">
								            	<input type="hidden" name="account_username" value="<?= $send; ?>">
								                 <input type="text" name="personal_chat" id="message" onkeyup="typestatus();" placeholder="Type your message" class="form-control form-control-trans">
								                 <span class="input-group-btn">
								                     <button type="submit" class="btn btn-icon add-tooltip" data-original-title="Send" type="button"><i class="demo-pli-paper-plane icon-lg"></i></button>
								                 </span>
								             
								             </div>
								             </form>
								        </div>

								 <script type="text/javascript">
								 	setInterval(function() {
									    $('#typingStatus').load('pages/ajax/ajax_typing.php?account_id=<?= $account_id; ?>&account_sent=<?= $account_sent; ?>');
									  }, 3000); // the "3000" 
								 </script>

								

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
				      <form class="form-horizontal action" method="POST"   enctype="multipart/form-data">
				      	<input type="hidden" name="action" value="input">
				      <div class="modal-body">
				        				


					                    <div class="form-group">
					                        <label class="col-sm-3 control-label" >
					                        	Username <span class="required">*</span></label>
					                        <div class="col-sm-9">
					                            <input type="text" name="account_username" id="account_username" class="form-control" placeholder="Search by username" autocomplete="off" required/>  
          										<div id="account_nameList"></div>
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



