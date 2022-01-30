$(document).ready(function(){
    $('#submit').click(function(){
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var phone = $('#phonenumber').val();
        var email = $('#email').val();
        var msg = $('#message').val();

        function validateEmail(email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test(email);
        }
        function validatePhoneNumber(phone){
            var phoneno = /^[\d]{10}$/;
            return phoneno.test(phone);
        }

        $('.error').remove();

        if(firstname.length < 1){
            $('#firstname').after("<span class='error'>*Enter First Name</span>");
            return false;
        }else{
            $('#firstname').next().hide();
        }

        if(lastname.length < 1){
            $('#lastname').after("<span class='error'>*Enter Last Name</span>");
            return false;
        }else{
            $('#lastname').next().hide();
        }

        if(!validatePhoneNumber(phone)){
            $('#phonenumber').parent().after("<span class='error'>*Enter Phone Number</span>");
            return false;
        }else{
            $('#phonenumber').parent().next().hide();
        }

        if(email.length < 1 || !validateEmail(email)){
            $('#email').after("<span class='error'>*Enter Valid Email</span>");
            return false;
        }else{
            $('#email').next().hide();
        }

        if(msg.length < 1){
            $('#message').after("<span class='error'>*Enter Message</span>");
            return false;
        }else{
            $('#message').next().hide();
        }
       
    });
});