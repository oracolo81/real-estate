<?php

class ManageController extends NotificationsAppController
{

    var $uses = array("Notification");

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->layout = "admin";
        $this->set("title_for_layout", "Notifications");
        $this->set("sTitle", '<i class="fa fa-newspaper-o fa-fw"></i> Notifications');
    }

    public function admin_index()
    {
        $this->set("notifications", $this->Notification->find('all'));
    }
    
    public function admin_detail($id = "")
    {
        if (!empty($id)) {
            $this->set("sTitle", '<i class="fa fa-newspaper-o fa-fw"></i> Edit Notifications');
            $this->set("notificationDetails", $this->Notification->findById($id));
        } else {
            $this->set("sTitle", '<i class="fa fa-newspaper-o fa-fw"></i> Add Notifications');
        }
    }

    public function admin_save()
    {
        if($this->request->is('post')) {
            $postData = $this->request['data'];
            $this->Notification->create();
            $this->Notification->set($postData);
            $this->Notification->set('is_published', false);
            if ($this->Notification->save()) {
                if(isset($postData['Notification']['id'])) {
                    $this->addSuccessMessage("Notification updated successfully");
                } else {
                    $this->addSuccessMessage("Notification created successfully");
                }
            } else {
                $this->addDangerMessage("An error occured when saving!");
            }
            $this->redirect('index');
        }
    }

    public function admin_publish($id)
    {
        if ($id != null) {
            $this->Notification->create();
            $this->Notification->id = $id;
            $this->Notification->set('is_published', true);
            $this->Notification->set('published_date', date("Y-m-d H:i:s"));
            if ($this->Notification->save()) {
                $this->addSuccessMessage("Notification updated successfully");
            } else {
                $this->addDangerMessage("An error occured when saving!");
            }
        }
        $this->redirect('index');
    }

    public function admin_delete($id)
    {
        if ($this->Notification->delete($id)) {
            $this->addSuccessMessage("Notification has been deleted successfully");
        } else {
            $this->addDangerMessage("An error occured when deleting notification");
        }
        $this->redirect('index');
    }

    public function admin_delete_multiple($ids)
    {
        $flag_error = false;
        $ids = json_decode(str_replace('\\', '', $ids));
        foreach ($ids as $id) {
            if (!$this->Notification->delete($id)) {
                $flag_error = true;
            }
        }
        if ($flag_error) {
            $this->addDangerMessage("An error occured when deleting notifications");
        } else {
            $this->addSuccessMessage("Notifications has been deleted successfully");
        }
        $this->redirect('index');
    }

    public function admin_markdown_help()
    {
        $this->set("sTitle", '<i class="fa fa-info fa-fw"></i> Markdown Help');
    }
}
