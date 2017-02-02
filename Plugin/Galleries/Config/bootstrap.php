<?php
    // Add plugin to Admin Menu item
    $aMenuItems = Configure::read("ADMIN_MENU");
    $aMenuItems[] = array(
                            "name" => "galleries",
                            "title" => "Galleries",
                            "rank" => "200",
                            "url" => "galleries/manage",
                            "icon" => "fa fa-picture-o fa-fw"
                    );
    Configure::write("ADMIN_MENU", $aMenuItems);
?>