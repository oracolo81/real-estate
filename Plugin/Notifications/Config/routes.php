<?php	
	Router::connect('/admin/notifications/', array('prefix' => 'admin', 'plugin' => 'notifications', 'controller' => 'manage', 'action' => 'index'));
	Router::connect('/admin/notifications', array('prefix' => 'admin', 'plugin' => 'notifications', 'controller' => 'manage', 'action' => 'index'));
?>