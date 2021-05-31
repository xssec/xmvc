<?php
//Fungsi untuk memanggil file CSS
function load_css($path){
  echo '<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'/public/'.$path.'">';
}

function load_ext_css($path){
  echo '<link rel="stylesheet" type="text/css" href="'.$path.'">';
}

//Fungsi untuk memanggil file Javascript
function load_script($path){
  echo '<script type="text/javascript" src="'.BASE_PATH.'/public/'.$path.'"></script>';
}

function load_ext_script($path){
  echo '<script type="text/javascript" src="'.$path.'"></script>';
}

//Fungsi untuk membuat menu pada halaman administrator
function create_menu($link, $icon, $title){
  global $url;
  $class = ($link==$url) ? "active" : "";
  echo '<li class="'.$class.'"><a href="'.BASE_PATH.'/'.$link.'"><i class="'.$icon.'"></i> '.$title.'</a></li>';
}

//Fungsi untuk membuat menu dropdown pada halaman administrator
function menu_drop($icon, $title){
  echo '<li class="sidebar-dropdown">
    <a href="#"><i class="'.$icon.'"></i><span> '.$title.'</span></a>
    <div class="sidebar-submenu">
      <ul>';
}
//Fungsi untuk membuat menu anak dropdown pada halaman administrator
function menu_drop_child($link, $title){
  global $url;
  echo  '<li><a href="'.BASE_PATH.'/'.$link.'">'.$title.'</a></li>
        ';
}
//Menutup menu dropdown
function close_menu(){
  echo '</ul>
    </div>
  </li>';
}


//Fungsi untuk membuat garis
function line(){
   echo '<li class="divider"></li>';
}

//Fungsi untuk membuat ikon panel pada dashboard halaman administrator
function create_panel($color, $icon, $number, $text, $url){
  echo '<div class="col-lg-3 col-md-6">
        <div class="panel panel-'.$color.'">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-'.$icon.' fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">'.$number.'</div>
                        <div>'.$text.'</div>
                    </div>
                </div>
            </div>
            <a href="'.$url.'">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>';
}

//Fungsi untuk membuat judul halaman
function create_title($text, $textcolor){
echo'  <div class="row">
    <div class="col-lg-12">
        <h6 class="page-header text-'.$textcolor.'">'.$text.'</h6>
    </div>
</div>';
}

//Fungsi untuk mengawali bagian konten halaman administrator
function start_content(){
  echo '<div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-body">';
}

//Fungsi untuk mengakhiri bagian konten halaman administrator
function end_content(){
  echo '</div></div></div></div>';
}

//Fungsi untuk membuat tombol
function create_button($text, $color, $onclick, $icon, $size='md', $name=''){
  echo '<button class="btn btn-'.$color.' btn-'.$size.'" onclick="'.$onclick.'" id="'.$name.'" name="'.$name.'"><i class="'.$icon.'"></i> '.$text.'</button>';
}

//Fungsi untuk membuat tabel
function create_table($column, $content="", $id=""){
   echo'<div class="mb-2">
   <table id='.$id.' class="table table-sm table-hover table-dark text-muted" width="100%">
   <thead class=""><tr>
   <th style="width: 10px">No</th>';

  foreach($column as $col){
     echo '<th>'.$col.'</th>';
  }

   echo '</tr></thead>
   <tbody>';
   if(is_array($content)){
      foreach($content as $cnt){
    echo '<td>'.$cnt.'</td>';
      }
   }
   echo '</tbody>
   </table>
   </div>';
}

//Fungsi untuk mengawali modal form
function start_modal($id, $action='', $size=''){
  echo '
   <div id="'.$id.'" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
     <div class="modal-dialog '.$size.'">
       <div class="modal-content">
         <form name="form-data" id="form-data" class="form-horizontal" method="post" onsubmit="'.$action.'" enctype="multipart/form-data">

           <div class="modal-header">
             <h4 class="modal-title">Modal Heading</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>

   <div class="modal-body">
      <input type="hidden" name="id" id="id">';
}

//Fungsi untuk mengakhiri modal form
function end_modal($save=true){
  echo '</div>
        <div class="modal-footer">';
  if ($save) {
    echo '<button type="submit" id="FormSubmit" class="btn btn-primary btn-save"> Save </button>';
  }
  echo '
          <button type="button" class="btn btn-warning" data-dismiss="modal"> Close </button>
        </div>
      </form>
    </div>
  </div>
</div>';
}


function end_modalx(){
  echo '</div>
   <div class="modal-footer">
      <button type="button" class="btn btn-warning" data-dismiss="modal">
      <i class="glyphicon glyphicon-remove-sign"></i> Close
    </button>
   </div>
   </form>

         </div>
      </div>
   </div>';
}

//Fungsi untuk membuat kotak input
function form_input($label, $name, $type="text", $placeholder='', $class="", $attr=""){
  echo '
  <div class="form-group">
    <label for="'.$label.'">'.$label.'</label>
    <input type="'.$type.'" class="form-control '.$class.'" id="'.$name.'" placeholder="'.$placeholder.'" name="'.$name.'" '.$attr.'>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
';
}

function form_clock($label, $name, $type="text", $width='5', $class="", $attr=""){
  echo '<div class="form-group">
   <label for="'.$name.'" class="col-sm-2 control-label"> '.$label.'</label>
   <div class="col-sm-'.$width.'">
      <input type="'.$type.'"  class="form-control clockpicker pull'.$class.'" data-align="top"  data-autoclose="true" id="'.$name.'" name="'.$name.'" '.$attr.'>
   </div> </div>';
}

function form_date($label, $name, $type="text", $width='5', $class="", $attr=""){
  echo '<div class="form-group">
   <label for="'.$name.'" class="col-sm-2 control-label"> '.$label.'</label>
   <div class="col-sm-'.$width.'">
      <input type="'.$type.'"  class="form-control datepicker '.$class.'" id="'.$name.'" name="'.$name.'" '.$attr.'>
   </div> </div>';
}

function form_datetime($label, $name, $type="text", $placeholder='', $class="", $attr=""){
  echo '
  <div class="form-group">
    <label for="'.$label.'">'.$label.'</label>
    <div class="input-group date">
      <input type="'.$type.'" class="form-control datetimepicker '.$class.'" id="'.$name.'" placeholder="'.$placeholder.'" name="'.$name.'" '.$attr.'>
      <div class="input-group-append input-group-addon datetimepicker-addon">
        <span class="input-group-text" id="Date"><i class="fas fa-calendar"></i></span>
      </div>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
  </div>
';
}

//Fungsi untuk membuat textarea
function form_textarea($label, $name, $type="text", $row='', $class="", $attr=""){
  echo '
  <div class="form-group">
    <label for="'.$label.'">'.$label.'</label>
    <textarea type="'.$type.'" class="form-control '.$class.'" id="'.$name.'" rows="'.$row.'" name="'.$name.'" '.$attr.'></textarea>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
';
}

//Fungsi untuk membuat combobox / select box
function form_combobox($label, $name, $list, $width='5', $class="", $attr=""){
   echo'<div class="form-group">
   <label for="'.$name.'" class="control-label"> '.$label.'</label>
   <div class="col-sm-'.$width.'">
      <select class="form-control '.$class.'" name="'.$name.'" id="'.$name.'" '.$attr.'>
         <option value="">- Pilih -</option>';
      foreach($list as $key => $val){
         echo '<option value='.$key.'>'.$val.'</option>';
      }
   echo '</select>
   </div> </div>';
}

//Fungsi untuk membuat media picker
function form_mediapicker($label, $nama, $lebar='4', $tipe="0", $modal_id="" ){
  ?>
    <script>
      $(function(){
        $('#filemanager-<?= $nama ?>').on('hidden.bs.modal', function (e) {
          var url = $('#<?= $nama ?>').val();
          $('#<?= $modal_id ?>').modal('show');
          $('#img-<?= $nama ?>').html('<br><img src="<?= BASE_PATH ?>/public/images/thumbs/'+url+'">');
        })
      });
    </script>
  <?php
  echo '<div class="form-group">
      <label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
      <div class="col-sm-'.$lebar.'">
      <div class="input-group">
        <input type="text" class="form-control input-'.$nama.'" id="'.$nama.'" name="'.$nama.'"  readonly>
        <a data-toggle="modal" data-target="#filemanager-'.$nama.'" class="input-group-addon btn btn-primary pilih-'.$nama.'">...</a>
      </div>
      <div id="img-'.$nama.'"></div>
      </div>
    </div>';

  echo '<div class="modal" id="filemanager-'.$nama.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="title" id="myModalLabel">File Manager</h4>
          </div>
          <div class="modal-body">
            <iframe src="'.BASE_PATH.'/public/filemanager/dialog.php?type='.$tipe.'&field_id='.$nama.'&relative_url=1" width="100%" height="400" style="border: 0"></iframe>
          </div>
        </div>
      </div>
    </div>';
}

function start_div($class=''){echo '<div class="'.$class.'">';}

function end_div(){echo '</div>';}

function form_file($label, $name, $placeholder='', $class="", $attr=""){
  echo '
  <div class="form-group">
    <label for="'.$label.'">'.$label.'</label>
    <div class="input-group date">
      <input type="file" class="form-control custom-file-input '.$class.'" id="'.$name.'" name="'.$name.'" '.$attr.'>
      <label class="custom-file-label" for="'.$name.'">'.$placeholder.'</label>
    </div>
    <label class="text-muted"><em id="fileInfo"></em></label>
  </div>
';
}

function start_card($label, $title='', $text='', $class=''){
  echo '
  <div class="card '.$class.'">
    <div class="card-header">
      '.$label.'
    </div>
    <div class="card-body">
      <h5 class="card-title">'.$title.'</h5>
      <p class="card-text">'.$text.'</p>
  ';
}

function end_card(){
  echo '
    </div>
  </div>
  ';
}
