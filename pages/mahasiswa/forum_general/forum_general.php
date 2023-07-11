			
				<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Forum General</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Forum General</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->			    

                </div>

                <?php

                $action="pages/mahasiswa/forum_general/action.php";
                $page_detail="page.php?p=forum_general&act=detail";
                $page_list="page.php?p=forum_general&act=list";
                $page_input="page.php?p=forum_general&act=input";
                $page_edit="page.php?p=forum_general&act=edit";
                $back="page.php?p=forum_general";

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
							        	<input type="hidden" name="p" value="forum_general">
							            <div class="input-group mar-btm">
							                 <span class="input-group-btn">
							                 	<a href="<?= $page_list; ?>">
							                     <button class="btn btn-info btn-lg" type="button"><i class="fa fa-list"></i></button></a>
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
					        	$where="WHERE forum_title like '%$search%'";

					        	$data=mysqli_query($connect, "SELECT * FROM forum_general $where
					            	order by create_date desc");
								                      
								$jumlah_data = mysqli_num_rows($data);
								$total_page = ceil($jumlah_data / $batas);

					        	?>
					            <div class="pad-hor mar-top">
					                <h2 class="text-thin mar-no"><?= $jumlah_data; ?> results found for: <i class="text-info text-normal">"<?= $search; ?>"</i></h2>
					            </div>
					
					            <hr>

					        	<?php } else {
					        		$search="";
					        		$filter="";
					        		$where="";
					        		$data=mysqli_query($connect, "SELECT * FROM forum_general $where
					            	order by create_date desc");
								                      
									$jumlah_data = mysqli_num_rows($data);
									$total_page = ceil($jumlah_data / $batas);

					        	} ?>
					
					            <ul class="list-group bord-no">
					            <?php
					            
					            
					            $nomor = $page_awal+1;

					            $data=mysqli_query($connect, "SELECT forum_general.*, 
					            	account.*, 
					            	date_format(forum_general.create_date, '%d %b %Y %H:%i %p') as jam
					            	FROM forum_general 
					            	LEFT JOIN account ON account.account_id=forum_general.account_id
					            	 $where
					            	order by forum_general.create_date desc limit $page_awal, $batas");
					            while ($row=mysqli_fetch_array($data)) {
					            		$comment=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM forum_comment 
					            		where forum_id='$row[forum_id]'"));
					            ?>  

					                <li class="list-group-item list-item-lg">
					                    <div class="media-heading">
					                        <a class="btn-link text-lg text-semibold" href="<?= $page_detail; ?>&id=<?= $row['forum_id']; ?>">
					                        	<?= bold($row['forum_title'],$search); ?></a>
					                    </div>
					                    <p><a class="btn-link text-success" href="<?= $page_detail; ?>&id=<?= $row['forum_id']; ?>"><?= $page_detail; ?>&id=<?= $row['forum_id']; ?></a></p>

					                    <p class="text-sm"><?= substr($row['forum_description'],0,500); ?>...</p>
					
					                    <div class="pad-btm">
					                        <small><?= $row['jam']; ?> <i class="demo-pli-speech-bubble-5 icon-fw"></i><?= $comment; ?>, Author :</small> 
					                        <a class="label label-mint" href="#"><?= $row['account_email']; ?></a> 
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
            



				<?php break;
				case 'list':
				?>

                
                <!--Page content-->
                <!--===================================================-->
	                <div id="page-content">
	                	<div class="row">
						        <div class="col-xs-12">
						            <div class="panel">
						                <div class="panel-heading">
						                    <h3 class="panel-title">Forum General Data</h3>
						                </div>
						
						                <!--Data Table-->
						                <!--===================================================-->
						                <div class="panel-body">
						                    <div class="pad-btm form-inline">
						                        <div class="row">
						                            <div class="col-sm-6 table-toolbar-left">
						                            	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
						                            	<a href="<?= $page_input; ?>">
						                                <button class="btn btn-purple"><i class="demo-pli-add icon-fw"></i>Add</button></a> 
	              
						                            </div>
						                        </div>
						                    </div>
						                    <div class="table-responsive">
						                       <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
						                            <thead>
						                                <tr>
						                                    <th>No</th>
						                                    <th>Post Title</th>
						                                    <th>Comment</th>
						                                    <th>Create Date</th>
						                                    <th>Post By</th>
						                                    <th></th>
						                                </tr>
						                            </thead>
						                            <tbody>
						                            	<?php
						                            	$no=1;
						                            	$data=mysqli_query($connect, "SELECT * FROM forum_general 
						                            		LEFT JOIN account ON account.account_id=forum_general.account_id 
						                            		WHERE forum_general.account_id='$account_id'
						                            		order by forum_general.create_date desc");
						                            	while ($row=mysqli_fetch_array($data)) {
						                            		$comment=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM forum_comment where forum_id='$row[forum_id]'"));
						                            	?>
						                                <tr>
						                                    <td><?= $no; ?></td>
						                                    <td><?= $row['forum_title']; ?></td>
						                                    <td><?= $comment; ?></td>
						                                    <td><?= $row['create_date']; ?></td>
						                                    <td><?= $row['account_username']; ?></td>
						                                    <td>
						                                    	<button class="btn btn-danger" id="remove" value="<?= $row['forum_id']; ?>" onclick="data_remove(this.value);" title="Remove">
						                                    	<i class="fa fa-trash"></i>
						                                    	</button>


							                                    <a href="<?= $page_edit; ?>&id=<?= $row['forum_id']; ?>">
							                               		 <button class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button></a> 

							                               		 <a href="<?= $page_detail; ?>&id=<?= $row['forum_id']; ?>">
							                               		 <button class="btn btn-default" title="Edit"><i class="fa fa-eye"></i></button></a> 
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

                <?php	break;
                case 'input':  
                $back=$page_list;              
               	?>
               	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Add Forum General</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="input">
					                
					               <div class="panel">
								                <div class="panel-body">
								                	<div class="form-group">
										                <input type="text" placeholder="Title" class="form-control " name="forum_title" autofocus>
										            </div>

								                    <textarea id="demo-summernote" name="forum_description"></textarea> 
								                </div>								                
												<div class="panel-footer text-right">
								                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
								                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
								                </div>
								    </div>


					                
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
               		</div>
               	</div>

                <?php	break;
                case 'edit':
                $back=$page_list;
                $id 		=htmlspecialchars($_GET['id']);
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM forum_general where forum_id='$id' AND account_id='$account_id'"));
                ?>
                	<div id="page-content">
               		<div class="row">
               			<div class="col-sm-12">
					        <div class="panel">
					            <div class="panel-heading">
					                <h3 class="panel-title">Edit Forum General</h3>
					            </div>
					
					            <!--Horizontal Form-->
					            <!--===================================================-->
					            <form class="form-horizontal action" method="POST"  enctype="multipart/form-data">
					            	<input type="hidden" name="action" value="edit">
					            	<input type="hidden" name="id" value="<?= $id; ?>">
					                

					                			<div class="panel-body">
								                	<div class="form-group">
										                <input type="text" placeholder="Title" class="form-control " name="forum_title" value="<?= $row['forum_title']; ?>" autofocus>
										            </div>

								                    <textarea id="demo-summernote" name="forum_description"><?= htmlspecialchars($row['forum_description']); ?></textarea> 
								                </div>								                
												<div class="panel-footer text-right">
								                	<a href="<?= $back; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
								                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Save</button>
								                </div>
					            </form>
					            <!--===================================================-->
					            <!--End Horizontal Form-->
					
					        </div>
					    </div>
               		</div>
               	</div>


                <?php	break;                
                case 'detail':
                
                $id=htmlspecialchars(@$_GET['id']);
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT forum_general.*, account.account_photo, account.account_email, account.account_status FROM forum_general 
					            	LEFT JOIN account ON account.account_id=forum_general.account_id
					            	WHERE forum_id='$id'"));
				if (empty($row['forum_id'])){
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
					                            <?= $row['forum_title']; ?>
					                        </h1>
					                    </div>

					                    <a href="<?= $back2; ?>"><button class="btn btn-danger" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                    <br><br>
					
					                    <div class="row">
					                        <div class="col-sm-12 toolbar-left">
					
					                            <!--Sender Information-->
					                            <div class="media">
					                                <span class="media-left">
					                                <img src="assets/account_photo/<?= $row['account_photo']; ?>" class="img-circle img-sm" alt="Profile Picture">
					                            </span>
					                                <div class="media-body text-left">
					                                    <div class="text-bold">
					                                    	<?= $row['account_email']; ?> | <?= $row['account_status']; ?>
					                                    </div>
					                                    <small class="text-muted"><?= $row['create_date']; ?></small>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
					                    	<div class="col-lg-12">
					                    		<?= $row['forum_description']; ?>
					                    	</div>
					                    </div>

					                    <hr class="new-section-sm bord-no">
								            <p class="text-lg text-main text-bold text-uppercase">Leave a comment</p>
								            <form role="form" class="action"  method="post">
								            	<input type="hidden" name="id" value="<?= $id; ?>">
								            	<input type="hidden" name="action" value="comment">
								                <div class="row">
								                    <div class="col-md-6">
								
								                        <div class="form-group">
								                            <textarea class="form-control" name="forum_comment" rows="5" placeholder="Your comment" required></textarea>
								                        </div>
								                        <div class="form-group">
								                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-comment"></i> Submit comment</button>
								                        </div>
								
								                    </div>
								                </div>
								            </form>

					                    <hr class="new-section-sm">
							            <p class="text-lg text-main text-bold text-uppercase pad-btm">Comments</p>
							
							
										<?php
										$data=mysqli_query($connect,"SELECT account.*, forum_comment.*,
											 date_format(forum_comment.create_date, '%d %b %Y %H:%i %p') as jam
										 FROM forum_comment 
										 LEFT JOIN account ON account.account_id=forum_comment.account_id
							            		where forum_id='$id' order by forum_comment.create_date asc");
										while ($row=mysqli_fetch_array($data)) {
										?>
							            <!-- Comments -->
							            <!--===================================================-->
							            <div class="comments media-block">
							                <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="assets/account_photo/<?= $row['account_photo']; ?>"></a>
							                <div class="media-body">
							                    <div class="comment-header">
							                        <a href="#" class="media-heading box-inline text-main text-bold">
							                        	<?= $row['account_username']; ?></a> 

							                        <p class="text-muted text-sm"><?= $row['jam']; ?></p>
							                    </div>
							                    <p><?= $row['forum_comment']; ?></p>
							                </div>
							            </div>
							            <!--===================================================-->
							            <!-- End Comments -->
										<?php } ?>

					        </div>
					    </div>
					
					
					    
                </div>
                <!--===================================================-->
                <!--End page content-->
                

                <?php	break;
                } ?>
            </div>

            


