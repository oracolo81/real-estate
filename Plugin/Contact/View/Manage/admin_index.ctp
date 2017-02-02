<? if (isset($sTitle)) { ?>
    <?php echo $this->element("admin/title", array("title" => $sTitle)); ?>
<? } ?>
<?php echo $this->element('notices'); ?>
<form action="/admin/contact/manage/save" enctype="multipart/form-data" class="validateForm" role="form" method="post">
    <?php if (isset($contactItem)) { ?>
        <input type="hidden" value="<?php echo $contactItem["Contact"]['id']; ?>" name="data[Contact][id]" />
    <?php } ?>
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label class="control-label" for="address">Address</label>
                <textarea id="address" rows='5' class="form-control required" name="data[Contact][address]" data-toggle="tooltip"  data-placement="left" title="Write your address"><?php echo isset($contactItem) ? $contactItem['Contact']['address'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label class="control-label" for="telephone">Telephone</label>
                <input id="telephone" class="form-control required" name="data[Contact][telephone]" type="text" value="<?php echo isset($contactItem) ? $contactItem['Contact']['telephone'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write your telephone number" />
            </div>
            <div class="form-group">
                <label class="control-label" for="email">Email</label>
                <input id="email" class="form-control required" name="data[Contact][email]" type="text" value="<?php echo isset($contactItem) ? $contactItem['Contact']['email'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write your email address" />
            </div>
            <div class="form-group">
                <label class="control-label" for="mobile">Mobile</label>
                <input id="mobile" class="form-control required" name="data[Contact][mobile]" type="text" value="<?php echo isset($contactItem) ? $contactItem['Contact']['mobile'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write your mobile number" />
            </div>
            <div class="form-group">
                <label class="control-label" for="fax">Fax</label>
                <input id="fax" class="form-control required" name="data[Contact][fax]" type="text" value="<?php echo isset($contactItem) ? $contactItem['Contact']['fax'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write your fax number" />
            </div>
            <div class="form-group">
                <label class="control-label" for="youtube">Youtube</label>
                <input id="youtube" class="form-control" name="data[Contact][youtube]" type="text" value="<?php echo isset($contactItem) ? $contactItem['Contact']['youtube'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write your YouTube profile url" />
            </div>
            <div class="form-group">
                <label class="control-label" for="skype">Skype</label>
                <input id="skype" class="form-control" name="data[Contact][skype]" type="text" value="<?php echo isset($contactItem) ? $contactItem['Contact']['skype'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write your Skype name" />
            </div>
            <div class="form-group">
                <label class="control-label" for="facebook">Facebook</label>
                <input id="facebook" class="form-control" name="data[Contact][facebook]" type="text" value="<?php echo isset($contactItem) ? $contactItem['Contact']['facebook'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write your Facebook page url" />
            </div>
            <div class="form-group">
                <label class="control-label" for="twitter">Twitter</label>
                <input id="twitter" class="form-control" name="data[Contact][twitter]" type="text" value="<?php echo isset($contactItem) ? $contactItem['Contact']['twitter'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write your Twitter url" />
            </div>
            <div class="form-group">
                <label class="control-label" for="linkedin">LinkedIn</label>
                <input id="linkedin" class="form-control" name="data[Contact][linkedin]" type="text" value="<?php echo isset($contactItem) ? $contactItem['Contact']['linkedin'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write your LinkedIn url" />
            </div>
            <div class="form-group">
                <label class="control-label" for="googleplus">Google Plus</label>
                <input id="googleplus" class="form-control" name="data[Contact][googleplus]" type="text" value="<?php echo isset($contactItem) ? $contactItem['Contact']['googleplus'] : ''; ?>" data-toggle="tooltip"  data-placement="left" title="Write your Google Plus url" />
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <label class="control-label" for="skype">Location</label>
                <p>Click on the map to indicate the position.</p>
                <div id="map-canvas" style="width: auto; height: 455px;"></div>
                <input id="googleSearchBox" class="controls" type="text" placeholder="Search Box">
                <input type="hidden" id="latitude" name="data[Contact][latitude]" value="<?=((!empty($contactItem))?$contactItem["Contact"]["latitude"]:"")?>"/>
                <input type="hidden" id="longitude"name="data[Contact][longitude]" value="<?=((!empty($contactItem))?$contactItem["Contact"]["longitude"]:"")?>"/>
                <button type="button" class="btn btn-sm btn-danger pull-right" id="btnRemoveLocation" onclick="removeLocation();">Remove location</button>
            </div>
        </div>
    </div><input type="submit" class="btn btn-success" value="Submit" />
</form>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=<?=Configure::read('google.api_key');?>"></script>
<script type="text/javascript">
    var lat = <?=((!empty($contactItem) && !empty($contactItem["Contact"]["latitude"]))?$contactItem["Contact"]["latitude"]:"null")?>;
    var lon = <?=((!empty($contactItem) && !empty($contactItem["Contact"]["longitude"]))?$contactItem["Contact"]["longitude"]:"null")?>;
    
    google.maps.event.addDomListener(window, 'load', function(){
        initAdminMap(lat, lon);
    });
</script>
