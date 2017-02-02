<?php
	Router::connect('/admin/access/', array('prefix' => 'admin', 'plugin' => 'access', 'controller' => 'control', 'action' => 'index'));
	Router::connect('/admin/access/', array('prefix' => 'admin', 'plugin' => 'access', 'controller' => 'control', 'action' => 'index'));
	Router::connect('/admin/', array('prefix' => 'admin', 'plugin' => 'access', 'controller' => 'control', 'action' => 'index'));
	Router::connect('/admin', array('prefix' => 'admin', 'plugin' => 'access', 'controller' => 'control', 'action' => 'index'));
	Router::connect('/admin/login', array('prefix' => 'admin', 'plugin' => 'access', 'controller' => 'control', 'action' => 'index'));
?>