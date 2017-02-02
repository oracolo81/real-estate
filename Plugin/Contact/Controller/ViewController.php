<?php
App::uses('CakeEmail', 'Network/Email');

class ViewController extends ContactAppController
{   
    
    var $uses = array("Contact", "Page");

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index()
    {
        $contactDetails = $this->Contact->find('first');
        $this->set("contactDetails", $contactDetails);
        $page = $this->Page->findByName('Contact us');
        $this->set("page", $page['Page']);
    }
    
    public function send()
    {
        if ($this->request->is('post')) {
            $contactDetails = $this->Contact->find('first');
            
            $email = new CakeEmail();
            $email->config('smtp');
            $email->from(array('noreply@equiptradeintl.com' => $this->request->data['firstname'] . " " . $this->request->data['lastname']));
            $email->replyTo($this->request->data['emailaddress']);
            $email->to($contactDetails['Contact']['email']);
            $email->subject("Equiptrade International - Website Contact Form");
            if ($email->send($this->request->data['message'])) {
                $this->addSuccessMessage("Your enquiry has been sent - we will get back to you soon!");
            } else {
                $this->addDangerMessage("An error occurred when trying to send your enquiry - please try again");
            }

            $this->redirect('/contact-us');
        } else {
            $this->redirect('/contact-us');
        }
    }
}
?>