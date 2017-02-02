<? if (isset($sTitle)) { ?>
	<?php echo $this->element("admin/title", array("title" => $sTitle)); ?>
<? } ?>
<?php echo $this->element('notices'); ?>
<form action="/admin/access/password/save" class="validateForm" role="form" method="post">
    <div class="form-group">
        <label for="currentpassword">Current Password</label>
        <input id="currentpassword" class="form-control" name="data[AdminUser][currentpassword]" type="password" data-toggle="tooltip"  data-placement="left" title="Write the old password" autofocus required />
    </div>
    <div class="form-group">
        <label for="newpassword">New Password</label>
        <input id="newpassword" class="form-control" name="data[AdminUser][newpassword]" type="password" data-toggle="tooltip"  data-placement="left" title="Write the new password" required />
    </div>
    <div class="form-group">
        <label for="confirmpassword">Confirm Password</label>
        <input id="confirmpassword" class="form-control" name="data[AdminUser][confirmpassword]" type="password" data-toggle="tooltip"  data-placement="left" title="Repeat the new password" required />
    </div>
    <input type="submit" class="btn btn-success" value="Submit" />
</form>