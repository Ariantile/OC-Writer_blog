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
                    console.log(comments);
                },
                    
                error : function(result, status, error){
                    $('#' + par_id + '').prop('disabled', false);
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
