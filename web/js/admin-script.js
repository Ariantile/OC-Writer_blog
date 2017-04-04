$(function() {
    
    function showModal($id) {
        if ($('#modal-' + $id + '').hasClass('modal-hide')) {
            $('#modal-' + $id + '').removeClass('modal-hide');
        }
        $('#modal-' + $id + '').addClass('modal-display');
    }
    
    function hideModal($id) {
        if ($('#modal-' + $id + '').hasClass('modal-display')) {
            $('#modal-' + $id + '').removeClass('modal-display');
        }
        $('#modal-' + $id + '').addClass('modal-hide');
    }
    
    function delEntity($cId, $but, $url, $type) {
        
        var token = $('#token').val();
        
        $('#' + $but + '').prop('disabled', true);

        $.ajax({
            type: 'POST',
            url: $url,
            data: ({delete : $cId, token : token}),
            dataType: "json",
                    
            success: function(message) {
                
                hideModal($cId);
                
                if ($type == 'comment') {
                    $('.msg-cont-aj').append('<div class="alert alert-info del-message">' + message + '</div>').delay(2000).queue( function(){
                        $('.del-message').fadeOut( 1000 ).queue(function() {
                            location.reload();
                        });
                    });
                } else {
                    $('#row-' + $cId + '').remove();
                    $('.msg-cont-aj').append('<div class="alert alert-info del-message">' + message + '</div>').delay(4000).queue( function(){
                        $('.del-message').fadeOut( 2000 );
                    });
                }
            },
                    
            error : function(message){
                
                hideModal($cId);
                
                $('.msg-cont-aj').text();
                $('.msg-cont-aj').append('<div class="alert alert-danger del-message">' + message['responseText'] + '</div>').delay(4000).queue( function(){
                    $('.del-message').fadeOut(2000).queue(function(){
                        $('#' + $but + '').prop('disabled', false);
                    });
                });
            }
        });
    }
    
    $(document).ready(function(){

        if ($('#title-admin').text() == 'Administration des articles postés') {
            var $type = 'article';
        }
        
        if ($('#title-admin').text() == 'Administration des catégories') {
            var $type = 'cat';
        }
        
        if ($('#title-admin').text() == 'Administration des commentaires') {
            var $type = 'comment';
        }
        
        $('body').on('click', '.delete-cat', function(){
            var $id = $(this).data('id'),
                $butId = $(this).attr('id'),
                $url = '/writer/web/ajax/delete-cat',
                $type = 'cat';

            delEntity($id, $butId, $url, $type);
            
        });
        
        $('body').on('click', '.delete-comment', function(){
            var $id = $(this).data('id'),
                $butId = $(this).attr('id'),
                $url = '/writer/web/ajax/delete-comment',
                $type = 'comment';

            delEntity($id, $butId, $url, $type);
            
        });
        
        $('body').on('click', '.delete-article', function(){
            var $id = $(this).data('id'),
                $butId = $(this).attr('id'),
                $url = '/writer/web/ajax/delete-article',
                $type = 'article';

            delEntity($id, $butId, $url, $type);
            
        });
            
        $('body').on('click', '.modal-delete-' + $type + '', function(){
            var $id = $(this).data('id');
            
            showModal($id);
            
        });
        
        $('body').on('click', '.cancel-delete', function(){
            var $id = $(this).data('id');
            
            hideModal($id);
            
        });
    });
});
