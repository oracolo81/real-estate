<?php
    // Add plugin to Admin Menu item
    $aMenuItems = Configure::read("ADMIN_MENU");
    $aMenuItems[] = array(
                            "name" => "notifications",
                            "title" => "Notifications",
                            "rank" => "30",
                            "url" => "notifications/manage",
                            "icon" => "fa fa-newspaper-o fa-fw"
                    );
    Configure::write("ADMIN_MENU", $aMenuItems);
