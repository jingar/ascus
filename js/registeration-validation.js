/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {
    $("#register").click(function() {
        $("#registration_form").validate({
            rules: {
                name: {
                    required: true
                },
                username: {
                    required: true,
                    minlength: 5,
                    remote: {
                        type: 'post',
                        url: "/classes/CheckUniqueUsername.php",
                        data: {
                            type: 'text/html',
                            username: function()
                            {
                                return $('#registration_form :input[name="username"]').val();
                            }
                        }
                    }
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirmPassword: {
                    required: true,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        type: 'post',
                        url: "/classes/CheckUniqueEmail.php",
                        data: {
                            type: 'text/html',
                            email: function()
                            {
                                return $('#registration_form :input[name="email"]').val();
                            }
                        }
                    }
                }
            },
            messages: {
                name: {
                    required: "Please specify your name"
                },
                username: {
                    required: "You must choose a username",
                    minlength: "Your username must be a minimum of 5 characters long",
                    remote: jQuery.validator.format("{0} is already taken.")
                },
                password: {
                    required: "You must specify a password",
                    minlength: "Your password must be a minimum of 5 characters long"
                },
                confirmPassword: {
                    required: "You must confirm your password",
                    equalTo: "Passowrd and confirm password do not match"
                },
                email: {
                    required: "You must specify an email address",
                    email: "Email address does not exist",
                    remote: jQuery.validator.format("{0} is already taken.")
                }
            },
            errorPlacement: function(label, element) {
                label.addClass('error');
                label.insertAfter(element);
            }

        });
    });
});

