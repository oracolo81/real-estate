<?php
	Router::connect('/admin/settings/', array('prefix' => 'admin', 'plugin' => 'settings', 'controller' => 'manage', 'action' => 'index'));
	Router::connect('/admin/settings', array('prefix' => 'admin', 'plugin' => 'settings', 'controller' => 'manage', 'action' => 'index'));
?>