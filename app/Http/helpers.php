<?php

/*
|--------------------------------------------------------
| All useful helper function
|--------------------------------------------------------
|
| 
| Author : Juman
| Version : 1.0.0
|
*/

/**
 * Date format function.
 *
 * @param  $date
 * @return formated date
 */
function changeDateFormate($date){
	return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format(\Session::get('dateFormat'));	
}


/**
 * Image path function.
 *
 * @param  $image_name
 * @return all path for image with $image_name
 */
function imagePath($image_name)
{
	return public_path('frontEnd/images/'.$image_name);
}


/**
 * Check page is enable or disable
 *
 * @param  $datas
 * @param  $methodName
 * @return ture/false
 */
function checkPage($datas,$methodName){

	if($methodName=='menu'){
		if($datas->menu_page_status == 'enable'){
			return 'true';
		}else{
			return 'false';
		}
	}
	
	if($methodName=='gallery'){
		if($datas->gallery_page_status == 'enable'){
			return 'true';
		}else{
			return 'false';
		}
	}
	
	if($methodName=='contact'){
		if($datas->contact_page_status == 'enable'){
			return 'true';
		}else{
			return 'false';
		}
	}
	
	if($methodName=='book_table'){
		if($datas->table_book_status == 'enable'){
			return 'true';
		}else{
			return 'false';
		}
	}
	
	if($methodName=='privacy'){
		if($datas->privacy_page_status == 'enable'){
			return 'true';
		}else{
			return 'false';
		}
	}
	
	if($methodName=='terms'){
		if($datas->terms_page_status == 'enable'){
			return 'true';
		}else{
			return 'false';
		}
	}
	
	if($methodName=='menu_file'){
		if($datas->menu_file_status == 'enable'){
			return 'true';
		}else{
			return 'false';
		}
	}
}

// function creator($creator_id){
// 	$users = Registration::find($creator_id);
// 	return ($users->name) ? $users->name : $users->username;
// }

