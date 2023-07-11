			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Alumni Home</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Alumni Home</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                $page_edit="page.php?p=alumni_home&act=edit";
                $back="page.php?p=alumni_home";
                $action="pages/administrator/alumni_home/action.php";

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
					                    <h3 class="panel-title">Alumni Home Data</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
					                            	<button class="btn btn-primary" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</button>
              
					                            </div>
					                        </div>
					                    </div>
					                    <div class="table-responsive">
					                        <table class="table table-striped">
					                            <?php
					                            $alumni_home=mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_alumni_home"));
					                            ?>
					                            <tbody>
					                            	<tr>
					                            		<td><?= $alumni_home['alumni_home']; ?></td>			         
					                            	</tr>					                            	
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


                <!-- Modal -->
				<div id="edit" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <h4 class="modal-title">Edit Alumni Home</h4>
				      </div>
				      <form class="form-horizontal action" method="POST" enctype="multipart/form-data">
				      <input type="hidden" name="action" value="edit">
					  <input type="hidden" name="id" value="<?= $alumni_home['alumni_home_id']; ?>">
				      <div class="modal-body">
				      					<div class="form-group">
					                        <div class="col-sm-12">
					                           <textarea id="demo-summernote" name="alumni_home"><?= $alumni_home['alumni_home']; ?></textarea>
					                        </div>
					                    </div>

					                   

				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
				      </div>
				  	</form>
				    </div>

				  </div>
				</div>

                <?php 
                break;
                
                } ?>

            </div>



