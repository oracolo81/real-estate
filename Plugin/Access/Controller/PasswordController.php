<?php
class PasswordController extends AccessAppController {

	var $name = 'Password';
	var $uses = array('Access.AdminUser');
	var $components = array('Email');	
		
	function beforeFilter(){
		parent::beforeFilter();
		$this->layout = "admin";
		$this->set("title_for_layout", "Change Password");
		$this->set("sTitle", '<i class="fa fa-lock fa-fw"></i> Change Password');
	}
		
	function admin_index()
	{	
	}
	
	function admin_save()
	{
		if ($this->request->isPost()) {
			$aUser = $this->AdminUser->find('first', array("conditions" => array("id" => $this->Auth->User("id"), "password" => $this->Auth->password($this->request['data']['AdminUser']['currentpassword']))));
						
			if(!empty($aUser)){
				$code = md5($aUser["AdminUser"]["username"] . $aUser["AdminUser"]["password"]);
				$email = new CakeEmail("smtp");
				$email->from(array("no-reply@preeostudios.com" => Configure::read("WEBSITENAME")));
				$email->to($aUser["AdminUser"]["email"]);
				$email->subject(Configure::read("WEBSITENAME") . " change password");
				$email->emailFormat("html");
				$email->template("Access.adminpasswordreset");
				$email->viewVars(array("code" => $code));
				$email->send();
				
				$this->AdminUser->id = $this->Auth->User("id");
				$this->AdminUser->set(array("temp_password" => $this->Auth->password($this->request->data["AdminUser"]["newpassword"]), "verification_code" => $code));
				$this->AdminUser->save();
				
				$this->Session->setFlash("An email has been sent to <b>" . $aUser["AdminUser"]["email"] . "</b>. Click the link in the email to confirm password change.", 'bootstrap_info', array(), 'info');
			} else {
				$this->Session->setFlash("Incorrect current password. Please try again.", 'bootstrap_danger', array(), 'danger');
			}
		}
		
		$this->redirect("index");
		
	}
	
	function admin_confirm()
	{		
		$code = $this->params["named"]["c"];
		$aUser = $this->AdminUser->find('first', array('conditions' => array('verification_code' => $code)));
		if(!empty($aUser))
		{
			$this->AdminUser->id = $this->Auth->User("id");
			$this->AdminUser->set(array("password" => $aUser["AdminUser"]["temp_password"], "temp_password" => "", "verification_code" => ""));	
			if($this->AdminUser->save()){		
				$this->Session->setFlash("Your admin account password has been updated. Please login.", 'bootstrap_success', array(), 'success');
				$this->redirect($this->Auth->logout());
			} else {
				$this->Session->setFlash("Operation failed. Kindly contact PreeoStudios.com for further assistance.", "bootstrap_warning", array(), 'warning');
				$this->redirect("index");
			}
		}
		else{
			$this->Session->setFlash("Operation failed. Kindly contact PreeoStudios.com for further assistance.", "bootstrap_warning", array(), 'warning');
			$this->redirect("index");
		}
	}
	
	function admin_decline()
	{
		$code = $this->params["named"]["c"];
		$aUser = $this->AdminUser->find('first', array('conditions' => array('verification_code' => $code)));
		if(!empty($aUser))
		{
			$sNewPassword = Common::generateRandomString(8);
			$email = new CakeEmail("smtp");
			$email->from(array("no-reply@preeostudios.com" => Configure::read("WEBSITENAME")));
			$email->to($aUser["AdminUser"]["email"]);
			$email->subject(Configure::read("WEBSITENAME") . " new password");
			$email->emailFormat("html");
			$email->template("Access.resetpasswordemail");
			$email->viewVars(array("password" => $sNewPassword));
			$email->send();
			
			$this->AdminUser->id = $this->Auth->User("id");
			$this->AdminUser->set(array("password" => $this->Auth->password($sNewPassword), "temp_password" => "", "verification_code" => ""));
			
			if($this->AdminUser->save()){
				$this->addInfoMessage("Your password has been reset. An email has been sent to " . $aUser["AdminUser"]["email"] . " with the new password.");
				$this->redirect($this->Auth->logout());
			} else {
				$this->addWarningMessage("Operation failed. Kindly contact PreeoStudios.com for further assistance.");
				$this->redirect("index");
			}
		}
		else
		{
			$this->addWarningMessage("Operation failed. Kindly contact PreeoStudios.com for further assistance.");
			$this->redirect("index");
		}
	}
}
?>