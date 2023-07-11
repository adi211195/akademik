

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Login page | Akademik</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="css/nifty.min.css" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="css/demo/nifty-demo-icons.min.css" rel="stylesheet">


    <!--=================================================-->

    <!--Demo [ DEMONSTRATION ]-->
    <link href="css/demo/nifty-demo.min.css" rel="stylesheet">

    <!--CSS Loaders [ OPTIONAL ]-->
    <link href="plugins/css-loaders/css/css-loaders.css" rel="stylesheet">

    <!--CSS sweetalert [ OPTIONAL ]-->
    <link rel="stylesheet" href="css/sweetalert.css"> 

 
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->

<body>
    <div id="container" class="cls-container">

    	<!-- Modal -->
        <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-body text-center">
                <div class="load8">
					<div class="loader"></div>
				</div>
                  <p>Loading...</p>
              </div>
            </div>
          </div>
        </div>
        
		<!-- BACKGROUND IMAGE -->
		<!--===================================================-->
		<div id="bg-overlay"></div>
		
		
		<!-- LOGIN FORM -->
		<!--===================================================-->
		<div class="cls-content">
		    <div class="cls-content-sm panel">
		        <div class="panel-body">
		            <div class="mar-ver pad-btm">
		                <h1 class="h3">Account Login</h1>
		                <p>Sign In to your account</p>
		            </div>
		            <form action="" id="submit"  enctype="multipart/form-data">
		                <div class="form-group">
		                    <input type="text" name="account_username" class="form-control" placeholder="Username" autofocus required>
		                </div>
		                <div class="form-group">
		                    <input type="password" name="account_password" class="form-control" placeholder="Password" required>
		                </div>
		                <div class="checkbox pad-btm text-left">
		                    <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox">
		                    <label for="demo-form-checkbox">Remember me</label>
		                </div>
		                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
		            </form>
		        </div>
		
		        <div class="pad-all">
		            <a href="#" class="btn-link mar-rgt">Forgot password ?</a>
		
		        </div>
		    </div>
		</div>
		<!--===================================================-->
		
		
		
		
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->


        
    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="js/jquery.min.js"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="js/bootstrap.min.js"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="js/nifty.min.js"></script>

    <script src="js/sweetalert-dev.js"></script>    
    <script type="text/javascript">
            $(document).ready(function(){
                
                $('#submit').submit(function(e){
                    e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "check_login.php",
                    data:new FormData(this),
                    cache: false,
                    dataType:"json",
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $("#loadMe").modal({
                              backdrop: "static", //remove ability to close modal with click
                              keyboard: false, //remove option to close with keyboard
                              show: true //Display loader!
                            });
                       },
                    success: function(result){
                            if (result.status=='failed') {
                                sweetAlert({
                                    title:'Error!',
                                    text: 'Wrong username and password!',
                                    type:'error'
                                },function(isConfirm){
                                    window.location.href = "index.php";
                                });

                                
                            }
                            if (result.status=='success') {
                                sweetAlert({
                                    title:'Success!',
                                    text: 'Sign in success!',
                                    type:'success',
                                },function(isConfirm){
                                    window.location.href = "page.php";
                                });

                            
                               
                            }
                    },
                });
            });
            });
    </script>




</body>

</html>
