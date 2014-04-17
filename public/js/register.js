/* Inputed passwords checker */

$('input[name=submit]').click(function(event) {
    var $password = $('input[name=password]').val();
    var $passwordRepeat = $('input[name=password-repeat]').val();
    if(!($passwordRepeat === $password)) {
        event.preventDefault();
        $('#pass-match-error').html('<i>Passwords do not match.</i>');
    }
});