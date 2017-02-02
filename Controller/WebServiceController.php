<?php
/**
 * API.
 */
App::uses('CakeEmail', 'Network/Email');

class WebServiceController extends AppController
{
    public $uses = array("Gallery", "Notification", "Contact");
    public $components = array("RequestHandler");

    private $errors = null;

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function galleries()
    {
        $itemsPerPage = 2;
        if ($this->request->isGet()) {
            $path_file = "/Galleries/img/";
            $path_thumb = "/Galleries/img/thumb/";
            if(!empty($this->request->query["page"])) {
                $start = $this->request->query["page"];
            } else {
                $start = 1;
            }
            $offset = ($start * $itemsPerPage) - $itemsPerPage;
            $results = $this->Gallery->find('all', array('order' => array('created' => 'DESC'), 'limit' => $itemsPerPage, 'offset' => $offset));
            if (empty($results)) {
                $this->setJsonReturn(false);
            } else {
                $this->setJsonReturn(true, $results);
            }
        }
    }

    public function notifications()
    {
        $itemsPerPage = 2;
        if ($this->request->isGet()) {
            if(!empty($this->request->query["page"])) {
                $start = $this->request->query["page"];
            } else {
                $start = 1;
            }
            $offset = ($start * $itemsPerPage) - $itemsPerPage;
            $results = $this->Notification->find('all', array('conditions' => array('is_published' => true), 'order' => array('published_date' => 'DESC'), 'limit' => $itemsPerPage, 'offset' => $offset));
            if (empty($results)) {
                $this->setJsonReturn(false);
            } else {
                $this->setJsonReturn(true, $results);
            }
        }
    }

    public function complaint()
    {
        if($this->request->isPost()) { 
            if(!empty($this->request->data["image"])) {
                $aimage = $this->request->data["image"];
            }
            $contactDetails = $this->Contact->find('first', array('fields' => array('email')));

            $fromEmail = Configure::read("contactform.from_email");
            $email = new CakeEmail();
            $email->config('smtp');
            $email->from(array($fromEmail => $this->request->data['name'] . " " . $this->request->data['surname']));
            $email->replyTo($this->request->data['email']);
            $email->to($contactDetails);
            $email->subject("Website contact form");

            if ($email->send()) {
                $this->setJsonReturn(true);
            } else {
                $this->setJsonReturn(false);
            }
            $this->setJsonReturn(true);
        } else {
            throw new BadRequestException();
        }
    }

    
    protected function setJsonReturn($success, $result = null)
    {
        $this->set(array(
            'success' => $success,
            'error' => $this->errors,
            'result' => $result,
            '_serialize' => array('success','error','result')
        ));
    }

    protected function addError($message, $code = null)
    {
        if($this->errors == null)
        {
            $this->errors = array();
        }
        $this->errors[] = array('message' => $message, 'code' => $code);
    }

}