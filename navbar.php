<div class="navbar-content">
                    <ul class="nav navbar-top-links">

                        <!--Navigation toogle button-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="demo-pli-list-view"></i>
                            </a>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End Navigation toogle button-->



                        <!--Search-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li>
                            <div class="custom-search-form">
                                <label class="btn btn-trans" for="search-input" data-toggle="collapse" data-target="#nav-searchbox">
                                    <i class="demo-pli-magnifi-glass"></i>
                                </label>
                                <form method="POST" action="page.php">
                                    <div class="search-container collapse" id="nav-searchbox">
                                        <input id="search-input" type="text" name="p" class="form-control" placeholder="search pages...">
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End Search-->

                    </ul>

                    <?php if ($account_status!="Administrator") { ?>
                    <ul class="nav navbar-top-links">

                        <?php
                            $details=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM mail_account
                                where account_id='$account_id'"));

                            $mail=$details['mail_account'];

                            $check=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM mail_academic_sent
                                 where mail_sent='$mail' AND 
                                 mail_view='1' AND
                                 mail_status='Sent'"));


                        ?>

                        <!--Notification dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <i class="demo-pli-mail"></i>
                            <?php if ($check>0) { ?>
                                <span class="badge badge-header badge-danger"></span>
                            <?php } ?>
                            </a>

                            
                            <!--Notification dropdown menu-->
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <div class="nano scrollable">
                                    <div class="nano-content">
                                        <ul class="head-list">
                                            
                                            <?php
                                             $data=mysqli_query($connect,"SELECT * FROM mail_academic_sent
                                             where mail_sent='$mail' AND 
                                             mail_view='1' AND
                                             mail_status='Sent' limit 4");
                                            while ($row=mysqli_fetch_array($data)) { 
                                                $account=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM mail_account
                                                    LEFT JOIN account ON account.account_id=mail_account.account_id
                                                    where mail_account.mail_account='$row[mail_account]'"));
                                                
                                                if (empty($row['mail_reply'])) {
                                                        $mail_id=$row['mail_id'];
                                                } else {
                                                        $mail_id=$row['mail_reply'];
                                                }

                                                $page_detail="?p=mail&act=detail&status=sent&view=$mail_id";
                                            ?>

                                            <li>
                                                <a class="media" href="<?= $page_detail; ?>">
                                                    <div class="media-left">
                                                        <img class="img-circle img-sm" alt="Profile Picture" src="assets/account_photo/<?= $account['account_photo']; ?>">
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="mar-no text-nowrap text-main text-semibold"><?= $row['mail_account']; ?></p>
                                                        <small><?= $row['create_date']; ?></small>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php } ?>


                                        </ul>
                                    </div>
                                </div>

                                <!--Dropdown footer-->
                                <div class="pad-all bord-top">
                                    <a href="?p=mail" class="btn-link text-main box-block">
                                        <i class="pci-chevron chevron-right pull-right"></i>Show All Notifications
                                    </a>
                                </div>
                            </div>
                        </li>


                        <?php
                            $amount=mysqli_fetch_array(mysqli_query($connect,"SELECT sum(drive_size) as size FROM drive_academic
                             where account_id='$account_id'"));
                            $check=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM drive_shared
                                                INNER JOIN account ON account.account_id=drive_shared.account_id
                                                WHERE account_send='$account_id'
                                                AND view_shared='1'"));

                            $persentase=round($amount['size']/10000,0,2); 

                        ?>

                        <!--Notification dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <i class="demo-pli-data-settings"></i>
                            <?php if ($check>0) { ?>
                                <span class="badge badge-header badge-danger"></span>
                            <?php } ?>
                            </a>

                            
                            <!--Notification dropdown menu-->
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <div class="nano scrollable">
                                    <div class="nano-content">
                                        <ul class="head-list">
                                            <li>
                                                <a href="#" class="media add-tooltip" data-title="Used space : <?= $persentase; ?>%" data-container="body" data-placement="bottom">
                                                    <div class="media-left">
                                                        <i class="demo-pli-data-settings icon-2x text-main"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="text-nowrap text-main text-semibold">Drive Academic</p>
                                                        <div class="progress progress-sm mar-no">
                                                            <div style="width: <?= $persentase; ?>%;" class="progress-bar progress-bar-danger">
                                                                <span class="sr-only"><?= $persentase; ?>% Complete</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            
                                            <?php
                                             $data=mysqli_query($connect,"SELECT * FROM drive_shared
                                                INNER JOIN account ON account.account_id=drive_shared.account_id
                                                WHERE account_send='$account_id'
                                                AND view_shared='1' limit 4");
                                            while ($row=mysqli_fetch_array($data)) { 
                                                $page_detail="page.php?p=drive&act=folder&id=".$row['account_status'];
                                            ?>

                                            <li>
                                                <a class="media" href="<?= $page_detail; ?>">
                                                    <div class="media-left">
                                                        <img class="img-circle img-sm" alt="Profile Picture" src="assets/account_photo/<?= $row['account_photo']; ?>">
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="mar-no text-nowrap text-main text-semibold"><?= $row['account_username']; ?></p>
                                                        <small><?= $row['create_date']; ?></small>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php } ?>


                                        </ul>
                                    </div>
                                </div>

                                <!--Dropdown footer-->
                                <div class="pad-all bord-top">
                                    <a href="?p=drive" class="btn-link text-main box-block">
                                        <i class="pci-chevron chevron-right pull-right"></i>Show All Notifications
                                    </a>
                                </div>
                            </div>
                        </li>

                        <?php
                        $check=mysqli_num_rows(mysqli_query($connect,"SELECT master_blog.* FROM master_blog
                                            LEFT JOIN view_blog ON view_blog.blog_id!=master_blog.blog_id
                                            WHERE account_id!='$account_id'"));
                        ?>

                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <i class="demo-pli-speech-bubble-5"></i>
                            <?php if ($check>0) { ?>
                                <span class="badge badge-header badge-danger"></span>
                            <?php } ?>
                            </a>


                            <!--Notification dropdown menu-->
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                <div class="nano scrollable">
                                    <div class="nano-content">
                                        <ul class="head-list">
                                         
                                         <?php
                                         $data=mysqli_query($connect,"SELECT master_blog.* FROM master_blog, view_blog                                            
                                            WHERE view_blog.account_id!='$account_id' AND
                                                  view_blog.blog_id!=master_blog.blog_id limit 4");
                                        while ($row=mysqli_fetch_array($data)) { 
                                            $page_detail="page.php?p=blog&act=detail&id=".$row['blog_id'];
                                            ?>

                                            <li>
                                                <a class="media" href="<?= $page_detail; ?>">
                                                    <div class="media-left">
                                                        <i class="demo-pli-support icon-2x"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="mar-no text-nowrap text-main text-semibold"><?= $row['blog_title']; ?></p>
                                                        <small><?= $row['create_date']; ?></small>
                                                    </div>
                                                </a>
                                            </li>

                                        <?php } ?>
                                            
                                        </ul>
                                    </div>
                                </div>

                                <!--Dropdown footer-->
                                <div class="pad-all bord-top">
                                    <a href="?p=blog" class="btn-link text-main box-block">
                                        <i class="pci-chevron chevron-right pull-right"></i>Show All Notifications
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End notifications dropdown-->


                    </ul>
                    <?php } else { ?>
                        <ul class="nav navbar-top-links">
                        </ul>
                    <?php } ?>
                </div>