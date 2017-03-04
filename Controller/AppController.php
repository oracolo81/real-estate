<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    const REC_STATUS_DELETED = 0;
    const REC_STATUS_ACTIVE = 1;

    public $components = array("Auth", "Cookie", "Session");

    public $uses = array(
        "Contact",
        "Pages.Page",
        "Settings",
        "Properties.AdvertType",
        "Properties.PropertyCategory",
        "Properties.PropertyType",
        "Properties.LocalCouncil"
    );
    
    public $helpers = array('Html' => array('className' => 'MyHtml'));

    public function beforeFilter()
    {
        $this->_setLanguage();

        $settings = $this->Settings->find('all');
        $googleAnalytics = "";
        if (!empty($settings)) {
            foreach ($settings as $option) {
                if ($option['Settings']['setting_name'] == 'default_editor') {
                    Configure::write('type_editor', $option['Settings']['setting_value']);
                }
                if ($option['Settings']['setting_name'] == 'google_analytics') {
                    $googleAnalytics = $option['Settings']['setting_value'];
                }
            }
        }
        $this->set("controller", $this->params["controller"]);
        $this->set("action", $this->params["action"]);
       
        // setting login url, logout url & database table for Admin authentication
        if (isset($this->request->params["prefix"]) && $this->request->params["prefix"] == "admin") {
            AuthComponent::$sessionKey = "Auth.AdminUser";
            $this->Auth->loginAction = array('plugin' => 'access', 'controller' => 'control', 'action' => 'index');
            $this->Auth->loginRedirect = array('plugin' => 'access', 'controller' => 'control', 'action' => 'index');
            $this->Auth->logoutRedirect = array('plugin' => 'access', 'controller' => 'control', 'action' => 'index');
            $this->Auth->authenticate = array(
                AuthComponent::ALL => array('userModel' => 'AdminUser'),
                'Form'
            );
        } else {
            if ($googleAnalytics != "") {
                $this->set("googleAnalytics", $googleAnalytics);
            }
            $this->set("contactInfo", $this->Contact->find('first'));
        }

        $cacheBreaker = Configure::read("CACHE_BREAKER");
        if (empty($cacheBreaker)) {
            $cacheBreaker = 1;
        }
        $this->set("cacheBreaker", $cacheBreaker);
    }

    public function addDangerMessage($message)
    {
        $this->Session->setFlash($message, "bootstrap_danger", array(), "danger");
    }

    public function addWarningMessage($message)
    {
        $this->Session->setFlash($message, "bootstrap_warning", array(), "warning");
    }

    public function addInfoMessage($message)
    {
        $this->Session->setFlash($message, "bootstrap_info", array(), "info");
    }

    public function addSuccessMessage($message)
    {
        $this->Session->setFlash($message, "bootstrap_success", array(), "success");
    }

    private function _setLanguage() 
    {
        //if the cookie was previously set, and Config.language has not been set
        //write the Config.language with the value from the Cookie
        if ($this->Cookie->read('lang') && !$this->Session->check('Config.language')) {
            $this->Session->write('Config.language', $this->Cookie->read('lang'));
        } else if (isset($this->params['language']) && ($this->params['language'] != $this->Session->read('Config.language'))) {
            //then update the value in Session and the one in Cookie
            $this->Session->write('Config.language', $this->params['language']);
            $this->Cookie->write('lang', $this->params['language'], false, '20 days');
        }
    }

    //override redirect
    public function redirect($url, $status = null, $exit = true) {
        if (is_array($url)) {
            if (!isset($url['language']) && $this->Session->check('Config.language')) {
                $url['language'] = $this->Session->read('Config.language');
            }
        }
        parent::redirect($url,$status,$exit);
    }

    protected function getAdvertTypes()
    {
        return $this->AdvertType->find("list", array(
            "order" => array(
                "AdvertType.id" => "ASC"
            )
        ));
    }

    protected function getPropertyCategories()
    {
        return $this->PropertyCategory->find("list", array(
            "order" => array(
                "PropertyCategory.id" => "ASC"
            )
        ));
    }

    protected function getPropertyTypes()
    {
        return $this->PropertyType->find("all", array(
            "order" => array(
                "PropertyType.name" => "ASC"
            )
        ));
    }

    protected function getLocations()
    {
        $locations = $this->LocalCouncil->find("all", array(
            'conditions' => array(
                'LocalCouncil.province_id' => 86
            ),
            "fields" => array(
                "LocalCouncil.id",
                "LocalCouncil.nome"
            ),
            "order" => array(
                "LocalCouncil.nome" => "ASC"
            )
        ));
        return $locations;
    }
}
