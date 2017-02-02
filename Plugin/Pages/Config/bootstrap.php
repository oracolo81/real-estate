<?php
    // Add plugin to Admin Menu item
    $aMenuItems = Configure::read("ADMIN_MENU");
    $aMenuItems[] = array(
                            "name" => "pages",
                            "title" => "Pages",
                            "rank" => "30",
                            "url" => "pages/manage",
                            "icon" => "fa fa-files-o"
                    );
    Configure::write("ADMIN_MENU", $aMenuItems);
