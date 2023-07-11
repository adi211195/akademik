<?php 
include "config/connection.php";
session_start();
ob_start();
$account_id         =$_SESSION['account_id'];
$account_status     =$_SESSION['account_status'];
$account_username   =$_SESSION['account_username'];
$account_name       =$_SESSION['account_name'];
$account_photo      =$_SESSION['account_photo'];
$account            =mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM account where account_id='$account_id'"));
$profile            =mysqli_fetch_array(mysqli_query($connect,"SELECT * FROM master_profile"));

if (empty($account_id)) {
  header("location:index.php");
}


?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Dashboard | Akademik <?= $account_id; ?></title>


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



    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="plugins/pace/pace.min.css" rel="stylesheet">
    <script src="plugins/pace/pace.min.js"></script>


    <!--Demo [ DEMONSTRATION ]-->
    <link href="css/demo/nifty-demo.min.css" rel="stylesheet">


        
    <!--Switchery [ OPTIONAL ]-->
    <link href="plugins/switchery/switchery.min.css" rel="stylesheet">


    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">


    <!--Chosen [ OPTIONAL ]-->
    <link href="plugins/chosen/chosen.min.css" rel="stylesheet">


    <!--noUiSlider [ OPTIONAL ]-->
    <link href="plugins/noUiSlider/nouislider.min.css" rel="stylesheet">


    <!--Select2 [ OPTIONAL ]-->
    <link href="plugins/select2/css/select2.min.css" rel="stylesheet">


    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <link href="plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <link href="plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

    <!--Summernote [ OPTIONAL ]-->
    <link href="plugins/summernote/summernote.min.css" rel="stylesheet">

    <link href="plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet">


    <!--Dropzone [ OPTIONAL ]-->
    <link href="plugins/dropzone/dropzone.min.css" rel="stylesheet">

    <!--Full Calendar [ OPTIONAL ]-->
    <link href="plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet">
    <link href="plugins/fullcalendar/nifty-skin/fullcalendar-nifty.min.css" rel="stylesheet">

     <!--Premium Icon [ DEMONSTRATION ]-->
    <link href="css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <style type="text/css">
        #content-container {
            padding-top: 0;
        }

        #page-title {
            margin-top: 55px;
        }
        .required {
            color: red;
        }

        .switch {
          position: relative;
          display: inline-block;
        }
        .switch-input {
          display: none;
        }
        .switch-label {
          display: block;
          width: 48px;
          height: 19px;
          text-indent: -150%;
          clip: rect(0 0 0 0);
          color: transparent;
          user-select: none;
        }
        .switch-label::before,
        .switch-label::after {
          content: "";
          display: block;
          position: absolute;
          cursor: pointer;
        }
        .switch-label::before {
          width: 100%;
          height: 100%;
          background-color: #dedede;
          border-radius: 9999em;
          -webkit-transition: background-color 0.25s ease;
          transition: background-color 0.25s ease;
        }
        .switch-label::after {
          top: 0;
          left: 0;
          width: 24px;
          height: 24px;
          border-radius: 50%;
          background-color: #fff;
          box-shadow: 0 0 2px rgba(0, 0, 0, 0.45);
          -webkit-transition: left 0.25s ease;
          transition: left 0.25s ease;
        }
        .switch-input:checked + .switch-label::before {
          background-color: #89c12d;
        }
        .switch-input:checked + .switch-label::after {
          left: 24px;
        }

        .mainnav-lg .page-fixedbar-container {
            left: 0px;
        }

        .page-fixedbar-content {
            margin: 40px 0px 0px 0px;
        }

        .chat-me {
          margin: 5px;
        }

        .chat-user {
          margin: 5px;
        }


        @media (min-width: 768px) {
          .page-fixedbar-content {
              padding-top: 0px;
          }
        }



        
    </style>

     <!--CSS Loaders [ OPTIONAL ]-->
    <link href="plugins/css-loaders/css/css-loaders.css" rel="stylesheet">

    <!--CSS sweetalert [ OPTIONAL ]-->
    <link rel="stylesheet" href="css/sweetalert.css">     
    <script src="js/sweetalert-dev.js"></script>    

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.4.1/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.4.1/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.1/firebase-storage.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.1/firebase-messaging.js"></script>

    <script>
      // Your web app's Firebase configuration
      // For Firebase JS SDK v7.20.0 and later, measurementId is optional
      const firebaseConfig = {
        apiKey: "AIzaSyAy4mSNztpu1CHQ9w9ysPTMZufuMu4HIVY",
        authDomain: "siakadfirebase.firebaseapp.com",
        databaseURL: "https://siakadfirebase-default-rtdb.firebaseio.com",
        projectId: "siakadfirebase",
        storageBucket: "siakadfirebase.appspot.com",
        messagingSenderId: "493454953273",
        appId: "1:493454953273:web:a8082984c5541dfb09b6e8",
        measurementId: "G-2V53TQHC4Q"
      };
      // Initialize Firebase
      firebase.initializeApp(firebaseConfig);
    </script>
    
    

    <script type="text/javascript">
  
    function select_majors(college)
      {
        $.ajax({
              url: 'pages/ajax/ajax_majors.php',
              data : 'college='+college,
              type: "post", 
              dataType: "html",
              timeout: 10000,
              success: function(response){
                  $('#majors_code').html(response);
              }
          });
      }


    function select_majors2(college)
      {
        $.ajax({
              url: 'pages/ajax/ajax_majors.php',
              data : 'college='+college,
              type: "post", 
              dataType: "html",
              timeout: 10000,
              success: function(response){
                  $('#majors_code2').html(response);
              }
          });
      }


    function select_majors3(college)
      {
        $.ajax({
              url: 'pages/ajax/ajax_majors.php',
              data : 'college='+college,
              type: "post", 
              dataType: "html",
              timeout: 10000,
              success: function(response){
                  $('#majors_code3').html(response);
              }
          });
      }


    function select_majors4(college)
      {
        $.ajax({
              url: 'pages/ajax/ajax_majors.php',
              data : 'college='+college,
              type: "post", 
              dataType: "html",
              timeout: 10000,
              success: function(response){
                  $('#majors_code4').html(response);
              }
          });
      }


      function select_majors5(college)
      {
        $.ajax({
              url: 'pages/ajax/ajax_majors.php',
              data : 'college='+college,
              type: "post", 
              dataType: "html",
              timeout: 10000,
              success: function(response){
                  $('#majors_code5').html(response);
              }
          });
      }


      function select_majors6(college)
      {
        $.ajax({
              url: 'pages/ajax/ajax_majors.php',
              data : 'college='+college,
              type: "post", 
              dataType: "html",
              timeout: 10000,
              success: function(response){
                  $('#majors_code6').html(response);
              }
          });
      }



       function select_majors7(college)
      {
        $.ajax({
              url: 'pages/ajax/ajax_majors.php',
              data : 'college='+college,
              type: "post", 
              dataType: "html",
              timeout: 10000,
              success: function(response){
                  $('#majors_code7').html(response);
              }
          });
      }


      function select_curriculum7(majors)
      {
        var sy = $('#sy7').val();
        var sm = $('#sm7').val();
        var college = $('#college_code7').val();

        $.ajax({
              url: 'pages/ajax/ajax_curriculum.php',
              data : 'college='+college+
                      '&sy='+sy+
                      '&sm='+sm+
                      '&majors='+majors,
              type: "post", 
              dataType: "html",
              timeout: 10000,
              success: function(response){
                  $('#curriculum').html(response);
              }
          });
      }


    function select_courses(majors)
      {
        $.ajax({
              url: 'pages/ajax/ajax_courses.php',
              data : 'majors='+majors,
              type: "post", 
              dataType: "html",
              timeout: 10000,
              success: function(response){
                  $('#courses_code').html(response);
              }
          });
      }
    </script>


    <?php

      function bold($result, $search) {
          return preg_replace("/$search/", "<span class='badge'>$search</span>", $result);
      }
      
    ?>

        
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">

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
        
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <!--Brand logo & name-->
                <!--================================-->
                <div class="navbar-header">
                    <a href="page.php" class="navbar-brand">
                        <img src="img/logo.png" alt="Academic Logo" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text">Academic</span>
                        </div>
                    </a>
                </div>
                <!--================================-->
                <!--End brand logo & name-->


                <!--Navbar Dropdown-->
                <!--================================-->
                <?php include "navbar.php"; ?>
                <!--================================-->
                <!--End Navbar Dropdown-->

            </div>
        </header>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <?php include "content.php"; ?>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
            <!--ASIDE-->
            <!--===================================================-->
            <?php include "aside.php"; ?>
            <!--===================================================-->
            <!--END ASIDE-->

            
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
                <div id="mainnav">


                    <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
                    <!--It will only appear on small screen devices.-->
                    <!--================================
                    <div class="mainnav-brand">
                        <a href="index.html" class="brand">
                            <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
                            <span class="brand-text">Nifty</span>
                        </a>
                        <a href="#" class="mainnav-toggle"><i class="pci-cross pci-circle icon-lg"></i></a>
                    </div>
                    -->



                    <!--Menu-->
                    <!--================================-->
                    <?php include "menu.php"; ?>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>

        

        <!-- FOOTER -->
        <!--===================================================-->
        <footer id="footer">



            <p class="pad-lft">&#0169; 2021 Academic</p>



        </footer>
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
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




    <!--=================================================-->
    
    <!--Demo script [ DEMONSTRATION ]-->
    <!-- <script src="js/demo/nifty-demo.min.js"></script> -->

    
    <!--Switchery [ OPTIONAL ]-->
    <script src="plugins/switchery/switchery.min.js"></script>


    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <script src="plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>


    <!--Chosen [ OPTIONAL ]-->
    <script src="plugins/chosen/chosen.jquery.min.js"></script>


    <!--noUiSlider [ OPTIONAL ]-->
    <script src="plugins/noUiSlider/nouislider.min.js"></script>


    <!--Select2 [ OPTIONAL ]-->
    <script src="plugins/select2/js/select2.min.js"></script>


    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <script src="plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <script src="plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <!--Bootstrap Wizard [ OPTIONAL ]-->
    <script src="plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>


    <!--Bootstrap Validator [ OPTIONAL ]-->
    <script src="plugins/bootstrap-validator/bootstrapValidator.min.js"></script>


    <!--Form Wizard [ SAMPLE ]-->
    <script src="js/demo/form-wizard.js"></script>


     <!--Full Calendar [ OPTIONAL ]-->
    <script src="plugins/fullcalendar/lib/moment.min.js"></script>
    <script src="plugins/fullcalendar/lib/jquery-ui.custom.min.js"></script>
    <script src="plugins/fullcalendar/fullcalendar.min.js"></script>


    <!--DataTables [ OPTIONAL ]-->
    <script src="plugins/datatables/media/js/jquery.dataTables.js"></script>
    <script src="plugins/datatables/media/js/dataTables.bootstrap.js"></script>
    <script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    
    
    <!--Summernote [ OPTIONAL ]-->
    <script src="plugins/summernote/summernote.min.js"></script>


    <!--Mail [ SAMPLE ]-->
    <script src="js/demo/mail.js"></script>
    

    <!--Dropzone [ OPTIONAL ]-->
    <script src="plugins/dropzone/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>

    <script type="text/javascript">
        var doc = new jsPDF('l', 'mm', 'a4');

      function saveDiv(divId, title) {
       doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
       doc.save('div.pdf');
      }

      function printDiv(divId,title) {

        let mywindow = window.open('', 'PRINT', 'height=100%,width=100%,top=100,left=150');

        mywindow.document.write(`<html><head><title>${title}</title>`);
        mywindow.document.write('</head><body >');
        mywindow.document.write(document.getElementById(divId).innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
      }
    </script>


    
    <!--Custom script [ DEMONSTRATION ]-->
    <!--===================================================-->
    <script>
            
          $('#demo-dt-basic').dataTable( {
              "responsive": true,
              "language": {
                  "paginate": {
                    "previous": '<i class="demo-psi-arrow-left"></i>',
                    "next": '<i class="demo-psi-arrow-right"></i>'
                  }
              }
          } );


          $(".table-alumni").DataTable({
              ordering: true,
              processing: true,
              serverSide: true,
              ajax: {
                url: "pages/administrator/alumni/json.php",
                type:'POST',
              },
              "aoColumns": [
                      null,
                      null,
                      null,
                      null,
                      null,
                      null,
                  {
                        "mData": null,
                        "sortable": false,
                        "render": function (data, row, type, meta) {
                            let btn = '';
     
                            btn += '<button class="btn btn-danger" id="remove" value="'+data[6]+'" onclick="data_remove(this.value);" title="Remove"><i class="fa fa-trash"></i></button> ';

                            btn += '<a href="page.php?p=alumni&act=edit&id='+data[6]+'"><button class="btn btn-primary" title="Edit"><i class="fa fa-edit"></i></button></a>';
                            

     
                            return btn;
                        }
                    }
              ]
          
            });

      
          // DROPZONE.JS
          // =================================================================
          // Require Dropzone
          // http://www.dropzonejs.com/
          // =================================================================
          $('#demo-dropzone').dropzone({
              url: '/file/post',
              autoProcessQueue: false,
              addRemoveLinks: true,
              maxFiles: 1,
              init: function() {
                  var myDropzone = this;
                  myDropzone.on('maxfilesexceeded', function(file) {
                      this.removeAllFiles();
                      this.addFile(file);
                  });
              }
          });
      
      
      
      
          // SUMMERNOTE
          // =================================================================
          // Require Summernote
          // http://hackerwins.github.io/summernote/
          // =================================================================
          $('#demo-summernote, #demo-summernote-full-width').summernote({
              height : '300px'
          });

          $('.demo-summernote2').summernote({
              height : '100px',
              toolbar: [
                  //[groupname, [button list]]
                  ['style', ['bold', 'italic', 'underline', 'clear']],
                  ['para', ['ul', 'ol', 'paragraph']],
              ]
          });
      
          
    </script>

    <script type="text/javascript">
      // Initialize the calendar
    // -----------------------------------------------------------------
    $(document).on('nifty.ready', function() {
        $('#demo-calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },

            <?php 
              $date   =htmlspecialchars(@$_GET['date']);
              if(empty($date)) {
                $start= date('Y-m-d');
              } else {
                $start=$date;
              } 
            ?>


            defaultDate: '<?= $start; ?>',
            eventLimit: true, // allow "more" link when too many events
            events: [
                <?php
                
                $data=mysqli_query($connect,"SELECT * FROM master_calendar where calendar_end>='$start'");
                while ($row=mysqli_fetch_array($data)) {
                ?>

                {
                    title: '<?= $row['calendar_title']; ?>',
                    start: '<?= $row['calendar_start']; ?>',
                    end: '<?= $row['calendar_end']; ?>',
                    className: '<?= $row['calendar_color']; ?>'
                },

              <?php } ?>
                
            ]
        });

    });
    </script>



    <!--Form Component [ SAMPLE ]-->
    <!-- <script src="js/demo/form-component.js"></script> -->
    <script type="text/javascript">
        $('#demo-cs-multiselect').chosen({width:'100%'});
        $('#demo-chosen-select').chosen();
        
        $('#demo-dp-txtinput input').datepicker(
            {
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true
            }
        );
    </script>



    
    

    <script type="text/javascript">
            $(document).ready(function(){


                
                $('.action').submit(function(e){
                        e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "<?= $action; ?>",
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
                                        text: 'Data Failed to Send!',
                                        type:'error'
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Data Sent Successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });
                });    

   

                $('#action_majors').submit(function(e){
                        e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "<?= $action; ?>",
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
                                        text: 'Data Failed!',
                                        type:'error'
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Data is successful! , '+result.jumlah+' data, '+ result.failed +' update data, ' + result.success +' insert data ',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });
                });     



            }); 

        
        function typestatus() {
                var message =$('#message');
                var typingStatus =$('#typingStatus');

                    if (!message.is(':focus') || message.val() == '') {
                      $.ajax({
                          type: "GET",
                          url: "<?= $action; ?>",
                          data:"id=<?= $sent = isset($account_sent)?$account_sent : ''; ?>"+
                               "&action=notyping",
                          success: function(result){
                          },
                      });

                        
                    } else {
                        $.ajax({
                          type: "GET",
                          url: "<?= $action; ?>",
                          data:"id=<?= $sent = isset($account_sent)?$account_sent : ''; ?>"+
                               "&action=typing",
                          success: function(result){
                          },
                      });
                    }
                }


        


        function data_remove(id){
            if (confirm('Are you sure you want to delete this?')) {
                   $.ajax({
                        type: "GET",
                        url: "<?= $action; ?>",
                        data:'id='+id+
                             '&action=remove',
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
                                        text: 'Data failed to delete!',
                                        type:'error'
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Data deleted successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });

            }
        };


        function data_remove_comment(id){
            if (confirm('Are you sure you want to delete this?')) {
                   $.ajax({
                        type: "GET",
                        url: "<?= $action; ?>",
                        data:'id='+id+
                             '&action=remove_comment',
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
                                        text: 'Data failed to delete!',
                                        type:'error'
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Data deleted successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });

            }
        };



        function data_blacklist(id, date){
            if (confirm('Are you sure you want to blacklist this data?')) {
                   $.ajax({
                        type: "GET",
                        url: "<?= $action; ?>",
                        data:'id='+id+
                             '&date='+date+
                             '&action=blacklist',
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
                                        text: 'Data failed to blacklist!',
                                        type:'error'
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Data blacklist successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });

            }
        };


        function data_whitelist(id, date){
            if (confirm('Are you sure you want to whitelist this data?')) {
                   $.ajax({
                        type: "GET",
                        url: "<?= $action; ?>",
                        data:'id='+id+
                             '&date='+date+
                             '&action=whitelist',
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
                                        text: 'Data failed to whitelist!',
                                        type:'error'
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Data whitelist successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });

            }
        };


        function data_trash(id){
            if (confirm('Are you sure you want to delete this?')) {
                   $.ajax({
                        type: "GET",
                        url: "<?= $action; ?>",
                        data:'id='+id+
                             '&action=trash',
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
                                        text: 'Data failed to delete!',
                                        type:'error'
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Data deleted successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });

            }
        };


        function data_trash_send(id){
            if (confirm('Are you sure you want to delete this?')) {
                   $.ajax({
                        type: "GET",
                        url: "<?= $action; ?>",
                        data:'id='+id+
                             '&action=trash_send',
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
                                        text: 'Data failed to delete!',
                                        type:'error'
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Data deleted successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });

            }
        };


        function data_folder(id){
            if (confirm('Are you sure you want to delete this?')) {
                   $.ajax({
                        type: "GET",
                        url: "<?= $action; ?>",
                        data:'id='+id+
                             '&action=remove_folder',
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
                                        text: 'Data failed to delete!',
                                        type:'error'
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Data deleted successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });

            }
        };
    </script>

    <script type="text/javascript">
        function data_choose(id){
            if (confirm('Are you sure you want to choose this?')) {
                   $.ajax({
                        type: "GET",
                        url: "<?= $action; ?>",
                        data:'id='+id+
                             '&student_nim=<?= $nim = isset($student_nim)?$student_nim : ""; ?>'+
                             '&krs_package_id=<?= $krs = isset($krs_package_id)?$krs_package_id : ""; ?>'+
                             '&action=choose',
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
                                        text: 'Data failed to choose!',
                                        type:'error'
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Data choose successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });

            }
        };
    </script>


    <script type="text/javascript">
        function data_attendance(id,attendance_type,student_nim){                  
                     $.ajax({
                       url:"<?= $action; ?>",
                       context: this,
                       data:{
                           id:id, 
                           attendance_type:attendance_type, 
                           student_nim:student_nim,
                           action:'absen'
                       },
                       dataType:"json",
                       method:"POST",
                       success:function(result) {
                                if (result.status=='failed') {
                                    sweetAlert({
                                        title:'Error!',
                                        text: 'Attendance data saved failed!',
                                        type:'error',
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Attendance data saved successfully!',
                                        type:'success',
                                    });
                                   
                                }
                        },
                    });  

        };



        function data_krs(id,approved,student_nim){                  
                     $.ajax({
                       url:"<?= $action; ?>",
                       context: this,
                       data:{
                           id:id, 
                           approved:approved, 
                           student_nim:student_nim,
                           action:'krs'
                       },
                       dataType:"json",
                       method:"POST",
                       success:function(result) {
                                if (result.status=='failed') {
                                    sweetAlert({
                                        title:'Error!',
                                        text: 'Approved data saved failed!',
                                        type:'error',
                                    });
                                }
                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Approved data saved successfully!',
                                        type:'success',
                                    });
                                   
                                }
                        },
                    });  

        };


        function data_choice(polling_choice_id,polling_id,account_id){                    
                     $.ajax({
                       url:"<?= $action; ?>",
                       context: this,
                       data:{
                           polling_choice_id:polling_choice_id, 
                           polling_id:polling_id, 
                           account_id:account_id,
                           action:'choice'
                       },
                       dataType:"json",
                       method:"POST",
                       success:function(result) {
                                if (result.status=='failed') {
                                    sweetAlert({
                                        title:'Error!',
                                        text: 'Polling data saved failed!',
                                        type:'error',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                }

                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Polling data saved successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $back; ?>";
                                    });
                                   
                                }
                        },
                    });            
        };


        function data_question(question_id,question_answer,student_nim){                    
                     $.ajax({
                       url:"<?= $action; ?>",
                       context: this,
                       data:{
                           question_id:question_id, 
                           question_answer:question_answer, 
                           student_nim:student_nim,
                           action:'question'
                       },
                       dataType:"json",
                       method:"POST",
                       success:function(result) {
                                if (result.status=='failed') {
                                    sweetAlert({
                                        title:'Error!',
                                        text: 'Questionnaire data saved failed!',
                                        type:'error',
                                    },function(isConfirm){
                                        window.location.href = "<?= $fail = isset($failed)?$failed : '' ?>";
                                    });
                                }

                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Questionnaire data saved successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $nex = isset($next)?$next : '' ?>";
                                    });
                                   
                                }
                        },
                    });            
        };


        function data_question_lecturer(question_id,question_answer,student_nim,curriculum_id){                    
                     $.ajax({
                       url:"<?= $action; ?>",
                       context: this,
                       data:{
                           question_id:question_id, 
                           question_answer:question_answer, 
                           student_nim:student_nim,
                           curriculum_id:curriculum_id,
                           action:'question'
                       },
                       dataType:"json",
                       method:"POST",
                       success:function(result) {
                                if (result.status=='failed') {
                                    sweetAlert({
                                        title:'Error!',
                                        text: 'Questionnaire data saved failed!',
                                        type:'error',
                                    },function(isConfirm){
                                        window.location.href = "<?= $fail = isset($failed)?$failed : '' ?>";
                                    });
                                }

                                if (result.status=='success') {
                                    sweetAlert({
                                        title:'Success!',
                                        text: 'Questionnaire data saved successfully!',
                                        type:'success',
                                    },function(isConfirm){
                                        window.location.href = "<?= $nex = isset($next)?$next : '' ?>";
                                    });
                                   
                                }
                        },
                    });            
        };
    </script>

    <script type="text/javascript">
        $(document).ready(function(){  
          $('#student_name').keyup(function(){  
               var query = $(this).val();  
               if(query != '')  
               {  
                    $.ajax({  
                         url:"pages/ajax/ajax_student.php",  
                         method:"POST",  
                         data:{query:query},  
                         success:function(data)  
                         {  
                              $('#student_nameList').fadeIn();  
                              $('#student_nameList').html(data);  
                         }  
                    });  
               }  
          });  
          $(document).on('click', 'li', function(){  
               $('#student_name').val($(this).text());  
               $('#student_nameList').fadeOut();  
          }); 


          $('#account_username').keyup(function(){  
               var query = $(this).val();  
               if(query != '')  
               {  
                    $.ajax({  
                         url:"pages/ajax/ajax_account.php",  
                         method:"POST",  
                         data:{query:query},  
                         success:function(data)  
                         {  
                              $('#account_nameList').fadeIn();  
                              $('#account_nameList').html(data);  
                         }  
                    });  
               }  
          });  
          $(document).on('click', 'li', function(){  
               $('#account_username').val($(this).text());  
               $('#account_nameList').fadeOut();  
          });  
     });  
    </script>


<!--     ///CURRICULUM -->
    <script type="text/javascript">
        $("#curriculum input[type='checkbox']").click(function(){

              var total_sks=0;
              var choose=$(this).val();

              //lOOP THROUGH CHECKED
              $("#curriculum input[type='checkbox']:checked").each(function(){
                   //Update total sks
                  total_sks += parseInt($(this).data("exval"),10);
              });

              $("#sks").html(total_sks+" SKS");


                if($(this).is(":checked")) { 
                // if(this.checked) {              
                     // checkboxes_value.push($(this).val());
                     $.ajax({
                       url:"<?= $action; ?>",
                       context: this,
                       data:{
                           choose:choose, 
                           schedule_id:'<?= $sch = isset($schedule_id)?$schedule_id : "" ?>', 
                           action:'input_schedule'
                       },
                       dataType:"json",
                       method:"POST",
                       success:function(result)
                       {
                        if (result.status=='schedule failed') {
                            
                            $(this).prop('checked',false);
                            total_sks = total_sks-parseInt($(this).data("exval"));
                            $("#sks").html(total_sks+" SKS");

                            sweetAlert({
                            title:'Failed!',
                            text: 'The schedule already exists, please check again the schedule you choose!',
                            type:'error',
                            }); 


                        }

                        if (result.status=='course failed') {
                            $(this).prop('checked',false);
                            total_sks = total_sks-parseInt($(this).data("exval"));
                            $("#sks").html(total_sks+" SKS");

                            sweetAlert({
                            title:'Failed!',
                            text: 'The course already exists, please check again the schedule you choose!',
                            type:'error',
                            }); 

                        } 
                        if (result.status=='success') {

                            $("#sks").html(total_sks+" SKS");
                            sweetAlert({
                            title:'Success!',
                            text: 'Schedule Added Successfully!',
                            type:'success',
                            });     
                        }   
                            
                       }
                     });

                                                                                       
                } else {
                    $.ajax({
                       url:"<?= $action; ?>",
                       context: this,
                       data:{
                           choose:choose, 
                           schedule_id:'<?= $sch = isset($schedule_id)?$schedule_id : "" ?>', 
                           action:'remove_schedule'
                       },
                       dataType:"json",
                       method:"POST",
                       success:function(result)
                       {
                        if (result.status=='success') {

                            $("#sks").html(total_sks+" SKS");

                            sweetAlert({
                            title:'Canceled!',
                            text: 'Schedule Canceled Successfully!',
                            type:'error',
                            });

                        }  

                        if (result.status=='failed') {
                            $("#sks").html(total_sks+" SKS");

                            sweetAlert({
                            title:'Canceled Failed!',
                            text: 'Schedule Canceled Failed!',
                            type:'error',
                            });

                        }  
                    }
                    });
                }  

        });  
    </script>


    


      <script>
        var lecturer_id         = "<?= $lecturer_id = isset($details['account_id'])?$details['account_id'] : ''; ?>";
        var account_status     = "<?= $account_status; ?>";
        var account_id         = "<?= $account_id; ?>";
        var account_name       = "<?= $account_name; ?>";
        var account_username   = "<?= $account_username; ?>";
        var account_photo      = "<?= $account_photo; ?>";
        var time = "<?php echo date('H:i'); ?>";
        var date = "<?php echo date('d M Y'); ?>";
        var datetime = <?php echo date('dmyHis'); ?>;
        var account_receiver =  "<?= $sent = isset($account_sent)?$account_sent : ''; ?>";
        var code = [account_id, account_receiver];
        code.sort();
        var code2 = [lecturer_id, account_receiver];
        code2.sort();
        
      </script>

      <script>
        
        $('.sentprivate').submit(function(e){
          // get message
          var message = $('#message').val();         

          var ref = firebase.database().ref("personal"+code);
          ref.once("value")
            .then(function(snapshot) {
            var index = snapshot.numChildren()+1; // 1 ("name")

          // save in database
          firebase.database().ref("personal"+code).push().set({
            "account_status"     : account_status,
            "account_id"         : account_id,
            "account_name"       : account_name,
            "account_username"   : account_username,
            "account_photo"      : account_photo,
            "account_receiver"   : account_receiver,
            "time"               : time,
            "date"               : date,
            "datetime"           : datetime,
            "message"            : message,
            "view"               : "1",
            index                : index
          });

          });

          // prevent form from submitting
          $('#message').val("");
          return false;
        });
        
        // attach listener for delete message
          firebase.database().ref("personal"+code).on("child_removed", function (snapshot) {
            // remove message node
            if (snapshot.val().account_id==account_id) {
              document.getElementById(snapshot.key).innerHTML = "<div class='chat-me'><div class='media-body'><div><p>This message has been removed </p></div></div>";

            } else {
              document.getElementById(snapshot.key).innerHTML = "<div class='chat-user'><div class='media-body'><div><p>This message has been removed </p></div></div>";
            }
          });


          function deleteprivate(self) {
            if (confirm('Are you sure you want to delete this?')) {
              // get message ID
              var messageId = self.getAttribute("data-id");          
              // delete message
              firebase.database().ref("personal"+code).child(messageId).remove();
            }
          }
        
      </script>


      <script>
        
        $('.sentgroup').submit(function(e){
          // get message
          var message = $('#message').val();         

          var ref = firebase.database().ref("group"+code2);
          ref.once("value")
            .then(function(snapshot) {
            var index = snapshot.numChildren()+1; // 1 ("name")

          // save in database
          firebase.database().ref("group"+code2).push().set({
            "account_status"     : account_status,
            "account_id"         : account_id,
            "account_name"       : account_name,
            "account_username"   : account_username,
            "account_photo"      : account_photo,
            "account_receiver"   : account_receiver,
            "time"               : time,
            "date"               : date,
            "datetime"           : datetime,
            "message"            : message,
            "view"               : "1",
            index                : index
          });

          });

          // prevent form from submitting
          $('#message').val("");
          return false;
        });
        
        // attach listener for delete message
          firebase.database().ref("group"+code2).on("child_removed", function (snapshot) {
            // remove message node
            if (snapshot.val().account_id==account_id) {
              document.getElementById(snapshot.key).innerHTML = "<div class='chat-me'><div class='media-body'><div><p>This message has been removed </p></div></div>";

            } else {
              document.getElementById(snapshot.key).innerHTML = "<div class='chat-user'><div class='media-body'><div><p>This message has been removed </p></div></div>";
            }
          });


          function deletegroup(self) {
            if (confirm('Are you sure you want to delete this?')) {
              // get message ID
              var messageId = self.getAttribute("data-id");          
              // delete message
              firebase.database().ref("group"+code2).child(messageId).remove();
            }
          }
        
      </script>



    <script type="text/javascript">
        $("#krs_personal input[type='checkbox']").click(function(){

              var total_sks=0;
              var choose=$(this).val();

              //lOOP THROUGH CHECKED
              $("#krs_personal input[type='checkbox']:checked").each(function(){
                   //Update total sks
                  total_sks += parseInt($(this).data("exval"),10);
              });

              $("#sks").html(total_sks+" SKS");


                if($(this).is(":checked")) { 


                // if(this.checked) {              
                     // checkboxes_value.push($(this).val());
                     $.ajax({
                       url:"<?= $action; ?>",
                       context: this,
                       data:{
                           choose:choose, 
                           student_nim:'<?= $nim = isset($student_nim)?$student_nim : "" ?>', 
                           krs_school_year:'<?= $krs = isset($krs_school_year)?$krs_school_year : "" ?>', 
                           krs_semester:'<?= $km= isset($krs_semester)?$krs_semester : "" ?>', 
                           action:'input_krs'
                       },
                       dataType:"json",
                       method:"POST",
                       success:function(result)
                       {
                        if (result.status=='schedule failed') {
                            
                            $(this).prop('checked',false);
                            total_sks = total_sks-parseInt($(this).data("exval"));
                            $("#sks").html(total_sks+" SKS");

                            sweetAlert({
                            title:'Failed!',
                            text: 'The schedule already exists, please check again the schedule you choose!',
                            type:'error',
                            }); 


                        }

                        if (result.status=='course failed') {
                            $(this).prop('checked',false);
                            total_sks = total_sks-parseInt($(this).data("exval"));
                            $("#sks").html(total_sks+" SKS");

                            sweetAlert({
                            title:'Failed!',
                            text: 'The course already exists, please check again the schedule you choose!',
                            type:'error',
                            }); 

                        } 
                        if (result.status=='success') {

                            $("#sks").html(total_sks+" SKS");
                            sweetAlert({
                            title:'Success!',
                            text: 'Schedule Added Successfully!',
                            type:'success',
                            });     
                        }   
                            
                       }
                     });

                                                                                       
                } else {
                    $.ajax({
                       url:"<?= $action; ?>",
                       context: this,
                       data:{
                           choose:choose, 
                           student_nim:'<?= $nim = isset($student_nim)?$student_nim : "" ?>', 
                           krs_school_year:'<?= $krs = isset($krs_school_year)?$krs_school_year : "" ?>', 
                           krs_semester:'<?= $km= isset($krs_semester)?$krs_semester : "" ?>', 
                           action:'remove_krs'
                       },
                       dataType:"json",
                       method:"POST",
                       success:function(result)
                       {
                        if (result.status=='success') {

                            $("#sks").html(total_sks+" SKS");

                            sweetAlert({
                            title:'Canceled!',
                            text: 'Schedule Canceled Successfully!',
                            type:'error',
                            });

                        }  

                        if (result.status=='failed') {
                            $("#sks").html(total_sks+" SKS");

                            sweetAlert({
                            title:'Canceled Failed!',
                            text: 'Schedule Canceled Failed!',
                            type:'error',
                            });

                        }  
                    }
                    });
                }  

        });  
    </script>






</body>

</html>
