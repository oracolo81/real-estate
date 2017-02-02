<?php	
	Router::connect('/admin/pages/', array('prefix' => 'admin', 'plugin' => 'pages', 'controller' => 'manage', 'action' => 'index'));
	Router::connect('/admin/pages', array('prefix' => 'admin', 'plugin' => 'pages', 'controller' => 'manage', 'action' => 'index'));
	Router::connect('/admin/markdown-help', array('prefix' => 'admin', 'plugin' => 'pages', 'controller' => 'manage', 'action' => 'markdown_help'));
?>