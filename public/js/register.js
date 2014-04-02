/* Inputed passwords checker */

$('input[name=submit]').css('display','none');

$('input[name=confirm_password]').keyup(function(event) {
    var $password = $('input[name=password]').val();
    var $submit = $('input[name=submit]');
    if($(this).val() === $password) {
        $submit.css('display','block');
    } else {
        $submit.css('display','none');
    }
});
