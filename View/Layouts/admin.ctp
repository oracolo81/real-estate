<?php $type_editor = Configure::read('type_editor');?>
<?php header('Content-type: text/html; charset=UTF-8'); ?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo $title_for_layout; ?></title>
        <?php
            echo $this->Html->meta('icon');
            echo $this->fetch('meta');

            echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css');
            echo $this->Html->css('font-awesome.min.css');
            echo $this->Html->css('plugins/tipTip.css?='.filemtime("css/plugins/tipTip.css"));
            if ($type_editor == 'markup') echo $this->Html->css('plugins/bootstrap-markdown.min.css');
            echo $this->Html->css('plugins/dataTables.bootstrap.css?='.filemtime("css/plugins/dataTables.bootstrap.css"));
            echo $this->Html->css('plugins/datepicker.css?='.filemtime("css/plugins/datepicker.css"));
            echo $this->Html->css('plugins/bootstrap-switch.min.css');
            echo $this->Html->css('admin-theme.css?='.filemtime("css/admin-theme.css"));
            echo $this->fetch('css');
        ?>
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/admin/access/control"><?= Configure::read("WEBSITENAME") ?> Admin</a>
                </div>

                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="mailto:carmelo_@hotmail.it">
                            <i class="fa fa-support"></i> Support
                        </a>
                    </li>
                    <li>
                        <a title="View Website" target="_blank" href="http://<?=$_SERVER["HTTP_HOST"]?>">
                            <i class="fa fa-search-plus"></i> View Website
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="/admin/access/control/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                </ul>
                <?php echo $this->element("admin/menu"); ?>
            </nav>
            <div id="page-wrapper">
                <?php echo $content_for_layout ?>
            </div>
        </div>
        <?php echo $this->element('multiple_delete'); ?>

        <?php
            echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js');
            echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js');
            echo $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js');
            echo $this->Html->script('//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js');
            if ($type_editor == 'markup') {
                echo $this->Html->script('bootstrap-markdown/js/bootstrap-markdown.js');
            } else {
                echo $this->Html->script('ckeditor/ckeditor.js');
                echo $this->Html->script('ckeditor/adapters/jquery.js');
            }
            echo $this->Html->script('dataTables/jquery.dataTables.js');
            echo $this->Html->script('dataTables/dataTables.bootstrap.js');
            echo $this->Html->script('bootstrap-datepicker.js');
            echo $this->Html->script('bootbox/bootbox.min.js');
            echo $this->Html->script('bootstrap-switch/bootstrap-switch.min.js');
            echo $this->Html->script('admin.js?='.filemtime("js/admin.js"));
            echo $this->Html->script('maps.js');
            echo $this->fetch('script');
        ?>
    </body>
</html>