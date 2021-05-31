<!DOCTYPE html>
<html lang="en">
<head>
  <title>LOGIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_PATH.'/public/images/favicon.png'?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  <?php
  require_once ROOT."/application/functions/functionHtml.php";
  ?>

<div class="container">
  <div class="row">
    <div class="Absolute-Center is-Responsive">
      <div class="text-center brandlogo mb-3"><span><?php echo '>;'?><span></div>
      <div class="col-sm-12 col-md-12 col-md-offset-1">
        <?php
        if (SELF_REGIST) {
          create_button("Register", "outline-success btn-sm", "addForm()", "");
        }
        ?>
      </div>
      <div class="col-sm-12 col-md-12 col-md-offset-1">
      <hr>
      <form role="form" action="<?= BASE_PATH ?>/login/check" method="post" autocomplete="off">
        <?php
        if(isset($msg)){
          echo "<div class='alert alert-danger'>$msg</div>";
        }
        ?>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
          <span class="input-group-text"><i class="far fa-user-circle"></i></span>
          </div>
          <input type="text" name="email" id="email" class="form-control " placeholder="E-mail" tabindex="1" autofocus>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-fingerprint"></i></span>
          </div>
          <input type="password" name="password" id="password" class="form-control " placeholder="Password" tabindex="2">
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
          <span class="text-info"><center>Unauthorised access or use shall render the user liable to criminal and/or civil prosecution.</center></span>
          </div>
        </div>

        <hr>
        <div class="row mb-3">
          <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Login" class="btn btn-secondary btn-block" tabindex="3"></div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<div id="particles-js"></div>

</body>
</html>

<?php
if (SELF_REGIST) {
  start_modal('modal-form', 'return saveData()');
  form_input("Username", "username", "text", '', "", "required");
  form_input("Full Name", "fullName", "text", '', "", "required");
  form_input("E-mail", "email", "email", '', "", "required");
  form_input("Password", "password", "password", '', "", "required");
  end_modal();
?>

<script type="text/javascript">
function addForm(){
  save_method = "add";
  $('#modal-form').modal('show');
  $('#modal-form form')[0].reset();
  $('.modal-title').text('Registrasi');
}

function saveData(){
  url = "<?= BASE_PATH ?>/auth/insert";
  $.ajax({
    url : url,
    type : "POST",
    data : $('#modal-form form').serialize(),
    success : function(data){
      $('#modal-form').modal('hide');
      alert("Anda berhasil registrasi, Silahkan login");
      table.ajax.reload();
    },
    error : function(){
      alert("Tidak dapat menyimpan data!");
    }
  });
  return false;
}
</script>
<?php }?>

<?php
  load_script('particles/particles.js');
  load_css('css/auth.css');
?>

<script>
/* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
particlesJS.load('particles-js', '<?= BASE_PATH."/public/particles/particles.json";?>', function() {
  console.log('callback - particles.js config loaded');
});
</script>
