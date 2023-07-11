			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Blog Academic</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Blog Academic</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php

               

                $page_input="page.php?p=blog&act=input";
                $back="page.php?p=blog";
                $action="pages/mahasiswa/blog/action.php";

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
							        	<input type="hidden" name="p" value="blog">
							            <div class="input-group mar-btm">							                 
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
					        	$where="WHERE blog_title like '%$search%'";

					        	$data=mysqli_query($connect, "SELECT * FROM master_blog $where
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
					        		$data=mysqli_query($connect, "SELECT * FROM master_blog $where
					            	order by create_date desc");
								                      
									$jumlah_data = mysqli_num_rows($data);
									$total_page = ceil($jumlah_data / $batas);

					        	} ?>
					
					            <ul class="list-group bord-no">
					            <?php
					            
					            
					            $nomor = $page_awal+1;

					            $data=mysqli_query($connect, "SELECT master_blog.*, date_format(create_date, '%d %b %Y %H:%i %p') as jam FROM master_blog  where blog_status='Publish' order by create_date desc limit $page_awal, $batas");
					            while ($row=mysqli_fetch_array($data)) {

					            $comment=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_blog_comment 
					            		where blog_id='$row[blog_id]'"));

					            ?>  
					            	<li class="list-group-item list-item-lg media">
					                    <div class="pull-left">
					                        <img class="img-lg" alt="Image" src="assets/blog_image/<?= $row['blog_image']; ?>">
					                    </div>
					                    <div class="media-body">
					                        <div class="media-heading mar-no">
					                            <a class="btn-link text-lg text-semibold" href="<?= $page_detail; ?>&id=<?= $row['blog_id']; ?>"><?= bold($row['blog_title'],$search); ?></a>
					                        </div>
					                        <p><a class="btn-link text-success" href="<?= $page_detail; ?>&id=<?= $row['blog_id']; ?>"><?= $page_detail; ?>&id=<?= $row['blog_id']; ?></a></p>
					                        <p class="text-sm"><?= substr($row['blog_post'],0,500); ?>...</p>
					                       <div class="blog-footer">
						                        <div class="media-left" style="width: 50%;">
						                            <?= $row['jam']; ?> <i class="demo-pli-speech-bubble-5 icon-fw"></i><?= $comment; ?>
						                        </div>
						                    </div>
					                    </div>
					                </li>
					                
					            <?php } ?>
					                

					            </ul>
					            <hr class="hr-wide">
								
								Showing <?= $page; ?> to <?= $page*$batas; ?> of <?= $jumlah_data; ?> entries

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
               

                <?php 
                break;
                case 'detail':
                $id 		=htmlspecialchars($_GET['id']);
                $blog=mysqli_fetch_array(mysqli_query($connect, "SELECT master_blog.*, date_format(create_date, '%d %b %Y %H:%i %p') as jam FROM master_blog  
                	where blog_status='Publish' 
                	AND blog_id='$id'
                	order by create_date desc"));
                $comment=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM master_blog_comment 
					            		where blog_id='$id'"));

                $check=mysqli_num_rows(mysqli_query($connect, "SELECT * FROM view_blog where blog_id='$id' AND account_id='$account_id'"));
                $create_date=date('Y-m-d H:i:s');
                if ($check==0) {
                	$genrate_id = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					// Genrate ID
					$genid=substr(str_shuffle($genrate_id), 0, 14);

					$save=mysqli_query($connect, "INSERT INTO view_blog (view_id,
			    			account_id,
			    			blog_id,
			    			create_date)
			    			VALUES ('$genid',
			    					'$account_id',
			    					'$id',
			    					'$create_date')");
                }

                ?>

                	<!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel blog blog-details">
					        <div class="panel-body">
					            <div class="blog-title media-block">
					                <div class="media-right textright">
					                    <a href="<?= $back; ?>" class="btn btn-icon fa fa-undo icon-lg add-tooltip" data-original-title="Back" data-container="body"> Back </a>
					                </div>
					                <div class="media-body">
					                    <a href="#" class="btn-link">
					                        <h1><?= $blog['blog_title']; ?></h1>
					                    </a>
					                </div>
					            </div>
					            
					            <div class="blog-content">

					                <div class="blog-body">
					                <div class="row">
					                	<div class="col-md-6"><?= $blog['blog_post']; ?></div>
										<div class="col-md-6"><img src="assets/blog_image/<?= $blog['blog_image']; ?>" width="100%"/></div>
					                </div>	
					                </div>
					            </div>

					            
					            <div class="blog-footer">
					                <div class="media-left">
					                    <?= $blog['jam']; ?>
					                    <small>Posted by : <a href="#" class="btn-link">Admin</a></small>
					                </div>
					                <div class="media-body text-right">
					                    <i class="demo-pli-speech-bubble-5 icon-fw"></i><?= $comment; ?>
					                </div>
					            </div>
					
					
								<?php 
								$back="page.php?p=blog&act=detail&id=".$blog['blog_id'];
								?>


					            <!-- Comment form -->
					            <!--===================================================-->
					            <?php if ($blog['blog_comment']=="Allow") { ?>
					            <hr class="new-section-sm bord-no">
					            <p class="text-lg text-main text-bold text-uppercase">Leave a comment</p>
					            <form role="form" class="action"  method="post">
					            	<input type="hidden" name="blog_id" value="<?= $id; ?>">
					            	<input type="hidden" name="action" value="comment">
					                <div class="row">
					                    <div class="col-md-6">
					
					                        <div class="form-group">
					                            <textarea class="form-control" name="comment" rows="5" placeholder="Your comment" required></textarea>
					                        </div>
					                        <div class="form-group">
					                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-comment"></i> Submit comment</button>
					                        </div>
					
					                    </div>
					                </div>
					            </form>
					        	<?php } ?>
					            <!--===================================================-->
					            <!-- End Comment form -->
					
					
					
					
					            <hr class="new-section-sm">
					            <p class="text-lg text-main text-bold text-uppercase pad-btm">Comments</p>
					
					
								<?php
								$data=mysqli_query($connect,"SELECT account.*, master_blog_comment.*,
									 date_format(master_blog_comment.create_date, '%d %b %Y %H:%i %p') as jam
								 FROM master_blog_comment 
								 LEFT JOIN account ON account.account_id=master_blog_comment.account_id
					            		where blog_id='$id' order by master_blog_comment.create_date asc");
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
					                    <p><?= $row['comment']; ?></p>
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


                <?php
                	break;
                
                } ?>

            </div>



