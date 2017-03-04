<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-top">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> 
            <a class="navbar-brand" href="<?=$this->Html->url('/');?>">
                <?=$this->Html->image('/img/logo.png', array('class' => 'img-responsive', 'alt' => 'Logo'));?>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-top">
            <ul class="nav navbar-nav navbar-right">
                <li <?= (!empty($page) && $page['custom_link'] == "home") ? 'class="active"' : ''; ?>><a href="<?=$this->Html->url('/');?>"><?php echo __("Home");?></a></li>
                <li <?= (!empty($page) && $page['custom_link'] == "properties") ? 'class="active"' : ''; ?>><a href="<?=$this->Html->url('/properties');?>"><?php echo __("Properties");?></a></li>
                <li <?= (!empty($page) && $page['custom_link'] == "contact") ? 'class="active"' : ''; ?>><a href="<?=$this->Html->url('/contact-us');?>"><?php echo __("Contacts");?></a></li> 
                <li>
                    <?php if ($this->Session->read('Config.language') == 'eng') { ?>
                        <?=$this->Html->link($this->Html->image('/img/it.png') .' '. __("Ita"), array('language' => 'ita'), array('class' => 'lang', 'escape' => false));?>
                    <?php } else { ?>
                        <?=$this->Html->link($this->Html->image('/img/gb.png') .' '. __("Eng"), array('language' => 'eng'), array('class' => 'lang', 'escape' => false));?>
                    <?php } ?>
                </li>    
            </ul>
        </div>
    </div>
</nav>
