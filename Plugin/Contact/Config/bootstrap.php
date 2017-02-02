<?php
    // Add plugin to Admin Menu item
    $aMenuItems = Configure::read("ADMIN_MENU");
    $aMenuItems[] = array(
                            "name" => "contact",
                            "title" => "Contact Details",
                            "rank" => "200",
                            "url" => "contact/manage",
                            "icon" => "fa fa-envelope fa-fw"
                    );
    Configure::write("ADMIN_MENU", $aMenuItems);
?>