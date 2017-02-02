var RecaptchaOptions = {
    theme : 'clean'
};

$(document).ready(setupValidators);
$(document).ready(initControls);

function setupValidators(){
    $.validator.addMethod("captcha", validateCaptcha, "Incorrect verification code");
    $.validator.addMethod("datepicker", validateDate, "Please enter a correct date");
    $.validator.addMethod("time", validateTime, "Please enter a correct time");
    $.validator.addMethod("allow", validateAllow, "Invalid data");
    $.validator.addMethod("fancyCheckbox", validateFancyCheckbox, "This field is required");
    $.validator.addMethod("fancyRadioButton", validateFancyRadioButton, "This field is required");
    $.validator.addMethod("ckeditor", function(value, element) {
        var editor = CKEDITOR.instances[$(element).attr("id")];
        var textData = editor.getData();
        if(textData.length>0) return true;
        return false;
    }, "This field is required");
    $.validator.setDefaults({
        errorElement: 'span',
        errorClass: 'has-error control-label form-error',
        errorPlacement: function(error, element) {
            if ( element.is(":radio") )
                error.appendTo( element.parents('table.radiobuttons').parent() );
            else if ( element.is(":checkbox") )
                error.appendTo ( (element.parents('table.checkboxes').length > 0)? element.parents('table.checkboxes').parent():element.parent() );
            else if ( element.is(":file") )
                error.appendTo( element.parent().parent() );
            else
                error.appendTo( element.parent() );

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
}

var editors = [];
function updateEditors(){
    for(var i =0; i < editors.length; i++){
        CKEDITOR.instances[$(editors[i]).attr("name")].updateElement();
    }
}

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

function initControls(){    

    var ckeditors = $("textarea.ckeditor");

    if(ckeditors.length > 0){
        var path = location.pathname.split('/');
        var plugin = "home";
        if(path[1] == "admin" && path.length > 2){
            plugin = path[2];
        }
        else if(path.length == 1){
            plugin = path[0];
        }
        ckeditors.ckeditor(function(){
            editors.push(this);
            this.document.on("keyup", updateEditors );
            this.document.on("paste", updateEditors );
        }, 
        {
            toolbar: 'Basic',
            filebrowserImageBrowseUrl : '/filemanager/index/plugin:' + plugin
        }); 
    }
    
    try{        
        $('input#customupload').customFileInput();
    }catch(Exception){}

    try{        
        $("div.progressbar").each(function(){
            var obj = $(this);
            obj.data("value", parseFloat($(this).html()));
            obj.html('');
            obj.progressbar({ value: obj.data("value") });
        });
    }catch(Exception){}

    try{        
        if($("input.datepicker").length > 0){
            $("input.datepicker").datepicker({
                format: "dd-mm-yyyy"
            });
        }
    }catch(Exception){}

    try{        
        $(".tiptip").tipTip({maxWidth: "auto", edgeOffset: 2, defaultPosition: 'top', activation: 'hover'});
        $(".right_tiptip").tipTip({maxWidth: "auto", edgeOffset: 2, defaultPosition: 'right', activation: 'focus'});
        $("input[title], select[title], textarea[title]").tipTip({maxWidth: "auto", edgeOffset: 2, defaultPosition: 'bottom', activation: 'focus'});
    }catch(Exception){}
    
    try{
        $('input.toggleText, textarea.toggleText').each(function(){
            if($(this).attr("alt") != ''){
                $(this).data('default', $(this).attr('alt'));
                if($(this).val() == ''){
                    $(this).val($(this).data('default'));
                }
                
                $(this).bind('blur', function(){
                    if($(this).val() == ''){
                        $(this).val($(this).data('default'));
                    }
                });
                
                $(this).bind('focus', function(){
                    if($(this).val() == $(this).data('default')){
                        $(this).val('');
                    }
                });
            }
        });
    }catch(Exception){}
    
    try{
        $('#file_upload').uploadify({
            'uploader'  : '/js/uploadify/uploadify.swf',
            'script'    : '/js/uploadify/uploadify.php',
            'cancelImg' : '/js/uploadify/cancel.png',
            'folder'    : '/app/webroot/img/uploads',
            'buttonText': 'Browse...',
            'auto'      : false
        });
    } catch(Exception){}
    
    $("input.defaultText").each(function(){
        if($(this).val() != ""){
            $(this).data("defaultText", $(this).val());
            $(this).bind("focus", function(){
                if($(this).val() == $(this).data("defaultText")){
                    $(this).val('');
                }
            }).bind("blur", function(){
                if($(this).val() == ""){
                    $(this).val($(this).data("defaultText"));
                }
            });
        }
    });

    var dontSort = [];
    $('.dataTable thead th').each( function () {
        if ( $(this).hasClass( 'sorting' )) {
            dontSort.push( null );
        } else {
            dontSort.push( { "bSortable": false } );
        }
    });
    $(".dataTable").dataTable({
        pageLength: 25,
        language: {
            info: 'Showing <b>_START_</b> to <b>_END_</b> of <b>_TOTAL_</b> records',
            search: 'Search: '
        },
        order: [[ 1, "desc" ]],
        aoColumns: dontSort
    });

    $(".validateForm").validate({});
}

function validateAllow(value, element){
    return true;
}

function validateCaptcha(value, element)
{
    challengeField = $("input#recaptcha_challenge_field").val();
    responseField = $("input#recaptcha_response_field").val();
    var response = $.ajax({
        type: "POST",
        url: "/captcha/",
        data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField,
        async: false
    }).responseText;
    
    if(response == "true"){
        return true;    
    }
    else{
        Recaptcha.reload();
        return false;
    }
}   

function validateDate(value, element) {
    var check = false;
    var separator = '-';
    var re = /^\d{1,2}-\d{1,2}-\d{4}$/;
    if (re.test(value)) {
        var adata = value.split(separator);
        var gg = parseInt(adata[0], 10);
        var mm = parseInt(adata[1], 10);
        var aaaa = parseInt(adata[2], 10);
        var xdata = new Date(aaaa, mm - 1, gg);
        if ((xdata.getFullYear() == aaaa) && (xdata.getMonth() == mm - 1) && (xdata.getDate() == gg))
            check = true;
        else
            check = false;
    } else
    check = false;
    return this.optional(element) || check;
}

function validateTime(value, element) {
    var check = false;
    var re = /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/
    if (re.test(value)) {
        var atime = value.split(':');
        var hh = parseInt(atime[0], 10);
        var mm = parseInt(atime[1], 10);
        check = true;
    } else {
        check = false;
    }
    return this.optional(element) || check;
}

function validateFancyCheckbox(value, element) {
    var checkbox = $(element).siblings(".jqTransformCheckboxWrapper").find("a.jqTransformCheckbox")[0];
    return $(checkbox).hasClass("jqTransformChecked");
}

function validateFancyRadioButton(value, element) {
    var radiobutton = $(element).siblings(".jqTransformRadioWrapper").find("a.jqTransformRadio")[0];
    return $(radiobutton).hasClass("jqTransformChecked");
}

function decreaseSliderValue(fieldName) {
    var step = $("#slider_" + fieldName).slider("option","step");
    var currentValue = $("#slider_" + fieldName).slider("option", "value");
    $("#slider_" + fieldName).slider("value" , currentValue - step );
    $("#slider_val_" + fieldName).val(currentValue - step);
}

function increaseSliderValue(fieldName) {
    var step = $("#slider_" + fieldName).slider("option","step");
    var currentValue = $("#slider_" + fieldName).slider("option", "value");
    $("#slider_" + fieldName).slider("value" , currentValue + step );
    $("#slider_val_" + fieldName).val(currentValue + step);
}

function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

var mapMarkers = new Array();
var infoWindows = new Array();
var maps = {};
function drawMap(div, zoomlevel, markers, options){
    if(!google){
        alert("Unfortunately we could not reach Google at this time. Google Maps will be disabled.");
        return;
    }
    if(markers != undefined && markers.length){
        var latlng = new google.maps.LatLng(markers[0].lat, markers[0].lng);
    } else if (options["center_fallback"]) {
        var latlng = new google.maps.LatLng(options.center_fallback.lat, options.center_fallback.lng);
    } else {
        var latlng = new google.maps.LatLng(35.939665,14.384962);
    }
    
    if(zoomlevel == undefined){
        zoomlevel = 11;
    }
    
    var myOptions = {
        zoom: zoomlevel, 
        center: latlng, 
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    if(options){
        $.extend(myOptions, options);
    }
    
    if(maps[div] == undefined) {
        maps[div] = {}; 
        maps[div].map = new google.maps.Map(document.getElementById(div), myOptions);
        maps[div].mapMarkers = new Array();
    } else {
        maps[div].map.setCenter(latlng);
        maps[div].map.setZoom(zoomlevel);
    }
    
    for(var i in markers) { 
        var lat = markers[i].lat;
        var lon = markers[i].lng;

        var pos = new google.maps.LatLng(lat,lon);
        marker = new google.maps.Marker({
            map:maps[div].map, 
            position: pos,
            title: markers[i].title,
            infoWindowIndex: i,
            icon: markers[i].icon
        }); 
        
        maps[div].mapMarkers[i] = marker;
        
        if(markers[i].default_image != undefined && div != "locations_map"){
            if($("#"+div).hasClass("offers_map")) {
                var contentString = '<div class="marker-content">'+
                '<h2>'+markers[i].special_offer_title+'</h2>' +
                '<img src="'+markers[i].default_image+'" />' +
                '</div>';
            } else {    
                var contentString = '<div class="marker-content">'+
                '<a href="/listing/'+markers[i].listing_id+'/'+markers[i].listing_title+'"><img src="'+markers[i].default_image+'" /></a>' +
                '</div>';
            }

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            }); 
            
            infoWindows[i] = infowindow;

            google.maps.event.addListener(marker, 'click', function() {
                for(var index in infoWindows){
                    infoWindows[index].close();
                }
                
                infoWindows[this.infoWindowIndex].open(maps[div].map,maps[div].mapMarkers[this.infoWindowIndex]);
            });
        }
    }   
}

function clearMarkers(map) {
    if(maps[map] != undefined) {
        for(i in maps[map].mapMarkers){
            maps[map].mapMarkers[i].setMap(null);
        }
        
        maps[map].mapMarkers = new Array();
    }
}


$(document).on('change', '.btn-file :file', function() {
  var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready( function() {
    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
    $('[data-toggle="tooltip"]').tooltip();
    $('.dataTables_filter').append('<select name="multi_del" id="multi_del" class="form-control input-sm pull-right"><option value="">With selected:</option><option value="delete">delete</option></select>')
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
});

function confirmDelete(plugin, controller, action, id) {
    bootbox.confirm('<i class="fa fa-exclamation-triangle fa-fw"></i>Are you sure you want to delete this record?', function(result) {
        if(result) {
            window.location = '/admin/'+plugin+'/'+controller+'/'+action+'/'+id;
        } else {
            return;
        }
    });
}

function confirmDeleteMultiple(plugin, controller, action) {
    var cList = [];
    $('.check').each(function () {
        if ($(this).is(":checked")) {
            cList.push($(this).val());
        }
    });
    if (cList.length != 0) {
        bootbox.confirm('<i class="fa fa-exclamation-triangle fa-fw"></i> Are you sure you want to delete the selected records?', function(result) {
            if(result) {
                window.location = '/admin/'+plugin+'/'+controller+'/'+action+'/'+JSON.stringify(cList);
            } else {
                return;
            }
        });
    }
}

$(function(){
    $("#default_editor").bootstrapSwitch({onSwitchChange: function(e, data) {
        bootbox.confirm('<i class="fa fa-exclamation-triangle fa-fw"></i> Are you sure you want change editor? This action will be effects in all the contents.', function(result) {
            if (!result) {
                var state = !data;
                $("#default_editor").bootstrapSwitch('state', state, true);
            }
        });
    }});
});
