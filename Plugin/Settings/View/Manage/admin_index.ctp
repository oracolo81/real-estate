<?php if (isset($sTitle)) { ?>
    <?php echo $this->element("admin/title", array("title" => $sTitle)); ?>
<?php } ?>
<?php echo $this->element('notices'); ?>
<?php
    if (!empty($settings)) {
        foreach ($settings as $option) {
            if ($option['Settings']['setting_name'] == 'google_analytics') {
                $google_analytics = $option['Settings']['setting_value'];
                $id_google_analytics = $option['Settings']['id'];
            }
            if ($option['Settings']['setting_name'] == 'default_editor') {
                $default_editor = $option['Settings']['setting_value'];
                $id_default_editor = $option['Settings']['id'];
            }
        }
    }
?>
<form action="/admin/settings/manage/save" enctype="multipart/form-data" class="validateForm" role="form" method="post">
    <div class="form-group">
        <?php if (isset($id_google_analytics)) { ?>
            <input type="hidden" value="<?php echo $id_google_analytics; ?>" name="data[Settings][id_google_analytics]" />
        <?php } ?>
        <label class="control-label" for="google_analytics">Google Analytics</label>
        <textarea id="google_analytics" rows='5' placeholder="Paste your code here" class="form-control" name="data[Settings][google_analytics]" data-toggle="tooltip"  data-placement="left" title="Paste your code here"><?php echo isset($google_analytics) ? $google_analytics : ''; ?></textarea>
    </div>
    <div class="form-group">
        <?php if (isset($id_default_editor)) { ?>
            <input type="hidden" value="<?php echo $id_default_editor; ?>" name="data[Settings][id_default_editor]" />
        <?php } ?>
        <label class="control-label" for="default_editor">Editor Markdown: </label><br />
        <input id="default_editor" type="checkbox" name="data[Settings][default_editor]" <?php echo (isset($default_editor) && $default_editor == "markup") ? 'checked' : ''; ?> data-size="mini">
    </div>
    <input type="submit" class="btn btn-success" value="Submit" />
</form>