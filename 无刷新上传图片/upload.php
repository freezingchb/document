<?php
include_once("../../includes/config.inc.php");
include_once("../../includes/class-upload.php");
check_login();
$suserSession=get_suser();
$customer_id=$suserSession['id'];

/**
 * 图片处理程序
 * $upload->upload_form_field 是input[type='file']框的name属性值
 */
if(method_is('post')){
	$upload = new class_upload();
	$upload->upload_form_field= 'imgfile';
	$upload->out_file_dir     = '../../data/image_c/'.$customer_id.'/'.date("Ymd");
	$upload->max_file_size    = 1024*1024*5;//5M
	$upload->make_script_safe = 1;
	$upload->allowed_file_ext = array( 'gif', 'jpg', 'jpeg', 'png');
	$upload->upload_process();
	if($upload->error_no) ajax_feedback(0,$upload->error_no);
	$save_path=str_replace('../../data/image_c/','',$upload->saved_upload_name);
	ajax_feedback(1,array('path'=>$save_path));
}