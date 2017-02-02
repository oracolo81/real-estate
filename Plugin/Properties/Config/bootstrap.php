<?php
	$aMenuItems = Configure::read("ADMIN_MENU");
	$aMenuItems[] = array(
						"name" => "properties",
						"title" => "Properties",
						"rank" => "20",
						"url" => "properties/manage",
						"icon" => "fa fa-home fa-fw"
					);
	Configure::write("ADMIN_MENU", $aMenuItems);
?>