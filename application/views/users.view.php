<?php
//Priv-Level Check
if (ROLE == 'super') {

start_div('mb-3');
  create_title(str_replace('/',' <i class="fas fa-chevron-right fa-sm"></i> ',$_SERVER['REQUEST_URI']), "warning");
end_div();
?>

<?php start_content();
start_div('row mb-3');
start_div('col-md-12');
  create_button("Add", "success", "addForm()", "plus-sign");
end_div();
end_div();
?>
   <div class="row">
     <div class="col-sm-12">
       <div class="card mb-3 is-card-dark">
         <div class="card-body">
           <h5 class="card-title text-muted">User Management</h5>
           <?php create_table(array("Username","Full Name", "Email","Role","Action"),"","Users");?>
         </div>
       </div>
     </div>
   </div>
<?php end_content();?>

<?php
start_modal('modal-form', 'return saveData()');
  form_input("Username", "username", "text", '', "", "required");
  form_input("Full Name", "fullName", "text", '', "", "required");
  form_input("Email", "email", "email", '', "", "required");
  form_input("Password", "password", "password", '******', "", "");
  echo '
  <div class="form-group">
   <label for="role">Role</label>
   <select class="form-control custom-select" id="role" name="role">
     <option value="user">user</option>
     <option value="admin">admin</option>
     <option value="super">super</option>
   </select>
 </div>
  ';
  form_input("", "temp-password", "hidden", '', "", "readonly");
end_modal();
?>

<script type="text/javascript">
//Call Add Form
function addForm(){
  save_method = "add";
  $('#modal-form').modal('show');
  $('#modal-form form')[0].reset();
  $('.modal-title').text('Add Data');
}

var table, save_method;
$(function(){
   table = $('.table').DataTable({
      "processing" : true,
      "columnDefs":[
        {"orderable":false, "targets":[0,-1]},
        {"width": "50px", "targets": [-1], class: 'text-center'}
      ],
      "ajax" : {
         "url" : "<?= BASE_PATH ?>/users/listData",
         "type" : "POST"
      }
   });
});

function editForm(id){
   save_method = "edit";
   $('#modal-form form')[0].reset();
   $.ajax({
      url : "<?= BASE_PATH ?>/users/edit/"+id,
      type : "GET",
      dataType : "JSON",
      success : function(data){
         $('#modal-form').modal('show');
         $('.modal-title').text('Edit Data');

         $('#id').val(data.id);
         $('#username').val(data.username);
         $('#fullName').val(data.fullName);
         $('#email').val(data.email);
         $('#password').val();
         $('#temp-password').val(data.password);
         $('#role').val(data.role);
      },
      error : function(){
         alert("Tidak dapat menampilkan data!");
      }
   });
}

function saveData(){
   //if(save_method == "edit") url = "<?//= BASE_PATH ?>/users/update";
   if(save_method == "add") url = "<?= BASE_PATH ?>/users/insert";
   else url = "<?= BASE_PATH ?>/users/update";
   $.ajax({
      url : url,
      type : "POST",
      data : $('#modal-form form').serialize(),
      success : function(data){
         $('#modal-form').modal('hide');
         table.ajax.reload();
      },
        error : function(){
        alert("Tidak dapat menyimpan data!");
      }
   });
   return false;
}

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
