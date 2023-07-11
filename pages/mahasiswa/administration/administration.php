			<div id="content-container">
                <div id="page-head">
                    
                    
                    <!--Page Title-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <div id="page-title">
                        <h1 class="page-header text-overflow">Administration</h1>
                    </div>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End page title-->


                    <!--Breadcrumb-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <ol class="breadcrumb">
					<li><a href="#"><i class="demo-pli-home"></i></a></li>
					<li><a href="page.php">Dashboard</a></li>
					<li class="active">Administration</li>
                    </ol>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End breadcrumb-->

                </div>


                <?php
                

                $page_input="page.php?p=ipk&act=input";
                $page_edit="page.php?p=ipk&act=edit";
                $back="page.php?p=ipk";
                $page_print="pages/mahasiswa/ipk/report_pdf.php";
                $action="pages/mahasiswa/ipk/action.php";

                $act=htmlspecialchars(@$_GET['act']);
                switch ($act) {
	
				default:
				?>

                
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					
					   <div class="row">

							<div class="col-md-4 ">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-file icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Surat Keterangan Kuliah</p>
					                    <a href="">
					                    <button class="btn btn-primary mar-ver"><i class="fa fa-download"></i> Download </button></a>
					                </div>
					            </div>
					        </div>
					        <div class="col-md-4 ">
					            <div class="panel">
					                <div class="panel-body text-center">
					                    <div class="pad-ver mar-top text-main"><i class="demo-pli-file icon-4x"></i></div>
					                    <p class="text-lg text-semibold mar-no text-main">Surat Penelitian</p>
					                    <a href="">
					                    <button class="btn btn-primary mar-ver"><i class="fa fa-download"></i> Download </button></a>
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



