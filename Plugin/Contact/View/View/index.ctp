<div id="header" class="heading" style="background-image: url(img/img01.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-12">
                <div class="page-title">
                    <h2>Contact</h2>
                </div>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a></li> 
                    <li class="active">Contact</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <?php echo $this->element('notices'); ?>
                <?php echo (isset($page)) ? $page['body'] : ''; ?>
                <form role="form" action="/contact/view/send" method="post">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" required placeholder="Enter First Name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" required placeholder="Enter Last Name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="emailaddress">Email Address</label>
                        <input type="email" name="emailaddress" id="emailaddress" required placeholder="Enter Email Address" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea rows="5" name="message" id="message" required placeholder="Enter Message" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-warning pull-right"><i class="fa fa-envelope-o"></i> Send Message</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-xs-12 contact-details">
                <h3>Contact Details</h3>
                <ul class="list-unstyled">
                    <?php if (!empty($contactDetails['Contact']['telephone'])) { ?>
                        <li><span class="contact-details-title"><i class="fa fa-phone fa-lg fa-fw"></i> Telephone:</span> <?php echo $contactDetails['Contact']['telephone']; ?></li>
                    <?php } ?>
                    <?php if (!empty($contactDetails['Contact']['skype'])) { ?>
                        <li><span class="contact-details-title"><i class="fa fa-skype fa-lg fa-fw"></i> Skype:</span> <?php echo $contactDetails['Contact']['skype']; ?></li>
                    <?php } ?>
                    <?php if (!empty($contactDetails['Contact']['email'])) { ?>
                        <li><span class="contact-details-title"><i class="fa fa-envelope-o fa-lg fa-fw"></i> Email:</span> <?php echo $contactDetails['Contact']['email']; ?></li>
                    <?php } ?>
                    <?php if (!empty($contactDetails['Contact']['mobile'])) { ?>
                        <li><span class="contact-details-title"><i class="fa fa-mobile-phone fa-lg fa-fw"></i> Mobile:</span> <?php echo $contactDetails['Contact']['mobile']; ?></li>
                    <?php } ?>
                    <?php if (!empty($contactDetails['Contact']['fax'])) { ?>
                        <li><span class="contact-details-title"><i class="fa fa-fax fa-lg fa-fw"></i> Fax:</span> <?php echo $contactDetails['Contact']['fax']; ?></li>
                    <?php } ?>
                    <?php if (!empty($contactDetails['Contact']['youtube'])) { ?>
                        <li><span class="contact-details-title"><i class="fa fa-youtube fa-lg fa-fw"></i> Youtube:</span> <?php echo $contactDetails['Contact']['youtube']; ?></li>
                    <?php } ?>
                    <?php if (!empty($contactDetails['Contact']['facebook'])) { ?>
                        <li><span class="contact-details-title"><i class="fa fa-facebook fa-lg fa-fw"></i> Facebook:</span> <?php echo $contactDetails['Contact']['facebook']; ?></li>
                    <?php } ?>
                    <?php if (!empty($contactDetails['Contact']['twitter'])) { ?>
                        <li><span class="contact-details-title"><i class="fa fa-twitter fa-lg fa-fw"></i> Twitter:</span> <?php echo $contactDetails['Contact']['twitter']; ?></li>
                    <?php } ?>
                    <?php if (!empty($contactDetails['Contact']['linkedin'])) { ?>
                        <li><span class="contact-details-title"><i class="fa fa-linkedin fa-lg fa-fw"></i> LinkedIn:</span> <?php echo $contactDetails['Contact']['linkedin']; ?></li>
                    <?php } ?>
                    <?php if (!empty($contactDetails['Contact']['googleplus'])) { ?>
                        <li><span class="contact-details-title"><i class="fa fa-googleplus fa-lg fa-fw"></i> Google Plus:</span> <?php echo $contactDetails['Contact']['googleplus']; ?></li>
                    <?php } ?>
                </ul>
                <?php if (!empty($contactDetails['Contact']["longitude"]) && !empty($contactDetails['Contact']["latitude"])) { ?>
                    <?php echo $this->Html->script('maps.js'); ?>
                    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=<?=Configure::read('google.api_key');?>"></script>
                    </script>
                    <script type="text/javascript">
                        var lat = <?=$contactDetails['Contact']["latitude"];?>;
                        var lon = <?=$contactDetails['Contact']["longitude"];?>;

                        google.maps.event.addDomListener(window, 'load', function(){
                            initFrontEndMap(lat, lon);
                        });
                    </script>
                    <div id="map-canvas" style="width: auto; height: 225px;border: 1px solid #ccc;border-radius: 4px;"></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>