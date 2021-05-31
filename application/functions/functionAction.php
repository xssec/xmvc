<?php
function create_action($id, $edit=true, $delete=true){
	$button = "";
	if($edit) $button .= '<a class="text-info action" onclick="editForm('.$id.')"><i class="fas fa-edit"></i></a>&nbsp;';
	if($delete) $button .= ' <a class="text-danger action" onclick="deleteData('.$id.')" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-trash"></i></a>';
	return $button;
}

function create_modify($id, $edit=true){
	$button = "";
	if($edit) $button .= '<a class="text-warning action" onclick="editForm('.$id.')"><i class="fas fa-grip-vertical"></i></a>';

	return $button;
}

function empty_var(){
	$button = '<a class="btn btn-default"><i class="fas fa-home"></i></a>';
	return $button;
}
