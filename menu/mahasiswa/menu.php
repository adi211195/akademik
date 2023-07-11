<?php
$account            =mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account where account_id='$account_id'"));
?>

<div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">

                                <!--Profile Widget-->
                                <!--================================-->
                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap text-center">
                                        <div class="pad-btm">
                                            <img class="img-circle img-md" src="assets/account_photo/<?= $account_photo; ?>" alt="Profile Picture">
                                        </div>
                                        <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                            <p class="mnp-name"><?= $account['account_username']; ?></p>
                                            <span class="mnp-desc"><?= $account['account_email']; ?></span>
                                        </a>
                                    </div>
                                    <div id="profile-nav" class="collapse list-group bg-trans">
                                        <a href="?p=view_profile" class="list-group-item">
                                            <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                                        </a>
                                        <a href="?p=edit_password" class="list-group-item">
                                            <i class="demo-pli-gear icon-lg icon-fw"></i> Edit Password
                                        </a>
                                        <a href="logout.php" class="list-group-item" onclick="return confirm('Are you sure you want to logout?');">
                                            <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                                        </a>
                                    </div>
                                </div>


                                <!--Shortcut buttons-->
                                <!--================================-->
                                <div id="mainnav-shortcut" class="hidden">
                                    <ul class="list-unstyled shortcut-wrap">
                                        <li class="col-xs-3" data-content="My Profile">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                                <i class="demo-pli-male"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Messages">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                                <i class="demo-pli-speech-bubble-3"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Activity">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                                <i class="demo-pli-thunder"></i>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="col-xs-3" data-content="Lock Screen">
                                            <a class="shortcut-grid" href="#">
                                                <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                                <i class="demo-pli-lock-2"></i>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!--================================-->
                                <!--End shortcut buttons-->


                                <ul id="mainnav-menu" class="list-group">
						
						            <!--Category name-->
						            <li class="list-header">Navigation</li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="?p=dashboard">
						                    <i class="demo-pli-home"></i>
						                    <span class="menu-title">
												Dashboard
											</span>
						                </a>
						            </li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">Kartu Rencana Studi</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="?p=krs">Data KRS</a></li>
											<li><a href="?p=schedules">Schedules</a></li>
											<li><a href="?p=questions">Questions and Answers</a></li>	
						                </ul>
						            </li>

						            <li>
						                <a href="?p=score">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">
												Score
											</span>
						                </a>
						            </li>

						            <li>
						                <a href="?p=ips">
						                    <i class="demo-pli-bar-chart"></i>
						                    <span class="menu-title">
												Index Prestasi Semester
											</span>
						                </a>
						            </li>

						            <li>
						                <a href="?p=ipk">
						                    <i class="demo-pli-bar-chart"></i>
						                    <span class="menu-title">
												Index Prestasi Komulatif
											</span>
						                </a>
						            </li>

						            <li>
						                <a href="?p=logbook">
						                    <i class="demo-pli-receipt-4"></i>
						                    <span class="menu-title">
												Logbook
											</span>
						                </a>
						            </li>

						            <li>
						                <a href="?p=student_skpi">
						                    <i class="demo-pli-receipt-4"></i>
						                    <span class="menu-title">
												SKPI
											</span>
						                </a>
						            </li>


						            <li>
						                <a href="?p=skripsi">
						                    <i class="demo-pli-receipt-4"></i>
						                    <span class="menu-title">
												Skripsi
											</span>
						                </a>
						            </li>

						            
						             <li>
						                <a href="#">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">Questionnaire</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                	<li><a href="?p=questionnaire_general">General</a></li>
						                    <li><a href="?p=questionnaire_lecturer">Lecturer</a></li>
											<li><a href="?p=questionnaire_academic">Academic</a></li>
											<li><a href="?p=questionnaire_advisor">Advisor</a></li>	
						                </ul>
						            </li>
						
						            
						            <li class="list-divider"></li>
						
						           
						
						            <!--Category name-->
						            <li class="list-header">More</li>

						            <li>
						                <a href="?p=administration">
						                    <i class="demo-pli-receipt-4"></i>
						                    <span class="menu-title">
												Administration
											</span>
						                </a>
						            </li>

						            <li>
						                <a href="?p=podcast">
						                    <i class="fa fa-video-camera"></i>
						                    <span class="menu-title">
												Podcast
											</span>
						                </a>
						            </li>

						            <li>
						                <a href="#">
						                    <i class="demo-pli-speech-bubble-7"></i>
						                    <span class="menu-title">
												Forum
											</span>
											<i class="arrow"></i>
						                </a>
						                <!--Submenu-->
						                <ul class="collapse">
						                	<li><a href="?p=forum_majors">Majors</a></li>
						                    <li><a href="?p=forum_general">General</a></li>
						                </ul>
						            </li>

						            <li>
						                <a href="#">
						                    <i class="demo-pli-bar-chart"></i>
						                    <span class="menu-title">
												Polling
											</span>
											<i class="arrow"></i>
						                </a>
						                <!--Submenu-->
						                <ul class="collapse">
						                	<li><a href="?p=polling_majors">Majors</a></li>
						                    <li><a href="?p=polling_general">General</a></li>
						                </ul>
						            </li>


						            
						
						            <!--Menu list item-->
						            <li>
						                <a href="?p=blog">
						                    <i class="demo-pli-speech-bubble-5"></i>
						                    <span class="menu-title">
												Blog Academic
											</span>
						                </a>
						            </li>

						            <li>
						                <a href="#">
						                    <i class="demo-pli-speech-bubble-7"></i>
						                    <span class="menu-title">
												Chat Academic
											</span>
											<i class="arrow"></i>
						                </a>
						                <!--Submenu-->
						                <ul class="collapse">
						                	<li><a href="?p=chat_personal">Personal</a></li>
						                    <li><a href="?p=chat_group">Group</a></li>
						                </ul>
						            </li>


						            <li>
						                <a href="?p=drive">
						                    <i class="demo-pli-data-settings"></i>
						                    <span class="menu-title">
												Drive Academic
											</span>
						                </a>
						            </li>


						            <li>
						                <a href="?p=elearning">
						                    <i class="demo-pli-information"></i>
						                    <span class="menu-title">
												E-learning
											</span>
						                </a>
						            </li>

						            <li>
						                <a href="?p=mail">
						                    <i class="demo-pli-mail"></i>
						                    <span class="menu-title">
												Mail Academic
											</span>
						                </a>
						            </li>

						            <li>
						                <a href="?p=calendar">
						                    <i class="demo-pli-calendar-4"></i>
						                    <span class="menu-title">
												Calendar Academic
											</span>
						                </a>
						            </li>


						            <li>
						                <a href="?p=support">
						                    <i class="demo-pli-support"></i>
						                    <span class="menu-title">
												Support
											</span>
						                </a>
						            </li>
						        

						        </ul>



                            </div>
                        </div>
                    </div>