<?php if (isset($sTitle)) {
    echo $this->element("admin/title", array("title" => $sTitle));
    echo $this->element('notices'); 
}
if(!empty($notificationDetails)) {
    $custom_link = strtolower(Inflector::slug($notificationDetails['Notification']['title'], '-'));
}
$type_editor = Configure::read('type_editor');
?>
<form action="/admin/notifications/manage/save" enctype="multipart/form-data" class="validateForm" role="form" method="post" autocomplete=off>
<?php if (isset($notificationDetails)) { ?>
    <input type="hidden" value="<?=$notificationDetails["Notification"]['id']; ?>" name="data[Notification][id]" />
    <label class="control-label" for="title">URL</label>
    <div class="form-group">
        <a target="_blank" href="http://<?=$_SERVER['HTTP_HOST']?>/notifications/<?=$notificationDetails['Notification']['id']?>/<?=$custom_link?>">http://<?=$_SERVER['HTTP_HOST']?>/notifications/<?=$notificationDetails['Notification']['id']?>/<?=$custom_link?></a>
    </div>
<?php } ?> 
 
    <div class="form-group">
        <label class="control-label" for="title">Title</label>
        <input id="title" class="form-control required" name="data[Notification][title]" type="text" value="<?=isset($notificationDetails) ? $notificationDetails['Notification']['title'] : ''?>" data-toggle="tooltip"  data-placement="left" title="Write the notification title" />
    </div>

    <div class="form-group">
        <label class="control-label" for="description">Description</label>
        <textarea id="description" rows='10' class="form-control <?=($type_editor == "rich-text")? "ckeditor" : "" ?>" name="data[Notification][description]"  <?=($type_editor == "markup")? 'data-provide="markdown"' : "" ?> title="Write the content of the notification"><?= isset($notificationDetails) ? $notificationDetails['Notification']['description'] : ''; ?></textarea>
        <?php if($type_editor == "markup") { ?>
            <p class="help-block"><a target="_blank" href="/admin/markdown-help">Markdown Help</a></p>
        <?php } ?>
    </div>

    <input type="submit" class="btn btn-success" value="Submit" />
    <?php if (isset($notificationDetails) && !$notificationDetails['Notification']['is_published']) { ?>
        <input type="button" class="btn btn-info" value="Publish" onclick="window.location='/admin/notifications/manage/publish/<?=$notificationDetails["Notification"]['id']; ?>'" />
    <?php } ?>
    <input type="button" class="btn btn-warning" value="Cancel" onclick="window.location='/admin/notifications/manage/index'" />
</form>
<?php if($type_editor == "markup") { ?>
    <script src="/js/bootstrap-markdown/lib/markdown.js"></script>
    <script src="/js/bootstrap-markdown/lib/to-markdown.js"></script>
<?php } ?> 