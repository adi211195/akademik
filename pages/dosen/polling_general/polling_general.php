			


                <?php

                $action="pages/dosen/polling_general/action.php";
                $page_detail="page.php?p=polling_general&act=detail";
                $page_list="page.php?p=polling_general&act=list";
                $page_input="page.php?p=polling_general&act=input";
                $page_edit="page.php?p=polling_general&act=edit";
                $back="page.php?p=polling_general";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				?>

				<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Polling General</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Polling General</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                    <hr class="bord-no">
				    <div class="row pad-ver">
				        <form action="" method="GET" class="col-xs-12 col-sm-10 col-sm-offset-1 pad-hor">
				        	<input type="hidden" name="p" value="polling_general">
				            <div class="input-group mar-btm">				            	
				                 
				                 <input type="text" name="search" placeholder="search" class="form-control input-lg">
				                 <span class="input-group-btn">
				                     <button class="btn btn-warning btn-lg" type="submit">Search</button>
				                 </span>
				            </div>
				        </form>
				    </div>

                </div>
                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">
					        <div class="panel-body">
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
					        	$where="WHERE polling_title like '%$search%'";

					        	$data=mysqli_query($connect, "SELECT * FROM polling_general $where
					            	order by create_date desc");
								                      
								$jumlah_data = mysqli_num_rows($data);
								$total_page = ceil($jumlah_data / $batas);

					        	?>
					            <div class="pad-hor mar-top">
					                <h2 class="text-thin mar-no"><?= $jumlah_data; ?> results found for: <i class="text-info text-normal">"<?= $search; ?>"</i></h2>
					            </div>
					
					            <hr>

					        	<?php } else {
					        		$filter="";
					        		$where="";
					        		$data=mysqli_query($connect, "SELECT * FROM polling_general $where
					            	order by create_date desc");
								                      
									$jumlah_data = mysqli_num_rows($data);
									$total_page = ceil($jumlah_data / $batas);

					        	} ?>
					
					            <ul class="list-group bord-no">
					            <?php
					            
					            
					            $nomor = $page_awal+1;

					            $data=mysqli_query($connect, "SELECT * FROM polling_general 
					            	LEFT JOIN account ON account.account_id=polling_general.account_id
					            	 $where
					            	order by polling_general.create_date desc limit $page_awal, $batas");
					            while ($row=mysqli_fetch_array($data)) {

					            ?>  

					                <li class="list-group-item list-item-lg">
					                    <div class="media-heading">
					                        <a class="btn-link text-lg text-semibold" href="<?= $page_detail; ?>&id=<?= $row['polling_id']; ?>"><?= $row['polling_title']; ?></a>
					                    </div>
					                    <p><a class="btn-link text-success" href="<?= $page_detail; ?>&id=<?= $row['polling_id']; ?>"><?= $page_detail; ?>&id=<?= $row['polling_id']; ?></a></p>

					                    <p class="text-sm"><?= substr($row['polling_description'],0,500); ?>...</p>
					                    <p class="text-sm"><i class="fa fa-calendar"></i> From <?= substr($row['polling_start_date'], 0,10); ?> to  <?= substr($row['polling_end_date'], 0,10); ?></p>
					
					                    <div class="pad-btm">
					                        <small><?= $row['create_date']; ?>, Author :</small> 
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
                </div>



				<?php break;
				
                case 'detail':
                
                $id=htmlspecialchars(@$_GET['id']);
                $row=mysqli_fetch_array(mysqli_query($connect,"SELECT polling_general.*, account.account_photo, account.account_email, account.account_status FROM polling_general 
					            	LEFT JOIN account ON account.account_id=polling_general.account_id
					            	WHERE polling_id='$id'"));
				if (empty($row['polling_id'])){
					header("location:$back");
				}

				$back2=$back;
                $back=$page_detail."&id=".$id;

                $voters=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM polling_answer where polling_id='$id'"));
                $ket_voters="Number of Voters : ".$voters;

                $date=date('Y-m-d H:i:s');
				$start_date=$row['polling_start_date'];
				$end_date=$row['polling_end_date'];

				if ($start_date>=$date) {
					$countdown=$start_date;
					$ket="Poll will be open";					
				} else {
					$countdown=$end_date;
					$ket="Poll will be closed";
				}
				
				?>
				<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Polling General</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Polling General</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->   

                </div>
                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    
					    <div class="panel">
					        <div class="panel-body">
					        	
					        	<!-- VIEW MESSAGE -->
					                    <!--===================================================-->
						
					                    <div class="mar-btm pad-btm bord-btm">
					                        <h1 class="page-header text-overflow">
					                            <?= $row['polling_title']; ?>
					                        </h1>
					                    </div>

					                    <a href="<?= $back2; ?>"><button class="btn btn-warning" type="button"><i class="fa fa-undo"></i> Back</button></a>
					                    <br><br>
					
					                    <div class="row">
					                        <div class="col-sm-7 toolbar-left">
					
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
					                        <div class="col-sm-5">
					                        	<p align="center"><?= $ket; ?></p>
					                        	<div id="demo" style="text-align: center; font-size: 50px; margin-top: 0px;"></div>
					                        </div>
					                    </div>
					                    <div class="row">
					                    	<div class="col-lg-12">
					                    		<?= $row['polling_description']; ?>
					                    	</div>

					                    	<div class="col-lg-12">
					                    		<div class="table-responsive">
					                    			<p>Choice : </p>
					                    			<div class="btn-group" id="choice" style="width: 100%;">
					                    			<table class="table">
					                    				<?php
					                    				@$answer=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM polling_answer WHERE polling_id='$id' AND account_id='$account_id'"));

					                    				$data=mysqli_query($connect,"SELECT * FROM polling_choice where polling_id='$id'");
					                    				while ($row2=mysqli_fetch_array($data)) {

					                    					if (@$answer['polling_choice_id']==$row2['polling_choice_id']) {
					                    						$choice="btn-danger";
					                    					} else {
					                    						$choice="";
					                    					}

					                    					@$pol_voters=mysqli_num_rows(mysqli_query($connect,"SELECT * FROM polling_answer 
					                    						where polling_id='$id' AND polling_choice_id='$row2[polling_choice_id]'"));
					                    					@$persentase=round(($pol_voters/$voters)*100);

					                    				if ($date<= $row['polling_end_date'] AND $date>=$row['polling_start_date']) {
					                    				?>
						                    				<tr>
						                    					<td width="10%"><button class="btn btn-lg <?= $choice; ?>" value="<?= $row2['polling_choice_id']; ?>" onclick="data_choice(this.value,'<?= $id; ?>','<?= $account_id; ?>');">
					                            					<i class="fa fa-check-square-o fa-lg"></i></button></td>

						                    					<td><?= $row2['polling_choice']; ?></td>
						                    				</tr>

						                    			<?php } elseif ($date<=$row['polling_start_date']) { ?>
						                    				<tr>
						                    					<td><?= $row2['polling_choice']; ?></td>
						                    				</tr>
						                    			<?php } else { ?>

						                    				<tr>
						                    					<td><?= $row2['polling_choice']; ?> 
						                    					<div class="progress progress-lg"><div style="width: <?= $persentase; ?>%;" class="progress-bar progress-bar-info"><?= $persentase; ?>%</div></div>

						                    					</td>
						                    				</tr>

						                    			<?php }}  ?>
					                    			</table>

					                    			<p><b><?= $ket_voters; ?></b></p>

					                    			</div>
					                    		</div>
					                    		
					                    	</div>
					                    </div>

					                    <script>
										// Add active class to the current button (highlight it)
										var header = document.getElementById("choice");
										var btns = header.getElementsByClassName("btn");
										for (var i = 0; i < btns.length; i++) {
										  btns[i].addEventListener("click", function() {
										  $('.btn').removeClass('btn-danger');
										  this.className += " btn-danger";
										  });
										}
										</script>


										<?php if ($date<= $row['polling_end_date']) { ?>
										<script>
										// Set the date we're counting down to
										var countDownDate = new Date("<?= $countdown; ?>").getTime();

										// Update the count down every 1 second
										var x = setInterval(function() {

										  // Get today's date and time
										  var now = new Date().getTime();

										  // Find the distance between now and the count down date
										  var distance = countDownDate - now;

										  // Time calculations for days, hours, minutes and seconds
										  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
										  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
										  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
										  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

										  // Display the result in the element with id="demo"
										  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
										  + minutes + "m " + seconds + "s ";

										  // If the count down is finished, write some text
										  if (distance < 0) {
										    clearInterval(x);
										    document.getElementById("demo").innerHTML = "EXPIRED";
										    window.location="<?= $back; ?>";
										  }
										}, 1000);
										</script>
										<?php } else { ?>
										<script>
											document.getElementById("demo").innerHTML = "EXPIRED";
										</script>
										<?php } ?>

					                    

					        </div>
					    </div>
					
					
					    
                </div>
                <!--===================================================-->
                <!--End page content-->
                 </div>

                <?php	break;
                } ?>

            


