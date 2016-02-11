$(document).ready(function(){
    $('#invite form').submit(function(e){
        // prevent form submit taking us off page
        e.preventDefault();
        var $form = $(this);
        $.post('/send-message', (function (){
            // quick & dirty: anonymous function gathers each input
            // name and value into a hash -- this is immediately called
            // and returns an object
            var data = {};
            $form.find(':input').each(function(){
                var $input = $(this);
                data[$input.attr('name')] = $input.val();
            });
            return data;
        })(), function(){ console.log('Invitation Sent.'); });
        var $btn = $form.find('button');
        $btn.removeClass('btn-primary').addClass('btn-success');
        window.setTimeout(function(){
            $form.closest('li').remove();
        }, 2000);
    });
});
