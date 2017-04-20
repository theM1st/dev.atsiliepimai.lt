$().ready(function(){
    $('.action-modal').each(function() {
        $(this).bind('click', function(e) {
            e.preventDefault();
            actionModal(this);
        });
    });

    $('.icheck').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
        increaseArea: '20%'
    });
});


function actionModal(o) {
    var o = $(o);
    var data = null;
    var url = o.attr('href');
    var dataForm = (o.attr('data-form'));
    var dataMethod = (o.attr('data-method') || 'post');
    var size = (o.attr('data-size') || 'modal-lg');

    var popup = new bsModal(size);

    if (dataForm) {
        //data = $(dataForm).serialize();
        //data = new FormData($(dataForm)[0]);
    }

    popup.show();

    ajax(url, dataMethod).done(function(response) {
        popup.setContent(response.html);
        $('.ajax-form').bind('submit', function (e) {
            e.preventDefault();
            ajaxForm(this, true);
        });
    });
/*
     $.ajax({
         type: dataMethod,
         url: url,
         data: data,
         dataType: 'json',
         processData: false,
         contentType: false,
         error: function(response){
             var errors = response.responseJSON;
             var errorsHtml = '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Klaida</h4></div><div class="modal-body"><div class="alert alert-danger">';

             $.each(errors, function( key, value ) {
                 errorsHtml += '<div>' + value[0]  '</div>'; //showing only the first error.
             });

             errorsHtml += '</div></div>';

             modal.setContent(errorsHtml);
         }
     }).success(function(response){
         modal.setContent(response.html);
         $('.ajax-form').bind('submit', function(e) {
             e.preventDefault();
             ajaxForm(this, true);
         });
     });*/

    return false;
}

function ajax(url, type) {
    this.url = url;
    this.type = type;

        return $.ajax({
            url: this.url,
            type: this.type,
            dataType: 'json'
    });
}

function bsModal(size) {
    this.id = guidGenerator();
    this.size = (size || 'modal-lg');

        var $html = $('<div class="modal fade" id="'+this.id+'" tabindex="-1" role="dialog"><div class="modal-dialog '+this.size+'"><div class="modal-content"></div></div></div>');
    $html.appendTo('body');

        this.show = function(){
            $('#'+this.id).modal();
        };

        this.setContent = function(content){
            $('#'+this.id+' .modal-content').html(content);
        };
}

function starRating(obj, options) {
    var options = options || {};

    obj.rating($.extend({
        theme: 'krajee-fa',
        language: 'lt',
        showClear: false,
        min: 0,
        max: 5,
        step: 1,
        size: 'xs',
        emptyStar: '<i class="fa fa-star"></i>',
        starCaptionClasses: function() {
            return 'label label-default';
        }
    }, options));
}

function listingTypeToggle() {
    $('input').on('ifChecked', function(){
        if ($(this).val() == 'product') {
            $('.brand-group-container').show();
            $('.address-group-container').hide();
        }

        if ($(this).val() == 'service') {
            $('.brand-group-container').hide();
            $('.address-group-container').show();
        }
    });
}

(function(form) {
    form.find('[id^=attribute_option_id]').each(function(){
        var optId = $(this);

        var $optValue = $('#value_' + optId.attr('id').replace('[', '').replace(']', ''));

        if (parseInt(optId.val()) === 0) {
            toggleOptionValue('show', $optValue);
        }

        optId.change(function() {
            if (parseInt($(this).val()) === 0) {
                toggleOptionValue('show', $optValue);
            } else {
                toggleOptionValue('hide', $optValue);
            }
        });
    });

    function toggleOptionValue(a, obj) {
        if (a == 'show') {
            obj.show();
            obj.find('input').prop('disabled', false);
        } else if (a == 'hide') {
            obj.hide();
            obj.find('input').prop('disabled', true);
        }
    }

})($('#review-form'));

function guidGenerator() {
    var S4 = function() {
            return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
        };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}