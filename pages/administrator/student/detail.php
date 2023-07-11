<?php
$id 		=htmlspecialchars($_GET['id']);
$row=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account 
                	LEFT JOIN master_student ON master_student.account_id=account.account_id
                	INNER JOIN master_student_father ON master_student_father.student_nim=master_student.student_nim
                	INNER JOIN master_student_mother ON master_student_mother.student_nim=master_student.student_nim
                	INNER JOIN master_student_school ON master_student_school.student_nim=master_student.student_nim
                	INNER JOIN master_student_guardian ON master_student_guardian.student_nim=master_student.student_nim
                	where account.account_id='$id'"));
$back2=$back;
$back=$page_additional."&id=".$row['account_id'];
?>

<div id="page-content">
                        <div class="panel">
					        <div class="panel-body">
					            <div class="fixed-fluid">
					                <div class="fixed-md-200 pull-sm-left fixed-right-border">
					
					                    <!-- Simple profile -->
					                    <div class="text-center">
					                        <div class="pad-ver">
					                            <img src="img/profile-photos/1.png" class="img-lg img-circle" alt="Profile Picture">
					                        </div>
					                        <h4 class="text-lg text-overflow mar-no">Aaron Chavez</h4>
					                        <p class="text-sm text-muted">Digital Marketing Director</p>
					
					                        <div class="pad-ver btn-groups">
					                            <a href="#" class="btn btn-icon demo-pli-facebook icon-lg add-tooltip" data-original-title="Facebook" data-container="body"></a>
					                            <a href="#" class="btn btn-icon demo-pli-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"></a>
					                            <a href="#" class="btn btn-icon demo-pli-google-plus icon-lg add-tooltip" data-original-title="Google+" data-container="body"></a>
					                            <a href="#" class="btn btn-icon demo-pli-instagram icon-lg add-tooltip" data-original-title="Instagram" data-container="body"></a>
					                        </div>
					                        <button class="btn btn-block btn-success btn-lg">Follow</button>
					                    </div>
					                    <hr>
					
					                    <!-- Profile Details -->
					                    <p class="pad-ver text-main text-sm text-uppercase text-bold">About Me</p>
					                    <p><i class="demo-pli-map-marker-2 icon-lg icon-fw"></i> San Jose, CA</p>
					                    <p><a href="#" class="btn-link"><i class="demo-pli-internet icon-lg icon-fw"></i> http://www.themeon.net</a></p>
					                    <p><i class="demo-pli-old-telephone icon-lg icon-fw"></i>(123) 456 1234</p>
					                    <p class="text-sm text-center">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
					
					
					
					                </div>
					                <div class="fluid">
					                    <div class="text-right">
					                        <button class="btn btn-sm btn-primary">Edit Profile</button>
					                        <button class="btn btn-sm btn-success">Download CV</button>
					                    </div>
					
					                    <!-- Newsfeed Content -->
					                    <!--===================================================-->
					                    <div class="comments media-block">
					                        <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="img/profile-photos/11.png"></a>
					                        <div class="media-body">
					                            <div class="comment-header">
					                                <a href="#" class="media-heading box-inline text-main text-semibold">John Doe</a> Share a status of <a href="#" class="media-heading box-inline text-main text-semibold">Lucy Doe</a>
					                                <p class="text-muted text-sm"><i class="demo-pli-smartphone-3 icon-lg"></i> - From Mobile - 26 min ago</p>
					                            </div>
					                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt </p>
					                            <a class="btn btn-sm btn-default"><i class="icon-lg demo-pli-like"></i> Like </a>
					                            <a class="btn btn-sm btn-default"><i class="icon-lg demo-pli-heart-2"></i> Love</a>
					                        </div>
					                    </div>
					                    <!--===================================================-->
					                    <!-- End Newsfeed Content -->
					
					
					
					                    
					
					
					                    <!-- Newsfeed Content -->
					                    <!--===================================================-->
					                    <div class="comments media-block">
					                        <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="img/profile-photos/4.png"></a>
					                        <div class="media-body">
					                            <div class="comment-header">
					                                <a href="#" class="media-heading box-inline text-main text-semibold">
					                                <?= $row['father_nik']; ?> | <?= $row['father_name']; ?> </a> (Father)
					                                <p class="text-muted text-sm"><i class="fa fa-phone "></i> - 
					                                	<?= $row['father_phone']; ?> - <?= $row['father_handphone']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-mortar-board "></i> - 
					                                	<?= $row['father_education']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-calendar"></i> - 
					                                	<?= $row['father_date_birth']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-map"></i> - 
					                                	<?= $row['father_address']; ?> - <?= $row['father_districts']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-suitcase"></i> - 
					                                	<?= $row['father_profession']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-money"></i> - 
					                                	<?= $row['father_income']; ?></p>
					                            </div>
					                        </div>
					                    </div>
					                    <!--===================================================-->
					                    <!-- End Newsfeed Content -->


					
										<!-- Newsfeed Content -->
					                    <!--===================================================-->
					                    <div class="comments media-block">
					                        <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="img/profile-photos/9.png"></a>
					                        <div class="media-body">
					                            <div class="comment-header">
					                                <a href="#" class="media-heading box-inline text-main text-semibold">
					                                <?= $row['mother_nik']; ?> | <?= $row['mother_name']; ?> </a> (Mother)
					                                <p class="text-muted text-sm"><i class="fa fa-phone "></i> - 
					                                	<?= $row['mother_phone']; ?> - <?= $row['mother_handphone']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-mortar-board "></i> - 
					                                	<?= $row['mother_education']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-calendar"></i> - 
					                                	<?= $row['mother_date_birth']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-map"></i> - 
					                                	<?= $row['mother_address']; ?> - <?= $row['mother_districts']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-suitcase"></i> - 
					                                	<?= $row['mother_profession']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-money"></i> - 
					                                	<?= $row['mother_income']; ?></p>
					                            </div>
					                        </div>
					                    </div>
					                    <!--===================================================-->
					                    <!-- End Newsfeed Content -->


					                    <!-- Newsfeed Content -->
					                    <!--===================================================-->
					                    <div class="comments media-block">
					                        <a class="media-left" href="#"><img class="img-circle img-sm" alt="Profile Picture" src="img/profile-photos/3.png"></a>
					                        <div class="media-body">
					                            <div class="comment-header">
					                                <a href="#" class="media-heading box-inline text-main text-semibold">
					                                 <?= $row['guardian_name']; ?> </a> (Guardian)
					                                <p class="text-muted text-sm"><i class="fa fa-mortar-board "></i> - 
					                                	<?= $row['guardian_education']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-calendar"></i> - 
					                                	<?= $row['guardian_date_birth']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-suitcase"></i> - 
					                                	<?= $row['guardian_profession']; ?></p>
					                                <p class="text-muted text-sm"><i class="fa fa-money"></i> - 
					                                	<?= $row['guardian_income']; ?></p>
					                            </div>
					                        </div>
					                    </div>
					                    <!--===================================================-->
					                    <!-- End Newsfeed Content -->

					                </div>
					            </div>
					        </div>
					    </div>
					    
                </div>
