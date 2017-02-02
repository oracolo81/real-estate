<div class="row">
    <div class="col-md-8">
        <?=$this->element("page_content") ?>
        <?=$this->element('notices'); ?>
        <form role="form" action="contactus/send" class="validateForm form-horizontal"  method="post" notrequired>
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" name="name" id="name" value="<?= !empty($formData['name']) ? $formData['name'] : ""; ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="surname" class="col-sm-2 control-label">Surname</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" name="surname" id="surname" value="<?= !empty($formData['surname'])? $formData['surname']: "";  ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="surname" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control required" name="email" id="surname" value="<?= !empty($formData['email'])? $formData['email']: "";  ?>" />
                </div>
            </div>
            <div class="form-group">
                <label for="subject" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control required" name="subject" id="subject" value="<?= !empty($formData['subject'])?$formData['subject'] :"" ;?>" />
                </div>
            </div>

            <div class="form-group">
                <label for="message" class="col-sm-2 control-label">Message</label>
                <div class="col-sm-10">
                    <textarea rows="5" name="message" id="message" class="form-control"required> 
                        <?= !empty($formData['message']) ? $formData['message']: ""; ?> 
                    </textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?=$captcha->html()?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-3 col-md-offset-1">
        <?php
        if (!empty($contactDetails['Contact'])) { ?>
            <h2>Contact details </h2><br>
            <label>Address <div class="glyphicon glyphicon-envelope"> </div></label>
            <p><?php echo $contactDetails['Contact']['address'];?></p> <br>
            <label>Telephone <div class="glyphicon glyphicon-phone-alt"> </div></label>
            <p><?php echo $contactDetails['Contact']['telephone'];?></p><br>
            <label>Email <div class="glyphicon glyphicon-envelope"></div> </label>
            <p><?php echo $contactDetails['Contact']['email'];?></p><br>
            <label>Mobile <div class="glyphicon glyphicon-phone"> </div></label>
            <p><?php echo $contactDetails['Contact']['mobile'];?></p><br>
            <label>Fax <div class="glyphicon glyphicon-print"> </div></label>
            <p><?php echo $contactDetails['Contact']['fax'];?></p><br>
            <label>Skype <div class=" glyphicon glyphicon-headphones"> </div> </label>
            <p><?php echo $contactDetails['Contact']['skype'];?> </p><br>
        <?php
        } ?>
    </div>
</div>
<div class="grey-line">
</div>

<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.0/jquery.validate.min.js"></script>
<script>
    $(function(){
        $.validator.setDefaults({
            ignore: '#recaptcha_response_field',
            errorElement: 'span',
            errorClass: 'has-error control-label form-error',
            errorPlacement: function(error, element) {
                element.parent('div').addClass('has-error').addClass('has-feedback');
                element.after('<span class="glyphicon glyphicon-remove form-control-feedback"></span>');
            },
            onfocusout: function(element) {
                if ($(element).hasClass('datepicker')) {
                    setTimeout(function() {
                        checkIfValid(element);
                    }, 300);
                } else {
                    checkIfValid(element);
                }
            }
        });
        $(".validateForm").validate();
        
    });

    function checkIfValid(element) {
        if ($(element).valid()) {
            $(element).parent('div').removeClass('has-error').addClass('has-success').addClass('has-feedback');
            if ($(element).siblings('span.glyphicon').length > 0) {
                $(element).siblings('span.glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            } else {
                $(element).after('<span class="glyphicon glyphicon-ok form-control-feedback"></span>');
            }
        } else {
            $(element).parent('div').removeClass('has-success').addClass('has-error').addClass('has-feedback');
        }
    }

</script>

