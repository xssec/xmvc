<?php
//Priv-Level Check
if (ROLE == 'super') {

start_div('mb-3');
  create_title(str_replace('/',' <i class="fas fa-chevron-right fa-sm"></i> ',$_SERVER['REQUEST_URI']), "warning");
end_div();
?>

<div class="row">
  <div class="col-sm-12">
    <div class="card mb-3 is-card-dark">
      <div class="card-body">
        <h5 class="card-title text-muted">System Preferences</h5>
        <form id="form-pengaturan" class="form" method="post">
          <?php
          $data = $data[0];
          start_content();
          start_div('row');
            start_div('col-md-6');
             form_input("App Name", "app_name", "text", '', "", "value='$data[app_name]'");
             form_input("App Description", "app_desc", "text", '', "", "value='$data[app_desc]'");
             form_input("Copyright", "app_copyright", "text", '', "", "value='$data[app_copyright]'");
            end_div();
            start_div('col-md-6');
             form_input("Favicon", "favicon", "text", '', "", "value='$data[favicon]'");
             form_input("Main Logo", "main_logo", "text", '', "", "value='$data[main_logo]'");
             form_input("Sidebar Logo", "sidebar_logo", "text", '', "", "value='$data[sidebar_logo]'");
            end_div();
          end_div();
          start_div('row mb-3');
            start_div('col-md-12');
             form_input("Footer Logo <small>(optional)</small>", "footer_logo", "url", '', "", "value='$data[footer_logo]'");
            end_div();
          end_div();
          start_div('row col-md-12');
             create_button("SAVE", "success", "", "fas fa-save");
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
   $('#favicon').val('<?= $data['favicon'] ?>');
   $('#img-favicon').html('<br><img src="<?= BASE_PATH ?>/public/images/thumbs/<?= $data['favicon'] ?>" width="150">');
   $('#form-pengaturan').submit(function(){
      $.ajax({
         url : "<?= BASE_PATH ?>/preferences/update",
         type : "POST",
         data : $('#form-pengaturan').serialize(),
         success : function(data){
            if (data == 'success') {
              alert('Preferences save successful!');
              location.reload();
            } else {
              alert(data);
            }
         },
         error : function(){
           alert("Preferences failed to save!");
         }
      });
      return false;
   });
});
</script>
<?php
}else{
  start_content();
  echo '
  <div class="align-items-center danger" style="padding: 10px 12px; background-color: #ffdddd; border-left: 6px solid #f44336;">
    <div class="col text-dark">
      <strong>Unauthorised</strong> access or use shall render the user liable to criminal and/or civil prosecution.
    </div>
  </div>';
  end_content();
}?>
