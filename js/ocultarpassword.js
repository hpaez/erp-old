$(document).on('ready', function(){
    $('#show-hide-passprev').on('click', function(e){
        e.preventDefault();
        var current = $(this).attr('action');

        if(current == 'hide'){
            $(document.getElementById('passprev')).attr('type','text');
            $(this).removeClass('glyphicon glyphicon-eye-open').addClass('glyphicon glyphicon-eye-close');
            $(this).attr('action','show');
        }  else {
            $(document.getElementById('passprev')).attr('type','password');
            $(this).removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-eye-open');
            $(this).attr('action','hide');
        }
    })

    $('#show-hide-passnew').on('click', function(e){
        e.preventDefault();
        var current = $(this).attr('action');

        if(current == 'hide'){
            $(document.getElementById('passnew')).attr('type','text');
            $(this).removeClass('glyphicon glyphicon-eye-open').addClass('glyphicon glyphicon-eye-close');
            $(this).attr('action','show');
        }  else {
            $(document.getElementById('passnew')).attr('type','password');
            $(this).removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-eye-open');
            $(this).attr('action','hide');
        }
    })
    
    $('#show-hide-repass').on('click', function(e){
        e.preventDefault();
        var current = $(this).attr('action');

        if(current == 'hide'){
            $(document.getElementById('repass')).attr('type','text');
            $(this).removeClass('glyphicon glyphicon-eye-open').addClass('glyphicon glyphicon-eye-close');
            $(this).attr('action','show');
        }  else {
            $(document.getElementById('repass')).attr('type','password');
            $(this).removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-eye-open');
            $(this).attr('action','hide');
        }
    })

    $('#show-hide-repassnew').on('click', function(e){
        e.preventDefault();
        var current = $(this).attr('action');

        if(current == 'hide'){
            $(document.getElementById('repassnew')).attr('type','text');
            $(this).removeClass('glyphicon glyphicon-eye-open').addClass('glyphicon glyphicon-eye-close');
            $(this).attr('action','show');
        }  else {
            $(document.getElementById('repassnew')).attr('type','password');
            $(this).removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-eye-open');
            $(this).attr('action','hide');
        }
    })
    
    $('#show-hide-password').on('click', function(e){
        e.preventDefault();
        var current = $(this).attr('action');

        if(current == 'hide'){
            $(document.getElementById('password')).attr('type','text');
            $(this).removeClass('glyphicon glyphicon-eye-open').addClass('glyphicon glyphicon-eye-close');
            $(this).attr('action','show');
        }  else {
            $(document.getElementById('password')).attr('type','password');
            $(this).removeClass('glyphicon glyphicon-eye-close').addClass('glyphicon glyphicon-eye-open');
            $(this).attr('action','hide');
        }
    })
})