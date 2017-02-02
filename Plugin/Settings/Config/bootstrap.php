<?php
    // Add plugin to Admin Menu item
    $aMenuItems = Configure::read("ADMIN_MENU");
    $aMenuItems[] = array(
                            "name" => "settings",
                            "title" => "Settings Page",
                            "rank" => "300",
                            "url" => "settings/manage",
                            "icon" => "fa fa-sliders fa-fw fa-rotate-90"
                    );
    Configure::write("ADMIN_MENU", $aMenuItems);
?>