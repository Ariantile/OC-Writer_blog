$(function() {
    
    $(document).ready(function(){
        
        $('body').on('click', '.show-reply', function(){
            
            var par_id = $(this).attr('id'),
                token = $('#token').val(),
                cur = $('#cur').val();
            
            $('#' + par_id + '').prop('disabled', true);
            
            $.ajax({
                type: 'POST',
                url: '/writer/web/ajax/comments',
                data: ({parent : par_id, token : token, cur : cur}),
                dataType: "json",
                    
                success: function(comments, status) {
                    $.each(comments, function(i, html) {
                        $('#' + par_id + '').parent().append(comments[i].html);
                    })
                    $('#' + par_id + '').remove();
                },
                    
                error : function(result, status, error){
                    $('#' + par_id + '').prop('disabled', false);
                }

            });
        });
        
        $('body').on('click', '.comment-signal', function(){
            
            var cId = $(this).data('id'),
                token = $('#token').val(),
                cur = $('#cur').val(),
                $but = $('#signal-' + cId + '');
            
            $but.prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: '/writer/web/ajax/signal',
                data: ({signal : cId, token : token, cur : cur}),
                dataType: "json",
                    
                success: function(message, status) {
                    $('#comment-' + cId +'').append(message).delay(4000).queue( function(){
                        $('.flag-message').fadeOut( 2000 );
                    });
                    $but.replaceWith('<span class="signal-off"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>');
                },
                    
                error : function(result, status, error){
                    $but.prop('disabled', false);
                }

            });
        });
        
        $('body').on('click', '.comment-reply', function(e){
            e.preventDefault();
            var $form = $('#form-comment'),
                $this = $(this),
                parent_id = $this.data('id'),
                $comment = $('#comment-' + parent_id);
            
            $form.find('h4').text('Répondre à un commentaire');
            $('#respond_to_id').val(parent_id);
            $this.after($form);
        });
        
    });

});
