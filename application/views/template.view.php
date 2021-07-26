<?php
if(isset($_COOKIE[COOKIE_NAME])) {
  try {
    $session = SessionManager::getCurrentSession();
    DEFINE('USERNAME',$session->username);
    DEFINE('ROLE',$session->role);
  } catch (Exception $exception) {
    $this->redirect('login');
  }
}
?>
<!DOCTYPE html>
<html>
   <head>
     <title><?= $preferences[0]['app_name']?></title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
      <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
      <link rel="icon" type="image/png" sizes="32x32" href="<?= ($preferences[0]['favicon']) ? BASE_PATH.'/public/images/'.$preferences[0]['favicon']:'';?>">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js" integrity="sha512-sOO7yng64iQzv/uLE8sCEhca7yet+D6vPGDEdXCqit1elBUAJD1jYIYqz0ov9HMd/k30e4UVFAovmSG92E995A==" crossorigin="anonymous"></script>
      <?php
        //Call functionHtml.php, file CSS dan library jQuery
        require_once ROOT."/application/functions/functionHtml.php";
        load_css('css/main.css');
      ?>
   </head>

   <body>
     <div class="progress-container">
       <div class="progress-bar" id="indicatorsBar"></div>
     </div>
      <div class="container-fluid">
      <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
          <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
          <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="#" style="color:#16c7ff"><?= ($preferences[0]['sidebar_logo']) ? '<img src="'.BASE_PATH.'/public/images/'.$preferences[0]['sidebar_logo'].'" height="20px">':''?> <?= $preferences[0]['app_name'] ?></a>
              <div id="close-sidebar">
                <i class="fas fa-angle-double-left"></i>
              </div>
            </div>

      			<?php require_once ROOT."/application/views/menu.view.php"; ?>

            <!-- sidebar-menu  -->
          </div>
          <!-- sidebar-content  -->
          <div class="sidebar-footer">
            <a href="#">
              <i class="fa fa-bell"></i>
              <span class="badge badge-pill badge-warning notification">3</span>
            </a>
            <a href="#">
              <i class="fa fa-envelope"></i>
              <span class="badge badge-pill badge-success notification">7</span>
            </a>
            <a href="<?=BASE_PATH.'/profile'?>">
              <i class="fa fa-cog"></i>
              <!--<span class="badge-sonar"></span>-->
            </a>
            <a href="<?=BASE_PATH.'/logout'?>">
              <i class="fa fa-power-off"></i>
            </a>
          </div>
        </nav>
        <!-- sidebar-wrapper  -->
        <main class="page-content">
          <div class="container-fluid">
            <?php if ($preferences[0]['main_logo']): ?>
              <a href="#" style="color:#16c7ff"><img src='<?= BASE_PATH.'/public/images/'.$preferences[0]['main_logo'];?>' height="50px"/></a>
            <?php endif; ?>

            <h2 class="text-muted bold"></h2>
            <hr>
              <div class="row">
              <div class="col-md-12">
      					<?php

                $view = new View($viewName);
                $view->bind('data', $data);
                $view->render();

      					?>
              </div>

            </div>
          </div>
          <span onclick="topFunction()" id="topBtn" title="Go to top"><i class='far fa-arrow-alt-circle-up'></i></span>

        </main>
        <!-- page-content" -->
      </div>
      <!-- page-wrapper -->
    </div>

    <div class="footer" style="text-align:right"><?= ($preferences[0]['footer_logo'])? '<img src="'.$preferences[0]['footer_logo'].'" height="20px">':''?>  D.H.L | &copy; <?php echo DATE('Y').' '.$preferences[0]['app_copyright'];?></div>

    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css"/>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js" integrity="sha512-8l10HpXwk93V4i9Sm38Y1F3H4KJlarwdLndY9S5v+hSAODWMx3QcAVECA23NTMKPtDOi53VFfhIuSsBjjfNGnA==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.0/css/dataTables.dateTime.min.css">
    <script src="https://cdn.datatables.net/datetime/1.1.0/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">

    <?php
    load_script('bootstrap4-datetimepicker/bootstrap-datetimepicker.min.js');
    load_css('bootstrap4-datetimepicker/bootstrap-datetimepicker.min.css');
    load_css('select2/select2-bootstrap4.css');
    load_script('js/mask.ip-input.js');
    ?>

<script>
  jQuery(function ($) {
    $(".sidebar-dropdown > a").click(function() {
      $(".sidebar-submenu").slideUp(200);
      if ($(this).parent().hasClass("active")) {
        $(".sidebar-dropdown").removeClass("active");
        $(this).parent().removeClass("active");
      } else {
        $(".sidebar-dropdown").removeClass("active");
        $(this).next(".sidebar-submenu").slideDown(200);
        $(this).parent().addClass("active");
      }
    });

    $("#close-sidebar").click(function() {
      $(".page-wrapper").removeClass("toggled");
    });

    $("#show-sidebar").click(function() {
      $(".page-wrapper").addClass("toggled");
    });

    if (screen.width <= 1024) {
      $(".page-wrapper").removeClass("toggled");
    }
  });
</script>

<script type="text/javascript">
  jQuery(document).ready(function($) {
    if (window.jQuery().datetimepicker) {
      $('.datetimepicker').datetimepicker({
        // Formats
        // follow MomentJS docs: https://momentjs.com/docs/#/displaying/format/
        format: 'YYYY-MM-DD', //'YYYY-MM-DD hh:mm:ss'

        // Your Icons
        // as Bootstrap 4 is not using Glyphicons anymore
        icons: {
          time: 'fas fa-clock',
          date: 'fa fa-calendar',
          up: 'fa fa-chevron-up',
          down: 'fa fa-chevron-down',
          previous: 'fa fa-chevron-left',
          next: 'fa fa-chevron-right',
          today: 'fa fa-check',
          clear: 'fa fa-trash',
          close: 'fa fa-times'
        }
      });

      $('.datetimepicker-addon').on('click', function() {
        $(this).prev('input.datetimepicker').data('DateTimePicker').toggle();
      });
    }
  });
</script>

<script>
	$(document).ready(function(){
    tinymce.init({
    selector: ".richtext",
    height: 200,
    menubar: false,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    toolbar_mode: 'sliding',
    //contextmenu: 'link image imagetools table configurepermanentpen',
    setup : function(editor) {
    editor.on("change keyup", function(e){
        console.log('saving');
        //tinyMCE.triggerSave(); // updates all instances
        editor.save(); // updates this instance's textarea
        $(editor.getElement()).trigger('change'); // for garlic to detect change
        });
    },
    plugins: ['autosave save codesample advlist lists autolink visualblocks code fullscreen image wordcount table help quickbars'],
    paste_as_text: true,
    toolbar: 'undo redo | formatselect | ' +
    'bold italic backcolor | alignleft aligncenter ' +
    'alignright alignjustify | bullist numlist outdent indent | ' +
    'removeformat | table | code | fullscreen | image | codesample | help',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
    tinymce.activeEditor.execCommand('mceTogglePlainTextPaste');
  });

  $(document).on('focusin', function(e) {
      if ($(e.target).closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
  		e.stopImmediatePropagation();
  	}
  });
</script>

<script>
$('.xs-select').each(function () {
	//$(this).off('change');
	$(this).select2({
		theme: 'bootstrap4',
		placeholder: "",
		//width: 'auto',
		dropdownAutoWidth: true,
    multiple: false,
    allowClear: true,
	});
});

// Scrolling Effect
$(window).on("scroll", function() {
  var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
  var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  var scrolled = (winScroll / height) * 100;
  document.getElementById("indicatorsBar").style.width = scrolled + "%";

  if($(window).scrollTop()) {
    $('nav').addClass('black');
    document.getElementById("topBtn").style.display = "block";
  }else {
    $('nav').removeClass('black');
    document.getElementById("topBtn").style.display = "none";
  }

});

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
</script>

   </body>
</html>
