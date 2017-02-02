<?php
App::uses('CakeEmail', 'Network/Email');

class ContactController extends AppController
{
    public $uses = array("Contact", "Pages.Page");
    public $components = array('Pages');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
        $this->layout = "default";
        $this->Pages->setPageData($this, "Contact us");
    }

    protected function getCaptcha()
    {

        $captcha = new Captcha\Captcha();
        $captcha->setPublicKey(Configure::read("recaptcha.public_key"));
        $captcha->setPrivateKey(Configure::read("recaptcha.private_key"));
        $captcha->setTheme("clean");
        return $captcha;
    }


    public function index()
    {
        if ($this->Session->check('formData')) {
            $this->set("formData", $this->Session->read('formData'));
        }
        $this->set("captcha", $this->getCaptcha());
        $this->set("contactDetails", $this->Contact->find('first'));
        $this->Session->delete('formData');
    }

    public function send()
    {

        if ($this->request->is('post')) {
            if ($this->getCaptcha()->check()->isValid()) {
                $contactDetails = $this->Contact->find('first')['Contact']['email'];

                $fromEmail = Configure::read("contactform.from_email");
                $email = new CakeEmail();
                $email->config('smtp');
                $email->from(array($fromEmail => $this->request->data['name'] . " " . $this->request->data['surname']));
                $email->replyTo($this->request->data['email']);
                $email->to($contactDetails);
                $email->subject("Website contact form");

                if ($email->send($this->request->data['message'])) {
                    $this->addSuccessMessage("Your enquiry has been sent - we will get back to you soon!");
                } else {
                    $this->addDangerMessage("An error occurred when trying to send your enquiry - please try again");
                }
            } else {
                $this->Session->write('formData', $this->request->data);
                $this->addDangerMessage("The text did not match! Please try again. ");
            }

            $this->redirect('/contactus');
        } else {
            $this->redirect('/contactus');
        }
    }
}
