<?php
class ManageController extends ContactAppController
{   
    
    var $uses = array("Contact");

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = "admin";
        $this->set("title_for_layout", "Contact");
        $this->set("sTitle", '<i class="fa fa-envelope fa-fw"></i> Contact');
    }

    function admin_index()
    {
        $contactDetails = $this->Contact->find('first');
        if (!empty($contactDetails)) {
            $this->set("sTitle", '<i class="fa fa-envelope fa-fw"></i> Contact Details');
            $this->set("contactItem", $contactDetails);
        }
    }
    
    function admin_save()
    {
        $this->Contact->create();
        $this->Contact->set($this->request['data']);

        // save
        if ($this->Contact->save()) {
            if (isset($this->request['data']['Contact']['id'])) {
                $this->addSuccessMessage("Contact details updated successfully");
            }
        } else {
            $this->addDangerMessage("An error occured when saving record");
        }

        $this->redirect('index');
    }
    
    function admin_delete($id)
    {
        if ($this->Contact->delete($id)) {
            $this->addSuccessMessage("Contact details deleted successfully");
        } else {
            $this->addDangerMessage("An error occured when deleting record");
        }
        $this->redirect('index');
    }   
}
?>