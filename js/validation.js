/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $("#register").click(function() {
        $("#registration_form").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                username: {
                    required: true,
                    filled: true,
                    minlength: 5
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    email: true
                }
            }
        });
    });

});

