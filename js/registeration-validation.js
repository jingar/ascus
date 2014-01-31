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
                        url: "/php/CheckUniqueUsername.php",
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
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        type: 'post',
                        url: "/php/CheckUniqueEmail.php",
                        data: {
                            type: 'text/html',
                            username: function()
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
                confirm_password: {
                    required: "You must confirm your password",
                    equalTo: "Your passwords are not equal"
                },
                email: {
                    required: "You must specify an email address",
                    email: "Email address does not exist",
                    remote: jQuery.validator.format("{0} is already taken.")
                }
            }

        });
    });
});

