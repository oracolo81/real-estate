<?php
	Router::connect('/admin/contact/', array('prefix' => 'admin', 'plugin' => 'contact', 'controller' => 'manage', 'action' => 'index'));
	Router::connect('/admin/contact', array('prefix' => 'admin', 'plugin' => 'contact', 'controller' => 'manage', 'action' => 'index'));

    Router::connect('/contact-us', array('plugin' => 'contact', 'controller' => 'view', 'action' => 'index'));
?>