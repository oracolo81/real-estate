<?php if (isset($sTitle)) {
    echo $this->element("admin/title", array("title" => $sTitle));
    echo $this->element('notices'); 
}
if(!empty($pageDetails)) {
    $isPageHardcoded = !empty($pageDetails['Page']['custom_link']);
    $custom_link = strtolower(Inflector::slug($pageDetails['Page']['name'], '-'));
}
$type_editor = Configure::read('type_editor');
?>
<form action="/admin/pages/manage/save" enctype="multipart/form-data" class="validateForm" role="form" method="post" autocomplete=off>
<?php if (isset($pageDetails)) { ?>
    <input type="hidden" value="<?=$pageDetails["Page"]['id']; ?>" name="data[Page][id]" />
    <label class="control-label" for="title">URL</label>
    <div class="form-group">
        <a target="_blank" href="http://<?=$_SERVER['HTTP_HOST']?><?=(!$isPageHardcoded) ? '/pages/'.$pageDetails['Page']['id'] : ''?>/<?=$custom_link?>">
        http://<?=$_SERVER['HTTP_HOST']?><?=(!$isPageHardcoded) ? '/pages/'.$pageDetails['Page']['id'] : ''?>/<?=$custom_link?></a>
    </div>
<?php } ?> 
 
    <div class="form-group">
        <label class="control-label" for="name">Name</label>
        <input id="name" class="form-control required" name="data[Page][name]" type="text" value="<?=isset($pageDetails) ? $pageDetails['Page']['name'] : ''?>" <?=(!empty($isPageHardcoded))? 'readonly' : '' ?> data-toggle="tooltip"  data-placement="left" title="Write the page name" />
    </div>

    <div class="form-group">
        <label class="control-label" for="body">Body</label>
        <textarea id="body" rows='10' class="form-control <?=($type_editor == "rich-text")? "ckeditor" : "" ?>" name="data[Page][body]"  <?=($type_editor == "markup")? 'data-provide="markdown"' : "" ?> title="Write the content of the page"><?= isset($pageDetails) ? $pageDetails['Page']['body'] : ''; ?></textarea>
        <?php if($type_editor == "markup") { ?>
            <p class="help-block"><a target="_blank" href="/admin/markdown-help">Markdown Help</a></p>
        <?php } ?>
    </div>
   
    <div class="form-group">
        <label class="control-label" for="browsertitle">SEO Browser Title</label>
        <input id="browsertitle" class="form-control required" name="data[Page][browser_title]" type="text" value="<?=isset($pageDetails) ? $pageDetails['Page']['browser_title'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write the browser title" />
    </div>

    <div class="form-group">
        <label class="control-label" for="keywords">SEO Meta Keywords</label>
        <textarea id="keywords" rows='5' class="form-control" name="data[Page][keywords]" data-toggle="tooltip"  data-placement="left" title="Add meta keywords"><?=isset($pageDetails) ? $pageDetails['Page']['keywords'] : ''; ?></textarea>
    </div>

    <div class="form-group">
        <label class="control-label" for="description">SEO Meta Description</label>
        <textarea id="description" rows='4' class="form-control" name="data[Page][description]" data-toggle="tooltip"  data-placement="left" title="Add meta description"><?=isset($pageDetails) ? $pageDetails['Page']['description'] : ''; ?></textarea>
    </div>
    <input type="submit" class="btn btn-success" value="Submit" />
    <input type="button" class="btn btn-warning" value="Cancel" onclick="window.location='/admin/pages/manage/index'" />
</form>
<?php if($type_editor == "markup") { ?>
    <script src="/js/bootstrap-markdown/lib/markdown.js"></script>
    <script src="/js/bootstrap-markdown/lib/to-markdown.js"></script>
<?php } ?> 