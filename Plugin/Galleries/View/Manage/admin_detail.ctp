<?php if (isset($sTitle)) {
    echo $this->element("admin/title", array("title" => $sTitle));
    echo $this->element('notices'); 
}
?>
<form action="/admin/galleries/manage/save" enctype="multipart/form-data" class="validateForm" role="form" method="post" autocomplete=off>
<?php if (isset($galleryDetails)) { ?>
    <input type="hidden" value="<?=$galleryDetails["Gallery"]['id']; ?>" name="data[Gallery][id]" />
    <div class="form-group">
        <label class="control-label" for="thumbnail">Thumbnail</label><br />
        <img id="thumbnail" class="img-thumb" src="<?=$path.$galleryDetails['Gallery']['file_name']?>" alt="Thumbnail" />
    </div>
<?php } ?> 
<?php if (isset($categoriesGallery)) { ?>
    <div class="form-group">
        <label class="control-label" for="categories">Categories</label>
        <select class="form-control required" id="categories" name="data[Gallery][category_id]">
            <?php foreach ($categoriesGallery as $key => $category) {
                $selected = "";
                if (isset($galleryDetails) && ($galleryDetails['Gallery']['category_id'] == $category['CategoriesGallery']['id']) ) { 
                    $selected = "selected";
                } ?>
                <option <?=$selected;?> value="<?=$category['CategoriesGallery']['id']?>"><?=$category['CategoriesGallery']['name']?></option>
            <?php } ?>
        </select>
    </div>
<?php } ?> 
    <div class="form-group">
        <label class="control-label" for="file_name">Name</label>
        <input id="file_name" class="form-control required" name="data[Gallery][file_name]" type="file" value="<?=isset($galleryDetails) ? $galleryDetails['Gallery']['file_name'] : ''?>" title="File" />
    </div>

    <div class="form-group">
        <label class="control-label" for="description">Caption</label>
        <textarea id="description" rows='5' class="form-control required" name="data[Gallery][description]" title="Write the caption"><?= isset($galleryDetails) ? $galleryDetails['Gallery']['description'] : ''; ?></textarea>
    </div>

    <input type="submit" class="btn btn-success" value="Submit" />
    <input type="button" class="btn btn-warning" value="Cancel" onclick="window.location='/admin/galleries/manage/index'" />
</form>