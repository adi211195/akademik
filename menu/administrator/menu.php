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
                                            <img class="img-circle img-md" src="assets/account_photo/<?= $account['account_photo']; ?>" alt="Profile Picture">
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
						                    <span class="menu-title">Master Data</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="?p=college">College</a></li>
											<li><a href="?p=majors">Majors</a></li>
											<li><a href="?p=school_year">School Year</a></li>
											<li><a href="?p=semester">Semester</a></li>
											<li><a href="?p=generation">Generation</a></li>
											<li><a href="?p=courses">Courses</a></li>
											<li><a href="?p=class">Class</a></li>
						                </ul>
						            </li>

						            <li>
						                <a href="#">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">Master Curriculum</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
											<li><a href="?p=curriculum_types">Curriculum Types</a></li>	
											<li><a href="?p=curriculum">Curriculum & Schedule</a></li>
											<li><a href="?p=schedule">Schedule Package</a></li>
						                </ul>
						            </li>

						            <li>
						                <a href="#">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">Master Alumni</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="?p=alumni">Alumni</a></li>
											<li><a href="?p=alumni_home">Home Alumni</a></li>
											<li><a href="?p=alumni_links">Related Links</a></li>
											<li><a href="?p=alumni_campus">Campus Info</a></li>
											<li><a href="?p=alumni_company">Company</a></li>	
											<li><a href="?p=alumni_agenda">Alumni Agenda</a></li>
											<li><a href="?p=alumni_job_vacancy">Job Vacancy</a></li>
											<li><a href="?p=alumni_job_vacancies_web">Job Vacancies Web</a></li>
						                </ul>
						            </li>

						            <li>
						                <a href="#">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">Master of Cooperation</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="?p=coo_education">Education</a></li>
											<li><a href="?p=coo_community_service">Community Service</a></li>
											<li><a href="?p=coo_research">Research</a></li>
						                </ul>
						            </li>

						            <li>
						                <a href="#">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">Master KRS</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="?p=krs_personal">KRS Personal</a></li>
											<li><a href="?p=krs_package">KRS Package</a></li>	
						                </ul>
						            </li>
						           

						            <li>
						                <a href="#">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">Questionnaire</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="?p=category_questionnaire">Category</a></li>
											<li><a href="?p=academic_questionnaire">Academic</a></li>
											<li><a href="?p=lecturer_questionnaire">Lecturer</a></li>
											<li><a href="?p=advisor_questionnaire">Advisor</a></li>
											<li><a href="?p=general_questionnaire">General</a></li>
						                </ul>
						            </li>


						            <li>
						                <a href="#">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">Master User</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="?p=user">User</a></li>
											<li><a href="#">Student <i class="arrow"></i></a>

                                                <!--Submenu-->
                                                <ul class="collapse">
                                                    <li><a href="?p=student">Student Data</a></li>
                                                    <li><a href="?p=student_access">Access</a></li>
                                                    <li><a href="?p=student_skpi">SKPI</a></li>
                                                    <li><a href="?p=student_open_krs">Open KRS</a></li>
                                                </ul></li>

											<li><a href="?p=lecturer">Lecturer</a></li>
						                </ul>
						            </li>

						            <li>
						                <a href="?p=pdpt">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">PDPT</span>
						                </a>
						            </li>

						           

						            <li>
						                <a href="#">
						                    <i class="demo-pli-split-vertical-2"></i>
						                    <span class="menu-title">Lecturer Salary</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="?p=salary_another">Another Salary</a></li>
						                    <li><a href="?p=salary_teaching">Teaching Salary</a></li>
						                    
						                </ul>
						            </li>

						             <li>
						                <a href="#">
						                    <i class="demo-pli-printer"></i>
						                    <span class="menu-title">Report</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                	<li><a href="?p=attendance">Attendance</a></li>
											<li><a href="?p=score">Score</a></li>
						                    <li><a href="?p=ips">IPS</a></li>
											<li><a href="?p=ipk">IPK</a></li>
											<li><a href="?p=ijasah">Ijasah</a></li>
											<li><a href="?p=transkrip">Transkrip</a></li>
											<li><a href="?p=logbook">Logbook</a></li>
											<li><a href="#">Lecturer Salary <i class="arrow"></i></a>

                                                <!--Submenu-->
                                                <ul class="collapse">
                                                    <li><a href="?p=report_salary_another">Another Salary Report</a></li>
                                                    <li><a href="?p=report_salary_teaching">Teaching Salary Report</a></li>
                                                </ul></li>

                                            <li><a href="#">Questionnaire <i class="arrow"></i></a>

                                                <!--Submenu-->
                                                <ul class="collapse">
                                                   <li><a href="?p=report_academic_questionnaire">Academic</a></li>
												    <li><a href="?p=report_lecturer_questionnaire">Lecturer</a></li>
													<li><a href="?p=report_advisor_questionnaire">Advisor</a></li>
													<li><a href="?p=report_general_questionnaire">General</a></li>
                                                </ul></li>
						                </ul>
						            </li>
						            

						            <li>
						                <a href="#">
						                    <i class="demo-pli-gear"></i>
						                    <span class="menu-title">Settings</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                	<li><a href="?p=open_questionnaire">Open Questionnaire</a></li>
						                	<li><a href="?p=open_krs">Open KRS</a></li>
						                    <li><a href="?p=range_sks">Range SKS</a></li>
											<li><a href="?p=range_ipk">Range IPK</a></li>
						                </ul>
						            </li>
						
						            
						            <li class="list-divider"></li>
						
						           
						
						            <!--Category name-->
						            <li class="list-header">More</li>

						            <li>
						                <a href="?p=skripsi">
						                    <i class="demo-pli-receipt-4"></i>
						                    <span class="menu-title">
												Skripsi
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
						                	<li><a href="#">Personal <i class="arrow"></i></a>

                                                <!--Submenu-->
                                                <ul class="collapse">
                                                    <li><a href="?p=chat_personal_student">Student</a></li>
                                                    <li><a href="?p=chat_personal_lecturer">Lecturer</a></li>
                                                </ul></li>

						                    <li><a href="?p=chat_group">Group</a></li>
						                </ul>
						            </li>


						            <li>
						                <a href="#">
						                    <i class="demo-pli-data-settings"></i>
						                    <span class="menu-title">
												Drive Academic
											</span>
											<i class="arrow"></i>
						                </a>
						                <!--Submenu-->
						                <ul class="collapse">
						                	<li><a href="?p=drive_student">Student</a></li>
						                    <li><a href="?p=drive_lecturer">Lecturer</a></li>
						                </ul>
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
						                <a href="#">
						                    <i class="demo-pli-mail"></i>
						                    <span class="menu-title">
												Mail Academic
											<i class="arrow"></i>
						                </a>
						                <!--Submenu-->
						                <ul class="collapse">
						                	<li><a href="?p=mail_student">Student</a></li>
						                    <li><a href="?p=mail_lecturer">Lecturer</a></li>
						                </ul>
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
						                <a href="#">
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