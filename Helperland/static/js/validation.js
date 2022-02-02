$(document).ready(function(){
    
    window.isValid = true;
    /* VALIDATION FOR CONTACT US FORM */
    $('#contactus').click(function(e){
        window.isValid = true;
        $('.error').remove();
        $('.alert').remove();
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var phonenumber = $('#phonenumber').val();
        var email = $('#email').val();
        var message = $('#message').val();
        var policy = $('#policy:checked').length;
        validateFirstName(firstname);
        validateLastName(lastname);
        validatePhoneNumber(phonenumber);
        validateEmail("#email",email);
        validateMessage(message);
        validatePolicy(policy);
        if(!window.isValid){
            e.preventDefault();
        }
    });

    /* VALIDATION FOR SIGNIN FORM */
    $("#signin").click(function(e){
        window.isValid = true;
        $('.error').remove();
        $('.alert').remove();
        var email = $('#signinemail').val();
        var password = $('#password').val();
        validateEmail("#signinemail",email);
        validatePassword("#password", password);
        if(!window.isValid){
            e.preventDefault();
        }
    });

    /* VALIDATION FOR SIGNUP FORM */
    $("#register").click(function(e){
        window.isValid = true;
        $('.error').remove();
        $('.alert').remove();
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var phonenumber = $('#phonenumber').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        var policy = $('#policy:checked').length;
        validateFirstName(firstname);
        validateLastName(lastname);
        validatePhoneNumber(phonenumber);
        validateEmail("#email",email);
        passwordMatched(password, repassword);
        validatePolicy(policy);
        if(!window.isValid){
            e.preventDefault();
        }
    });

    /* VALIDATION FOR FORGOT PASSWORD FORM */
    $("#forgotpassword").click(function(e){
        window.isValid = true;
        $('.error').remove();
        $('.alert').remove();
        var email = $('#forgotemail').val();
        validateEmail("#forgotemail",email);
        if(!window.isValid){
            e.preventDefault();
        }
    });

    /* VALIDATION FOR CHANGE PASSWORD FORM */
    $("#changepassword").click(function(e){
        window.isValid = true;
        $('.error').remove();
        $('.alert').remove();
        var password = $('#password').val();
        var repassword = $('#repassword').val();
        passwordMatched(password, repassword);
        if(!window.isValid){
            e.preventDefault();
        }
    });

    function validateFirstName(firstname){
        if(firstname.length < 1){
            $('#firstname').after("<span class='error'>*Enter the first name</span>");
            window.isValid = false;
            return;
        }
        
    }
    function validateLastName(lastname){
        if(lastname.length < 1){
            $('#lastname').after("<span class='error'>*Enter the last name</span>");
            window.isValid = false;
            return;
        }
    }
    function validatePhoneNumber(phonenumber){
        var reg = /^[\d]{10}$/;
        if(phonenumber.length < 1){
            $('#phonenumber').parent().after("<span class='error'>*Enter the mobile number</span>");
            window.isValid = false;
            return;
        }else if(!reg.test(phonenumber)){
            $('#phonenumber').parent().after("<span class='error'>*Mobile must be 10 charcters long</span>");
            window.isValid = false;
            return;
        }
    }
    function validateEmail(id,email){
        var reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if(email.length < 1){
            $(id).after("<span class='error'>*Email field cant be empty</span>");
            window.isValid = false;
            return;
        }else if(!reg.test(email)){
            $(id).after("<span class='error'>*Enter a valid email</span>");
            window.isValid = false;
            return;
        }
    }
    function validateMessage(message){
        if(message.length < 1){
            $('#message').after("<span class='error'>*Message can't be empty</span>");
            window.isValid = false;
            return;
        }
    }
    function validatePolicy(policy){
        if(policy==0){
            alert("Policy must be accepeted");
            window.isValid = false;
            return;
        }
    }

    function validatePassword(id, password){
        var reg = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&])[a-zA-Z\d@$!%*#?&]{6,14}$/;
        if(password.length < 1){
            $(id).after("<span class='error'>*"+id.replace("#", "")+" can't be empty</span>");
            window.isValid = false;
            return;
        }else{
            if(!reg.test(password)){
                $(id).after("<span class='error'>*At least one uppercase, lowercase, special char, numbers and 6 to 14 characters longer</span>");
                window.isValid = false;
                return;
            }
        }
        window.passwordValid = true;
    }

    function passwordMatched(pass, repass){
        window.passwordValid = false;
        validatePassword("#password",pass);
        validatePassword("#repassword",repass);
        if(window.passwordValid && pass!=repass){
            $("#password").after("<span class='error'>*password and repassword must be matched</span>");
            window.isValid = false;
            return;
        }
    }
});