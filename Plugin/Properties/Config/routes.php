<?php
	Router::connect('/properties', array('plugin' => 'properties', 'controller' => 'view', 'action' => 'index'));
	Router::connect('/properties/:id/:slug', array('plugin' => 'properties', 'controller' => 'view', 'action' => 'detail'), array("pass" => array("id", "slug")));

	Router::connect('/admin/properties/', array('prefix' => 'admin', 'plugin' => 'properties', 'controller' => 'manage', 'action' => 'index'));
	Router::connect('/admin/properties', array('prefix' => 'admin', 'plugin' => 'properties', 'controller' => 'manage', 'action' => 'index'));
?>