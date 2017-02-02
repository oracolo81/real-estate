<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/:language/:controller/:action/*', array(), array('language' => '[a-z]{3}'));

	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
	Router::connect('/home', array('controller' => 'pages', 'action' => 'home'));
	Router::connect('/:language/', array('controller' => 'pages', 'action' => 'home'), array('language' => 'eng|ita'));
	Router::connect('/contact', array('controller' => 'contact', 'action' => 'index'));
	Router::connect('/about', array('controller' => 'pages', 'action' => 'display', array('name' => 'about')));
	Router::connect('/contact/send', array('controller' => 'contact', 'action' => 'send'));
	
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/:language/pages/*', array('controller' => 'pages', 'action' => 'display'), array('language' => 'eng|ita'));
	Router::connect('/:language/', array('controller' => 'pages', 'action' => 'display', 'home'), array('language' => 'eng|ita'));
	Router::connect('/properties', array('plugin' => 'properties', 'controller' => 'view', 'action' => 'index'));
	Router::connect('/properties/search', array('plugin' => 'properties', 'controller' => 'view', 'action' => 'search'));
	Router::connect('/properties/:id/:slug', array('plugin' => 'properties', 'controller' => 'view', 'action' => 'detail'), array("pass" => array("id", "slug"), 'id' => '[0-9]+'));
	Router::connect('/search/*', array('plugin' => 'properties', 'controller' => 'view', 'action' => 'index'));
	
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	Router::parseExtensions('json');
	
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
