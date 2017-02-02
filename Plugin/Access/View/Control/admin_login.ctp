
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                	<h1 class="panel-title"><?= Configure::read("WEBSITENAME") ?> Admin Login</h1>
                </div>
                <div class="panel-body">
                	<?php echo $this->element('notices'); ?>
                   <form role="form" action="/admin/access/control/login" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control input-lg" placeholder="Username" name="data[AdminUser][username]" type="text" autofocus required>
                        </div>
                        <div class="form-group">
                            <input class="form-control input-lg" placeholder="Password" name="data[AdminUser][password]" type="password" required>
                        </div>
                        <input type="submit" class="btn btn-success" value="Login" />
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</div>