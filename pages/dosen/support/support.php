<!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
               <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Support</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Support</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>

                <?php
                $back="page.php?p=support";
                $action="pages/dosen/support/action.php";
                ?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <!-- Contact Panel -->
					    <!---------------------------------->
					    <div class="panel">
					        <div class="panel-body">
					
					            <h3>Leave us a Message</h3>
					            <p>please send a message to the admin if there are problems</p>
					            <div class="row">
					                <div class="col-sm-6">
					                    <form class="action" method="post">	
					                    <input type="hidden" name="action" value="input">				                        
					                        <div class="form-group">
					                            <input class="form-control" name="support_email" type="email" placeholder="Your email" required>
					                        </div>
					                        <div class="form-group">
					                            <input class="form-control" name="support_subject" type="text" placeholder="Subject" required>
					                        </div>					                        
					                        <div class="form-group">
					                            <textarea class="form-control" name="support_message" rows="10" placeholder="Your message" required></textarea>
					                        </div>
					                        <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
					                    </form>
					                </div>
					                <div class="col-sm-6">
					                    <div class="mar-all">
					                        <div class="media">
					                            <div class="media-left">
					                                <i class="icon-lg icon-fw demo-pli-map-marker-2"></i>
					                            </div>
					                            <div class="media-body">
					                                <address>
					                                    <strong class="text-main"> <?= $profile['profile_title']; ?></strong><br>
					                                   <?= $profile['profile_address']; ?>
					                                </address>
					                            </div>
					                        </div>
					
					                        <p><i class="icon-lg icon-fw demo-pli-old-telephone"></i> <span>
					                        	<?= $profile['profile_telp']; ?></span></p>
					                        <div class="pad-btm">
					                            <i class="icon-lg icon-fw demo-pli-mail"></i>
					                            <span><?= $profile['profile_email']; ?></span>
					                        </div>
					                        <div class="pad-ver">
					                            <a href="#" class="mar-rgt box-inline demo-pli-facebook icon-lg add-tooltip" data-original-title="Facebook" data-container="body"></a>
					                            <a href="#" class="mar-rgt box-inline demo-pli-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"></a>
					                            <a href="#" class="mar-rgt box-inline demo-pli-instagram icon-lg add-tooltip" data-original-title="Instagram" data-container="body"></a>
					                        </div>
					                        <div>
					                            <?= $profile['profile_maps']; ?>
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					    </div>
					    <!---------------------------------->
					
					
					    
                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->