<?php
start_div('mb-3');
  create_title(str_replace('/',' <i class="fas fa-chevron-right fa-sm"></i> ',$_SERVER['REQUEST_URI']), "warning");
end_div();

//Content
start_content();

  start_div('row');
    start_div('col-md-6');
      create_button("Add", "success", "addForm()", "plus-sign");
    end_div();
    start_div('col-md-6');
      echo '<span id="utility" class="float-right mb-5"></span>';
    end_div();
  end_div();

  start_div('mb-3');end_div();
  create_table(array("Title","Description","Attachment","Action"),"","xsTable");

end_content();

//Form Modal
start_modal('modal-form', '', 'modal-lg');
form_input("Title", "title", "text", '', "", "required");
form_textarea("Description", "description", "text", '', "richtext", "");

$upload = true;
if ($upload) {
  form_file("Attachment <small class='text-muted'><em><span id='temp-attachment-name'></span></em></small>", "attachment", "", '', "");
  echo '<input type="hidden" class="" id="temp-attachment" name="temp-attachment" style="border:none;" style="width: 48px;" readonly/>';
}

end_modal();
?>

<script type="text/javascript">
var table, save_method;
$(function(){
//Load Data to Table with AJAX
  table = $('.table').DataTable({
    "processing" : true,
    "dom" : 'flBrt<"bottom"ip><"clear">',
    //"bSort" : false,
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "columnDefs":[
      {"orderable":false, "targets":[0,-1]},
      {"width": "50px", "targets": [-1], class: 'text-center'}
    ],
    "buttons" : [
      {
        extend: 'pdf',
        text: 'PDF',
        className: 'pdf btn btn-primary'
      },
      {
        extend: 'excel',
        text: 'Excel',
        className: 'excel btn btn-success'
      },
      {
        extend: 'print',
        text: 'Print',
        className: 'print btn btn-info'
      }
    ],
    "ajax" : {
    "url" : "<?= BASE_PATH ?>/app/xs/listData",
    "type" : "POST"
    }
  });
});

//Call Add Form
function addForm(){
  save_method = "add";
  $('#modal-form').modal('show');
  $('#modal-form form')[0].reset();
  $('.modal-title').text('Add Data');
  $('#temp-attachment-name').text('');

  var upload = true;
  if (upload) {
    $('.custom-file-label').html('');
    $("#fileInfo").empty();
  }

}

//Fetch Data for Edit
function editForm(id){
  save_method = "edit";
  $('#modal-form form')[0].reset();

  // set upload false if no need to upload
  var upload = true;
  if (upload) {
    $('.custom-file-label').html('');
    $("#fileInfo").empty();
  }

  $.ajax({
    url : "<?= BASE_PATH ?>/app/xs/edit/"+id,
    type : "GET",
    dataType : "JSON",
    success : function(data){
      $('#modal-form').modal('show');
      $('.modal-title').text('Edit Data');

      $('#id').val(data.id);
      $('#title').val(data.title);
      tinymce.get('description').setContent(data.description);
      $('#temp-attachment').val(data.attachment);
      $('#temp-attachment-name').text(data.attachment);

    },
    error : function(){
      alert("Tidak dapat menampilkan data!");
    }
  });
}

//Save Data with AJAX
$(document).on('submit', '#form-data', function(event){
  event.preventDefault();
  saveData();
});

function saveData(){
  if(save_method == "add") url = "<?= BASE_PATH ?>/app/xs/insert";
  else url = "<?= BASE_PATH ?>/app/xs/update";

  var formData = new FormData();
  var file = $("#attachment")[0].files[0];
  formData.append("attachment",file);
  formData.append("data",$("#form-data").serialize());

  $.ajax({
    url: url,
    type: "POST",
    data : formData,//$('#modal-form form').serialize(),
    async: true,
    //cache: false,
    contentType: false,
    processData: false,
    enctype: 'multipart/form-data',
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

//Delete Data with AJAX
function deleteData(id){
  if(confirm("Apakah yakin data akan dihapus?")){
    $.ajax({
      url : "<?= BASE_PATH ?>/app/xs/delete/"+id,
      type : "GET",
      success : function(data){
        table.ajax.reload();
      },
      error : function(){
        alert("Tidak dapat menghapus data!");
      }
    });
  }
}
</script>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<script>
	$("#attachment").on('change', function () {
	    $("#fileInfo").empty();
			getFileInfo();

			function getFileInfo(){
		    var fp = $('#attachment');
		    var lg = fp[0].files.length; // get length
		    var items = fp[0].files;
		    var fragment = "";

		    if (lg > 0) {
		        for (var i = 0; i < lg; i++) {
		            var fileName = items[i].name; // get file name
		            var fileSize = items[i].size; // get file size
		            var fileType = items[i].type; // get file type
								var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
								        i=0;while(fileSize>900){fileSize/=1024;i++;}
								        var exactSize = (Math.round(fileSize*100)/100)+' '+fSExt[i];
		            // append li to UL tag to display File info
		            fragment += "<small>" + fileName + " (<b>" + exactSize + "</b>) - Type :" + fileType + "</small>";
		        }

		        $("#fileInfo").append(fragment);
		    }
			}

	});
</script>
