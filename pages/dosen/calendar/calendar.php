			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Calendar Academic</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Calendar Academic</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php

               

                $page_input="page.php?p=calendar&act=input";
                $page_detail="page.php?p=calendar&act=detail";
                $back="page.php?p=calendar";
                $action="pages/dosen/calendar/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					
					    <div class="panel">
					        <div class="panel-body">
					            <div class="fixed-fluid">
					                <div class="fixed-sm-200 pull-sm-left fixed-right-border">
					                    
					                    <!-- ============================================ -->
					                    <p class="text-muted text-sm text-uppercase">List Calendar Active</p>
					                    <div>
					                    	<?php
					                    	$no=1;
					                    	$start= date('Y-m-d');
											$data=mysqli_query($connect,"SELECT * FROM master_calendar where calendar_end>='$start'");
											while ($row=mysqli_fetch_array($data)) {
											?>
											<a href="<?= $back; ?>&date=<?= $row['calendar_start']; ?>">
					                        <div class="fc-event fc-list" data-class="<?= $row['calendar_color']; ?>"><?= $row['calendar_title']; ?></div>
					                        </a>
					                        <?php $no++; } ?>

					                        <?php if ($no==1) { ?>

					                        <p class="text-center">
					                        	<br><br><br>
					                        	<i class="fa fa-calendar fa-5x"></i> <br>
					                        	Data is still empty
					                        </p>			                        	

					                        <?php } ?>
					                        
					                    </div>
					                    <!-- ============================================ -->
					                </div>
					                <div class="fluid">
					                    <!-- Calendar placeholder-->
					                    <!-- ============================================ -->
					                    <div id='demo-calendar'></div>
					                    <!-- ============================================ -->
					                </div>
					            </div>
					        </div>
					    </div>
					    
                </div>
                <!--===================================================-->
                <!--End page content-->

                <?php 
                break;
                
                } ?>

            </div>



