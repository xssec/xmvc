<?php
start_div('mb-3');
  create_title(str_replace('/',' <i class="fas fa-chevron-right fa-sm"></i> ',$_SERVER['REQUEST_URI']), "warning");
end_div();
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card mb-3 is-card-dark">
      <div class="card-body">
        <h5 class="card-title text-muted">User Account</h5>
        <form id="form-setting" class="form form-horizontal" method="post">
        <?php
        $data = $data[0];
        start_content();
        start_div('row col-md-4');
           form_input("Full Name", "fullName", "text", '', "", 'value="'.$data['fullName'].'" readonly');
        end_div();
        start_div('row col-md-4');
           form_input("Username", "username", "text", '', "", 'value="'.$data['username'].'" readonly');
        end_div();
        start_div('row col-md-4');
           form_input("Old Password", "lama", "password", '', "", "required");
        end_div();
        start_div('row col-md-4');
           form_input("New Password", "baru", "password", '', "", "required");
        end_div();
        start_div('row col-md-4 mb-3');
           form_input("Re-type Password", "ulang", "password", '', "", "required");
        end_div();
        start_div('row col-md-4');
           create_button("SAVE", "success", "", "fa fa-save");
        end_div();
        end_content();
        ?>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(function(){
   $('#form-setting').submit(function(){
      if($('#baru').val() != $('#ulang').val()){
         alert('Password Baru tidak sama dengan Ulang Password');
      }else{
         $.ajax({
            url : "<?= BASE_PATH ?>/profile/update",
            type : "POST",
            data : $('#form-setting').serialize(),
            success : function(data){
              if (data == 'success') {
                alert('Profile save successful!');
                location.reload();
              } else {
                alert(data);
              }
            },
            error : function(){
              alert("Profile failed to save!");
            }
         });
      }
      return false;
   });
});
</script>
