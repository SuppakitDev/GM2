function showPassword() {
    
    var key_attr = $('#password-confirm').attr('type');
    
    if(key_attr != 'text') {
        
        $('.checkbox').addClass('show');
        $('#password-confirm').attr('type', 'text');
        
    } else {
        
        $('.checkbox').removeClass('show');
        $('#password-confirm').attr('type', 'password');
        
    }

    var key_attr = $('#password').attr('type');
    
    if(key_attr != 'text') {
        
        $('.checkbox').addClass('show');
        $('#password').attr('type', 'text');
        
    } else {
        
        $('.checkbox').removeClass('show');
        $('#password').attr('type', 'password');
        
    }
    
}