			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Mail Academic Lecturer</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Mail Academic Lecturer</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                
                $page_detail="page.php?p=mail_lecturer&act=detail";
                $back="page.php?p=mail_lecturer";
                $action="pages/administrator/mail_lecturer/action.php";
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
					                <div class="panel-heading">
					                    <h3 class="panel-title">Mail Academic Lecturer Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">

					                    <div class="table-responsive">
					                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Photo</th>
					                                    <th>Code</th>
					                                    <th>Name</th>
					                                    <th>Mail Academic</th>
					                                    <th></th>
					                                </tr>
					                            </thead>
					                            <tbody>
					                            	<?php
					                            	$no=1;
					                            	$data=mysqli_query($connect, "SELECT * FROM mail_account
					                            		LEFT JOIN account ON account.account_id=mail_account.account_id
					                            		LEFT JOIN master_lecturer ON master_lecturer.account_id=account.account_id
					                            		WHERE mail_account_status='lecturer'");
					                            	while ($row=mysqli_fetch_array($data)) {
					                            	?>
					                                <tr>
					                                    <td><?= $no; ?></td>
					                                    <td><img src="assets/account_photo/<?= $row['account_photo']; ?>" alt="" style="width: 50px;"></td>
					                                    <td><?= $row['lecturer_code']; ?></td>
					                                    <td><?= $row['lecturer_name']; ?></td>
					                                    <td><?= $row['mail_account']; ?></td>
					                                    <td>
					                                    	<a href="<?= $page_detail; ?>&id=<?= $row['account_id']; ?>">
						                               		 <button class="btn btn-warning" title="Detail"><i class="demo-pli-mail"></i></button></a> 
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


                


                <?php 
                break;
                case 'detail':

                $status 		=htmlspecialchars(@$_GET['status']);
                $account_id 	=htmlspecialchars(@$_GET['id']);
                $view 			=htmlspecialchars(@$_GET['view']);
                
                $page_detail="page.php?p=mail_lecturer&act=detail&id=$account_id";
                $page_draft="page.php?p=mail_lecturer&act=draft&id=$account_id";        
                $action="pages/administrator/mail_lecturer/action.php";

                $details=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM mail_account
					LEFT JOIN account ON account.account_id=mail_account.account_id
					LEFT JOIN master_lecturer ON master_lecturer.account_id=account.account_id
                	where mail_account.account_id='$account_id'"));

                $mail=$details['mail_account'];

                @$inbox=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mail_academic_sent
                	 where mail_sent='$mail' AND 
                	 mail_view='1' AND
                	 mail_status='Sent'"));

                @$draft=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mail_academic_accepted
                	 where mail_account='$mail' AND 
                	 mail_status='Draft'"));

                @$sent=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mail_academic_accepted
                	 where mail_account='$mail' AND 
                	 mail_status='Sent'"));

                @$trash=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM mail_academic_accepted
                	 where mail_account='$mail' AND 
                	 mail_status='Trash'"));

                if ($status=="draft") {

                	$table="mail_academic_accepted";
                	$table2="mail_academic_accepted.mail_sent";
                	$where="where mail_account='$mail' AND 
                	 mail_status='Draft'";

                	 $read_draft="mail-nav-unread";

                } elseif ($status=="sent") {

                	$table="mail_academic_accepted";
                	$table2="mail_academic_accepted.mail_sent";
                	$where="where mail_account='$mail' AND 
                	 mail_status='Sent'";

                	 $read_sent="mail-nav-unread";

                } elseif ($status=="trash") {

                	$table="mail_academic_accepted";
                	$table2="mail_academic_accepted.mail_sent";
                	$where="where mail_account='$mail' AND 
                	 mail_status='Trash'";

                	$read_trash="mail-nav-unread";

                } else {

                	$table="mail_academic_sent";
                	$table2="mail_academic_sent.mail_account";
                	$where="where mail_sent='$mail' AND 
                	 mail_status='Sent'";

                	$read_inbox="mail-nav-unread";

                }


                if ($status=="draft") {
					$page_detail_view=$page_draft."&status=draft";
					$back=$page_draft."&status=draft";
				} elseif ($status!="" AND $status!="draft") {
					$page_detail_view=$page_detail."&status=".$status;
					$back=$page_detail."&status=".$status;
				} else {
					$page_detail_view=$page_detail."&status=".$status;
					$back="page.php?p=mail_lecturer";
				}


                ?>


                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">

					    	<div class="panel-body">
               					<div class="alert alert-info">
						                    Code : <?= $details['lecturer_code']; ?> <br> 
					                        Name : <?= $details['lecturer_name']; ?> <br> 
					                        Mail Academic : <?= $details['mail_account']; ?>
						                </div>

						                <a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a> 
						     </div>

					        <div class="panel-body">
					            <div class="fixed-fluid">
					                <div class="fixed-sm-200 pull-sm-left fixed-right-border">
					
					                    <p class="pad-hor mar-top text-main text-bold text-sm text-uppercase">Folders</p>
					                    <div class="list-group bg-trans pad-btm bord-btm">
					                        <a href="<?= $page_detail; ?>&status=inbox" class="list-group-item <?= $read_inbox; ?>">
					                            <i class="demo-pli-mail-unread icon-lg icon-fw"></i> Inbox (<?= $inbox; ?>)
					                        </a>
					                        <a href="<?= $page_detail; ?>&status=draft" class="list-group-item <?= $read_draft; ?>">
					                            <i class="demo-pli-pen-5 icon-lg icon-fw"></i> Draft (<?= $draft; ?>)
					                        </a>
					                        <a href="<?= $page_detail; ?>&status=sent" class="list-group-item <?= $read_sent; ?>">
					                            <i class="demo-pli-mail-send icon-lg icon-fw"></i> Sent (<?= $sent; ?>)
					                        </a>
					                        <a href="<?= $page_detail; ?>&status=trash" class="list-group-item <?= $read_trash; ?>">
					                            <i class="demo-pli-trash icon-lg icon-fw"></i> Trash (<?= $trash; ?>)
					                        </a>
					                    </div>
					
					                    
					                </div>

					                <?php if (empty($view)) { ?>

					                <div class="fluid">
					                    <div id="demo-email-list">
					                        <div class="row">
					                            <div class="col-sm-7 toolbar-left">
					                              
					                                <!--Refresh button-->
					                                <a href="<?= $page_detail_view; ?>">
								                        <button id="demo-mail-ref-btn" data-toggle="panel-overlay" data-target="#demo-email-list" class="btn btn-default" type="button">
								                            <i class="demo-psi-repeat-2"></i>
								                        </button>
								                    </a>
							                        
							                    </div>
					
					                            <?php
					                            //PAGGING
								                  
								                      $batas = 10;
								        			  $page = isset($_GET['page'])?(int)$_GET['page'] : 1;
								        		      $page_awal = ($page>1) ? ($page * $batas) - $batas : 0;	
								         
								        			  $previous = $page - 1;
								        			  $next = $page + 1;

												
								                      $data=mysqli_query($connect, "SELECT $table.*, $table2 as mail,
														DATE_FORMAT(create_date, '%d %b %Y %H:%i %p') as jam
														FROM $table
															$where");
								                      
								                      $jumlah_data = mysqli_num_rows($data);
												      $total_page = ceil($jumlah_data / $batas);
												      $nomor = $page_awal+1;
												      
												   //PAGGING  
												?>   


					                            <div class="col-sm-5 toolbar-right">
					                                <!--Pager buttons-->
					                                <span class="text-main">
					                                <strong><?= $page; ?>-<?= $page+9; ?></strong>
					                                of
					                                <strong><?= $jumlah_data; ?></strong>
					                            </span>

					                                <div class="btn-group btn-group">
					                                <a <?php if($page > 1){ echo "href='$page_detail_view&page=$previous'"; } ?>>
					                                    <button class="btn btn-default" type="button">
						                                    <i class="demo-psi-arrow-left"></i>
						                                </button>
						                            </a>

						                            <a <?php if($page > 1){ echo "href='$page_detail_view&page=$next'"; } ?>>
					                                    <button class="btn btn-default" type="button">
						                                    <i class="demo-psi-arrow-right"></i>
						                                </button>
						                             </a>
					                                </div>
					                            </div>
					                        </div>
					
					                        <!--Mail list group-->
					                        <ul id="demo-mail-list" class="mail-list pad-top bord-top">
					
					                            				
												<?php
												$no=1; 
												$data=mysqli_query($connect,"SELECT $table.*, 
												DATE_FORMAT(create_date, '%d %b %Y %H:%i %p') as jam
												FROM $table
													$where limit $page_awal, $batas");
												while ($row=mysqli_fetch_array($data)) {
													if (empty($row['mail_reply'])) {
														$mail_id=$row['mail_id'];
														$ket_reply="";
													} else {
														$mail_id=$row['mail_reply'];
														$ket_reply="Reply : ";
													}
										

													if ($row['mail_view']==0) {
												?>
					                            <!--Mail list item-->
					                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
					                            <li>
					                                <div class="mail-control">
					                                	<input id="email-list-<?= $no; ?>" class="magic-checkbox" type="checkbox">
					                                    <label for="email-list-<?= $no; ?>"></label>					                                    
					                                </div>
					                                <div class="mail-from">
					                                	<a href="<?= $page_detail_view; ?>&view=<?= $mail_id; ?>">
					                                		<?= $ket_reply; ?> <?= $row['mail_account']; ?> 
					                                	</a>
					                                </div>
					                                <div class="mail-time"><?= $row['jam']; ?></div>
					                                <div class="mail-subject">
					                                	<a href="<?= $page_detail_view; ?>&view=<?= $mail_id; ?>">
					                                		<?= $ket_reply; ?> <?= $row['mail_subject']; ?>					
					                                	</a>
					                                </div>
					                            </li>
												
												<?php } else { ?>
					
					                            <!--Mail list item-->
					                            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
					                            <li class="mail-list-unread">
					                               <div class="mail-control">
					                                    <input id="email-list-<?= $no; ?>" class="magic-checkbox" type="checkbox">
					                                    <label for="email-list-<?= $no; ?>"></label>
					                                </div>
					                                <div class="mail-from">
					                                	<a href="<?= $page_detail_view; ?>&view=<?= $mail_id; ?>">
					                                		<?= $ket_reply; ?> <?= $row['mail_account']; ?> 
					                                	</a>
					                                </div>
					                                <div class="mail-time"><?= $row['jam']; ?></div>
					                                <div class="mail-subject">
					                                	<a href="<?= $page_detail_view; ?>&view=<?= $mail_id; ?>">
					                                		<?= $ket_reply; ?> <?= $row['mail_subject']; ?>					
					                                	</a>
					                                </div>
					                            </li>
					                        <?php } $no++; } ?>

					                        </ul>
					                    </div>
					
					                </div>

					                <?php } else { 

					                $dm=mysqli_fetch_array(mysqli_query($connect, "SELECT 
					                	mail_academic_sent.*, 
					                	mail_account.*,
					                	account.*,
					                	DATE_FORMAT(mail_academic_sent.create_date, '%d %b %Y %H:%i %p') as jam
					                	 FROM mail_academic_sent 
					                	LEFT JOIN mail_account ON mail_account.mail_account=mail_academic_sent.mail_sent 
					                	LEFT JOIN account ON account.account_id=mail_account.account_id
					                	where mail_id='$view'"));


					                if ($dm['mail_account_status']=="Student") {
					                	$personal=mysqli_fetch_array(mysqli_query($connect, "SELECT student_nim as code, student_name as name FROM master_student
					                	where account_id='$dm[account_id]'"));
					                } else {
					                	$personal=mysqli_fetch_array(mysqli_query($connect, "SELECT lecturer_code as code, lecturer_name as name FROM master_lecturer
					                	where account_id='$dm[account_id]'"));
					                }


					                ?>

					                <div class="fluid">
					
					                    <!-- VIEW MESSAGE -->
					                    <!--===================================================-->
					
					                    <div class="mar-btm pad-btm bord-btm">
					                        <h1 class="page-header text-overflow">
					                            <?= $dm['mail_subject']; ?>
					                        </h1>
					                    </div>
					
					                    <div class="row">
					                        <div class="col-sm-7 toolbar-left">
					
					                            <!--Sender Information-->
					                            <div class="media">
					                                <span class="media-left">
					                                <img src="assets/account_photo/<?= $dm['account_photo']; ?>" class="img-circle img-sm" alt="Profile Picture">
					                            </span>
					                                <div class="media-body text-left">
					                                    <div class="text-bold"><?= $personal['code']; ?> | <?= $personal['name']; ?></div>
					                                    <small class="text-muted"><?= $dm['mail_sent']; ?></small>
					                                </div>
					                            </div>
					                        </div>
					                        <div class="col-sm-5 toolbar-right">
					
					                            <!--Details Information-->
					                            <p class="mar-no"><small class="text-muted"><?= $dm['jam']; ?></small></p>
					                            
					                        </div>
					                    </div>
					                    <!--Message-->
					                    <!--===================================================-->
					                    <div class="mail-message">
					                        <?= $dm['mail_post']; ?>
					                    </div>
					                    <!--===================================================-->
					                    <!--End Message-->
											
										<?php
										$data=mysqli_query($connect,"SELECT * FROM mail_file where mail_id='$view'");
										@$file=mysqli_num_rows($data);
										if ($file>0) {
										?>
					                    <!-- Attach Files-->
					                    <!--===================================================-->
					                    <div class="pad-ver">
					                        <p class="text-main text-bold box-inline"><i class="demo-psi-paperclip icon-fw"></i> Attachments <span>(<?= $file; ?>) - </span></p>
					
					                        <ul class="mail-attach-list list-ov">
					                            
					                            <?php
					                            $data=mysqli_query($connect,"SELECT mail_file.*,
												DATE_FORMAT(create_date, '%d %b %Y %H:%i %p') as jam
												FROM mail_file where mail_id='$view'");
					                            while ($row=mysqli_fetch_array($data)) {
					                            	$type=mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mail_file_type where mail_file_type='$row[mail_file_type]'"));
					                            ?>
					                            <li>
					                                <a href="download_file.php?act=mail&file=<?= $account_id; ?>!<?= $row['mail_file_id']; ?>" target="_blank" class="thumbnail">
					                                    <div class="mail-file-icon">
					                                        <i class="<?= $type['mail_file_icon']; ?>"></i>
					                                    </div>
					                                    <div class="caption">
					                                        <p class="text-main mar-no"><?= $row['mail_file_name']; ?></p>
					                                        <small class="text-muted">Added: <?= $row['jam']; ?></small>
					                                    </div>
					                                </a>
					                            </li>
					                        <?php } ?>
					                            

					                        </ul>
					                    </div>
					                    <!--===================================================-->
					                    <!-- End Attach Files-->
					                	<?php } ?>
					
										<br>
					                    <p class="text-lg text-main text-bold text-uppercase pad-btm">Reply</p>
					                    
					                    <?php
					                    $data=mysqli_query($connect,"SELECT 
								                	mail_academic_sent.*, 
								                	mail_account.*,
								                	account.*,
								                	DATE_FORMAT(mail_academic_sent.create_date, '%d %b %Y %H:%i %p') as jam
								                	 FROM mail_academic_sent 
								                	LEFT JOIN mail_account ON mail_account.mail_account=mail_academic_sent.mail_account 
								                	LEFT JOIN account ON account.account_id=mail_account.account_id
								                	where mail_reply='$view'");
					                    while ($row=mysqli_fetch_array($data)) {



					                    	if ($row['mail_account_status']=="Student") {
							                	$personal=mysqli_fetch_array(mysqli_query($connect, "SELECT student_nim as code, student_name as name FROM master_student
							                	where account_id='$row[account_id]'"));
							                } else {
							                	$personal=mysqli_fetch_array(mysqli_query($connect, "SELECT lecturer_code as code, lecturer_name as name FROM master_lecturer
							                	where account_id='$row[account_id]'"));
							                }
					                    ?>


					                    <div class="comments media-block">
							                <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="img/profile-photos/2.png"></a>
							                <div class="media-body">
							                    <div class="comment-header">
							                        <a href="#" class="media-heading box-inline text-main text-bold"><?= $personal['code']; ?> | <?= $personal['name']; ?></a>
							                        <p class="text-muted text-sm"><?= $row['mail_account']; ?> | <?= $row['jam']; ?></p>
							                    </div>
							                    <p><?= $row['mail_post']; ?></p>	
							                </div>
							            </div>

							        	<?php } ?>


							        	<?php if ($status=="inbox") { ?>

							        	<form class="action" method="post">
							        	<input type="hidden" name="action" value="reply">
							        	<input type="hidden" name="id" value="<?= $row['mail_id']; ?>">
							        	<input type="hidden" name="mail_sent" value="<?= $row['mail_account']; ?>">
							        	<input type="hidden" name="mail_subject" value="<?= $row['mail_subject']; ?>">
							        	<!--Quick reply : Summernote Placeholder -->
					                    <textarea id="demo-mail-textarea" name="mail_post" class="mail-message-reply form-control bg-trans-dark">
					                        Reply or Forward this message...
					                    </textarea>
					
					                    <!--Send button-->
					                    <div class="pad-btm">
					                        <button id="demo-mail-send-btn" type="submit" class="btn btn-primary btn-lg btn-block hide">
					                        <span class="demo-psi-mail-send icon-lg icon-fw"></span>
					                        Send Message
					                    </button>
					                    </div>
					                    </form>
					                    <!--===================================================-->
					                    <!-- END VIEW MESSAGE -->

							        	<?php } ?>
					
					                </div>

					                <?php } ?>
					            </div>
					        </div>


					    </div>
					
					    
                </div>
                <!--===================================================-->
                <!--End page content-->


                


                <?php	break;
                } ?>

            </div>



