$().ready(function(){
    $('.action-modal').each(function() {
        $(this).bind('click', function(e) {
            e.preventDefault();
            actionModal(this);
        });
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

function guidGenerator() {
    var S4 = function() {
            return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
        };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}