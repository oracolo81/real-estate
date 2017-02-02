<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a <?=(strtolower($this->plugin . "/" . $this->name) == "access/control") ? "class='selected'" : "";?> href="/admin/access/control/index"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <?php
                $aMenuItems = Common::sortArray(Configure::read("ADMIN_MENU"), "rank");
                foreach ($aMenuItems as $aItem) { 
                    $class = "";
                    if (strtolower($this->plugin . "/" . $this->name) == $aItem["url"]) $class = "class='selected'";
                    if (strtolower($this->params["controller"] . "/manage") == $aItem["url"]) $class = "class='selected'";
                    if ($this->here == "/admin/markdown-help") $class = "";
                    ?>
                    <li><a <?=$class;?> href="/admin/<?=$aItem["url"];?>"><i class="<?php echo $aItem['icon']; ?>"></i> <?=$aItem["title"];?></a></li>
                <? }
            ?>
            <li><a <?=(strtolower($this->plugin . "/" . $this->name) == "access/password") ? "class='selected'" : "";?> href="/admin/access/password/index"><i class="fa fa-lock fa-fw"></i> Change Password</a></li>
        </ul>
    </div>
</div>