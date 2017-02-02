<?php
class ControlController extends AccessAppController {
    public $components = array("Auth");
    public $uses = array("AdminUser", "Page", 'Property', 'Gallery');

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow();
    }
    
    function admin_index()
    {
        if ($this->Auth->loggedIn()) {
            $this->layout = "admin";
            $this->set("pagesCount", $this->Page->find('count'));
            $this->set("propertiesCount", $this->Property->find('count'));
            $this->set("galleriesCount", $this->Gallery->find('count'));
        } else {
            $this->layout = "adminlogin";
            $this->render("admin_login");
        }
    }
        
    function admin_logout() 
    {
        $this->redirect($this->Auth->logout());
    }
    
    function admin_login(){
        $this->layout = "adminlogin";

        if ($this->request->isPost()) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash("Incorrect username or password", 'bootstrap_danger', array(), 'danger');
            }
        }
    }
}
?>