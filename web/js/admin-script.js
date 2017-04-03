$(function() {
    
    function delEntity($cId, $but, $url, $type) {
        
        var token = $('#token').val();
        
        $('#' + $but + '').prop('disabled', true);

        $.ajax({
            type: 'POST',
            url: $url,
            data: ({delete : $cId, token : token}),
            dataType: "json",
                    
            success: function(message) {
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
        
    });

});
