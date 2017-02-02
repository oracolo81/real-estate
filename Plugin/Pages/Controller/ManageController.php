<?php

class ManageController extends PagesAppController
{

    var $uses = array("Pages.Page");

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = "admin";
        $this->set("title_for_layout", "Pages");
        $this->set("sTitle", '<i class="fa fa-files-o fa-fw"></i> Pages');
    }

    public function admin_index()
    {
        $hardcodedPages = array("Home", "Contact us");
        $this->set("pages", $this->Page->find('all'));
        $this->set("hardcodedPages", $hardcodedPages); 
    }
    
    public function admin_detail($id = "")
    {
        if (!empty($id)) {
            $this->set("sTitle", '<i class="fa fa-file-o fa-fw"></i> Edit Page');
            $this->set("pageDetails", $this->Page->findById($id));
        } else {
            $this->set("sTitle", '<i class="fa fa-file-o fa-fw"></i> Add Page');
        }
    }

    public function admin_save()
    {
        if($this->request->is('post')) {
            $postData = $this->request['data'];
            $this->Page->create();
            $this->Page->set($postData);
            if ($this->Page->save()) {
                if(isset($postData['Page']['id'])) {
                    $this->addSuccessMessage("Page updated successfully");
                } else {
                    $this->addSuccessMessage("Page created successfully");
                }
            } else {
                $this->addDangerMessage("An error occured when saving!");
            }
            $this->redirect('index');
        }
    }

    public function admin_delete($id)
    {
        if ($this->Page->delete($id)) {
            $this->addSuccessMessage("Page has been deleted successfully");
        } else {
            $this->addDangerMessage("An error occured when deleting page");
        }
        $this->redirect('index');
    }

    public function admin_delete_multiple($ids)
    {
        $flag_error = false;
        $ids = json_decode(str_replace('\\', '', $ids));
        foreach ($ids as $id) {
            if (!$this->Page->delete($id)) {
                $flag_error = true;
            }
        }
        if ($flag_error) {
            $this->addDangerMessage("An error occured when deleting pages");
        } else {
            $this->addSuccessMessage("Pages has been deleted successfully");
        }
        $this->redirect('index');
    }

    public function admin_markdown_help()
    {
        $this->set("sTitle", '<i class="fa fa-info fa-fw"></i> Markdown Help');
    }
}
