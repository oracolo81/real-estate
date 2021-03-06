<!DOCTYPE html>
<html lang="en">
    <head>
    <?php echo $this->Html->charset(); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="<?=(!empty($page) && !empty($page["keywords"]))?$page["keywords"]:""?>"/>
    <meta name="description" content="<?=(!empty($page) && !empty($page["description"]))?$page["description"]:""?>"/>
    <meta name="author" content="Carmelo Cutrera" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=(!empty($page)) ? $page['browser_title'] : $title_for_layout; ?></title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('bootstrap.min.css');
    echo $this->Html->css('font-awesome.min.css');
    echo $this->Html->css('style.css');
    echo $this->Html->css('responsive.css');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body id="top">
        <?php echo $this->element("navbar"); ?>
        <div class="container">
            <?php echo $this->Session->flash(); ?>
        </div>
        <?php echo $this->fetch('content'); ?>
        <?php echo $this->element("footerbar"); ?>
        <script type="text/javascript">
            /* Used in script.js */
            var slides_url = "<?php echo $this->Html->url('/img/slides/'); ?>";
        </script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
        <?php
        echo $this->Html->script('jquery.min.js');
        echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->script('jquery.easing.js');
        echo $this->Html->script('jquery.jcarousel.min.js');
        echo $this->Html->script('imagesloaded.pkgd.min.js');
        echo $this->Html->script('masonry.pkgd.min.js');
        echo $this->Html->script('jquery.backstretch.js');
        echo $this->Html->script('jquery.nicescroll.min.js');
        echo $this->Html->script('gmap3.min.js');
        echo $this->Html->script('script.js');
        echo $this->Html->script('frontend.js');

        ?>
        <?=(!empty($googleAnalytics)) ? $googleAnalytics : '' ; ?>
    </body>
</html>

