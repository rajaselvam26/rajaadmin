<?php 
#PHP DEV__FRAME
ob_start();
session_start(); # START SESSION FOR COMMON DEVFRAME CMS

function admin_is_login(){ $admin = false; global $user; # Check Admin Is Login
    $session = $user->get->admin_status();
	if($session['admin']=='pass'){
		$admin = true;
	}
	return $admin;
}
function display_top_menu(){ # Admin Is Login Means
		inc('frame/admin_is_login');
}
function overlay_menu(){ global $user;
	return array('Menus'=>'Menus&Admin_page=Menus','Pages'=>'Pages&Admin_page=Pages&type=page','Posts'=>'Posts&Admin_page=Posts&type=post','Plugins'=>'Plugins&Admin_page=Plugins','Partition'=>'Partition&Admin_page=themes','Extensions'=>'Extensions&Admin_page=Extension','Settings'=>'Settings&Admin_page=General');
}

?>