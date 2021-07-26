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


  <!-- count particles -->
  <div class="count-particles">

    <div class="container">
    	<div class="d-flex justify-content-center h-100 mb-3">
    		<div class="card">
    			<div class="card-header">
    				<h3>Sign In</h3>

    				<div class="d-flex justify-content-end social_icon">
    					<span><i class="fab fa-facebook-square"></i></span>
    					<span><i class="fab fa-google-plus-square"></i></span>
    					<span><i class="fab fa-twitter-square"></i></span>
    				</div>

    			</div>
    			<div class="card-body">
            <form role="form" action="<?= BASE_PATH ?>/login/check" method="post" autocomplete="off">
              <div class="mb-3 text-danger"><?php if(isset($msg)){echo $msg;}?></div>
    					<div class="input-group form-group">
    						<div class="input-group-prepend">
    							<span class="input-group-text login_btn"><i class="fas fa-user"></i></span>
    						</div>
    						<input type="text" id="email" name="email" class="form-control" placeholder="username">
    					</div>
    					<div class="input-group form-group">
    						<div class="input-group-prepend">
    							<span class="input-group-text login_btn"><i class="fas fa-key"></i></span>
    						</div>
    						<input type="password" id="password" name="password" class="form-control" placeholder="password">
    					</div>
    					<div class="row align-items-center remember">
    						<input type="checkbox">Remember Me
    					</div>
    					<div class="form-group">
    						<button type="submit" name="submit" value="Login" class="btn btn-outline-secondary btn-lg float-right login_btn">Login</button>
    					</div>
    				</form>
    			</div>
    			<div class="card-footer">
            <?php
            if (SELF_REGIST) {
              echo '
              <div class="d-flex justify-content-center links">
                Don\'t have an account?<a href="#"><span onclick="addForm(); return false">Sign Up</span></a>
              </div>
              ';
            }
            ?>
            <div class="d-flex justify-content-center mb-2">
              <a href="#">Forgot your password?</a>
            </div>
            <span class="text-info"><center>Unauthorised access or use shall render the user liable to criminal and/or civil prosecution.</center></span>

    			</div>
    		</div>
    	</div>
    </div>

  </div>

  <!-- particles.js container -->
  <div id="particles-js"></div>
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
  $('.modal-title').text('Sign Up');
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


  </body>
  </html>
